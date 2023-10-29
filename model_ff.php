<?php
/*
*   User management
*/
$conn = mysqli_connect('localhost', 'kbergman', 'kbergman136', 'C354_kbergman');

function user_is_valid($username, $password)
{
    global $conn;
    $sql = "Select * from FF_Users where username = '$username' AND password = '$password'";
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result))
        return true;
    else
        return false;
}

function user_exists_UE($username, $email)
{
    global $conn;
    $sql = "Select * from FF_Users where username = '$username' OR email = '$email'";
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result))
        return true;
    else
        return false;
}
function check_email($email)
{
    global $conn;
    $sql = "Select * from FF_Users where email = '$email'";
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result))
        return true;
    else
        return false;
}

function user_exists_U($username)
{
    global $conn;
    $sql = "Select * from FF_Users where username = '$username'";
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result))
        return true;
    else
        return false;
}
function signup_new_user($username, $fname, $lname, $email, $pass)
{
    if($username == '' OR $fname == '' OR $lname == '' OR $email == '' OR $pass == ''){
        return false;
    }
    $result = false;
    if (!user_exists_UE($username, $email)) {
        global $conn;
        $current_date = date("Ymd");
        $sql = "INSERT INTO FF_Users (username, firstname, lastname, email, password, bio, datejoined) VALUES ('$username', '$fname', '$lname', '$email','$pass', '','$current_date')";
        $result = mysqli_query($conn, $sql);
    }
    return $result;
}

function unsubscribe_user($username)
{
    global $conn;
    $sql = "DELETE FROM FF_Users WHERE username = '$username'";
    $result = mysqli_query($conn, $sql);

    $sql = "DELETE FROM FF_Comments WHERE username = '$username'";
    mysqli_query($conn, $sql);

    $sql = "DELETE FROM FF_Following WHERE username = '$username'";
    mysqli_query($conn, $sql);

    $sql = "DELETE FROM FF_Following WHERE following = '$username'";
    mysqli_query($conn, $sql);

    $sql = "DELETE FROM FF_Messages WHERE sender = '$username'";
    mysqli_query($conn, $sql);

    $sql = "DELETE FROM FF_Messages WHERE receiver = '$username'";
    mysqli_query($conn, $sql);

    $sql = "DELETE FROM FF_Status WHERE username = '$username'";
    mysqli_query($conn, $sql);

    $sql = "DELETE FROM FF_StatusLikes WHERE username = '$username'";
    mysqli_query($conn, $sql);
}

function follow_user($username, $following, $user_term)
{
    if (user_exists_U($username) and user_exists_U($following)) {
        global $conn;
        $sql = "INSERT INTO FF_Following (username, following) VALUES ('$username', '$following')";
        $result = mysqli_query($conn, $sql);
    }
    return find_users($username, $user_term);
}

function find_users($username, $user_term)
{
    global $conn;
    $sql = "Select username, firstname, lastname from FF_Users WHERE (username NOT IN (SELECT following FROM FF_Following WHERE username = '$username' OR following = '$username')) AND ((username LIKE '%$user_term%') OR (firstname LIKE '%$user_term%') OR (lastname LIKE '%$user_term%')) ORDER BY username DESC";    
    $result = mysqli_query($conn, $sql);
    $data = [];
    $i = 0;
    if (mysqli_num_rows($result)) {
        while ($row = mysqli_fetch_assoc($result)) {
            if($row['username'] != $username){
                array_push($row, $user_term);
                $data[$i++] = $row;
            }
        }
    }
    return $data;
}
function create_post($u, $text)
{
    $result = false;
    global $conn;
    $current_date = date("Y-m-d H:i:s");
    $sql = "INSERT INTO FF_Status (username, statustext, statusdate, likeCount) VALUES ('$u', '$text', '$current_date',0)";
    $result = mysqli_query($conn, $sql);
    if ($result == true) {
        return 0;
    } else {
        return 1;
    }
}
function get_posts($username)
{
    global $conn;
    $sql = "Select * from FF_Status where username IN (SELECT following FROM FF_Following WHERE username = '$username') ORDER BY StatusDate DESC";
    $result = mysqli_query($conn, $sql);
    $data = [];
    $i = 0;
    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $data[$i++] = $row;
        }
    }
    return $data;
}

function like_post($username, $status_id, $current_likes)
{
    //insert into messages table
    // if (!user_exists($receiver)) {
    //     //error, return
    //     return "Invalid Recipient";
    // }
    global $conn;
    $sql = "Select * FROM FF_StatusLikes WHERE username = '$username' AND StatusID = $status_id";
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) == 0) {
        $sql = "INSERT INTO FF_StatusLikes (StatusID, Username) VALUES ($status_id, '$username');";
        $result = mysqli_query($conn, $sql);
        $current_likes++;
        $sql = "UPDATE FF_Status SET likeCount = $current_likes WHERE StatusID = $status_id";
        $result = mysqli_query($conn, $sql);
    }
    return $current_likes;
}

function get_comments($status_id)
{
    global $conn;
    $sql = "Select * from FF_Comments WHERE StatusID = '$status_id'";
    $result = mysqli_query($conn, $sql);
    $data = [];
    $i = 0;
    if (mysqli_num_rows($result)) {
        while ($row = mysqli_fetch_assoc($result)) {
            $data[$i++] = $row;
        }
    }
    return $data;
}

function get_commented($username)
{
    global $conn;
    $sql = "Select * from FF_Comments WHERE username = '$username'";
    $result = mysqli_query($conn, $sql);
    $data = [];
    $i = 0;
    if (mysqli_num_rows($result)) {
        while ($row = mysqli_fetch_assoc($result)) {
            $status_id = $row['StatusID'];
            $sql = "Select username as status_user, statustext from FF_Status WHERE StatusID = $status_id";
            $result2 = mysqli_query($conn, $sql);
            $row2 = mysqli_fetch_assoc($result2);
            array_push($row, $row2['status_user']);
            array_push($row, $row2['statustext']);
            $data[$i++] = $row;
        }
    }
    return $data;
}
function get_liked($username)
{
    global $conn;
    $sql = "Select * from FF_Status WHERE statusID IN (SELECT statusID FROM FF_StatusLikes WHERE  username = '$username') ORDER BY StatusDate DESC";
    $result = mysqli_query($conn, $sql);
    $data = [];
    $i = 0;
    if (mysqli_num_rows($result)) {
        while ($row = mysqli_fetch_assoc($result)) {
            $data[$i++] = $row;
        }
    }
    return $data;
}

function make_comment($status_id, $username, $comment_text)
{
    global $conn;
    $sql = "INSERT INTO FF_Comments (StatusID, Username, CommentText) VALUES ($status_id, '$username', '$comment_text');";
    $result = mysqli_query($conn, $sql);
    return $result;
}

function get_user_profile($username)
{
    global $conn;
    $sql = "Select username, firstname, lastname, email, bio from FF_Users where username = '$username'";
    $result = mysqli_query($conn, $sql);
    $data = [];
    if (mysqli_num_rows($result)) {
        $data[0] = mysqli_fetch_assoc($result);
        return $data;
    } else
        return false;
}

function search_posts($term)
{
    global $conn;
    $sql = "Select * from FF_Status where (StatusText LIKE '%$term%') ORDER BY StatusDate DESC";
    $result = mysqli_query($conn, $sql);
    $data = [];
    $i = 0;
    if (mysqli_num_rows($result)) {
        while ($row = mysqli_fetch_assoc($result)) {
            $data[$i++] = $row;
        }
    }
    return $data;
}



function unfollow_user($username, $following)
{
    global $conn;
    $sql = "DELETE FROM FF_Following WHERE username = '$username' AND following = '$following'";
    $result = mysqli_query($conn, $sql);
    if ($result)
        return get_following($username);
    else return $result;
}



function get_followers($user)
{
    global $conn;
    $sql = "Select username from FF_Following WHERE username != '$user' AND following = '$user'";
    $result = mysqli_query($conn, $sql);
    $data = [];
    $i = 0;
    if (mysqli_num_rows($result)) {
        while ($row = mysqli_fetch_assoc($result)) {
            $data[$i++] = $row;
        }
    }
    return $data;
}

function get_following($user)
{
    global $conn;
    $sql = "Select following from FF_Following WHERE following != '$user' AND username = '$user'";
    $result = mysqli_query($conn, $sql);
    $data = [];
    $i = 0;
    if (mysqli_num_rows($result)) {
        while ($row = mysqli_fetch_assoc($result)) {
            $data[$i++] = $row;
        }
    }
    return $data;
}
function edit_username($username, $newusername)
{
    if(user_exists_U($newusername)){
        return false;
    }
    global $conn;
    $sql = "UPDATE FF_Users SET username = '$newusername' WHERE username = '$username'";
    $result = mysqli_query($conn, $sql);
    $sql = "Select username from FF_Users where username = '$newusername'";
    $result = mysqli_query($conn, $sql);
    $data = [];
    if (mysqli_num_rows($result)) {
        $data[0] = mysqli_fetch_assoc($result);
        update_tables($username, $newusername);
        return $data;
    } else
        return false;
}

function update_tables($username, $newusername){
    global $conn;
    $sql = "UPDATE FF_Comments SET username = '$newusername' WHERE username = '$username'";
    mysqli_query($conn, $sql);

    $sql = "UPDATE FF_Following SET username = '$newusername' WHERE username = '$username'";
    mysqli_query($conn, $sql);

    $sql = "UPDATE FF_Following SET following = '$newusername' WHERE following = '$username'";
    mysqli_query($conn, $sql);

    $sql = "UPDATE FF_Messages SET sender = '$newusername' WHERE sender = '$username'";
    mysqli_query($conn, $sql);

    $sql = "UPDATE FF_Messages SET receiver = '$newusername' WHERE receiver = '$username'";
    mysqli_query($conn, $sql);

    $sql = "UPDATE FF_Status SET username = '$newusername' WHERE username = '$username'";
    mysqli_query($conn, $sql);

    $sql = "UPDATE FF_StatusLikes SET username = '$newusername' WHERE username = '$username'";
    mysqli_query($conn, $sql);
}

function edit_firstname($username, $firstname)
{
    global $conn;
    $sql = "UPDATE FF_Users SET firstname = '$firstname' WHERE username = '$username'";
    $result = mysqli_query($conn, $sql);
    $sql = "Select username from FF_Users where username = '$username'";
    $result = mysqli_query($conn, $sql);
    $data = [];
    if (mysqli_num_rows($result)) {
        $data[0] = mysqli_fetch_assoc($result);
        return $data;
    } else
        return false;
}

function edit_lastname($username, $lastname)
{
    global $conn;
    $sql = "UPDATE FF_Users SET lastname = '$lastname' WHERE username = '$username'";
    $result = mysqli_query($conn, $sql);
    $sql = "Select username from FF_Users where username = '$username'";
    $result = mysqli_query($conn, $sql);
    $data = [];
    if (mysqli_num_rows($result)) {
        $data[0] = mysqli_fetch_assoc($result);
        return $data;
    } else
        return false;
}
function edit_bio($username, $bio)
{
    global $conn;
    $sql = "UPDATE FF_Users SET bio = '$bio' WHERE username = '$username'";
    $result = mysqli_query($conn, $sql);
    $sql = "Select username from FF_Users where username = '$username'";
    $result = mysqli_query($conn, $sql);
    $data = [];
    if (mysqli_num_rows($result)) {
        $data[0] = mysqli_fetch_assoc($result);
        return $data;
    } else
        return false;
}
function edit_email($username, $email)
{
    if(check_email($email)){
        return false;
    }
    global $conn;
    $sql = "UPDATE FF_Users SET email = '$email' WHERE username = '$username'";
    $result = mysqli_query($conn, $sql);
    $sql = "Select username from FF_Users where username = '$username'";
    $result = mysqli_query($conn, $sql);
    $data = [];
    if (mysqli_num_rows($result)) {
        $data[0] = mysqli_fetch_assoc($result);
    }
    return $data;
}
function edit_password($username, $password)
{
    global $conn;
    $sql = "UPDATE FF_Users SET password = '$password' WHERE username = '$username'";
    $result = mysqli_query($conn, $sql);
    $sql = "Select username from FF_Users where username = '$username'";
    $result = mysqli_query($conn, $sql);
    $data = [];
    if (mysqli_num_rows($result)) {
        $data[0] = mysqli_fetch_assoc($result);
        return $data;
    } else
        return false;
}
function search_friends($term)
{
    global $conn;
    $sql = "Select * from Users WHERE username LIKE '%$term%'";
    if ($term == '') {
        $sql = "Select * from Users";
    }
    $result = mysqli_query($conn, $sql);
    $data = [];
    $i = 0;
    if (mysqli_num_rows($result)) {
        while ($row = mysqli_fetch_assoc($result)) {
            $data[$i++] = $row;
        }
    }
    return $data;
}

function save_message($sender, $receiver, $message)
{
    //insert into messages table
    if (!user_exists_U($receiver)) {
        //error, return
        return "Invalid Recipient";
    }
    global $conn;
    $current_date = date("Ymd");
    $sql = "INSERT INTO FF_Messages VALUES (NULL, '$sender', '$receiver', '$message', '$current_date', 0);";
    $result = mysqli_query($conn, $sql);
    if ($result) {
        return "Message Sent Successfully";
    } else {
        return "Error Sending Message";
    }
}
function read_message($receiver, $readstate)
{
    global $conn;
    $sql = "select * from FF_Messages where receiver = '$receiver' and ReadOrNot = '$readstate';";
    $result = mysqli_query($conn, $sql);
    $data = [];
    $i = 0;
    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $data[$i++] = $row;
            if ($readstate == 0) {
                $id = $row['ID'];
                $sql = "UPDATE FF_Messages SET ReadOrNot = 1 WHERE ID = '$id'";
                mysqli_query($conn, $sql);
            }
        }
    }
    return $data;
}
