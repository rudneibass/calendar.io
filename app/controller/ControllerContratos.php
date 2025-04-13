<?php

session_start();
require_once '../../config/header.php';
require_once '../../app/model/ClassModel.php';
require_once '../../app/model/ClassValidacao.php';

class ControllerContratos {

    function locate() {

        if (isset($_POST['id'])) {

            $prep = "WHERE c.id=" . filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT) . " ";
            $crud = new ClassModel();
            $select = $crud->select('c.*, c.id as relacionamento, l.processo as exibe_descricao', 'contratos c LEFT JOIN licitacoes l ON c.numero_licitacao = l.id', $prep, array());
            $result = $select->fetch(\PDO::FETCH_ASSOC); // A T E N Ç Ã O !!! AQUI O PDO MONTA UM ARRAY ASSOCIATIVO.
            echo json_encode($result, JSON_PRETTY_PRINT);
        } else {

            $prep = "WHERE 1=1 "
                    . (isset($_POST["c1"]) && !empty($_POST["c1"]) ? " AND id =" . filter_input(INPUT_POST, 'c1', FILTER_SANITIZE_NUMBER_INT) : "")
                    . (isset($_POST["c2"]) && !empty($_POST["c2"]) ? " AND credor LIKE '%" . filter_input(INPUT_POST, 'c2', FILTER_SANITIZE_SPECIAL_CHARS) . "%'" : "")
                    . (isset($_POST["c3"]) && !empty($_POST["c3"]) ? " AND data_cadastro BETWEEN '" . filter_input(INPUT_POST, 'c3', FILTER_SANITIZE_SPECIAL_CHARS) . "' AND '" . filter_input(INPUT_POST, 'c4', FILTER_SANITIZE_SPECIAL_CHARS) . "'" : "")
                    . " ORDER BY id DESC";

            $crud = new ClassModel();
            $select = $crud->select("*, DATE_FORMAT(data_cadastro, '%d/%m/%Y') as data_cadastro, DATE_FORMAT(data_contrato, '%d/%m/%Y') as data_contrato", 'contratos ', $prep, array());
            $result = $select->fetchAll();  //A T E N Ç Ã O !!! AQUI O PDO MONTA UM ARRAY  >>N Ã O<<  ASSOCIATIVO
            echo json_encode($result, JSON_PRETTY_PRINT);
        }
    }

    public function update() {

        $val = new ClassValidacao();
        $val->set($_POST['credor'], '<b>Credor</b>')->obrigatorio();
        $val->set($_POST['credor'], '<b>Credor</b>')->obrigatorio();
        $val->set($_POST['cnpj_credor'], '<b>CNPJ do Credor</b>')->obrigatorio();
        $val->set($_POST['numero'], '<b>Número</b>')->obrigatorio();
        $val->set($_POST['exercicio'], '<b>Exercício</b>')->obrigatorio();
        $val->set($_POST['modalidade'], '<b>Modalidade</b>')->obrigatorio();
        $val->set($_POST['tipo'], '<b>Tipo</b>')->obrigatorio();
        $val->set($_POST['valor_global'], '<b>Valor Global</b>')->obrigatorio();
        $val->set($_POST['data_contrato'], '<b>Data do Contrato</b>')->obrigatorio();
        $val->set($_POST['data_inicio'], '<b>Data Inicio</b>')->obrigatorio();
        $val->set($_POST['id_mandatos'], '<b>Gestão/Legislatura</b>')->obrigatorio();
        $val->set($_POST['id_entidade_orgaos'], '<b>Órgão</b>')->obrigatorio();
        $val->set($_POST['objeto'], '<b>Objeto</b>')->obrigatorio();
        
        if ($val->validar()) {
            $post = filter_var_array($_POST, FILTER_SANITIZE_SPECIAL_CHARS);
            $post['usuario'] = $_SESSION['USUARIO'];
            $id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);
            $crud = new ClassModel();
            $update = $crud->update('contratos ', $post, $id);
        } else {
            foreach ($val->getErrors() as $erro) {
                echo "$erro <br />";
            }
        }
    }

    public function insert() {

        $val = new ClassValidacao();
        $val->set($_POST['credor'], '<b>Credor</b>')->obrigatorio();
        $val->set($_POST['cnpj_credor'], '<b>CNPJ do Credor</b>')->obrigatorio();
        $val->set($_POST['numero'], '<b>Número</b>')->obrigatorio();
        $val->set($_POST['exercicio'], '<b>Exercício</b>')->obrigatorio();
        $val->set($_POST['modalidade'], '<b>Modalidade</b>')->obrigatorio();
        $val->set($_POST['tipo'], '<b>Tipo</b>')->obrigatorio();
        $val->set($_POST['valor_global'], '<b>Valor Global</b>')->obrigatorio();
        $val->set($_POST['data_contrato'], '<b>Data do Contrato</b>')->obrigatorio();
        $val->set($_POST['data_inicio'], '<b>Data Inicio</b>')->obrigatorio();
        $val->set($_POST['id_mandatos'], '<b>Gestão/Legislatura</b>')->obrigatorio();
        $val->set($_POST['id_entidade_orgaos'], '<b>Órgão</b>')->obrigatorio();
        $val->set($_POST['objeto'], '<b>Objeto</b>')->obrigatorio();
        
        if ($val->validar()) {
            $post = filter_var_array($_POST, FILTER_SANITIZE_SPECIAL_CHARS);
            $post['data_cadastro'] = date("Y/m/d h:i:s");
            $post['usuario'] = $_SESSION['USUARIO'];
            $crud = new ClassModel();
            print $crud->insert($post, 'contratos ');
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
            $delete = $crud->delete('contratos ', ' WHERE id=?', array($id));
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
          
            $exemplo = '{
                "id": "53",
                "data": "05/09/2023",
                "contratado_nome": "F4 VENDAS E SERVIÇOS LTDA",
                "contratado_cpf_cnpj": "34.087.702/0001-76",
                "valor_global": "17.000,00",
                "objeto": "CONTRATAÇÃO DE PESSOA JURIDICA OU FISICA PARA PRESTAÇÃO DOS SERVIÇOS DE LOCAÇÃO DE VEICULO SEM MOTORISTA DESTINADO AS ATIVIDADES DA CÂMARA MUNCIPAL DE CEDRO/CE.",
                "arquivo": "/contratos/53/0509.012023_2023_0000001.PDF"
              },';

            if ($jsonData !== null) {
              
                foreach($jsonData as $item){
                    $post['id'] = $item['id'];

                    $post['data_contrato'] =   $item['data'] == 'N/A' ? '0000-00-00': DateTime::createFromFormat('d/m/Y', $item['data'])->format('Y-m-d');
                    
                    $post['exercicio'] = date('Y', strtotime($item['data'])); 
                    $post['credor'] = $item['contratado_nome'];
                    $post['cnpj_credor'] = $item['contratado_cpf_cnpj'];
                    $post['valor_global'] = $item['valor_global'];
                    $post['objeto'] = $item['objeto'];

                    $post['data_cadastro'] = date("Y/m/d h:i:s");
                    $post['usuario'] = $_SESSION['USUARIO'];
                    $post['tbl'] = 'contratos';

                    $db = new ClassModel();
                    $id = $db->insert($post, 'contratos ');

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
                        $postArquivo['tabela_pai'] = 'contratos';
                        
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
