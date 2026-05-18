# 👥 Veebirakenduse Kasutusjuhend

Antud juhend on mõeldud BananaLog veebirakenduse lõppkasutajatele ja klientidele ning kirjeldab süsteemi funktsionaalsust, integreeritud analüütikat ja selle kasutamist.

---

## 1. Rakenduse eesmärk ja olemus
BananaLog on loodud veebilehe külastuste automaatseks registreerimiseks, ajaloo kuvamiseks ning reaalajas statistika pärimiseks. Süsteem fikseerib iga veebilehe vaatamise ja võimaldab administraatoritel või äriklientidel analüüsida liiklust kuupäevade lõikes.

---

## 2. Kuidas teenust kasutada

Rakenduse kasutamine on maksimaalselt lihtne ega nõua kasutajalt keerulisi lisategevusi. Teenuse tarbimiseks tavatarbija ja analüütiku vaatest tuleb läbida järgmised sammud:

* 🌐 **Veebilehele sisenemine:** Ava oma eelistatud veebibrauser ja sisesta aadressiribale: `http://localhost`.
* 🔄 **Külastuse registreerimine:** Iga kord, kui lehele sisened või veebilehte värskendad (vajutades klahvi **F5**), loob süsteem automaatselt uue sissekande MariaDB andmebaasi ja saadab vastava info-logi monitooringusse.
* 📊 **Andmete kuvamine (Üldine väljund):** Veebilehel kuvatakse tekst: *"Antud süsteem on konteineriseeritud ja logid on suunatud keskserverisse"*. Selle teksti all kuvatakse dünaamiline nimekiri viimasest 5 üldisest külastusest koos täpse fikseeritud ajaga (*Timestamp*).
* 📅 **Integreeritud statistika pärimine (UUS):** Lehel on sisseehitatud kalendri ja analüütika blokk *"Filtreeri külastuste statistikat"*. 
  1. Vali sisendväljast soovitud kuupäev.
  2. Vajuta nupule **"Päri statistika"**.
  3. Süsteem teeb automaatse SQL-päringu ja kuvab valitud päeva kohta **täpse külastatavuse arvu** (sissekannete kogusumma) ning detailsed **kellaajad**, millal päringud tehti.
  4. Algvaatesse naasmiseks vajuta nuppu **"Tühjenda"**.

<img width="626" height="662" alt="{FC338D33-71D8-47F7-8B7B-A15186C55006}" src="https://github.com/user-attachments/assets/9686ab32-b48a-4804-b49f-3c00a377816c" />

---

## 3. Mis andmeid süsteem salvestab?

Kasutaja privaatsuse tagamiseks **ei kogu rakendus isikuandmeid**. Andmebaasi ja logitabelisse salvestatakse ainult kriitiline tehniline info ja äriline analüütika:

1. 🕒 **Külastuse aeg:** Täpne kuupäev ja kellaaeg, millal veebilehte vaadati, värskendati või millal statistika päring sooritati.
2. 💻 **Seadme info (User-Agent):** Tehniline teave selle kohta, millist operatsioonisüsteemi ja veebibrauserit külastaja kasutas (salvestatakse ainult uutel reaalsetel külastustel).
3. 📈 **Päringute ajalugu:** Süsteem eristab tavalisi lehe laadimisi administraatori tehtud statistika päringutest, saates iga tegevuse kohta vastava JSON-andmepaketi keskserverisse.

> ℹ️ **Süsteemi stabiilsus:** Kõik teenuse tekitatud logid (sh info-logid edukate statistikapäringute kohta ja error-logid andmebaasi tõrgete korral) edastatakse reaalajas ja turvaliselt monitooringu serverisse, mis tagab infrastruktuuri stabiilse töö ja kiire veaotsingu.

---
**Märkus administraatorile:** Kui teenus ei avane või kalendri päringud ebaõnnestuvad, kontrollige, kas Docker-konteinerid ja MariaDB teenus on korrektselt käivitatud vastavalt failile [ADMIN_GUIDE.md](./ADMIN_GUIDE.md).
