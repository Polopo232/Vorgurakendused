# Süsteemi Administraatori Juhend

See dokument on mõeldud tehnilisele personalile süsteemi haldamiseks ja hoolduseks.

## 1. Paigaldusjuhend
Süsteemi käivitamiseks on vajalik Docker ja Docker Compose.

1. Kloonige repositoorium: `git clone https://github.com/Polopo232/Vorgurakendused.git`.
2. Käivitage süsteem: `sudo docker compose up -d`.

---

## 2. Rakenduse funktsionaalsus
Veebirakendus registreerib külastusi ja kuvab ajalugu.
* **Ligipääs:** Ava brauseris `http://localhost`.
* **Kasutamine:** Iga lehe värskendus loob uue sissekande MariaDB andmebaasi.
* **Väljund:** Kuvatakse viimased 5 külastust koos seadme infoga.

<img width="1816" height="927" alt="Veebivaade" src="https://github.com/user-attachments/assets/b16c3324-c964-4d4d-9077-6249e272d64b" />

---

## 3. Infrastruktuuri haldus
* **Nginx:** Tegeleb pordiga 80 ja suunab liikluse PHP konteinerisse.
* **Portide haldus:** Rakendus suhtleb välise Forward API-ga pordil 8443.

## 4. Andmebaasi varundamine ja taastamine
Administraator peab regulaarselt looma varukoopiaid.
* **Varundamine:** `docker exec nimi_db mysqldump -u root -p projekt_db > backup.sql`.
* **Taastamine:** `docker exec -i nimi_db mariadb -u root -p projekt_db < backup.sql`.

## 5. Logiskriptide konfigureerimine
Logid saadetakse HTTPS POST päringutega.
* **Autoriseerimine:** Kontrollige `index.php` failis `x-api-id` ja `x-api-key` väärtuste vastavust.
* **Veaotsing:** Kasutage `docker logs nimi_app`, et jälgida saatmisprotsessi.

---
**Konfidentsiaalne | IT-Infrastruktuuri meeskond**
