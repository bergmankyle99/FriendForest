<?php
$display_modal_window = '';
if (empty($_POST['page'])) {  // When no page is sent from the client; The initial display
    // You may use if (!isset($_POST['page'])) instead of empty(...).
    //$display_modal_window = 'no-modal';  // This variable will be used in 'view_startpage.php'.
    // It will display the start page without any box, i.e., no LogIn box, no Join box, ...
    $error_msg_username = '';
    $error_msg_password = ''; // Set an error message into a variable.
    $edited_username = '';
    $signup_error_alert = '';
    $login_error_alert = '';
    include('view_startpage_ff.php');
    exit();
}
$sess_user = '';
$search_data = [];
$message_data = [];
$getuser_data = [];
require('model_ff.php');  // This file includes some routines to use DB.

// When commands come from StartPage
if ($_POST['page'] == 'StartPage') {
    $command = $_POST['command'];
    switch ($command) {  // When a command is sent from the client
        case 'LogIn':  // With username and password
            if (!user_is_valid($_POST['username'], $_POST['password'])) {
                $display_modal_window = 'login';  // It will display the start page with the LogIn box.
                // This variable will be used in 'view_startpage.php'.
                $error_msg_username = '* Wrong username, or';
                $error_msg_password = '* Wrong password'; // Set an error message into a variable.
                
                $login_error_alert = 'Log In Error: Please Try Again';
                // This variable will used in the form in 'view_startpage.php'.
                include('view_startpage_ff.php');
            } else {
                session_start();  // session start
                $_SESSION[$sess_user] = $_POST['username'];
                include('view_mainpage_ff.php');
            }
            exit();
            break;

        case 'SignUp':  // With username, password, email, some other information
            if (!user_exists_UE($_POST['username'], $_POST['email'])) {
                $display_modal_window = 'login';
                signup_new_user($_POST['username'], $_POST['firstname'], $_POST['lastname'],  $_POST['email'], $_POST['password']);
                $login_error_alert = 'Sign Up Successful: Please Log In with your Account';
                follow_user($_POST['username'], $_POST['username'], "");
                include('view_startpage_ff.php');
            } else {
                $display_modal_window = 'signup';
                $sign_up_error_msg_username = '* Username or Email already exist!';
                $signup_error_alert = 'Sign Up Error: Please Try Again';
                include('view_startpage_ff.php');
            }
            exit();
            break;

        default:
            echo "Unknown command from StartPage<br>";
            exit();
            break;
    }
}

// When commands come from 'MainPage'
else if ($_POST['page'] == 'MainPage') {
    session_start();
    $command = $_POST['command'];
    switch ($command) {  // When a command is sent from the client
        case 'LogOut':
            session_unset();
            session_destroy();
            $display_modal_window = 'none';
            include('view_startpage_ff.php');
            exit();
            break;
        case 'SearchFriends':
            $search_data = search_friends($_POST['term']);
            include('view_mainpage_ff.php');
            exit();
            break;
        case 'SendMessage':
            echo save_message($_SESSION[$sess_user], $_POST['receiver'], $_POST['message']);
            break;
        case 'ReadMessage':
            $read_messages = read_message($_SESSION[$sess_user], $_POST['readstate']);
            echo json_encode($read_messages);
            break;
        case 'CreatePost':
            create_post($_SESSION[$sess_user], $_POST['status_text']);
            $retrieved_posts = get_posts($_SESSION[$sess_user]);
            echo json_encode($retrieved_posts);
            break;
        case 'GetPosts':
            $retrieved_posts = get_posts($_SESSION[$sess_user]);
            echo json_encode($retrieved_posts);
            break;
        case 'LikePost':
            echo like_post($_SESSION[$sess_user], $_POST['status_id'], $_POST['current_likes']);
            break;
        case 'GetComments':
            echo json_encode(get_comments($_POST['status_id']));
            break;
        case 'MakeComment':
            make_comment($_POST['status_id'], $_SESSION[$sess_user], $_POST['comment_text']);
            echo $_POST['status_id'];
            break;
        case 'GetCommented':
            echo json_encode(get_commented($_SESSION[$sess_user]));
            break;
        case 'GetLiked':
            echo json_encode(get_liked($_SESSION[$sess_user]));
            break;
        case 'GetUser':
            echo json_encode(get_user_profile($_SESSION[$sess_user]));
            break;
        case 'TopBarSearch':
            echo json_encode(search_posts($_POST['search_text']));
            break;
        case 'EditUsername':
            echo edit_username($_SESSION[$sess_user], $_POST['new_username']);
            break;
        case 'EditFirstname':
            echo  json_encode(edit_firstname($_SESSION[$sess_user], $_POST['new_fname']));
            break;
        case 'EditLastname':
            echo json_encode(edit_lastname($_SESSION[$sess_user], $_POST['new_lname']));
            break;
        case 'EditBio':
            echo json_encode(edit_bio($_SESSION[$sess_user], $_POST['new_bio']));
            break;
        case 'EditEmail':
            echo json_encode(edit_email($_SESSION[$sess_user], $_POST['new_email']));
            break;
        case 'EditPassword':
            echo json_encode(edit_password($_SESSION[$sess_user], $_POST['new_password']));
            break;
        case 'GetFollowers':
            echo json_encode(get_followers($_SESSION[$sess_user]));
            break;
        case 'GetFollowing':
            echo json_encode(get_following($_SESSION[$sess_user]));
            break;
        case 'GetUsers':
            echo json_encode(find_users($_SESSION[$sess_user], $_POST['username']));
            break;
        case 'UnfollowUser':
            echo json_encode(unfollow_user($_SESSION[$sess_user], $_POST['following']));
            break;
        case 'FollowUser':
            echo json_encode(follow_user($_SESSION[$sess_user], $_POST['user'], $_POST['user_term']));
            break;
        case 'Unsubscribe':
            unsubscribe_user($_SESSION[$sess_user]);
            break;
        default:
            echo "Unknown command from MainPage<br>";
            exit();
            break;
    }
}
// Wrong
else {
    echo 'Wrong page<br>';
}
