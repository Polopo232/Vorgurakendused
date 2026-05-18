## 1. Paigaldusjuhend
Süsteemi käivitamiseks on vajalik Docker ja Docker Compose.

1. Kloonige repositoorium: `git clone https://github.com/Polopo232/Vorgurakendused.git`.
2. Käivitage süsteem: `sudo docker compose up -d`.

---

## 3. Rakenduse funktsionaalsus
Veebirakendus registreerib külastusi ja kuvab ajalugu.
* **Ligipääs:** Ava brauseris `http://localhost`.
* **Kasutamine:** Iga lehe värskendus loob uue sissekande MariaDB andmebaasi.
* **Väljund:** Kuvatakse viimased 5 külastust koos seadme infoga.

<img width="1816" height="927" alt="Veebivaade" src="https://github.com/user-attachments/assets/b16c3324-c964-4d4d-9077-6249e272d64b" />


