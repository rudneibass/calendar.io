<?php

session_start();
require_once '../../config/header.php';
require_once '../../app/model/ClassModel.php';
require_once '../../app/model/ClassValidacao.php';

class ControllerOpcoesTabelasColunas {

    function locate() {
        if (isset($_POST['id']) && !empty($_POST['id'])) {

            $prep = "WHERE id=" . filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT) . " ";
            $crud = new ClassModel();
            $select = $crud->select('* ', 'opcoes_tabelas_colunas ', $prep, array());
            $result = $select->fetch(\PDO::FETCH_ASSOC); // A T E N Ç Ã O !!! AQUI O PDO MONTA UM ARRAY ASSOCIATIVO.

            if($result['ativo'] == 'S'){
                $result['ativo'] = 'on';
            }
            if($result['ativo'] == 'N'){
                $result['ativo'] = 'off';
            }

            echo json_encode($result, JSON_PRETTY_PRINT);
        } else {

            $prep = "WHERE 1=1 "
                    . (isset($_POST["codigo"]) && !empty($_POST["codigo"]) ? " AND id = " . filter_input(INPUT_POST, 'codigo', FILTER_SANITIZE_NUMBER_INT) : "")
                    . (isset($_POST["tabela"]) && !empty($_POST["tabela"]) ? " AND tabela LIKE '%" . filter_input(INPUT_POST, 'tabela', FILTER_SANITIZE_SPECIAL_CHARS) . "%'" : "")
                    . (isset($_POST["coluna"]) && !empty($_POST["coluna"]) ? " AND coluna LIKE '%" . filter_input(INPUT_POST, 'coluna', FILTER_SANITIZE_SPECIAL_CHARS) . "%'" : "")
                    . (isset($_POST["nome"]) && !empty($_POST["nome"]) ? " AND nome LIKE '%" . filter_input(INPUT_POST, 'nome', FILTER_SANITIZE_SPECIAL_CHARS) . "%'" : "")
                    . " ORDER BY tabela, coluna, nome";

            $crud = new ClassModel();
            $select = $crud->select("* ", 'opcoes_tabelas_colunas ', $prep, array());
            $result = $select->fetchAll();  //A T E N Ç Ã O !!! AQUI O PDO MONTA UM ARRAY  >>N Ã O<<  ASSOCIATIVO
            echo json_encode($result, JSON_PRETTY_PRINT);
        }
    }

    public function update() {

        $val = new ClassValidacao();
        $val->set($_POST['tabela'], '<b>Tabela</b>')->obrigatorio();
        $val->set($_POST['coluna'], '<b>Coluna</b>')->obrigatorio();
        $val->set($_POST['nome'], '<b>Nome</b>')->obrigatorio();

        if ($val->validar()) {
            $crud = new ClassModel();
            $post = filter_var_array($_POST, FILTER_SANITIZE_SPECIAL_CHARS);
            $id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);
            if (!isset($post['ativo'])) {
                $post['ativo'] = 'N';
            }
            if (isset($post['ativo'])) {
                $post['ativo'] = 'S';
            }
            $crud->update('opcoes_tabelas_colunas ', $post, $id);
        } else {
            foreach ($val->getErrors() as $erro) {
                echo "$erro <br />";
            }
        }
    }

    public function insert() {

        $val = new ClassValidacao();
        $val->set($_POST['tabela'], '<b>Tabela</b>')->obrigatorio();
        $val->set($_POST['coluna'], '<b>Coluna</b>')->obrigatorio();
        $val->set($_POST['nome'], '<b>Nome</b>')->obrigatorio();
        
        if ($val->validar()) {
            $crud = new ClassModel();
            $post = filter_var_array($_POST, FILTER_SANITIZE_SPECIAL_CHARS);
            if (!isset($post['ativo'])) {
                $post['ativo'] = 'N';
            }
            if (isset($post['ativo'])) {
                $post['ativo'] = 'S';
            }
            print $crud->insert($post, 'opcoes_tabelas_colunas ');
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
            $crud->delete('opcoes_tabelas_colunas ', ' WHERE id=?', array($id));
        } else {
            foreach ($val->getErrors() as $erro) {
                echo "$erro <br />";
            }
        }
    }*/

}
