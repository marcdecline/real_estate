<?php
// /public/register.php

require_once('../app/controllers/AuthController.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    AuthController::register($_POST['username'], $_POST['password'], $_POST['email'], 'user');
}

?>
<html>
    <body>
        <form action="register.php" method="post">
            <label for="username">Username:</label><br>
            <input type="text" id="username" name="username"><br>
            <label for="password">Password:</label><br>
            <input type="password" id="password" name="password"><br>
            <label for="email">Email:</label><br>
            <input type="email" id="email" name="email"><br>
            <input type="submit" value="Register">
        </form>
    </body>
</html>
