@extends('layouts.admin')

@section('content')
    <div class="container mt-3">
        <div class="row">
            <h1 class="mb-5"> Ciao {{ $user->name }}</h1>


            <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

            <div class="col-6 mb-5">
                <h3 class="text-center">VOTI ULTIMO MESE</h3>
                <canvas id="monthlyVote"></canvas>
            </div>
    
            <script>
                const monthlyVote = document.getElementById('monthlyVote');
    
                new Chart(monthlyVote, {
                    type: 'bar',
                    data: {
                    labels: ['1', '2', '3', '4', '5'],
                    datasets: [{
                        label: 'Numero di voti',
                        data: [{{ $lastMonthVotes['oneStar'] }}, {{ $lastMonthVotes['twoStar'] }},{{ $lastMonthVotes['threeStar'] }},{{ $lastMonthVotes['fourStar'] }},{{ $lastMonthVotes['fiveStar'] }},],
                        borderWidth: 1
                    }]
                    },
                    options: {
                    scales: {
                        y: {
                        beginAtZero: true,
                        ticks: {
                            stepSize: 1
                        }
                        }
                    }
                    }
                });
            </script>
    
            <div class="col-6 mb-5">
                <h3 class="text-center">VOTI ULTIMO ANNO</h3>
                <canvas id="yearlyVote"></canvas>
            </div>
    
    
            <script>
                const yearlyVote = document.getElementById('yearlyVote');
    
                new Chart(yearlyVote, {
                    type: 'bar',
                    data: {
                    labels: ['1', '2', '3', '4', '5'],
                    datasets: [{
                        label: 'Numero di voti',
                        data: [{{ $lastYearVotes['oneStar'] }}, {{ $lastYearVotes['twoStar'] }},{{ $lastYearVotes['threeStar'] }},{{ $lastYearVotes['fourStar'] }},{{ $lastYearVotes['fiveStar'] }},],
                        borderWidth: 1
                    }]
                    },
                    options: {
                    scales: {
                        y: {
                        beginAtZero: true,
                        ticks: {
                            stepSize: 1
                        }
                        }
                    }
                    }
                });
            </script>

            <div class="col-6 mb-5">
                <h3 class="text-center">RECENSIONI RICEVUTE</h3>
                <canvas id="reviewsChart"></canvas>
            </div>

            <script>
                const reviewsChart = document.getElementById('reviewsChart');

                new Chart(reviewsChart, {
                    type: 'bar',
                    data: {
                    labels: ['ULTIMO MESE', 'ULTIMO ANNO'],
                    datasets: [{
                        label: 'Numero di recensioni',
                        data: [{{ $lastMonthReviews }}, {{ $lastYearReviews }}],
                        borderWidth: 1
                    }]
                    },
                    options: {
                    scales: {
                        y: {
                        beginAtZero: true,
                        ticks: {
                            stepSize: 1
                        }
                        }
                    }
                    }
                });
            </script>

            <div class="col-6 mb-5">
                <h3 class="text-center">NUMERO MESSAGGI RICEVUTI</h3>
                <canvas id="messagesChart"></canvas>
            </div>

            <script>
                const messagesChart = document.getElementById('messagesChart');

                new Chart(messagesChart, {
                    type: 'bar',
                    data: {
                    labels: ['ULTIMO MESE', 'ULTIMO ANNO'],
                    datasets: [{
                        label: 'Numero di messaggi',
                        data: [{{ $lastMonthMessages }}, {{ $lastYearMessages }}],
                        borderWidth: 1
                    }]
                    },
                    options: {
                    scales: {
                        y: {
                        beginAtZero: true,
                        ticks: {
                            stepSize: 1
                        }
                        }
                    }
                    }
                });
            </script>


        </div>

        
    </div>
@endsection