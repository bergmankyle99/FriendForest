<?php
/*
 *   User management
 */

$conn = mysqli_connect('', '', '', '');

if (!$conn) {
    die("Database connection failed: " . mysqli_connect_error());
}
$conn->set_charset("utf8mb4");

/*
 * Helper function for prepared statements
 */
function db_query($sql, $types = "", $params = [])
{
    global $conn;

    $stmt = $conn->prepare($sql);

    if (!$stmt) {
        die("SQL Prepare Error: " . $conn->error);
    }

    if ($types != "") {
        $stmt->bind_param($types, ...$params);
    }

    $stmt->execute();

    return $stmt;
}


/*
 * Check username/password login
 */
function user_is_valid($username, $password)
{
    $stmt = db_query(
        "SELECT password FROM FF_Users WHERE username = ?",
        "s",
        [$username]
    );

    $result = $stmt->get_result();

    if ($result->num_rows == 1) {

        $row = $result->fetch_assoc();

        if (password_verify($password, $row['password'])) {
            return true;
        }

    }

    return false;
}


/*
 * Check if username OR email exists
 */
function user_exists_UE($username, $email)
{
    $stmt = db_query(
        "SELECT * FROM FF_Users WHERE username = ? OR email = ?",
        "ss",
        [
            $username,
            $email
        ]
    );

    return $stmt->get_result()->num_rows > 0;
}

function username_taken($username)
{
    $stmt = db_query(
        "SELECT username FROM FF_Users WHERE username = ?",
        "s",
        [$username]
    );

    return $stmt->get_result()->num_rows > 0;
}


/*
 * Check if email exists
 */
function check_email($email)
{
    $stmt = db_query(
        "SELECT * FROM FF_Users WHERE email = ?",
        "s",
        [$email]
    );

    return $stmt->get_result()->num_rows > 0;
}


/*
 * Check if username exists
 */
function user_exists_U($username)
{
    $stmt = db_query(
        "SELECT * FROM FF_Users WHERE username = ?",
        "s",
        [$username]
    );

    return $stmt->get_result()->num_rows > 0;
}


/*
 * Create new user
 */
function signup_new_user($username, $fname, $lname, $email, $pass)
{

    if (
        $username == '' ||
        $fname == '' ||
        $lname == '' ||
        $email == '' ||
        $pass == ''
    ) {
        return false;
    }


    if (user_exists_UE($username, $email)) {
        return false;
    }


    $current_date = date("Ymd");

    $pass_hash = password_hash(
        $pass,
        PASSWORD_DEFAULT
    );


    $stmt = db_query(
        "
        INSERT INTO FF_Users
        (
            username,
            firstname,
            lastname,
            email,
            password,
            bio,
            datejoined
        )
        VALUES (?, ?, ?, ?, ?, ?, ?)
        ",
        "sssssss",
        [
            $username,
            $fname,
            $lname,
            $email,
            $pass_hash,
            "",
            $current_date
        ]
    );


    return $stmt->affected_rows > 0;
}

/*
 * Delete user and related data
 */
function unsubscribe_user($username)
{

    $tables = [
        "FF_Comments" => "username",
        "FF_Following" => "username",
        "FF_Messages" => "sender",
        "FF_Status" => "username",
        "FF_StatusLikes" => "username",
        "FF_Users" => "username"
    ];


    foreach ($tables as $table => $column) {

        db_query(
            "DELETE FROM $table WHERE $column = ?",
            "s",
            [$username]
        );

    }


    // Delete users they were following
    db_query(
        "DELETE FROM FF_Following WHERE following = ?",
        "s",
        [$username]
    );


    // Delete messages they received
    db_query(
        "DELETE FROM FF_Messages WHERE receiver = ?",
        "s",
        [$username]
    );

}


/*
 * Follow another user
 */
function follow_user($username, $following, $user_term)
{

    if (
        user_exists_U($username) &&
        user_exists_U($following)
    ) {

        db_query(
            "
            INSERT INTO FF_Following
            (username, following)
            VALUES (?, ?)
            ",
            "ss",
            [
                $username,
                $following
            ]
        );

    }


    return find_users($username, $user_term);
}


/*
 * Find users
 */
function find_users($username, $user_term)
{

    $search = "%" . $user_term . "%";


    $stmt = db_query(
        "
        SELECT username, firstname, lastname
        FROM FF_Users
        WHERE username NOT IN
        (
            SELECT following
            FROM FF_Following
            WHERE username = ?
            OR following = ?
        )
        AND
        (
            username LIKE ?
            OR firstname LIKE ?
            OR lastname LIKE ?
        )
        ORDER BY username DESC
        ",
        "sssss",
        [
            $username,
            $username,
            $search,
            $search,
            $search
        ]
    );


    $result = $stmt->get_result();

    $data = [];
    $i = 0;


    while ($row = $result->fetch_assoc()) {

        if ($row['username'] != $username) {

            array_push($row, $user_term);

            $data[$i++] = $row;

        }

    }


    return $data;
}



/*
 * Create post
 */
function create_post($u, $text)
{

    $current_date = date("Y-m-d H:i:s");


    $stmt = db_query(
        "
        INSERT INTO FF_Status
        (
            username,
            statustext,
            statusdate,
            likeCount
        )
        VALUES (?, ?, ?, 0)
        ",
        "sss",
        [
            $u,
            $text,
            $current_date
        ]
    );


    if ($stmt->affected_rows > 0) {
        return 0;
    }


    return 1;
}



/*
 * Get posts from followed users
 */
function get_posts($username)
{

    $stmt = db_query(
        "
        SELECT *
        FROM FF_Status
        WHERE username IN
        (
            SELECT following
            FROM FF_Following
            WHERE username = ?
        )
        ORDER BY StatusDate DESC
        ",
        "s",
        [$username]
    );


    $result = $stmt->get_result();


    $data = [];
    $i = 0;


    while ($row = $result->fetch_assoc()) {

        $data[$i++] = $row;

    }


    return $data;
}



/*
 * Like post
 */
function like_post($username, $status_id, $current_likes)
{

    $stmt = db_query(
        "
        SELECT *
        FROM FF_StatusLikes
        WHERE username = ?
        AND status_id = ?
        ",
        "si",
        [
            $username,
            $status_id
        ]
    );


    $result = $stmt->get_result();


    if ($result->num_rows == 0) {


        db_query(
            "
            INSERT INTO FF_StatusLikes
            (
                status_id,
                username
            )
            VALUES (?, ?)
            ",
            "is",
            [
                $status_id,
                $username
            ]
        );


        $current_likes++;


        db_query(
            "
            UPDATE FF_Status
            SET likeCount = ?
            WHERE status_id = ?
            ",
            "ii",
            [
                $current_likes,
                $status_id
            ]
        );

    }


    return $current_likes;
}

function get_comments($status_id)
{
    global $conn;

    $stmt = $conn->prepare(
        "SELECT * FROM FF_Comments WHERE status_id = ?"
    );

    $stmt->bind_param("i", $status_id);
    $stmt->execute();

    $result = $stmt->get_result();

    $data = [];
    $i = 0;

    while ($row = mysqli_fetch_assoc($result)) {
        $data[$i++] = $row;
    }

    return $data;
}


function get_commented($username)
{
    global $conn;

    $stmt = $conn->prepare(
        "SELECT * FROM FF_Comments WHERE username = ?"
    );

    $stmt->bind_param("s", $username);
    $stmt->execute();

    $result = $stmt->get_result();

    $data = [];
    $i = 0;


    while ($row = mysqli_fetch_assoc($result)) {

        $status_id = $row['status_id'];


        $stmt2 = $conn->prepare(
            "SELECT username AS status_user, statustext 
             FROM FF_Status 
             WHERE status_id = ?"
        );

        $stmt2->bind_param("i", $status_id);
        $stmt2->execute();

        $result2 = $stmt2->get_result();

        if ($row2 = mysqli_fetch_assoc($result2)) {

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


    $stmt = $conn->prepare(
        "SELECT * 
         FROM FF_Status 
         WHERE status_id IN 
         (
            SELECT status_id 
            FROM FF_StatusLikes 
            WHERE username = ?
         )
         ORDER BY StatusDate DESC"
    );


    $stmt->bind_param("s", $username);
    $stmt->execute();


    $result = $stmt->get_result();


    $data = [];
    $i = 0;


    while ($row = mysqli_fetch_assoc($result)) {
        $data[$i++] = $row;
    }


    return $data;
}



function make_comment($status_id, $username, $comment_text)
{
    global $conn;


    $stmt = $conn->prepare(
        "INSERT INTO FF_Comments
        (
            status_id,
            username,
            comment_text
        )
        VALUES (?, ?, ?)"
    );


    $stmt->bind_param(
        "iss",
        $status_id,
        $username,
        $comment_text
    );


    return $stmt->execute();
}



function get_user_profile($username)
{
    global $conn;


    $stmt = $conn->prepare(
        "SELECT username, firstname, lastname, bio
         FROM FF_Users
         WHERE username = ?"
    );


    $stmt->bind_param("s", $username);
    $stmt->execute();


    $result = $stmt->get_result();


    $data = [];


    if ($result->num_rows) {

        $data[0] = mysqli_fetch_assoc($result);

        return $data;
    }


    return false;
}



function search_posts($term)
{
    global $conn;


    $search = "%" . $term . "%";


    $stmt = $conn->prepare(
        "SELECT *
         FROM FF_Status
         WHERE StatusText LIKE ?
         ORDER BY StatusDate DESC"
    );


    $stmt->bind_param("s", $search);
    $stmt->execute();


    $result = $stmt->get_result();


    $data = [];
    $i = 0;


    while ($row = mysqli_fetch_assoc($result)) {
        $data[$i++] = $row;
    }


    return $data;
}



function unfollow_user($username, $following)
{
    global $conn;


    $stmt = $conn->prepare(
        "DELETE FROM FF_Following
         WHERE username = ?
         AND following = ?"
    );


    $stmt->bind_param(
        "ss",
        $username,
        $following
    );


    $result = $stmt->execute();


    if ($result) {
        return get_following($username);
    }


    return false;
}



function get_followers($user)
{
    global $conn;


    $stmt = $conn->prepare(
        "SELECT username
         FROM FF_Following
         WHERE username != ?
         AND following = ?"
    );


    $stmt->bind_param(
        "ss",
        $user,
        $user
    );


    $stmt->execute();


    $result = $stmt->get_result();


    $data = [];
    $i = 0;


    while ($row = mysqli_fetch_assoc($result)) {
        $data[$i++] = $row;
    }


    return $data;
}



function get_following($user)
{
    global $conn;


    $stmt = $conn->prepare(
        "SELECT following
         FROM FF_Following
         WHERE following != ?
         AND username = ?"
    );


    $stmt->bind_param(
        "ss",
        $user,
        $user
    );


    $stmt->execute();


    $result = $stmt->get_result();


    $data = [];
    $i = 0;


    while ($row = mysqli_fetch_assoc($result)) {
        $data[$i++] = $row;
    }


    return $data;
}
function edit_username($username, $newusername)
{
    global $conn;

    // Already taken?
    if (user_exists_U($newusername)) {
        return false;
    }

    // ----- critical part -----
    $conn->query("SET FOREIGN_KEY_CHECKS = 0");

    // 1. Update all related tables
    update_tables($username, $newusername);

    // 2. Update the main Users table
    $stmt = $conn->prepare(
        "UPDATE FF_Users SET username = ? WHERE username = ?"
    );
    $stmt->bind_param("ss", $newusername, $username);
    $stmt->execute();

    $success = ($stmt->affected_rows > 0);

    // Re-enable foreign key checks
    $conn->query("SET FOREIGN_KEY_CHECKS = 1");
    // -------------------------

    if (!$success) {
        return false;
    }

    return [
        ["username" => $newusername]
    ];
}

function update_tables($username, $newusername)
{
    global $conn;


    $tables = [

        "UPDATE FF_Comments 
         SET username = ? 
         WHERE username = ?",


        "UPDATE FF_Following 
         SET username = ? 
         WHERE username = ?",


        "UPDATE FF_Following 
         SET following = ? 
         WHERE following = ?",


        "UPDATE FF_Messages 
         SET sender = ? 
         WHERE sender = ?",


        "UPDATE FF_Messages 
         SET receiver = ? 
         WHERE receiver = ?",


        "UPDATE FF_Status 
         SET username = ? 
         WHERE username = ?",


        "UPDATE FF_StatusLikes 
         SET username = ? 
         WHERE username = ?"
    ];


    foreach ($tables as $sql) {

        $stmt = $conn->prepare($sql);


        $stmt->bind_param(
            "ss",
            $newusername,
            $username
        );


        $stmt->execute();
    }
}




function edit_firstname($username, $firstname)
{
    global $conn;


    $stmt = $conn->prepare(
        "UPDATE FF_Users 
         SET firstname = ?
         WHERE username = ?"
    );


    $stmt->bind_param(
        "ss",
        $firstname,
        $username
    );


    $stmt->execute();


    return get_user_edit_result($username);
}



function edit_lastname($username, $lastname)
{
    global $conn;


    $stmt = $conn->prepare(
        "UPDATE FF_Users 
         SET lastname = ?
         WHERE username = ?"
    );


    $stmt->bind_param(
        "ss",
        $lastname,
        $username
    );


    $stmt->execute();


    return get_user_edit_result($username);
}




function edit_bio($username, $bio)
{
    global $conn;


    $stmt = $conn->prepare(
        "UPDATE FF_Users 
         SET bio = ?
         WHERE username = ?"
    );


    $stmt->bind_param(
        "ss",
        $bio,
        $username
    );


    $stmt->execute();


    return get_user_edit_result($username);
}




function get_user_edit_result($username)
{
    global $conn;


    $stmt = $conn->prepare(
        "SELECT username 
         FROM FF_Users 
         WHERE username = ?"
    );


    $stmt->bind_param(
        "s",
        $username
    );


    $stmt->execute();


    $result = $stmt->get_result();


    if ($result->num_rows) {

        $data = [];

        $data[0] = mysqli_fetch_assoc($result);

        return $data;
    }


    return false;
}
function edit_email($username, $email)
{
    if (check_email($email)) {
        return false;
    }


    global $conn;


    $stmt = $conn->prepare(
        "UPDATE FF_Users 
         SET email = ?
         WHERE username = ?"
    );


    $stmt->bind_param(
        "ss",
        $email,
        $username
    );


    $stmt->execute();


    return get_user_edit_result($username);
}



function edit_password($username, $password)
{
    global $conn;


    // Hash password before storing
    $password_hash = password_hash(
        $password,
        PASSWORD_DEFAULT
    );


    $stmt = $conn->prepare(
        "UPDATE FF_Users
         SET password = ?
         WHERE username = ?"
    );


    $stmt->bind_param(
        "ss",
        $password_hash,
        $username
    );


    $stmt->execute();


    return get_user_edit_result($username);
}



function search_friends($term)
{
    global $conn;


    $data = [];
    $i = 0;


    if ($term == '') {

        $stmt = $conn->prepare(
            "SELECT username, firstname, lastname, bio FROM FF_Users"
        );


    } else {


        $search = "%" . $term . "%";


        $stmt = $conn->prepare(
            "SELECT username, firstname, lastname, bio
             FROM FF_Users
             WHERE username LIKE ?"
        );


        $stmt->bind_param(
            "s",
            $search
        );
    }


    $stmt->execute();


    $result = $stmt->get_result();


    while ($row = mysqli_fetch_assoc($result)) {
        $data[$i++] = $row;
    }


    return $data;
}





function save_message($sender, $receiver, $message)
{
    if (!user_exists_U($receiver)) {
        return "Invalid Recipient";
    }


    global $conn;


    $current_date = date("Ymd");


    $stmt = $conn->prepare(
        "INSERT INTO FF_Messages
        (
            sender,
            receiver,
            message,
            message_date,
            ReadOrNot
        )
        VALUES (?, ?, ?, ?, 0)"
    );


    $stmt->bind_param(
        "ssss",
        $sender,
        $receiver,
        $message,
        $current_date
    );


    $result = $stmt->execute();


    if ($result) {
        return "Message Sent Successfully";
    }


    return "Error Sending Message";
}




function read_message($receiver, $readstate)
{
    global $conn;


    $stmt = $conn->prepare(
        "SELECT *
         FROM FF_Messages
         WHERE receiver = ?
         AND ReadOrNot = ?"
    );


    $stmt->bind_param(
        "si",
        $receiver,
        $readstate
    );


    $stmt->execute();


    $result = $stmt->get_result();


    $data = [];
    $i = 0;


    while ($row = mysqli_fetch_assoc($result)) {

        $data[$i++] = $row;


        if ($readstate == 0) {

            $id = $row['message_id'];


            $stmt2 = $conn->prepare(
                "UPDATE FF_Messages
                 SET ReadOrNot = 1
                 WHERE message_id = ?"
            );


            $stmt2->bind_param(
                "i",
                $id
            );


            $stmt2->execute();
        }
    }


    return $data;
}