1. Rakenduse eesmärk ja olemus

Veebirakendus on loodud külastuste automaatseks registreerimiseks ja ajaloo kuvamiseks. Süsteem fikseerib iga veebilehe vaatamise ja salvestab andmed reaalajas.
2. Kuidas teenust kasutada

Rakenduse kasutamine on maksimaalselt lihtne ega nõua kasutajalt lisategevusi:

    Veebilehele sisenemine: Ava oma veebibrauser ja sisesta aadressiribale: http://localhost.

    Külastuse registreerimine: Iga kord, kui sa lehele sisened või veebilehte värskendad (vajutades klahvi F5), loob süsteem automaatselt uue sissekande MariaDB andmebaasi.

    Andmete kuvamine (Väljund): Veebilehel kuvatakse reaalajas tekst: "Antud süsteem on konteineriseeritud ja logid on suunatud keskserverisse". Selle all näed nimekirja viimasest 5 külastusest koos täpse fikseeritud ajaga (Timestamp).

3. Mis andmeid süsteem salvestab?

Sinu privaatsuse tagamiseks ei kogu rakendus isikuandmeid. Salvestatakse ainult:

    Külastuse aeg: Täpne kuupäev ja kellaaeg, millal lehte värskendati.

    Seadme info (User-Agent): Tehniline teave selle kohta, millist brauserit ja operatsioonisüsteemi sa külastamiseks kasutasid.

Süsteemi logid edastatakse turvaliselt monitooringu serverisse, tagades süsteemi stabiilse töö.

Märkus administraatorile: Kui teenus ei avane aadressil http://localhost, kontrollige, kas Docker-konteinerid on korrektselt käivitatud vastavalt failile [ADMIN_GUIDE.md](./ADMIN_GUIDE.md).


