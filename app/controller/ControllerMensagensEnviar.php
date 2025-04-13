<?php

require_once '../../app/model/ClassModel.php';
require_once '../../app/model/ClassValidacao.php';

class ControllerMensagensEnviar {

    function teste() {
        echo 'function teste() MensagensEnviar Controller';
    }

    function enviarResposta() {
        //PARAMETROS DE CONEXÃO
        $crud = new ClassModel();
        $select = $crud->select('*', 'entidade ', "", array());
        $result = $select->fetchAll();
        foreach ($result as $data) {
            $razao_social = $data['razao_social'];
            $email = $data['email'];
        }
        
        $mensagem = utf8_decode(strip_tags(trim($_POST['mensagem_resposta'])));
        $para = utf8_decode(strip_tags(trim($_POST['email_destino'])));
        $assunto = "Contato - OUVIDORIA";
        $body .= "<br /><br /><strong>Assunto:</strong> $assunto<br /><br /><strong>Mensagem:</strong><br /> $mensagem";
        $headers = "Content-Type:text/html; charset=UTF-8\n";
        $headers .= "From:  camaraico.ce.gov.br<no-reply@camaraico.ce.gov.br>\n";
        $headers .= "X-Sender:  <no-reply@diocesanohotel.com.br>\n";
        $headers .= "X-Mailer: PHP  v" . phpversion() . "\n";
        $headers .= "X-IP:  " . $_SERVER['REMOTE_ADDR'] . "\n";
        $headers .= "Return-Path:  <no-reply@camaraico.ce.gov.br>\n";
        $headers .= "MIME-Version: 1.0\n";
        $envio = mail($para, $assunto, $body, $headers, "-r" . "contato@camaraico.ce.gov.br");

        if ($envio) {
            echo"Enviardo com sucesso!";
        } else {
            echo "<script>window.alert('A mensagem não foi enviada!')</script>";
            echo "Erro: " . $Email->ErrorInfo;
        }
    }

    public function salvarResposta() {
        
        $val = new ClassValidacao();
        $val->set($_POST['email_destino'], '<b>"Para.."</b> corresponde ao endereço de email que deseja enviar uma restposta,')->obrigatorio();
        $post = filter_var_array($_POST, FILTER_SANITIZE_SPECIAL_CHARS);
        $post['data'] = date("Y-m-d H:i:s");

        if ($val->validar()) {
            $crud = new ClassModel();
            print $crud->insert($post, 'enviadas ');
        } else {
            foreach ($val->getErrors() as $erro) {
                echo "$erro <br />";
            }
        }
    }

}
