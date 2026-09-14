/**
 * ==========================================================
 * PROGRESS SHOW
 * Gráficas de evolución de peso y composición corporal.
 * Lee los datos que la vista inyecta en `window.progressShowData`
 * — ver resources/views/progress/show.blade.php.
 * ==========================================================
 */

document.addEventListener('DOMContentLoaded', function () {

    const data = window.progressShowData;

    if (!data || typeof Chart === 'undefined') {
        return;
    }

    const { labels, weights, bodyFat, muscleMass } = data;

    const chartOptions = {
        responsive: true,
        maintainAspectRatio: false,
        plugins: {
            legend: {
                labels: { color: 'rgba(225,240,228,.65)' },
            },
        },
        scales: {
            x: {
                ticks: { color: 'rgba(220,235,223,.40)' },
                grid: { color: 'rgba(255,255,255,.04)' },
            },
            y: {
                ticks: { color: 'rgba(220,235,223,.40)' },
                grid: { color: 'rgba(255,255,255,.05)' },
            },
        },
    };

    /* Peso */
    new Chart(document.getElementById('weightChart'), {
        type: 'line',
        data: {
            labels: labels,
            datasets: [{
                label: 'Peso (kg)',
                data: weights,
                borderColor: '#a7ca9d',
                backgroundColor: 'rgba(167,202,157,.12)',
                fill: true,
                tension: .35,
            }],
        },
        options: chartOptions,
    });

    /* Composición corporal */
    new Chart(document.getElementById('compositionChart'), {
        type: 'line',
        data: {
            labels: labels,
            datasets: [
                {
                    label: 'Grasa (%)',
                    data: bodyFat,
                    borderColor: '#d7bd70',
                    tension: .35,
                },
                {
                    label: 'Masa muscular (kg)',
                    data: muscleMass,
                    borderColor: '#87beb0',
                    tension: .35,
                },
            ],
        },
        options: chartOptions,
    });

});
