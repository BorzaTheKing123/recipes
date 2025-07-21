# Narejeno s pomočjo chat-gpt za hitrejšo uporabo knjižnic, ki mi niso toliko znane

import requests
from bs4 import BeautifulSoup
import json
import os

BASE_URL = "https://fran.si/iskanje"

kategorije = {
    "besede": set()
}

first = True

def razvrsti_po_vrstah(pojmi):
    fenomi = "ŕíìêáàéóôòèúù"
    crke = "riieaaeoooeuu"
    for pojem in pojmi:
        pojem = pojem.lower()
        if len(pojem) > 4 and len(pojem) < 9:
            if "." not in pojem and " " not in pojem and "x" not in pojem and "y" not in pojem and "w" not in pojem and "q" not in pojem:
                for ind in range(len(pojem)):
                    p = pojem[ind]
                    if p in fenomi:
                        #pojem[ind] = crke[fenomi.index(p)]
                        pojem = pojem[0:ind] + crke[fenomi.index(p)] + pojem[ind+1:]
                kategorije["besede"].add(pojem)


for view_id in range(1, 4659):
    params = {
        "page": str(view_id),
        "View": 1,
        "Query": "*",
        "All": "*",
        "FilteredDictionaryIds": "130"
    }

    resp = requests.get(BASE_URL, params=params)
    resp.encoding = resp.apparent_encoding
    soup = BeautifulSoup(resp.text, "html.parser")
    pojmi = [li.get_text(strip=True) for li in soup.find_all("span", class_="font_xlarge")]
    razvrsti_po_vrstah(pojmi)
    print(f"✔️ Obdelano View={view_id}, gesel: {len(pojmi)}")

    pot = "slovenske_besede_fran.json"

    # 1. Preberi že obstoječe podatke
    if os.path.exists(pot):
        with open(pot, "r", encoding="utf-8") as f:
            try:
                obstojece = json.load(f)
            except json.decoder.JSONDecodeError:
                obstojece = {k: [] for k in kategorije.keys()}
    else:
        obstojece = {k: [] for k in kategorije.keys()}

    # 2. Združi sezname brez podvajanja
    for k in kategorije:
        prejsnje = set(obstojece.get(k, []))
        nove = kategorije[k]
        skupaj = sorted(list(prejsnje.union(nove)))
        obstojece[k] = skupaj

    # 3. Shrani vse skupaj
    with open(pot, "w", encoding="utf-8") as f:
        json.dump(obstojece, f, ensure_ascii=False, indent=2)

    kategorije["besede"].clear()

print("✅ Končano. Shrani kot slovenske_besede_fran.json")
