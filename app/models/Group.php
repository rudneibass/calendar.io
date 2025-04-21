<?php
require_once 'DB.php';

class Group extends DB {
    private $table = 'group';

    public function all() {
        return $this->rawQuery(
            "SELECT * FROM `{$this->table}` ", 
            array()
        );
    }

    public function getById(string $id) {
        return $this->rawQuery(
            "SELECT * FROM `{$this->table}` WHERE id = :id",
            array(':id' => $id) 
        )[0] ?? null;
    }
}