<?php

class ClassValidacaoArquivos {

    public function arquivoExistente($nome_arquivo) {
        require_once '../../app/model/ClassModel.php';
        $stmt = new ClassModel();
        $select = $stmt->select('*', 'arquivos ', "WHERE nome='" . $nome_arquivo . "'", array());
        $result = $select->fetchAll();
        $count = count($result);

        if ($count) {
            exit("Arquivo <b>" . $nome_arquivo . "</b> já existe, favor renomea-lo antes de enviar!");
        }

        return TRUE;
    }

    public function permissaoExtensao($nome_arquivo) {
        $extensoes_autorizadas = array('.pdf', '.doc', '.docx', '.xls', '.xlsx', '.txt', '.jpg', '.jpeg', '.png', '.ods', '.odt'); // Extensões de arquivos permitidas
        $extensao_arquivo = strrchr($nome_arquivo, '.'); // Extensão do arquivo enviado
        if (!empty($extensoes_autorizadas) && !in_array($extensao_arquivo, $extensoes_autorizadas)) {
            exit("<b>Atenção! </b>Arquivo com extensão <b>" . $extensao_arquivo . "</b> não são permitidos<br/><b>Extensões permitidas:</b><br/>.pdf;<br/>.doc;<br/>.docx;<br/>.xls;<br/>.xlsx;<br/>.txt;<br/>.jpg;<br/>jpeg;<br/>.png;<br/>.ods;<br/>.odt");
        }
        return TRUE;
    }

    public function permissaoTamanho($nome_arquivo, $tamanho_arquivo) {
        $limitar_tamanho = 0;
        if ($limitar_tamanho && $tamanho_arquivo > $limitar_tamanho) {
            exit("Arquivo <b>" . $nome_arquivo . " </b>  excede o tamanho máximo permitido!");
        }
        return TRUE;
    }

    public function montaInsert() {
        $tipo_arquivo = $arquivo['type'][$i];
        $caminho_absoluto = 'http://' . $dominio . '/arquivos/' . $nome_arquivo;
        $caminho_relativo = '../arquivos/' . $nome_arquivo;
    }

}
