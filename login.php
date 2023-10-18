<?php

// see if user is already logged in
session_start();
if(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
    header("location: home.html.ptp");
    exit;
}

// check if user info was entered and return to login if not
if(!isset($_POST['username']) && !isset($_POST['password'])) {
    require 'login.html.php';
    exit;
}

$username = $password = "";
$username_error = $password_error = $login_error = "";

// ensure information is not empty
if(empty(trim($_POST["username"]))) {
    $username_error = "Username can not be empty";
}
else {
    $username = trim($_POST["username"]);
}

if(empty(trim($_POST['password']))) {
    $password_error = "Password can not be empty";
}
else {
    $password = trim($_POST["password"]);
}

// return to login screen if information is empty
if(!empty($username_error) || !empty($password_error)) {
    require 'login.html.php';
    exit;
}

// the database stuff
require_once 'sql-config.php';

$sql = "SELECT user_id, username, password FROM kadens_test_webapp_users WHERE username = ?";
if($stmt = mysqli_prepare($db_link, $sql)) {
    mysqli_stmt_bind_param($stmt, "s", $param_username);
    $param_username = $username;

    if(mysqli_stmt_execute($stmt)) {
        mysqli_stmt_store_result($stmt);

        if(mysqli_stmt_num_rows($stmt) == 1) {
            mysqli_stmt_bind_result($stmt, $user_id, $username, $hashed_password);

            if(mysqli_stmt_fetch($stmt)) {
                // varify password with password hash
                if(password_verify($password, $hashed_password)) {
                    session_start();

                    $_SESSION['loggedin'] = true;
                    $_SESSION['user_id'] = $user_id;
                    $_SESSION['username'] = $username;

                    header('location: home.html.php');
                }
                else {
                    $login_error = "Invalid username or password";
                }
            }
        }
        else {
            $login_error = "Invalid username or password";
        }
    }
    else {
        echo "Something went wrong. Please try again later.";
    }

    mysqli_stmt_close($stmt);
}

mysqli_close($db_link);

if(!empty($login_error)) {
    require 'login.html.php';
}

?>