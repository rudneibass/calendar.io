<?php
// Obtém o mês e o ano da requisição GET
$mesAtual = isset($_GET['mes']) ? (int) $_GET['mes'] : date('n');
$anoAtual = isset($_GET['ano']) ? (int) $_GET['ano'] : date('Y');

// Obtém o primeiro e último dia do mês
$primeiroDia = new DateTime("$anoAtual-$mesAtual-01");
$ultimoDia = new DateTime("$anoAtual-$mesAtual-" . $primeiroDia->format('t'));

// Obtém o primeiro dia da semana (0 = Domingo, 6 = Sábado)
$diaSemanaInicio = (int) $primeiroDia->format('w');

// Obtém a quantidade total de dias no mês
$totalDias = (int) $ultimoDia->format('d');

$html = '';

// Espaços vazios antes do primeiro dia do mês
for ($i = 0; $i < $diaSemanaInicio; $i++) {
    $html .= '<div class="dia"></div>';
}

// Dias do mês
for ($dia = 1; $dia <= $totalDias; $dia++) {
    $html .= '<div class="dia">' . $dia . '</div>';
}

echo $html;
