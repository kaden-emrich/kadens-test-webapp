<?php

session_start();
if(!isset($_SESSION["loggedin"]) || $_SESSION['loggedin'] !== true) {
    header("location: login.html.php");
    exit;
}

?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Kaden's Test Webapp</title>

</head>

<body>

    <h1>Kaden's Test Webapp</h1>
    <h2><?php echo "Welcome " . $_SESSION['username'] . "!"; ?></h2>

    <a href="logout.php"><button>logout</button></a>

    <a href="the-button"><p>Click a button</p></a>
    
</body>

</html>