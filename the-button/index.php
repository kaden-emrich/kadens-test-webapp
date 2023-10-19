<?php

session_start();
if(!isset($_SESSION["loggedin"]) || $_SESSION['loggedin'] !== true || !isset($_SESSION['user_id'])) {
    header("location: login.html.php");
    exit;
}

global $numClicks;

$numClicks = 0;

require_once '../sql-config.php';

$sql = "SELECT the_button_num_clicks FROM kadens_test_webapp_users WHERE user_id = ?";
if($stmt = mysqli_prepare($db_link, $sql)) {

    mysqli_stmt_bind_param($stmt,"i", $param_user_id);
    $param_user_id = $_SESSION['user_id'];

    if(mysqli_stmt_execute($stmt)) {
        mysqli_stmt_store_result($stmt);

        if(mysqli_stmt_num_rows($stmt) == 1) {
            mysqli_stmt_bind_result($stmt, $stored_clicks);

            if(mysqli_stmt_fetch($stmt)) { 
                $numClicks = $stored_clicks;
            }
        }
        else {
        }
    }

    mysqli_stmt_close($stmt);
}

mysqli_close($db_link);

?>

<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>The Button</title>
        
</head>
<body>
    <h1>The Button</h1>
    <h2><?php 
        echo "Logged in as " . $_SESSION['username'];
    ?></h2>
    <a href="../home.html.php"><p>home</p></a>

    <div class="game-div">
        <button onclick="buttonClick()">click</button>
        <p>You have clicked the button <span id="click-count-display">0</span> times</p>
    </div>

    <form action="save-game.php" method="get">
        <button id="save-button" name="num-clicks" value="<?php echo $numClicks; ?>">save game</button>
    </form>


    <script type="text/javascript">

    var numClicks = <?php 
    global $numClicks;
    echo $numClicks;
    ?>;

    var clicksDisplay = document.getElementById("click-count-display");
    var saveButton = document.getElementById("save-button");

    function updateClickDisplay() {
        clicksDisplay.innerText = numClicks;
    }

    function updateSaveButton() {
        saveButton.setAttribute("value", numClicks);
    }

    function buttonClick() {
        numClicks++;
        updateClickDisplay();
        updateSaveButton();
    }

    updateClickDisplay();
    updateSaveButton();

    </script>
</body>

</html>