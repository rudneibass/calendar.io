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
        
        tag_nome_da_pagina = soup.find('h2', class_='subject-title mr-0 font-weight-semibold bg-secondary p-2-new')
        if tag_nome_da_pagina and tag_nome_da_pagina.text.strip() != 'Sessões':
            return  
            
         
        h6_tags = soup.find_all('h6', class_='font-weight-normal mb-1')
        
        data_tag_text = h6_tags[1].text.strip() if len(h6_tags) > 1 else "N/A"
        data_sessao = data_tag_text.replace("Data: ", "")
        
        try:
            data_formatada = datetime.strptime(data_sessao.strip(), "%d/%m/%Y").strftime("%Y-%m-%d")
        except ValueError:
            print(f"Erro ao converter a data '{data_sessao}' para o formato desejado. Utilizando N/A.")
            data_formatada = "N/A"
            
        
        status_tag_text = h6_tags[2].text.strip() if len(h6_tags) > 2 else "N/A"
        status = status_tag_text.replace("Status: ", "")
        
        descricao = soup.find('p', class_='text-justify font-weight-normal mb-1').text.strip() if soup.find('p', class_='text-justify font-weight-normal mb-1') else 'N/A' 

        data = {
            "id": registro_id,
            "data" : data_formatada,
            "status": status,
            "descricao": descricao
        }

        json_data.append(data)
        
        print(f"Os dados da página {url} foram extraídos e salvos em 'sessoes.json'.")
    else:
        print(f"Erro ao acessar a URL {url}. Código de status: {response.status_code}")

base_url = "https://www.camaradecedro.ce.gov.br/sessoes/"
total_pages = 531
all_data = []

for page_number in range(1, total_pages + 1):
    current_url = f"{base_url}{page_number}"
    extract_data(current_url, all_data)

json_data = json.dumps(all_data, indent=2, ensure_ascii=False)


with open('sessoes.json', 'w', encoding='utf-8') as json_file:
    json_file.write(json_data)
