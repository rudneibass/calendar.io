<?php

session_start();
require_once '../../config/header.php';
require_once '../../app/model/ClassAbstractDB.php';
require_once '../../app/model/ClassValidacao.php';
require_once '../../app/model/MasterClassModel.php';
require_once '../../app/model/ClassModel.php';

class ControllerMasterDatabase
{

    public function getSchema(){
        $db = new ClassAbstractDB();
        $select = $db->select('cnpj ', 'entidade ', '', array());
        $result = $select->fetchAll(); 
        $cnpj = null;
        foreach ($result as $data) {
            $cnpj = $data['cnpj'];
       };

       $dbMaster = new MasterClassModel();
       $select = $dbMaster->select('db_name ', 'master_entidade ', ' WHERE cnpj=?', array($cnpj));
       $result = $select->fetchAll();  
       
       $tableSchema = null;
        foreach ($result as $data) {
            $tableSchema = $data['db_name'];
       };

       return $tableSchema;
    }

    public function locate()
    {    
        $prep = 'WHERE TABLE_SCHEMA = "'.$this->getSchema().'" ORDER BY _tables';
        $crud = new ClassAbstractDB();
        $select = $crud->select('TABLE_NAME AS _tables ', 'INFORMATION_SCHEMA.TABLES ', $prep, array());
        $result = $select->fetchAll();  //A T E N Ç Ã O !!! AQUI O PDO MONTA UM ARRAY  >>N Ã O<<  ASSOCIATIVO
        echo json_encode($result, JSON_PRETTY_PRINT);
    }

    public function showOneColumn()
    {
        $table = $_GET['table'];
        $prep = 'TABLE_SCHEMA = "'.$this->getSchema().'" AND TABLE_NAME = "' . $table . '"';
        $crud = new ClassAbstractDB();
        $select = $crud->showColumns($table, array());
        $result = $select->fetchAll();  //A T E N Ç Ã O !!! AQUI O PDO MONTA UM ARRAY  >>N Ã O<<  ASSOCIATIVO
        echo json_encode($result, JSON_PRETTY_PRINT);
    }


    public function showColumns()
    {
        $table = $_POST['table'];
        $prep = 'TABLE_SCHEMA = "'.$this->getSchema().'" AND TABLE_NAME = "' . $table . '"';
        $crud = new ClassAbstractDB();
        $select = $crud->showColumns($table, array());
        $result = $select->fetchAll();  //A T E N Ç Ã O !!! AQUI O PDO MONTA UM ARRAY  >>N Ã O<<  ASSOCIATIVO
        echo json_encode($result, JSON_PRETTY_PRINT);
    }

    public function addColumn()
    {
        $val = new ClassValidacao();
        $val->set($_POST['name'], '<b>Name</b>')->obrigatorio();
        if ($val->validar()) {
            $post = filter_var_array($_POST, FILTER_SANITIZE_SPECIAL_CHARS);
            $table = filter_input(INPUT_GET, 'table', FILTER_SANITIZE_SPECIAL_CHARS);

            $column = $post['name'];
            $type = $post['type'];
            if (in_array($type, ['INT', 'VARCHAR'])) {
                $type .= '(' . $post['length'] . ')';
            }
            $collate = $post['collate'];
            $crud = new ClassAbstractDB();
            $crud->addColumn($table, $column, $type, $collate,  array());
        } else {
            foreach ($val->getErrors() as $erro) {
                echo "$erro <br />";
            }
        }
    }

    public function modifyColumn()
    {
        $val = new ClassValidacao();
        $val->set($_POST['name'], '<b>Name</b>')->obrigatorio();
        if ($val->validar()) {
            $post = filter_var_array($_POST, FILTER_SANITIZE_SPECIAL_CHARS);
            $table = filter_input(INPUT_GET, 'table', FILTER_SANITIZE_SPECIAL_CHARS);

            $column = $post['name'];
            $type = $post['type'];
            if (in_array($type, ['INT', 'VARCHAR'])) {
                $type .= '(' . $post['length'] . ')';
            }
            $collate = $post['collate'];
            $crud = new ClassAbstractDB();
            $crud->modifyColumn($table, $column, $type, $collate,  array());
        } else {
            foreach ($val->getErrors() as $erro) {
                echo "$erro <br />";
            }
        }
    }

    public function addTable()
    {
        $val = new ClassValidacao();
        $val->set($_POST['name'], '<b>Name</b>')->obrigatorio();
        if ($val->validar()) {
            $post = filter_var_array($_POST, FILTER_SANITIZE_SPECIAL_CHARS);
            $name = trim($post['name']);
            $db = new ClassAbstractDB();
            $db->addTable($name);
        } else {
            foreach ($val->getErrors() as $erro) {
                echo "$erro <br />";
            }
        }
    }
}
