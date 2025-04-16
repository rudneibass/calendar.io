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


            $html .= '<div class="' . $classe . ' d-flex" id="'.$dia.'" onclick="abrirModal(\'modal-diario-oficial\', \''.$dataFormatada.'\');checkDia(\''.$dia.'\')">';
                $html .= '<div class="position-relative">';
                    $html .= '<span style="font-size: 1.5rem">'.$dia.'</span>';
                    if (isset($mapaPublicacoes[$dataFormatada])) {
                        $html .= '&nbsp;<sup class="badge badge-pill badge-danger text-end position-absolute" >'.count($mapaPublicacoes[$dataFormatada]).'</sup>';
                    }
                $html .= '</div>';
            $html .= '</div>';
        }
    
        echo $html;
    }
    
    public function persistAudio(){
        $uploadDir = '../../uploads/audio/';
        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0777, true);
        }

        $fileName = basename($_FILES['audio']['name']);
        $filePath = $uploadDir . $fileName;

        if (move_uploaded_file($_FILES['audio']['tmp_name'], $filePath)) {
            // Retornar a URL do arquivo salvo
            echo '/uploads/audio/' . $fileName;
        } else {
            http_response_code(500);
            echo 'Erro ao salvar o arquivo.';
        }
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
            $post['usuario'] = $_SESSION['USUARIO'] ? $_SESSION['USUARIO'] : 'Sistema';
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
            $post['usuario'] = $_SESSION['USUARIO'] ? $_SESSION['USUARIO'] : 'Sistema';
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
}
