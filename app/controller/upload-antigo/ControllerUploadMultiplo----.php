<?php

session_start();
require_once '../../config/header.php';
require_once '../../app/model/ClassModel.php';
require_once '../../app/model/ClassValidacao.php';

class ControllerUploadMultiplo {

    private $table;
    private $id;

    public function analisaArquivo() {
        //set_time_limit(0); // Configura o tempo limite para ilimitado
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
            exit("<b>Atenção: </b>Não foi possivel realizar o envio, parametros de conexão não configurados. Entre em contato com o administrador");
        }


        //CONEXÃO PROPRIMENTE DITA
        $conexao_ftp = ftp_connect($servidor_ftp); //Realiza a conexão   
        $login_ftp = ftp_login($conexao_ftp, $usuario_ftp, $senha_ftp); //Tenta fazer login
        if (!$login_ftp) {
            exit('<b>Atenção: </b>Sua conexão com o servidor foi recusada, por favor verifique suas credenciais!');
        }
        ftp_pasv($conexao_ftp, true) or die("Não foi possível alternar para o modo passivo"); //Muda a conexao para o modo passivo
        //PARAMETROS PARA ANALISE DO ARQUIVO A SER UPADO
        $extensoes_autorizadas = array('.pdf', '.doc', '.docx', '.xls', '.xlsx', '.txt', '.jpg', 'jpeg', '.png', '.ods', '.odt'); // Extensões de arquivos permitidas
        $limitar_tamanho = 0;
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

            $caminho = '/public_html/arquivos/'; // Caminho da pasta FTP    
            $extensao_arquivo = strrchr($nome_arquivo, '.'); // Extensão do arquivo enviado
            $destino = $caminho . $nome_arquivo; // O destino para qual o arquivo será enviado
            $caminho_absoluto = 'http://' . $dominio . '/arquivos/' . $nome_arquivo;
            $caminho_relativo = '../arquivos/' . $nome_arquivo;

            //VERIFICA SE O ARQUIVO JÁ EXISTE
            $select = $crud->select('*', 'arquivos ', "WHERE nome='" . $nome_arquivo . "'", array());
            $result = $select->fetchAll();
            $count = count($result);

            if ($count) {
                exit('<b>Atenção: </b> arquivo <b>' . $nome_arquivo . '</b> já existe, favor renomea-lo antes de enviar!');
            }

            if ($limitar_tamanho && $limitar_tamanho < $tamanho_arquivo) {
                exit('<b>Atenção: </b> Arquivo excede tamanho maximo permitido!');
            }

            if (!empty($extensoes_autorizadas) && !in_array($extensao_arquivo, $extensoes_autorizadas)) {
                exit('<b>Atenção: </b>Tipo de arquivo não permitido.');
            }

            if (ftp_put($conexao_ftp, $destino, $arquivo_temp, FTP_BINARY)) {
                $post = [
                    'id_tabela_pai' => $this->getId(),
                    'tabela_pai' => $this->getTable(),
                    'nome' => $nome_arquivo,
                    'tipo' => $tipo_arquivo,
                    'tamanho' => $tamanho_arquivo,
                    'dominio' => $dominio,
                    'caminho_absoluto' => $caminho_absoluto,
                    'caminho_retaivo' => $caminho_relativo,
                    'usuario' => $_SESSION['USUARIO'],
                    'data' => date('Y-m-d'),
                    'hora' => date('H:i:s')
                ];

                $crud->insert($post, 'arquivos');
                #$upload_local = move_uploaded_file($arquivo_temp, "../../public_html/arquivos/" . $nome_arquivo);
                #if (!$upload_local) {exit("<b>Atenção: </b>Diretório ../../public_html/arquivos/ não localizado");}
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
        return $this->talbe = filter_input(INPUT_POST, 'tabela_pai', FILTER_SANITIZE_SPECIAL_CHARS);
    }

    public function getId() {
        return $this->setId();
    }

    public function setId() {
        return $this->id = filter_input(INPUT_POST, 'id_tabela_pai', FILTER_SANITIZE_SPECIAL_CHARS);
    }

}
