<?php

session_start();
require_once '../../config/headers.php';
require_once '../../app/models/Message.php';

require_once '../../app/models/Publicacao.php';
class MessageController
{

    function locate()
    {
        $mesAtual = isset($_GET['mes']) ? (int) $_GET['mes'] : date('n');
        $anoAtual = isset($_GET['ano']) ? (int) $_GET['ano'] : date('Y');

        $primeiroDia = new DateTime("$anoAtual-$mesAtual-01");
        $ultimoDia = new DateTime("$anoAtual-$mesAtual-" . $primeiroDia->format('t'));
        $diaSemanaInicio = (int) $primeiroDia->format('w');
        $totalDias = (int) $ultimoDia->format('d');
        $dataInicio = $primeiroDia->format('Y-m-d');
        $dataFim = $ultimoDia->format('Y-m-d');

        $publicacao = new Publicacao();
        $publicacoes = $publicacao->getMessages($dataInicio, $dataFim);

        $mapaPublicacoes = [];
        foreach ($publicacoes as $pub) {
            $data = (new DateTime($pub['data_publicacao']))->format('Y-m-d');
            $mapaPublicacoes[$data][] = $pub;
        }

        $hoje = new DateTime();
        $html = '';

        for ($i = 0; $i < $diaSemanaInicio; $i++) {
            $html .= '<div class="dia"></div>';
        }

        for ($dia = 1; $dia <= $totalDias; $dia++) {
            $dataAtual = new DateTime("$anoAtual-$mesAtual-$dia");
            $dataFormatada = $dataAtual->format('Y-m-d');
            $classe = $dataFormatada === $hoje->format('Y-m-d') ? 'dia hoje' : 'dia';


            $html .= '<div class="' . $classe . ' d-flex" id="' . $dia . '" onclick="abrirModal(\'modal-diario-oficial\', \'' . $dataFormatada . '\');checkDia(\'' . $dia . '\')">';
            $html .= '<div class="position-relative">';
            $html .= '<span style="font-size: 1.5rem">' . $dia . '</span>';
            if (isset($mapaPublicacoes[$dataFormatada])) {
                $html .= '&nbsp;<sup class="badge badge-pill badge-danger text-end position-absolute" >' . count($mapaPublicacoes[$dataFormatada]) . '</sup>';
            }
            $html .= '</div>';
            $html .= '</div>';
        }

        echo $html;
    }

    public function create()
    {
        $message = new Message();
        $data = filter_var_array($_POST, FILTER_SANITIZE_SPECIAL_CHARS);
        echo $message->create($data);
    }

    public function delete()
    {
        $message = new Message();
        echo $message->delete(filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT));
    }


    public function persistImage()
    {
        $message = new Message();
        $uploadDir = '../../storage/uploads/images/';

        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0777, true);
        }

        $fileName = basename($_FILES['image']['name']);
        $filePath = $uploadDir . $fileName;

        if (move_uploaded_file($_FILES['image']['tmp_name'], $filePath)) {
            $data = filter_var_array($_POST, FILTER_SANITIZE_SPECIAL_CHARS);
            $data['message'] = '../..//storage/uploads/images/' . $fileName;
            $data['type'] = 'image'; 

            echo $message->create($data);
        } else {
            http_response_code(500);
            echo 'Erro ao tentar salvar o arquivo.';
        }
    }

    public function persistAudio()
    {
        $message = new Message();
        $uploadDir = '../../storage/uploads/audio/';
        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0777, true);
        }
        $fileName = basename($_FILES['audio']['name']);
        $filePath = $uploadDir . $fileName;

        if (move_uploaded_file($_FILES['audio']['tmp_name'], $filePath)) {
            echo '/storage/uploads/audio/' . $fileName;
            $data = filter_var_array($_POST, FILTER_SANITIZE_SPECIAL_CHARS);
            $data['message'] = '../../storage/uploads/audio/' . $fileName;
            echo $message->create($data);
        } else {
            http_response_code(500);
            echo 'Erro ao tentar salvar o arquivo.';
        }
    }
}
