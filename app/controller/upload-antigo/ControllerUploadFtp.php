<?php

class ControllerUploadFtp {

    function teste() {
        echo 'function teste() Controller UploadFtp ';
    }

    public function uploadFtp($arquivo_temp, $nome_arquivo) {
        //PARAMETROS DE CONEXÃO
        $crud = new ClassModel();
        $select = $crud->select('*', 'entidade ', "", array());
        $result = $select->fetchAll();
        foreach ($result as $data) {
            $servidor_ftp = $data['servidor_ftp'];
            $usuario_ftp = $data['usuario_ftp'];
            $senha_ftp = $data['senha_ftp'];
        }
        if (empty($servidor_ftp) or empty($usuario_ftp) or empty($senha_ftp)) {
            exit("<b>Atenção: </b>Não foi possivel realizar o envio, parametros de conexão não configurados. Entre em contato com o administrador!");
        }

        //CONEXÃO PROPRIMENTE DITA
        set_time_limit(0); // Configura o tempo limite para ilimitado
        $conexao_ftp = ftp_connect($servidor_ftp); //Realiza a conexão   
        $login_ftp = ftp_login($conexao_ftp, $usuario_ftp, $senha_ftp); //Tenta fazer login
        if (!$login_ftp) {
            exit('<b>Atenção: </b>Sua conexão com o servidor foi recusada, por favor verifique suas credenciais!');
        }
        ftp_pasv($conexao_ftp, true) or die("Não foi possível alternar para o modo passivo"); //Muda a conexao para o modo passivo0 
        //UPLOAD
        $destino_ftp = '/public_html/img/' . $nome_arquivo; // destino da pasta FTP 
        if (ftp_put($conexao_ftp, $destino_ftp, $arquivo_temp, FTP_BINARY)) {
            
        } else {
            echo '<b>Atenção: </b>Erro na tranferência FTP de <b> ' . $arquivo_temp . '<b/>';
        }

        //ENCERRA CONEXÃO
        ftp_close($conexao_ftp);
     
        return TRUE;
    }
}
