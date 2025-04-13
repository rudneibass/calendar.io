<?php

session_start();
require_once '../../config/header.php';
require_once '../../app/model/ClassModel.php';
require_once '../../app/model/ClassValidacao.php';

class ControllerPublicacoes {

    function locate() {

        if (isset($_POST['id'])) {

            $prep = "WHERE e.id=" . filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT) . " ";
            $crud = new ClassModel();
            $select = $crud->select('*, e.id as relacionamento  ', 'publicacoes e', $prep, array());
            $result = $select->fetch(\PDO::FETCH_ASSOC); // A T E N Ç Ã O !!! AQUI O PDO MONTA UM ARRAY ASSOCIATIVO.
            echo json_encode($result, JSON_PRETTY_PRINT);
        } else {

            $prep = "WHERE 1=1 "
                    . (isset($_POST["c1"]) && !empty($_POST["c1"]) ? " AND id =" . filter_input(INPUT_POST, 'c1', FILTER_SANITIZE_NUMBER_INT) : "")
                    . (isset($_POST["c2"]) && !empty($_POST["c2"]) ? " AND descricao LIKE '%" . filter_input(INPUT_POST, 'c2', FILTER_SANITIZE_SPECIAL_CHARS) . "%'" : "")
                    . (isset($_POST["c3"]) && !empty($_POST["c3"]) ? " AND data_cadastro BETWEEN '" . filter_input(INPUT_POST, 'c3', FILTER_SANITIZE_SPECIAL_CHARS) . "' AND '" . filter_input(INPUT_POST, 'c4', FILTER_SANITIZE_SPECIAL_CHARS) . "'" : "")
                    . " ORDER BY id DESC";

            $crud = new ClassModel();
            $select = $crud->select("*, DATE_FORMAT(data_publicacao, '%d/%m/%Y') as data_publicacao", 'publicacoes ', $prep, array());
            $result = $select->fetchAll();  //A T E N Ç Ã O !!! AQUI O PDO MONTA UM ARRAY  >>N Ã O<<  ASSOCIATIVO
            echo json_encode($result, JSON_PRETTY_PRINT);
        }
    }

    public function update() {

        $val = new ClassValidacao();
        $val->set($_POST['titulo'], '<b>Título</b>')->obrigatorio();
        $val->set($_POST['tipo'], '<b>Tipo</b>')->obrigatorio();
        $val->set($_POST['data_publicacao'], '<b>Data da Publicação</b>')->obrigatorio();
        $val->set($_POST['id_entidade_orgaos'], '<b>Órgão</b>')->obrigatorio();
        $val->set($_POST['id_mandatos'], '<b>Legislatura/Gestão</b>')->obrigatorio();

        if ($val->validar()) {
            $post = filter_var_array($_POST, FILTER_SANITIZE_SPECIAL_CHARS);
            $post['usuario'] = $_SESSION['USUARIO'];
            $id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);
            $crud = new ClassModel();
            $update = $crud->update('publicacoes ', $post, $id);
        } else {
            foreach ($val->getErrors() as $erro) {
                echo "$erro <br />";
            }
        }
    }

    public function insert() {

        $val = new ClassValidacao();
        $val->set($_POST['titulo'], '<b>Título</b>')->obrigatorio();
        $val->set($_POST['tipo'], '<b>Tipo</b>')->obrigatorio();
        $val->set($_POST['data_publicacao'], '<b>Data da Publicação</b>')->obrigatorio();
        $val->set($_POST['id_entidade_orgaos'], '<b>Órgão</b>')->obrigatorio();
        $val->set($_POST['id_mandatos'], '<b>Gestão/Legislatura</b>')->obrigatorio();
        
        if ($val->validar()) {
            $post = filter_var_array($_POST, FILTER_SANITIZE_SPECIAL_CHARS);
            $post['data_cadastro'] = date("Y/m/d h:i:s");
            $post['usuario'] = $_SESSION['USUARIO'];
            $crud = new ClassModel();
            print $crud->insert($post, 'publicacoes ');
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
            $delete = $crud->delete('publicacoes ', ' WHERE id=?', array($id));
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
                    $post['data_publicacao'] = $item['data'] == 'N/A' ? '0000-00-00': DateTime::createFromFormat('d/m/Y', $item['data'])->format('Y-m-d');
                    $post['numero'] = $item['numero'];
                    $post['titulo'] = $item['descricao'];
                    $post['descricao'] = $item['descricao']; 
                    $post['exercicio'] = date('Y', strtotime($item['data']));                

                    $post['data_cadastro'] = date("Y/m/d h:i:s");
                    $post['usuario'] = $_SESSION['USUARIO'];
                    $post['tbl'] = 'publicacoes';

                    if(isset($item['tipo']) && !empty($item['tipo'])){
                        $post['tipo'] = $item['tipo'];
                    }
                    

                    $db = new ClassModel();
                    $id = $db->insert($post, 'publicacoes ');

                    if($id){
                        $postArquivo['nome'] = $item['arquivo'];
                        $postArquivo['tipo'] = 'application/pdf';
                        $postArquivo['tamanho'] = 'indisponivel';
                        $postArquivo['dominio'] = $item['dominio'];
                        $postArquivo['usuario'] = $_SESSION['USUARIO'];
                        $postArquivo['data'] = date('Y-m-d');
                        $postArquivo['hora'] = date('H:i:s');
                        $postArquivo['hora'] = date('H:i:s');
                        $postArquivo['id_tabela_pai'] = $item['id'];
                        $postArquivo['tabela_pai'] = 'publicacoes';
                        $postArquivo['caminho_absoluto'] = $item['arquivo'];
                        $postArquivo['caminho_relativo'] = $item['arquivo'];

                        if(!is_array($item['arquivos'])){
                            $db->insert($postArquivo, 'arquivos ');
                        }
                        
                        if(is_array($item['arquivos'])){
                            foreach($item['arquivos'] as $arquivo){
                                $postArquivo['caminho_absoluto'] = $arquivo;
                                $postArquivo['caminho_relativo'] = $arquivo;
                                $db->insert($postArquivo, 'arquivos ');
                            }
                        }
                        
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

}
