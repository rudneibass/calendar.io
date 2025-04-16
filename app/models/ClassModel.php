<?php

require_once 'ClassConDB.php';

class ClassModel extends ClassConDB {

    private $query;

    public function prepExec($prep, $exec) {
        $this->query = $this->getConn()->prepare($prep);
        $this->query->execute($exec);
    }

    public function executeQuery(string $sql, array $params = []) {
        try {
            $this->prepExec($sql, $params);
            if (stripos(trim($sql), 'SELECT') === 0) {
                return $this->query->fetchAll(PDO::FETCH_ASSOC);
            }
            return $this->query->rowCount();
        } catch (\PDOException $e) {
            echo "Erro na execução da consulta: " . $e->getMessage();
            return false;
        }
    }

    public function insert($post, $table) {
        $fields = null;     
        $params = null;
        $valuesPgSql = null;
        $valuesMySql = null;

        foreach ($post as $campo => $valor) {
            $fields .= $campo . ',';
            $params .= ':' . $campo . ',';
            $valuesPgSql .= $valor . '@&$';
            $valuesMySql .= "'" . $valor . "',";
        }

        $fields = substr($fields, 0, strlen($fields) - 1);
        $params = substr($params, 0, strlen($params) - 1);
        $valuesPgSql = substr($valuesPgSql, 0, strlen($valuesPgSql) - 3);
        $valuesMySql = substr($valuesMySql, 0, strlen($valuesMySql) - 1);

        try {
            switch ($_SESSION['DB_TYPE']) {
                case 'pgsql':
                    $this->prepExec(' INSERT INTO ' . $table . ' (' . $fields . ') VALUES (' . $params . ') ', explode('@&$', $valuesPgSql));
                    break;
                case 'mysql':
                    $this->prepExec(' INSERT INTO ' . $table . ' (' . $fields . ') VALUES (' . $valuesMySql . ') ', array());
                    break;
            }
        } catch (\PDOException $e) {
            echo $e->getCode();
            echo $e->getMessage();
        }
        return $this->getConn()->lastInsertId();
    }

    public function update($table, $post, $id) {

        $fields = null;
        $values = null;

        foreach ($post as $campo => $valor) {
            $fields .= $campo . "=?,";
            $values .= $valor . ",-,";
        }
        $fields = substr($fields, 0, strlen($fields) - 1);
        $values = substr($values, 0, strlen($values) - 3);

        try {
            $this->prepExec(' UPDATE ' . $table . ' SET ' . $fields . ' WHERE id = ' . $id . '', explode(',-,', $values));
            $this->query->rowCount();
            print $this->query->rowCount() > 0 ? '1' : '0';
        } catch (\PDOException $e) {
            echo $e->getCode();
            echo $e->getMessage();
        }

        return $this->query;
    }


    public function updateAll($table, $column, $value, $id) { 
        try {
            $this->prepExec(' UPDATE ' . $table . ' SET ' . $column . ' = "' . $value . '" WHERE id = '. $id, array());
            $this->query->rowCount();
            print $this->query->rowCount() > 0 ? '1' : '0';
        } catch (\PDOException $e) {
            echo $e->getCode();
            echo $e->getMessage();
        }
        return $this->query;
    }

    public function delete($table, $prep, $exec) {
        try {
            $this->prepExec('DELETE FROM ' . $table . ' ' . $prep . ' ', $exec);
        } catch (\PDOException $e) {
            echo $e->getCode();
            echo $e->getMessage();
        }
        return $this->query;
    }

    public function select($fields, $table, $prep, $exec) {
        //var_dump(' SELECT ' . $fields . ' FROM ' . $table . ' ' . $prep . ''); die;
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

    public function alterTable($table, $column, $type , $collate, $exec) {
        try {
            $this->prepExec('ALTER TABLE `'.$table.'` ADD `'.$column.'` '.$type.' '.$collate.'' , $exec);
           
        } catch (\PDOException $e) {
            echo $e->getCode();
            echo $e->getMessage();
        }
        return $this->query;
    }
}
