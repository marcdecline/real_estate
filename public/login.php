<?php
// /public/login.php

require_once('../app/controllers/AuthController.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $loginSuccessful = AuthController::login($_POST['username'], $_POST['password']);
    if ($loginSuccessful) {
        header('Location: /');
        exit();
    }
}

?>
<html>
    <body>
        <form action="login.php" method="post">
            <label for="username">Username:</label><br>
            <input type="text" id="username" name="username"><br>
            <label for="password">Password:</label><br>
            <input type="password" id="password" name="password"><br>
            <input type="submit" value="Log in">
        </form>
    </body>
</html>
