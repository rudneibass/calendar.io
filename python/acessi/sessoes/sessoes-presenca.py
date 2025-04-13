import requests
from bs4 import BeautifulSoup
import json

def extract_data(html, page_id, json_data):

    soup = BeautifulSoup(html, 'html.parser')
    
    #div = soup.find('div', class_='table-responsive push')
    #if not div:
    #   print(f"Não há presença na página https://www.camaradecedro.ce.gov.br/sessoes/{page_id}.")     
    #   return

    table = soup.find('table', id='table-1')
    
    if not table:
       print(f"Não há presença na página https://www.camaradecedro.ce.gov.br/sessoes/{page_id}.")
       return
   
    if table:
        rows = table.find_all('tr')[1:]  # Skip the header row
        for row in rows:
            columns = row.find_all('td')
            if not columns:
                continue  # Skip empty rows

            cargo = columns[0].text.strip()
            nome = columns[1].text.strip()
            chamada = columns[2].text.strip()
            
            # Extracting data-target attribute from the last column
            last_column = row.find_all('td')[-1]
            data_target = last_column.find('a')['data-target'] if last_column.find('a') else 'N/A'

            data = {
                "id_sessao": page_id,
                "id_vereador": data_target.replace("#myModall",""),
                "cargo": cargo,
                "nome": nome,
                "chamada": chamada,
                "data_target": data_target
            }

            json_data.append(data)

    print(f"Dados da página https://www.camaradecedro.ce.gov.br/sessoes/{page_id} extraídos e salvos no arquivo 'presenca.json'.")
            
    
base_url = "https://www.camaradecedro.ce.gov.br/sessoes/"
total_pages = 531

all_data = []

for page_number in range(91, total_pages + 1):
    current_url = f"{base_url}{page_number}"
    response = requests.get(current_url)

    if response.status_code == 200:
        extract_data(response.text, page_number, all_data)
    else:
        print(f"Erro ao acessar a URL {current_url}. Código de status: {response.status_code}")

json_data = json.dumps(all_data, indent=2, ensure_ascii=False)

with open('presenca.json', 'w', encoding='utf-8') as json_file:
    json_file.write(json_data)
