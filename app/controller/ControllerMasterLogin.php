<?php

require_once '../../app/model/MasterClassModel.php';

class ControllerMasterLogin {

    public function logar() {
        session_start();
        $loginFiltros = filter_input(INPUT_POST, 'usuario', FILTER_SANITIZE_SPECIAL_CHARS);
        $senhaFiltros = filter_input(INPUT_POST, 'senha', FILTER_SANITIZE_SPECIAL_CHARS);
        $tokenFiltros = filter_input(INPUT_POST, 'token', FILTER_SANITIZE_SPECIAL_CHARS);

        $login = addslashes($loginFiltros);
        $token = addslashes($tokenFiltros);
        $senha = md5($senhaFiltros);

        if ($_SESSION['captcha'] == $token) {
            $prep = " WHERE login ='" . $login . "' and senha = '" . $senha . "'";
            $crud = new MasterClassModel();
            $select = $crud->select("login, senha", 'master_usuarios', $prep, array());
            $result = $select->fetchAll();

            if ($result) {

                $_SESSION['USUARIO'] = $login;
                echo "1";
            } else {
                echo "Usuario ou Senha inválidos";
            }
        } else {
            echo 'Código de Segurança inválido!';
        }
    }

}
