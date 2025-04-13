<?php

session_start();
require_once '../../config/header.php';
require_once '../../app/model/ClassModel.php';
require_once '../../app/model/ClassValidacao.php';

class ControllerProcessoSeletivo {


    function locate() {

        if (isset($_POST['id'])) {

            $prep = "WHERE e.id=" . filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT) . " ";
            $crud = new ClassModel();
            $select = $crud->select('*, e.id as relacionamento, e.id as tab_3_form_1_relacionamento  ', 'processo_seletivo e', $prep, array());
            $result = $select->fetch(\PDO::FETCH_ASSOC); // A T E N Ç Ã O !!! AQUI O PDO MONTA UM ARRAY ASSOCIATIVO.
            echo json_encode($result, JSON_PRETTY_PRINT);
        } else {

            $prep = "WHERE 1=1 "
                    . (isset($_POST["c1"]) && !empty($_POST["c1"]) ? " AND id =" . filter_input(INPUT_POST, 'c1', FILTER_SANITIZE_NUMBER_INT) : "")
                    . (isset($_POST["c2"]) && !empty($_POST["c2"]) ? " AND objeto_licitacao LIKE '%" . filter_input(INPUT_POST, 'c2', FILTER_SANITIZE_SPECIAL_CHARS) . "%'" : "")
                    . (isset($_POST["c3"]) && !empty($_POST["c3"]) ? " AND data_cadastro BETWEEN '" . filter_input(INPUT_POST, 'c3', FILTER_SANITIZE_SPECIAL_CHARS) . "' AND '" . filter_input(INPUT_POST, 'c4', FILTER_SANITIZE_SPECIAL_CHARS) . "'" : "")
                    . " ORDER BY data_cadastro";

            $crud = new ClassModel();
            $select = $crud->select("*, DATE_FORMAT(data_publicacao, '%d/%m/%Y') as data_publicacao", 'processo_seletivo ', $prep, array());
            $result = $select->fetchAll();  //A T E N Ç Ã O !!! AQUI O PDO MONTA UM ARRAY  >>N Ã O<<  ASSOCIATIVO
            echo json_encode($result, JSON_PRETTY_PRINT);
        }
    }

    public function update() {

        $val = new ClassValidacao();
        $val->set($_POST['id_entidade_orgaos'], '<b>Órgão</b>')->obrigatorio();
        $val->set($_POST['id_mandatos'], '<b>Legislatura/Gestão</b>')->obrigatorio();
        $val->set($_POST['titulo'], '<b>Título</b>')->obrigatorio();
        $val->set($_POST['tipo'], '<b>Tipo</b>')->obrigatorio();
        $val->set($_POST['data_publicacao'], '<b>Data da Publicação</b>')->obrigatorio();
        $val->set($_POST['exercicio'], '<b>Exercício</b>')->obrigatorio();
        
        if ($val->validar()) {
            $post = filter_var_array($_POST, FILTER_SANITIZE_SPECIAL_CHARS);
            $post['usuario'] = $_SESSION['USUARIO'];
            $id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);
            $crud = new ClassModel();
            $update = $crud->update('processo_seletivo ', $post, $id);
        } else {
            foreach ($val->getErrors() as $erro) {
                echo "$erro <br />";
            }
        }
    }

    public function insert() {

        $val = new ClassValidacao();
        $val->set($_POST['id_entidade_orgaos'], '<b>Órgão</b>')->obrigatorio();
        $val->set($_POST['id_mandatos'], '<b>Legislatura/Gestão</b>')->obrigatorio();
        $val->set($_POST['titulo'], '<b>Título</b>')->obrigatorio();
        $val->set($_POST['tipo'], '<b>Tipo</b>')->obrigatorio();
        $val->set($_POST['data_publicacao'], '<b>Data da Publicação</b>')->obrigatorio();
        $val->set($_POST['exercicio'], '<b>Exercício</b>')->obrigatorio();

        if ($val->validar()) {
            $post = filter_var_array($_POST, FILTER_SANITIZE_SPECIAL_CHARS);
            $post['data_cadastro'] = date("Y/m/d h:i:s");
            $post['usuario'] = $_SESSION['USUARIO'];
            $crud = new ClassModel();
            print $crud->insert($post, 'processo_seletivo ');
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
            $delete = $crud->delete('processo_seletivo ', ' WHERE id=?', array($id));
        } else {
            foreach ($val->getErrors() as $erro) {
                echo "$erro <br />";
            }
        }
    }*/

}
