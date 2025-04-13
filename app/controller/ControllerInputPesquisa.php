<?php

session_start();
require_once '../../config/header.php';
require_once '../../app/model/ClassModel.php';
require_once '../../app/model/ClassValidacao.php';

class ControllerInputPesquisa {

    public $table;

    public function inputPesquisa() {
        $fields = "*";
        $table = $this->getTable();
        $prep = "WHERE 1 =1 "
        . (isset($_POST["id"]) && !empty($_POST["id"]) ? " AND id = " . $_POST["id"] . "" : "")
        . (isset($_POST["descricao"]) && !empty($_POST["descricao"]) ? " AND descricao LIKE '%" . $_POST["descricao"] . "%'" : "")
        . (isset($_POST["objeto_licitacao"]) && !empty($_POST["objeto_licitacao"]) ? " AND objeto_licitacao LIKE '%" . $_POST["objeto_licitacao"] . "%'" : "")
        . " ORDER BY id ASC";

        $crud = new ClassModel();
        $select = $crud->select($fields, $table, $prep, array());
        $result = $select->fetchAll();
        echo json_encode($result, JSON_PRETTY_PRINT);
    }

    public function getTable() {
        return $this->setTable();
    }

    public function setTable() {
        return $this->table = filter_input(INPUT_GET, 'tbl', FILTER_DEFAULT);
    }

}
