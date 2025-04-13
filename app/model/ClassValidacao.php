<?php

class ClassValidacao {

    private $dados;
    private $erro = array();

    public function set($valor, $nome) {
        $this->dados = array("valor" => trim($valor), "nome" => $nome);
        return $this;
    }

    public function confirmaCpfCnpj($table, $field) {
        if (empty($field)) {
            $this->erro[] = "CNPJ/CPF é de preenchimento obrigatório";
        } else {
            $cnpjcpf = filter_input(INPUT_POST, 'cnpj_cpf', FILTER_SANITIZE_SPECIAL_CHARS);
            $crud = new Model();
            $select = $crud->select('*', 'comercios', ' AND ccnpj_cpf=?', array($cnpjcpf));

            foreach ($select as $data) {
                $n = $data['comercio_id'];
            }

            if ($n >= 1) {
                $this->erro[] = "Já existe um usuario com o mesmo CPF/CNPJ cadastrado";
            };
        }
    }

    public function obrigatorio() {
        if (empty($this->dados['valor'])) {
            $this->erro[] = sprintf("O campo %s é obrigatorio!", $this->dados['nome']);
        }
        return $this;
    }

    public function confirmaSenha($senha, $confirmaSenha) {
        if ($senha != $confirmaSenha) {
            $this->erro[] = "O campo 'Senha' e 'Confirmar Senha' não conferem!";
        }
    }

    public function email() {
        if (!filter_var($this->dados['valor'], FILTER_VALIDATE_EMAIL)) {
            $this->erro[] = sprintf("O campo %s não é email valido", $this->dados['nome']);
        }
        return $this;
    }

    public function data() {//99-99-9999
        if (!preg_match("/^[0-9]{2}\-[0-9]{2}\-[0-9]{4}$/", $this->dados['valor'])) {
            $this->erro[] = sprintf("o campo %s só aceita formato dd-mm-aaaa", $this->dados['nome']);
        }
        return $this;
    }

    public function moeda() {
        if (!preg_match("/^[0-9]\.[0-9]$/", $this->dados['valor'])) {
            $this->erro[] = sprintf("o campo %s só aceita formato 00.00", $this->dados['nome']);
        }
        return $this;
    }

    public function telefone() {//(99)9999-9999
        if (!preg_match("/^\([0-9]{2}\)[0-9]{4}\-[0-9]{4}$/", $this->dados['valor'])) {
            $this->erro[] = sprintf("o campo %s só aceita formato (99)9999-9999", $this->dados['nome']);
        }
        return $this;
    }

    function validarCnpj($cnpj) {
   
        if ($cnpj == null) exit ("O campo CNPJ é obrigatório!");
            
        $cnpj = preg_replace('/[^0-9]/', '', (string) $cnpj);
        
        // Valida tamanho
        if (strlen($cnpj) != 14) $this->erro[] = sprintf("CNPJ inválido, verifique a quantidade de caracteres!", $this->dados['nome']);
        
        // Verifica se todos os digitos são iguais
        if (preg_match('/(\d)\1{13}/', $cnpj)) $this->erro[] = sprintf("CNPJ inválido!", $this->dados['nome']);

        
        // Valida primeiro dígito verificador  
        for ($i = 0, $j = 5, $soma = 0; $i < 12; $i++) {
            $soma += $cnpj[$i] * $j;
            $j = ($j == 2) ? 9 : $j - 1;
        }$resto = $soma % 11;
        if ($cnpj[12] != ($resto < 2 ? 0 : 11 - $resto)) $this->erro[] = sprintf("1º algarismo do digito verificador  inválido!", $this->dados['nome']);

        
         //Valida segundo dígito verificador
        for ($i = 0, $j = 6, $soma = 0; $i < 13; $i++) {
            $soma += $cnpj[$i] * $j;
            $j = ($j == 2) ? 9 : $j - 1;
        }$resto = $soma % 11;      
       if ($cnpj[13] != ($resto < 2 ? 0 : 11 - $resto))
            $this->erro[] = sprintf("2º algarismo do  digito verificador  inválido!", $this->dados['nome']);;
       
    }

    public function validar() {
        if (count($this->erro) > 0) {
            return false;
        } else {
            return true;
        }
    }

    public function getErrors() {
        return $this->erro;
    }

}
