<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Administrateur avec Chart.js</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        .container {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
        }
        .chart-container {
            width: 45%;
            height: 45%;
            margin: 2%;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="chart-container">
            <canvas id="bubbleChart"></canvas>
        </div>
        <div class="chart-container">
            <canvas id="stackedBarChart"></canvas>
        </div>
        <div class="chart-container">
            <canvas id="polarAreaChart"></canvas>
        </div>
        <div class="chart-container">
            <canvas id="multiDatasetDoughnutChart"></canvas>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var ctxBubble = document.getElementById('bubbleChart').getContext('2d');
            var ctxStackedBar = document.getElementById('stackedBarChart').getContext('2d');
            var ctxPolarArea = document.getElementById('polarAreaChart').getContext('2d');
            var ctxMultiDatasetDoughnut = document.getElementById('multiDatasetDoughnutChart').getContext('2d');

            var bubbleChart = new Chart(ctxBubble, {
                type: 'bubble',
                data: {
                    datasets: [{
                        label: 'Exemple de données',
                        data: [
                            {x: 10, y: 20, r: 5},
                            {x: 15, y: 10, r: 10},
                            {x: 25, y: 30, r: 8},
                            {x: 30, y: 15, r: 6}
                        ],
                        backgroundColor: '#1e52a8'
                    }]
                }
            });

            var stackedBarChart = new Chart(ctxStackedBar, {
                type: 'bar',
                data: {
                    labels: ['Jan', 'Fev', 'Mar', 'Avr', 'Mai', 'Juin'],
                    datasets: [{
                        label: 'Exemple de données 1',
                        data: [12, 19, 3, 5, 2, 3],
                        backgroundColor: '#1e52a8'
                    }, {
                        label: 'Exemple de données 2',
                        data: [5, 10, 15, 20, 8, 12],
                        backgroundColor: '#a8b0c7'
                    }]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true,
                            stacked: true
                        },
                        x: {
                            stacked: true
                        }
                    }
                }
            });

            var polarAreaChart = new Chart(ctxPolarArea, {
                type: 'polarArea',
                data: {
                    labels: ['A', 'B', 'C', 'D', 'E'],
                    datasets: [{
                        data: [12, 19, 3, 5, 2],
                        backgroundColor: [
                            '#1e52a8',
                            '#a8b0c7',
                            '#4a72c1',
                            '#2d53a2',
                            '#173884'
                        ]
                    }]
                }
            });

            var multiDatasetDoughnutChart = new Chart(ctxMultiDatasetDoughnut, {
                type: 'doughnut',
                data: {
                    labels: ['A', 'B', 'C', 'D', 'E'],
                    datasets: [{
                        data: [12, 19, 3, 5, 2],
                        backgroundColor: [
                            '#1e52a8',
                            '#a8b0c7',
                            '#4a72c1',
                            '#2d53a2',
                            '#173884'
                        ]
                    }, {
                        data: [5, 10, 15, 8, 12],
                        backgroundColor: [
                            '#a8b0c7',
                            '#4a72c1',
                            '#2d53a2',
                            '#173884',
                            '#1e52a8'
                        ]
                    }]
                }
           
            });

});

</script>
</body>
</html><?php /**PATH C:\xampp\htdocs\InsucranceFrontEnd\InsucranceFrontEnd\project\resources\views/DashboardAgent.blade.php ENDPATH**/ ?>