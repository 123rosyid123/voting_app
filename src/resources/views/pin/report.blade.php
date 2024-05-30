@extends('layouts.dashboard')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card card-chart">
                <div class="card-header card-header-icon card-header-danger">
                    <div class="card-icon">
                        <i class="material-icons">bar_chart</i>
                    </div>
                    <h4 class="card-title">Report {{$pin->name}}, PIN {{$pin->pin}}, capacity : {{$pin->capacity}}</h4>
                </div>
                <div class="card-body">
                    <canvas id="myChart" width="400" height="400"></canvas>
                </div>
                <div class="card-footer">
                    <div class="stats">
                        total : {{$pin->voting()->count()}}
                    </div>
                    <div>
                        <a href="{{ route('pin.export', ['pin' => $pin->pin])}}" class="btn btn-primary">Download</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        function getRandomColor() {
            var r = Math.floor(Math.random() * 255);
            var g = Math.floor(Math.random() * 255);
            var b = Math.floor(Math.random() * 255);
            var a = 0.5; // Atur transparansi di sini
            return `rgba(${r}, ${g}, ${b}, ${a})`;
        }

        function generateRandomColors(count) {
            var colors = [];
            for (var i = 0; i < count; i++) {
                colors.push(getRandomColor());
            }
            return colors;
        }

        $(document).ready(function() {
            var ctx = $('#myChart')[0].getContext('2d');
            var labels = @json($result['candidate']);
            var data = @json($result['total']);
            var backgroundColors = generateRandomColors(data.length);
            var borderColors = backgroundColors.map(color => color.replace('0.2',
                '1')); // Ganti transparansi menjadi 1 untuk border

            var myChart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: labels,
                    datasets: [{
                        label: '# of Votes',
                        data: data,
                        backgroundColor: backgroundColors,
                        borderColor: borderColors,
                        borderWidth: 1
                    }]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true,
                            ticks: {
                                callback: function(value) {
                                    return Number.isInteger(value) ? value : null;
                                }
                            }

                        },
                    },
                    maintainAspectRatio: false,
                }
            });
        });
    </script>
@endsection
