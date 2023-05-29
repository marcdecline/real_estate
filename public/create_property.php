<?php
// /public/create_property.php

require_once('../app/controllers/PropertyController.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    PropertyController::create(
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
        <form action="create_property.php" method="post">
            <!-- Form fields for property details go here -->
            <input type="submit" value="Create Property">
        </form>
    </body>
</html>
