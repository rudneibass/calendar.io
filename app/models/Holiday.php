<?php
require_once 'DB.php';

class Holiday extends DB {
    private $table = 'holiday';

    public function all($year = null) {
        return $this->rawQuery(
            "SELECT day, description FROM {$this->table} WHERE YEAR(day) = :ano ", 
            array(':ano' => $year)
        );
    }
}