
let timer;
let isRunning = false;


const timerInputMinutes = document.getElementById("timerInputMinutes");
const timerInputSeconds = document.getElementById("timerInputSeconds");
const startPauseButton = document.getElementById("startPauseButton");
const resetTimerButton = document.getElementById("resetTimerButton");


function getTimeInSeconds() {
    const minutes = parseInt(timerInputMinutes.value, 10) || 0;
    const seconds = parseInt(timerInputSeconds.value, 10) || 0;
    return minutes * 60 + seconds;
}

function setTimeFromSeconds(totalSeconds) {
    const minutes = Math.floor(totalSeconds / 60);
    const seconds = totalSeconds % 60;
    timerInputMinutes.value = String(minutes).padStart(2, "0");
    timerInputSeconds.value = String(seconds).padStart(2, "0");
}

function startPauseTimer() {
    if (isRunning) {
        pauseTimer();
        return;
    }

    let timeRemaining = getTimeInSeconds();
    if (timeRemaining <= 0) return;

    isRunning = true;
    updateButtonText();

    timer = setInterval(() => {
        if (timeRemaining <= 0) {
            clearInterval(timer);
            isRunning = false;
            alert("Fin du temps imparti !");
            updateButtonText();
        } else {
            timeRemaining--;
            setTimeFromSeconds(timeRemaining);
        }
    }, 1000);
}

function pauseTimer() {
    clearInterval(timer);
    isRunning = false;
    updateButtonText();
}

function resetTimer() {
    pauseTimer();
    timerInputMinutes.value = "00";
    timerInputSeconds.value = "00";
}

function updateButtonText() {
    if (isRunning) {
        startPauseButton.textContent = "Arrêter";
        startPauseButton.classList = "btn btn-warning";
    } else {
        startPauseButton.textContent = "Démarrer";
        startPauseButton.classList = "btn btn-success";
    }
}

startPauseButton.addEventListener("click", startPauseTimer);
resetTimerButton.addEventListener("click", resetTimer);

timerInputMinutes.addEventListener("input", () => {
    if (timerInputMinutes.value < 0) timerInputMinutes.value = "00";
});
timerInputSeconds.addEventListener("input", () => {
    if (timerInputSeconds.value < 0) timerInputSeconds.value = "00";
    if (timerInputSeconds.value > 59) timerInputSeconds.value = "59";
});

function handleEnter(event) {
    if (event.key === "Enter") {
        event.preventDefault();
        startPauseTimer();
    }
}

timerInputMinutes.addEventListener("keydown", function (event) { handleEnter(event); });
timerInputSeconds.addEventListener("keydown", function (event) { handleEnter(event); });


