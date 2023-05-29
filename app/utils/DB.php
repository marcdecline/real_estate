<?php
// /app/utils/DB.php

require_once('../../config/config.php');

class DB {
    private static $pdo = null;

    public static function connect() {
        if (self::$pdo === null) {
            try {
                self::$pdo = new PDO('mysql:host=' . DB_HOST . ';dbname=' . DB_NAME, DB_USER, DB_PASSWORD);
                self::$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            } catch (PDOException $e) {
                die("ERROR: Could not connect. " . $e->getMessage());
            }
        }

        return self::$pdo;
    }

    public static function query($query, $params = []) {
        $statement = self::connect()->prepare($query);
        $statement->execute($params);

        if (explode(' ', $query)[0] == 'SELECT') {
            return $statement->fetchAll(PDO::FETCH_ASSOC);
        }
    }
}
