<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once '../../app/model/ClassModel.php';

class ClassUploadFtpFiles
{
    public $servidor_ftp;
    public $usuario_ftp;
    public $senha_ftp;

    public function uploadFtp($nome_arquivo, $arquivo_temp, $diretorio_ftp, $cnpj)
    {
        $crud = new ClassModel();
        $select = $crud->select('*', 'entidade ', "", array());
        $result = $select->fetchAll();
        foreach ($result as $data) {
            $this->servidor_ftp = $data['servidor_ftp'];
            $this->usuario_ftp = $data['usuario_ftp'];
            $this->senha_ftp = $data['senha_ftp'];
        }

        

        
        if (empty($this->servidor_ftp) or empty($this->usuario_ftp) or empty($this->senha_ftp)) {
            exit("<b>Atenção: </b>Não foi possivel realizar o envio, parametros de conexão não configurados. Entre em contato com o administrador");
        }

        $conexao_ftp = ftp_connect($this->servidor_ftp);
        $login_ftp = ftp_login($conexao_ftp, $this->usuario_ftp, $this->senha_ftp);
        
        if (!$login_ftp) {
            exit('<b>Atenção: </b>Sua conexão com o servidor foi recusada, por favor verifique suas credenciais!');
        }

        ftp_pasv($conexao_ftp, true) or die("Não foi possivel enviar o(s) arquivo(s)!"); 

        $arrayDiretorios = ftp_nlist($conexao_ftp, $diretorio_ftp);
        
        if (!in_array($this->cnpj, $arrayDiretorios)) {
            if(ftp_chdir($conexao_ftp, $diretorio_ftp)){
                if(!ftp_mkdir($conexao_ftp, $cnpj)){
                    exit("Não foi possivel enviar o(s) arquivo(s)!");
                }
            }else{
                exit("Não foi possivel enviar o(s) arquivo(s)!");
            }
        }

        if (ftp_put($conexao_ftp, $nome_arquivo, $arquivo_temp, FTP_BINARY)) {
            return TRUE;
        } else {
            exit("Não foi possivel enviar o(s) arquivo(s)!");
            return FALSE;
        }
    }
}
