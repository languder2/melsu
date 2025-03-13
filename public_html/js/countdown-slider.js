document.addEventListener('DOMContentLoaded', () => {

    const endDate = new Date('2025-03-14T12:00:00').getTime();
    let countdownInterval = null;

    function updateCountdown() {
        const now = new Date().getTime();
        const timeLeft = endDate - now;

        if (timeLeft <= 0) {
            clearInterval(countdownInterval);
            document.getElementById('countdown').innerHTML = 'Обратный отсчет завершен!';
            return;
        }

        const days = Math.floor(timeLeft / (1000 * 60 * 60 * 24));
        const hours = Math.floor((timeLeft % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
        const minutes = Math.floor((timeLeft % (1000 * 60 * 60)) / (1000 * 60));
        const seconds = Math.floor((timeLeft % (1000 * 60)) / 1000);

        document.getElementById('days').textContent = days;
        document.getElementById('hours').textContent = hours;
        document.getElementById('minutes').textContent = minutes;
        document.getElementById('seconds').textContent = seconds;
    }

    updateCountdown();
    countdownInterval = setInterval(updateCountdown, 1000);
});
