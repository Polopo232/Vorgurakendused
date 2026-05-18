# IT-Infrastruktuuri Projekt - Veebirakendus ja Monitooring

Antud projekt on loodud õppeülesande raames. Süsteem koosneb konteineriseeritud veebirakendusest, andmebaasist ja tsentraalsest logimissüsteemist.

<img width="948" height="690" alt="Süsteemi vaade" src="https://github.com/user-attachments/assets/d1e949ba-db93-477c-a4e4-a26672893cd7" />

---

## 📌 Sisukord
* [1. Arhitektuuri joonis](#1-arhitektuuri-joonis)
* [2. Andmebaasi spetsifikatsioon](#4-andmebaasi-spetsifikatsioon)
* [3. Monitooring ja Kibana](#5-monitooring-ja-kibana)
* [4. API Dokumentatsioon](#6-api-dokumentatsioon)

**Tehniline Administraatori Juhend asub siin:** [ADMIN_GUIDE.md](./ADMIN_GUIDE.md).
**Kasutusjuhend (User Manual) asub siin:** [UserManual.md](./UserManual.md).

---

<a name="1-arhitektuuri-joonis"></a>
## 1. Arhitektuuri joonis
Süsteemi arhitektuur on täielikult konteineriseeritud (Nginx, PHP-FPM, MariaDB). Joonis kirjeldab andmevoogusid kasutaja ja teenuste vahel.

<img width="905" height="457" alt="Arhitektuur" src="https://github.com/user-attachments/assets/8cc9d2b2-6f25-4577-ad34-71fe1404294b" />

---

<a name="4-andmebaasi-spetsifikatsioon"></a>
## 2. Andmebaasi spetsifikatsioon
* **Tüüp:** MariaDB 10.11.
* **Tabel:** `visits`.
* **Väljad:** `id` (PK), `visit_time` (Timestamp), `user_agent` (Varchar).

---

<a name="5-monitooring-ja-kibana"></a>
## 3. Monitooring ja Kibana
Logid edastatakse reaalajas Forward API kaudu JSON-vormingus.
* **Teenus:** `Nimi_App`.
* **Kibana:** Kasutage filtrit `service: "Nimi_App"`, et jälgida süsteemi logisid.

<img width="1093" height="461" alt="Kibana" src="https://github.com/user-attachments/assets/71911ef3-90a1-449b-9022-22d9f234f7fe" />

---

<a name="6-api-dokumentatsioon"></a>
## 4. API Dokumentatsioon
Süsteem pakub REST-liidest vastavalt OpenAPI (Swagger) standardile.
* **Endpoint:** `GET /` - väljastab külastuste ajaloo.
* **Turvalisus:** Päringud on kaitstud `x-api-id` ja `x-api-key` päistega.
* **Fail:** Täielik spetsifikatsioon asub failis `swagger.yaml`.

---

**Autor:** Nikita Nikiforov | **Rühm:** TARpv24
