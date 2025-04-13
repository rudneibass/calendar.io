import requests
from bs4 import BeautifulSoup
import json
import re
from datetime import datetime
from unidecode import unidecode

def page_exists(url):
    response = requests.head(url)
    return response.status_code == 200

def extract_data(url, json_data):
    # Obtém o ID do registro a partir da URL
    registro_id = url.split('/')[-1]

    # Realiza a requisição HTTP
    response = requests.get(url)

    # Verifica se a requisição foi bem-sucedida (código de status 200)
    if response.status_code == 200:
        # Parsing do HTML com BeautifulSoup
        soup = BeautifulSoup(response.text, 'html.parser')

        # Encontrar a tag <h3> com a classe 'card-title'
        h3_tag = soup.find('h3', class_='card-title')

        # Extrai o texto da tag <h3>
        if h3_tag:
            # Utiliza expressão regular para extrair tipo e número
            match = re.match(r"(.*?):\s*(\d+)", h3_tag.text)
            if match:
                tipo = match.group(1).strip()
                numero = match.group(2).strip()
            else:
                tipo = "N/A"
                numero = "N/A"
        else:
            tipo = "N/A"
            numero = "N/A"

        # Encontrar as tags <h6> com a classe 'font-weight-normal mb-1'
        h6_tags = soup.find_all('h6', class_='font-weight-normal mb-1')

        # Extrai o texto das tags <h6>
        autor_tag_text = h6_tags[0].text.strip() if len(h6_tags) > 0 else "N/A"
        autor = autor_tag_text.replace("Autor: ", "")

        data_tag_text = h6_tags[1].text.strip() if len(h6_tags) > 1 else "N/A"
        data_str = data_tag_text.replace("Data: ", "")

        # Converte a string de data para o formato yyyy-mm-dd
        try:
            data_formatada = datetime.strptime(data_str, "%d/%m/%Y").strftime("%Y-%m-%d")
        except ValueError:
            print(f"Erro ao converter a data '{data_str}' para o formato desejado. Utilizando N/A.")
            data_formatada = "N/A"

        # Encontrar a div com a classe 'card-body'
        card_body_div = soup.find('div', class_='card-body')

        # Verifica se a div foi encontrada
        if card_body_div:
            # Encontrar a div com a classe 'mb-0' dentro da div 'card-body'
            mb_div = card_body_div.find('div', class_='mb-0')

            # Verifica se a div 'mb-0' foi encontrada
            if mb_div:
                # Encontrar a tag <p> dentro da div 'mb-0'
                p_tag = mb_div.find('p')

                # Extrai o texto da tag <p>
                resumo = p_tag.text.strip() if p_tag else "N/A"
            else:
                print("Div 'mb-0' não encontrada.")
                resumo = "N/A"
        else:
            print("Div 'card-body' não encontrada.")
            resumo = "N/A"

        # Encontrar a tag <a> com a classe 'btn btn-danger py-0'
        arquivo_tag = soup.find('a', class_='btn btn-danger py-0')

        # Extrair o conteúdo do atributo href
        arquivo = arquivo_tag['href'].strip() if arquivo_tag and 'href' in arquivo_tag.attrs else "N/A"

        # Cria um dicionário com as chaves "id", "tipo", "numero", "autor", "data", "vizualizacoes", "resumo" e "arquivo"
        data = {
            "id": registro_id,
            "tipo": tipo,
            "numero": numero,
            "autor": autor,
            "data": data_formatada,
            "vizualizacoes": "N/A",  # Ajuste conforme necessário
            "resumo": resumo,
            "arquivo": arquivo
        }

        # Adiciona os dados ao JSON existente
        json_data.append(data)
        print(f"Os dados da página {url} foram extraídos e salvos em 'materias.json'.")
    else:
        print(f"Erro ao acessar a URL {url}. Código de status: {response.status_code}")

# Número total de páginas
total_pages = 2461

# URL base
base_url = "https://camaradecedro.ce.gov.br/materias/"

# Lista para armazenar os dados de todas as páginas
all_data = []

# Itera sobre as páginas de 1 a 4000
for page_number in range(2443, total_pages + 1):
    current_url = f"{base_url}{page_number}"
    extract_data(current_url, all_data)

# Converte a lista para formato JSON
json_data = json.dumps(all_data, indent=2, ensure_ascii=False)

# Salva o JSON em um arquivo
with open('materias.json', 'w', encoding='utf-8') as json_file:
    json_file.write(json_data)

print(f"Os dados de todas as páginas foram extraídos e salvos em 'materias.json'.")
