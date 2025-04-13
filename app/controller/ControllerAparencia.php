<?php

session_start();
require_once '../../app/model/ClassModel.php';
require_once '../../app/model/ClassValidacao.php';

class ControllerAparencia {


    function locate() {

        if (!isset($_POST['tabelaPai'])) {      
            $prep = "WHERE id in (select max(id) from leiaute)";
            $crud = new ClassModel();
            $select = $crud->select("* ", "leiaute ", $prep, array());
            $result = $select->fetchAll();  //A T E N Ç Ã O !!! AQUI O PDO MONTA UM ARRAY  >>N Ã O<<  ASSOCIATIVO
            echo json_encode($result, JSON_PRETTY_PRINT);
        } else {
            $tabelaPai = filter_input(INPUT_POST, 'tabelaPai', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $prep = "WHERE tabela_pai = ?  ORDER BY data";
            $crud = new ClassModel();
            $select = $crud->select("*", 'arquivos ', $prep, array($tabelaPai));
            $result = $select->fetchAll();  //A T E N Ç Ã O !!! AQUI O PDO MONTA UM ARRAY  >>N Ã O<<  ASSOCIATIVO
            echo json_encode($result, JSON_PRETTY_PRINT);
        }
    }

    function getColors() {

            $table = filter_input(INPUT_POST, 'table', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $prep = "WHERE id in (select max(id) from  ".$table.")";
            $crud = new ClassModel();
            $select = $crud->select("*", $table, $prep, array());
            $result = $select->fetchAll();  //A T E N Ç Ã O !!! AQUI O PDO MONTA UM ARRAY  >>N Ã O<<  ASSOCIATIVO
            echo json_encode($result, JSON_PRETTY_PRINT);

    }

    /*public function delete() {

        $val = new ClassValidacao();
        $val->set($_POST['id'], '"Id não Informado"')->obrigatorio();

        if ($val->validar()) {
            $tabelaPai = filter_input(INPUT_POST, 'tabelaPai', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $id = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT);
            $crud = new ClassModel();
            $crud->delete('arquivos ', ' WHERE id=? && tabela_pai=? ', array($id, $tabelaPai));
        } else {
            foreach ($val->getErrors() as $erro) {
                echo "$erro <br />";
            }
        }
    }*/

    public function insert() {

        $val = new ClassValidacao();
        $_POST['usuario'] = 'admin';
        $val->set($_POST['usuario'], '<b>"Usuário"</b>')->obrigatorio();
        $post = filter_var_array($_POST, FILTER_SANITIZE_SPECIAL_CHARS);
        $table = 'leiaute';

        if ($val->validar()) {
            $post['data_cadastro'] = date("Y/m/d h:i:s");
            $crud = new ClassModel();
            print $crud->Insert($post, $table);
        } else {
            foreach ($val->getErrors() as $erro) {
                echo "$erro <br />";
            }
        }
    }

    public function update() {
        $post = filter_var_array($_POST, FILTER_SANITIZE_SPECIAL_CHARS);
        $table = "cores";
        $id = 1;
        $crud = new ClassModel();
        $crud->update($table, $post, $id); 
    }

    public function setColors() {
        $post = filter_var_array($_POST, FILTER_SANITIZE_SPECIAL_CHARS);
        $table = "cores";

        $crud = new ClassModel();
        $select = $crud->select("*", $table, '', array());
        $result = $select->fetchAll();
        
        if(count($result) === 0){
            print $crud->Insert($post, $table);
        }

        if(count($result) > 0){
            $id = 1;
            $crud->update($table, $post, $id); 
        }
        
    }
}
