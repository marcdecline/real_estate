<?php
// /public/properties.php

require_once('../app/controllers/PropertyController.php');

$properties = PropertyController::getAll();

?>
<html>
    <body>
        <h1>Properties</h1>
        <?php foreach ($properties as $property): ?>
        <div>
            <h2><?= $property->type ?></h2>
            <p><?= $property->squareMeters ?> m²</p>
            <p><?= $property->numBathrooms ?> bathrooms</p>
            <p><?= $property->numRooms ?> rooms</p>
            <!-- Rest of the property details go here -->
        </div>
        <a href="delete_property.php?id=<?= $property->id ?>">Delete Property</a>

        <?php if ($property->isFavoritedBy($currentUser)): ?>
            <a href="remove_favorite.php?property_id=<?= $property->id ?>"><?= _("Remove from Favorites") ?></a>
        <?php else: ?>
            <a href="add_favorite.php?property_id=<?= $property->id ?>"><?= _("Add to Favorites") ?></a>
        <?php endif; ?>
        <?php endforeach; ?>
    </body>
</html>
