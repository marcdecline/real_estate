<?php
// /app/controllers/PropertyController.php

require_once('../models/Property.php');

class PropertyController {
    public static function create($type, $squareMeters, $numBathrooms, $numRooms, $kitchenType, $energyRating, $hasBalcony, $hasGarden, $hasGarage, $location, $state, $isChalet, $floors, $managerId) {
        Property::create($type, $squareMeters, $numBathrooms, $numRooms, $kitchenType, $energyRating, $hasBalcony, $hasGarden, $hasGarage, $location, $state, $isChalet, $floors, $managerId);
    }

    public static function update($id, $type, $squareMeters, $numBathrooms, $numRooms, $kitchenType, $energyRating, $hasBalcony, $hasGarden, $hasGarage, $location, $state, $isChalet, $floors, $managerId) {
        $property = Property::get($id);
        $property->update($type, $squareMeters, $numBathrooms, $numRooms, $kitchenType, $energyRating, $hasBalcony, $hasGarden, $hasGarage, $location, $state, $isChalet, $floors, $managerId);
    }

    public static function delete($id) {
        $property = Property::get($id);
        $property->delete();
    }

    public static function getAll() {
        return Property::getAll();
    }
}
