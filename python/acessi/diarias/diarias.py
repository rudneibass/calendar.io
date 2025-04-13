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
        data_portaria = data_tag_text.replace("Data da Portaria: ", "")
        
        agente_tag_text = h6_tags[1].text.strip() if len(h6_tags) > 1 else "N/A"
        agente = agente_tag_text.replace("Agente: ", "")
        
        cargo_tag_text = h6_tags[2].text.strip() if len(h6_tags) > 2 else "N/A"
        cargo = cargo_tag_text.replace("Cargo: ", "")

        orgao_tag_text = h6_tags[3].text.strip() if len(h6_tags) > 3 else "N/A"
        orgao = orgao_tag_text.replace("Cargo: ", "")
        
        desc_tag_text = h6_tags[4].text.strip() if len(h6_tags) > 4 else "N/A"
        desc = desc_tag_text.replace("Cargo: ", "")
        
        empresa_tag_text = h6_tags[5].text.strip() if len(h6_tags) > 5 else "N/A"
        empresa = empresa_tag_text.replace("Empresa: ", "")
        
        cidade_tag_text = h6_tags[6].text.strip() if len(h6_tags) > 6 else "N/A"
        cidade = cidade_tag_text.replace("Cidade: ", "")
        
        estado_tag_text = h6_tags[7].text.strip() if len(h6_tags) > 7 else "N/A"
        estado = estado_tag_text.replace("Estado: ", "")

    
        div_tags = soup.find_all('div', class_='col-md-5 col-xs-5 inforcard-value')
        
        data_inicio_viagem = div_tags[0].text.strip() if len(div_tags) > 0 else "N/A"
        data_fim_viagem = div_tags[1].text.strip() if len(div_tags) > 1 else "N/A"
        data_quitacao = div_tags[2].text.strip() if len(div_tags) > 2 else "N/A"
        valor_unitario_tag = div_tags[3].text.strip() if len(div_tags) > 3 else "N/A"
        valor_unitario = valor_unitario_tag.replace("R$ ", "")
        quantidade = div_tags[4].text.strip() if len(div_tags) > 4 else "1"
        valor_total_tag = div_tags[5].text.strip() if len(div_tags) > 5 else "N/A"
        valor_total = valor_total_tag.replace("R$ ", "")
    
        arquivo_tag = soup.find('a', class_='btn btn-primary mt-3')
        arquivo = arquivo_tag['href'].strip() if arquivo_tag and 'href' in arquivo_tag.attrs else "N/A"
            
        data = {
            "id": registro_id,
            "data" : data_portaria,
            "agente": agente,
            "cargo": cargo,
            "descricao": desc,
            "empresa": empresa,
            "cidade": cidade,
            "estado": estado,
            "data_inicio_viagem": data_inicio_viagem,
            "data_fim_viagem":data_fim_viagem,
            "data_quitacao": data_quitacao,
            "valor_unitario": valor_unitario,
            "quantidade": quantidade,
            "valor_total":valor_total,
            "arquivo": arquivo
        }

        json_data.append(data)
        print(f"Os dados da página {url} foram extraídos e salvos em 'diarias.json'.")
    else:
        print(f"Erro ao acessar a URL {url}. Código de status: {response.status_code}")

base_url = "https://camaradecedro.ce.gov.br/diariaslista/"
total_pages = 620
all_data = []

for page_number in range(288, total_pages + 1):
    current_url = f"{base_url}{page_number}"
    extract_data(current_url, all_data)

json_data = json.dumps(all_data, indent=2, ensure_ascii=False)


with open('diarias.json', 'w', encoding='utf-8') as json_file:
    json_file.write(json_data)

print(f"Os dados de todas as páginas foram extraídos e salvos em 'diarias.json'.")
