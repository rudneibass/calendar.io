<?php

session_start();
require_once '../../config/header.php';
require_once '../../app/model/ClassModel.php';
require_once '../../app/model/ClassValidacao.php';

class ControllerDiarias {

    function locate() {

        if (isset($_POST['id'])) {

            $prep = "WHERE e.id=" . filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT) . " ";
            $crud = new ClassModel();
            $select = $crud->select('*, e.id as relacionamento  ', 'diarias e', $prep, array());
            $result = $select->fetch(\PDO::FETCH_ASSOC); // A T E N Ç Ã O !!! AQUI O PDO MONTA UM ARRAY ASSOCIATIVO.
            echo json_encode($result, JSON_PRETTY_PRINT);
        } else {

            $prep = "WHERE 1=1 "
                    . (isset($_POST["c1"]) && !empty($_POST["c1"]) ? " AND id =" . filter_input(INPUT_POST, 'c1', FILTER_SANITIZE_NUMBER_INT) : "")
                    . (isset($_POST["c2"]) && !empty($_POST["c2"]) ? " AND beneficiario LIKE '%" . filter_input(INPUT_POST, 'c2', FILTER_SANITIZE_SPECIAL_CHARS) . "%'" : "")
                    . (isset($_POST["c3"]) && !empty($_POST["c3"]) ? " AND data_diaria BETWEEN '" . filter_input(INPUT_POST, 'c3', FILTER_SANITIZE_SPECIAL_CHARS) . "' AND '" . filter_input(INPUT_POST, 'c4', FILTER_SANITIZE_SPECIAL_CHARS) . "'" : "")
                    . " ORDER BY id DESC";

            $crud = new ClassModel();
            $select = $crud->select("*, DATE_FORMAT(data_diaria, '%d/%m/%Y') as data_diaria", 'diarias ', $prep, array());
            $result = $select->fetchAll();  //A T E N Ç Ã O !!! AQUI O PDO MONTA UM ARRAY  >>N Ã O<<  ASSOCIATIVO
            echo json_encode($result, JSON_PRETTY_PRINT);
        }
    }

    public function update() {

        $val = new ClassValidacao();
        $val->set($_POST['exercicio'], '<b>Exercício</b>')->obrigatorio();
        $val->set($_POST['data_diaria'], '<b>Data</b>')->obrigatorio();
        $val->set($_POST['numero'], '<b>Número</b>')->obrigatorio();
        $val->set($_POST['beneficiario'], '<b>Beneficiario</b>')->obrigatorio();
        $val->set($_POST['empresa'], '<b>Orgão/Empresa</b>')->obrigatorio();
        $val->set($_POST['cidade'], '<b>Cidade</b>')->obrigatorio();
        $val->set($_POST['uf'], '<b>UF</b>')->obrigatorio();
        $val->set($_POST['quantidade'], '<b>Quantidade</b>')->obrigatorio();
        $val->set($_POST['valor_unitario'], '<b>Vl. Unit.</b>')->obrigatorio();
        $val->set($_POST['valor_total'], '<b>Total</b>')->obrigatorio();
        $val->set($_POST['data_quitacao'], '<b>Data Quitação</b>')->obrigatorio();
        $val->set($_POST['id_mandatos'], '<b>Gestão/Legislatura</b>')->obrigatorio();
        $val->set($_POST['id_entidade_orgaos'], '<b>Órgão</b>')->obrigatorio();
        $val->set($_POST['descricao'], '<b>Descrição</b>')->obrigatorio();
        
        if ($val->validar()) {
            $post = filter_var_array($_POST, FILTER_SANITIZE_SPECIAL_CHARS);
            $post['usuario'] = $_SESSION['USUARIO'];
            $id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);
            $crud = new ClassModel();
            $update = $crud->update('diarias ', $post, $id);
        } else {
            foreach ($val->getErrors() as $erro) {
                echo "$erro <br />";
            }
        }
    }

    public function insert() {

        $val = new ClassValidacao();
        $val->set($_POST['exercicio'], '<b>Exercício</b>')->obrigatorio();
        $val->set($_POST['data_diaria'], '<b>Data</b>')->obrigatorio();
        $val->set($_POST['numero'], '<b>Número</b>')->obrigatorio();
        $val->set($_POST['beneficiario'], '<b>Beneficiario</b>')->obrigatorio();
        $val->set($_POST['empresa'], '<b>Orgão/Empresa</b>')->obrigatorio();
        $val->set($_POST['cidade'], '<b>Cidade</b>')->obrigatorio();
        $val->set($_POST['uf'], '<b>UF</b>')->obrigatorio();
        $val->set($_POST['quantidade'], '<b>Quantidade</b>')->obrigatorio();
        $val->set($_POST['valor_unitario'], '<b>Vl. Unit.</b>')->obrigatorio();
        $val->set($_POST['valor_total'], '<b>Total</b>')->obrigatorio();
        $val->set($_POST['data_quitacao'], '<b>Data Quitação</b>')->obrigatorio();
        $val->set($_POST['id_mandatos'], '<b>Gestão/Legislatura</b>')->obrigatorio();
        $val->set($_POST['id_entidade_orgaos'], '<b>Órgão</b>')->obrigatorio();
        $val->set($_POST['descricao'], '<b>Descrição</b>')->obrigatorio();
        
        if ($val->validar()) {
            $post = filter_var_array($_POST, FILTER_SANITIZE_SPECIAL_CHARS);
            $post['data_cadastro'] = date("Y/m/d h:i:s");
            $post['usuario'] = $_SESSION['USUARIO'];
            $crud = new ClassModel();
            print $crud->insert($post, 'diarias ');
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
            $delete = $crud->delete('diarias ', ' WHERE id=?', array($id));
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
                "id": "288",
                "data": "20/03/2015",
                "agente": "CINTHIA MIKAELLY ALVES MOREIRA",
                "cargo": "PRESIDENTE",
                "descricao": "Descrição: DIÁRIA",
                "empresa": "Órgão/CÂMARA DE CEDRO",
                "cidade": "FORTALEZA",
                "estado": "CE",
                "data_inicio_viagem": "SEM DATA",
                "data_fim_viagem": "SEM DATA",
                "data_quitacao": "20/03/2018",
                "valor_unitario": "200,00",
                "quantidade": "2.00",
                "valor_total": "400,00",
                "arquivo": "N/A"';

            if ($jsonData !== null) {
              
                foreach($jsonData as $item){
                    $post['id'] = $item['id'];
                    $post['data_diaria'] =  $item['data'] == 'N/A' ? '0000-00-00': DateTime::createFromFormat('d/m/Y', $item['data'])->format('Y-m-d');
                    $post['exercicio'] = date('Y', strtotime($item['data'])); 
                    $post['beneficiario'] = $item['agente'];
                    $post['descricao'] = $item['descricao'];
                    $post['empresa'] = $item['empresa'];
                    $post['cidade'] = $item['cidade'];
                    $post['uf'] = $item['estado'];
                    $post['data_quitacao'] = $item['data_quitacao'];
                    $post['valor_unitario'] = $item['valor_unitario'];
                    $post['quantidade'] = $item['quantidade'];
                    $post['valor_total'] = $item['valor_total'];

                    $post['data_cadastro'] = date("Y/m/d h:i:s");
                    $post['usuario'] = $_SESSION['USUARIO'];
                    $post['tbl'] = 'diarias';

                    $db = new ClassModel();
                    $id = $db->insert($post, 'diarias ');

                    if($id){
                        $postArquivo['nome'] = $item['arquivo'];
                        $postArquivo['tipo'] = 'application/pdf';
                        $postArquivo['tamanho'] = 'indisponivel';
                        $postArquivo['dominio'] = 'https://www.camaradecedro.ce.gov.br';
                        $postArquivo['caminho_absoluto'] = 'https://www.camaradecedro.ce.gov.br'.$item['arquivo'];
                        $postArquivo['caminho_relativo'] = $item['arquivo'];
                        $postArquivo['usuario'] = $_SESSION['USUARIO'];
                        $postArquivo['data'] = date('Y-m-d');
                        $postArquivo['hora'] = date('H:i:s');
                        $postArquivo['hora'] = date('H:i:s');
                        $postArquivo['id_tabela_pai'] = $item['id'];
                        $postArquivo['tabela_pai'] = 'diarias';
                        
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


}
