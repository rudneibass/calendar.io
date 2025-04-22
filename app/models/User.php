<?php
require_once 'DB.php';

class User extends DB {
    private $table = 'user';

    public function getUser(string $userId) {
        return $this->rawQuery(
            "SELECT *
            FROM {$this->table} 
            WHERE id = :id", 
            array(
                ':id' => $userId
            )
        )[0];
    }

    public function getUserBySlug(string $slug) {
        return $this->rawQuery(
            "SELECT *
            FROM {$this->table} 
            WHERE slug = :slug", 
            array(
                ':slug' => $slug
            )
        )[0];
    }

    public function all() {
        return $this->rawQuery(
            "SELECT * FROM `{$this->table}` ", 
            array()
        );
    }
}