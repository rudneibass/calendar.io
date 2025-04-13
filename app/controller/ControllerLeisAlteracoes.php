<?php

session_start();
require_once '../../config/header.php';
require_once '../../app/model/ClassModel.php';
require_once '../../app/model/ClassValidacao.php';

class ControllerLeisAlteracoes {

    function locate() {
        $prep = "WHERE id_lei_alteradora=" . filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT) . " ORDER BY id_lei_alterada DESC";
        $crud = new ClassModel();
        $select = $crud->select("leis_alteracoes.*, leis.descricao ", 'leis_alteracoes LEFT JOIN leis ON leis.id = leis_alteracoes.id_lei_alterada ', $prep, array());
        $result = $select->fetchAll();  //A T E N Ç Ã O !!! AQUI O PDO MONTA UM ARRAY  >>N Ã O<<  ASSOCIATIVO
        echo json_encode($result, JSON_PRETTY_PRINT);
    }

    public function update() {

        $val = new ClassValidacao();
        $val->set($_POST['id_lei_alterada'], '<b>Lei</b>')->obrigatorio();
        $val->set($_POST['id_lei_alteradora'], '<b>Id da lei alteradora</b>')->obrigatorio();

        if ($val->validar()) {
            $post = filter_var_array($_POST, FILTER_SANITIZE_SPECIAL_CHARS);
            $post['usuario'] = $_SESSION['USUARIO'];
            $id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);
            $crud = new ClassModel();
            $update = $crud->update('leis_alteracoes ', $post, $id);
        } else {
            foreach ($val->getErrors() as $erro) {
                echo "$erro <br />";
            }
        }
    }

    public function insert() {

        $val = new ClassValidacao();
        $val->set($_POST['id_lei_alterada'], '<b>Lei</b>')->obrigatorio();
        $val->set($_POST['id_lei_alteradora'], '<b>Id da lei alteradora</b>')->obrigatorio();

        if ($val->validar()) {
            $post = filter_var_array($_POST, FILTER_SANITIZE_SPECIAL_CHARS);
            $post['data_cadastro'] = date("Y/m/d h:i:s");
            $post['usuario'] = $_SESSION['USUARIO'];
            $crud = new ClassModel();
            print $crud->insert($post, 'leis_alteracoes ');
        } else {
            foreach ($val->getErrors() as $erro) {
                echo "$erro <br />";
            }
        }
    }

    public function delete() {

        $val = new ClassValidacao();
        $val->set($_POST['id'], '"Id não Informado"')->obrigatorio();

        var_dump($_POST['id']);

        if ($val->validar()) {
            $id = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT);
            $crud = new ClassModel();
            $delete = $crud->delete('leis_alteracoes ', ' WHERE id=?', array($id));
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

            $exemplo = 
            '"id": "20",
            "data": "29/10/2015",
            "numero": "467",
            "exercicio": "2015",
            "categoria": "leis_alteracoes, ATOS E NORMATIVOS MUNICIPAIS",
            "descricao": "Descrição  DISPÕE SOBRE A ALTERAÇÃO DA REDAÇÃO DO ART. 1º, DA LEI 466/2015 DE 26 DE OUTUBRO DE 2015.",
            "arquivo": "/arquivos/20/leis_alteracoes_467_2015.pdf"
            "dominio": "https://www.camaradecedro.ce.gov.br"';
          
            if ($jsonData !== null) {
              
                foreach($jsonData as $item){
                    $post['id'] = $item['id'];
                    $post['data_lei'] = $item['data'] == 'N/A' ? '0000-00-00': DateTime::createFromFormat('d/m/Y', $item['data'])->format('Y-m-d');
                    $post['numero_lei'] = $item['numero'];
                    $post['exercicio'] = $item['exercicio'];
                    $post['descricao'] = $item['descricao'];

                    $post['data_cadastro'] = date("Y/m/d h:i:s");
                    $post['usuario'] = $_SESSION['USUARIO'];
                    $post['tbl'] = 'leis_alteracoes';

                    $db = new ClassModel();
                    $leiId = $db->insert($post, 'leis_alteracoes ');

                    if($leiId){
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
                        $postArquivo['tabela_pai'] = 'leis_alteracoes';
                        
                        $db->insert($postArquivo, 'arquivos ');
                    }
                }

            } else {
              echo "Erro ao decodificar o JSON.";
            }
          } else {
            echo "Erro ao receber o arquivo JSON.";
          }
    }


}
