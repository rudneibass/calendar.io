import requests
from bs4 import BeautifulSoup
import json

def extract_data(html, page_id, json_data):

    soup = BeautifulSoup(html, 'html.parser')
    card_divs = soup.find_all('div', class_='card mb-2 pb-0')

    materias = soup.find_all('strong', string=" Lista de matérias vinculadas a sessão ")
    if not materias:
        print(f"Não há matérias na sessão {page_id}.")
        return
    
    for card_div in card_divs:
        strong_tag = card_div.find('strong', class_='text-uppercase fs-15 mb-0')
        titulo = strong_tag.text.strip() if strong_tag else 'N/A'

        status_tag = card_div.find('span', class_='label label-default text-uppercase mb-0')
        status = status_tag.text.strip() if status_tag else 'N/A'

        date_tag = card_div.find('i', class_='fa fa-calendar-o')
        date = date_tag.find_next('i').text.strip() if date_tag else 'N/A'

        author_tag = card_div.find('i', class_='fa fa-user-o')
        author = author_tag.find_next('a').text.strip() if author_tag else 'N/A'

        link_tag = card_div.find('a', class_='btn btn-secondary btn-sm icons ml-auto')
        link = link_tag['href'] if link_tag else 'N/A'

        data = {
            "id_sessao": page_id,
            "id_materias": link.replace("../materias/", ""),
            "titulo": titulo,
            "status": status,
            "data": date,
            "autor": author,
            "link": link
        }

        json_data.append(data)

    print(f"Dados da página {page_id} extraídos e salvos no arquivo 'materias.json'.")

base_url = "https://www.camaradecedro.ce.gov.br/sessoes/"
total_pages = 531

all_data = []

for page_number in range(1, total_pages + 1):
    current_url = f"{base_url}{page_number}"
    response = requests.get(current_url)

    if response.status_code == 200:
        extract_data(response.text, page_number, all_data)
    else:
        print(f"Erro ao acessar a URL {current_url}. Código de status: {response.status_code}")

json_data = json.dumps(all_data, indent=2, ensure_ascii=False)

with open('materias.json', 'w', encoding='utf-8') as json_file:
    json_file.write(json_data)
