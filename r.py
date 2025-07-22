# Zamenja določene črke z drugimi
import json

kategorije: dict = {
    "besede": list()
}

pot = "slovenske_besede_fran.json"
with open(pot, "r", encoding="utf-8") as f:
    try:
        obstojece = json.load(f)
    except json.decoder.JSONDecodeError:
        obstojece = {k: [] for k in kategorije.keys()}

for o in obstojece["besede"]:
    if "ŕ" in o:
        for ind in range(len(o)):
            c = o[ind]
            if c == "ŕ":
                o = o[0:ind] + "r" + o[ind+1:]
                break
    kategorije["besede"].append(o)

with open(pot, "w", encoding="utf-8") as f:
    json.dump(kategorije, f, ensure_ascii=False, indent=2)