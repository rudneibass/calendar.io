<?php

session_start();
require_once '../../config/header.php';
require_once '../../app/model/ClassModel.php';
require_once '../../app/model/ClassValidacao.php';

class ControllerPessoa {

    function teste() {
        echo 'function teste() Pessoa Controller';
    }

    function locate() {

        if (isset($_POST['id'])) {

            $prep = "WHERE s.id=" . filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT) . " ";
            $crud = new ClassModel();
            $select = $crud->select('*, s.id as relacionamento', 'servidor s', $prep, array());
            $result = $select->fetch(\PDO::FETCH_ASSOC); // A T E N Ç Ã O !!! AQUI O PDO MONTA UM ARRAY ASSOCIATIVO.
            unset($result['senha']);
            echo json_encode($result, JSON_PRETTY_PRINT);

        } else {

            $prep = "WHERE 1=1 "
                    . (isset($_POST["c1"]) && !empty($_POST["c1"]) ? " AND id =" . filter_input(INPUT_POST, 'c1', FILTER_SANITIZE_NUMBER_INT) : "")
                    . (isset($_POST["c2"]) && !empty($_POST["c2"]) ? " AND nome LIKE '%" . filter_input(INPUT_POST, 'c2', FILTER_SANITIZE_SPECIAL_CHARS) . "%'" : "")
                    . (isset($_POST["nome_eleitoral"]) && !empty($_POST["nome_eleitoral"]) ? " AND nome_eleitoral LIKE '%" . filter_input(INPUT_POST, 'nome_eleitoral', FILTER_SANITIZE_SPECIAL_CHARS) . "%'" : "")
                    . (isset($_POST["c3"]) && !empty($_POST["c3"]) ? " AND data_cadastro BETWEEN '" . filter_input(INPUT_POST, 'c3', FILTER_SANITIZE_SPECIAL_CHARS) . "' AND '" . filter_input(INPUT_POST, 'c4', FILTER_SANITIZE_SPECIAL_CHARS) . "'" : "")
                    . " ORDER BY nome";

            $crud = new ClassModel();
            $select = $crud->select("*", 'servidor ', $prep, array());
            $result = $select->fetchAll();  //A T E N Ç Ã O !!! AQUI O PDO MONTA UM ARRAY  >>N Ã O<<  ASSOCIATIVO
            foreach($result as &$item){
                unset($item['senha']);
            }

            echo json_encode($result, JSON_PRETTY_PRINT);
        }
    }

    public function update() {

        $val = new ClassValidacao();
        $val->set($_POST['nome'], '<b>"Nome"</b>')->obrigatorio();
        $senha = $_POST['senha'];
        $post = filter_var_array($_POST, FILTER_SANITIZE_SPECIAL_CHARS);
        if (!isset($post['ativo'])) {
            $post['ativo'] = 'off';
        }

        if ($val->validar()) {
            $id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);
            $crud = new ClassModel();
            if($senha){
                $post['senha'] = md5($senha);
            }
            
            $crud->update('servidor ', $post, $id);
        } else {
            foreach ($val->getErrors() as $erro) {
                echo "$erro <br />";
            }
        }
    }

    public function insert() {

        $val = new ClassValidacao();
        $val->set($_POST['nome'], '<b>"Nome"</b>')->obrigatorio();
        $senha = $_POST['senha'];

        if ($val->validar()) {
            $post = filter_var_array($_POST, FILTER_SANITIZE_SPECIAL_CHARS);
            $post['data_cadastro'] = date("Y/m/d h:i:s");
            $post['usuario'] = $_SESSION['USUARIO'];
            if($senha){
                $post['senha'] = md5($senha);
            }
            if (!isset($post['ativo'])) {
                $post['ativo'] = 'off';
            }
            
            $crud = new ClassModel();            
            $id = $crud->Insert($post, 'servidor');

            $prep = "WHERE s.id=" . $id . " ";
            $crud = new ClassModel();
            $select = $crud->select('*, s.id as relacionamento', 'servidor s', $prep, array());
            $result = $select->fetch(\PDO::FETCH_ASSOC); // A T E N Ç Ã O !!! AQUI O PDO MONTA UM ARRAY ASSOCIATIVO.
            echo json_encode($result, JSON_PRETTY_PRINT);

        } else {
            foreach ($val->getErrors() as $erro) {
                echo "$erro <br />";
            }
        }
    }

    /*
    public function delete() {

        $val = new ClassValidacao();
        $val->set($_POST['id'], '"Id não Informado"')->obrigatorio();

        if ($val->validar()) {
            $id = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT);
            $crud = new ClassModel();
            $delete = $crud->delete('servidor', ' WHERE id=?', array($id));
        } else {
            foreach ($val->getErrors() as $erro) {
                echo "$erro <br />";
            }
        }
    }*/

}
