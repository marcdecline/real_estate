<?php
// /app/controllers/UserController.php

require_once('../models/User.php');

class UserController {
    public function register($email, $password, $role) {
        // Encriptamos la contraseña antes de guardarla en la base de datos
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        // Creamos un nuevo usuario
        User::create($email, $hashedPassword, $role);

        // Podríamos hacer más cosas aquí, como enviar un correo electrónico de confirmación, iniciar la sesión automáticamente, etc.
    }

    public function login($email, $password) {
        // Buscamos al usuario por su correo electrónico
        $user = User::getByEmail($email);

        // Verificamos si el usuario existe y la contraseña es correcta
        if ($user && password_verify($password, $user->password)) {
            // Iniciamos la sesión y guardamos el ID del usuario en la variable de sesión
            session_start();
            $_SESSION['userId'] = $user->id;
            return true;
        } else {
            return false;
        }
    }
}
