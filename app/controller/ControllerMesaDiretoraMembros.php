<?php

session_start();
require_once '../../config/header.php';
require_once '../../app/model/ClassModel.php';
require_once '../../app/model/ClassValidacao.php';

class ControllerMesaDiretoraMembros {

    function teste() {
        echo 'function teste() ControllerEntidade Controller';
    }

    function locate() {

        if (isset($_GET['id'])) {

            $prep = "WHERE id=" . filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT) . " ";
            $crud = new ClassModel();
            $select = $crud->select('* ', 'mesa_diretora_membros ', $prep, array());
            $result = $select->fetch(\PDO::FETCH_ASSOC); // A T E N Ç Ã O !!! AQUI O PDO MONTA UM ARRAY ASSOCIATIVO.
            echo json_encode($result, JSON_PRETTY_PRINT);
        } else {

            $prep = "WHERE t1.id_mesa_diretora = " . $_POST['id'] . "";
            $crud = new ClassModel();
            $select = $crud->select("t1.*, t2.nome, DATE_FORMAT(t1.data_inicio, '%d/%m/%Y') as data_inicio, DATE_FORMAT(t1.data_fim, '%d/%m/%Y') as data_fim ", "mesa_diretora_membros t1 LEFT JOIN servidor t2 ON t1.id_servidor = t2.id ", $prep, array());
            $result = $select->fetchAll();  //A T E N Ç Ã O !!! AQUI O PDO MONTA UM ARRAY  >>N Ã O<<  ASSOCIATIVO
            echo json_encode($result, JSON_PRETTY_PRINT);
        }
    }

    public function update() {

        $val = new ClassValidacao();
        $val->set($_POST['id_servidor'], '<b>Funcionario</b>')->obrigatorio();
        $val->set($_POST['data_inicio'], '<b>Data Inicio</b>')->obrigatorio();
        $val->set($_POST['data_fim'], '<b>Data Fim</b>')->obrigatorio();

        if ($val->validar()) {
            $post = filter_var_array($_POST, FILTER_SANITIZE_SPECIAL_CHARS);
            $id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);
            $crud = new ClassModel();
            $crud->update('mesa_diretora_membros ', $post, $id);
        } else {
            foreach ($val->getErrors() as $erro) {
                echo "$erro <br />";
            }
        }
    }

    public function insert() {

        $val = new ClassValidacao();
        $val->set($_POST['id_servidor'], '<b>Funcionario</b>')->obrigatorio();
        $val->set($_POST['data_inicio'], '<b>Data Inicio</b>')->obrigatorio();
        $val->set($_POST['data_fim'], '<b>Data Fim</b>')->obrigatorio();

        if ($val->validar()) {
            $post = filter_var_array($_POST, FILTER_SANITIZE_SPECIAL_CHARS);
            $post['data_cadastro'] = date("Y/m/d h:i:s");
            $post['usuario'] = $_SESSION['USUARIO'];
            $crud = new ClassModel();
            print $crud->insert($post, 'mesa_diretora_membros ');
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
            $delete = $crud->delete('entidade_orgaoss_detalhe ', ' WHERE id=?', array($id));
        } else {
            foreach ($val->getErrors() as $erro) {
                echo "$erro <br />";
            }
        }
    }*/

}
