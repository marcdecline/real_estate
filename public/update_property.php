<?php
// /public/update_property.php

require_once('../app/controllers/PropertyController.php');

$property = Property::get($_GET['id']);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    PropertyController::update(
        $property->id,
        $_POST['type'],
        $_POST['square_meters'],
        $_POST['num_bathrooms'],
        $_POST['num_rooms'],
        $_POST['kitchen_type'],
        $_POST['energy_rating'],
        $_POST['has_balcony'],
        $_POST['has_garden'],
        $_POST['has_garage'],
        $_POST['location'],
        $_POST['state'],
        $_POST['is_chalet'],
        $_POST['floors'],
        $_POST['manager_id']
    );
    header('Location: /properties.php');
    exit();
}

?>
<html>
    <body>
        <form action="update_property.php?id=<?= $property->id ?>" method="post">
            <!-- Form fields for property details go here, pre-filled with current property data -->
            <input type="submit" value="Update Property">
        </form>
    </body>
</html>
