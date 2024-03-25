@extends('layouts.app')
@section('title', 'Dashboard')

@section('content')
<div class="container-fluid">
    <div class="row g-2">
        <div class="col-lg-12 d-flex justify-content-between">
            <div><h2 class="title">Dashboard</h2></div>
        </div>
        <div class="col-lg-12">
            <div class="row g-2">
                <div class="col-sm-6 col-lg-6">
                    <div class="tile tile-primary">
                        <div class="tile-heading">Total Users</div>
                        <div class="tile-body">
                            <i class="fa-solid fa-users"></i>
                            <h2 class="float-end">{{ $countUsers }}</h2>
                        </div>
                        <div class="tile-footer"><a href="{{ route('users.index') }}">View more...</a></div>
                    </div>
                </div>
                <div class="col-sm-6 col-lg-6">
                    <div class="tile tile-primary">
                        <div class="tile-heading">Total Admins</div>
                        <div class="tile-body">
                            <i class="fa-solid fa-users"></i>
                            <h2 class="float-end">{{ $countAdmins }}</h2>
                        </div>
                        <div class="tile-footer"><a href="{{ route('admins.index') }}">View more...</a></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-12">
            <div class="box">
                <div class="row g-2">
                    <div class="col-lg-12">
                        <div class="div d-flex justify-content-between align-items-center">
                            <h5>Latest Users</h5>
                            <a href="{{ route('users.index') }}">see more</a>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead class="table-light">
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Date</th>
                                    <th>Actions</th>
                                </thead>
                                <tbody>
                                    @foreach ($latestUsers as $user)
                                        <tr>
                                            <td>{{ $user->id }}</td>
                                            <td>{{ $user->first_name .' '. $user->last_name }}</td>
                                            <td>{{ $user->email }}</td>
                                            <td>{{ \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $user->created_at)->format('F d, Y h:i A') }}</td>
                                            <td>
                                                <div class="d-flex">
                                                    <div class="action-button"><a href="{{ route('users.view', $user->id) }}" title="View"><i class="fa-solid fa-eye"></i></a></div>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-6 col-12 mb-3">
            <div class="box">
                <canvas id="mixedChart" width="400" height="200"></canvas>
            </div>
        </div>
        <div class="col-lg-6 col-12 mb-3">
            <div class="box">
                <canvas id="mixedChart2" width="400" height="200"></canvas>
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

    var ctx2 = document.getElementById('mixedChart2').getContext('2d');
    var mixedChart2 = new Chart(ctx2, {
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