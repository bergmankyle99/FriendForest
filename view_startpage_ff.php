<!DOCTYPE html>

<html>
<meta name="viewport" content="width=device-width, initial-scale=1">
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

<head>
    <title>FriendForest - Login</title>
    <style>
        body,
        html {
            height: 100%;
            font-family: Arial, sans-serif;
        }

        .FriendForestStartImg {
            background-image: url("FriendForestStart.jpg");
            height: 100%;
            background-position: center;
            background-repeat: no-repeat;
            background-size: cover;
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


        #menu-login {
            position: relative;
            width: 20%;
            height: 40px;
            margin: auto;
            top: calc(60vh - 40px);
            left: calc(50vw - 10%);
        }

        #menu-signup {
            position: relative;
            width: 20%;
            height: 40px;
            margin: auto;
            top: calc(60vh - 40px);
            left: calc(50vw - 10%);
        }

        #modal-signup {
            top: calc(50vh - 125px);
        }

        #modal-login {
            top: calc(50vh - 125px);
        }

        #FriendForestStartTitle {
            position: relative;
            width: fit-content;
            height: auto;
            margin: auto;
            top: calc(25vh - 125px);
            font-size: 10em;
            color: rgb(12, 79, 237);
        }

        #EditedUsername {
            position: relative;
            width: fit-content;
            height: auto;
            margin: auto;
            top: calc(25vh - 125px);
            font-size: 2em;
            color: rgb(12, 79, 237);
        }
    </style>
</head>

<body style='margin:0'>
    <div class="FriendForestStartImg">
        <h1 id='FriendForestStartTitle'>FriendForest</h1>
        <button type="button" class="btn btn-primary" id='menu-login'>Login</button>
        <br>
        <br>
        <button type="button" class="btn btn-primary" id='menu-signup'>Sign Up</button>
    </div>
    <div class='modal fade' id='modal-login'>
        <div class='modal-dialog'>
            <div class='modal-content'>
                <form method='post' action='controller_ff.php'>
                    <div class='modal-title'>
                        <h2 class='modal-title'>Login</h2>
                    </div>
                    <div class='modal-body'>
                        <div class="input-group">
                            <input type="hidden" name='page' value='StartPage'>
                            <input type="hidden" name='command' value='LogIn'>
                            <div class='grid'>
                                <div class="row">
                                    <label class='control_label' for='input-login-username'>Username:</label>
                                    <input class="form-control" id='input-login-username' type='text' name='username' required>
                                    <?php if (!empty($error_msg_username)) echo $error_msg_username; ?>
                                </div>
                                <row>
                                    <label class='control_label' for='input-login-password'>Password:</label>
                                    <input class="form-control" id='input-login-password' type='password' name='password'>
                                    <?php if (!empty($error_msg_password)) echo $error_msg_password; ?>
                                </row>
                            </div>
                        </div>
                    </div>
                    <div class='modal-footer'>
                        <div class="input-group">
                            <button id="cancel-modal-login" type="button" class="btn btn-outline-danger" data-bs-dismiss="modal" required>Cancel</button>
                            <button id='send-login-button' type="submit" class="btn btn-outline-primary">Log In</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class='modal fade' id='modal-signup'>
        <div class='modal-dialog'>
            <div class='modal-content'>
                <form method='post' action='controller_ff.php' id='start_signup'>
                    <div class='modal-title'>
                        <h2 class='modal-title'>Sign Up</h2>
                    </div>
                    <div class='modal-body'>
                        <div class="input-group">
                            <input type="hidden" name='page' value='StartPage'>
                            <input type="hidden" name='command' value='SignUp'>
                            <div class='grid'>
                                <div class='row'>
                                    <label class='control_label' for='input-signup-username'>Username:</label>
                                    <input class="form-control" id='input-signup-username' type='text' name='username' required>
                                </div>
                                <div class='row'>
                                    <label class='control_label' for='input-signup-fname'>First Name:</label>
                                    <input class="form-control" id='input-signup-fname' type='text' name='firstname' required>
                                </div>
                                <div class='row'>
                                    <label class='control_label' for='input-signup-lname'>Last Name:</label>
                                    <input class="form-control" id='input-signup-lname' type='text' name='lastname' required>
                                </div>
                                <div class='row'>
                                    <label class='control_label' for='input-signup-email'>Email:</label>
                                    <input class="form-control" id='input-signup-email' type='email' name='email' required></br>
                                </div>
                                <div class='row'>
                                    <label class='control_label' for='input-signup-password'>Password:</label>
                                    <input class="form-control" id='input-signup-password' type='password' name='password' required>
                                    <br><?php if (!empty($sign_up_error_msg_username)) echo $sign_up_error_msg_username; ?>
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class='modal-footer'>
                        <div class="input-group">
                            <button id="cancel-modal-signup" type="button" class="btn btn-outline-danger" data-bs-dismiss="modal">Cancel</button>
                            <button id='send-signup-button' type="submit" class="btn btn-outline-primary">Sign Up</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>

</html>

<script>
    $('#menu-login').click(function() {
        $('#modal-login').modal('show');
    });
    $('#cancel-modal-login').click(function() {
        $('#modal-login').modal('hide');
    });
    $('#menu-signup').click(function() {
        $('#modal-signup').modal('show');
    });
    $('#cancel-modal-signup').click(function() {
        $('#modal-signup').modal('hide');
    });


    function show_new_username_prompt() {
        $('#EditedUsername').show();
    }

    function display_login_modal(message) {
        // document.getElementById("modal-login").style.display = "block";
        alert(message);
    }

    function display_signup_modal(message) {
        // document.getElementById("modal-signup").style.display = "block";
        alert(message);
    }

    <?php

    if ($display_modal_window == 'login')
        if ($login_error_alert != "") {
            echo "display_login_modal(\"" . $login_error_alert . "\");";
        }
    if ($display_modal_window == 'signup')
        if ($signup_error_alert != "") {
            echo "display_signup_modal(\"" . $signup_error_alert . "\");";
        } else;


    ?>
</script>