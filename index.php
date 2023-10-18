<?php 

if(isset($_SESSION["loggedin"]) && $_SESSION['loggedin'] === true) {
    header("location: home.html.php");
    exit;
}

header("location: login.html.php");
exit;

?>