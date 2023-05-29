<?php
// /app/controllers/AuthController.php

require_once('../models/User.php');

class AuthController {
    public static function register($username, $password, $email, $role) {
        User::create($username, $password, $email, $role);
    }

    public static function login($username, $password) {
        $users = User::getAll();
        foreach ($users as $user) {
            if ($user->username == $username && password_verify($password, $user->password)) {
                $_SESSION['user_id'] = $user->id;
                return true;
            }
        }
        return false;
    }

    public static function logout() {
        unset($_SESSION['user_id']);
    }
}
