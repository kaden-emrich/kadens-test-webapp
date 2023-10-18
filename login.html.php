<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>KTW: Login</title>

</head>

<body>

    <h1>Kaden's Test Webapp</h1>
    <h2>Login</h2>
    <p>Don't have an account? <a href="register.html.php">Click here</a> to create one.</p>

    <form action="login.php" method="post">

        <div class="form-group">

            <input type="text" name="username">
            <?php 

            if(isset($username_error) && !empty($username_error)) {
                echo "<p class=\"input-error\">" . $username_error , "</p>";
            }

            ?>

        </div>

        <div class="form-group">

            <label>Password</label><br>
            <input type="password" name="password">
            <?php 

            if(isset($password_error) && !empty($password_error)) {
                echo "<p class=\"input-error\">" . $password_error . "</p>";
            }

            ?>


        </div>

        <input type="submit" name="submit-button" value="submit">
        <?php 

            if(isset($login_error) && !empty($login_error)) {
                echo "<p class=\"input-error\">" . $login_error . "</p>";
            }

        ?>

    </form>
    
</body>

</html>