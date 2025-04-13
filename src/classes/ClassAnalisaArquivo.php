<?php

class ClassAnalisaArquivo {

    private $arquivoNome;
    private $arquivoTipo;
    private $arquivoTamanho;

    public function analisaArquivo() {

        $extensoes_autorizadas = array('.jpg', '.jpeg', '.pjpeg', '.png', '.webp');
        $extensao_arquivo = strrchr($this->getArquivoNome(), '.');
        if (!empty($extensoes_autorizadas) && !in_array($extensao_arquivo, $extensoes_autorizadas)) {
            exit('<center><b>Atenção</b></center> Tipo de arquivo não permitido. Extensões Permitidas: <br/> ".jpg" <br/> ".jpeg" <br/> ".pjpeg" <br/> ".png" <br/> ".webp"');
        }

        $limitar_tamanho = 0;
        if ($limitar_tamanho && $limitar_tamanho < $this->getArquivoTamanho()) {
            exit('<b>Atenção: </b> Arquivo excede tamanho maximo permitido!');
        }

        return TRUE;
    }

    public function getArquivoTipo() {
        return $this->setArquivoTipo();
    }

    public function setArquivoTipo() {
        return $this->arquivoTipo = $_FILES['seleciona-imagem']['type'];
    }

    public function getArquivoTamanho() {
        return $this->setArquivoTamanho();
    }

    public function setArquivoTamanho() {
        return $this->arquivoTamanho = $_FILES['seleciona-imagem']['size'];
    }

    public function getArquivoNome() {
        return $this->setArquivoNome();
    }

    public function setArquivoNome() {
        return $this->arquivoNome = $_FILES['seleciona-imagem']['name'];
    }

}
