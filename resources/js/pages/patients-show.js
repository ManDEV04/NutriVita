/**
 * ==========================================================
 * PATIENTS SHOW
 * Gráfica de evolución de peso (Chart.js). Lee los datos que
 * la vista inyecta en `window.patientShowData` — ver
 * resources/views/patients/show.blade.php, sección @section('js').
 * ==========================================================
 */

document.addEventListener('DOMContentLoaded', function () {

    const canvas = document.getElementById('weightChart');
    const data = window.patientShowData;

    if (!canvas || !data || typeof Chart === 'undefined') {
        return;
    }

    const ctx = canvas.getContext('2d');

    const gradient = ctx.createLinearGradient(0, 0, 0, 310);
    gradient.addColorStop(0, 'rgba(159, 199, 153, .25)');
    gradient.addColorStop(1, 'rgba(159, 199, 153, 0)');

    new Chart(canvas, {
        type: 'line',
        data: {
            labels: data.weightLabels,
            datasets: [{
                label: 'Peso',
                data: data.weightData,
                borderColor: '#9fc799',
                backgroundColor: gradient,
                borderWidth: 2,
                fill: true,
                tension: .42,
                pointRadius: 4,
                pointHoverRadius: 6,
                pointBackgroundColor: '#afd3a5',
                pointBorderColor: '#17301f',
                pointBorderWidth: 2,
            }],
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            interaction: { intersect: false, mode: 'index' },
            plugins: {
                legend: { display: false },
                tooltip: {
                    backgroundColor: 'rgba(12, 31, 20, .96)',
                    borderColor: 'rgba(255,255,255,.10)',
                    borderWidth: 1,
                    padding: 10,
                    displayColors: false,
                    callbacks: {
                        label: (context) => 'Peso: ' + context.parsed.y + ' kg',
                    },
                },
            },
            scales: {
                y: {
                    beginAtZero: false,
                    border: { display: false },
                    grid: { color: 'rgba(255,255,255,.045)' },
                    ticks: {
                        color: 'rgba(211,229,215,.36)',
                        font: { size: 8 },
                        callback: (value) => value + ' kg',
                    },
                },
                x: {
                    border: { display: false },
                    grid: { display: false },
                    ticks: {
                        color: 'rgba(211,229,215,.36)',
                        font: { size: 8 },
                    },
                },
            },
        },
    });

});
