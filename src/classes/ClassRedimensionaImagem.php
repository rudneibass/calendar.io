<?php

class ClassRedimensionaImagem {

    private $arquivoNome;
    private $arquivoRedimensionado;

    public function redimensiona($altura, $largura) {

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
                imagejpeg($imagem_redimensionada, '../temp/' . $this->getArquivoNome());
                
                break;
            case 'image/png':
            case 'image/x-png';
                //REDIMENCIONAMENTO
                $imagem_temporaria = imagecreatefrompng($_FILES['seleciona-imagem']['tmp_name']);
                $largura_original = imagesx($imagem_temporaria);
                $altura_original = imagesy($imagem_temporaria);
                $nova_largura = $largura ? $largura : floor(( $largura_original / $altura_original ) * $altura);
                $nova_altura = $altura ? $altura : floor(( $altura_original / $largura_original ) * $largura);
                $imagem_redimensionada = imagecreatetruecolor($nova_largura, $nova_altura);
                imagecopyresampled($imagem_redimensionada, $imagem_temporaria, 0, 0, 0, 0, $nova_largura, $nova_altura, $largura_original, $altura_original);
                //SALVA IMAGEM REDIMENSIONADA EM UM DIRETORIO LOCAL ANTES DE ENVIAR PRO FTP
                imagepng($imagem_redimensionada, '../temp/' . $this->getArquivoNome());
                
                break;
        endswitch;

        return TRUE;
    }

    public function getArquivoRedimensionado() {
        return $this->setArquivoRedimensionado();
    }

    public function setArquivoRedimensionado() {
        return $this->arquivoRedimensionado = $_SERVER['DOCUMENT_ROOT'] . '/public_html/temp/' . $_FILES['seleciona-imagem']['name'];
    }

    public function getArquivoNome() {
        return $this->setArquivoNome();
    }

    public function setArquivoNome() {
        return $this->arquivoNome = $_FILES['seleciona-imagem']['name'];
    }

}
