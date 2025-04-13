<?php

session_start();
require_once '../../config/header.php';
require_once '../../app/model/ClassModel.php';
require_once '../../app/model/ClassValidacao.php';

class ControllerUsuarios {

    function teste() {
        echo 'function teste() Usiarios Controller';
    }

    function locate() {

        if (isset($_POST['id'])) {
            $prep = "WHERE id=" . filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT) . " ";
            $crud = new ClassModel();
            $select = $crud->select('*', 'usuarios ', $prep, array());
            $result = $select->fetch(\PDO::FETCH_ASSOC); // A T E N Ç Ã O !!! AQUI O PDO MONTA UM ARRAY ASSOCIATIVO.
            echo json_encode($result, JSON_PRETTY_PRINT);
        } else {

            $prep = "WHERE id <> 999 "
                    . (isset($_POST["c1"]) && !empty($_POST["c1"]) ? " AND id =" . filter_input(INPUT_POST, 'c1', FILTER_SANITIZE_NUMBER_INT) : "")
                    . (isset($_POST["c2"]) && !empty($_POST["c2"]) ? " AND nome LIKE '%" . filter_input(INPUT_POST, 'c2', FILTER_SANITIZE_SPECIAL_CHARS) . "%'" : "")
                    . (isset($_POST["c3"]) && !empty($_POST["c3"]) ? " AND login LIKE '%" . filter_input(INPUT_POST, 'c3', FILTER_SANITIZE_SPECIAL_CHARS) . "%'" : "")
                    . (isset($_POST["c4"]) && !empty($_POST["c4"]) ? " AND email LIKE '%" . filter_input(INPUT_POST, 'c4', FILTER_SANITIZE_SPECIAL_CHARS) . "%'" : "")
                    . " ORDER BY id DESC";

            $crud = new ClassModel();
            $select = $crud->select('*', 'usuarios ', $prep, array());
            $result = $select->fetchAll();  //A T E N Ç Ã O !!! AQUI O PDO MONTA UM ARRAY  >>N Ã O<<  ASSOCIATIVO
            echo json_encode($result, JSON_PRETTY_PRINT);
        }
    }

    public function update() {

        $val = new ClassValidacao();
        $val->set($_POST['nome'], '"Nome"')->obrigatorio();
        $val->set($_POST['login'], '"Login"')->obrigatorio();
        $val->set($_POST['tipo'], '"Tipo"')->obrigatorio();
        $val->set($_POST['ativo'], '"Ativo?"')->obrigatorio();
        $val->set($_POST['senha'], '"Senha"')->obrigatorio();
        $val->set($_POST['confirma_senha'], '"Confirmar Senha"')->obrigatorio();
        $val->set($_POST['captcha'], '"Código de Segurança"')->obrigatorio();
        $val->confirmaSenha($_POST['senha'], $_POST['confirma_senha']);

        $post = filter_var_array($_POST, FILTER_SANITIZE_SPECIAL_CHARS);

        //CRIPTOGRAFA A SENHA CASO O USUARIO TENHA INSERIDO UMA NOVA SENHA
        if (!empty($_POST['senha']) && !empty($_POST['confirma_senha'])) {
            $senha = md5($_POST['senha']);
            $post['senha'] = $senha;
            $confirmaSenha = md5($_POST['confirma_senha']);
            $post['confirma_senha'] = $confirmaSenha;
        }

        //FUNÇÃO ARRAY_POP() REMOVE A ULTIMA POSIÇÃO DO ARRAY, NO CASO, O CAPTCHA
        array_pop($post);



        if ($val->validar()) {
            #session_start();
            if ($_SESSION['captcha'] == $_POST['captcha']) {
                $id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);
                $crud = new ClassModel();
                $update = $crud->update('usuarios ', $post, $id);
            } else {
                echo 'Código de Segurança Invalido, tente novamente!';
            }
        } else {
            foreach ($val->getErrors() as $erro) {
                echo "$erro <br />";
            }
        }
    }

    public function insert() {

        $val = new ClassValidacao();
        $val->set($_POST['nome'], '"Nome"')->obrigatorio();
        $val->set($_POST['login'], '"Login"')->obrigatorio();
        $val->set($_POST['tipo'], '"Tipo"')->obrigatorio();
        $val->set($_POST['ativo'], '"Ativo?"')->obrigatorio();
        $val->set($_POST['senha'], '"Senha"')->obrigatorio();
        $val->set($_POST['confirma_senha'], '"Confirmar Senha"')->obrigatorio();
        $val->set($_POST['captcha'], '"Código de Segurança"')->obrigatorio();
        $val->confirmaSenha($_POST['senha'], $_POST['confirma_senha']);

        $table = filter_input(INPUT_POST, 'tbl', FILTER_SANITIZE_SPECIAL_CHARS);
        $data_cadastro = date("Y/m/d h:i:s");
        $nome = filter_input(INPUT_POST, 'nome', FILTER_SANITIZE_SPECIAL_CHARS);
        $login = filter_input(INPUT_POST, 'login', FILTER_SANITIZE_SPECIAL_CHARS);
        $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_SPECIAL_CHARS);
        $ativo = filter_input(INPUT_POST, 'ativo', FILTER_SANITIZE_SPECIAL_CHARS);
        $tipo = filter_input(INPUT_POST, 'tipo', FILTER_SANITIZE_SPECIAL_CHARS);
        $senha = md5(filter_input(INPUT_POST, 'senha', FILTER_SANITIZE_SPECIAL_CHARS));
        $confirma_senha = md5(filter_input(INPUT_POST, 'confirma_senha', FILTER_SANITIZE_SPECIAL_CHARS));
        $usuario = $_SESSION['USUARIO'];
        
        $post = ['tbl' => $table, 'data_cadastro' => $data_cadastro, 'nome' => $nome, 
                'login' => $login, 'email' => $email, 'ativo' => $ativo, 'tipo' => $tipo, 
                'senha' => $senha, 'confirma_senha' => $confirma_senha, 'usuario' => $usuario
                ];
      
        if ($val->validar()) {
            #session_start();
            if ($_SESSION['captcha'] == $_POST['captcha']) {
                $crud = new ClassModel();
                $crud->Insert($post, 'usuarios');
            } else {
                echo 'Código de segurança inválido, tente novamente!';
            }
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
            $delete = $crud->delete('usuarios', ' WHERE id=?', array($id));
        } else {
            foreach ($val->getErrors() as $erro) {
                echo "$erro <br />";
            }
        }
    }

}
