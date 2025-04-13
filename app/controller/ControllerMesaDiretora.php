<?php

session_start();
require_once '../../config/header.php';
require_once '../../app/model/ClassModel.php';
require_once '../../app/model/ClassValidacao.php';

class ControllerMesaDiretora {

    function teste() {
        echo 'function teste() Controller mesa diretora Controller';
    }

    function locate() {

        if (isset($_POST['id'])) {

            $prep = "WHERE e.id=" . filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT) . " ";
            $crud = new ClassModel();
            $select = $crud->select('*, e.id as relacionamento  ', 'mesa_diretora e', $prep, array());
            $result = $select->fetch(\PDO::FETCH_ASSOC); // A T E N Ç Ã O !!! AQUI O PDO MONTA UM ARRAY ASSOCIATIVO.
            echo json_encode($result, JSON_PRETTY_PRINT);
        } else {

            $prep = "WHERE 1=1 "
                    . (isset($_POST["c1"]) && !empty($_POST["c1"]) ? " AND id =" . filter_input(INPUT_POST, 'c1', FILTER_SANITIZE_NUMBER_INT) : "")
                    . (isset($_POST["c2"]) && !empty($_POST["c2"]) ? " AND nome LIKE '%" . filter_input(INPUT_POST, 'c2', FILTER_SANITIZE_SPECIAL_CHARS) . "%'" : "")
                    . (isset($_POST["c3"]) && !empty($_POST["c3"]) ? " AND data_cadastro BETWEEN '" . filter_input(INPUT_POST, 'c3', FILTER_SANITIZE_SPECIAL_CHARS) . "' AND '" . filter_input(INPUT_POST, 'c4', FILTER_SANITIZE_SPECIAL_CHARS) . "'" : "")
                    . " ORDER BY data_cadastro";

            $crud = new ClassModel();
            $select = $crud->select("*, DATE_FORMAT(data_cadastro, '%d/%m/%Y') as data_cadastro", 'mesa_diretora ', $prep, array());
            $result = $select->fetchAll();  //A T E N Ç Ã O !!! AQUI O PDO MONTA UM ARRAY  >>N Ã O<<  ASSOCIATIVO
            echo json_encode($result, JSON_PRETTY_PRINT);
        }
    }

    public function update() {

        $val = new ClassValidacao();
        $val->set($_POST['nome'], '<b>Nome</b>')->obrigatorio();
        $val->set($_POST['id_mandatos'], '<b>Legislatura</b>')->obrigatorio();
        $val->set($_POST['data_eleicao'], '<b>Data Eleição</b>')->obrigatorio();
        $val->set($_POST['data_inicio'], '<b>Data Inicio</b>')->obrigatorio();
        $val->set($_POST['data_fim'], '<b>Data Fim</b>')->obrigatorio();

        if ($val->validar()) {
            $post = filter_var_array($_POST, FILTER_SANITIZE_SPECIAL_CHARS);
            $id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);
            $crud = new ClassModel();
            print $crud->update('mesa_diretora ', $post, $id);
        } else {
            foreach ($val->getErrors() as $erro) {
                echo "$erro <br />";
            }
        }
    }

    public function insert() {

        $val = new ClassValidacao();
        $val->set($_POST['nome'], '<b>Nome</b>')->obrigatorio();
        $val->set($_POST['id_mandatos'], '<b>Legislatura</b>')->obrigatorio();
        $val->set($_POST['data_eleicao'], '<b>Data Eleição</b>')->obrigatorio();
        $val->set($_POST['data_inicio'], '<b>Data Inicio</b>')->obrigatorio();
        $val->set($_POST['data_fim'], '<b>Data Fim</b>')->obrigatorio();

        if ($val->validar()) {
            $post = filter_var_array($_POST, FILTER_SANITIZE_SPECIAL_CHARS);
            $post['data_cadastro'] = date("Y/m/d h:i:s");
            $post['usuario'] = $_SESSION['USUARIO'];
            $crud = new ClassModel();
            print $crud->insert($post, 'mesa_diretora ');
        } else {
            foreach ($val->getErrors() as $erro) {
                echo "$erro <br />";
            }
        }
    }

    /*public function delete() {

        $val = new ClassValidacao();
        $val->set($_POST['id'], '"Id não Informado"')->obrigatorio();

        if ($val->validar()) {
            $id = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT);
            $crud = new ClassModel();
            $delete = $crud->delete('mesa_diretora ', ' WHERE id=?', array($id));
        } else {
            foreach ($val->getErrors() as $erro) {
                echo "$erro <br />";
            }
        }
    }*/

}
