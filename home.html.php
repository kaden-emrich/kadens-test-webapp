<?php

session_start();
if(isset($_SESSION["loggedin"]) && $_SESSION['loggedin'] !== true) {
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

    <p><?php echo "Hello world! Part 2"; ?></p>
    
</body>

</html>