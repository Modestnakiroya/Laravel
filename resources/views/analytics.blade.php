@extends('layouts.app', ['activePage' => 'analytics', 'title' => 'Light Bootstrap Dashboard Laravel by Creative Tim & UPDIVISION', 'navName' => 'analytics', 'activeButton' => 'laravel'])

@section('content')
<style>
    body {
        background-image: url('image/back.jpg'); 
        background-size: cover;
        background-position: center;
        background-attachment: fixed;
        font-family: 'Roboto', sans-serif;
        color: #333;
    }
     .content {
        /*background-color: rgba(255, 255, 255, 0.9);*/
        min-height: 100vh;
        padding: 20px;
        border-radius: 10px;
        box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
    }
    .chart-container {
        position: relative;
        height: 300px;
        width: 100%;
    }
    .card {
        margin-bottom: 20px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        border-radius: 10px;
        overflow: hidden;
        transition: transform 0.3s ease-in-out;
    }
    .card:hover {
        transform: translateY(-5px);
    }
    .card-header {
        background-color: #4e73df;
        border-bottom: 1px solid #e3e6f0;
        padding: 15px;
    }
    .card-title {
        margin-bottom: 0;
        color: #ffffff;
        font-weight: 600;
    }
    .card-body {
        padding: 20px;
    }
    ul, ol {
        padding-left: 20px;
        margin-bottom: 0;
    }
    li {
        margin-bottom: 5px;
    }
    .dashboard-title {
        text-align: center;
        color: #4e73df;
        margin-bottom: 30px;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 2px;
    }
</style>
<div class="content">
    <div class="container-fluid">
        
        <div class="row">
            <!-- Placeholder for best performing schools -->
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Best performing schools for all challenges</h4>
                    </div>
                    <div class="card-body">
                        <ol>
                            @foreach($bestPerformingSchools as $school)
                                <li>{{ $school->name }} (Total Score: {{ $school->total_score }})</li>
                            @endforeach
                        </ol>
                    </div>
                </div>
            </div>

            <!-- List of pupils with incomplete challenges -->
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Pupils with incomplete challenges</h4>
                    </div>
                    <div class="card-body">
                        <ul>
                            @foreach($incompleteChallengePupils as $pupil)
                                <li>{{ $pupil->username }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <!-- List of worst performing schools for a given challenge -->
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Worst performing schools for challenge CH001</h4>
                    </div>
                    <div class="card-body">
                        <ol>
                            @foreach($worstPerformingSchools as $school)
                                <li>{{ $school->name }} (Total Score: {{ $school->total_score }})</li>
                            @endforeach
                        </ol>
                    </div>
                </div>
            </div>

            <!-- Pie chart for repetition -->
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Percentage of repetition of questions across attempts</h4>
                    </div>
                    <div class="card-body">
                        <div class="chart-container">
                            <canvas id="repetitionChart"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <!-- Bar graph of school rankings -->
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">School rankings</h4>
                    </div>
                    <div class="card-body">
                        <div class="chart-container">
                            <canvas id="rankingChart"></canvas>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Line graph showing the performance of schools over the years -->
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Performance of schools over the years</h4>
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
</div>
@endsection

@push('js')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script type="text/javascript">
    // Add the color palette here
    var colorPalette = [
        'rgb(255, 99, 132)', 'rgb(54, 162, 235)', 'rgb(255, 206, 86)', 
        'rgb(75, 192, 192)', 'rgb(153, 102, 255)', 'rgb(255, 159, 64)',
        'rgb(199, 199, 199)', 'rgb(83, 102, 255)', 'rgb(40, 159, 183)',
        'rgb(210, 105, 30)', 'rgb(128, 0, 128)', 'rgb(0, 128, 0)'
    ];

    $(document).ready(function() {
        // Pie chart for repetition
        var ctxRepetition = document.getElementById('repetitionChart').getContext('2d');
        var repetitionChart = new Chart(ctxRepetition, {
            type: 'doughnut',
            data: {
                labels: ['Attempt 1', 'Attempt 2', 'Attempt 3'],
                datasets: [{
                    data: [30, 20, 50],
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.8)',
                        'rgba(54, 162, 235, 0.8)',
                        'rgba(255, 206, 86, 0.8)'
                    ],
                    borderColor: [
                        'rgba(255, 99, 132, 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: 'bottom',
                        labels: {
                            font: {
                                size: 14
                            }
                        }
                    },
                    title: {
                        display: true,
                        text: 'Question Repetition Across Attempts',
                        font: {
                            size: 18
                        }
                    },
                    tooltip: {
                        callbacks: {
                            label: function(context) {
                                var label = context.label || '';
                                var value = context.parsed || 0;
                                var total = context.dataset.data.reduce((a, b) => a + b, 0);
                                var percentage = Math.round((value / total) * 100);
                                return `${label}: ${percentage}% (${value})`;
                            }
                        }
                    }
                },
                cutout: '50%'
            }
        });

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

        var datasets = Object.entries(schoolPerformanceData).map(([schoolName, data], index) => {
            var colorIndex = index % colorPalette.length;
            return {
                label: schoolName,
                data: years.map(year => {
                    var yearData = data.find(d => d.year == year);
                    return yearData ? yearData.average_score : null;
                }),
                fill: false,
                borderColor: colorPalette[colorIndex],
                tension: 0.1
            };
        });

        var ctxPerformance = document.getElementById('performanceChart').getContext('2d');
        var performanceChart = new Chart(ctxPerformance, {
            type: 'line',
            data: {
                labels: years,
                datasets: datasets
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

        if (typeof demo !== 'undefined' && typeof demo.showNotification === 'function') {
            demo.showNotification();
        }
    });
</script>
@endpush