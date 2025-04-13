<?php

class ClassUploadFtpFiles
{

    public $dominio;
    public $servidor_ftp;
    public $usuario_ftp;
    public $senha_ftp;
    public $cnpj;
    public $url_storage;
    public $dir_arquivos;
    public $dir_imagens;

    public function __construct()
    {

        require_once '../../app/model/ClassModel.php';
        $crud = new ClassModel();
        $select = $crud->select('*', 'entidade ', "", array());
        $result = $select->fetchAll();
        foreach ($result as $data) {
            $this->dominio = $data['dominio'];
            $this->servidor_ftp = $data['servidor_ftp'];
            $this->usuario_ftp = $data['usuario_ftp'];
            $this->senha_ftp = $data['senha_ftp'];
            $this->cnpj = $data['cnpj'];
            $this->url_storage = $data['url_storage'];
            $this->dir_arquivos = $data['dir_arquivos'] ;
            $this->dir_imagens = $data['dir_imagens'];
        }

        if (empty($this->servidor_ftp) or empty($this->usuario_ftp) or empty($this->senha_ftp)) {
            exit("<b>Atenção: </b>Não foi possivel realizar o envio, parametros de conexão não configurados. Entre em contato com o administrador");
        }
    }

    public function uploadFtp($nome_arquivo, $arquivo_temp, $tipo_arquivo)
    {
        if($tipo_arquivo){

        }
        $novo_arquivo_url = $this->dir_arquivos. $this->cnpj . '/' . $nome_arquivo; 
        $conexao_ftp = ftp_connect($this->servidor_ftp);

        //LOGIN ON FTP
        $login_ftp = ftp_login($conexao_ftp, $this->usuario_ftp, $this->senha_ftp);
        if (!$login_ftp) {
            exit('<b>Atenção: </b>Sua conexão com o servidor foi recusada, por favor verifique suas credenciais!');
        }

        //LISTA DIRETORIOS DO FTP
        $arrayDiretorios = ftp_nlist($conexao_ftp, "public_html/arquivos/");

        //VERIFICA SE EXISTE DIRETORIO COM CNPJ
        if (!in_array($this->cnpj, $arrayDiretorios)) {
            //PREPARA O UM DIRETORIO PARA RECEBER A CRIAÇÃO  DE UM SUBDIRETÓRIO
            if(ftp_chdir($conexao_ftp, $this->dir_arquivos)){
                //CRIA O SUBDIRETÓRIO
                if(!ftp_mkdir($conexao_ftp, $this->cnpj)){
                    exit("Não foi possivel enviar o(s) arquivo(s)! <br/> Código do Erro: [RT-SC-CUFM-55]");
                }
            }else{
                exit("Não foi possivel enviar o(s) arquivo(s)! <br/> Código do Erro: [RT-SC-CUFM-58]");
            }
        }

        //MUDA A CONEXÃO PARA O MODO PASSIVO
        ftp_pasv($conexao_ftp, true) or die("Não foi possivel enviar o(s) arquivo(s)! <br/> Código do Erro: [RT-SC-CUFM-63]"); 
        
        //ENVIA OS AQUIVOS PARA O SERVIDOR
        if (ftp_put($conexao_ftp, $novo_arquivo_url, $arquivo_temp, FTP_BINARY)) {
            return TRUE;
        } else {
            exit("Não foi possivel enviar o(s) arquivo(s)! <br/> Código do Erro: [RT-SC-CUFM-69]");
            return FALSE;
        }
    }
}
