<?php
session_start();
require_once '../../app/model/ClassModel.php';
require_once '../../app/model/ClassAbstractDB.php';

class ControllerOptionSelect {

    public $table;

    public function optionSelect() {
        $crud = new ClassModel();
        $select = $crud->select('*', $this->getTable(), ' ORDER BY nome', array());

        foreach ($select as $data) {
            echo '<option value="' . $data['id'] . '">' . $data['nome'] . '</option>';
        }
    }

    public function optionSelectMaterias() {
        $crud = new ClassModel();
        $select = $crud->select('*, DATE_FORMAT(data, "%d/%m/%Y") as data', $this->getTable(), ' ORDER BY data DESC', array());

        foreach ($select as $data) {
            echo '<option value="' . $data['id'] . '">'.$data['id'].' | '.$data['data'].' | '. substr($data['descricao'], 0, 100) . '... </option>';
        }
    }

    public function optionSelectNovo() {
        $crud = new ClassModel();
        $where = 'WHERE ativo = "S" ';
        if($_POST['filtros']){
            $where .= 'AND '.$_POST['filtros']['campo'].' = '.$_POST['filtros']['campo'].' ';
        }
        $select = $crud->select('*', $this->getTable(),  $where.' ORDER BY nome', array());
        foreach ($select as $data) {
            echo '<option value="' . $data['valor'] . '">' . $data['nome'] . '</option>';
        }
    }

    public function optionSelectTabelas() {

        $db = new ClassAbstractDB();
        $dbMaster = new MasterClassModel();

        $select = $db->select('cnpj ', 'entidade ', '', array());
        $result = $select->fetchAll(); 
        $cnpj = null;
        foreach ($result as $data) {
            $cnpj = $data['cnpj'];
       };

       $select = $dbMaster->select('db_name ', 'master_entidade ', ' WHERE cnpj=?', array($cnpj));
       $result = $select->fetchAll();  
       
       $tableSchema = null;
        foreach ($result as $data) {
            $tableSchema = $data['db_name'];
       };

        $prep = 'WHERE TABLE_SCHEMA = "'.$tableSchema.'" ORDER BY _tables';
        $select = $db->select('TABLE_NAME AS _tables ', 'INFORMATION_SCHEMA.TABLES ', $prep, array());
        
        foreach ($select as $data) {
            echo '<option value="' . $data['_tables'] . '">'.$data['_tables'].'</option>';
        }
    }

    public function optionSelectColunas()
    {
        $db = new ClassAbstractDB();
        $select = $db->showColumns($_GET['tbl'], array());

        foreach ($select as $data) {
            echo '<option value="' . $data['Field'] . '">'.$data['Field'].'</option>';
        }
    }

    function getTable() {
        return $this->setTable();
    }

    function setTable() {
        return $this->table = filter_input(INPUT_GET, 'tbl', FILTER_SANITIZE_SPECIAL_CHARS);
    }

}
