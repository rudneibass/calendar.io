<?php

ini_set('display_errors', 1);
ini_set('log_errors', 1);
ini_set('error_log', dirname(__FILE__) . '/error_log.txt');
error_reporting(E_ALL);

session_start();
require_once '../../app/model/MasterClassModel.php';
require_once '../../app/model/ClassValidacao.php';
require_once '../../src/classes/ClassUploadFtpImages.php';

class ControllerMasterUpload {

    public $id;
    public $table;
    public $dominio;
    public $urlStorage;
    public $arquivoTemp;
    public $arquivoNome;

    public $servidor_ftp;
    public $usuario_ftp;
    public $senha_ftp;
    public $dir_arquivos;
    public $dir_imagens;
    

    public function __construct()
    {
        $this->servidor_ftp = 'ftp.sitew2e.tecnologia.ws';
        $this->usuario_ftp = 'sitew2etecnologi1';
        $this->senha_ftp = 'W2etecnologia@locaweb';
        $this->dir_arquivos = 'arquivos';
        $this->dir_imagens = 'imagens';
        $this->urlStorage = 'https://sitew2e.com.br';
    }


    public function redimensionaEnvia()
    {
        $table = $this->getTable();
        switch ($table):
            case "noticias";
                $altura = "400";
                $largura = "600";
                break;
        endswitch;

        switch ($_FILES['seleciona-imagem']['type']):
            case 'image/jpeg';
            case 'image/jpg';
            case 'image/pjpeg';
                //REDIMENCIONAMENTO
                $imagem_temporaria = imagecreatefromjpeg($_FILES['seleciona-imagem']['tmp_name']);
                $largura_original = imagesx($imagem_temporaria);
                $altura_original = imagesy($imagem_temporaria);
                $nova_largura = $largura ? $largura : floor(($largura_original / $altura_original) * $altura);
                $nova_altura = $altura ? $altura : floor(($altura_original / $largura_original) * $largura);
                $imagem_redimensionada = imagecreatetruecolor($nova_largura, $nova_altura);
                imagecopyresampled($imagem_redimensionada, $imagem_temporaria, 0, 0, 0, 0, $nova_largura, $nova_altura, $largura_original, $altura_original);
                //SALVA IMAGEM REDIMENSIONADA EM UM DIRETORIO LOCAL ANTES DE ENVIAR PRO FTP
                imagejpeg($imagem_redimensionada, '../../public_html/temp/' . $this->getArquivoNome());

                break;

            case 'image/png':
            case 'image/x-png';
                //REDIMENCIONAMENTO
                $imagem_temporaria = imagecreatefrompng($_FILES['seleciona-imagem']['tmp_name']);
                $largura_original = imagesx($imagem_temporaria);
                $altura_original = imagesy($imagem_temporaria);
                $nova_largura = $largura ? $largura : floor(($largura_original / $altura_original) * $altura);
                $nova_altura = $altura ? $altura : floor(($altura_original / $largura_original) * $largura);
                $imagem_redimensionada = imagecreatetruecolor($nova_largura, $nova_altura);

                // Preserve transparency
                imagecolortransparent($imagem_redimensionada, imagecolorallocatealpha($imagem_redimensionada, 0, 0, 0, 127));
                imagealphablending($imagem_redimensionada, false);
                imagesavealpha($imagem_redimensionada, true);

                imagecopyresampled($imagem_redimensionada, $imagem_temporaria, 0, 0, 0, 0, $nova_largura, $nova_altura, $largura_original, $altura_original);
                imagepng($imagem_redimensionada, '../../public_html/temp/' . $this->getArquivoNome()); //SALVA IMAGEM REDIMENSIONADA EM UM DIRETORIO LOCAL ANTES DE ENVIAR PRO FTP

                break;
        endswitch;

        $ftp = $this->uploadFtp($this->getArquivoNome(), $this->getArquivoTemp());

        if ($ftp) {

            $update = $this->update();
            if ($update) {
                echo 'Arquivo <b>' . $this->getArquivoNome() . '</b> Enviado com sucesso';
            } else {
                echo 'Não foi possivel salvar <b>' . $this->getArquivoNome() . '</b>. Entre em contato com o administrador';
            }
        } else {
            echo 'Não foi possivel salvar <b>' . $this->getArquivoNome() . '</b>. Entre em contato com o administrador. [Código do erro: <RT><AP><CR><CRI><106>]';
        }
    }

    public function update()
    {
        $post['imagem_url'] = $this->urlStorage . '/imagens/' . $this->getArquivoNome();
        $crud = new MasterClassModel();
        $crud->update('master_noticias', $post, $this->getId());
        return TRUE;
    }

    public function uploadFtp($nome_arquivo, $arquivo_temp)
    {

        $novo_arquivo_url = 'public_html/' . $this->dir_imagens . '/' . $nome_arquivo;
        $conexao_ftp = ftp_connect($this->servidor_ftp);
 
        $login_ftp = ftp_login($conexao_ftp, $this->usuario_ftp, $this->senha_ftp);
        if (!$login_ftp) {
            exit('<b>Atenção: </b>Sua conexão com o servidor foi recusada, por favor verifique suas credenciais!');
        }


        ftp_pasv($conexao_ftp, true) or die("Não foi possivel enviar o(s) arquivo(s)! <br/> Código do Erro: [RT-SC-CUFM-63]");

        if (ftp_put($conexao_ftp, $novo_arquivo_url, $arquivo_temp, FTP_BINARY)) {
            return TRUE;
        } else {
            exit("Não foi possivel enviar o(s) arquivo(s)!");
            return FALSE;
        }
    }



    public function getArquivoNome() {
        return $this->setArquivoNome();
    }

    public function setArquivoNome() {
        return $this->arquivoNome = $_FILES['seleciona-imagem']['name'];
    }

    public function getArquivoTemp(){
        return $this->setArquivoTemp();
    }

    public function setArquivoTemp(){
        return $this->arquivoTemp = $_SERVER['DOCUMENT_ROOT'] . 'temp/' . $_FILES['seleciona-imagem']['name'];
    }


    public function getTable(){
        return $this->setTable();
    }

    public function setTable(){
        return $this->table = filter_input(INPUT_POST, 'tabela', FILTER_SANITIZE_SPECIAL_CHARS);
    }

    public function getId(){
        return $this->setId();
    }

    public function setId(){
        return $this->id = filter_input(INPUT_POST, 'id_tabela', FILTER_SANITIZE_SPECIAL_CHARS);
    }
}
