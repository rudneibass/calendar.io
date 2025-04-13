<?php

session_start();
require_once '../../app/model/ClassModel.php';
require_once '../../app/model/ClassValidacao.php';

class ControllerMultimidia
{


    function locate()
    {

        if (isset($_POST['id'])) {
            $prep = "WHERE id=" . filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT) . " ";
            $crud = new ClassModel();
            $select = $crud->select('*, DATE_FORMAT(data, "%d/%m/%Y") as data', 'arquivos ', $prep, array());
            $result = $select->fetch(\PDO::FETCH_ASSOC); // A T E N Ç Ã O !!! AQUI O PDO MONTA UM ARRAY ASSOCIATIVO.
            echo json_encode($result, JSON_PRETTY_PRINT);
        } else {

            $prep = "WHERE 1 "
                . (isset($_POST["c1"]) && !empty($_POST["c1"]) ? " AND id =" . filter_input(INPUT_POST, 'c1', FILTER_SANITIZE_NUMBER_INT) : "")
                . (isset($_POST["c2"]) && !empty($_POST["c2"]) ? " AND nome LIKE '%" . filter_input(INPUT_POST, 'c2', FILTER_SANITIZE_SPECIAL_CHARS) . "%'" : "")
                . (isset($_POST["c3"]) && !empty($_POST["c3"]) ? " AND data BETWEEN '" . filter_input(INPUT_POST, 'c3', FILTER_SANITIZE_SPECIAL_CHARS) . "' AND '" . filter_input(INPUT_POST, 'c4', FILTER_SANITIZE_SPECIAL_CHARS) . "'" : "")
                . " ORDER BY id DESC";

            $crud = new ClassModel();
            $select = $crud->select('* , DATE_FORMAT(data, "%d/%m/%Y") as data ', 'arquivos ', $prep, array());
            $result = $select->fetchAll();  //A T E N Ç Ã O !!! AQUI O PDO MONTA UM ARRAY  >>N Ã O<<  ASSOCIATIVO
            echo json_encode($result, JSON_PRETTY_PRINT);
        }
    }

    public function update()
    {

        $val = new ClassValidacao();
        $val->set($_POST['tabela_pai'], '<b>"Tabela Pai"</b>')->obrigatorio();
        $val->set($_POST['id_tabela_pai'], '<b>"Código Tabela Pai"</b>')->obrigatorio();
        $val->set($_POST['caminho_relativo'], '<b>"Caminho Relativo"</b>')->obrigatorio();
        $val->set($_POST['caminho_absoluto'], '<b>"Caminho Absoluto"</b>')->obrigatorio();

        $post = filter_var_array($_POST, FILTER_SANITIZE_SPECIAL_CHARS);

        $data = [];
        $data['tabela_pai'] =  $post['tabela_pai'];
        $data['id_tabela_pai'] =  $post['id_tabela_pai'];
        $data['caminho_relativo'] =  $post['caminho_relativo'];
        $data['caminho_absoluto'] =  $post['caminho_absoluto'];
        $data['link'] =  $post['link'];


        if ($val->validar()) {
            $id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);
            $crud = new ClassModel();
            $update = $crud->update('arquivos ', $data, $id);
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
            $delete = $crud->delete('arquivos ', ' WHERE id=?', array($id));
        } else {
            foreach ($val->getErrors() as $erro) {
                echo "$erro <br />";
            }
        }
    }*/

    function updateUrl()
    {


        $val = new ClassValidacao();
        $val->set($_POST['nova_url'], '<b>"Nova Url"</b>')->obrigatorio();
        $val->set($_POST['tipo'], '<b>"Tipo"</b>')->obrigatorio();

        if ($val->validar()) {
            
            $nova_url = $_POST['nova_url'];
            $barra = substr($nova_url, -1);
            if ($barra != "/") {
                $nova_url = $_POST['nova_url'] . '/';
            }
            
            if ($_POST['tipo'] == "imagens"){
                $prep = "WHERE tipo in ('image/jpeg', 'image/jpg','image/pjpeg', 'image/png','image/x-png') ";    
            }

            if ($_POST['tipo'] == "arquivos"){
                $prep = "WHERE tipo not in ('image/jpeg', 'image/jpg','image/pjpeg', 'image/png','image/x-png') ";    
            }


            $crud = new ClassModel();
            $select = $crud->select('*, DATE_FORMAT(data, "%d/%m/%Y") as data', 'arquivos ', $prep, array());          
            $result = $select->fetchAll();

            foreach ($result as $data) {
                $nome_arquivo = '';
                $id = $data['id'];
                $string_url = $data['caminho_absoluto'];
                $array_url = explode('/', $string_url);
                $nome_arquivo = end($array_url);
                $coluna = "caminho_absoluto";
                $url =  $nova_url . $nome_arquivo;
                $crud->updateAll('arquivos ', $coluna, $url, $id);
            }

        } else {
            foreach ($val->getErrors() as $erro) {
                echo "$erro <br />";
            }
        }
    }


    function updateUrlCapaNoticia()
    {

        $val = new ClassValidacao();
        $val->set($_POST['nova_url'], '<b>"Nova Url"</b>')->obrigatorio();

        if ($val->validar()) {
            
            $nova_url = $_POST['nova_url'];
            $barra = substr($nova_url, -1);
            if ($barra != "/") {
                $nova_url = $_POST['nova_url'] . '/';
            }
            
            $prep = "WHERE 1=1";
            $crud = new ClassModel();
            $select = $crud->select('*', 'noticias ', $prep, array());          
            $result = $select->fetchAll();

            foreach ($result as $data) {
                $nome_arquivo = '';
                $id = $data['id'];
                $string_url = $data['imagem_url'];
                $array_url = explode('/', $string_url);
                $nome_arquivo = end($array_url);
                $coluna = "imagem_url";
                $url =  $nova_url . $nome_arquivo;
                $crud->updateAll('noticias ', $coluna, $url, $id);
            }

        } else {
            foreach ($val->getErrors() as $erro) {
                echo "$erro <br />";
            }
        }
    }


    function updateUrlImagemServidor()
    {

        $val = new ClassValidacao();
        $val->set($_POST['nova_url'], '<b>"Nova Url"</b>')->obrigatorio();

        if ($val->validar()) {
            
            $nova_url = $_POST['nova_url'];
            $barra = substr($nova_url, -1);
            if ($barra != "/") {
                $nova_url = $_POST['nova_url'] . '/';
            }
            
            $prep = "WHERE 1=1";
            $crud = new ClassModel();
            $select = $crud->select('*', 'servidor ', $prep, array());          
            $result = $select->fetchAll();

            foreach ($result as $data) {
                $nome_arquivo = '';
                $id = $data['id'];
                $string_url = $data['imagem_url'];
                $array_url = explode('/', $string_url);
                $nome_arquivo = end($array_url);
                $coluna = "imagem_url";
                $url =  $nova_url . $nome_arquivo;
                $crud->updateAll('servidor ', $coluna, $url, $id);
            }

        } else {
            foreach ($val->getErrors() as $erro) {
                echo "$erro <br />";
            }
        }
    }

}
