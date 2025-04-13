import requests
from bs4 import BeautifulSoup
import os

# URL da página
URL = "https://cmbsf.pb.gov.br/consulta/leis-municipais/p16_sectionid/127"
URL = "https://cmbsf.pb.gov.br/consulta/leis-municipais/p16_sectionid/127/p16_start/21"

# URL base do site (se necessário para corrigir URLs relativas)
BASE_URL = "https://cmbsf.pb.gov.br"

# Diretório para salvar os arquivos
os.makedirs("downloads", exist_ok=True)

# Faz a requisição HTTP para obter o HTML da página
response = requests.get(URL)
if response.status_code != 200:
    print("Erro ao acessar a página:", response.status_code)
    exit()

# Parseando o HTML
soup = BeautifulSoup(response.text, "html.parser")

# Encontra a div com a classe específica
div_list = soup.find("div", class_="_new-list")
if not div_list:
    print("Erro: A div '_new-list' não foi encontrada na página.")
    exit()

# Encontrar todos os links <a> dentro dos <li> da div selecionada
for a_tag in div_list.select("ul li a"):
    file_url = a_tag["href"]

    # Se a URL for relativa, adiciona a URL base
    if not file_url.startswith("http"):
        file_url = BASE_URL + file_url

    # Obtendo o nome do arquivo
    file_name = os.path.basename(file_url)

    # Baixando o arquivo
    response = requests.get(file_url, stream=True)
    if response.status_code == 200:
        with open(os.path.join("downloads", file_name), "wb") as f:
            for chunk in response.iter_content(1024):
                f.write(chunk)
        print(f"Arquivo baixado: {file_name}")
    else:
        print(f"Erro ao baixar: {file_url}")
