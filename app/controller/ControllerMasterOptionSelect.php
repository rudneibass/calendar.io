<?php

require_once '../../app/model/MasterClassModel.php';

class ControllerMasterOptionSelect {

    public $table;

    public function optionSelect() {
        $crud = new MasterClassModel();
        $select = $crud->select('*', $this->getTable(), '', array());

        foreach ($select as $data) {
            echo '<option value="' . $data['cnpj'] . '">' . $data['nome'] . '</option>';
        }
    }

    function getTable() {
        return $this->setTable();
    }

    function setTable() {
        return $this->table = filter_input(INPUT_GET, 'tbl', FILTER_SANITIZE_SPECIAL_CHARS);
    }

}
