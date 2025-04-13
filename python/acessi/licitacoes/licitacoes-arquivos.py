import os
import requests
from bs4 import BeautifulSoup
from urllib.parse import urljoin
from selenium import webdriver
from selenium.webdriver.common.keys import Keys
import time

def extrair_dados_tabela(id):
    # URL da página com o ID dinâmico
    url = f'https://www.camaradecedro.ce.gov.br/licitacoes/{id}'

    # Configuração do webdriver
    options = webdriver.ChromeOptions()
    options.add_argument("--headless")  # Execução sem interface gráfica (opcional)
    driver = webdriver.Chrome(options=options)

    # Faz a requisição HTTP para a página
    driver.get(url)
    time.sleep(5)  # Aguarda um tempo para carregar a página

    # Cria um objeto BeautifulSoup para fazer a análise HTML
    soup = BeautifulSoup(driver.page_source, 'html.parser')

    # Localiza a tabela com o ID "table-2"
    tabela = soup.find('table', {'id': 'table-2'})

    # Verifica se a tabela foi encontrada
    if tabela:
        # Inicializa uma lista para armazenar os dados da tabela
        dados_tabela = []

        # Itera sobre as linhas da tabela, excluindo o cabeçalho
        for linha in tabela.find_all('tr')[1:]:
            # Extrai o conteúdo do atributo href do elemento <a> na última coluna
            ultima_coluna_a = linha.find_all('td')[-1].find('a')
            arquivo_link = ultima_coluna_a['href'] if ultima_coluna_a and 'href' in ultima_coluna_a.attrs else None

            # Adiciona o link à lista de dados da linha
            dados_tabela.append(arquivo_link)

        driver.quit()  # Fecha o webdriver
        return dados_tabela
    else:
        print(f"Tabela com ID 'table-2' não encontrada na página {url}.")
        driver.quit()  # Fecha o webdriver em caso de erro
        return []

def download_arquivos(dados_arquivos, pasta_destino):
    # Cria a pasta de destino se ela não existir
    if not os.path.exists(pasta_destino):
        os.makedirs(pasta_destino)

    # Configuração do webdriver
    options = webdriver.ChromeOptions()
    options.add_argument("--headless")  # Execução sem interface gráfica (opcional)
    driver = webdriver.Chrome(options=options)

    for arquivo_link in dados_arquivos:
        # Verifica se há link para download
        if arquivo_link:
            # Faz o download do arquivo
            try:
                driver.get('https://www.camaradecedro.ce.gov.br' + arquivo_link)
                time.sleep(5)  # Aguarda um tempo para o arquivo ser aberto

                # Salva o conteúdo da aba atual
                driver.find_element_by_tag_name('body').send_keys(Keys.CONTROL + 's')
                time.sleep(2)  # Aguarda um tempo para o diálogo de download aparecer

                # Configuração do diretório de download
                prefs = {"download.default_directory": os.path.abspath(pasta_destino)}
                options.add_experimental_option("prefs", prefs)

                # Confirma o download no diálogo de download
                driver.find_element_by_id('popup_ok').click()
                print(f"Arquivo '{arquivo_link}' baixado com sucesso.")

            except Exception as e:
                print(f"Falha ao baixar o arquivo '{arquivo_link}': {e}")

    driver.quit()  # Fecha o webdriver

# ID da página
id_pagina = 62

# Diretório de destino para download
pasta_destino = f'./{id_pagina}'

# Chamada da função para extrair dados da tabela
dados_arquivos_pagina = extrair_dados_tabela(id_pagina)
if dados_arquivos_pagina:
    download_arquivos(dados_arquivos_pagina, pasta_destino)
