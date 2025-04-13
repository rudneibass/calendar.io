<?php
ini_set('display_errors', 1);
ini_set('log_errors', 1);
ini_set('error_log', dirname(__FILE__) . '/error_log.txt');
error_reporting(E_ALL);

session_start();
require_once '../../config/header.php';
require_once '../../app/model/ClassModel.php';
require_once '../../app/model/ClassValidacao.php';
require_once '../../app/model/ClassValidacaoArquivos.php';
require_once '../../src/classes/ClassUploadFtpFiles.php';


class ControllerUploadMultiplo extends ClassUploadFtpFiles {

    public $cnpj;
    public $dominio;
    public $url_storage;
    public $dir_arquivos;
    public $dir_imagens;

    public function __construct()
    {
        $crud = new ClassModel();
        $select = $crud->select('*', 'entidade ', "", array());
        $result = $select->fetchAll();
        foreach ($result as $data) {
            $this->cnpj = $data['cnpj'];
            $this->dominio = $data['dominio'];    
            $this->url_storage = $data['url_storage'];
            $this->dir_arquivos = $data['dir_arquivos'];
            $this->dir_imagens = $data['dir_imagens'];
        }

        if (empty($this->url_storage) or empty($this->dir_arquivos) or empty($this->dir_imagens)  or empty($this->dominio)  or empty($this->cnpj)) {
            exit('<b>Atenção: </b>Acesse o cadastro da entidade e forneça "CNPJ", "Domínio", "Url Storage", "Diretório de Arquivos (FTP)" e "Diretório de Imagens (FTP)"');
        }
    }

    public function analisaArquivo() {
        $val = new ClassValidacaoArquivos();
        $arquivo = $_FILES['arquivo'];
        $indice = count(array_filter($arquivo["name"]));
       
        if ($indice <= 0) {
            exit('<b>Atenção: </b>Nenhum arquivo selecionado!');
        }

        for ($i = 0; $i < $indice; $i ++) {

            $nome_arquivo = $this->sanitizeFileName($arquivo['name'][$i]);
            $tamanho_arquivo = $arquivo['size'][$i];
            $arquivo_temp = $arquivo['tmp_name'][$i];
            $tipo_arquivo = $arquivo['type'][$i];

            //$val->arquivoExistente($nome_arquivo);
            //$val->permissaoExtensao($nome_arquivo);
            $val->permissaoTamanho($nome_arquivo, $tamanho_arquivo);
            
            $tipos_imagem = array('image/jpeg', 'image/jpg','image/pjpeg', 'image/png','image/x-png');

            if(in_array($tipo_arquivo, $tipos_imagem)){
                $diretorio_ftp = $this->dir_imagens; 
                $diretorio_url = str_replace('/public_html', '', $this->dir_imagens); 
                $path_arquivo_ftp = $this->dir_imagens. $this->cnpj . '/' . $nome_arquivo;

            } else {
                $diretorio_ftp = $this->dir_arquivos; 
                $diretorio_url = str_replace('/public_html', '', $this->dir_arquivos);
                $path_arquivo_ftp = $this->dir_arquivos. $this->cnpj . '/' . $nome_arquivo;
            }


            $upload = $this->uploadFtp($path_arquivo_ftp, $arquivo_temp, $diretorio_ftp, $this->cnpj);
            if($upload){
                $insert = $this->insert($nome_arquivo, $tipo_arquivo, $tamanho_arquivo, $diretorio_url);
            }else{
                echo "Não foi possivel enviar o(s) arquivo(s)!";
            }
            

            if ($upload && $insert) {
                echo "-<b>" . $nome_arquivo . "</b> enviado com sucesso<br/>";
            }

            # Upload Segundo Plano
            # exec("php /caminho/do/seu_script_upload_local.php > /dev/null 2>&1 &");
            # pclose(popen("start php.exe C:\caminho\do\seu_script_upload_local.php", "r"));
            # $command = "php /caminho/do/seu_script_upload_local.php";
            # $process = proc_open($command, [], $pipes);
        }
        return TRUE;
    }

    public function insert($nome_arquivo, $tipo_arquivo, $tamanho_arquivo, $diretorio_url) {
        $val = new ClassValidacao();
        $val->set($_POST['tabela_pai'], '<b>" tabela_pai"</b>')->obrigatorio();
        $val->set($_POST['id_tabela_pai'], '<b>"id_tabela_pai"</b>')->obrigatorio();
        if ($val->validar()) {
            $post = filter_var_array($_POST, FILTER_SANITIZE_SPECIAL_CHARS);
            $post['nome'] = $nome_arquivo;
            $post['tipo'] = $tipo_arquivo;
            $post['tamanho'] = $tamanho_arquivo;
            $post['dominio'] = $this->dominio;
            $post['caminho_absoluto'] = $this->url_storage . $diretorio_url . $this->cnpj .'/'. $nome_arquivo;
            $post['caminho_relativo'] = '..'.$diretorio_url. $this->cnpj .'/' . $nome_arquivo;
            $post['usuario'] = $_SESSION['USUARIO'];
            $post['data'] = date('Y-m-d');
            $post['hora'] = date('H:i:s');
            $crud = new ClassModel();
            print $crud->insert($post, 'arquivos ');
        } else {
            foreach ($val->getErrors() as $erro) {
                echo "$erro <br />";
            }
        }
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
}
