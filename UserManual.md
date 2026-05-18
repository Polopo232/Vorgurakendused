## 1. Kuidas teenust kasutada

Rakenduse kasutamine on maksimaalselt lihtne ega nõua kasutajalt keerulisi lisategevusi. Teenuse tarbimiseks tavatarbija vaatest tuleb läbida järgmised sammud:

* Veebilehele sisenemine: Ava oma eelistatud veebibrauser ja sisesta aadressiribale: http://localhost.

* Külastuse registreerimine: Iga kord, kui lehele sisened või veebilehte värskendad (vajutades klahvi F5), loob süsteem automaatselt uue sissekande MariaDB andmebaasi.

* Andmete kuvamine (Väljund): Veebilehel kuvatakse reaalajas tekst: "Antud süsteem on konteineriseeritud ja logid on suunatud keskserverisse". Selle teksti all kuvatakse dünaamiline nimekiri viimasest 5 külastusest koos täpse fikseeritud ajaga (Timestamp).

<img width="596" height="547" alt="{E67D8AF5-11F6-4F07-9CF4-914789B2DECE}" src="https://github.com/user-attachments/assets/244ce42d-12a7-4a3d-8b04-2c1741287575" />

## 2. Mis andmeid süsteem salvestab?

Kasutaja privaatsuse tagamiseks ei kogu rakendus isikuandmeid. Andmebaasi ja logitabelisse salvestatakse ainult kriitiline tehniline info:

1. Külastuse aeg: Täpne kuupäev ja kellaaeg, millal veebilehte vaadati või värskendati.

2. Seadme info (User-Agent): Tehniline teave selle kohta, millist operatsioonisüsteemi ja veebibrauserit külastaja kasutas.

3. Süsteemi stabiilsus: Kõik teenuse tekitatud logid edastatakse reaalajas ja turvaliselt monitooringu serverisse, mis tagab infrastruktuuri stabiilse töö ja kiire veaotsingu.
