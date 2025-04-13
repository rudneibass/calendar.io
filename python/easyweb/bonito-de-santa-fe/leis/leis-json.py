import requests
from bs4 import BeautifulSoup
import json

# URL da página
URL = "https://cmbsf.pb.gov.br/consulta/leis-municipais/p16_sectionid/127"
URL = "https://cmbsf.pb.gov.br/consulta/leis-municipais/p16_sectionid/127/p16_start/21"

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

# Lista para armazenar os dados extraídos
data = []

# Encontrar todos os <li> dentro da <div> selecionada
for li in div_list.select("ul li"):
    a_tag = li.find("a")
    if a_tag:
        title = a_tag.get_text(" ", strip=True)  # Obtém o texto dentro da <a>
        span = a_tag.find("span")  # Obtém o <span> dentro da <a>
        description = span.get_text(" ", strip=True) if span else ""

        data.append({
            "titulo": title,
            "descricao": description
        })

# Salvando os dados como JSON
with open("2021-2.json", "w", encoding="utf-8") as f:
    json.dump(data, f, indent=4, ensure_ascii=False)

print("Arquivo JSON salvo com sucesso!")
