<?php

class Database {
    private static $conn;

    public function connect() {
        if (!self::$conn) {
            try {
                self::$conn = new PDO("mysql:host=localhost;dbname=attendance", "root", "root");
                self::$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            } catch (PDOException $e) {
                $mess = $e->getMessage();
                echo $mess;
            }
        }
        return self::$conn;
    }
}