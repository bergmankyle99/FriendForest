<?php
?>

<!DOCTYPE html>

<html>

<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script>
        $(document).keypress(
            function(event) {
                if (event.which == '13') {
                    event.preventDefault();
                }
            });
    </script>
    <?php
    $user_var = '';
    if (!isset($_SESSION[$sess_user])) {
        include('view_startpage_ff.php');
        exit();
    } else {
        $user_var = $_SESSION[$sess_user];
    }
    ?>
    <title>FriendForest - Home</title>

    <style>
        body,
        html {
            height: 100%;
            font-family: Arial, sans-serif;
        }


        #top_bar {
            position: absolute;

            height: 50px;
            width: 100vw;
            background-color: rgb(12, 79, 237);
            font-size: 2em;
            color: white;
            z-index: 3;
        }

        #top_bar>span {
            display: inline-block;
            padding-left: 10px;
            width: 25%;
        }

        #top_bar_form {
            position: absolute;
            display: inline-block;
            line-height: 100%;
            font-size: 0.75em;
            top: 5px;
            right: 0;
        }

        #top_bar_search {
            margin-top: 3px;
            margin-left: 3px;
            border: none;
            border: solid 1px #ccc;
            border-radius: 10px;
        }

        #create_post_text {
            text-align: left;
            margin-top: 3px;
            margin-left: 3px;
            border: none;
            border: solid 1px #ccc;
            border-radius: 10px;
            width: 50%;
            line-height: 80%;
        }

        #create_post_div {
            display: none;
            position: fixed;
            text-align: center;
            font-size: 1.5em;
            color: white;
            margin-top: 3px;
            width: 60%;
            margin-left: 3px;
            border: none;
            border: solid 1px #ccc;
            border-radius: 10px;
            background-color: rgb(12, 79, 237);
        }

        #find_user_search_div {
            display: none;
            position: fixed;
            text-align: center;
            font-size: 1.5em;
            color: white;
            margin-top: 3px;
            width: 60%;
            margin-left: 3px;
            border: none;
            border: solid 1px #ccc;
            border-radius: 10px;
            background-color: rgb(12, 79, 237);
        }

        #select_follower_page_div {
            display: none;
            position: fixed;
            font-size: 1.5em;
            color: white;
            margin-top: 3px;
            width: 60%;
            margin-left: 3px;
            border: none;
            border: solid 1px #ccc;
            border-radius: 10px;
            background-color: rgb(12, 79, 237);
        }

        #create_message_div {
            display: none;
            position: fixed;
            text-align: center;
            font-size: 1.5em;
            color: white;
            margin-top: 3px;
            width: 60%;
            margin-left: 3px;
            border: none;
            border: solid 1px #ccc;
            border-radius: 10px;
            background-color: rgb(12, 79, 237);
        }

        #refresh_messages {
            width: 2%;
            height: auto;
        }

        #main_div {
            display: block;
            position: relative;
            background-color: white;
            height: 100%;
            margin: auto;
            width: 75vw;
            z-index: 2;
        }

        #html_div {
            display: block;
            position: relative;
            background-image: url("forest_mainpage_background.jpg");
            background-position: center;
            background-repeat: no-repeat;
            background-size: cover;
            top: 50px;
            height: calc(100% - 50px);
            width: 100%;
            z-index: 1;
        }

        #vertical-line {
            position: relative;
            height: 100%;
            display: inline-block;
            width: 1px;
            border: 1px solid black;
        }

        #mainpage_menu {
            position: relative;
            display: inline-block;
            width: 15%;
            height: 100%;
        }

        #user_icon_img {
            position: relative;
            left: 15px;
            height: auto;
            width: 20%;
        }

        #menu_div {
            display: block;
            float: left;
            border-right: 2px solid black;
            width: 17%;
            height: 100%;
        }

        #content_div {
            display: inline-block;
            position: relative;
            top: 5%;
            width: 82%;
            height: 95%;
            border-right: 2px solid black;
            border-top: 2px solid black;
        }

        #hor_line {
            border-bottom: 2px solid black;
            position: relative;
            width: 100%;
            height: auto;
        }

        .menu_item {
            font-size: x-large;
            padding-left: 10px;
            cursor: pointer;
        }

        #menu_item_logout {
            position: absolute;
            bottom: 0;
            cursor: pointer;
        }

        #post_template_div {
            border-bottom: 2px solid black;
        }

        #follower_template_div {
            border-bottom: 2px solid black;
        }

        #comment_template_div {
            border-top: 2px solid black;
        }

        #message_template_div {
            border-top: 2px solid black;
        }

        #user_top_div {
            border-bottom: 2px solid black;
        }

        #user_top_username {
            padding-left: 5%;
            font-size: 5em;
        }

        #user_top_name {
            padding-left: 2.5%;
            font-size: 2em;
        }

        #user_top_bio {
            padding-left: 2.5%;
            font-size: 2em;
        }

        #user_profile_edit_div_1 {
            width: 40%;
            float: left;
            padding-left: 5%;
            padding-top: 2%;
        }

        #user_profile_edit_div_2 {
            width: 40%;
            float: right;
            padding-right: 5%;
            padding-top: 2%;
        }

        .modal-window {
            width: 400px;
            height: 250px;
            border: 1px solid black;
            display: none;
            background-color: White;
            position: fixed;
            top: calc(50vh - 125px);
            left: calc(50vw - 200px);
            z-index: 999;
        }
    </style>
</head>

<body>
    <div id='top_bar'>
        <span>FriendForest</span>
        <form id='top_bar_form'>
            <label for="top_bar_search">Search</label>
            <input type="text" id="top_bar_search" placeholder="Find a post" name='top_search_text'>
            <button id='top_bar_search_button' type="button" class="btn btn-secondary">Find</button>
        </form>
    </div>
    <div id='html_div'>
        <div id='main_div'>
            <div id='menu_div'>
                <img src='user_icon.png' style="position: relative; width: 20%; height: auto;">
                <p id='menu_username_label' style="position: relative; display: inline-block; font-size: 1.5em;">Username</p>
                <p id='hor_line'></p>
                <p id='menu_item_feed' class='menu_item'>Feed</p>
                <p id='menu_item_following' class='menu_item'>Following</p>
                <p id='menu_item_messages' class='menu_item'>Messages</p>
                <p id='menu_item_liked' class='menu_item'>Liked Posts</p>
                <p id='menu_item_comments' class='menu_item'>Comments</p>
                <p id='menu_item_edit' class='menu_item'>Edit Profile</p>
                <p id='menu_item_logout' class='menu_item'>LogOut</p>
            </div>
            <div id='create_post_div'>
                <form id='create_post_form'>
                    <input type='hidden' name='page' value='MainPage'>
                    <input type='hidden' name='command' value='CreatePost'>
                    <label for="create_post_text">Create Post</label>
                    <input type="text" id="create_post_text" name='status_text' placeholder="What are you thinking about?">
                    <button id='create_post_button' type="button" class="btn btn-secondary">Post</button>
                </form>
            </div>
            <div id='create_message_div'>
                <label for="create_message_text">Create Message</label>
                <input type="text" id="create_message_receiver" name='receiver' placeholder="Receiver">
                <input type="text" id="create_message_text" name='message_text' placeholder="Message" required>
                <button id='create_message_button' type="button" class="btn btn-secondary">Send</button>
            </div>
            <div id='select_follower_page_div'>
                <div id='followers_div' style='display: inline-block; text-align: center; width: 32%; border-right: 2px solid black; cursor: pointer;'>
                    Followers
                </div>
                <div id='following_div' style='display: inline-block; text-align: center;  width: 32%; cursor: pointer;'>
                    Following
                </div>
                <div id='find_users_div' style='display: inline-block; text-align: center;  width: 32%; border-left: 2px solid black; cursor: pointer;'>
                    Find Users
                </div>
            </div>
            <div id='content_div' style='overflow-y: auto;'>
                <div id='display_feed_div' style='display: none;'>
                </div>
                <div id='display_followers_div' style='display: none;'>
                </div>
                <div id='display_messages_div' style='display: none;'>
                    Get New Messages: <img src='refresh.png' id='refresh_messages' style='cursor: pointer;'>
                    <br>
                    <br>
                    <h4>New Messages</h4>
                    <div id='pane-messages-unread'>
                    </div>
                    <h4>Read Messages</h4>
                    <div id='pane-messages-read'>
                    </div>
                </div>
                <div id='display_likes_div' style='display: none;'>
                </div>
                <div id='display_comments_div' style='display: none;'>
                </div>
                <div id='user_profile_div' style='display: none;'>
                    <div id='user_top_div'>
                        <img src='user_icon.png' style="position: relative; width: 20%; height: auto;">
                        <div id='user_top_username' style='display: inline-block;'><?php if (count($getuser_data) > 0) echo $getuser_data[0]['username']; ?></div>
                        <br>
                        <div id='user_top_name' style='display: inline-block;'><?php if (count($getuser_data) > 0) echo $getuser_data[0]['firstname'] + " " + $getuser_data[0]['lastname']; ?></div>
                        <br>
                        <div id='user_top_bio' style='display: inline-block;'><?php if (count($getuser_data) > 0) echo $getuser_data[0]['bio']; ?></div>
                    </div>
                    <div id='user_profile_edit_div_1'>
                        <form id='username_edit_form'>
                            <label class='control_label' for='edit_username'>Username:</label>
                            <input class="form-control" id='edit_username' type='text'>
                            <button id='edit_username_button' type="button" class="btn btn-secondary">Change</button>
                        </form>
                        <br>
                        <form id='firstname_edit_form'>
                            <label class='control_label' for='edit_firstname'>First Name:</label>
                            <input class="form-control" id='edit_firstname' type='text' name='firstname'>
                            <button id='edit_firstname_button' type="button" class="btn btn-secondary">Change</button>
                        </form>
                        <br>
                        <form id='lastname_edit_form'>
                            <label class='control_label' for='edit_lastname'>Last Name:</label>
                            <input class="form-control" id='edit_lastname' type='text' name='lastname'>
                            <button id='edit_lastname_button' type="button" class="btn btn-secondary">Change</button>
                        </form>
                    </div>
                    <div id='user_profile_edit_div_2'>
                        <form id='bio_edit_form'>
                            <label class='control_label' for='edit_bio'>Bio:</label>
                            <input class="form-control" id='edit_bio' type='text' name='bio'>
                            <button id='edit_bio_button' type="button" class="btn btn-secondary">Change</button>
                        </form>
                        <br>
                        <form id='email_edit_form'>
                            <label class='control_label' for='edit_email'>Email:</label>
                            <input class="form-control" id='edit_email' type='email' name='email'>
                            <button id='edit_email_button' type="button" class="btn btn-secondary">Change</button>
                        </form>
                        <br>
                        <form id='password_edit_form'>
                            <label class='control_label' for='edit_password'>Password:</label>
                            <input class="form-control" id='edit_password' type='text' name='password'>
                            <button id='edit_password_button' type="button" class="btn btn-secondary">Change</button>
                        </form>
                        <br>
                        <br>
                        <h3 id='unsub_span' style='color: red; border: 2px solid red; cursor: pointer;'>Unsubscribe from Friend Forest</h3>
                    </div>
                </div>


            </div>
        </div>
    </div>
    </div>
    </div>
    <form id='form-logout' method='post' action='controller_ff.php' style='display:none'>
        <input type='hidden' name='page' value='MainPage'>
        <input type='hidden' name='command' value='LogOut'>
        <input type='submit'>
    </form>
    <div class='modal fade' id='modal_comment'>
        <div class='modal-dialog'>
            <div class='modal-content'>
                <span id='modal_status_id' style='display:none;'></span>
                <form method='post' action='controller_ff.php'>
                    <div class='modal-title'>
                        <h4 class='modal-title'>Comments</h4>
                    </div>
                    <div class='modal-body' id='modal_comment_display' style='overflow-y:scroll;'>

                    </div>
                    <div class='modal-footer'>
                        <div class="input-group">
                            <input class="form-control" id='input_comment_text' type='text'>
                            <button id='comment-button' type="button" class="btn btn-outline-primary">Comment</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>


</html>

<script>
    $('#top_bar_search_button').click(function() {
        var xhttp = new XMLHttpRequest(); // AJAX code for the SendMessage command. The command will be sent to test_send_message.php.
        xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                let data = JSON.parse(this.response);
                hideAll();
                document.getElementById('display_feed_div').innerHTML = "";
                if (data.length == 0) {
                    document.getElementById('display_feed_div').innerHTML += "<h3>No posts to show with that Term. Find more friends in the Followers tab, or wait for someone you follow to post</h3>";
                } else {
                    for (let i = 0; i < data.length; i++) {
                        let date_string = data[i]['StatusDate'].toString();
                        console.log(date_string);
                        let year_string = date_string.substring(0, 4);
                        let month_string = date_string.substring(4, 6);
                        let day_string = date_string.substring(6, 8);

                        document.getElementById('display_feed_div').innerHTML += "<div id = 'post_template_div' ><p>Username: " + data[i]['Username'] + "</p><p>" + data[i]['StatusText'] + "</p><p>Date: " + data[i]['StatusDate'] + "</p><span onclick='likeStatusFA(" + data[i]['StatusID'] + ", " + data[i]['likeCount'] + ")'style='color: red; cursor: pointer;'>Like </span><span>" + data[i]['likeCount'] + "</span><br><span onclick='openComments(" + data[i]['StatusID'] + ")' style='color: blue; cursor: pointer;'>Comments</span></div>";
                    }
                    document.getElementById('top_bar_search').value = '';

                }
                showFeed();
            }
        };
        xhttp.open("POST", "controller_ff.php");
        xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        var query = "";
        query += "page=MainPage";
        query += "&command=TopBarSearch";
        query += "&search_text=" + $("#top_bar_search").val();
        xhttp.send(query);
    });

    function get_posts() {
        var xhttp = new XMLHttpRequest(); // AJAX code for the SendMessage command. The command will be sent to test_send_message.php.
        xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                //alert(this.response);
                document.getElementById('display_feed_div').innerHTML = "";
                let data = JSON.parse(this.response);
                if (data.length == 0) {
                    document.getElementById('display_feed_div').innerHTML = "<h3>No posts to show. Find more friends in the Followers tab, or wait for someone you follow to post</h3>";
                } else {
                    for (let i = 0; i < data.length; i++) {
                        let date_string = data[i]['StatusDate'].toString();
                        let year_string = date_string.substring(0, 4);
                        let month_string = date_string.substring(4, 6);
                        let day_string = date_string.substring(6, 8);
                        document.getElementById('display_feed_div').innerHTML += "<div id = 'post_template_div' ><p>Username: " + data[i]['Username'] + "</p><p>" + data[i]['StatusText'] + "</p><p>Date: " + data[i]['StatusDate'] + "</p><span onclick='likeStatus(" + data[i]['StatusID'] + ", " + data[i]['likeCount'] + ")'style='color: red; cursor: pointer;'>Like </span><span>" + data[i]['likeCount'] + "</span><br><span onclick='openComments(" + data[i]['StatusID'] + ")' style='color: blue; cursor: pointer;'>Comments</span></div>";
                    }
                }
            }
        };
        xhttp.open("POST", "controller_ff.php");
        xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        var query = "";
        query += "page=MainPage";
        query += "&command=GetPosts";
        xhttp.send(query);
    }

    function get_postsFA() {
        var xhttp = new XMLHttpRequest(); // AJAX code for the SendMessage command. The command will be sent to test_send_message.php.
        xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                //alert(this.response);
                document.getElementById('display_feed_div').innerHTML = "";
                let data = JSON.parse(this.response);
                if (data.length == 0) {
                    document.getElementById('display_feed_div').innerHTML = "<h3>No posts to show. Find more friends in the Followers tab, or wait for someone you follow to post</h3>";
                } else {
                    for (let i = 0; i < data.length; i++) {
                        let date_string = data[i]['StatusDate'].toString();
                        let year_string = date_string.substring(0, 4);
                        let month_string = date_string.substring(4, 6);
                        let day_string = date_string.substring(6, 8);
                        document.getElementById('display_feed_div').innerHTML += "<div id = 'post_template_div' ><p>Username: " + data[i]['Username'] + "</p><p>" + data[i]['StatusText'] + "</p><p>Date: " + data[i]['StatusDate'] + "</p><span onclick='likeStatusFA(" + data[i]['StatusID'] + ", " + data[i]['likeCount'] + ")'style='color: red; cursor: pointer;'>Like </span><span>" + data[i]['likeCount'] + "</span><br><span onclick='openComments(" + data[i]['StatusID'] + ")' style='color: blue; cursor: pointer;'>Comments</span></div>";
                    }
                }
            }
        };
        xhttp.open("POST", "controller_ff.php");
        xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        var query = "";
        query += "page=MainPage";
        query += "&command=TopBarSearch";
        query += "&search_text=" + $("#top_bar_search").val();
        xhttp.send(query);
    }

    function likeStatus(statusID, currentLikes) {
        //alert(statusID);
        var xhttp = new XMLHttpRequest(); // AJAX code for the SendMessage command. The command will be sent to test_send_message.php.
        xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                //alert(this.response);
                get_posts();
            }
        };
        xhttp.open("POST", "controller_ff.php");
        xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        var query = "";
        query += "page=MainPage";
        query += "&command=LikePost";
        query += "&status_id=" + statusID;
        query += "&current_likes=" + currentLikes;
        xhttp.send(query);
    }

    function likeStatusFA(statusID, currentLikes) {
        //alert(statusID);
        var xhttp = new XMLHttpRequest(); // AJAX code for the SendMessage command. The command will be sent to test_send_message.php.
        xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                //alert(this.response);
                get_postsFA();
            }
        };
        xhttp.open("POST", "controller_ff.php");
        xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        var query = "";
        query += "page=MainPage";
        query += "&command=LikePost";
        query += "&status_id=" + statusID;
        query += "&current_likes=" + currentLikes;
        xhttp.send(query);
    }

    function getLiked() {
        //alert(statusID);
        var xhttp = new XMLHttpRequest(); // AJAX code for the SendMessage command. The command will be sent to test_send_message.php.
        xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                let data = JSON.parse(this.response);
                document.getElementById('display_likes_div').innerHTML = "<h3 style='border-bottom: 2px solid black'>Your Liked Posts</h3>";
                if (data.length == 0) {
                    document.getElementById('display_likes_div').innerHTML += "<h5>No Liked Posts</h5>";
                } else {
                    for (let i = 0; i < data.length; i++) {
                        let date_string = data[i]['StatusDate'].toString();
                        let year_string = date_string.substring(0, 4);
                        let month_string = date_string.substring(4, 6);
                        let day_string = date_string.substring(6, 8);
                        document.getElementById('display_likes_div').innerHTML += "<div id = 'post_template_div' ><p>Username: " + data[i]['Username'] + "</p><p>" + data[i]['StatusText'] + "</p><p>Date: " + data[i]['StatusDate'] + "</p><span onclick='likeStatus(" + data[i]['StatusID'] + ", " + data[i]['likeCount'] + ")'style='color: red; cursor: pointer;'>Like </span><span>" + data[i]['likeCount'] + "</span><br><span onclick='openComments(" + data[i]['StatusID'] + ")' style='color: blue; cursor: pointer;'>Comments</span></div>";
                    }
                }
            }
        };
        xhttp.open("POST", "controller_ff.php");
        xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        var query = "";
        query += "page=MainPage";
        query += "&command=GetLiked";
        xhttp.send(query);
    }

    function getCommented() {
        //alert(statusID);
        var xhttp = new XMLHttpRequest(); // AJAX code for the SendMessage command. The command will be sent to test_send_message.php.
        xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                //alert(this.response);
                let data = JSON.parse(this.response);
                document.getElementById('display_comments_div').innerHTML = "<h3 style='border-bottom: 2px solid black'>Your Comments</h3>";
                if (data.length == 0) {
                    document.getElementById('display_comments_div').innerHTML += "<h5>No Comments on  Posts</h5>";
                } else {
                    for (let i = 0; i < data.length; i++) {
                        document.getElementById('display_comments_div').innerHTML += "<div id = 'comment_template_div' ><span>Username: " + data[i]['0'] + "</span><br><span>Status: " + data[i]['1'] + "</span><br><br><span>Your Comment: </span><span>" + data[i]['CommentText'] + "</span></div>";
                    }
                }
            }
        };
        xhttp.open("POST", "controller_ff.php");
        xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        var query = "";
        query += "page=MainPage";
        query += "&command=GetCommented";
        xhttp.send(query);
    }

    function openComments(statusID) {
        //alert(statusID);
        $('#modal_comment').modal('show');
        $('#modal_status_id').html(statusID);
        getComments(statusID);
    }

    function getComments(statusID) {
        var xhttp = new XMLHttpRequest(); // AJAX code for the SendMessage command. The command will be sent to test_send_message.php.
        xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                //alert(this.response);
                let data = JSON.parse(this.response);
                document.getElementById('modal_comment_display').innerHTML = "";
                for (let i = 0; i < data.length; i++) {
                    document.getElementById('modal_comment_display').innerHTML += "<div id = 'comment_template_div' ><span>" + data[i]['Username'] + ": </span><span>" + data[i]['CommentText'] + "</span></div>";
                }
                document.getElementById('input_comment_text').value = '';
            }
        };
        xhttp.open("POST", "controller_ff.php");
        xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        var query = "";
        query += "page=MainPage";
        query += "&command=GetComments";
        query += "&status_id=" + statusID;
        xhttp.send(query);
    }

    $('#comment-button').click(function() {
        var xhttp = new XMLHttpRequest(); // AJAX code for the SendMessage command. The command will be sent to test_send_message.php.
        xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                //alert(this.response);
                getComments(this.response);
            }
        };
        xhttp.open("POST", "controller_ff.php");
        xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        var query = "";
        query += "page=MainPage";
        query += "&command=MakeComment";
        query += "&comment_text=" + $("#input_comment_text").val();
        query += "&status_id=" + document.getElementById('modal_status_id').innerHTML;
        xhttp.send(query);
    });

    $('#create_post_button').click(function() {
        var xhttp = new XMLHttpRequest(); // AJAX code for the SendMessage command. The command will be sent to test_send_message.php.
        xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                get_posts();
                // let data = JSON.parse(this.response);
                // document.getElementById('display_feed_div').innerHTML = "";
                // for (let i = 0; i < data.length; i++) {
                //     let date_string = data[i]['StatusDate'].toString();
                //     console.log(date_string);
                //     let year_string = date_string.substring(0, 4);
                //     let month_string = date_string.substring(4, 6);
                //     let day_string = date_string.substring(6, 8);
                //     document.getElementById('display_feed_div').innerHTML += "<div id = 'post_template_div' ><p>Username: " + data[i]['Username'] + "</p><p>" + data[i]['StatusText'] + "</p><p>Date: " + data[i]['StatusDate'] + "</p><span onclick='likeStatus("+data[i]['StatusID']+", "+data[i]['likeCount']+")'style='color: red; cursor: pointer;'>Like </span><span>"+data[i]['likeCount']+"</span><br><span onclick='openComments("+data[i]['StatusID']+")' style='color: blue; cursor: pointer;'>Comments</span></div>";
                // }
                // document.getElementById('create_post_text').value = '';
            }
        };
        xhttp.open("POST", "controller_ff.php");
        xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        var query = "";
        query += "page=MainPage";
        query += "&command=CreatePost";
        query += "&status_text=" + $("#create_post_text").val();
        xhttp.send(query);
    });

    $('#unsub_span').click(function() {
        var xhttp = new XMLHttpRequest(); // AJAX code for the SendMessage command. The command will be sent to test_send_message.php.
        xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                alert('User account has been deleted');
                document.getElementById('form-logout').submit();
            }
        };
        xhttp.open("POST", "controller_ff.php");
        xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        var query = "";
        query += "page=MainPage";
        query += "&command=Unsubscribe";
        xhttp.send(query);
    });


    document.getElementById('menu_username_label').innerHTML = '<?php echo $user_var ?>';

    document.getElementById('menu_item_logout').addEventListener('click', function() {
        document.getElementById('form-logout').submit();
    });


    $('#menu_item_feed').click(function() {
        hideAll();
        showFeed();
        get_posts();
    })
    $('#menu_item_following').click(function() {
        hideAll();
        showFollowers();
    })
    $('#menu_item_messages').click(function() {
        hideAll();
        showMessages();
        var xhttp = new XMLHttpRequest(); // AJAX code for the SendMessage command. The command will be sent to test_send_message.php.
        xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById('pane-messages-unread').innerHTML = "";
                get_read_messages();
                let data = JSON.parse(this.response);
                if (data.length == 0) {
                    document.getElementById('pane-messages-unread').innerHTML = "<p>No Messages</p>";
                } else {
                    for (let i = 0; i < data.length; i++) {
                        document.getElementById('pane-messages-unread').innerHTML += "<div id = 'message_template_div' ><p>From: " + data[i]['Sender'] + "</p><p>Message: " + data[i]['Message'] + "</p><p>Date: " + data[i]['Date'] + "</p></div>";
                    }
                }
            }
        };
        xhttp.open("POST", "controller_ff.php");
        xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        var query = "";
        query += "page=MainPage";
        query += "&command=ReadMessage";
        query += "&readstate=0";
        xhttp.send(query);
    })
    $('#menu_item_liked').click(function() {
        //alert(this.innerHTML);
        hideAll();
        showLiked();
        getLiked();
    })

    function showLiked() {
        $('#display_likes_div').show();
    }

    function hideLiked() {
        $('#display_likes_div').hide();
    }
    $('#menu_item_comments').click(function() {
        //alert(this.innerHTML);
        hideAll();
        showCommented();
        getCommented();
    })

    function showCommented() {
        $('#display_comments_div').show();
    }

    function hideCommented() {
        $('#display_comments_div').hide();
    }
    $('#menu_item_edit').click(function() {
        hideAll();
        showEdit();
        get_user_profile();
        //alert(this.innerHTML);
    })
    $('#followers_div').click(function() {
        var xhttp = new XMLHttpRequest(); // AJAX code for the SendMessage command. The command will be sent to test_send_message.php.
        xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                let data = JSON.parse(this.response);
                document.getElementById('display_followers_div').innerHTML = "";
                if (data.length == 0) {
                    document.getElementById('display_followers_div').innerHTML += "<h3>You currently have 0 followers. Connect with friends on the 'Find Friends' tab</h3>";
                } else {
                    for (let i = 0; i < data.length; i++) {
                        document.getElementById('display_followers_div').innerHTML += "<div id = 'follower_template_div' ><p>Username: " + data[i]['username'] + "</p></div>";
                    }
                }
            }
        };
        xhttp.open("POST", "controller_ff.php");
        xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        var query = "";
        query += "page=MainPage";
        query += "&command=GetFollowers";
        xhttp.send(query);
    });

    $('#following_div').click(function() {
        var xhttp = new XMLHttpRequest(); // AJAX code for the SendMessage command. The command will be sent to test_send_message.php.
        xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                //alert(this.response);
                let data = JSON.parse(this.response);
                document.getElementById('display_followers_div').innerHTML = "";
                if (data.length == 0) {
                    document.getElementById('display_followers_div').innerHTML = "<h3>You are not currently following any users. Connect with friends in the 'Find Friends' tab</h3>";
                } else {
                    for (let i = 0; i < data.length; i++) {
                        document.getElementById('display_followers_div').innerHTML += "<div id = 'follower_template_div' ><p>Username: " + data[i]['following'] + "</p><button onclick = \"unfollow_user('" + data[i]['following'] + "')\">Unfollow</button></div>";
                    }
                }
            }
        };
        xhttp.open("POST", "controller_ff.php");
        xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        var query = "";
        query += "page=MainPage";
        query += "&command=GetFollowing";
        xhttp.send(query);
    });

    $('#find_users_div').click(function() {
        document.getElementById('display_followers_div').innerHTML = "";
        document.getElementById('display_followers_div').innerHTML += "<div id='find_user_search_div' style=\"display: inline-block;\"><label class='control_label' for='find_user_text'>Find User: </label><input type='text' id='find_user_text' name='username' value='' placeholder='Name or Username'><button onclick = 'find_user_button_click()' id='find_user_button' type='button' class='btn btn-secondary'>Post</button></div>";
    });

    $('#create_message_button').click(function() {
        if ($('#create_message_text').val() == '') {
            alert("Please Enter a Message");
            return;
        }
        var xhttp = new XMLHttpRequest(); // AJAX code for the SendMessage command. The command will be sent to test_send_message.php.
        xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                alert(this.response);
            }
        };
        xhttp.open("POST", "controller_ff.php");
        xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        var query = "";
        query += "page=MainPage";
        query += "&command=SendMessage";
        query += "&receiver=" + $('#create_message_receiver').val();
        query += "&message=" + $('#create_message_text').val();
        xhttp.send(query);
    });

    $('#refresh_messages').click(function() { // When the image is clicked
        var xhttp = new XMLHttpRequest(); // AJAX code for the SendMessage command. The command will be sent to test_send_message.php.
        xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById('pane-messages-unread').innerHTML = "";
                get_read_messages();
                let data = JSON.parse(this.response);
                if (data.length == 0) {
                    document.getElementById('pane-messages-unread').innerHTML = "<p>No Messages</p>";
                } else {
                    for (let i = 0; i < data.length; i++) {
                        document.getElementById('pane-messages-unread').innerHTML += "<div id = 'message_template_div' ><p>From: " + data[i]['Sender'] + "</p><p>Message: " + data[i]['Message'] + "</p><p>Date: " + data[i]['Date'] + "</p></div>";
                    }
                }
            }
        };
        xhttp.open("POST", "controller_ff.php");
        xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        var query = "";
        query += "page=MainPage";
        query += "&command=ReadMessage";
        query += "&readstate=0";
        xhttp.send(query);
    });

    function get_read_messages() {
        var xhttp = new XMLHttpRequest(); // AJAX code for the SendMessage command. The command will be sent to test_send_message.php.
        xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                let data = JSON.parse(this.response);
                document.getElementById('pane-messages-read').innerHTML = "";
                if (data.length == 0) {
                    document.getElementById('pane-messages-read').innerHTML = "<p>No Messages</p>";
                } else {
                    for (let i = 0; i < data.length; i++) {
                        document.getElementById('pane-messages-read').innerHTML += "<div id = 'message_template_div' ><p>From: " + data[i]['Sender'] + "</p><p>Message: " + data[i]['Message'] + "</p><p>Date: " + data[i]['Date'] + "</p></div>";
                    }
                }
            }
        };
        xhttp.open("POST", "controller_ff.php");
        xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        var query = "";
        query += "page=MainPage";
        query += "&command=ReadMessage";
        query += "&readstate=1";
        xhttp.send(query);
    }

    function find_user_button_click() {
        //alert(this.innerHTML);
        var xhttp = new XMLHttpRequest(); // AJAX code for the SendMessage command. The command will be sent to test_send_message.php.
        xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                //alert(this.response);
                let data = JSON.parse(this.response);
                document.getElementById('display_followers_div').innerHTML = "";
                if (data.length == 0) {
                    document.getElementById('display_followers_div').innerHTML = "<h3>No Users found with that information</h3>";
                } else {
                    for (let i = 0; i < data.length; i++) {
                        document.getElementById('display_followers_div').innerHTML += "<div id = 'follower_template_div' ><p>Username: " + data[i]['username'] + "</p><p>First Name: " + data[i]['firstname'] + "</p><p>Last Name: " + data[i]['lastname'] + "</p><button onclick = \"follow_user('" + data[i]['username'] + "', '" + data[i]['0'] + "')\">Follow</button></div>";
                    }
                }
            }
        };
        xhttp.open("POST", "controller_ff.php");
        xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        var query = "";
        query += "page=MainPage";
        query += "&command=GetUsers";
        query += "&username=" + $('#find_user_text').val();
        xhttp.send(query);
    }

    function unfollow_user(following) {
        //alert(username);
        var xhttp = new XMLHttpRequest(); // AJAX code for the SendMessage command. The command will be sent to test_send_message.php.
        xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                //alert(this.response);
                let data = JSON.parse(this.response);
                document.getElementById('display_followers_div').innerHTML = "";
                if (data.length == 0) {
                    document.getElementById('display_followers_div').innerHTML = "<h3>You are not currently following any users. Check the Find Friends tab</h3>";
                } else {
                    for (let i = 0; i < data.length; i++) {
                        document.getElementById('display_followers_div').innerHTML += "<div id = 'follower_template_div' ><p>Username: " + data[i]['following'] + "</p><button onclick = \"unfollow_user('" + data[i]['following'] + "')\">Unfollow</button></div>";
                    }
                }
            }
        };
        xhttp.open("POST", "controller_ff.php");
        xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        var query = "";
        query += "page=MainPage";
        query += "&command=UnfollowUser";
        query += "&following=" + following;
        xhttp.send(query);
    }

    function follow_user(user, user_term) {
        //alert(username);
        var xhttp = new XMLHttpRequest(); // AJAX code for the SendMessage command. The command will be sent to test_send_message.php.
        xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                //alert(this.response);
                let data = JSON.parse(this.response);
                document.getElementById('display_followers_div').innerHTML = "";
                for (let i = 0; i < data.length; i++) {
                    document.getElementById('display_followers_div').innerHTML += "<div id = 'follower_template_div' ><p>Username: " + data[i]['username'] + "</p><p>First Name: " + data[i]['firstname'] + "</p><p>Last Name: " + data[i]['lastname'] + "</p><button onclick = \"follow_user('" + data[i]['username'] + "', '" + data[i]['0'] + "')\">Follow</button></div>";
                }
            }
        };
        xhttp.open("POST", "controller_ff.php");
        xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        var query = "";
        query += "page=MainPage";
        query += "&command=FollowUser";
        query += "&user=" + user;
        query += "&user_term=" + user_term;
        xhttp.send(query);
    }

    function showFeed() {
        document.getElementById('create_post_div').style.display = 'inline-block';
        $('#display_feed_div').show();
    }

    function hideFeed() {
        $('#create_post_div').hide();
        $('#display_feed_div').hide();
    }

    function showEdit() {
        $('#user_profile_div').show();
    }

    function hideEdit() {
        $('#user_profile_div').hide();
    }

    function showFollowers() {
        document.getElementById('select_follower_page_div').style.display = 'inline-block';
        $('#display_followers_div').show();
    }

    function hideFollowers() {
        $('#select_follower_page_div').hide();
        $('#display_followers_div').hide();
    }

    function showMessages() {
        document.getElementById('create_message_div').style.display = 'inline-block';
        $('#display_messages_div').show();
    }

    function hideMessages() {
        $('#create_message_div').hide();
        $('#display_messages_div').hide();
    }

    function hideAll() {
        hideFeed();
        hideEdit();
        hideFollowers();
        hideMessages();
        hideLiked();
        hideCommented();
    }

    function get_user_profile($user) {
        var xhttp = new XMLHttpRequest(); // AJAX code for the SendMessage command. The command will be sent to test_send_message.php.
        xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                // alert(this.response);
                let data = JSON.parse(this.response);
                document.getElementById('user_top_username').innerHTML = data[0]['username'];
                document.getElementById('user_top_name').innerHTML = data[0]['firstname'] + " " + data[0]['lastname'];
                document.getElementById('user_top_bio').innerHTML = "Bio: " + data[0]['bio'];
            }
        };

        xhttp.open("POST", "controller_ff.php");
        xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        var query = "";
        query += "page=MainPage";
        query += "&command=GetUser";
        query += "&username=" + $user;
        xhttp.send(query);
    }

    $('#edit_username_button').click(function() {
        if ($("#edit_username").val() == "") {
            alert("Please enter your username");
            return;
        }
        //alert();
        var xhttp = new XMLHttpRequest(); // AJAX code for the SendMessage command. The command will be sent to test_send_message.php.
        xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                //alert(this.response);
                if (this.response == false) {
                    alert("Username Already Exists");
                } else {
                    document.getElementById('form-logout').submit();
                    alert("ATTENTION: Please Log In with new Username");
                }

            }
        };
        xhttp.open("POST", "controller_ff.php");
        xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        var query = "";
        query += "page=MainPage";
        query += "&command=EditUsername";
        query += "&new_username=" + $("#edit_username").val();
        xhttp.send(query);
    });
    $('#edit_firstname_button').click(function() {
        if ($("#edit_firstname").val() == "") {
            alert("Please enter your first name");
            return;
        }
        var xhttp = new XMLHttpRequest(); // AJAX code for the SendMessage command. The command will be sent to test_send_message.php.
        xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                alert("Firstname Updated Successfully");
                document.getElementById('edit_firstname').value = '';
                get_user_profile((JSON.parse(this.response)[0]['username']));
            }
        };
        xhttp.open("POST", "controller_ff.php");
        xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        var query = "";
        query += "page=MainPage";
        query += "&command=EditFirstname";
        query += "&new_fname=" + $("#edit_firstname").val();
        xhttp.send(query);
    });
    $('#edit_lastname_button').click(function() {
        if ($("#edit_lastname").val() == "") {
            alert("Please enter your last name");
            return;
        }
        var xhttp = new XMLHttpRequest(); // AJAX code for the SendMessage command. The command will be sent to test_send_message.php.
        xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                alert("Lastname Updated Successfully");
                document.getElementById('edit_lastname').value = '';
                get_user_profile((JSON.parse(this.response)[0]['username']));
            }
        };
        xhttp.open("POST", "controller_ff.php");
        xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        var query = "";
        query += "page=MainPage";
        query += "&command=EditLastname";
        query += "&new_lname=" + $("#edit_lastname").val();
        xhttp.send(query);
    });
    $('#edit_bio_button').click(function() {
        if ($("#edit_bio").val() == "") {
            alert("Please enter your bio");
            return;
        }
        var xhttp = new XMLHttpRequest(); // AJAX code for the SendMessage command. The command will be sent to test_send_message.php.
        xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                alert("Bio Updated Successfully");
                document.getElementById('edit_bio').value = '';
                get_user_profile((JSON.parse(this.response)[0]['username']));
            }
        };
        xhttp.open("POST", "controller_ff.php");
        xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        var query = "";
        query += "page=MainPage";
        query += "&command=EditBio";
        query += "&new_bio=" + $("#edit_bio").val();
        xhttp.send(query);
    });
    $('#edit_email_button').click(function() {
        if ($("#edit_email").val() == "") {
            alert("Please enter your email");
            return;
        }
        if (!isEmail($("#edit_email").val())) {
            alert("Invalid Email Format");
            return;
        }
        var xhttp = new XMLHttpRequest(); // AJAX code for the SendMessage command. The command will be sent to test_send_message.php.
        xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                //alert(this.response);
                if (this.response == "false") {
                    alert("Email Already In Use");
                } else {
                    alert("Email Updated Successfully");
                    document.getElementById('edit_email').value = '';
                    get_user_profile((JSON.parse(this.response)[0]['username']));
                }
            }
        };
        xhttp.open("POST", "controller_ff.php");
        xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        var query = "";
        query += "page=MainPage";
        query += "&command=EditEmail";
        query += "&new_email=" + $("#edit_email").val();
        xhttp.send(query);
    });

    function isEmail(email) {
        var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
        return regex.test(email);
    }
    $('#edit_password_button').click(function() {
        if ($("#edit_password").val() == "") {
            alert("Please enter your password");
            return;
        }
        var xhttp = new XMLHttpRequest(); // AJAX code for the SendMessage command. The command will be sent to test_send_message.php.
        xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                alert("Password Updated Successfully");
                document.getElementById('edit_password').value = '';
                get_user_profile((JSON.parse(this.response)[0]['username']));
            }
        };
        xhttp.open("POST", "controller_ff.php");
        xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        var query = "";
        query += "page=MainPage";
        query += "&command=EditPassword";
        query += "&new_password=" + $("#edit_password").val();
        xhttp.send(query);
    });
</script>