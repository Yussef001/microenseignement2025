<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>QCM - Microenseignement 2025</title>
    <link rel="stylesheet" href="assets/style.css">
</head>
<body>

    <h1>QCM – Simplification de fonctions logiques</h1>

    <form action="submit.php" method="POST">

        <!-- Question 1 -->
        <fieldset>
            <legend>1. Quelle est la fonction logique non simplifiée obtenue à partir de la table de vérité de l’histoire de Fabrice ? (2 points)</legend>
            <label><input type="radio" name="q1" value="a"> F = A + B</label>
            <label><input type="radio" name="q1" value="b"> F = A·B</label>
            <label><input type="radio" name="q1" value="c"> F = A&#773;·B + A·B&#773; + A·B</label>
            <label><input type="radio" name="q1" value="d"> F = A ⊕ B</label>
        </fieldset>

        <!-- Question 2 -->
        <fieldset>
            <legend>2. Quelle est la forme simplifiée correcte de la fonction logique ? (2 points)</legend>
            <label><input type="radio" name="q2" value="a"> F = A·B</label>
            <label><input type="radio" name="q2" value="b"> F = A ⊕ B</label>
            <label><input type="radio" name="q2" value="c"> F = A + B</label>
            <label><input type="radio" name="q2" value="d"> F = A&#773;·B&#773; + A·B</label>
        </fieldset>

        <!-- Question 3 -->
        <fieldset>
            <legend>3. Dans le contexte de l’histoire, que signifie la combinaison A = 1 et B = 0 ? (2 points)</legend>
            <label><input type="radio" name="q3" value="a"> Alice et Brigitte ont envoyé un message</label>
            <label><input type="radio" name="q3" value="b"> Seule Alice a envoyé un message</label>
            <label><input type="radio" name="q3" value="c"> Aucun message n’a été envoyé</label>
            <label><input type="radio" name="q3" value="d"> Seule Brigitte a envoyé un message</label>
        </fieldset>

        <!-- Question 4 -->
        <fieldset>
            <legend>4. À quoi sert la méthode de Karnaugh ? (2 points)</legend>
            <label><input type="radio" name="q4" value="a"> Calculer les puissances logiques</label>
            <label><input type="radio" name="q4" value="b"> Simplifier les fonctions logiques à l’aide d’un tableau</label>
            <label><input type="radio" name="q4" value="c"> Dessiner des circuits électriques</label>
            <label><input type="radio" name="q4" value="d"> Convertir des nombres binaires en hexadécimal</label>
        </fieldset>

        <!-- Question 5 -->
        <fieldset>
            <legend>5. Pourquoi simplifie-t-on une fonction logique avant de l’implémenter ? (2 points)</legend>
            <label><input type="radio" name="q5" value="a"> Pour la rendre plus difficile à comprendre</label>
            <label><input type="radio" name="q5" value="b"> Pour augmenter le nombre de portes logiques</label>
            <label><input type="radio" name="q5" value="c"> Pour obtenir un circuit plus économique et rapide</label>
            <label><input type="radio" name="q5" value="d"> Pour changer le résultat logique final</label>
        </fieldset>

        <div style="text-align:center;">
            <button type="submit">Soumettre</button>
        </div>

    </form>
    <script>
        window.addEventListener("DOMContentLoaded", function () {
            if (sessionStorage.getItem("qcm_done") === "1") {
                alert("Vous avez déjà participé. Vous ne pouvez plus soumettre le QCM.");
                window.location.href = "submit.php"; // ou page d'attente
            }
        });
    </script>

</body>
</html>
