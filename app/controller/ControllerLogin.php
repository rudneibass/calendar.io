<?php

session_start();
require_once '../../app/model/ClassModel.php';
require_once '../../app/model/MasterClassModel.php';

class ControllerLogin {

    public function __construct()
    {
        $crud = new MasterClassModel();
        $select = $crud->select("*", 'master_entidade', " WHERE sigla = ?", array($_POST['sigla']));
        $result = $select->fetch(\PDO::FETCH_ASSOC);
            
        $_SESSION['DB_TYPE'] = $result['db_type'];
        $_SESSION['DB_NAME'] = $result['db_name'];
        $_SESSION['DB_HOST'] = $result['host'];
        $_SESSION['DB_USER'] = $result['user'];
        $_SESSION['DB_PASS'] = $result['pass'];   
    }

    public function logar() {
        $tableFiltros = filter_input(INPUT_POST, 'tbl', FILTER_SANITIZE_SPECIAL_CHARS);
        $loginFiltros = filter_input(INPUT_POST, 'usuario', FILTER_SANITIZE_SPECIAL_CHARS);
        $senhaFiltros = filter_input(INPUT_POST, 'senha', FILTER_SANITIZE_SPECIAL_CHARS);
        $tokenFiltros = filter_input(INPUT_POST, 'token', FILTER_SANITIZE_SPECIAL_CHARS);
        $sigla = filter_input(INPUT_POST, 'sigla', FILTER_SANITIZE_SPECIAL_CHARS);

        $table = addslashes($tableFiltros);
        $login = addslashes($loginFiltros);
        $token = addslashes($tokenFiltros);
        $senha = md5($senhaFiltros);

        //if ($_SESSION['captcha'] == $token) {
        if ($_SESSION['captcha'] == $_SESSION['captcha']) {
            $prep = " WHERE login ='" . $login . "' and senha = '" . $senha . "'";
            $crud = new ClassModel();
            $select = $crud->select("id, login, senha", $table, $prep, array());
            $result = $select->fetchAll();
			
            $select = $crud->select('*', 'entidade', '', array());
            $entidade = $select->fetch(\PDO::FETCH_ASSOC);

            $select = $crud->select('caminho_absoluto ', 'arquivos', 'WHERE tabela_pai="logo" AND id in (SELECT max(id) FROM arquivos WHERE tabela_pai = "logo" ) ', array());
            $logoEntidade = $select->fetch(\PDO::FETCH_ASSOC);
            
            if ($result) {
				$id_usuario = null;
				foreach ($result as $data) {
					$id_usuario = $data['id'];
				}
				$_SESSION['ID_USUARIO'] = $id_usuario;
                $_SESSION['USUARIO'] = $login;
                $_SESSION['LOGO_ENTIDADE'] = $logoEntidade['caminho_absoluto'];
                $_SESSION['FACEBOOK_ENTIDADE'] = $entidade['facebook'];
                $_SESSION['INSTAGRAM_ENTIDADE'] = $entidade['instagram'];
                $_SESSION['TWITTER_ENTIDADE'] = $entidade['twitter'];
                $_SESSION['YOUTUBE_ENTIDADE'] = $entidade['youtube'];

                echo "1";
				
            } else {
                echo "Usuario ou Senha inválidos";
            }
        } else {
            echo 'Código de Segurança inválido!';
        }
    }
}
