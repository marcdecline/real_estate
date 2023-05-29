<?php
// /public/admin/dashboard.php

require_once('../app/config.php');
require_once('../app/models/User.php');
require_once('../app/models/Property.php');

// Check if the user is logged in and is an admin or manager
if (!isset($_SESSION['user']) || !in_array($_SESSION['user']->role, ['admin', 'manager'])) {
    header('Location: /login.php');
    exit();
}

$userCount = User::count();
$propertyCount = Property::count();
?>
<!DOCTYPE html>
<html>
<head>
    <title>Dashboard</title>
</head>
<body>
    <h1>Dashboard</h1>
    <p>Total users: <?= $userCount ?></p>
    <p>Total properties: <?= $propertyCount ?></p>
    <a href="properties.php">Manage Properties</a>
    <a href="users.php">Manage Users</a>
</body>
</html>
