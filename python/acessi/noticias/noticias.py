import requests
from bs4 import BeautifulSoup
import json
import re
from datetime import datetime
import locale
from unidecode import unidecode

def page_exists(url):
    response = requests.head(url)
    return response.status_code == 200

def extract_data(url, json_data):

    registro_id = url.split('/')[-1]
    response = requests.get(url)

    if response.status_code == 200:
        soup = BeautifulSoup(response.text, 'html.parser')
   
        div_text = soup.find('div', id='speak_text')
        
        if not div_text:
            return
        
        div_descricao = soup.find('div', id='speak_text')
        descricao = div_descricao.text.strip() if div_text else 'NULL'
        
        h2 = soup.find_all('h2')
        titulo = h2[1].text.strip() if len(h2) > 1 else 'NULL'
        
        h4 = soup.find('h4', class_='font-weight-normal mt-2 text-dark text-center mb-0')
        resumo = h4.text.strip() if h4 else 'NULL'
        
        div_img = soup.find('div', class_='item7-card-img d-flex')
        
        imagem = div_img = div_img.find('img').get('src') if div_img else 'NULL'
           
        # Configuração do locale para português do Brasil
        locale.setlocale(locale.LC_TIME, 'pt_BR.utf-8')
        
        div_data = soup.find('div',class_='item7-card-desc d-flex mb-2 mt-3 justify-content-center')
        data_em_portugues = div_data.find('span', class_='mr-2').text.strip() if div_data.find('span', class_='mr-2') else 'NULL'
        
        data_em_portugues = data_em_portugues.replace('MARÇO', 'MAIO').upper()
        
        data_em_portugues = data_em_portugues.replace('217', '2017').upper()
        
        # Substitui 'DE' por espaço e converte a string para maiúsculas
        data_em_portugues = data_em_portugues.replace(' DE ', ' ').upper()

        # Converte a parte da data em português para um objeto datetime
        data_obj = datetime.strptime(data_em_portugues, "%d %B %Y")

        # Formata a data no estilo desejado (YYYY-MM-DD)
        data_formatada = data_obj.strftime("%Y-%m-%d")

        data = {
            "id": registro_id,
            "data": data_formatada,
            "titulo" : titulo,
            "resumo": resumo, 
            "descricao": descricao,
            "imagem": imagem,
        }

        json_data.append(data)
        
        print(f"Os dados da página {url} foram extraídos e salvos em 'noticias.json'.")
    else:
        print(f"Erro ao acessar a URL {url}. Código de status: {response.status_code}")

base_url = "https://www.camaradecedro.ce.gov.br/informa/"
total_pages = 671
all_data = []

for page_number in range(197, 671):
    current_url = f"{base_url}{page_number}"
    extract_data(current_url, all_data)

json_data = json.dumps(all_data, indent=2, ensure_ascii=False)


with open('noticias.json', 'w', encoding='utf-8') as json_file:
    json_file.write(json_data)
