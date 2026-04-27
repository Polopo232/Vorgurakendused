# IT-Infrastruktuuri Projekt - Veebirakendus ja Monitooring

Antud projekt on loodud õppeülesande raames. Süsteem koosneb konteineriseeritud veebirakendusest, andmebaasist ja tsentraalsest logimissüsteemist.

---

## 📌 Sisukord
* [1. Arhitektuuri joonis](#1-arhitektuuri-joonis)
* [2. Paigaldusjuhend](#2-paigaldusjuhend)
* [3. Rakenduse funktsionaalsus](#3-rakenduse-funktsionaalsus)
* [4. Andmebaasi administreerimine](#4-andmebaasi-administreerimine)
* [5. Monitooring ja Kibana](#5-monitooring-ja-kibana)
* [6. API Dokumentatsioon](#6-api-dokumentatsioon)

---

<a name="1-arhitektuuri-joonis"></a>
## 1. Arhitektuuri joonis
Süsteemi arhitektuur kirjeldab seoseid kasutaja brauseri, veebiserveri, rakendusserveri ja andmebaasi vahel. Logid suunatakse tsentraalsesse Forward API teenusesse.

<img width="905" height="457" alt="Screenshot 2026-04-27 120946" src="https://github.com/user-attachments/assets/8cc9d2b2-6f25-4577-ad34-71fe1404294b" />

---

<a name="2-paigaldusjuhend"></a>
## 2. Paigaldusjuhend
Süsteemi käivitamiseks peab masinas olema installitud **Docker** ja **Docker Compose**.

1. Kloonige repositoorium:
   \`\`\`bash
   git clone https://github.com/Polopo232/Vorgurakendused.git
   cd Vorgurakendused
   \`\`\`
2. Käivitage konteinerid:
   \`\`\`bash
   sudo docker compose up -d
   \`\`\`
3. Kontrollige konteinerite staatust:
   \`\`\`bash
   sudo docker ps
   \`\`\`



---

<a name="3-rakenduse-funktsionaalsus"></a>
## 3. Rakenduse funktsionaalsus
Veebirakendus on kättesaadav aadressil \`http://localhost\`.
* Igal lehe laadimisel registreeritakse külastus MariaDB andmebaasis.
* Rakendus kuvab viimased 5 külastust otse andmebaasist.
* Süsteem kontrollib ühendust andmebaasiga ja raporteerib vigadest logimissüsteemi.

<img width="1816" height="927" alt="image" src="https://github.com/user-attachments/assets/b16c3324-c964-4d4d-9077-6249e272d64b" />

---

<a name="4-andmebaasi-administreerimine"></a>
## 4. Andmebaasi administreerimine
* **Andmebaasi tüüp:** MariaDB 10.11
* **Andmebaasi nimi:** \`projekt_db\`
* **Tabeli struktuur:** \`visits\` (id, visit_time, user_agent)
* **Varundamine (Backup):**
  \`\`\`bash
  docker exec db_container_name mysqldump -u root -p projekt_db > backup.sql
  \`\`\`
* **Andmete taastamine:**
  \`\`\`bash
  docker exec -i db_container_name mariadb -u root -p projekt_db < backup.sql
  \`\`\`

---

<a name="5-monitooring-ja-kibana"></a>
## 5. Monitooring ja Kibana
Logid saadetakse reaalajas Elasticsearchi serverisse JSON-vormingus üle HTTPS protokolli.

* **Teenuse nimi:** \`Nimi_App\`
* **Logi sihtkoht:** \`https://srv1073565.hstgr.cloud:8443/api/v1/logs\`
* **Kibana vaade:** Kasutage filtrit \`service: "Nimi_App"\`, et jälgida rakenduse tervist.

<img width="1093" height="461" alt="image" src="https://github.com/user-attachments/assets/71911ef3-90a1-449b-9022-22d9f234f7fe" />

---

<a name="6-api-dokumentatsioon"></a>
## 6. API Dokumentatsioon
Rakendus pakub lihtsat liidest külastuste registreerimiseks ja andmete kuvamiseks.
* **Endpoint:** \`GET /\`
* **Vastus:** HTML dokument koos külastajate ajalooga.
* **Veahaldus:** Kõik PHP ja PDO vead logitakse tasemega \`ERROR\` ja saadetakse tsentraalsesse monitooringusse.

---
**Autor:** Polopo232
**Kuupäev:** 27. aprill 2026
EOF
