<?php
// /public/delete_property.php

require_once('../app/controllers/PropertyController.php');

PropertyController::delete($_GET['id']);
header('Location: /properties.php');
exit();
