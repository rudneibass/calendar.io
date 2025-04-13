<?php
session_start();
require_once '../../app/model/ClassModel.php';
require_once '../../app/model/MasterClassModel.php';

class ControllerVotacao {

    public function login() {

        $cpf = addslashes(filter_input(INPUT_POST, 'cpf', FILTER_SANITIZE_SPECIAL_CHARS));
        $senha = $_POST['senha'];

        if(!$cpf || !$senha){ echo "Insira Cpf e Senha"; die; }

        $databaseAdmin = new MasterClassModel();
        $select = $databaseAdmin->select("*", 'master_usuarios_votacao', 'WHERE cpf = ?', array($cpf));
        $usuario = $select->fetch(\PDO::FETCH_ASSOC);
    
        if(!$usuario){ echo "Não Foi possivel localizar usuário com este Cpf."; die; }

        if($usuario){
            $select = $databaseAdmin->select("*", 'master_entidade', " WHERE sigla ='" . $usuario['sigla'] . "'", array());
            $result = $select->fetch(\PDO::FETCH_ASSOC);
            
            $_SESSION['DB_TYPE'] = $result['db_type'];
            $_SESSION['DB_NAME'] = $result['db_name'];
            $_SESSION['DB_HOST'] = $result['host'];
            $_SESSION['DB_USER'] = $result['user'];
            $_SESSION['DB_PASS'] = $result['pass'];

            $_SESSION['RAZAO_SOCIAL'] = $result['razao_social'];

            $this->outroMetodo($cpf, $senha, $usuario['sigla']);
        }
    }

    
    public function outroMetodo($cpf, $senha){

        $database = new ClassModel();
        $select = $database->select(
            "id, nome, nome_eleitoral, imagem_url " 
            ,"servidor "
            ," WHERE cpf ='" . $cpf . "' and senha = '" .md5($senha) . "'"
            ,array()
        );
        $result = $select->fetch(\PDO::FETCH_ASSOC);
          
        $select = $database->select('caminho_absoluto ', 'arquivos', 'WHERE tabela_pai="logo" AND id in (SELECT max(id) FROM arquivos WHERE tabela_pai = "logo" ) ', array());
        $logo = $select->fetch(\PDO::FETCH_ASSOC);
       
        if ($result) {
	    	$_SESSION['USUARIO_ID'] = $result['id'];
            $_SESSION['USUARIO'] = $result['nome'];
            $_SESSION['USUARIO_NOME'] = $result['nome_eleitoral'];
            $_SESSION['USUARIO_IMAGEM'] = $result['imagem_url'];
            $_SESSION['ENTIDADE_IMAGEM'] = $logo['caminho_absoluto'];
            
            echo "1";
        } else {
            echo "Cpf ou Senha inválidos";
            die;
        }
    }

    public function listaSessoes() {
        $prep = "WHERE 1=1 "
                . (isset($_POST["c1"]) && !empty($_POST["c1"]) ? " AND id =" . filter_input(INPUT_POST, 'c1', FILTER_SANITIZE_NUMBER_INT) : "")
                . (isset($_POST["c2"]) && !empty($_POST["c2"]) ? " AND nome LIKE '%" . filter_input(INPUT_POST, 'c2', FILTER_SANITIZE_SPECIAL_CHARS) . "%'" : "")
                . (isset($_POST["c3"]) && !empty($_POST["c3"]) ? " AND data_cadastro BETWEEN '" . filter_input(INPUT_POST, 'c3', FILTER_SANITIZE_SPECIAL_CHARS) . "' AND '" . filter_input(INPUT_POST, 'c4', FILTER_SANITIZE_SPECIAL_CHARS) . "'" : "")
                . " ORDER BY id DESC";
        $crud = new ClassModel();
        $select = $crud->select("*, DATE_FORMAT(data_cadastro, '%d/%m/%Y') as data_cadastro", 'sessoes ', $prep, array());
        $result = $select->fetchAll();  //A T E N Ç Ã O !!! AQUI O PDO MONTA UM ARRAY  >>N Ã O<<  ASSOCIATIVO
        echo json_encode($result, JSON_PRETTY_PRINT);
    }

}
