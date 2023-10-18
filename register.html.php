<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="style.css">

    <title>KTW: Login</title>

</head>

<body>

    <h1>Kaden's Test Webapp</h1>
    <h2>Register</h2>
    <p>Already have an account? <a href="login.html.php">Click here</a> to login.</p>

    <form action="register.php" method="post">

        <div class="form-group">

            <label>Email</label><br>
            <input type="text" name="email" value="<?php if(isset($email)) echo $email;?>">
            <?php 

            if(isset($email_error) && !empty($email_error)) {
                echo "<p class=\"input-error\">" . $email_error . "</p>";
            }

            ?>

        </div>

        <div class="form-group">

            <label>Username</label><br>
            <input type="text" name="username" value="<?php if(isset($username)) echo $username;?>">
            <?php 

            if(isset($username_error) && !empty($username_error)) {
                echo "<p class=\"input-error\">" . $username_error . "</p>";
            }

            ?>

        </div>

        <div class="form-group">

            <label>Password</label><br>
            <input type="password" name="password" value="<?php if(isset($password)) echo $password;?>">
            <?php 

            if(isset($password_error) && !empty($password_error)) {
                echo "<p class=\"input-error\">" . $password_error . "</p>";
            }

            ?>

        </div>

        <div class="form-group">

            <label>Confirm Password</label><br>
            <input type="password" name="confirm_password" value="<?php if(isset($confirm_password)) echo $confirm_password;?>">
            <?php 

            if(isset($confirm_password_error) && !empty($confirm_password_error)) {
                echo "<p class=\"input-error\">" . $confirm_password_error . "</p>";
            }

            ?>

        </div>

        <input type="submit" name="submit-button" value="submit">

    </form>

</body>

</html>