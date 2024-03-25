@extends('layouts.app')
@section('title', 'Reports')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12 d-flex justify-content-between">
                <div><h2 class="title">Reports</h2></div>
            </div>
            <div class="col-lg-12 mb-3">
                <div class="box">
                    <canvas id="mixedChart" width="400" height="200"></canvas>
                </div>
            </div>
        </div>
    </div>
    
    <script>
        var labels = [
          @foreach ($result as $res)
              "{{ $res['created_at'] }}",
          @endforeach
        ];
        var barData1 = [              
          @foreach ($result as $res)
              "{{ $res['user_count'] }}",
          @endforeach
        ];
        var barData2 = [
          @foreach ($result as $res)
              "{{ $res['admin_count'] }}",
          @endforeach
        ];

        // Create a mixed chart
        var ctx = document.getElementById('mixedChart').getContext('2d');
        var mixedChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: labels,
                datasets: [
                    {
                        label: 'Users',
                        data: barData1,
                        backgroundColor: 'rgba(75, 192, 192, 0.2)',
                        borderColor: 'rgba(75, 192, 192, 1)',
                        borderWidth: 1
                    },
                    {
                        label: 'Admins',
                        data: barData2,
                        backgroundColor: 'rgba(255, 99, 132, 0.2)',
                        borderColor: 'rgba(255, 99, 132, 1)',
                        borderWidth: 1
                    },
                ]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });

    </script>
@endsection