<?php
require_once 'db.php';

$reponses = [
    'q1' => 'c',
    'q2' => 'c',
    'q3' => 'b',
    'q4' => 'b',
    'q5' => 'c'
];

$score = 0;
foreach ($reponses as $question => $bonneReponse) {
    if (isset($_POST[$question]) && $_POST[$question] === $bonneReponse) {
        $score += 2;
    }
}

try {
    $stmt = $pdo->prepare("INSERT INTO results (score) VALUES (:score)");
    $stmt->execute(['score' => $score]);
} catch (PDOException $e) {
    die("Erreur lors de l'enregistrement : " . $e->getMessage());
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Résultat du QCM</title>
    <link rel="stylesheet" href="assets/style.css">
</head>
<body>

    <div class="result-box">
        <h2>Merci pour votre participation !</h2>
        <p class="score">Votre score : <strong><?= $score ?>/10</strong></p>
        <div class="progress-container">
            <div class="progress-bar" id="progress-bar" data-score="<?= $score ?>"></div>
        </div>
        <p>Vous pouvez fermer la page ou revenir au QCM pour recommencer.</p>
        <a href="index.php"><button>Revenir au QCM</button></a>
    </div>
    <script src="assets/script.js"></script>
    <script>
// Empêche retour arrière avec le bouton du navigateur
history.pushState(null, null, location.href);
window.addEventListener('popstate', function () {
    history.pushState(null, null, location.href);
});
</script>
<script>
    const score = <?= $score ?>;
    if (score === 10) {
        sessionStorage.removeItem("qcm_done");
    }
</script>

</body>
</html>
