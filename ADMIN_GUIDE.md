# Süsteemi Administraatori Juhend (5.3)

See dokument on mõeldud tehnilisele personalile süsteemi haldamiseks ja hoolduseks[cite: 2].

## 1. Infrastruktuuri haldus
* **Nginx:** Tegeleb pordiga 80 ja suunab liikluse PHP konteinerisse[cite: 2].
* **Portide haldus:** Rakendus suhtleb välise Forward API-ga pordil 8443[cite: 1, 2].

## 2. Andmebaasi varundamine ja taastamine
Administraator peab regulaarselt looma varukoopiaid[cite: 2].
* **Varundamine:** `docker exec nimi_db mysqldump -u root -p projekt_db > backup.sql`[cite: 2].
* **Taastamine:** `docker exec -i nimi_db mariadb -u root -p projekt_db < backup.sql`[cite: 2].

## 3. Logiskriptide konfigureerimine
Logid saadetakse HTTPS POST päringutega[cite: 1, 2].
* **Autoriseerimine:** Kontrollige `index.php` failis `x-api-id` ja `x-api-key` väärtuste vastavust[cite: 1, 2].
* **Veaotsing:** Kasutage `docker logs nimi_app`, et jälgida saatmisprotsessi[cite: 2].

---
**Konfidentsiaalne | IT-Infrastruktuuri meeskond**
