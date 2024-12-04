@extends('admin.layouts.adminmain')
@section('content')
<?php
use App\Models\Revenue;
$revenues = Revenue::all();
$monthlyRevenue = $revenues->groupBy(function($date) {
    return \Carbon\Carbon::parse($date->created_at)->format('F Y');
});
$months = [];
$totalRevenue = [];
foreach ($monthlyRevenue as $month => $revenue) {
    $months[] = $month;
    $totalRevenue[] = $revenue->sum('price');
}
?>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<style>
    /* Custom CSS for responsiveness and styling */
    body{
        background-color: #495057;
    }
    .container {
        margin-top: 20px;
    }

    .card {
        transition: transform 0.3s;
        background-color: #f8f9fa; /* Light Gray Background */
        border: 1px solid #dee2e6; /* Light Gray Border */
        border-radius: 10px; /* Rounded Corners */
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1); /* Soft Shadow */
    }

    .card:hover {
        transform: scale(1.05);
        box-shadow: 0 8px 12px rgba(0, 0, 0, 0.2); /* Slightly Elevated Shadow on Hover */
    }

    .card-title {
        font-size: 1.5rem;
        font-weight: bold;
        color: #343a40; /* Dark Gray Text Color */
    }

    .card-text {
        font-size: 1.2rem;
        color: #495057; /* Dark Gray Text Color */
    }

    .card-chart {
        background-color: #ffffff; /* White Background */
        border: 1px solid #dee2e6; /* Light Gray Border */
        border-radius: 10px; /* Rounded Corners */
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1); /* Soft Shadow */
    }

    #currentMonthInfo {
        font-size: 1.1rem;
        color: #6c757d; /* Medium Gray Text Color */
    }
</style>
<div class="container mt-4">
    <div class="row">
        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Total Users</h5>
                    <p class="card-text">{{ $totalUsers }}</p>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Total Products</h5>
                    <p class="card-text">{{ $totalProducts }}</p>
                    <a href="/productview" class="btn btn-success">View Products</a>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Total Orders</h5>
                    <p class="card-text">{{ $totalOrders }}</p>
                    <a href="/orders" class="btn btn-info">View Orders</a>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="card mt-5 mb-5 card-chart">
    <div class="card-body">
        <canvas id="salesChart"></canvas>
        <div id="currentMonthInfo" class="mt-3">
            <strong>Current Month:</strong> {{ \Carbon\Carbon::now()->format('F Y') }}
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    var allMonths = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];
    var monthsWithData = JSON.parse('{!! json_encode($months)!!}');
    var totalRevenue = JSON.parse('{!! json_encode($totalRevenue)!!}');

    var monthlyRevenue = [];

    allMonths.forEach(function(month) {
        if (monthsWithData.includes(month)) {
            var index = monthsWithData.indexOf(month);
            monthlyRevenue.push(totalRevenue[index]);
        } else {
            monthlyRevenue.push(0);
        }
    });

    var ctx = document.getElementById('salesChart').getContext('2d');
    var salesChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: allMonths,
            datasets: [{
                label: 'Total Revenue',
                data: totalRevenue,
                backgroundColor: 'rgba(75, 192, 192, 0.2)',
                borderColor: 'rgba(75, 192, 192, 1)',
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });
});
</script>
@endsection
