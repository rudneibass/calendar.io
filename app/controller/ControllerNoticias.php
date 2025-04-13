<?php

session_start();
require_once '../../config/header.php';
require_once '../../app/model/ClassModel.php';
require_once '../../app/model/ClassValidacao.php';

class ControllerNoticias {

    function teste() {
        echo 'function teste() Noticias Controller';
    }

    function locate() {

        if (isset($_POST['id'])) {

            $prep = "WHERE id=" . filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT) . " ";
            $crud = new ClassModel();
            $select = $crud->select("* ", 'noticias ', $prep, array());
            $result = $select->fetch(\PDO::FETCH_ASSOC); // A T E N Ç Ã O !!! AQUI O PDO MONTA UM ARRAY ASSOCIATIVO.
            echo json_encode($result, JSON_PRETTY_PRINT);
        } else {

            $prep = "WHERE 1=1 "
                    . (isset($_POST["id"]) && !empty($_POST["c1"]) ? " AND id =" . filter_input(INPUT_POST, 'c1', FILTER_SANITIZE_NUMBER_INT) : "")
                    . (isset($_POST["c2"]) && !empty($_POST["c2"]) ? " AND (descricao LIKE '%" . filter_input(INPUT_POST, 'c2', FILTER_SANITIZE_SPECIAL_CHARS) . "%' OR titulo LIKE '%" . filter_input(INPUT_POST, 'c2', FILTER_SANITIZE_SPECIAL_CHARS) . "%')" : "")
                    . (isset($_POST["c3"]) && !empty($_POST["c3"]) ? " AND data_noticia BETWEEN '" . filter_input(INPUT_POST, 'c3', FILTER_SANITIZE_SPECIAL_CHARS) . "' AND '" . filter_input(INPUT_POST, 'c4', FILTER_SANITIZE_SPECIAL_CHARS) . "'" : "")
                    . " ORDER BY data_noticia DESC";

            $crud = new ClassModel();
            $select = $crud->select("* , DATE_FORMAT(data_noticia, '%d/%m/%Y') as data_noticia_pt_br", 'noticias ', $prep, array());
            $result = $select->fetchAll();  //A T E N Ç Ã O !!! AQUI O PDO MONTA UM ARRAY  >>N Ã O<<  ASSOCIATIVO
            echo json_encode($result, JSON_PRETTY_PRINT);
        }
    }

    public function update() {

        $val = new ClassValidacao();
        $val->set($_POST['titulo'], 'Titulo')->obrigatorio();
        $val->set($_POST['resumo'], 'Resumo')->obrigatorio();
        $val->set($_POST['descricao'], 'Descrição')->obrigatorio();
        $val->set($_POST['data_noticia'], 'Data da Notícia')->obrigatorio();

        $post = $_POST;

        if ($val->validar()) {
            $id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);
            $crud = new ClassModel();
            $update = $crud->update('noticias ', $post, $id);
        } else {
            foreach ($val->getErrors() as $erro) {
                echo "$erro <br />";
            }
        }
    }

    public function insert() {

        $val = new ClassValidacao();
        $val->set($_POST['titulo'], 'Titulo')->obrigatorio();
        $val->set($_POST['resumo'], 'Resumo')->obrigatorio();
        $val->set($_POST['descricao'], 'Descrição')->obrigatorio();
        $val->set($_POST['data_noticia'], 'Data da Notícia')->obrigatorio();

        if ($val->validar()) {
            $post = $_POST;
            $post['data_cadastro'] = date("Y/m/d h:i:s");
            $post['usuario'] = $_SESSION['USUARIO'];
            $crud = new ClassModel();
            print $crud->Insert($post, 'noticias');
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
            $delete = $crud->delete('noticias', ' WHERE id=?', array($id));
        } else {
            foreach ($val->getErrors() as $erro) {
                echo "$erro <br />";
            }
        }
    }*/


    public function ativarTodos() {
        $database = new ClassModel();
        $database->executeQuery("UPDATE noticias SET ativo = :ativo", array(':ativo' => 'S'));
        echo json_encode(
            array(
                'status' => 200,
                'message' => 'Operação realizada com sucesso'
            )
        );
    }

    public function desativarTodos() {
        $database = new ClassModel();
        $database->executeQuery("UPDATE noticias SET ativo = :ativo", array(':ativo' => 'N'));
        echo json_encode(
            array(
                'status' => 200,
                'message' => 'Operação realizada com sucesso'
            )
        );
    }

     public function ativar() {

        $val = new ClassValidacao();
        $val->set($_POST['id'], 'ID')->obrigatorio();

        if ($val->validar()) {
            $database = new ClassModel();
            $database->executeQuery("UPDATE noticias SET ativo = :ativo WHERE id = :id", array(':ativo' => 'S', ':id' => $_POST['id']));
            echo json_encode(
                array(
                    'status' => 200,
                    'message' => 'Operação realizada com sucesso'
                )
            );
        } else {
            foreach ($val->getErrors() as $erro) {
                echo "$erro <br />";
            }
        }
    }

    public function desativar() {
        
        $val = new ClassValidacao();
        $val->set($_POST['id'], 'ID')->obrigatorio();

        if ($val->validar()) {
            $database = new ClassModel();
            $database->executeQuery("UPDATE noticias SET ativo = :ativo WHERE id = :id", array(':ativo' => 'N', ':id' => $_POST['id']));
            echo json_encode(
                array(
                    'status' => 200,
                    'message' => 'Operação realizada com sucesso'
                )
            );
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
            "id": "2",
            "data": "2016-05-04",
            "titulo": "Vereadora Silvana Leite elogia 2º CICLOSESC",
            "resumo": "NULL",
            "descricao": "Na reunião da Câmara Municipal de Cedro, nesta terça-feira, 03, a vereadora Silvana Maria Coelho Leite Pinheiro usou a tribuna e fez um relato do 2º CICLOSESC, acontecido no dia 1º de maio, Dia do Trabalho, destacando o sucesso do evento. Ele parabenizou o secretário de Esportes, Clériton Junior, e solicitou Moção de Congratulação para o mesmo.\n\r\nSilvana Leite destacou a presença e o apoio do prefeito da cidade, Nilson Diniz (PDT), e da primeira-dama, Ana Clécia, para o sucesso do evento.\n\r\nA vereadora falou sobre a visita que fez à comunidade de Mundo Movo, no distrito de Várzea da Conceição, na Igreja de Nossa Senhora de Fátima, ressaltando o brilhantismo do terço dos homens e solicitando Moção de Congratulação para a comunidade.Silvana Leite enalteceu o trabalho do padre Walisson.\n\r\nA vereadora apresentou votos de pêsames aos familiares do saudoso Rogério, do saudoso João Gonçalves da Costa e do saudoso jovem Daví e finalizou reforçando o pedido de melhoramentos na praça José Guedes, no bairro Alto do Padeiro.",
            "imagem": "/fotos/2/Img0_600x400.jpg"';
          
            if ($jsonData !== null) {
              
                foreach($jsonData as $item){
                    $post['id'] = $item['id'];
                    $post['data_noticia'] = $item['data'];
                    $post['titulo'] = $item['titulo'];
                    $post['resumo'] = $item['resumo'];
                    $post['descricao'] = $item['descricao'];
                    $post['imagem_url'] = 'https://www.camaradecedro.ce.gov.br'.$item['imagem'];
                    $post['imagem_nome'] = $item['imagem'];
                    
                    $post['data_cadastro'] = date("Y/m/d h:i:s");
                    $post['usuario'] = $_SESSION['USUARIO'];
                    $post['tbl'] = 'noticias';

                    $db = new ClassModel();
                    $materiasId = $db->insert($post, 'noticias ');

                    if($materiasId){
                        $postArquivo['nome'] = $item['imagem'];
                        $postArquivo['tipo'] = 'image';
                        $postArquivo['tamanho'] = 'indisponivel';
                        $postArquivo['dominio'] = 'https://www.camaradecedro.ce.gov.br';
                        $postArquivo['caminho_absoluto'] = 'https://www.camaradecedro.ce.gov.br'.$item['imagem'];
                        $postArquivo['caminho_relativo'] = $item['imagem'];
                        $postArquivo['usuario'] = $_SESSION['USUARIO'];
                        $postArquivo['data'] = date('Y-m-d');
                        $postArquivo['hora'] = date('H:i:s');
                        $postArquivo['hora'] = date('H:i:s');
                        $postArquivo['id_tabela_pai'] = $item['id'];
                        $postArquivo['tabela_pai'] = 'noticias';
                        
                        $db->insert($postArquivo, 'arquivos ');
                    }
                }

                echo 'Noticias Importadas com sucesso!';
                
            } else {
              echo "Erro ao decodificar o JSON.";
            }
          } else {
            echo "Erro ao receber o arquivo JSON.";
          }
    }

}
