<?php

session_start();
require_once '../../src/classes/ClassAnalisaArquivo.php';
require_once '../../src/classes/ClassRedimensionaImagem.php';
require_once '../../src/classes/ClassUploadFtp.php';
require_once '../../app/model/ClassModel.php';

class ControllerUploadImagens {

    private $id;
    private $table;
    private $dominio;
    private $arquivoNome;
    private $arquivoTemp;
    private $arquivoTipo;
    private $arquivoTamanho;
    private $altura;
    private $largura;

    public function uploadInsert() {
        $tables = array('header', 'slide', 'banner');
        $ClassAnalisaArquivo = new ClassAnalisaArquivo();
        $ClassUploadFtp = new ClassUploadFtp();
        $ClassAnalisaArquivo->analisaArquivo();

        if (in_array($this->getTable(), $tables)) {
            $ClassRedimensionaImagem = new ClassRedimensionaImagem();
            $redimensiona = $ClassRedimensionaImagem->redimensiona($this->getAltura(), $this->getLargura());
            if (!$redimensiona) {
                exit("Não foi possivel redimensionar a imagem!");
            }
            $arquivo_temp = $ClassRedimensionaImagem->getArquivoRedimensionado();
            $arquivo_nome = $ClassRedimensionaImagem->getArquivoNome();
            $uploadFtp = $ClassUploadFtp->uploadFtp($arquivo_temp, $arquivo_nome);
            if (!$uploadFtp) {
                exit("Não foi possivel fazer o upload!");
            }
        } else {
            $arquivo_temp = $this->getArquivoTemp();
            $arquivo_nome = $this->getArquivoNome();
            $uploadFtp = $ClassUploadFtp->uploadFtp($arquivo_temp, $arquivo_nome);
            if (!$uploadFtp) {
                exit("Não foi possivel fazer o upload!");
            }
        }

        $insert = $this->insert();
        if ($insert) {
            echo "Arquivo <b>" . $this->getArquivoNome() . "</b> enviado com ssucesso";
        } else {
            echo "Não foi possivel enviar o arquivo <b>" . $this->getArquivoNome() . "</b>!";
        }
    }

    public function insert() {
        $post = [
            'id_tabela_pai' => $this->getId(),
            'tabela_pai' => $this->getTable(),
            'nome' => $this->getArquivoNome(),
            'tipo' => $this->getArquivoTipo(),
            'tamanho' => $this->getArquivoTamanho(),
            'dominio' => $this->getDominio(),
            'caminho_absoluto' => $this->getDominio() . '/img/' . $this->getArquivoNome(),
            'caminho_relativo' => '../img/'.$this->getArquivoNome(),
            'usuario' => '$usuario',
            'data' => date('Y-m-d'),
            'hora' => date('H:i:s')
        ];
        $crud = new ClassModel();
        $crud->insert($post, 'arquivos');
        return TRUE;
    }

    public function update() {
        $crud = new ClassModel();
        $id = $this->getId();
        $table = $this->getTable();
        $arquivo_nome = $this->getArquivoNome();
        $dominio = $this->getDominio();
        $imagem_url = 'http://' . $dominio . '/img/' . $arquivo_nome;
        $post = ['imagem_nome' => $arquivo_nome, 'imagem_url' => $imagem_url];
        $crud->update($table, $post, $id);
        return TRUE;
    }

    public function uploadUpdate() {
        $ClassAnalisaArquivo = new ClassAnalisaArquivo();
        $ClassUploadFtp = new ClassUploadFtp();
        $ClassAnalisaArquivo->analisaArquivo();

        $arquivo_temp = $this->getArquivoTemp();
        $arquivo_nome = $this->getArquivoNome();
        $uploadFtp = $ClassUploadFtp->uploadFtp($arquivo_temp, $arquivo_nome);
        if (!$uploadFtp) {
            exit("Não foi possivel fazer o upload!");
        }

        $update = $this->update();
        if ($update) {
            echo "Arquivo <b>" . $this->getArquivoNome() . "</b> enviado com ssucesso";
        } else {
            echo "Não foi possivel enviar o arquivo <b>" . $this->getArquivoNome() . "</b>!";
        }
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

    public function getArquivoTemp() {
        return $this->setArquivoTemp();
    }

    public function setArquivoTemp() {
        return $this->arquivoTemp = $_SERVER['DOCUMENT_ROOT'] . '/NOVO-PAINEL-NOVO/public_html/temp/' . $this->getArquivoNome();
    }

    public function setDominio() {
        $crud = new ClassModel();
        $select = $crud->select('*', 'entidade ', "", array());
        $result = $select->fetchAll();
        foreach ($result as $data) {
            $dominio = $data['dominio'];
        }
        return $this->dominio = $dominio;
    }

    public function getDominio() {
        return $this->setDominio();
    }

    public function getTable() {
        return $this->setTable();
    }

    public function setTable() {
        return $this->table = filter_input(INPUT_POST, 'tabela', FILTER_SANITIZE_SPECIAL_CHARS);
    }

    public function getId() {
        return $this->setId();
    }

    public function setId() {
        return $this->id = filter_input(INPUT_POST, 'id_tabela', FILTER_SANITIZE_SPECIAL_CHARS);
    }

    public function getAltura() {
        return $this->setAltura();
    }

    public function setAltura() {
        $table = $this->getTable();
        switch ($table) :
            case 'header';
                return $this->altura = '1380';
                break;
            case 'slide';
                return $this->altura = '1380';
                break;
            case 'banner';
                return $this->altura = '465';
                break;
        endswitch;
    }

    public function getLargura() {
        return $this->setLargura();
    }

    public function setLargura() {
        $table = $this->getTable();
        switch ($table) :
            case 'header';
                return $this->largura = '186';
                break;
            case 'slide';
                return $this->largura = '306';
                break;
            case 'banner';
                return $this->largura = '400';
                break;
        endswitch;
    }

}
