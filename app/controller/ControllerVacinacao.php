<?php

session_start();
require_once '../../config/header.php';
require_once '../../app/model/ClassModel.php';
require_once '../../app/model/ClassValidacao.php';

class ControllerVacinacao {


    function locate() {

        if (isset($_POST['id'])) {

            $prep = "WHERE e.id=" . filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT) . " ";
            $crud = new ClassModel();
            $select = $crud->select('*, e.id as relacionamento, e.id as tab_3_form_1_relacionamento  ', 'vacinacao e', $prep, array());
            $result = $select->fetch(\PDO::FETCH_ASSOC); // A T E N Ç Ã O !!! AQUI O PDO MONTA UM ARRAY ASSOCIATIVO.
            echo json_encode($result, JSON_PRETTY_PRINT);
        } else {

            $prep = "WHERE 1=1 "
                    . (isset($_POST["c2"]) && !empty($_POST["c2"]) ? " AND paciente_nome LIKE '%" . filter_input(INPUT_POST, 'c2', FILTER_SANITIZE_SPECIAL_CHARS) . "%'" : "")
                    . (isset($_POST["c3"]) && !empty($_POST["c3"]) ? " AND data_aplicacao BETWEEN '" . filter_input(INPUT_POST, 'c3', FILTER_SANITIZE_SPECIAL_CHARS) . "' AND '" . filter_input(INPUT_POST, 'c4', FILTER_SANITIZE_SPECIAL_CHARS) . "'" : "")
                    . " ORDER BY data_aplicacao";

            $crud = new ClassModel();
            $select = $crud->select("*, DATE_FORMAT(data_aplicacao, '%d/%m/%Y') as data_aplicacao", 'vacinacao ', $prep, array());
            $result = $select->fetchAll();  //A T E N Ç Ã O !!! AQUI O PDO MONTA UM ARRAY  >>N Ã O<<  ASSOCIATIVO
            echo json_encode($result, JSON_PRETTY_PRINT);
        }
    }

    public function update() {

        $val = new ClassValidacao();
        $val->set($_POST['paciente_nome'], '<b>Nome do Paciente</b>')->obrigatorio();
        $val->set($_POST['vacina_categoria_nome'], '<b>Categoria</b>')->obrigatorio();
        $val->set($_POST['vacina_subcategoria_nome'], '<b>Subcategoria</b>')->obrigatorio();
        $val->set($_POST['idade'], '<b>Idade</b>')->obrigatorio();
        $val->set($_POST['vacina_numero_dose'], '<b>Dose</b>')->obrigatorio();
        $val->set($_POST['vacina_nome'], '<b>Vacina</b>')->obrigatorio();
        
        
        if ($val->validar()) {
            $post = filter_var_array($_POST, FILTER_SANITIZE_SPECIAL_CHARS);
            $post['usuario'] = $_SESSION['USUARIO'];
            $id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);
            $crud = new ClassModel();
            $update = $crud->update('vacinacao ', $post, $id);
        } else {
            foreach ($val->getErrors() as $erro) {
                echo "$erro <br />";
            }
        }
    }

    public function insert() {

        $val = new ClassValidacao();
        $val->set($_POST['paciente_nome'], '<b>Nome do Paciente</b>')->obrigatorio();
        $val->set($_POST['vacina_categoria_nome'], '<b>Categoria</b>')->obrigatorio();
        $val->set($_POST['vacina_subcategoria_nome'], '<b>Subcategoria</b>')->obrigatorio();
        $val->set($_POST['idade'], '<b>Idade</b>')->obrigatorio();
        $val->set($_POST['vacina_numero_dose'], '<b>Dose</b>')->obrigatorio();
        $val->set($_POST['vacina_nome'], '<b>Vacina</b>')->obrigatorio();
        
        if ($val->validar()) {
            $post = filter_var_array($_POST, FILTER_SANITIZE_SPECIAL_CHARS);
            $post['data_cadastro'] = date("Y/m/d h:i:s");
            $post['usuario'] = $_SESSION['USUARIO'];
            $crud = new ClassModel();
            print $crud->insert($post, 'vacinacao ');
        } else {
            foreach ($val->getErrors() as $erro) {
                echo "$erro <br />";
            }
        }
    }

    public function delete() {

        $val = new ClassValidacao();
        $val->set($_POST['id'], '"Id não Informado"')->obrigatorio();

        if ($val->validar()) {
            $id = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT);
            $crud = new ClassModel();
            $delete = $crud->delete('vacinacao ', ' WHERE id=?', array($id));
        } else {
            foreach ($val->getErrors() as $erro) {
                echo "$erro <br />";
            }
        }
    }

}
