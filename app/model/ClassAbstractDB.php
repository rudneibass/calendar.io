<?php

require_once 'ClassConDB.php';

class ClassAbstractDB extends ClassConDB {

    private $query;

    public function prepExec($prep, $exec) {
        $this->query = $this->getConn()->prepare($prep);
        $this->query->execute($exec);
    }

    public function select($fields, $table, $prep, $exec) {
        try {
            $this->prepExec(' SELECT ' . $fields . ' FROM ' . $table . ' ' . $prep . '', $exec);
        } catch (\PDOException $e) {
            echo $e->getCode();
            echo $e->getMessage();
        }
        return $this->query;
    }

    public function showColumns($table, $exec) {
        try {
            $this->prepExec(' SHOW FULL COLUMNS FROM ' . $table , $exec);
        } catch (\PDOException $e) {
            echo $e->getCode();
            echo $e->getMessage();
        }
        return $this->query;
    }

    public function showTables($exec) {
        try {
            $this->prepExec(' SHOW FULL TABLES AS table_name' , $exec);
        } catch (\PDOException $e) {
            echo $e->getCode();
            echo $e->getMessage();
        }
        return $this->query;
    }

    public function addColumn($table, $column, $type , $collate, $exec) {
        try {
            $this->prepExec('ALTER TABLE `'.$table.'` ADD `'.$column.'` '.$type.' '.$collate.'' , $exec);
           
        } catch (\PDOException $e) {
            echo $e->getCode();
            echo $e->getMessage();
        }
        return $this->query;
    }

    public function addTable($name) {
        try {
            $this->prepExec("CREATE TABLE `".$name."`
                (
                `id` INT AUTO_INCREMENT PRIMARY KEY,
                `tbl` varchar(255) NOT NULL DEFAULT '".$name."',
                `data_cadastro` timestamp NOT NULL,
                `usuario` varchar(255) NOT NULL,
                `id_mandatos` int(11) DEFAULT NULL,
                `id_entidade_orgaos` varchar(11) DEFAULT NULL
                ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;" , 
                array());
           
        } catch (\PDOException $e) {
            echo $e->getCode();
            echo $e->getMessage();
        }
        return $this->query;
    }

    public function modifyColumn($table, $column, $type , $collate, $exec) {
        try {
            $this->prepExec('ALTER TABLE `'.$table.'` MODIFY `'.$column.'` '.$type.' '.$collate.'' , $exec);
           
        } catch (\PDOException $e) {
            echo $e->getCode();
            echo $e->getMessage();
        }
        return $this->query;
    }

    public function query($query)
    {
        $this->prepExec($query , array());
        return $this->query;
    }
}
