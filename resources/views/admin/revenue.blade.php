@extends('admin.layouts.adminmain')
@section('content')
<style>
    /* Add your CSS styles here */
    .card {
        margin-bottom: 20px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        border: 1px solid #ddd;
        border-radius: 8px;
        padding: 20px;
    }

    canvas {
        max-width: 100%;
    }
</style>

<div class="container mt-5">
    <h2>Revenue Report</h2>
    <div class="table-responsive">
        <table class="table table-striped table-bordered">
            <thead class="thead-dark">
                <tr>
                    <th>Username</th>
                    <th>Product Name</th>
                    <th>Quantity</th>
                    <th>Price(NPR)</th>
                    <th>Created At</th>
                </tr>
            </thead>
            <tbody>
                @php
                $totalRevenue = 0; // Initialize totalRevenue variable
                @endphp

                @foreach($revenues as $revenue)
                <tr>
                    <td>{{ $revenue->user_name }}</td>
                    <td>{{ $revenue->product_name }}</td>
                    <td>{{ $revenue->quantity }}</td>
                    <td>{{ number_format($revenue->price, 2) }}</td>
                    <td>{{ $revenue->created_at->format('Y-m-d H:i:s') }}</td>
                </tr>

                @php
                $totalRevenue += $revenue->price; // Calculate total revenue
                @endphp
                @endforeach
                <tr>
                    <td class="text-center" colspan="5">Total Revenue : {{ number_format($totalRevenue, 2) }}</td>
                </tr>
                <tr>
                    <td>
                        <form action="{{ route('revenue.clear') }}" method="get">
                            @csrf
                            <button type="submit" class="btn btn-danger">Clear Revenue Table</button>
                        </form>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
@endsection