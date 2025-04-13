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
        
        if h6_tags and len(h6_tags) > 2:
            agente_tag_text = h6_tags[1].text.strip() if len(h6_tags) > 0 else "N/A"
            agente = agente_tag_text.replace("Agente: ", "")
        else:
            agente = 'N/A'          
            
        numero = soup.find('h3', class_='card-title').text if soup.find('h3', class_='card-title') else 'N/A'
        
        descricao = soup.find('p', class_='text mt-1 mb-1').text if soup.find('p', class_='text mt-1 mb-1') else 'N/A' 

        arquivo_tag = soup.find('a', class_='btn btn-danger btn-sm ml-3 mb-1')
        
        if arquivo_tag:
            arquivo = arquivo_tag['href'].strip() if arquivo_tag and 'href' in arquivo_tag.attrs else "N/A"
        else:
            arquivo = 'N/A'
            
        data = {
            "id": registro_id,
            "data" : data_lei,
            "numero": numero,
            "agente": agente,
            "descricao": descricao,
            "arquivo": arquivo
        }


        json_data.append(data)
        print(f"Os dados da página {url} foram extraídos e salvos em 'portarias.json'.")
    else:
        print(f"Erro ao acessar a URL {url}. Código de status: {response.status_code}")

base_url = "https://www.camaradecedro.ce.gov.br/portaria/"
total_pages = 622
all_data = []

for page_number in range(1, total_pages + 1):
    current_url = f"{base_url}{page_number}"
    extract_data(current_url, all_data)

json_data = json.dumps(all_data, indent=2, ensure_ascii=False)


with open('portarias.json', 'w', encoding='utf-8') as json_file:
    json_file.write(json_data)

print(f"Os dados de todas as páginas foram extraídos e salvos em 'portarias.json'.")
