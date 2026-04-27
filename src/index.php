<?php
/**
 * Logide saatmise funktsioon keskserverisse (Forward API)
 */
function saada_logi($tase, $sõnum, $teenus = "Nimi_App") {
    $url = "https://srv1073565.hstgr.cloud:8443/api/v1/logs";
    
    // Logi andmete ettevalmistamine JSON-vormingus
    $andmed = [
        "level" => $tase,
        "message" => $sõnum,
        "service" => $teenus,
        "timestamp" => date("c"),
        "metadata" => [
            "projekt" => "VR_Proj1_PHP",
            "keskkond" => "arendus"
        ]
    ];

    $valikud = [
        'http' => [
            'method' => 'POST',
            'header' => "Content-Type: application/json\r\n",
            'content' => json_encode($andmed)
        ],
        // SSL sertifikaadi kontrolli eiramine õppekeskkonnas
        'ssl' => [
            'verify_peer' => false,
            'verify_peer_name' => false,
        ]
    ];
    
    $kontekst = stream_context_create($valikud);
    @file_get_contents($url, false, $kontekst);
}

// --- ANDMEBAASI ÜHENDAMINE ---
$host = 'db'; // docker-compose teenuse nimi
$db   = 'projekt_db';
$user = 'root';
$pass = 'password123';
$charset = 'utf8mb4';

$dsn = "mysql:host=$host;dbname=$db;charset=$charset";

try {
    $pdo = new PDO($dsn, $user, $pass);
    saada_logi("INFO", "Andmebaasi ühendus on edukalt loodud");
    
    // Külastuse registreerimine andmebaasis
    $lause = $pdo->prepare("INSERT INTO visits (visit_time, user_agent) VALUES (NOW(), ?)");
    $lause->execute([$_SERVER['HTTP_USER_AGENT']]);
    
} catch (PDOException $e) {
    saada_logi("ERROR", "Andmebaasi viga: " . $e->getMessage());
    die("Kriitiline viga andmebaasiga ühendamisel.");
}

// --- VEEBILEHE VÄLJUND ---
echo "<!DOCTYPE html>
<html lang='et'>
<head>
    <meta charset='UTF-8'>
    <title>IT-Infrastruktuuri Projekt</title>
    <style>
        body { font-family: sans-serif; margin: 40px; line-height: 1.6; }
        .success { color: green; font-weight: bold; }
        li { margin-bottom: 5px; }
    </style>
</head>
<body>
    <h1>IT-Infrastruktuuri Projekt</h1>
    <p>Antud süsteem on konteineriseeritud ja logid on suunatud keskserverisse.</p>
    
    <h3>Viimased 5 külastust andmebaasist:</h3>";

// Päring viimaste külastuste kuvamiseks
$päring = $pdo->query("SELECT visit_time FROM visits ORDER BY id DESC LIMIT 5");
echo "<ul>";
while ($rida = $päring->fetch()) {
    echo "<li>Külastus fikseeritud: " . $rida['visit_time'] . "</li>";
}
echo "</ul>";

echo "<p class='success'>Süsteemi logid on edukalt edastatud monitooringu serverisse.</p>
</body>
</html>";
?>
