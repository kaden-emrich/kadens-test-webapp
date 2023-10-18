<?php

if(!isset($_POST['username']) && !isset($_POST['email']) && !isset($_POST['password']) && !isset($_POST['confirm_password'])) {
    require 'register.html.php';
    exit;
}

//echo 'test'; // for debugging
require_once 'sql-config.php'; // <-- the problem child
//echo '2test2'; // for debugging

$max_email_length = 254;
$max_username_length = 150;
$min_password_length = 6;
$max_password_length = 254;

$username_error = $password_error = $confirm_password_error = $email_error = "";
$username = $password = $confirm_password = $email = "";

// vaidate email / check if email is in use
if(empty(trim($_POST['email']))) {
    $email_error = "Email can not be empty";
}
else if(strlen(trim($_POST['email'])) > $max_email_length) {
    $email_error = "Email can not me longer than " . $max_email_length . " characters";
}
else if (!filter_var(trim($_POST['email']), FILTER_VALIDATE_EMAIL)) { // confirms email is in a valid format
    $email_error = "Invalid email format";
}
else {
    $sql = "SELECT email FROM kadens_test_webapp_users WHERE email = ?";

    if($stmt = mysqli_prepare($db_link, $sql)) {
        mysqli_stmt_bind_param($stmt, "s", $param_email);
        $param_email = strtolower(trim($_POST["email"]));

        if(mysqli_stmt_execute($stmt)) {
            mysqli_stmt_store_result($stmt);
            
            if(mysqli_stmt_num_rows($stmt) > 0) {
                $email_error = "There is already an acount with that email.";
            }
            else {
                $email = strtolower(trim($_POST["email"]));
            }
        }
        else {
            echo "Something went wrong. Please try again later.";
        }

        mysqli_stmt_close($stmt);
    }
}

// validate username / check if username is taken
if(empty(trim($_POST['username']))) {
    $username_error = "Username can not be empty";
}
else if(strlen(trim($_POST["username"])) > $max_username_length) {
    $username_error = "Username can not be longer than " . $max_username_length . " characters";
}
else {
    $sql = "SELECT user_id FROM kadens_test_webapp_users WHERE username = ?";

    if($stmt = mysqli_prepare($db_link, $sql)) {
        mysqli_stmt_bind_param($stmt, "s", $param_username);
        $param_username = trim($_POST["username"]);

        if(mysqli_stmt_execute($stmt)) {
            mysqli_stmt_store_result($stmt);

            if(mysqli_stmt_num_rows($stmt) > 0) {
                $username_error = "Username is taken";
            }
            else {
                $username = trim($_POST['username']);
            }
        }
        else {
            echo "Something went wrong. Please try again later.";
        }

        mysqli_stmt_close($stmt);
    }
}

// validate password
if(empty(trim($_POST['password']))) {
    $password_error = "Password can not be empty";
}
else if(strlen(trim($_POST["password"])) < $min_password_length) {
    $password_error = "Password must be longer than " . $min_password_length . " characters";
}
else if(strlen(trim($_POST['passowrd'] > $max_password_length))) {
    $password_error = "Password can not be longer than " . $max_password_length . " characters.";
}
else {
    $password = trim($_POST["password"]);
}

// validate confirm password
if(empty($_POST['confirm_password'])) {
    $confirm_password_error = "Confirm password can not be empty";
}
else {
    $confirm_password = trim($_POST['confirm_password']);

    if(empty($password_error) && ($password != $confirm_password)) {
        $confirm_password_error = "Passwords do not match";
    }
}

// return to register screen if there are any errors
if(!empty($username_error) || !empty($email_error) || !empty($password_error) || !empty($confirm_password_error)) {
    mysqli_close($db_link);
    require 'register.html.php';
    exit;
}

// create account record
$sql = "INSERT INTO kadens_test_webapp_users (username, password) VALUES (?, ?)";

if($stmt = mysqli_prepare($db_link, $sql)) {
    mysqli_stmt_bind_param($stmt, "ss", $param_username, $param_password);
    $param_username = $username;
    $param_password = password_hash($password, PASSWORD_DEFAULT); // hashes password so they aren't stored in plain text. Cryptography you so cool.

    if(mysqli_stmt_execute($stmt)) {
        // new user created successfully
        header('location: login.html.php');
    }
    else {
        echo "Something went wrong. Please try again later";
    }

    mysqli_stmt_close($stmt);
}

mysqli_close($db_link);

?>