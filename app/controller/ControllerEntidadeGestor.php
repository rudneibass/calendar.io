<?php

session_start();
require_once '../../config/header.php';
require_once '../../app/model/ClassModel.php';
require_once '../../app/model/ClassValidacao.php';

class ControllerEntidadeGestor {

    public function locate() {

        if (isset($_GET['id'])) {

            $prep = "WHERE id=" . filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT) . " ";
            $crud = new ClassModel();
            $select = $crud->select('* ', 'entidade_gestores ', $prep, array());
            $result = $select->fetch(\PDO::FETCH_ASSOC); // A T E N Ç Ã O !!! AQUI O PDO MONTA UM ARRAY ASSOCIATIVO.
            echo json_encode($result, JSON_PRETTY_PRINT);
        
        } else {
            
            $prep = "WHERE id_entidade = " . $_POST['id'] . "";
            $crud = new ClassModel();
            $select = $crud->select(
                    "t1.*, t2.nome, t3.nome as cargo, 
                    DATE_FORMAT(t1.data_cadastro, '%d/%m/%Y') as data_cadastro, 
                    DATE_FORMAT(t1.data_inicio, '%d/%m/%Y') as data_inicio , 
                    DATE_FORMAT(t1.data_fim, '%d/%m/%Y') as data_fim", 
                    'entidade_gestores t1
                        LEFT JOIN servidor t2 ON t1.id_servidor = t2.id
                        LEFT JOIN cargos t3 ON t1.id_cargo = t3.id', $prep, array());
            $result = $select->fetchAll();  //A T E N Ç Ã O !!! AQUI O PDO MONTA UM ARRAY  >>N Ã O<<  ASSOCIATIVO
            echo json_encode($result, JSON_PRETTY_PRINT);
        }
    }

    public function update() {
        $crud = new ClassModel();
        $val = new ClassValidacao();
        $val->set($_POST['id_servidor'], '<b>Funcionario</b>')->obrigatorio();
        $post = filter_var_array($_POST, FILTER_SANITIZE_SPECIAL_CHARS);

        if (!isset($post['ativo'])) {
            $post['ativo'] = 'off';
        }

        if (isset($post['ativo'])) {
            $select = $crud->select('* ', 'entidade_gestores ', 'WHERE id_cargo = '.$_POST['id_cargo'].' and ativo = "on" ', array());
            $result = $select->fetchAll();
            if($result){
                foreach($result as $data){
                    $crud->update('entidade_gestores ', ['ativo' => 'off'], $data['id']);
                }
            }
        }

        if ($val->validar()) {
            $id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);
            $crud->update('entidade_gestores ', $post, $id);
        } else {
            foreach ($val->getErrors() as $erro) {
                echo "$erro <br />";
            }
        }
    }

    public function insert() {
        $crud = new ClassModel();
        $val = new ClassValidacao();
        $val->set($_POST['id_servidor'], '<b>Funcionario</b>')->obrigatorio();
        $post = filter_var_array($_POST, FILTER_SANITIZE_SPECIAL_CHARS);


        if (!isset($post['ativo'])) {
            $post['ativo'] = 'off';
        }

        if (isset($post['ativo'])) {
            $select = $crud->select('* ', 'entidade_gestores ', 'WHERE id_cargo = '.$_POST['id_cargo'].' and ativo = "on" ', array());
            $result = $select->fetchAll();
            if($result){
                foreach($result as $data){
                    $crud->update('entidade_gestores ', ['ativo' => 'off'], $data['id']);
                }
            }
        }

        if ($val->validar()) {
            print $crud->insert($post, 'entidade_gestores ');
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
            $delete = $crud->delete('entidade_gestores ', ' WHERE id=?', array($id));
        } else {
            foreach ($val->getErrors() as $erro) {
                echo "$erro <br />";
            }
        }
    }*/

}
