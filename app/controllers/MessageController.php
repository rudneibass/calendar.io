<?php

session_start();
require_once '../../config/headers.php';
require_once '../../app/models/Message.php';
require_once '../../app/models/Group.php';

class MessageController
{
    /*public function __construct()
    {
        if (!isset($_SESSION['user'])) {
            http_response_code(401);
            echo json_encode(array('message' => 'Usuário não autenticado'));
            exit;
        }
    }*/

    public function loadMessages()
    {
    $mesAtual = isset($_GET['mes']) ? (int) $_GET['mes'] : date('n');
    $anoAtual = isset($_GET['ano']) ? (int) $_GET['ano'] : date('Y');
    $groupId = isset($_GET['group']) ? (int) $_GET['group'] : null;


    $primeiroDia = new DateTime("$anoAtual-$mesAtual-01");
    $ultimoDia = new DateTime("$anoAtual-$mesAtual-" . $primeiroDia->format('t'));
    $dataInicio = $primeiroDia->format('Y-m-d');
    $dataFim = $ultimoDia->format('Y-m-d');
    $html = '';

    $groupModel = new Group();
    $group = $groupModel->getById($groupId);

    if ($group && $group['visibility'] == 'private') {
        echo '<div class="alert alert-info" role="alert">';
        echo 'Grupo privado. Para ter acesso as mensagens é preciso estar conectado com este usuário.';
        echo ' Mas fique tranquilo, você ainda pode acessar as mensagens dos grupos publicos.';
        echo '</div>';
        exit;
    } 


    $message = new Message();
    $messageList = $message->findAllByParams(['group_id' => $groupId]);

    foreach ($messageList as $item) {
        $html .= '<div class="message-container">';
        $html .= '<div class="message-bubble">';

        // Verificar o tipo de mensagem
        switch ($item['type']) {
            case 'text':
                $html .= '<div class="message-text">' . htmlspecialchars($item['message']) . '</div>';
                break;

            case 'image':
                $html .= '<div class="message-image">';
                $html .= '<img src="' . htmlspecialchars($item['message']) . '" alt="Imagem" style="max-width: 100%; border-radius: 10px;">';
                $html .= '</div>';
                break;

            case 'audio':
                $html .= '<div class="message-audio">';
                $html .= '<audio controls style="width: 100%;">';
                $html .= '<source src="' . htmlspecialchars($item['message']) . '" type="audio/mpeg">';
                $html .= 'Seu navegador não suporta o elemento de áudio.';
                $html .= '</audio>';
                $html .= '</div>';
                break;

            default:
                $html .= '<div class="message-unknown">Tipo de mensagem desconhecido.</div>';
                break;
        }

        // Exibir a hora da mensagem
        $html .= '<div class="message-time">' . (new DateTime($item['created_at']))->format('H:i') . '</div>';
        $html .= '</div>'; // Fechar message-bubble
        $html .= '</div>'; // Fechar message-container
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
            $data['message'] = '../../storage/uploads/images/' . $fileName;
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
