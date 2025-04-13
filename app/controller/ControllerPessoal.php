<?php

session_start();
require_once '../../config/header.php';
require_once '../../app/model/ClassModel.php';
require_once '../../app/model/ClassValidacao.php';

class ControllerPessoal {

    function importar(){
        $db = new ClassModel();
        $validador = new ClassValidacao();
        $validador->set($_FILES['arquivo']['tmp_name'], '<b>"Arquivo"</b>')->obrigatorio();
        $validador->set($_POST['ano'], '<b>"Ano"</b>')->obrigatorio();
        $validador->set($_POST['mes'], '<b>"Mês"</b>')->obrigatorio();
        $validador->set($_POST['tipo_folha'], '<b>"Tipo de Folha"</b>')->obrigatorio();
        $validador->set($_POST['tipo_arquivo'], '<b>"Tipo de Arquivo"</b>')->obrigatorio();

        if ($validador->validar()) {
            switch($_POST['tipo_arquivo']){
                case 'terceiros':
                    $this->importarArquivoTerceiros($_FILES['arquivo']['tmp_name'], $_POST['ano'], $_POST['mes'], $_POST['tipo_folha'], $db);
                    break;
                case 'manad':
                    $this->importarArquivoManad();
                    break;     
            }
        } else {
            foreach ($validador->getErrors() as $erro) {
                echo "$erro <br />";
            }
        }
    }

    function getFolhas(){
        $folhas = $this->getFolhasManad(new ClassModel());
        if(!count($folhas)){
            $folhas = $this->getFolhasTerceiros(new ClassModel());
        }
        echo json_encode($folhas);
    }

    function getFolhaDetalhes(){
        $competencia = filter_input(INPUT_GET, 'competencia', FILTER_SANITIZE_SPECIAL_CHARS);

        $folha_detalhes = $this->getFolhaDetalhesManad(new ClassModel(), $competencia);
        if(!count($folha_detalhes)){
            $folha_detalhes = $this->getFolhaDetalhesTerceiros(new ClassModel(), $competencia);
        }
        echo json_encode($folha_detalhes);
    }

    public function getFolhasTerceiros($db){
        $select = $db->select(" 
            id, 
            mes, 
            ano, 
            competencia, 
            competencia as mes_ano,  
            sum(proventos) as proventos, 
            sum(descontos) as descontos, 
            (sum(proventos) - sum(descontos)) as liquido,
                CASE 
                    WHEN tipo_folha = 'N' THEN 'N - Normal'
                    WHEN tipo_folha = 'N' THEN 'C - Complementar'
                    WHEN tipo_folha = 'D' THEN 'D - Décimo Terceiro'
                END AS tipo_folha
            ", 
            "folhas_detalhes ",
            "GROUP BY competencia, tipo_folha ORDER BY ano DESC, mes DESC", 
            array());
        return $select->fetchAll();
    }

    public function getFolhasManad(ClassModel $db){
        $select = $db->select("*, INSERT(competencia, 3, 0, '/') AS mes_ano ", 'folhas ',  "ORDER BY ano DESC, mes DESC", array());
        return $select->fetchAll();
    }

    public function getFolhaDetalhesManad(ClassModel $db, $competencia){
        $select = $db->select(
            "
            K250.7 as matricula, 
            K050.7 as nome,
            K250.13 as cargo,
            K250.15 as vinculo,
            replace(K250.25, ',', '.') as proventos,
            INSERT(K250.8, 3, 0, '/') as competencia ",
            'K050, K250 ',
            "WHERE K050.3 = K250.7 AND K250.8 = ? GROUP BY matricula, nome, cargo, vinculo, competencia  ORDER BY nome",
            array($competencia)
        );
        
        return $select->fetchAll();
    }

    public function getFolhaDetalhesTerceiros(ClassModel $db, $competencia){
        $select = $db->select(
            "*",
            'folhas_detalhes ',
            "WHERE competencia = ? ORDER BY nome",
            array(str_replace('_', '/',$competencia))
        );
        
        return $select->fetchAll();
    }

    public function folhas(){
        $crud = new ClassModel();
        $select = $crud->select("*, INSERT(competencia, 3, 0, '/') AS mes_ano, competencia as competencia_id ", 'folhas ', " ORDER BY ano DESC, mes DESC", array());
        $result = $select->fetchAll();
        echo json_encode($result);
    }

    public function detalheFolha(){

        $comp = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_SPECIAL_CHARS);
        $crud = new ClassModel();
        $prep = "WHERE K050.3 = K250.7 AND K250.8 = ? GROUP BY matricula, nome, cargo, vinculo, competencia  ORDER BY nome";
        $select = $crud->select(
            "
            K250.7 as matricula, 
            K050.7 as nome,
            K250.13 as cargo,
            K250.15 as vinculo,
            replace(K250.25, ',', '.') as proventos,
            INSERT(K250.8, 3, 0, '/') as competencia ",
            'K050, K250 ',
            $prep,
            array($comp)
        );
        $result = $select->fetchAll();
        echo json_encode($result);
    }


    function importarArquivoManad()
    {
        $val = new ClassValidacao();
        $val->set($_POST['ano'], '<b>"Ano"</b>')->obrigatorio();
        $val->set($_POST['mes'], '<b>"Mês"</b>')->obrigatorio();

        if ($val->validar()) {

            $ano =  filter_input(INPUT_POST, 'ano', FILTER_SANITIZE_SPECIAL_CHARS);
            $mes =  filter_input(INPUT_POST, 'mes', FILTER_SANITIZE_SPECIAL_CHARS);

            if (strlen($mes) == 1) {
                $mes = '0' . $mes;
            }

            $db = new ClassModel();
            $tables = ['K001', 'K050', 'K051', 'K060', 'K070', 'K100', 'K110', 'K120', 'K130', 'K150', 'K250', 'K300', 'K990'];
            foreach ($tables as $table) {
                $prep = "WHERE " . $table . ".0 = ?";
                try {
                    $delete = $db->delete($table,  $prep, array($ano . $mes));
                } catch (\PDOException $e) {
                    echo $e->getCode();
                    echo $e->getMessage();
                }
            }

            $arquivo_tmp = $_FILES['arquivo']['tmp_name'];
            $arquivo = file($arquivo_tmp);

            foreach ($arquivo as $linha) {
                if ($linha[0] != 'K') {
                    continue;
                }

                $linha = trim($linha);
                $linhas = explode('|', $linha);

                $fields = null;
                $values = null;

                foreach ($linhas as $campo => $valor) {
                    $fields .= "`" . $campo . "`,";
                    $values .= $valor . "|";
                }

                $fieldsArray = explode(',', $fields);
                $fields = array_splice($fieldsArray, 0, -1);

                $valuesArray = explode('|', $values);
                $table = "`" . $valuesArray[0] . "`";
                $valuesArray[0] = $ano . $mes;
                $values = array_splice($valuesArray, 0, -1);

                $post = array_combine($fields, $values);
                $db->insert($post, $table); 
            }

            print $this->deleteSelectInsert('folhas', $ano, $mes);
        } else {
            foreach ($val->getErrors() as $erro) {
                echo "$erro <br />";
            }
        }
    }


    public function deleteSelectInsert($table, $ano, $mes)
    {
        try {
            $this->deleteFolhas($table, $ano, $mes);
        } catch (\PDOException $e) {
            echo $e->getCode();
            echo $e->getMessage();
        }

        try {
            $this->selectInsert($table, $ano, $mes);
        } catch (\PDOException $e) {
            echo $e->getCode();
            echo $e->getMessage();
        }
    }

    public function deleteFolhas($table, $ano, $mes)
    {
        $db = new ClassModel();
        $prep = 'WHERE competencia = "' . $mes . $ano . '"';
        $delete = $db->delete($table, $prep, array());
        return TRUE;
    }

    public function selectInsert($table, $ano, $mes)
    {
        $db = new ClassModel();
        $select = $db->select(
            "K300.5 AS competencia, 
             K300.2 as tipo_folha, 
             " . $ano . " as ano,
             " . $mes . " as mes,
             (SELECT SUM(replace(K300.7, ',', '.')) FROM K300 WHERE K300.8 = 'P' AND K300.0=" . $ano . $mes . ") AS proventos, 
             (SELECT SUM(replace(K300.7, ',', '.')) FROM K300 WHERE K300.8 = 'D' AND K300.0=" . $ano . $mes . ") AS descontos, 
             (SELECT SUM(replace(K300.7, ',', '.')) FROM K300 WHERE K300.8 = 'P' AND K300.0=" . $ano . $mes . ") - 
             (SELECT SUM(replace(K300.7, ',', '.')) FROM K300 WHERE K300.8 = 'D' AND K300.0=" . $ano . $mes . ") AS liquido ",
            'K300 ',
            ' WHERE K300.5 = ? GROUP BY K300.5, K300.2',
            array($mes . $ano)
        );

        $result = $select->fetch(\PDO::FETCH_ASSOC);
        switch ($result['tipo_folha']) {
            case 'N':
                $result['tipo_folha'] = 'N - Normal';
                break;
            case 'C':
                $result['tipo_folha'] = 'C - Complementar';
                break;
            case 'D':
                $result['tipo_folha'] = 'D - Décimo Terceiro';
                break;
            default:
                $result['tipo_folha'] = $result['tipo_folha'];
                break;
        }
        $insert = $db->insert($result, $table);

        return TRUE;
    }


    function locate()
    {

        if (isset($_POST['id'])) {

            $prep = "WHERE id=" . filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT) . " ";
            $crud = new ClassModel();
            $select = $crud->select('* ', 'K250 ', $prep, array());
            $result = $select->fetch(\PDO::FETCH_ASSOC);
            echo json_encode($result, JSON_PRETTY_PRINT);
        } else {
            $table =  filter_input(INPUT_GET, 'table', FILTER_SANITIZE_SPECIAL_CHARS) . " ";
            $prep = "WHERE 1 ORDER BY `0` DESC";
            $crud = new ClassModel();
            $select = $crud->select("*", $table, $prep, array());
            $result = $select->fetchAll();
            echo json_encode($result, JSON_PRETTY_PRINT);
        }
    }
 
    public function delete(){
        $val = new ClassValidacao();
        $val->set($_POST['id'], '"Id não Informado"')->obrigatorio();
        if ($val->validar()) {
            $id = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT);
            $db = new ClassModel();
            $db->delete('folhas ', ' WHERE id=?', array($id));
        } else {
            foreach ($val->getErrors() as $erro) {
                echo "$erro <br />";
            }
        }
    }


    function importarArquivoTerceiros(string $arquivo_temp,string $ano,string $mes,string $tipo_folha, ClassModel $db){
     
        if (strlen($mes) == 1) { $mes = '0' . $mes;}
        $arquivo = fopen($arquivo_temp, 'r');
        $dados = array();
        $vinculos = array();
        $cargos = array();
        $pessoas = array();
        $folha = array();

        $db->delete('folhas_detalhes',  "WHERE competencia = ?", array($ano.'/'.$mes));

        while (($linha = fgets($arquivo)) !== false) {
    
            $dados['ano'] = $ano;
            $dados['mes'] = $mes;
            $dados['competencia'] = $ano.'/'.$mes;
            $tipoRegistro = substr($linha, 0, 3);
        
            switch ($tipoRegistro) {
                case '001':
                    $vinculo_codigo = ltrim(trim(substr($linha, 3, 2)),'0');
                    $vinculo_descricao = trim(substr($linha, 5, 60));
                    $vinculos[$vinculo_codigo] = $vinculo_descricao;
                    break;
        
                case '002':
                    $cargo_codigo = ltrim(trim(substr($linha, 98, 10)), '0');
                    $cargo_nome = trim(substr($linha, 6, 80));
                    $cargos[$cargo_codigo] = $cargo_nome;
                    break;
        
                case '004':
                    $pessoa_cpf = trim(substr($linha, 3, 11));
                    $pessoa_nome = trim(substr($linha, 14, 80));
                    $pessoas[$pessoa_cpf] = $pessoa_nome;
                    break;
        
                case '005':
                    $folha_cpf = trim(substr($linha, 13, 11));
                    $folha_matricula = ltrim(trim(substr($linha, 3, 10)), '0');
                    $folha_proventos = ltrim(trim(substr($linha, 91, 19)), '0');
                    $folha_descontos = ltrim(trim(substr($linha, 129, 19)), '0');
                    $folha_cargo = ltrim(trim(substr($linha, 175, 10)), '0');
                    $folha_vinculo = ltrim(trim(substr($linha, 24, 2)), '0');
                    $folha = array(
                        'cpf' => $folha_cpf,
                        'matricula' => $folha_matricula,
                        'proventos' => $folha_proventos,
                        'descontos' => $folha_descontos,
                        'cargo' => $cargos[$folha_cargo],
                        'vinculo' => $vinculos[$folha_vinculo],
                        'nome' => $pessoas[$folha_cpf],
                        'tipo_folha' => $tipo_folha,
                        'ano' => $ano,
                        'mes' => $mes,
                        'competencia' => $mes.$ano
                    );
                    $db->insert($folha, 'folhas_detalhes');
                    break;
            }
        }

        print 1;
        return true;
    }


    function importarArquivoTerceirosOld(){

        $db = new ClassModel();
        $val = new ClassValidacao();
        $val->set($_POST['ano'], '<b>"Ano"</b>')->obrigatorio();
        $val->set($_POST['mes'], '<b>"Mês"</b>')->obrigatorio();
        $val->set($_POST['tipo_folha'], '<b>"Tipo de Folha"</b>')->obrigatorio();

        if ($val->validar()) {

            $tipo_folha = filter_input(INPUT_POST, 'tipo_folha', FILTER_SANITIZE_SPECIAL_CHARS);
            $ano =  filter_input(INPUT_POST, 'ano', FILTER_SANITIZE_SPECIAL_CHARS);
            $mes =  filter_input(INPUT_POST, 'mes', FILTER_SANITIZE_SPECIAL_CHARS);

            if (strlen($mes) == 1) { $mes = '0' . $mes;}

            $arquivo_tmp = $_FILES['arquivo']['tmp_name'];
            $arquivo = fopen($arquivo_tmp, 'r');
            
            $dados = array();
            $vinculos = array();
            $cargos = array();
            $pessoas = array();
            $folha = array();

            while (($linha = fgets($arquivo)) !== false) {
    
                $dados['ano'] = $ano;
                $dados['mes'] = $mes;
                $dados['competencia'] = $ano.'/'.$mes;

                $tipoRegistro = substr($linha, 0, 3);
        
                switch ($tipoRegistro) {
                    case '001':
                        $vinculo_codigo = ltrim(trim(substr($linha, 3, 2)),'0');
                        $vinculo_descricao = trim(substr($linha, 5, 60));
                        $vinculos[$vinculo_codigo] = $vinculo_descricao;
                        break;
        
                    case '002':
                        $cargo_codigo = ltrim(trim(substr($linha, 98, 10)), '0');
                        $cargo_nome = trim(substr($linha, 6, 80));
                        $cargos[$cargo_codigo] = $cargo_nome;
                        break;
        
                    case '004':
                        $pessoa_cpf = trim(substr($linha, 3, 11));
                        $pessoa_nome = trim(substr($linha, 14, 80));
                        $pessoas[$pessoa_cpf] = $pessoa_nome;
                        break;
        
                    case '005':
                        $folha_cpf = trim(substr($linha, 13, 11));
                        $folha_matricula = ltrim(trim(substr($linha, 3, 10)), '0');
                        $folha_proventos = ltrim(trim(substr($linha, 91, 19)), '0');
                        $folha_descontos = ltrim(trim(substr($linha, 129, 19)), '0');
                        $folha_cargo = ltrim(trim(substr($linha, 175, 10)), '0');
                        $folha_vinculo = ltrim(trim(substr($linha, 24, 2)), '0');
        
                        $folha = array(
                            'cpf' => $folha_cpf,
                            'matricula' => $folha_matricula,
                            'proventos' => $folha_proventos,
                            'descontos' => $folha_descontos,
                            'cargo' => $cargos[$folha_cargo],
                            'vinculo' => $vinculos[$folha_vinculo],
                            'nome' => $pessoas[$folha_cpf],
                            'tipo_folha' => $tipo_folha
                        );
                        print $db->insert($folha, 'folhas_detalhes');
                }
            }
        
        } else {
            foreach ($val->getErrors() as $erro) {
                echo "$erro <br />";
            }
        }
    }
}
