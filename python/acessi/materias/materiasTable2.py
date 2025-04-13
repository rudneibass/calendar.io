import requests
import json
from bs4 import BeautifulSoup
from unidecode import unidecode

def page_exists(url):
    response = requests.head(url)
    return response.status_code == 200

def extract_first_table_data(url):
    response = requests.get(url)

    if response.status_code == 200:
        soup = BeautifulSoup(response.text, 'html.parser')
        table = soup.find_all('table', id='table-1')

        records = []

        if len(table) >= 2:
            if table[1]:
                headers = [unidecode(header.text.strip().lower()) for header in table[1].find_all('th')]

                for row in table[1].find_all('tr')[1:]:
                    cells = row.find_all(['th', 'td'])
                    record = {}

                    for header, cell in zip(headers, cells):
                        record[header] = cell.text.strip()

                    record['id_materias'] = url.split('/')[-1]
                    records.append(record)

        return records
    
    else:
        print(f"Erro ao acessar a URL {url}. Código de status: {response.status_code}")
        return None

def extract_and_save_data(url, all_data):
    table_data = extract_first_table_data(url)

    if table_data:
        all_data.extend(table_data)
        print(f"Os dados da página {url} foram extraídos e salvos em 'materias_table_2.json'.")
    else:
        print(f"Falha ao extrair dados da página {url}.")
    

total_pages = 1010

base_url = "https://www.camaradecedro.ce.gov.br/materias/"
all_data = []

for page_number in range(1000, total_pages + 1):
    current_url = f"{base_url}{page_number}"
    extract_and_save_data(current_url, all_data)

json_data = json.dumps(all_data, indent=2, ensure_ascii=False)

with open('materias_table_2.json', 'w', encoding='utf-8') as json_file:
    json_file.write(json_data)

print("Todos os dados foram extraídos e salvos em 'materias_table_2.json'.")
