<?php
// /app/models/Property.php

require_once('../../utils/DB.php');

class Property {
    public $id;
    public $type;
    public $squareMeters;
    public $numBathrooms;
    public $numRooms;
    public $kitchenType;
    public $energyRating;
    public $hasBalcony;
    public $hasGarden;
    public $hasGarage;
    public $location;
    public $state;
    public $isChalet;
    public $floors;
    public $managerId;

    public function __construct($id, $type, $squareMeters, $numBathrooms, $numRooms, $kitchenType, $energyRating, $hasBalcony, $hasGarden, $hasGarage, $location, $state, $isChalet, $floors, $managerId) {
        $this->id = $id;
        $this->type = $type;
        $this->squareMeters = $squareMeters;
        $this->numBathrooms = $numBathrooms;
        $this->numRooms = $numRooms;
        $this->kitchenType = $kitchenType;
        $this->energyRating = $energyRating;
        $this->hasBalcony = $hasBalcony;
        $this->hasGarden = $hasGarden;
        $this->hasGarage = $hasGarage;
        $this->location = $location;
        $this->state = $state;
        $this->isChalet = $isChalet;
        $this->floors = $floors;
        $this->managerId = $managerId;
    }

    public static function create($type, $squareMeters, $numBathrooms, $numRooms, $kitchenType, $energyRating, $hasBalcony, $hasGarden, $hasGarage, $location, $state, $isChalet, $floors, $managerId) {
        DB::query('INSERT INTO properties (type, square_meters, num_bathrooms, num_rooms, kitchen_type, energy_rating, has_balcony, has_garden, has_garage, location, state, is_chalet, floors, manager_id) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)', [$type, $squareMeters, $numBathrooms, $numRooms, $kitchenType, $energyRating, $hasBalcony, $hasGarden, $hasGarage, $location, $state, $isChalet, $floors, $managerId]);
    }

    public static function get($id) {
        $result = DB::query('SELECT * FROM properties WHERE id = ?', [$id]);
        if (count($result) > 0) {
            return new Property($result[0]['id'], $result[0]['type'], $result[0]['square_meters'], $result[0]['num_bathrooms'], $result[0]['num_rooms'], $result[0]['kitchen_type'], $result[0]['energy_rating'], $result[0]['has_balcony'], $result[0]['has_garden'], $result[0]['has_garage'], $result[0]['location'], $result[0]['state'], $result[0]['is_chalet'], $result[0]['floors'], $result[0]['manager_id']);
        } else {
            return null;
        }
    }

    public static function getAll() {
        $result = DB::query('SELECT * FROM properties');
        $properties = [];
        foreach ($result as $row) {
            $properties[] = new Property($row['id'], $row['type'], $row['square_meters'], $row['num_bathrooms'], $row['num_rooms'], $row['kitchen_type'], $row['energy_rating'], $row['has_balcony'], $row['has_garden'], $row['has_garage'], $row['location'], $row['state'], $row['is_chalet'], $row['floors'], $row['manager_id']);
        }
        return $properties;
    }

    public function update($type, $squareMeters, $numBathrooms, $numRooms, $kitchenType, $energyRating, $hasBalcony, $hasGarden, $hasGarage, $location, $state, $isChalet, $floors, $managerId) {
        DB::query('UPDATE properties SET type = ?, square_meters = ?, num_bathrooms = ?, num_rooms = ?, kitchen_type = ?, energy_rating = ?, has_balcony = ?, has_garden = ?, has_garage = ?, location = ?, state = ?, is_chalet = ?, floors = ?, manager_id = ? WHERE id = ?', [$type, $squareMeters, $numBathrooms, $numRooms, $kitchenType, $energyRating, $hasBalcony, $hasGarden, $hasGarage, $location, $state, $isChalet, $floors, $managerId, $this->id]);
    }

    public function delete() {
        DB::query('DELETE FROM properties WHERE id = ?', [$this->id]);
    }

    public function isFavoritedBy(User $user) {
        global $db;
        $sql = "SELECT * FROM favorites WHERE user_id = ? AND property_id = ?";
        $result = $db->query($sql, [$user->getId(), $this->id])->fetch();
        return $result !== false;
    }

    public function getId() {
        return $this->id;
    }

    public static function count() {
        global $db;
        $sql = "SELECT COUNT(*) as count FROM properties";
        return $db->query($sql)->fetchColumn();
    }


    
}