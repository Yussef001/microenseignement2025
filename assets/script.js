window.addEventListener("DOMContentLoaded", function () {
    const progressBar = document.getElementById("progress-bar");

    if (progressBar) {
        const score = parseInt(progressBar.dataset.score, 10);
        const percent = (score / 10) * 100;

        progressBar.style.width = percent + "%";
        progressBar.textContent = percent + "%";

        // Déterminer la couleur
        if (score >= 8) {
            progressBar.classList.add("bar-green");
        } else if (score >= 5) {
            progressBar.classList.add("bar-orange");
        } else {
            progressBar.classList.add("bar-red");
        }
    }
    // Si score < 10, bloquer la possibilité de revenir au QCM
    if (typeof score !== 'undefined' && score < 10) {
        sessionStorage.setItem("qcm_done", "1");
    }
});
