<?php

require_once '../config/headers.php';
require_once '../app/models/Message.php';
require_once '../app/models/Holiday.php';

class CalendarController
{

    function loadCalendar()
{
    $mesAtual = isset($_GET['mes']) ? (int) $_GET['mes'] : date('n');
    $anoAtual = isset($_GET['ano']) ? (int) $_GET['ano'] : date('Y');

    $primeiroDia = new DateTime("$anoAtual-$mesAtual-01");
    $ultimoDia = new DateTime("$anoAtual-$mesAtual-" . $primeiroDia->format('t'));
    $diaSemanaInicio = (int) $primeiroDia->format('w');
    $totalDias = (int) $ultimoDia->format('d');
    $dataInicio = $primeiroDia->format('Y-m-d');
    $dataFim = $ultimoDia->format('Y-m-d');

    $message = new Message();
    $messageList = $message->getMessages($dataInicio, $dataFim);

    $massagesMap = [];
    foreach ($messageList as $item) {
        $data = (new DateTime($item['created_at']))->format('Y-m-d');
        $massagesMap[$data][] = $item;
    }

    $feriado = new Holiday();
    $feriados = $feriado->all($anoAtual);
    $feriadosMap = [];
    foreach ($feriados as $feriado) {
        $feriadosMap[$feriado['day']] = $feriado['description'];
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

        $descricaoFeriado = '';
        if (isset($feriadosMap[$dataFormatada])) {
            $classe .= ' feriado'; 
            $descricaoFeriado = $feriadosMap[$dataFormatada]; 
        }

        $html .= '<div class="' . $classe . ' d-flex" id="' . $dia . '" onclick="loadGroups(\'' . $dataFormatada . '\');">';
            $html .= '<div class="position-relative">';
                $html .= '<span style="font-size: 1.5rem">' . $dia . '</span>';
                if (isset($massagesMap[$dataFormatada])) {
                    $html .= '&nbsp;<sup class="badge badge-pill badge-danger text-end position-absolute" >' . count($massagesMap[$dataFormatada]) . '</sup>';
                }
                if ($descricaoFeriado) {
                    $html .= '<div class="feriado-descricao" style="font-size: 0.8rem; color: red;">' . htmlspecialchars($descricaoFeriado) . '</div>';
                }
            $html .= '</div>';
        $html .= '</div>';
    }

    echo $html;
}
}
