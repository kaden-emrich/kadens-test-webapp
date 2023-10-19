<?php

session_start();
if(!isset($_SESSION["loggedin"]) || $_SESSION['loggedin'] !== true || !isset($_SESSION['user_id'])) {
    header("location: login.html.php");
    exit;
}

if(!isset($_GET['num-clicks'])) {
    header("location: index.php");
    exit;
}

require_once "../sql-config.php";

$sql = "UPDATE `kadens_test_webapp_users` SET `the_button_num_clicks` = ? WHERE `user_id` = ?";
if($stmt = mysqli_prepare($db_link, $sql)) {

    mysqli_stmt_bind_param($stmt, "ii", $param_numClicks, $param_user_id);
    $param_numClicks = trim($_GET['num-clicks']);
    $param_user_id = $_SESSION['user_id'];

    if(mysqli_stmt_execute($stmt)) {

        mysqli_stmt_close($stmt);
        mysqli_close($db_link);
        
        header("location: index.php");
        exit();
    }
    else {
        echo "Something went wrong. Try again later.";
    }
    
    mysqli_stmt_close($stmt);
}

mysqli_close($db_link);

?>