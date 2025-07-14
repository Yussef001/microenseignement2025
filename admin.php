<?php
require_once 'db.php';

// Récupération des scores
try {
    $stmt = $pdo->query("SELECT score FROM results");
    $scores = $stmt->fetchAll(PDO::FETCH_COLUMN);

    $total = count($scores);
    $count10 = 0;
    $countFail = 0;

    foreach ($scores as $s) {
        if ($s == 10) $count10++;
        if ($s < 5) $countFail++;
    }

    $percent10 = $total > 0 ? round($count10 / $total * 100, 1) : 0;
    $percentFail = $total > 0 ? round($countFail / $total * 100, 1) : 0;
    $percentOther = 100 - $percent10 - $percentFail;

} catch (PDOException $e) {
    die("Erreur : " . $e->getMessage());
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Admin – Statistiques QCM</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link rel="stylesheet" href="assets/style.css">
    <style>
        body {
            background: radial-gradient(circle at top left, #e3f2fd, #ffffff);
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            margin: 0;
            padding: 40px;
            color: #002244;
        }

        .admin-box {
            max-width: 750px;
            margin: auto;
            background: rgba(255, 255, 255, 0.9);
            padding: 40px;
            border-radius: 20px;
            box-shadow: 0 15px 40px rgba(0, 102, 204, 0.25);
            backdrop-filter: blur(10px);
            animation: fadeIn 1s ease-in-out;
        }

        .admin-box h2 {
            text-align: center;
            margin-bottom: 30px;
            color: #003366;
            font-size: 26px;
        }

        .stat {
            font-size: 18px;
            margin: 15px 0 10px 0;
        }

        .bar-graph {
            height: 22px;
            background: #e0e0e0;
            border-radius: 12px;
            overflow: hidden;
            margin-bottom: 20px;
            box-shadow: inset 0 1px 4px rgba(0,0,0,0.1);
        }

        .bar {
            height: 100%;
            color: #fff;
            text-align: center;
            line-height: 22px;
            font-size: 13px;
            font-weight: bold;
        }

        .green { background: linear-gradient(90deg, #4caf50, #66bb6a); }
        .red { background: linear-gradient(90deg, #f44336, #ef5350); }
        .blue { background: linear-gradient(90deg, #2196f3, #42a5f5); }

        canvas {
            display: block;
            max-width: 100%;
            margin: 30px auto;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .footer {
            text-align: center;
            margin-top: 40px;
        }

        .footer button {
            padding: 10px 20px;
            font-size: 15px;
            border: none;
            border-radius: 30px;
            background: linear-gradient(90deg, #0066cc, #00c6ff);
            color: #fff;
            cursor: pointer;
            box-shadow: 0 4px 10px rgba(0,0,0,0.15);
        }

        .footer button:hover {
            background: linear-gradient(90deg, #004c99, #00aaff);
        }
    </style>
</head>
<body>

<div class="admin-box">
    <h2>📊 Statistiques QCM – Page admin</h2>

    <div class="stat">👥 Total participants : <strong><?= $total ?></strong></div>

    <div class="stat">🟩 10/10 : <strong><?= $count10 ?> (<?= $percent10 ?>%)</strong></div>
    <div class="bar-graph">
        <div class="bar green" style="width: <?= $percent10 ?>%"><?= $percent10 ?>%</div>
    </div>

    <div class="stat">🟥 Moins de 5/10 : <strong><?= $countFail ?> (<?= $percentFail ?>%)</strong></div>
    <div class="bar-graph">
        <div class="bar red" style="width: <?= $percentFail ?>%"><?= $percentFail ?>%</div>
    </div>

    <div class="stat">🔷 Moyens (5 à 9/10 hors 10) : <strong><?= $total - $count10 - $countFail ?> (<?= $percentOther ?>%)</strong></div>
    <div class="bar-graph">
        <div class="bar blue" style="width: <?= $percentOther ?>%"><?= $percentOther ?>%</div>
    </div>

    <canvas id="qcmChart" width="400" height="200"></canvas>

    <div class="footer">
        <a href="index.php"><button>Retour au QCM</button></a>
    </div>
</div>

<script>
    const chartData = {
        labels: ["10/10", "< 5/10", "5 à 9/10"],
        datasets: [{
            label: "Répartition des scores",
            data: [<?= $count10 ?>, <?= $countFail ?>, <?= $total - $count10 - $countFail ?>],
            backgroundColor: [
                "rgba(76, 175, 80, 0.7)",
                "rgba(244, 67, 54, 0.7)",
                "rgba(33, 150, 243, 0.7)"
            ],
            borderColor: [
                "rgba(76, 175, 80, 1)",
                "rgba(244, 67, 54, 1)",
                "rgba(33, 150, 243, 1)"
            ],
            borderWidth: 1
        }]
    };

    const ctx = document.getElementById("qcmChart").getContext("2d");
    const qcmChart = new Chart(ctx, {
        type: "bar",
        data: chartData,
        options: {
            responsive: true,
            plugins: {
                legend: { display: false },
                tooltip: { enabled: true }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        stepSize: 1,
                        precision: 0
                    }
                }
            }
        }
    });

    // 🔄 Recharge automatique toutes les 15 secondes
    setTimeout(() => {
        location.reload();
    }, 15000);
</script>

</body>
</html>
