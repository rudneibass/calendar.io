<?php

session_start();
require_once '../../app/model/ClassModel.php';
require_once '../../app/model/ClassValidacao.php';

class ControllerPessoaVinculo {

    function locate() {
        if (isset($_GET['id'])) {

            $prep = "WHERE id=" . filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT) . " ";
            $crud = new ClassModel();
            $select = $crud->select('*', 'servidor_vinculo', $prep, array());
            $result = $select->fetch(\PDO::FETCH_ASSOC); // A T E N Ç Ã O !!! AQUI O PDO MONTA UM ARRAY ASSOCIATIVO.
            echo json_encode($result, JSON_PRETTY_PRINT);
        
            
        } else {

            $prep = "WHERE id_servidor = " . $_POST['id'] . "";
            $crud = new ClassModel();
            $select = $crud->select(
                "sv.*, 
                DATE_FORMAT(sv.data_ingresso,'%d/%m/%Y') as data_ingresso,
                c.nome as nome_cargo", 
                'servidor_vinculo sv
                LEFT JOIN cargos c ON sv.id_cargo = c.id', 
                $prep, 
                array()
            );
            $result = $select->fetchAll();  //A T E N Ç Ã O !!! AQUI O PDO MONTA UM ARRAY  >>N Ã O<<  ASSOCIATIVO
            echo json_encode($result, JSON_PRETTY_PRINT);
        }
    }

    public function update() {

        $val = new ClassValidacao();
        $val->set($_POST['matricula'], '<b>"Matricula"</b>')->obrigatorio();
        $val->set($_POST['id_cargo'], '<b>"Cargo no Órgãos"</b>')->obrigatorio();
        $val->set($_POST['data_posse'], '<b>"Data da Posse"</b>')->obrigatorio();
        $val->set($_POST['data_publicacao_expediente'], '<b>"Data Publicacao Expediente"</b>')->obrigatorio();
        $val->set($_POST['data_expediente_nomeacao'], '<b>"Data Expediente Nomeação"</b>')->obrigatorio();
        $val->set($_POST['tipo_expediente_nomeacao'], '<b>"Tipo Expediente Nomeação"</b>')->obrigatorio();
        $val->set($_POST['numero_expediente_nomeacao'], '<b>"Numero Expediente Nomeação"</b>')->obrigatorio();


        $post = filter_var_array($_POST, FILTER_SANITIZE_SPECIAL_CHARS);

        if (!isset($post['vinculo_ativo'])) {
            $post['vinculo_ativo'] = 'off';
        }

        if ($val->validar()) {
            $id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);
            $crud = new ClassModel();
            $update = $crud->update('servidor_vinculo ', $post, $id);
        } else {
            foreach ($val->getErrors() as $erro) {
                echo "$erro <br />";
            }
        }
    }

    public function insert() {

        $val = new ClassValidacao();
        $val->set($_POST['matricula'], '<b>"Matricula"</b>')->obrigatorio();
        $val->set($_POST['id_cargo'], '<b>"Cargo no Órgãos"</b>')->obrigatorio();
        $val->set($_POST['data_posse'], '<b>"Data da Posse"</b>')->obrigatorio();
        $val->set($_POST['data_publicacao_expediente'], '<b>"Data Publicacao Expediente"</b>')->obrigatorio();
        $val->set($_POST['data_expediente_nomeacao'], '<b>"Data Expediente Nomeação"</b>')->obrigatorio();
        $val->set($_POST['tipo_expediente_nomeacao'], '<b>"Tipo Expediente Nomeação"</b>')->obrigatorio();
        $val->set($_POST['numero_expediente_nomeacao'], '<b>"Numero Expediente Nomeação"</b>')->obrigatorio();

        $post = filter_var_array($_POST, FILTER_SANITIZE_SPECIAL_CHARS);

        if (!isset($post['vinculo_ativo'])) {
            $post['vinculo_ativo'] = 'off';
        }
        
        if ($val->validar()) {
            $crud = new ClassModel();
            print $crud->Insert($post, 'servidor_vinculo');
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
            $delete = $crud->delete('servidor_vinculo', ' WHERE id=?', array($id));
        } else {
            foreach ($val->getErrors() as $erro) {
                echo "$erro <br />";
            }
        }
    }*/

}
