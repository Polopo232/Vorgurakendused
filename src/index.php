<?php
/**
 * Logide saatmise funktsioon keskserverisse (Forward API)
 */
function saada_logi($tase, $sõnum, $teenus = "BananaLog_TARpv24") {
    $url = "https://srv1073565.hstgr.cloud:8443/api/v1/logs";
    
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
        'ssl' => [
            'verify_peer' => false,
            'verify_peer_name' => false,
        ]
    ];
    
    $kontekst = stream_context_create($valikud);
    @file_get_contents($url, false, $kontekst);
}

// --- ANDMEBAASI ÜHENDAMINE ---
$host = 'db'; 
$db   = 'projekt_db';
$user = 'root';
$pass = 'password123';
$charset = 'utf8mb4';

$dsn = "mysql:host=$host;dbname=$db;charset=$charset";

try {
    $pdo = new PDO($dsn, $user, $pass);
    
    // Külastuse registreerimine andmebaasis (ainult tavalisel lehe laadimisel, mitte statistika pärimisel)
    if (!isset($_GET['kuupäev'])) {
        $lause = $pdo->prepare("INSERT INTO visits (visit_time, user_agent) VALUES (NOW(), ?)");
        $lause->execute([$_SERVER['HTTP_USER_AGENT']]);
        saada_logi("INFO", "Uus külastus registreeritud edukalt");
    } else {
        saada_logi("INFO", "Statistika päring sooritatud kuupäevale: " . $_GET['kuupäev']);
    }
    
} catch (PDOException $e) {
    saada_logi("ERROR", "Andmebaasi viga: " . $e->getMessage());
    die("Kriitiline viga andmebaasiga ühendamisel.");
}

// --- VEEBILEHE VÄLJUND ---
echo "<!DOCTYPE html>
<html lang='et'>
<head>
    <meta charset='UTF-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
    <title>BananaLog - IT-Infrastruktuuri Projekt</title>
    <style>
        :root {
            --bg-color: #0b0f17;          
            --card-bg: #161b26;           
            --text-main: #f3f4f6;         
            --text-muted: #9ca3af;        
            --banana-yellow: #f59e0b;     
            --banana-cream: #fef08a;      
            --accent-green: #10b981;      
            --border-color: #242b3d;      
        }
        body { 
            font-family: 'Segoe UI', Roboto, Helvetica, Arial, sans-serif; 
            background-color: var(--bg-color); 
            color: var(--text-main);
            margin: 0; 
            padding: 40px 20px;
            display: flex;
            justify-content: center;
        }
        .container {
            max-width: 800px;
            width: 100%;
        }
        header {
            margin-bottom: 35px;
            border-bottom: 1px solid var(--border-color);
            padding-bottom: 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .logo-area h1 { 
            font-size: 2.4rem; 
            margin: 0;
            font-weight: 800;
            background: linear-gradient(to right, var(--banana-yellow), var(--banana-cream));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }
        .status-badge {
            background-color: rgba(245, 158, 11, 0.08);
            color: var(--banana-yellow);
            padding: 6px 14px;
            border-radius: 20px;
            font-size: 0.85rem;
            font-weight: 600;
            border: 1px solid rgba(245, 158, 11, 0.2);
        }
        .card {
            background-color: var(--card-bg);
            border: 1px solid var(--border-color);
            border-radius: 14px;
            padding: 24px;
            margin-bottom: 25px;
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.3);
        }
        h3 { 
            margin-top: 0; 
            font-size: 1.2rem; 
            color: var(--text-main);
            font-weight: 600;
            letter-spacing: -0.025em;
        }
        
        /* Фирменная форма фильтра */
        .filter-form {
            display: flex;
            gap: 12px;
            margin-top: 15px;
        }
        .filter-form input[type='date'] {
            background-color: rgba(11, 15, 23, 0.6);
            border: 1px solid var(--border-color);
            color: var(--text-main);
            padding: 10px 16px;
            border-radius: 8px;
            font-family: inherit;
            font-size: 0.95rem;
            outline: none;
        }
        .filter-form input[type='date']:focus {
            border-color: var(--banana-yellow);
        }
        .filter-form button, .reset-btn {
            background-color: var(--banana-yellow);
            color: #0b0f17;
            border: none;
            padding: 10px 20px;
            border-radius: 8px;
            font-weight: 600;
            cursor: pointer;
            font-size: 0.95rem;
            transition: opacity 0.2s ease;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
        }
        .filter-form button:hover, .reset-btn:hover {
            opacity: 0.9;
        }
        .reset-btn {
            background-color: transparent;
            border: 1px solid var(--border-color);
            color: var(--text-main);
            margin-left: 10px;
        }

        .stat-summary {
            background-color: rgba(245, 158, 11, 0.05);
            border: 1px dashed var(--banana-yellow);
            padding: 12px 16px;
            border-radius: 8px;
            margin-bottom: 15px;
            font-size: 1rem;
        }
        
        ul { 
            list-style: none; 
            padding: 0; 
            margin: 0;
        }
        li { 
            background-color: rgba(11, 15, 23, 0.5);
            border: 1px solid var(--border-color);
            padding: 14px 18px; 
            margin-bottom: 12px; 
            border-radius: 10px;
            font-family: 'Courier New', Courier, monospace;
            font-size: 0.95rem;
            display: flex;
            align-items: center;
        }
        li::before {
            content: '🍌';
            margin-right: 14px;
            font-size: 1.1rem;
        }
        .success-msg { 
            color: var(--accent-green); 
            font-weight: 600; 
            display: flex;
            align-items: center;
            gap: 10px;
            margin-top: 20px;
            font-size: 0.9rem;
        }
        .success-msg::before {
            content: '✓';
            background-color: rgba(16, 185, 129, 0.1);
            border: 1px solid var(--accent-green);
            border-radius: 50%;
            width: 22px;
            height: 22px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-size: 0.85rem;
        }
    </style>
</head>
<body>
    <div class='container'>
        <header>
            <div class='logo-area'>
                <h1>BananaLog</h1>
            </div>
            <div class='status-badge'>Infrastruktuur: Konteineriseeritud</div>
        </header>
        
        <div class='card'>
            <h3>Süsteemi olek</h3>
            <p style='color: var(--text-muted); margin: 0; line-height: 1.5;'>Antud süsteem on konteineriseeritud ja logid on suunatud keskserverisse.</p>
        </div>

        <div class='card'>
            <h3>Filtreeri külastuste statistikat</h3>
            <form method='GET' class='filter-form'>
                <input type='date' name='kuupäev' value='".(isset($_GET['kuupäev']) ? htmlspecialchars($_GET['kuupäev']) : "")."'' required>
                <button type='submit'>Päri statistika</button>
                ".(isset($_GET['kuupäev']) ? "<a href='/' class='reset-btn'>Tühjenda</a>" : "")."
            </form>
        </div>

        <div class='card'>";

// --- ЛОГИКА АНАЛИТИКИ И ВЫВОДА ---
if (isset($_GET['kuupäev']) && !empty($_GET['kuupäev'])) {
    $otsitav_paev = $_GET['kuupäev'];
    
    // 1. Запрос на подсчет точной посещаемости за выбранный день
    $loendur_lause = $pdo->prepare("SELECT COUNT(*) FROM visits WHERE DATE(visit_time) = ?");
    $loendur_lause->execute([$otsitav_paev]);
    $külastuste_arv = $loendur_lause->fetchColumn();
    
    echo "<h3>Statistika kuupäeval: " . htmlspecialchars($otsitav_paev) . "</h3>";
    echo "<div class='stat-summary'>
            ⚡ Kokku fikseeritud külastusi: <strong>" . $külastuste_arv . "</strong>
          </div>";
          
    // 2. Запрос на детальный вывод: во сколько именно заходили
    $andmed_lause = $pdo->prepare("SELECT TIME(visit_time) as kellaaeg, user_agent FROM visits WHERE DATE(visit_time) = ? ORDER BY id DESC");
    $andmed_lause->execute([$otsitav_paev]);
    
    if ($külastuste_arv > 0) {
        echo "<p style='color: var(--text-muted); font-size: 0.9rem;'>Külastuste kellaajad:</p><ul>";
        while ($rida = $andmed_lause->fetch()) {
            echo "<li>Kell: <strong>" . $rida['kellaaeg'] . "</strong></li>";
        }
        echo "</ul>";
    } else {
        echo "<p style='color: var(--text-muted);'>Valitud kuupäeval külastused puuduvad.</p>";
    }

} else {
    // Стандартный вывод последних 5 записей, если фильтр не выбран
    echo "<h3>Viimased 5 üldist külastust andmebaasist:</h3>";
    
    $päring = $pdo->query("SELECT visit_time FROM visits ORDER BY id DESC LIMIT 5");
    echo "<ul>";
    while ($rida = $päring->fetch()) {
        echo "<li>Külastus fikseeritud: " . $rida['visit_time'] . "</li>";
    }
    echo "</ul>";
}

echo "      <p class='success-msg'>Süsteemi logid on edukalt edastatud monitooringu serverisse.</p>
        </div>
    </div>
</body>
</html>";
?>
