import requests
from bs4 import BeautifulSoup
from datetime import datetime
import re
import json
from unidecode import unidecode

def extrair_dados_pagina(id):
    # URL da página com o ID dinâmico
    url = f'https://camaradecedro.ce.gov.br/licitacoes/{id}'

    # Faz a requisição HTTP para a página
    response = requests.get(url)

    # Verifica se a requisição foi bem-sucedida (código de status 200)
    if response.status_code == 200:
        # Cria um objeto BeautifulSoup para fazer a análise HTML
        soup = BeautifulSoup(response.text, 'html.parser')

        # Localiza o primeiro elemento HTML com a classe "text-dark"
        elemento_div_1 = soup.find('div', class_='text-dark')

        # Verifica se o primeiro elemento foi encontrado
        if elemento_div_1:
            # Cria um dicionário para armazenar os dados
            dados = {'id': id}  # Adiciona a chave 'id' ao dicionário

            # Define padrões de expressões regulares para extrair informações específicas
            padrao_numero_processo = re.compile(r'Número do processo:</strong>\s*(\S+)')
            padrao_tipo = re.compile(r'Tipo:</strong>\s*(\S+)')
            padrao_data_abertura = re.compile(r'Data abertura:</strong>\s*(\d{2}/\d{2}/\d{4})')
            padrao_data_publicacao_edital = re.compile(r'Data da publicação do edital:</strong>\s*(\d{2}/\d{2}/\d{4})')
            padrao_data_publicacao_aviso = re.compile(r'Data publicação do aviso:</strong>\s*(\d{2}/\d{2}/\d{4})')

            # Extrai as informações usando expressões regulares
            dados['numero_do_processo'] = re.search(padrao_numero_processo, str(elemento_div_1)).group(1) if re.search(padrao_numero_processo, str(elemento_div_1)) else 'N/A'
            dados['tipo'] = re.search(padrao_tipo, str(elemento_div_1)).group(1) if re.search(padrao_tipo, str(elemento_div_1)) else 'N/A'
            dados['data_abertura'] = datetime.strptime(re.search(padrao_data_abertura, str(elemento_div_1)).group(1), '%d/%m/%Y').strftime('%Y-%m-%d') if re.search(padrao_data_abertura, str(elemento_div_1)) else 'N/A'
            dados['data_da_publicacao_do_edital'] = datetime.strptime(re.search(padrao_data_publicacao_edital, str(elemento_div_1)).group(1), '%d/%m/%Y').strftime('%Y-%m-%d') if re.search(padrao_data_publicacao_edital, str(elemento_div_1)) else 'N/A'
            dados['data_publicacao_do_aviso'] = datetime.strptime(re.search(padrao_data_publicacao_aviso, str(elemento_div_1)).group(1), '%d/%m/%Y').strftime('%Y-%m-%d') if re.search(padrao_data_publicacao_aviso, str(elemento_div_1)) else 'N/A'

            # Localiza o segundo elemento HTML com a classe "mt-1"
            elemento_div_2 = soup.find('div', class_='mt-1')

            # Verifica se o segundo elemento foi encontrado
            if elemento_div_2:
                # Extrai o conteúdo da tag <p> dentro do segundo elemento
                objeto_texto = elemento_div_2.find('p').text.strip() if elemento_div_2.find('p') else 'N/A' 

                # Trata caracteres especiais usando unidecode
                dados['objeto'] = unidecode(objeto_texto)

                print(f"Extraindo dados do página {url}")
                
                return dados
            else:
                print(f"Segundo elemento não encontrado para a página {url}.")
        else:
            print(f"Primeiro elemento não encontrado para a página {url}.")
    else:
        print(f"Falha ao acessar a página {url}. Código de status: {response.status_code}")
    
# Lista para armazenar os dados de todas as páginas
dados_json = []

# Itera sobre a lista de IDs
for id in range(1, 63):
    dados_pagina = extrair_dados_pagina(id)
    if dados_pagina:
        dados_json.append(dados_pagina)

# Converte a estrutura de dados em JSON
json_string = json.dumps(dados_json, indent=4, ensure_ascii=False)

# Cria um arquivo JSON e escreve a string JSON nele
with open('licitacoes.json', 'w', encoding='utf-8') as json_file:
    json_file.write(json_string)

print("Arquivo JSON criado com sucesso.")
