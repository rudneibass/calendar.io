<?php
session_start();
require_once '../../app/model/ClassModel.php';
require_once '../../app/model/ClassValidacao.php';

class ControllerMensagensEnviadas {


    function enviadas() {

        $prep = "WHERE 1=1 "
                . (isset($_POST["id"]) && !empty($_POST["id"]) ? " AND id =" . filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT) : "")
                . (isset($_POST["nome"]) && !empty($_POST["nome"]) ? " AND o_nome LIKE '%" . filter_input(INPUT_POST, 'nome', FILTER_SANITIZE_SPECIAL_CHARS) . "%'" : "")
                . (isset($_POST["data_ini"]) && !empty($_POST["data_ini"]) ? " AND data_cadastro BETWEEN '" . filter_input(INPUT_POST, 'data_ini', FILTER_SANITIZE_SPECIAL_CHARS) . "' AND '" . filter_input(INPUT_POST, 'o_data_fim', FILTER_SANITIZE_SPECIAL_CHARS) . "'" : "")
                . " ORDER BY id DESC";

        $crud = new ClassModel();
        $select = $crud->select("*, DATE_FORMAT(data, '%d/%m/%Y') as data", 'ouvidoria_respostas ', ' ORDER BY id DESC', array());
        $result = $select->fetchAll();  //A T E N Ç Ã O !!! AQUI O PDO MONTA UM ARRAY  >>N Ã O<<  ASSOCIATIVO
        echo json_encode($result, JSON_PRETTY_PRINT);
    }


    function vizualizarEnviadasOuvidoria() {

        $prep = "WHERE id=" . filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT) . " ";
        $crud = new ClassModel();
        $select = $crud->select('*, DATE_FORMAT(data, "%d/%m/%Y") as data', 'ouvidoria_respostas  ', $prep, array());
        $result = $select->fetchAll(); // A T E N Ç Ã O !!! AQUI O PDO MONTA UM ARRAY >> N Ã O << ASSOCIATIVO. 
        foreach ($result as $data) {
            echo '<div>     
                        <div class="corpo-msg">
                            <span class="span-14">---------- Mensagem enviada ---------</span><br/>
                            <span class="span-14">Enviado:&nbsp;' . $data['data'] . '</span><br/>
                            <span class="span-14" >Protocolo:&nbsp;</span>00000' . $data['id_ouvidoria'] . '<br/><br/>
                            <span>' . $data['mensagem_resposta'] . '</span>
                        </div>   
                  </div>';
        }
    }


    function vizualizarEnviadasEsic() {

        $prep = "WHERE e.id=" . filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT) . " ";
        $crud = new ClassModel();
        $select = $crud->select('*, es.id as id_esic', 'enviadas e INNER JOIN esic_solicitacao es ON e.id_esic = es.id', $prep, array());
        $result = $select->fetchAll(); // A T E N Ç Ã O !!! AQUI O PDO MONTA UM ARRAY >> N Ã O << ASSOCIATIVO.           
        foreach ($result as $data) {
            echo '<div>     
                        <div class="corpo-msg">
                            <span class="span-14">---------- Mensagem enviada ---------</span><br/>
                            <span class="span-14">De:&nbsp;' . $data['cpfcnpj'] . '</span><span><</span><span id="email-remetente">' . $data['cpfcnpj'] . '</span><span>></span><br/>
                            <span class="span-14">Enviado:&nbsp;' . $data['data_cadastro_formatada'] . '</span><br/>
                            <span class="span-14">Assunto:&nbsp;' . $data['tipo_solicitacao'] . '</span>
                            <span class="span-14" >Protocolo:&nbsp;</span>00000' . $data['id'] . '<br/><br/>
                            <span >' . $data['mensagem'] . '</span><hr/>
                        
                            <span class="span-14"><b>Para:&nbsp;</b>' . $data['email_destino'] . '</span><br/>
                            <span class="span-14"><b>Enviado:</b>&nbsp;' . strftime("%A, %d de %B de %Y", strtotime($data['data_cadastro'])) . '</span><br/><br/>
                            <span>' . $data['mensagem_resposta'] . '</span><hr/>
                        </div>   
                     </div>';
        }
    }

    
}
