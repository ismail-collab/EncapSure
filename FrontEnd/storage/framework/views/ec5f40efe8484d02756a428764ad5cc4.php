<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Exemple de Dashboard avec Chart.js</title>
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
            <canvas id="lineChart"></canvas>
        </div>
        <div class="chart-container">
            <canvas id="barChart"></canvas>
        </div>
        <div class="chart-container">
            <canvas id="radarChart"></canvas>
        </div>
        <div class="chart-container">
            <canvas id="pieChart"></canvas>
        </div>



    </div>

    <script>

        document.addEventListener('DOMContentLoaded', function () {

            var ctxLine = document.getElementById('lineChart').getContext('2d');
            var ctxBar = document.getElementById('barChart').getContext('2d');
            var ctxRadar = document.getElementById('radarChart').getContext('2d');
            var ctxPie = document.getElementById('pieChart').getContext('2d');








            var lineChart = new Chart(ctxLine, {
                type: 'line',
                data: {
                    labels: ['Jan', 'Fev', 'Mar', 'Avr', 'Mai', 'Juin'],
                    datasets: [{
                        label: 'Exemple de données',
                        data: [12, 19, 3, 5, 2, 3],
                        borderColor: '#1e52a8',
                        backgroundColor: 'rgba(30, 82, 168, 0.1)'
                    }]
                }
            });





            var barChart = new Chart(ctxBar, {
                type: 'bar',
                data: {
                    labels: ['Jan', 'Fev', 'Mar', 'Avr', 'Mai', 'Juin'],
                    datasets: [{
                        label: 'Exemple de données',
                        data: [12, 19, 3, 5, 2, 3],
                        backgroundColor: '#1e52a8'
                    }]
                }
            });




            var radarChart = new Chart(ctxRadar, {
                type: 'radar',
                data: {
                    labels: ['A', 'B', 'C', 'D', 'E', 'F'],
                    datasets: [{
                        label: 'Exemple de données',
                        data: [12, 19, 3, 5, 2, 3],
                        borderColor: '#1e52a8',
                        backgroundColor: 'rgba(30, 82, 168, 0.1)'
                    }]
                }
            });




            var pieChart = new Chart(ctxPie, {
                type: 'pie',
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
        });



    </script>
</body>
</html><?php /**PATH C:\xampp\htdocs\InsucranceFrontEnd\InsucranceFrontEnd\project\resources\views/DashboardAdmin.blade.php ENDPATH**/ ?>