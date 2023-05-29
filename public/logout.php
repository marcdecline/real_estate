<?php
// /public/logout.php

require_once('../app/controllers/AuthController.php');

AuthController::logout();
header('Location: /');
exit();
