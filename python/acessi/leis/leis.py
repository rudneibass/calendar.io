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

    registro_id = url.split('/')[-1]
    response = requests.get(url)

    if response.status_code == 200:

        soup = BeautifulSoup(response.text, 'html.parser')

        h6_tags = soup.find_all('h6', class_='font-weight-normal mb-1')

        data_tag_text = h6_tags[0].text.strip() if len(h6_tags) > 0 else "N/A"
        data_lei = data_tag_text.replace("Data: ", "")

        numero_tag_text = h6_tags[1].text.strip() if len(h6_tags) > 1 else "N/A"
        numero = numero_tag_text.replace("Número: ", "")
        
        exercicio_tag_text = h6_tags[2].text.strip() if len(h6_tags) > 1 else "N/A"
        exercicio = exercicio_tag_text.replace("Exercício: ", "")
        
        categoria_tag_text = h6_tags[3].text.strip() if len(h6_tags) > 1 else "N/A"
        categoria = categoria_tag_text.replace("Categoria: ", "")


        card_body_div = soup.find('div', class_='card-body')
        if card_body_div:
            mb_div = card_body_div.find('div', class_='mb-0')
            if mb_div:
                p_tag = mb_div.find('p')
                descricao = p_tag.text.strip() if p_tag else "N/A"
            else:
                print("Div 'mb-0' não encontrada.")
                descricao = "N/A"
        else:
            print("Div 'card-body' não encontrada.")
            descricao = "N/A"

        arquivo_tag = soup.find('a', class_='btn btn-danger py-0')
        arquivo = arquivo_tag['href'].strip() if arquivo_tag and 'href' in arquivo_tag.attrs else "N/A"

        data = {
            "id": registro_id,
            "data" : data_lei,
            "numero": numero,
            "exercicio": exercicio,
            "categoria": categoria,
            "descricao": descricao,
            "arquivo": arquivo
        }


        json_data.append(data)
        print(f"Os dados da página {url} foram extraídos e salvos em 'materias.json'.")
    else:
        print(f"Erro ao acessar a URL {url}. Código de status: {response.status_code}")

base_url = "https://camaradecedro.ce.gov.br/leis/"
total_pages = 584
all_data = []

for page_number in range(1, total_pages + 1):
    current_url = f"{base_url}{page_number}"
    extract_data(current_url, all_data)

json_data = json.dumps(all_data, indent=2, ensure_ascii=False)


with open('leis.json', 'w', encoding='utf-8') as json_file:
    json_file.write(json_data)

print(f"Os dados de todas as páginas foram extraídos e salvos em 'leis.json'.")
