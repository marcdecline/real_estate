<?php
// /app/models/User.php

require_once('../../utils/DB.php');

class User {
    public $id;
    public $username;
    public $password;
    public $email;
    public $role;

    public function __construct($id, $username, $password, $email, $role) {
        $this->id = $id;
        $this->username = $username;
        $this->password = $password;
        $this->email = $email;
        $this->role = $role;
    }

    public static function create($username, $password, $email, $role) {
        $passwordHash = password_hash($password, PASSWORD_DEFAULT);
        DB::query('INSERT INTO users (username, password, email, role) VALUES (?, ?, ?, ?)', [$username, $passwordHash, $email, $role]);
    }

    public static function get($id) {
        $result = DB::query('SELECT * FROM users WHERE id = ?', [$id]);
        if (count($result) > 0) {
            return new User($result[0]['id'], $result[0]['username'], $result[0]['password'], $result[0]['email'], $result[0]['role']);
        } else {
            return null;
        }
    }

    public static function getAll() {
        $result = DB::query('SELECT * FROM users');
        $users = [];
        foreach ($result as $row) {
            $users[] = new User($row['id'], $row['username'], $row['password'], $row['email'], $row['role']);
        }
        return $users;
    }

    public function update($username, $password, $email, $role) {
        $passwordHash = password_hash($password, PASSWORD_DEFAULT);
        DB::query('UPDATE users SET username = ?, password = ?, email = ?, role = ? WHERE id = ?', [$username, $passwordHash, $email, $role, $this->id]);
    }

    public function delete() {
        DB::query('DELETE FROM users WHERE id = ?', [$this->id]);
    }

        public function addFavorite(Property $property) {
        global $db;
        $sql = "INSERT INTO favorites (user_id, property_id) VALUES (?, ?)";
        $db->query($sql, [$this->id, $property->getId()]);
    }

    public function removeFavorite(Property $property) {
        global $db;
        $sql = "DELETE FROM favorites WHERE user_id = ? AND property_id = ?";
        $db->query($sql, [$this->id, $property->getId()]);
    }

    public function getFavorites() {
        global $db;
        $sql = "SELECT * FROM properties INNER JOIN favorites ON properties.id = favorites.property_id WHERE favorites.user_id = ?";
        $results = $db->query($sql, [$this->id])->fetchAll();
        $properties = [];
        foreach ($results as $row) {
            $properties[] = new Property($row);
        }
        return $properties;
    }

    public static function count() {
        global $db;
        $sql = "SELECT COUNT(*) as count FROM users";
        return $db->query($sql)->fetchColumn();
    }
    
}


