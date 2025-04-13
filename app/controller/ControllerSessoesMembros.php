<?php

session_start();
require_once '../../config/header.php';
require_once '../../app/model/ClassModel.php';
require_once '../../app/model/ClassValidacao.php';

class ControllerSessoesMembros {


    function locate() {

        if (isset($_GET['id'])) {

            $prep = "WHERE id=" . filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT) . " ";
            $crud = new ClassModel();
            $select = $crud->select('* ', 'sessoes_membros ', $prep, array());
            $result = $select->fetch(\PDO::FETCH_ASSOC); // A T E N Ç Ã O !!! AQUI O PDO MONTA UM ARRAY ASSOCIATIVO.
            echo json_encode($result, JSON_PRETTY_PRINT);
        } else {

            $prep = "WHERE t1.id_sessoes = " . $_POST['id'] . "";
            $crud = new ClassModel();
            $select = $crud->select("t1.*, t2.nome, DATE_FORMAT(t1.data_inicio, '%d/%m/%Y') as data_inicio, DATE_FORMAT(t1.data_fim, '%d/%m/%Y') as data_fim ", "sessoes_membros t1 LEFT JOIN servidor t2 ON t1.id_servidor = t2.id ", $prep, array());
            $result = $select->fetchAll();  //A T E N Ç Ã O !!! AQUI O PDO MONTA UM ARRAY  >>N Ã O<<  ASSOCIATIVO
            echo json_encode($result, JSON_PRETTY_PRINT);
        }
    }

    /*public function update() {

        $val = new ClassValidacao();
        $val->set($_POST['id_servidor'], '<b>Funcionario</b>')->obrigatorio();
        $post = filter_var_array($_POST, FILTER_SANITIZE_SPECIAL_CHARS);

        if ($val->validar()) {
            $id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);
            $post['tbl'] = 'sessoes_membros';
            if(!isset($post['ativo'])){
                $post['ativo'] = 'off';
            }
            $crud = new ClassModel();
            $crud->update('sessoes_membros ', $post, $id);
        } else {
            foreach ($val->getErrors() as $erro) {
                echo "$erro <br />";
            }
        }
    }*/


    public function update() {

        $val = new ClassValidacao();
        $val->set($_POST['id_servidor'], '<b>Funcionario</b>')->obrigatorio();
        $val->set($_POST['presente'], '<b>Voto</b>')->obrigatorio();
        $post = filter_var_array($_POST, FILTER_SANITIZE_SPECIAL_CHARS);

        if ($val->validar()) {
            $id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);
            $post['tbl'] = 'sessoes_membros';

            $crud = new ClassModel();
            $crud->update('sessoes_membros ', $post, $id);
        } else {
            foreach ($val->getErrors() as $erro) {
                echo "$erro <br />";
            }
        }
    }


    public function insert() {

        $val = new ClassValidacao();
        $val->set($_POST['id_servidor'], '<b>Funcionario</b>')->obrigatorio();

        if ($val->validar()) {
            $post = filter_var_array($_POST, FILTER_SANITIZE_SPECIAL_CHARS);
            $post['data_cadastro'] = date("Y/m/d h:i:s");
            $post['tbl'] = 'sessoes_membros';
            if(!isset($post['ativo'])){
                $post['ativo'] = 'off';
            }
            $crud = new ClassModel();
            print $crud->insert($post, 'sessoes_membros ');
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
            $delete = $crud->delete('sessoes_membros ', ' WHERE id=?', array($id));
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
            $db = new ClassModel();

            $exemplo = '
                "id_sessao": 531,
                "id_vereador": "9",
                "cargo": "VEREADOR(A)",
                "nome": "GILBERTO BARBOSA DE OLIVEIRA  (GILBERTO BARBOSA)",
                "chamada": "PRESENTE",
                "data_target": "#myModall9"
            ';

            if ($jsonData !== null) {
                
                $db->delete('sessoes_membros ', ' ', array());

                foreach($jsonData as $item){
                    $post['id'] = $item['id'];
                    $post['presente'] = $item['chamada'] == 'PRESENTE' ? 'S' :  'N';
                    $post['id_servidor'] = $item['id_vereador'];
                    $post['id_sessoes'] = $item['id_sessao'];            

                    $post['data_cadastro'] = date("Y/m/d h:i:s");
                    $post['tbl'] = 'sessoes_membros';
                    
                    $id = $db->insert($post, 'sessoes_membros ');
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
