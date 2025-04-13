<?php

require_once 'MasterClassConDB.php';

class MasterClassModel extends MasterClassConDB {

    private $query;

    public function prepExec($prep, $exec) {
        $this->query = $this->getConn()->prepare($prep);
        $this->query->execute($exec);
    }

//    public function Insert($post, $table) {
//        $fields = null;
//        $values = null;
//        foreach ($post as $campo => $valor) {
//            $fields .= $campo . "=?, ";
//            $values .= $valor . ",-,";
//        }
//        $prep = substr($fields, 0, strlen($fields) - 2);
//        $exec = substr($values, 0, strlen($values) - 3);
//
//        try {
//            $this->prepExec(' INSERT INTO ' . $table . ' SET ' . $prep . '', explode(',-,', $exec));
//        } catch (\PDOException $e) {
//            echo $e->getCode();
//            echo $e->getMessage();
//        }
//        return $this->getConn()->lastInsertId();
//    }

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
            switch (M_DB_TYPE) {
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

    public function delete($table, $prep, $exec) {
        try {
            $this->prepExec('DELETE FROM ' . $table . ' ' . $prep . ' ', $exec);
        } catch (\PDOException $e) {
            echo $e->getCode();
            echo $e->getMessage();
        }
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

}
