# Süsteemi Administraatori Juhend

See dokument on mõeldud tehnilisele personalile süsteemi haldamiseks ja hoolduseks.

## 1. Infrastruktuuri haldus
* **Nginx:** Tegeleb pordiga 80 ja suunab liikluse PHP konteinerisse.
* **Portide haldus:** Rakendus suhtleb välise Forward API-ga pordil 8443.

## 2. Andmebaasi varundamine ja taastamine
Administraator peab regulaarselt looma varukoopiaid.
* **Varundamine:** `docker exec nimi_db mysqldump -u root -p projekt_db > backup.sql`.
* **Taastamine:** `docker exec -i nimi_db mariadb -u root -p projekt_db < backup.sql`.

## 3. Logiskriptide konfigureerimine
Logid saadetakse HTTPS POST päringutega.
* **Autoriseerimine:** Kontrollige `index.php` failis `x-api-id` ja `x-api-key` väärtuste vastavust.
* **Veaotsing:** Kasutage `docker logs nimi_app`, et jälgida saatmisprotsessi.

---
**Konfidentsiaalne | IT-Infrastruktuuri meeskond**
