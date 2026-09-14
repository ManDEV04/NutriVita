/**
 * ==========================================================
 * NUTRIADMIN — DASHBOARD CHARTS
 * Lee los datos inyectados por la vista en `window.dashboardData`
 * (ver resources/views/dashboard/index.blade.php, sección @section('js'))
 * y construye las 4 gráficas con Chart.js.
 * ==========================================================
 */

document.addEventListener('DOMContentLoaded', function () {

    const data = window.dashboardData;

    if (!data || typeof Chart === 'undefined') {
        return;
    }

    /* ---------------------------------------------------------
       COLORES GENERALES
    --------------------------------------------------------- */
    const gridColor = 'rgba(255,255,255,0.045)';
    const labelColor = 'rgba(216,234,220,0.38)';
    const green = '#9fc99a';

    Chart.defaults.color = labelColor;
    Chart.defaults.font.family = 'Poppins';

    const tooltipBase = {
        backgroundColor: 'rgba(16,37,26,.95)',
        borderColor: 'rgba(255,255,255,.10)',
        borderWidth: 1,
        padding: 9,
    };

    const hiddenAxisLine = { display: false };


    /* ---------------------------------------------------------
       1) PACIENTES — CRECIMIENTO (línea)
    --------------------------------------------------------- */
    const patientsCanvas = document.getElementById('patientsGrowthChart');

    if (patientsCanvas && data.patients) {
        const ctx = patientsCanvas.getContext('2d');

        const gradient = ctx.createLinearGradient(0, 0, 0, 280);
        gradient.addColorStop(0, 'rgba(159,201,154,.28)');
        gradient.addColorStop(1, 'rgba(159,201,154,0)');

        new Chart(patientsCanvas, {
            type: 'line',
            data: {
                labels: data.patients.labels,
                datasets: [{
                    data: data.patients.data,
                    borderColor: green,
                    backgroundColor: gradient,
                    fill: true,
                    borderWidth: 2,
                    tension: .42,
                    pointRadius: 0,
                    pointHoverRadius: 5,
                    pointHoverBackgroundColor: green,
                    pointHoverBorderColor: '#13251a',
                    pointHoverBorderWidth: 3,
                }],
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                interaction: { intersect: false, mode: 'index' },
                plugins: {
                    legend: { display: false },
                    tooltip: { ...tooltipBase, padding: 10, displayColors: false },
                },
                scales: {
                    x: {
                        border: hiddenAxisLine,
                        grid: { display: false },
                        ticks: { color: labelColor, font: { size: 9 } },
                    },
                    y: {
                        beginAtZero: true,
                        border: hiddenAxisLine,
                        grid: { color: gridColor },
                        ticks: { color: labelColor, precision: 0, font: { size: 8 } },
                    },
                },
            },
        });
    }


    /* ---------------------------------------------------------
       2) PACIENTES — ACTIVOS / INACTIVOS (dona)
    --------------------------------------------------------- */
    const statusCanvas = document.getElementById('patientStatusChart');

    if (statusCanvas && data.patientStatus) {
        new Chart(statusCanvas, {
            type: 'doughnut',
            data: {
                labels: ['Activos', 'Inactivos'],
                datasets: [{
                    data: [data.patientStatus.active, data.patientStatus.inactive],
                    backgroundColor: ['#9fc99a', '#405849'],
                    borderColor: ['rgba(255,255,255,.06)', 'rgba(255,255,255,.04)'],
                    borderWidth: 1,
                    hoverOffset: 4,
                }],
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                cutout: '77%',
                plugins: {
                    legend: { display: false },
                    tooltip: tooltipBase,
                },
            },
        });
    }


    /* ---------------------------------------------------------
       3) CITAS DE LA SEMANA (barras)
    --------------------------------------------------------- */
    const appointmentsCanvas = document.getElementById('appointmentsChart');

    if (appointmentsCanvas && data.appointments) {
        new Chart(appointmentsCanvas, {
            type: 'bar',
            data: {
                labels: data.appointments.labels,
                datasets: [{
                    data: data.appointments.data,
                    backgroundColor: 'rgba(157,196,147,.55)',
                    hoverBackgroundColor: '#a9cc9f',
                    borderRadius: 8,
                    borderSkipped: false,
                    barThickness: 17,
                }],
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: { display: false },
                    tooltip: { backgroundColor: 'rgba(16,37,26,.95)', displayColors: false },
                },
                scales: {
                    x: {
                        border: hiddenAxisLine,
                        grid: { display: false },
                        ticks: { color: labelColor, font: { size: 8 } },
                    },
                    y: {
                        beginAtZero: true,
                        border: hiddenAxisLine,
                        grid: { color: gridColor },
                        ticks: { precision: 0, color: labelColor, font: { size: 8 } },
                    },
                },
            },
        });
    }


    /* ---------------------------------------------------------
       4) INGRESOS MENSUALES (línea de área)
    --------------------------------------------------------- */
    const incomeCanvas = document.getElementById('incomeChart');

    if (incomeCanvas && data.income) {
        const ctx = incomeCanvas.getContext('2d');

        const incomeGradient = ctx.createLinearGradient(0, 0, 0, 250);
        incomeGradient.addColorStop(0, 'rgba(213,194,126,.25)');
        incomeGradient.addColorStop(1, 'rgba(213,194,126,0)');

        new Chart(incomeCanvas, {
            type: 'line',
            data: {
                labels: data.income.labels,
                datasets: [{
                    data: data.income.data,
                    borderColor: '#d5c27e',
                    backgroundColor: incomeGradient,
                    fill: true,
                    borderWidth: 2,
                    tension: .42,
                    pointRadius: 0,
                    pointHoverRadius: 4,
                }],
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: { display: false },
                    tooltip: {
                        backgroundColor: 'rgba(16,37,26,.95)',
                        displayColors: false,
                        callbacks: {
                            label: (context) => '$' + Number(context.raw).toLocaleString('es-MX'),
                        },
                    },
                },
                scales: {
                    x: {
                        border: hiddenAxisLine,
                        grid: { display: false },
                        ticks: { color: labelColor, font: { size: 8 } },
                    },
                    y: {
                        beginAtZero: true,
                        border: hiddenAxisLine,
                        grid: { color: gridColor },
                        ticks: {
                            color: labelColor,
                            font: { size: 8 },
                            callback: (value) => '$' + value,
                        },
                    },
                },
            },
        });
    }

});
