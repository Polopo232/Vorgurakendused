# IT-Infrastruktuuri Projekt - Veebirakendus ja Monitooring

Antud projekt on loodud õppeülesande raames. Süsteem koosneb konteineriseeritud veebirakendusest, andmebaasist ja tsentraalsest logimissüsteemist.

<img width="948" height="690" alt="Süsteemi vaade" src="https://github.com/user-attachments/assets/d1e949ba-db93-477c-a4e4-a26672893cd7" />

---

## 📌 Sisukord
* [1. Arhitektuuri joonis](#1-arhitektuuri-joonis)
* [2. Paigaldusjuhend](#2-paigaldusjuhend)
* [3. Rakenduse funktsionaalsus](#3-rakenduse-funktsionaalsus)
* [4. Andmebaasi spetsifikatsioon](#4-andmebaasi-spetsifikatsioon)
* [5. Monitooring ja Kibana](#5-monitooring-ja-kibana)
* [6. API Dokumentatsioon](#6-api-dokumentatsioon)

---

<a name="1-arhitektuuri-joonis"></a>
## 1. Arhitektuuri joonis (5.2)
Süsteemi arhitektuur on täielikult konteineriseeritud (Nginx, PHP-FPM, MariaDB). Joonis kirjeldab andmevoogusid kasutaja ja teenuste vahel.

<img width="905" height="457" alt="Arhitektuur" src="https://github.com/user-attachments/assets/8cc9d2b2-6f25-4577-ad34-71fe1404294b" />

---

<a name="2-paigaldusjuhend"></a>
## 2. Paigaldusjuhend
Süsteemi käivitamiseks on vajalik Docker ja Docker Compose[cite: 2].

1. Kloonige repositoorium: `git clone https://github.com/Polopo232/Vorgurakendused.git`[cite: 2].
2. Käivitage süsteem: `sudo docker compose up -d`[cite: 2].

---

<a name="3-rakenduse-funktsionaalsus"></a>
## 3. Rakenduse funktsionaalsus (User Manual - 5.1)
Veebirakendus registreerib külastusi ja kuvab ajalugu[cite: 2].
* **Ligipääs:** Ava brauseris `http://localhost`[cite: 2].
* **Kasutamine:** Iga lehe värskendus loob uue sissekande MariaDB andmebaasi[cite: 2].
* **Väljund:** Kuvatakse viimased 5 külastust koos seadme infoga[cite: 2].

<img width="1816" height="927" alt="Veebivaade" src="https://github.com/user-attachments/assets/b16c3324-c964-4d4d-9077-6249e272d64b" />

---

<a name="4-andmebaasi-spetsifikatsioon"></a>
## 4. Andmebaasi spetsifikatsioon (DB Spec - 5.2)
* **Tüüp:** MariaDB 10.11[cite: 2].
* **Tabel:** `visits`[cite: 2].
* **Väljad:** `id` (PK), `visit_time` (Timestamp), `user_agent` (Varchar)[cite: 2].

---

<a name="5-monitooring-ja-kibana"></a>
## 5. Monitooring ja Kibana (4.2)
Logid edastatakse reaalajas Forward API kaudu JSON-vormingus[cite: 1, 2].
* **Teenus:** `Nimi_App`[cite: 1, 2].
* **Kibana:** Kasutage filtrit `service: "Nimi_App"`, et jälgida süsteemi logisid[cite: 1, 2].

<img width="1093" height="461" alt="Kibana" src="https://github.com/user-attachments/assets/71911ef3-90a1-449b-9022-22d9f234f7fe" />

---

<a name="6-api-dokumentatsioon"></a>
## 6. API Dokumentatsioon (5.2)
Süsteem pakub REST-liidest vastavalt OpenAPI (Swagger) standardile[cite: 2].
* **Endpoint:** `GET /` - väljastab külastuste ajaloo[cite: 2].
* **Turvalisus:** Päringud on kaitstud `x-api-id` ja `x-api-key` päistega[cite: 1, 2].
* **Fail:** Täielik spetsifikatsioon asub failis `swagger.yaml`[cite: 2].

---
**Tehniline Administraatori Juhend (5.3) asub siin:** [ADMIN_GUIDE.md](./ADMIN_GUIDE.md)[cite: 2].

**Autor:** Nikita Nikiforov | **Rühm:** TARpv24
