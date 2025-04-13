<?php

session_start();
require_once '../../config/header.php';
require_once '../../app/model/ClassModel.php';
require_once '../../app/model/ClassValidacao.php';

class ControllerConvenios {

    function locate() {

        if (isset($_POST['id'])) {

            $prep = "WHERE e.id=" . filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT) . " ";
            $crud = new ClassModel();
            $select = $crud->select('*, e.id as relacionamento  ', 'convenios e', $prep, array());
            $result = $select->fetch(\PDO::FETCH_ASSOC); // A T E N Ç Ã O !!! AQUI O PDO MONTA UM ARRAY ASSOCIATIVO.
            echo json_encode($result, JSON_PRETTY_PRINT);
        } else {

            $prep = "WHERE 1=1 "
                    . (isset($_POST["c1"]) && !empty($_POST["c1"]) ? " AND id =" . filter_input(INPUT_POST, 'c1', FILTER_SANITIZE_NUMBER_INT) : "")
                    . (isset($_POST["c2"]) && !empty($_POST["c2"]) ? " AND objeto LIKE '%" . filter_input(INPUT_POST, 'c2', FILTER_SANITIZE_SPECIAL_CHARS) . "%'" : "")
                    . (isset($_POST["c3"]) && !empty($_POST["c3"]) ? " AND data_celebracao BETWEEN '" . filter_input(INPUT_POST, 'c3', FILTER_SANITIZE_SPECIAL_CHARS) . "' AND '" . filter_input(INPUT_POST, 'c4', FILTER_SANITIZE_SPECIAL_CHARS) . "'" : "")
                    . " ORDER BY data_cadastro";

            $crud = new ClassModel();
            $select = $crud->select("*, DATE_FORMAT(data_publicacao, '%d/%m/%Y') as data_publocacao", 'convenios ', $prep, array());
            $result = $select->fetchAll();  //A T E N Ç Ã O !!! AQUI O PDO MONTA UM ARRAY  >>N Ã O<<  ASSOCIATIVO
            echo json_encode($result, JSON_PRETTY_PRINT);
        }
    }

    public function update() {

        $val = new ClassValidacao();
        $val->set($_POST['numero'], '<b>Número</b>')->obrigatorio();
        $val->set($_POST['id_mandatos'], '<b>Mandato</b>')->obrigatorio();
        $val->set($_POST['id_entidade_orgaos'], '<b></b>')->obrigatorio();
        $val->set($_POST['exercicio'], '<b>Exercício</b>')->obrigatorio();
        $val->set($_POST['numero'], '<b>Número</b>')->obrigatorio();
        $val->set($_POST['tipo'], '<b>Tipo</b>')->obrigatorio();
        $val->set($_POST['esfera'], '<b>Esfera</b>')->obrigatorio();
        $val->set($_POST['data_publicacao'], '<b>Data Publicação</b>')->obrigatorio();
        $val->set($_POST['data_celebracao'], '<b>Data Celebração</b>')->obrigatorio();
        $val->set($_POST['concedente_nome'], '<b>Consedente</b>')->obrigatorio();
        $val->set($_POST['concedente_responsavel'], '<b>Responsável Pelo Concedente</b>')->obrigatorio();
        $val->set($_POST['conveniente_nome'], '<b>Conveniente</b>')->obrigatorio();
        $val->set($_POST['conveniente_responsavel'], '<b>Responsável Pelo Conveniênte</b>')->obrigatorio();
        $val->set($_POST['contrapartida'], '<b>Contrapartida</b>')->obrigatorio();
        $val->set($_POST['transferencia'], '<b>Transferência</b>')->obrigatorio();
        $val->set($_POST['pactuado'], '<b>pactuado</b>')->obrigatorio();
        $val->set($_POST['objeto'], '<b>objeto</b>')->obrigatorio();
        $val->set($_POST['justificativa'], '<b>justificativa</b>')->obrigatorio();

        
        if ($val->validar()) {
            $post = filter_var_array($_POST, FILTER_SANITIZE_SPECIAL_CHARS);
            $post['usuario'] = $_SESSION['USUARIO'];
            $id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);
            $crud = new ClassModel();
            $update = $crud->update('convenios ', $post, $id);
        } else {
            foreach ($val->getErrors() as $erro) {
                echo "$erro <br />";
            }
        }
    }

    public function insert() {

        $val = new ClassValidacao();
        $val->set($_POST['numero'], '<b>Número</b>')->obrigatorio();
        $val->set($_POST['id_mandatos'], '<b>Mandato</b>')->obrigatorio();
        $val->set($_POST['id_entidade_orgaos'], '<b></b>')->obrigatorio();
        $val->set($_POST['exercicio'], '<b>Exercício</b>')->obrigatorio();
        $val->set($_POST['numero'], '<b>Número</b>')->obrigatorio();
        $val->set($_POST['tipo'], '<b>Tipo</b>')->obrigatorio();
        $val->set($_POST['esfera'], '<b>Esfera</b>')->obrigatorio();
        $val->set($_POST['data_publicacao'], '<b>Data Publicação</b>')->obrigatorio();
        $val->set($_POST['data_celebracao'], '<b>Data Celebração</b>')->obrigatorio();
        $val->set($_POST['concedente_nome'], '<b>Consedente</b>')->obrigatorio();
        $val->set($_POST['concedente_responsavel'], '<b>Responsável Pelo Concedente</b>')->obrigatorio();
        $val->set($_POST['conveniente_nome'], '<b>Conveniente</b>')->obrigatorio();
        $val->set($_POST['conveniente_responsavel'], '<b>Responsável Pelo Conveniênte</b>')->obrigatorio();
        $val->set($_POST['contrapartida'], '<b>Contrapartida</b>')->obrigatorio();
        $val->set($_POST['transferencia'], '<b>Transferência</b>')->obrigatorio();
        $val->set($_POST['pactuado'], '<b>pactuado</b>')->obrigatorio();
        $val->set($_POST['objeto'], '<b>objeto</b>')->obrigatorio();
        $val->set($_POST['justificativa'], '<b>justificativa</b>')->obrigatorio();


        if ($val->validar()) {

            $post = filter_var_array($_POST, FILTER_SANITIZE_SPECIAL_CHARS);
            $post['tbl'] = "convenios";
            $post['data_cadastro'] = date("Y/m/d h:i:s");
            $post['usuario'] = $_SESSION['USUARIO'];

            $crud = new ClassModel();
            print $crud->insert($post, 'convenios ');
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
            $delete = $crud->delete('convenios ', ' WHERE id=?', array($id));
        } else {
            foreach ($val->getErrors() as $erro) {
                echo "$erro <br />";
            }
        }
    }*/

}
