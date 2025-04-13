<?php

session_start();
require_once '../../config/header.php';
require_once '../../app/model/ClassModel.php';
require_once '../../app/model/ClassValidacao.php';

class ControllerSessoes {

    function locate() {

        if (isset($_POST['id'])) {

            $prep = "WHERE e.id=" . filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT) . " ";
            $crud = new ClassModel();
            $select = $crud->select('*, e.id as relacionamento  ', 'sessoes e', $prep, array());
            $result = $select->fetch(\PDO::FETCH_ASSOC); // A T E N Ç Ã O !!! AQUI O PDO MONTA UM ARRAY ASSOCIATIVO.
            echo json_encode($result, JSON_PRETTY_PRINT);
        } else {

            $prep = "WHERE 1=1 "
                    . (isset($_POST["c1"]) && !empty($_POST["c1"]) ? " AND id =" . filter_input(INPUT_POST, 'c1', FILTER_SANITIZE_NUMBER_INT) : "")
                    . (isset($_POST["c2"]) && !empty($_POST["c2"]) ? " AND nome LIKE '%" . filter_input(INPUT_POST, 'c2', FILTER_SANITIZE_SPECIAL_CHARS) . "%'" : "")
                    . (isset($_POST["c3"]) && !empty($_POST["c3"]) ? " AND data_cadastro BETWEEN '" . filter_input(INPUT_POST, 'c3', FILTER_SANITIZE_SPECIAL_CHARS) . "' AND '" . filter_input(INPUT_POST, 'c4', FILTER_SANITIZE_SPECIAL_CHARS) . "'" : "")
                    . " ORDER BY data DESC";

            $crud = new ClassModel();
            $select = $crud->select("*, DATE_FORMAT(data_cadastro, '%d/%m/%Y') as data_cadastro", 'sessoes ', $prep, array());
            $result = $select->fetchAll();  //A T E N Ç Ã O !!! AQUI O PDO MONTA UM ARRAY  >>N Ã O<<  ASSOCIATIVO
            echo json_encode($result, JSON_PRETTY_PRINT);
        }
    }

    public function update() {

        $val = new ClassValidacao();
        $val->set($_POST['tipo'], '<b>Tipo</b>')->obrigatorio();
        $val->set($_POST['nome'], '<b>Nome</b>')->obrigatorio();
        $val->set($_POST['numero'], '<b>Número</b>')->obrigatorio();
        $val->set($_POST['data'], '<b>Data</b>')->obrigatorio();
        $val->set($_POST['exercicio'], '<b>Exercício</b>')->obrigatorio();
        $val->set($_POST['situacao'], '<b>Situação</b>')->obrigatorio();
        $val->set($_POST['id_mandatos'], '<b>Legislatura</b>')->obrigatorio();

        if ($val->validar()) {
            $post = filter_var_array($_POST, FILTER_SANITIZE_SPECIAL_CHARS);
            $id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);
            $crud = new ClassModel();
            $atualizado = $crud->update('sessoes ', $post, $id);

            if($atualizado){
                $select = $crud->select('*', 'sessoes_membros ', 'WHERE id_sessoes = ?', array($id));
                $result = $select->fetchAll();

                if(count($result) == 0){
                    $select = $crud->select('*', 'servidor ', 'WHERE ativo = "on"', array());
                    $result = $select->fetchAll();
                        
                    foreach($result as $data){
                         $crud->insert(array('id_sessoes' => $id, 'id_servidor' => $data['id'], 'ativo' =>  'on'), 'sessoes_membros ');
                    }
                }
                
            }

        } else {
            foreach ($val->getErrors() as $erro) {
                echo "$erro <br />";
            }
        }
    }

    public function insert() {

        $val = new ClassValidacao();
        $val->set($_POST['tipo'], '<b>Tipo</b>')->obrigatorio();
        $val->set($_POST['nome'], '<b>Nome</b>')->obrigatorio();
        $val->set($_POST['numero'], '<b>Número</b>')->obrigatorio();
        $val->set($_POST['data'], '<b>Data</b>')->obrigatorio();
        $val->set($_POST['exercicio'], '<b>Exercício</b>')->obrigatorio();
        $val->set($_POST['situacao'], '<b>Situação</b>')->obrigatorio();
        $val->set($_POST['id_mandatos'], '<b>Legislatura</b>')->obrigatorio();

        if ($val->validar()) {
            $post = filter_var_array($_POST, FILTER_SANITIZE_SPECIAL_CHARS);
            $post['data_cadastro'] = date("Y/m/d h:i:s");
            $post['usuario'] = $_SESSION['USUARIO'];
            $post['tbl'] = 'sessoes';
            $crud = new ClassModel();
            $sessaoId =  $crud->insert($post, 'sessoes ');

            if($sessaoId){
                $select = $crud->select('*', 'servidor ', 'WHERE ativo = "on"', array());
                $result = $select->fetchAll();

               foreach($result as $data){
                    $crud->insert(array('id_sessoes' => $sessaoId, 'id_servidor' => $data['id'], 'ativo' =>  'on'), 'sessoes_membros ');
               }
            }

            print $sessaoId;

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
            $delete = $crud->delete('sessoes ', ' WHERE id=?', array($id));
        } else {
            foreach ($val->getErrors() as $erro) {
                echo "$erro <br />";
            }
        }
    }*/


    public function getOpenSession(){
        $crud = new ClassModel();
        $select = $crud->select('* ', 'sessoes ', 'WHERE situacao = "Aberta"', array());
        $result = $select->fetch(\PDO::FETCH_ASSOC); // A T E N Ç Ã O !!! AQUI O PDO MONTA UM ARRAY ASSOCIATIVO.
        echo json_encode($result, JSON_PRETTY_PRINT);
    }

    public function abrirSessao(){
        $val = new ClassValidacao();
        $val->set($_POST['id'], '<b>ID do Registro</b>')->obrigatorio();

        if ($val->validar()) {
            
            $databse = new ClassModel();
            $databse->executeQuery("UPDATE sessoes SET situacao = :situacao", array(':situacao' => 'Encerrada'));
            $databse->executeQuery("UPDATE sessoes SET situacao = :situacao WHERE id = :id", array(':situacao' => 'Aberta', ':id' => $_POST['id']));
            
            echo "Operação realizada com sucesso!";

        } else {
            foreach ($val->getErrors() as $erro) {
                echo "$erro <br />";
            }
        }
    }

    public function fecharSessao(){
        $val = new ClassValidacao();
        $val->set($_POST['id'], '<b>ID do Registro</b>')->obrigatorio();

        if ($val->validar()) {
            
            $databse = new ClassModel();
            $databse->executeQuery("UPDATE sessoes SET situacao = 'Encerrada' WHERE id = :id", array(':id' => $_POST['id']));
            
            echo "Operação realizada com sucesso!";

        } else {
            foreach ($val->getErrors() as $erro) {
                echo "$erro <br />";
            }
        }
    }

    public function importarJson() {
        if ($_FILES['jsonFile']['error'] == UPLOAD_ERR_OK) {
            $jsonData = file_get_contents($_FILES['jsonFile']['tmp_name']);
            $jsonData = json_decode($jsonData, true);
          
            $exemplo = '
            "id": "6",
            "data": " 15/02/2016",
            "numero": "LEI MUNICIPAL - FEVEREIRO/2016",
            "descricao": "Descrição  FICA O PODER LEGISLATIVO AUTORIZADO A CONCEDER AUMENTO DO VENCIMENTO-BASE DOS SERVIDORES DA CÂMARA MUNICIPAL DE CEDRO - CEARÁ.",
            "arquivo": "/arquivos/6/Leis_476_2016.pdf"
            "dominio": "https://www.camaradecedro.ce.gov.br"
            ';

            if ($jsonData !== null) {
              
                foreach($jsonData as $item){

                    $post['id'] = $item['id'];
                    $post['data'] = $item['data'] == 'N/A' ? '0000-00-00': DateTime::createFromFormat('d/m/Y', $item['data'])->format('Y-m-d');
                    $post['situacao'] = "Encerrada";
                    $post['nome'] = $item['descricao'];                  
                    $post['numero'] = $item['numero'];

                    $post['data_cadastro'] = date("Y/m/d h:i:s");
                    $post['usuario'] = $_SESSION['USUARIO'];
                    $post['tbl'] = 'sessoes';
                    

                    $db = new ClassModel();
                    $id = $db->insert($post, 'sessoes ');

                    if($id){
                        $postArquivo['nome'] = $item['arquivo'];
                        $postArquivo['tipo'] = 'application/pdf';
                        $postArquivo['tamanho'] = 'indisponivel';
                        $postArquivo['dominio'] = $item['dominio'];
                        $postArquivo['caminho_absoluto'] = $item['arquivo'];
                        $postArquivo['caminho_relativo'] = $item['arquivo'];
                        $postArquivo['usuario'] = $_SESSION['USUARIO'];
                        $postArquivo['data'] = date('Y-m-d');
                        $postArquivo['hora'] = date('H:i:s');
                        $postArquivo['hora'] = date('H:i:s');
                        $postArquivo['id_tabela_pai'] = $item['id'];
                        $postArquivo['tabela_pai'] = 'sessoes';
                        
                        $db->insert($postArquivo, 'arquivos ');
                    }
                }
                echo 'Arquivo importado com sucesso!';
            } else {
              echo "Erro ao decodificar o JSON.";
            }
        } else {
            echo "Erro ao receber o arquivo JSON.";
        }
    }
    /*
    public function importarJson() {
        if ($_FILES['jsonFile']['error'] == UPLOAD_ERR_OK) {
            $jsonData = file_get_contents($_FILES['jsonFile']['tmp_name']);
            $jsonData = json_decode($jsonData, true);
            $db = new ClassModel();

            $exemplo = '
            "id": "10",
            "data": "2016-03-08",
            "status": " ENCERRADA",
            "descricao": "Descrição  05ª (QUINTA) SESSÃO ORDINÁRIA DO 1º PERÍODO LEGISLATIVO DE 2016, EM 08 DE MARÇO DE 2016."
            ';

            if ($jsonData !== null) {
                
                $db->delete('sessoes ', ' ', array());
                
                foreach($jsonData as $item){
                    $post['id'] = $item['id'];
                    $post['data'] = $item['data'] == 'N/A' ? '1989-04-26': $item['data'];
                    $post['situacao'] = $item['status'];
                    $post['nome'] = $item['descricao'];                  

                    $post['data_cadastro'] = date("Y/m/d h:i:s");
                    $post['usuario'] = $_SESSION['USUARIO'];
                    $post['tbl'] = 'sessoes';

                    $id = $db->insert($post, 'sessoes ');
                }

                echo 'Arquivo importado com sucesso!';

            } else {
              echo "Erro ao decodificar o JSON.";
            }
          } else {
            echo "Erro ao receber o arquivo JSON.";
          }
    }*/
}
