<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['audio'])) {
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
} else {
    http_response_code(400);
    echo 'Requisição inválida.';
}