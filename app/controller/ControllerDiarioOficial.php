<?php

session_start();
require_once '../../config/header.php';
require_once '../../app/model/ClassModel.php';
require_once '../../app/model/ClassValidacao.php';

class ControllerDiarioOficial {

    function locate() {
        $mesAtual = isset($_GET['mes']) ? (int) $_GET['mes'] : date('n');
        $anoAtual = isset($_GET['ano']) ? (int) $_GET['ano'] : date('Y');
        
        // Criação dos limites do mês atual
        $primeiroDia = new DateTime("$anoAtual-$mesAtual-01");
        $ultimoDia = new DateTime("$anoAtual-$mesAtual-" . $primeiroDia->format('t'));
        $diaSemanaInicio = (int) $primeiroDia->format('w');
        $totalDias = (int) $ultimoDia->format('d');
        $dataInicio = $primeiroDia->format('Y-m-d');
        $dataFim = $ultimoDia->format('Y-m-d');
    
        $db = new ClassModel();
    
        // Consulta das publicações no mês atual
        $publicacoes = $db->select(
            "*, DATE_FORMAT(data_publicacao, '%d/%m/%Y') as data_formatada", 
            'publicacoes', 
            'WHERE data_publicacao BETWEEN ? AND ?', 
            array($dataInicio, $dataFim)
        )->fetchAll();
    
        // Agrupar publicações por data (YYYY-MM-DD)
        $mapaPublicacoes = [];
        foreach ($publicacoes as $pub) {
            $data = (new DateTime($pub['data_publicacao']))->format('Y-m-d');
            $mapaPublicacoes[$data][] = $pub;
        }
    
        // Data de hoje
        $hoje = new DateTime();
        $html = '';
    
        // Espaços em branco antes do primeiro dia do mês
        for ($i = 0; $i < $diaSemanaInicio; $i++) {
            $html .= '<div class="dia"></div>';
        }
    
        // Dias do mês
        for ($dia = 1; $dia <= $totalDias; $dia++) {
            $dataAtual = new DateTime("$anoAtual-$mesAtual-$dia");
            $dataFormatada = $dataAtual->format('Y-m-d');
            $classe = $dataFormatada === $hoje->format('Y-m-d') ? 'dia hoje' : 'dia';


            $html .= '<div class="' . $classe . ' d-flex" id="'.$dia.'" ondblclick="abrirModal(\'modal-diario-oficial\', \''.$dataFormatada.'\')" onclick="checkDia(\''.$dia.'\')">';
                $html .= '<div>';
                    $html .= '<h4 class="text-end">'.$dia.'</h4>';
                $html .= '</div>';
                
                $html .= '<div>';
                    $html .= '<ul>';
                        if (isset($mapaPublicacoes[$dataFormatada])) {
                            foreach ($mapaPublicacoes[$dataFormatada] as $pub) {
                                $html .= 
                                '<li>
                                    <a href="#" onclick="abrirModal(\'modal-diario-oficial\', \''.$pub['id'].'\'); populaForm('.$pub['id'].')">
                                        <small>
                                            '.$pub['titulo'].'&nbsp;<i class="fa fa-check" style="color: rgb(40, 167, 69)"></i>
                                        </small>
                                    </a>
                                </li>';
                            }
                        }
                    $html .= '</ul>';
                $html .= '</div>';
            $html .= '</div>';
        }
    
        echo $html;
    }
    
    
    public function update() {

        $val = new ClassValidacao();
        $val->set($_POST['titulo'], '<b>Título</b>')->obrigatorio();
        $val->set($_POST['tipo'], '<b>Tipo</b>')->obrigatorio();
        $val->set($_POST['data_publicacao'], '<b>Data da Publicação</b>')->obrigatorio();
        $val->set($_POST['id_entidade_orgaos'], '<b>Órgão</b>')->obrigatorio();
        $val->set($_POST['id_mandatos'], '<b>Legislatura/Gestão</b>')->obrigatorio();

        if ($val->validar()) {
            $post = filter_var_array($_POST, FILTER_SANITIZE_SPECIAL_CHARS);
            $post['usuario'] = $_SESSION['USUARIO'];
            $id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);
            $crud = new ClassModel();
            $update = $crud->update('publicacoes ', $post, $id);
        } else {
            foreach ($val->getErrors() as $erro) {
                echo "$erro <br />";
            }
        }
    }

    public function insert() {

        $val = new ClassValidacao();
        $val->set($_POST['titulo'], '<b>Título</b>')->obrigatorio();
        $val->set($_POST['tipo'], '<b>Tipo</b>')->obrigatorio();
        $val->set($_POST['data_publicacao'], '<b>Data da Publicação</b>')->obrigatorio();
        $val->set($_POST['id_entidade_orgaos'], '<b>Órgão</b>')->obrigatorio();
        $val->set($_POST['id_mandatos'], '<b>Gestão/Legislatura</b>')->obrigatorio();
        
        if ($val->validar()) {
            $post = filter_var_array($_POST, FILTER_SANITIZE_SPECIAL_CHARS);
            $post['data_cadastro'] = date("Y/m/d h:i:s");
            $post['usuario'] = $_SESSION['USUARIO'];
            $crud = new ClassModel();
            print $crud->insert($post, 'publicacoes ');
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
            $delete = $crud->delete('publicacoes ', ' WHERE id=?', array($id));
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
            "id": "6",
            "data": " 15/02/2016",
            "numero": "LEI MUNICIPAL - FEVEREIRO/2016",
            "descricao": "Descrição  FICA O PODER LEGISLATIVO AUTORIZADO A CONCEDER AUMENTO DO VENCIMENTO-BASE DOS SERVIDORES DA CÂMARA MUNICIPAL DE CEDRO - CEARÁ.",
            "arquivo": "/arquivos/6/Leis_476_2016.pdf"
            "dominio": "https://www.camaradecedro.ce.gov.br"
            ';

            if ($jsonData !== null) {
              
                foreach($jsonData as $item){
                    $post['id'] = $item['id'];
                    $post['data_publicacao'] = $item['data'] == 'N/A' ? '0000-00-00': DateTime::createFromFormat('d/m/Y', $item['data'])->format('Y-m-d');
                    $post['numero'] = $item['numero'];
                    $post['titulo'] = $item['descricao'];
                    $post['descricao'] = $item['descricao']; 
                    $post['exercicio'] = date('Y', strtotime($item['data']));                

                    $post['data_cadastro'] = date("Y/m/d h:i:s");
                    $post['usuario'] = $_SESSION['USUARIO'];
                    $post['tbl'] = 'publicacoes';

                    if(isset($item['tipo']) && !empty($item['tipo'])){
                        $post['tipo'] = $item['tipo'];
                    }
                    

                    $db = new ClassModel();
                    $id = $db->insert($post, 'publicacoes ');

                    if($id){
                        $postArquivo['nome'] = $item['arquivo'];
                        $postArquivo['tipo'] = 'application/pdf';
                        $postArquivo['tamanho'] = 'indisponivel';
                        $postArquivo['dominio'] = $item['dominio'];
                        $postArquivo['usuario'] = $_SESSION['USUARIO'];
                        $postArquivo['data'] = date('Y-m-d');
                        $postArquivo['hora'] = date('H:i:s');
                        $postArquivo['hora'] = date('H:i:s');
                        $postArquivo['id_tabela_pai'] = $item['id'];
                        $postArquivo['tabela_pai'] = 'publicacoes';
                        $postArquivo['caminho_absoluto'] = $item['arquivo'];
                        $postArquivo['caminho_relativo'] = $item['arquivo'];

                        if(!is_array($item['arquivos'])){
                            $db->insert($postArquivo, 'arquivos ');
                        }
                        
                        if(is_array($item['arquivos'])){
                            foreach($item['arquivos'] as $arquivo){
                                $postArquivo['caminho_absoluto'] = $arquivo;
                                $postArquivo['caminho_relativo'] = $arquivo;
                                $db->insert($postArquivo, 'arquivos ');
                            }
                        }
                        
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
