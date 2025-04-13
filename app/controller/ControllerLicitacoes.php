<?php

session_start();
require_once '../../config/header.php';
require_once '../../app/model/ClassModel.php';
require_once '../../app/model/ClassValidacao.php';

class ControllerLicitacoes {

    function locate() {

        if (isset($_POST['id'])) {

            $prep = "WHERE e.id=" . filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT) . " ";
            $crud = new ClassModel();
            $select = $crud->select('*, e.id as relacionamento, e.id as tab_3_form_1_relacionamento  ', 'licitacoes e', $prep, array());
            $result = $select->fetch(\PDO::FETCH_ASSOC); // A T E N Ç Ã O !!! AQUI O PDO MONTA UM ARRAY ASSOCIATIVO.
            echo json_encode($result, JSON_PRETTY_PRINT);
        } else {

            $prep = "WHERE 1=1 "
                    . (isset($_POST["c1"]) && !empty($_POST["c1"]) ? " AND id =" . filter_input(INPUT_POST, 'c1', FILTER_SANITIZE_NUMBER_INT) : "")
                    . (isset($_POST["c2"]) && !empty($_POST["c2"]) ? " AND objeto_licitacao LIKE '%" . filter_input(INPUT_POST, 'c2', FILTER_SANITIZE_SPECIAL_CHARS) . "%'" : "")
                    . (isset($_POST["c3"]) && !empty($_POST["c3"]) ? " AND data_cadastro BETWEEN '" . filter_input(INPUT_POST, 'c3', FILTER_SANITIZE_SPECIAL_CHARS) . "' AND '" . filter_input(INPUT_POST, 'c4', FILTER_SANITIZE_SPECIAL_CHARS) . "'" : "")
                    . " ORDER BY id DESC";

            $crud = new ClassModel();
            $select = $crud->select("*, DATE_FORMAT(data_abertura, '%d/%m/%Y') as data_abertura, DATE_FORMAT(data_publicacao_edital, '%d/%m/%Y') as data_publicacao_edital", 'licitacoes ', $prep, array());
            $result = $select->fetchAll();  //A T E N Ç Ã O !!! AQUI O PDO MONTA UM ARRAY  >>N Ã O<<  ASSOCIATIVO
            echo json_encode($result, JSON_PRETTY_PRINT);
        }
    }

    public function update() {

        $val = new ClassValidacao();
        $val->set($_POST['id_entidade_orgaos'], '<b>Órgão</b>')->obrigatorio();
        $val->set($_POST['exercicio'], '<b>Exercício</b>')->obrigatorio();
        $val->set($_POST['processo'], '<b>Processo</b>')->obrigatorio();
        $val->set($_POST['objeto_licitacao'], '<b>Objeto da Licitação</b>')->obrigatorio();
        
        /*
        $val->set($_POST['data_publicacao_aviso'], '<b>Data Pub. Aviso</b>')->obrigatorio();
        $val->set($_POST['data_publicacao_edital'], '<b>Data Pub. Edital</b>')->obrigatorio();
        $val->set($_POST['modalidade'], '<b>Modalidade</b>')->obrigatorio();
        $val->set($_POST['tipo'], '<b>Tipo</b>')->obrigatorio();
        $val->set($_POST['situacao'], '<b>Situação</b>')->obrigatorio();
        $val->set($_POST['local_abertura'], '<b>Local de Abertura</b>')->obrigatorio();
        $val->set($_POST['data_abertura'], '<b>Data Abertura</b>')->obrigatorio();
        $val->set($_POST['hora_abertura'], '<b>Hora Abertura</b>')->obrigatorio();
        $val->set($_POST['pregoeiro_presidente'], '<b>Pregoeiro Presidente</b>')->obrigatorio();
        $val->set($_POST['resp_informacao'], '<b>Responsável pela Informação</b>')->obrigatorio();
        $val->set($_POST['resp_parecer_juridico'], '<b>Responsável pelo Parecer Técnico Jurídico</b>')->obrigatorio();
        $val->set($_POST['resp_adjudicacao'], '<b>Responsável pela Adjudicação</b>')->obrigatorio();
        */

        if ($val->validar()) {
            $post = filter_var_array($_POST, FILTER_SANITIZE_SPECIAL_CHARS);
            $post['usuario'] = $_SESSION['USUARIO'];
            $id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);
            $crud = new ClassModel();
            $update = $crud->update('licitacoes ', $post, $id);
        } else {
            foreach ($val->getErrors() as $erro) {
                echo "$erro <br />";
            }
        }
    }

    public function insert() {

        $val = new ClassValidacao();
        $val->set($_POST['id_entidade_orgaos'], '<b>Órgão</b>')->obrigatorio();
        $val->set($_POST['exercicio'], '<b>Exercício</b>')->obrigatorio();
        $val->set($_POST['processo'], '<b>Processo</b>')->obrigatorio();
        $val->set($_POST['objeto_licitacao'], '<b>Objeto da Licitação</b>')->obrigatorio();
        
        /*
        $val->set($_POST['data_publicacao_aviso'], '<b>Data Pub. Aviso</b>')->obrigatorio();
        $val->set($_POST['data_publicacao_edital'], '<b>Data Pub. Edital</b>')->obrigatorio();
        $val->set($_POST['modalidade'], '<b>Modalidade</b>')->obrigatorio();
        $val->set($_POST['tipo'], '<b>Tipo</b>')->obrigatorio();
        $val->set($_POST['situacao'], '<b>Situação</b>')->obrigatorio();
        $val->set($_POST['local_abertura'], '<b>Local de Abertura</b>')->obrigatorio();
        $val->set($_POST['data_abertura'], '<b>Data Abertura</b>')->obrigatorio();
        $val->set($_POST['hora_abertura'], '<b>Hora Abertura</b>')->obrigatorio();
        $val->set($_POST['pregoeiro_presidente'], '<b>Pregoeiro Presidente</b>')->obrigatorio();
        $val->set($_POST['resp_informacao'], '<b>Responsável pela Informação</b>')->obrigatorio();
        $val->set($_POST['resp_parecer_juridico'], '<b>Responsável pelo Parecer Técnico Jurídico</b>')->obrigatorio();
        $val->set($_POST['resp_adjudicacao'], '<b>Responsável pela Adjudicação</b>')->obrigatorio();
        */

        if ($val->validar()) {
            $post = filter_var_array($_POST, FILTER_SANITIZE_SPECIAL_CHARS);
            $post['data_cadastro'] = date("Y/m/d h:i:s");
            $post['usuario'] = $_SESSION['USUARIO'];
            $crud = new ClassModel();
            print $crud->insert($post, 'licitacoes ');
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
            $delete = $crud->delete('licitacoes ', ' WHERE id=?', array($id));
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
            "id": 5,
            "numero_processo": "005-16-PP-CMC-2016",
            "tipo": "Menor Preço",
            "data_abertura": "2016-02-04",
            "data_publicacao_edital": "2016-01-22",
            "data_publicacao_aviso": "2016-01-22",
            "objeto": "SERVICO DE DIVULGACAO DAS ACOES REALIZADAS PELO PODER LEGISLATIVO MUNICIPAL DE CEDRO."';

            if ($jsonData !== null) {
              
                foreach($jsonData as $item){
                    $post['id'] = $item['id'];
                    $post['tipo'] = "Menor Preço";
                    $post['processo'] = $item['numero_processo'];
                    $post['objeto_licitacao'] = $item['objeto'];
                    
                    if(isset($item['data_abertura']) && !empty($item['data_abertura'])){
                        $post['data_abertura'] = $item['data_abertura'] == 'N/A' ? '0000-00-00': DateTime::createFromFormat('d/m/Y', $item['data_abertura'])->format('Y-m-d');
                        $post['exercicio'] = date('Y', strtotime($item['data_abertura'])); 
                    }
                    if(isset($item['data_publicacao_aviso']) && !empty($item['data_publicacao_aviso'])){
                        $post['data_publicacao_aviso'] =  $item['data_publicacao_aviso'] == 'N/A' ? '0000-00-00': DateTime::createFromFormat('d/m/Y', $item['data_publicacao_aviso'])->format('Y-m-d');
                        $post['exercicio'] = date('Y', strtotime($item['data_publicacao_aviso']));
                    }
                    if(isset($item['data_publicacao_edital']) && !empty($item['data_publicacao_edital'])){
                        $post['data_publicacao_edital'] = $item['data_publicacao_edital'] == 'N/A' ? '0000-00-00': DateTime::createFromFormat('d/m/Y', $item['data_publicacao_edital'])->format('Y-m-d');
                        $post['exercicio'] = date('Y', strtotime($item['data_publicacao_edital'])); 
                    }


                    $post['id_entidade_orgaos'] = '1';
                    $post['data_cadastro'] = date("Y/m/d h:i:s");
                    $post['usuario'] = $_SESSION['USUARIO'];
                    $post['tbl'] = 'licitacoes';

                    $db = new ClassModel();
                    $licitacaoId = $db->insert($post, 'licitacoes ');

                    if($licitacaoId){
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
                        $postArquivo['tabela_pai'] = 'licitacoes';
                        
                        $db->insert($postArquivo, 'arquivos ');
                    }
                }

                echo "Licitações importadas com sucesso";

            } else {
              echo "Erro ao decodificar o JSON.";
            }
          } else {
            echo "Erro ao receber o arquivo JSON.";
          }
    }


}
