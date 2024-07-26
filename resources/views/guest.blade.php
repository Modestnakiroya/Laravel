<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MATHEMATICS CHALLENGE</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <style>
        body {
            background-image: url('image/back.jpg');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            background-attachment: fixed;
            font-family: 'Arial', sans-serif;
        }
        .custom-font {
            font-family: 'Algerian', sans-serif;
            font-size: 2.5rem;
            text-align: left;
        }
        .card {
            background-color: rgba(248, 249, 250, 0.9);
            margin-bottom: 20px;
            border-radius: 15px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }
        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.15);
        }
        .card-title {
            font-size: 1.25rem;
            color: #333;
            font-weight: bold;
        }
        .card-header {
            background-color: rgba(0, 123, 255, 0.1);
            border-bottom: 1px solid rgba(0, 123, 255, 0.2);
        }
        .list-group-item {
            background-color: rgba(255, 255, 255, 0.8);
            border: none;
            margin-bottom: 5px;
            border-radius: 5px;
        }
        .chart-container {
            position: relative;
            height: 50vh;
            width: 100%;
        }
    </style>
</head>
<body>
    <div class="container mt-5">
        <h1 class="text-center mb-5 custom-font text-white">MATHEMATICS CHALLENGE</h1>
        <div class="row">
            <!-- Left side with top students -->
            <div class="col-md-3">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title"><i class="fas fa-plus-circle mr-2"></i>Top 3 in Addition (CH001)</h4>
                    </div>
                    <div class="card-body">
                        <ul class="list-group">
                            @foreach($topStudentsAddition as $index => $student)
                                <li class="list-group-item">
                                    <span class="badge badge-primary mr-2">{{ $index + 1 }}</span>
                                    {{ $student->username }} 
                                    <span class="float-right badge badge-success">Score: {{ $student->score }}</span>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title"><i class="fas fa-minus-circle mr-2"></i>Top 3 in Subtraction (CH002)</h4>
                    </div>
                    <div class="card-body">
                        <ul class="list-group">
                            @foreach($topStudentsSubtraction as $index => $student)
                                <li class="list-group-item">
                                    <span class="badge badge-primary mr-2">{{ $index + 1 }}</span>
                                    {{ $student->username }}
                                    <span class="float-right badge badge-success">Score: {{ $student->score }}</span>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
            <!-- Right side with charts -->
            <div class="col-md-9">
                <div class="card mb-4">
                    <div class="card-header">
                        <h4 class="card-title"><i class="fas fa-chart-bar mr-2"></i>School Rankings</h4>
                    </div>
                    <div class="card-body">
                        <div class="chart-container">
                            <canvas id="rankingChart"></canvas>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title"><i class="fas fa-chart-line mr-2"></i>Performance of Schools Over the Years</h4>
                    </div>
                    <div class="card-body">
                        <div class="chart-container">
                            <canvas id="performanceChart"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        var colorPalette = [
            'rgb(255, 99, 132)', 'rgb(54, 162, 235)', 'rgb(255, 206, 86)', 
            'rgb(75, 192, 192)', 'rgb(153, 102, 255)', 'rgb(255, 159, 64)',
            'rgb(199, 199, 199)', 'rgb(83, 102, 255)', 'rgb(40, 159, 183)',
            'rgb(210, 105, 30)', 'rgb(128, 0, 128)', 'rgb(0, 128, 0)'
        ];

        document.addEventListener('DOMContentLoaded', function() {
            var schoolRankings = @json($schoolRankings);
            console.log(schoolRankings);
            var labels = schoolRankings.map(function(school) {
                return school.name;
            });
            var data = schoolRankings.map(function(school) {
                return school.count;
            });

            var ctxRanking = document.getElementById('rankingChart').getContext('2d');
            var rankingChart = new Chart(ctxRanking, {
                type: 'bar',
                data: {
                    labels: labels,
                    datasets: [{
                        label: 'Number of Pupils Scoring 15 and Above',
                        data: data,
                        backgroundColor: 'rgba(54, 162, 235, 0.6)',
                        borderColor: 'rgba(54, 162, 235, 1)',
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    scales: {
                        y: {
                            beginAtZero: true,
                            title: {
                                display: true,
                                text: 'Number of Pupils'
                            }
                        },
                        x: {
                            title: {
                                display: true,
                                text: 'School Name'
                            },
                            ticks: {
                                autoSkip: false,
                                maxRotation: 90,
                                minRotation: 90
                            }
                        }
                    },
                    plugins: {
                        legend: {
                            display: true,
                            position: 'top'
                        },
                        title: {
                            display: true,
                            text: 'School Rankings by Number of Pupils Scoring 15 and Above'
                        }
                    }
                }
            });

            var schoolPerformanceData = @json($schoolPerformanceOverYears);
            var years = @json($years);

            var ctxPerformance = document.getElementById('performanceChart').getContext('2d');
            var performanceChart = new Chart(ctxPerformance, {
                type: 'line',
                data: {
                    labels: years,
                    datasets: Object.entries(schoolPerformanceData).map(([schoolName, data], index) => ({
                        label: schoolName,
                        data: years.map(year => {
                            var yearData = data.find(d => d.year == year);
                            return yearData ? yearData.average_score : null;
                        }),
                        fill: false,
                        borderColor: colorPalette[index % colorPalette.length],
                        tension: 0.1
                    }))
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            position: 'bottom'
                        },
                        title: {
                            display: true,
                            text: 'School Performance Over Years'
                        }
                    },
                    scales: {
                        y: {
                            beginAtZero: true,
                            title: {
                                display: true,
                                text: 'Average Score'
                            }
                        },
                        x: {
                            title: {
                                display: true,
                                text: 'Year'
                            }
                        }
                    }
                }
            });
        });
    </script>
</body>
</html>