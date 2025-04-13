<?php

require_once '../../app/model/ClassModel.php';
require_once '../../app/model/ClassValidacao.php';

class ControllerUploadSingle {

    private $table;
    private $id;

    function teste() {
        echo 'function teste() ControllerUploadImagens ';
    }

    public function analisaArquivo() {

        $arquivo = $_FILES['seleciona-imagem'];
        $nome_arquivo = $this->getId() . '-' . $arquivo['name'];
        $tamanho_arquivo = $arquivo['size'];
        $tipo_arquivo = $arquivo['type'];
        $arquivo_temp = $arquivo['tmp_name'];

        $extensoes_autorizadas = array('.jpg', '.jpeg', '.pjpeg', '.png', '.webp');
        $extensao_arquivo = strrchr($nome_arquivo, '.');
        if (!empty($extensoes_autorizadas) && !in_array($extensao_arquivo, $extensoes_autorizadas)) {
            exit('<center><b>Atenção</b></center> Tipo de arquivo não permitido. Extensões Permitidas: <br/> ".jpg" <br/> ".jpeg" <br/> ".pjpeg" <br/> ".png" <br/> ".webp"');
        }

        $limitar_tamanho = 0;
        if ($limitar_tamanho && $limitar_tamanho < $tamanho_arquivo) {
            exit('<b>Atenção: </b> Arquivo excede tamanho maximo permitido!');
        }

        #$this->uploadLocal($arquivo_temp,$nome_arquivo);  
        $uploadFtp = $this->uploadFtp($arquivo_temp, $nome_arquivo);
        
        if($uploadFtp){ $this->update($nome_arquivo); }
        
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
    }

    public function update($nome_arquivo) {
        $crud = new ClassModel();
        $select = $crud->select('*', 'entidade ', "", array());
        $result = $select->fetchAll();
        foreach ($result as $data) {
            $dominio = $data['dominio'];
        }

        $id = $this->getId();
        $table = $this->getTable();
        $imagem_url = 'http://'.$dominio.'/img/'. $nome_arquivo;        
        $post = ['imagem_nome' => $nome_arquivo,'imagem_url' => $imagem_url];
        $crud->update($table, $post, $id);
        if ($crud) {
            echo "Arquivo <b>".$nome_arquivo."</b> enviado com sucesso!";
        }
    }

    public function uploadLocal($arquivo_temp, $nome_arquivo) {

        $destino = '../../public_html/img/' . $this->getTable() . '/' . $nome_arquivo;

        $upload_local = move_uploaded_file($arquivo_temp, $destino);

        if (!$upload_local) {
            exit("<b>Atenção: </b>Diretório " . $destino . " não localizado");
        } else {
            echo 'Arquivo enviado com sucesso!<br/>';
        }
    }

    //================================================


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

}
