<?php

session_start();
require_once '../../config/header.php';
require_once '../../app/model/ClassModel.php';
require_once '../../app/model/ClassValidacao.php';

class ControllerMaterias {

    function locate() {

        if (isset($_POST['id'])) {

            $prep = "WHERE e.id=" . filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT) . " ";
            $crud = new ClassModel();
            $select = $crud->select('*, e.id as relacionamento, e.id as tab_3_form_1_relacionamento  ', 'materias e', $prep, array());
            $result = $select->fetch(\PDO::FETCH_ASSOC); // A T E N Ç Ã O !!! AQUI O PDO MONTA UM ARRAY ASSOCIATIVO.
            echo json_encode($result, JSON_PRETTY_PRINT);
        } else {

            $prep = "WHERE 1=1 "
                    . (isset($_POST["c1"]) && !empty($_POST["c1"]) ? " AND id =" . filter_input(INPUT_POST, 'c1', FILTER_SANITIZE_NUMBER_INT) : "")
                    . (isset($_POST["exercicio"]) && !empty($_POST["exercicio"]) ? " AND exercicio =" . filter_input(INPUT_POST, 'exercicio', FILTER_SANITIZE_NUMBER_INT) : "")
                    . (isset($_POST["numero"]) && !empty($_POST["numero"]) ? " AND numero =" . filter_input(INPUT_POST, 'numero', FILTER_SANITIZE_NUMBER_INT) : "")
                    . (isset($_POST["c2"]) && !empty($_POST["c2"]) ? " AND descricao LIKE '%" . filter_input(INPUT_POST, 'c2', FILTER_SANITIZE_SPECIAL_CHARS) . "%'" : "")
                    . (isset($_POST["c3"]) && !empty($_POST["c3"]) ? " AND data BETWEEN '" . filter_input(INPUT_POST, 'c3', FILTER_SANITIZE_SPECIAL_CHARS) . "' AND '" . filter_input(INPUT_POST, 'c4', FILTER_SANITIZE_SPECIAL_CHARS) . "'" : "")
                    . " ORDER BY id DESC LIMIT 430";

            $crud = new ClassModel();
            $select = $crud->select("*, DATE_FORMAT(data, '%d/%m/%Y') as data", 'materias ', $prep, array());
            $result = $select->fetchAll();  //A T E N Ç Ã O !!! AQUI O PDO MONTA UM ARRAY  >>N Ã O<<  ASSOCIATIVO
            echo json_encode($result, JSON_PRETTY_PRINT);
        }
    }

    public function update() {

        $val = new ClassValidacao();
        $val->set($_POST['tipo'], '<b>Tipo</b>')->obrigatorio();
        $val->set($_POST['exercicio'], '<b>Exercício</b>')->obrigatorio();
        $val->set($_POST['numero'], '<b>Número</b>')->obrigatorio();
        $val->set($_POST['data'], '<b>Data</b>')->obrigatorio();
        $val->set($_POST['descricao'], '<b>Descrição</b>')->obrigatorio();

        if ($val->validar()) {
            $post = filter_var_array($_POST, FILTER_SANITIZE_SPECIAL_CHARS);
            $post['usuario'] = $_SESSION['USUARIO'];
            $id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);
            $crud = new ClassModel();
            $atualizado = $crud->update('materias ', $post, $id);

            if($atualizado){
                $select = $crud->select('*', 'materias_votos ', 'WHERE id_materias = ?', array($id));
                $result = $select->fetchAll();

                if(count($result) == 0){
                    $select = $crud->select('*', 'servidor ', 'WHERE ativo = "on"', array());
                    $result = $select->fetchAll();
                        
                    foreach($result as $data){
                         $crud->insert(array('id_materias' => $id, 'id_servidor' => $data['id']), 'materias_votos ');
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
        $val->set($_POST['exercicio'], '<b>Exercício</b>')->obrigatorio();
        $val->set($_POST['numero'], '<b>Número</b>')->obrigatorio();
        $val->set($_POST['data'], '<b>Data</b>')->obrigatorio();
        $val->set($_POST['descricao'], '<b>Descrição</b>')->obrigatorio();

        if ($val->validar()) {
            $post = filter_var_array($_POST, FILTER_SANITIZE_SPECIAL_CHARS);
            $post['data_cadastro'] = date("Y/m/d h:i:s");
            $post['usuario'] = $_SESSION['USUARIO'];
            $crud = new ClassModel();
            $materiasId = $crud->insert($post, 'materias ');

            if($materiasId){
                $select = $crud->select('*', 'servidor ', 'WHERE ativo = "on"', array());
                $result = $select->fetchAll();

               foreach($result as $data){
                    $crud->insert(array('id_materias' => $materiasId, 'id_servidor' => $data['id']), 'materias_votos ');
               }
            }

            print $materiasId;

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
            $delete = $crud->delete('materias ', ' WHERE id=?', array($id));
        } else {
            foreach ($val->getErrors() as $erro) {
                echo "$erro <br />";
            }
        }
    }*/
    
    public function importarJson() {
        if ($_FILES['jsonFile']['error'] == UPLOAD_ERR_OK) {
            $jsonData = file_get_contents($_FILES['jsonFile']['tmp_name']);
            $jsonData = json_decode($jsonData, true);
          
            $exemplo = '
            "id": "2319",
            "tipo": "MOÇÃO DE PESAR",
            "numero": "188",
            "autor": "GILBERTO BARBOSA DE OLIVEIRA",
            "data": "2023-10-26",
            "vizualizacoes": "N/A",
            "resumo": "MOÇÃO DE PESAR PELO FALECIMENTO DA SENHORA JOSEFA SEVERO DE SOUZA, OCORRIDO NO DIA 19 DE OUTUBRO DE 2023.",
            "arquivo": "/requerimentos/2319/MOCPES_188_2023_0000001.pdf"
            "dominio": "https://www.camaradecedro.ce.gov.br"';

            if ($jsonData !== null) {
              
                foreach($jsonData as $item){
                    $post['id'] = $item['id'];
                    $post['tipo'] = $item['tipo'];
                    $post['numero'] = $item['numero'];
                    //$post['data'] = $item['data'];
                    $post['data'] = $item['data'] == 'N/A' ? '0000-00-00': DateTime::createFromFormat('d/m/Y', $item['data'])->format('Y-m-d');
                    $post['exercicio'] = date('Y', strtotime($item['data']));                    
                    $post['autor'] = $item['autor'];
                    $post['descricao'] = $item['resumo'];
                    $post['situacao'] = "Aprovada";
                    $post['observacao'] = $item['arquivo'];
                    
                    $post['data_cadastro'] = date("Y/m/d h:i:s");
                    $post['usuario'] = $_SESSION['USUARIO'];
                    $post['tbl'] = 'materias';

                    $db = new ClassModel();
                    $materiasId = $db->insert($post, 'materias ');

                    if($materiasId){
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
                        $postArquivo['tabela_pai'] = 'materias';
                        
                        $db->insert($postArquivo, 'arquivos ');
                    }
                }

                echo "Materias importadas com sucesso.";

            } else {
              echo "Erro ao decodificar o JSON.";
            }
          } else {
            echo "Erro ao receber o arquivo JSON.";
          }
    }


    public function importarJsonFases() {
        if ($_FILES['jsonFile']['error'] == UPLOAD_ERR_OK) {
            $jsonData = file_get_contents($_FILES['jsonFile']['tmp_name']);
            $jsonData = json_decode($jsonData, true);
          
            $exemplo = 
            '"data": "06/05/2016",
            "sessao": "14ª (Décima Quarta) Sessão Ordinária do 1º Período Legislativo de 2016, em 06 de Maio de 2016. mais",
            "expediente": "ORDEM DO DIA",
            "fase": "1ª VOTAÇÃO",
            "situacao": "Favorável",
            "observacao": "14ª SESSÃO ORDINÁRIA – 06 DE MAIO DE 2016",
            "id_materias": "1"';

            if ($jsonData !== null) {
              
                foreach($jsonData as $item){
                    $post['id_materias'] = $item['id_materias'];
                    $post['fase'] = $item['fase'];
                    $post['situacao'] = $item['situacao'];
                    $post['data_fase'] = date('Y-m-d', strtotime($item['data']));
                    $post['sessao'] = $item['sessao'];
                    $post['expediente'] = $item['expediente'];
                    $post['observacao'] = $item['observacao'];

                    $db = new ClassModel();
                    $db->insert($post, 'materias_fases ');
                }
                echo "Fases importadas com sucesso!";

            } else {
              echo "Erro ao decodificar o JSON.";
            }
          } else {
            echo "Erro ao receber o arquivo JSON.";
          }
    }
    
}
