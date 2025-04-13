<?php

require_once '../../app/model/ClassModel.php';
require_once '../../app/model/ClassValidacao.php';

class ControllerUploadImagens {

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
        $this->uploadFtp($arquivo_temp, $nome_arquivo);
        $this->update($nome_arquivo);
    }

    public function uploadFtp($arquivo_temp, $nome_arquivo) {
        //PARAMETROS DE CONEXÃO
        $crud = new ClassModel();
        $select = $crud->select('*', 'entidade ', "", array());
        $result = $select->fetchAll();
        foreach ($result as $data) {
            $dominio = $data['dominio'];
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
        $table = $this->getTable();
        $dirImg = 'img/' . $table . '/' . $nome_arquivo;
        $id = $this->getId();
        $crud = new ClassModel();
        $post = ['imagem' => $dirImg];
        $crud->update($table, $post, $id);
        if ($crud) {
            echo "Arquivo enviado com sucesso!";
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

    public function UploadFtpLoop() {

        //PARAMETROS DE CONEXÃO
        $crud = new ClassModel();
        $select = $crud->select('*', 'entidade ', "", array());
        $result = $select->fetchAll();
        foreach ($result as $data) {
            $cnpj = $data['cnpj'];
            $dominio = $data['dominio'];
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
        
        ftp_pasv($conexao_ftp, true) or die("Não foi possível alternar para o modo passivo"); //Muda a conexao para o modo passivo

        $arquivo = $_FILES['arquivo'];
        $indice = count(array_filter($arquivo["name"]));

        if ($indice <= 0) {
            exit('<b>Atenção: </b>Nenhum arquivo selecionado!');
        }

        //LOOP DE UPLOAD
        for ($i = 0; $i < $indice; $i ++) {
            $nome_arquivo = $arquivo['name'][$i];
            $tamanho_arquivo = $arquivo['size'][$i];
            $tipo_arquivo = $arquivo['type'][$i];
            $arquivo_temp = $arquivo['tmp_name'][$i];

            $caminho = '/public_html/img/'; // Caminho da pasta FTP    
            $extensao_arquivo = strrchr($nome_arquivo, '.'); // Extensão do arquivo enviado
            $destino = $caminho . $nome_arquivo; // O destino para qual o arquivo será enviado

            $caminho_absoluto = 'http://' . $dominio . '/arquivos/' . $nome_arquivo;
            $caminho_relativo = '../arquivos/' . $nome_arquivo;

            //VERIFICA SE O ARQUIVO JÁ EXISTE
            $select = $crud->select('*', 'arquivos ', "WHERE nome='" . $nome_arquivo . "'", array());
            $result = $select->fetchAll();
            $count = count($result);

            if ($count) {
                exit('<b>Atenção: </b> Já existe uma arquivo com o mesmo nome, favor renomear antes de fazer o ulpload. Para saber mais consulte a área de multimidia!');
            }

            if ($limitar_tamanho && $limitar_tamanho < $tamanho_arquivo) {
                exit('<b>Atenção: </b> Arquivo excede tamanho maximo permitido!');
            }

            if (!empty($extensoes_autorizadas) && !in_array($extensao_arquivo, $extensoes_autorizadas)) {
                exit('<b>Atenção: </b>Tipo de arquivo não permitido.');
            }

            if (ftp_put($conexao_ftp, $destino, $arquivo_temp, FTP_BINARY)) {
                echo 'Arquivo <b>"' . $nome_arquivo . '" </b> enviado com sucesso!<br/>';
            } else {
                echo '<b>Atenção: </b>Erro na tranferência FTP de <b> ' . $nome_arquivo . '<b/>';
            }
        }

        ftp_close($conexao_ftp);
    }


    public function getTable() {
        return $this->setTable();
    }

    public function setTable() {
        return $this->talbe = filter_input(INPUT_POST, 'tabela', FILTER_SANITIZE_SPECIAL_CHARS);
    }

    public function getId() {
        return $this->setId();
    }

    public function setId() {
        return $this->id = filter_input(INPUT_POST, 'id_tabela', FILTER_SANITIZE_SPECIAL_CHARS);
    }

}
