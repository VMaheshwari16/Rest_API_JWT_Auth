<?php
class User {
    public static function create($data) {
        $db = Database::connect();
        $stmt = $db->prepare(
            "INSERT INTO users (name,email,password) VALUES (?,?,?)"
        );
        return $stmt->execute($data);
    }

    public static function findByEmail($email) {
        $db = Database::connect();
        $stmt = $db->prepare("SELECT * FROM users WHERE email=?");
        $stmt->execute([$email]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
