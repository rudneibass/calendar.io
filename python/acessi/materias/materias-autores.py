import requests
from bs4 import BeautifulSoup
import json

def extract_data(html, page_id, json_data):

    soup = BeautifulSoup(html, 'html.parser')
    
    autores = soup.find_all('strong', string=" Informações dos autores e subescritores ")
    if not autores:
        print(f"Não há atores na página {page_id}. ")
        return
        
    table = soup.find_all('table', id='table-1')
    if not table:
       print(f"Não há presença na página https://www.camaradecedro.ce.gov.br/materias/{page_id}.")
       return
   
    if table:
        rows = table[1].find_all('tr')[1:]  # Skip the header row
        for row in rows:
            columns = row.find_all('td')
            
            if not columns:
                continue  # Skip empty rows

            nome = columns[0].text.strip()
            cargo = columns[1].text.strip()
            
            # Extracting data-target attribute from the last column
            last_column = row.find_all('td')[-1]
            data_target = last_column.find('a')['href'] if last_column.find('a') else 'N/A'
            
            data = {
                "id_materias": page_id,
                "id_vereador": data_target.replace("/vereadores/",""),
                "cargo": cargo,
                "nome": nome,
                "data_target": data_target
            }

            json_data.append(data)

    print(f"Dados da página https://www.camaradecedro.ce.gov.br/sessoes/{page_id} extraídos e salvos no arquivo 'autores.json'.")
            
    
base_url = "https://www.camaradecedro.ce.gov.br/materias/"
total_pages = 2461

all_data = []

for page_number in range(1, total_pages + 1):
    current_url = f"{base_url}{page_number}"
    response = requests.get(current_url)

    if response.status_code == 200:
        extract_data(response.text, page_number, all_data)
    else:
        print(f"Erro ao acessar a URL {current_url}. Código de status: {response.status_code}")

json_data = json.dumps(all_data, indent=2, ensure_ascii=False)

with open('autores.json', 'w', encoding='utf-8') as json_file:
    json_file.write(json_data)
