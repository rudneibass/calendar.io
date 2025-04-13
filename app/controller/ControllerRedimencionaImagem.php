<?php

ini_set('display_errors', 1);
ini_set('log_errors', 1);
ini_set('error_log', dirname(__FILE__) . '/error_log.txt');
error_reporting(E_ALL);

session_start();
require_once '../../app/model/ClassModel.php';
require_once '../../app/model/ClassValidacao.php';
require_once '../../src/classes/ClassUploadFtpImages.php';

class ControllerRedimencionaImagem extends ClassUploadFtpImages
{
    private $id;
    public $table;
    
    public $cnpj;
    public $dominio;
    public $urlStorage;

    private $arquivoNome;
    private $arquivoTemp;
    private $arquivoTipo;
    private $arquivoTamanho;

    private $ftpUploader;

    public function __construct(){
        $this->setId();
        $this->setTable();

        $this->setCnpj();
        $this->setDominio();
        $this->setUrlStorage();
        
        $this->setArquivoNome();
        $this->setArquivoTemp();
        $this->setArquivoTipo();
        $this->setArquivoTamanho();

        $this->setFtpUploader();
        
    }

    public function redimensiona() {
        if($this->table == 'arquivos'){
            $this->proccessWithoutResizing();
        } else {
            $this->resize();
        }
        $this->uploadToFtp();
        $this->persistOnDB();
        echo "Arquivo enviado com sucesso!";
    }

    public function resize() {
        $table = $this->getTable();     
        if($table !== 'videos'){
            switch ($table):
                case "logo";
                    $jpg = array('image/jpeg', 'image/jpg', 'image/pjpeg');
                    if(in_array($_FILES['seleciona-imagem']['type'], $jpg)){
                        $imagem_temporaria = imagecreatefromjpeg($_FILES['seleciona-imagem']['tmp_name']);
                        $altura = imagesy($imagem_temporaria);
                        $largura= imagesx($imagem_temporaria);
                    }

                    $png = array('image/png', 'image/x-png');
                    if(in_array($_FILES['seleciona-imagem']['type'], $png)){
                        $imagem_temporaria = imagecreatefrompng($_FILES['seleciona-imagem']['tmp_name']);
                        $altura = imagesy($imagem_temporaria);
                        $largura= imagesx($imagem_temporaria);
                    }
                    
                    break;
                case "header";
                    $altura = "186";
                    $largura = "1380";
                    break;
                case "slide";
                    $altura = "306";
                    $largura = "1380";
                    break;
                case "banner";
                    $altura = "400";
                    $largura = "465";
                    break;
                case "noticias";
                    $altura = "400";
                    $largura = "600";
                    break;
                case "servidor";
                    $altura = "470";
                    $largura = "350";
                    break;
                case "servidor";
                    $altura = "470";
                    $largura = "350";
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
        }    
    }

    public function uploadToFtp(){
        try{
             
            $this->ftpUploader->setCredentials();
            $upload = $this->ftpUploader->uploadFtp($this->getArquivoNome(), $this->getArquivoTemp());

            if (!$upload) {
                throw new Exception('Não foi possivel salvar <b>' . $this->getArquivoNome() . '</b>. Entre em contato com o administrador.');
            }
        } catch (Exception $e){
            echo $e->getMessage();
            die;
        }
    }

    public function persistOnDB(){
        try{
            if (in_array($this->table, array('noticias', 'servidor'))) {
                $update = $this->update();
                if (!$update) {
                    throw new Exception('Não foi possivel salvar <b>' . $this->getArquivoNome() . '</b>. Entre em contato com o administrador');
                }
            }
    
            if(!in_array($this->table, array('noticias', 'servidor'))){
                $insert = $this->insert();
                if (!$insert) {
                    throw new Exception('Não foi possivel salvar <b>' . $this->getArquivoNome() . '</b>. Entre em contato com o administrador');
                }
            } 
        } catch (Exception $e){
            echo $e->getMessage();
            die;
        }
    }

    public function proccessWithoutResizing(){
        switch ($_FILES['seleciona-imagem']['type']):
            case 'image/png':
            case 'image/x-png':
                $image = imagecreatefrompng($_FILES['seleciona-imagem']['tmp_name']);
        
                // Preserve transparency
                imagecolortransparent($image, imagecolorallocatealpha($image, 0, 0, 0, 127));
                imagealphablending($image, false);
                imagesavealpha($image, true);

                imagepng($image, '../../public_html/temp/' . $this->getArquivoNome());
                imagedestroy($image);
                break;
        
            default:
                $image = imagecreatefromjpeg($_FILES['seleciona-imagem']['tmp_name']);
                imagejpeg($image, '../../public_html/temp/' . $this->getArquivoNome());
                imagedestroy($image);
        endswitch;
    }
    
    public function insert()
    { 
        $post = [
            'id_tabela_pai' => $this->getId(),
            'tabela_pai' => $this->getTable(),
            'nome' => $this->getArquivoNome(),
            'tipo' => $this->getArquivoTipo(),
            'tamanho' => $this->getArquivoTamanho(),
            'dominio' => $this->getUrlStorage(),
            'caminho_absoluto' => $this->getUrlStorage() . '/img/' . $this->getCnpj() . '/' . $this->getArquivoNome(),
            'caminho_relativo' => '../img/' . $this->getCnpj() . '/' . $this->getArquivoNome(),
            'link' => filter_input(INPUT_POST, 'link', FILTER_SANITIZE_URL),
            'usuario' => $_SESSION['USUARIO'],
            'data' => date('Y-m-d'),
            'hora' => date('H:i:s')
        ];

        $crud = new ClassModel();
        $crud->insert($post, 'arquivos');
        return TRUE;
    }

    public function update()
    {
        $post['imagem_url'] = $this->getUrlStorage() . '/img/' . $this->getCnpj() . '/' . $this->getArquivoNome();
        $crud = new ClassModel();
        $crud->update($this->getTable(), $post, $this->getId());
        return TRUE;
    }

    public function sanitizeFileName($fileName){
        $nomeArquivo = $fileName;
        $nomeArquivo = preg_replace('/[^a-zA-Z0-9._-]/', '_', $nomeArquivo);
        $extensao = strtolower(pathinfo($nomeArquivo, PATHINFO_EXTENSION));
        $novoNome = pathinfo($nomeArquivo, PATHINFO_FILENAME);
        $novoNome = $novoNome . '_' . time() . '.' . $extensao;
        return $novoNome;
    }

    public function getArquivoTipo() {
        return $this->arquivoTipo;
    }

    public function getArquivoTamanho(){
        return $this->arquivoTamanho;
    }

    public function getArquivoNome(){
        return $this->arquivoNome;
    }

    public function getArquivoTemp(){
        return $this->arquivoTemp;
    }
    public function getDominio(){
        return $this->dominio;
    }

    public function getUrlStorage(){
        return $this->urlStorage;
    }

    public function getCnpj(){
        return $this->cnpj;
    }

    public function getTable(){
        return $this->table;
    }
    
    public function getId(){
        return $this->id;
    }

    public function getFtpUploader(){
        return $this->ftpUploader;
    }

    public function setTable(){
        return $this->table = filter_input(INPUT_POST, 'tabela', FILTER_SANITIZE_SPECIAL_CHARS);
    }

    public function setId(){
        return $this->id = filter_input(INPUT_POST, 'id_tabela', FILTER_SANITIZE_SPECIAL_CHARS);
    }

    public function setArquivoTipo() {
        return $this->arquivoTipo = $_FILES['seleciona-imagem']['type'];
    }

    public function setArquivoTamanho(){
        return $this->arquivoTamanho = $_FILES['seleciona-imagem']['size'];
    }

    public function setArquivoNome(){
        return $this->arquivoNome = $this->sanitizeFileName($_FILES['seleciona-imagem']['name']);
    }

    public function setArquivoTemp(){
        return $this->arquivoTemp = $_SERVER['DOCUMENT_ROOT'] . '/temp/' . $_FILES['seleciona-imagem']['name'];
    }

    public function setDominio()
    {
        $crud = new ClassModel();
        $select = $crud->select('*', 'entidade ', "", array());
        $result = $select->fetchAll();
        foreach ($result as $data) {
            $dominio = $data['dominio'];
        }
        return $this->dominio = $dominio;
    }

    public function setUrlStorage(){
        $crud = new ClassModel();
        $select = $crud->select('*', 'entidade ', "", array());
        $result = $select->fetchAll();
        foreach ($result as $data) {
            $urlStorage = $data['url_storage'];
        }
        return $this->urlStorage = $urlStorage;
    }

    public function setCnpj(){
        $crud = new ClassModel();
        $select = $crud->select('*', 'entidade ', "", array());
        $result = $select->fetchAll();
        foreach ($result as $data) {
            $cnpj = $data['cnpj'];
        }
        return $this->cnpj = $cnpj;
    }

    public function setFtpUploader(){
        $this->ftpUploader = new ClassUploadFtpImages();
    }

}
