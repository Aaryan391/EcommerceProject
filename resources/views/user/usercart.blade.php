@extends('user.usermain')
@section('content')
<!-- Display Success or Error Message -->
@if(session('success'))
<div class="alert alert-success mt-1">
    {{ session('success') }}
</div>
@elseif(session('error'))
<div class="alert alert-danger mt-1">
    {{ session('error') }}
</div>
@endif
<style>
    body {
        background-color: lightslategray; /* Light gray background */
        color: #333333; /* Dark text color */
        font-family: 'Arial', sans-serif; /* Use your preferred font */
    }

    .alert {
        border-radius: 10px;
    }

    .table {
        background-color: #ffffff; /* White table background */
    }

    .table th,
    .table td {
        border: 1px solid #dddddd; /* Light gray border */
    }

    .table th {
        background-color: #007bff; /* Blue header background */
        color: #ffffff; /* White header text color */
    }

    .table td {
        background-color: #ffffff; /* White cell background */
    }

    .img-thumbnail {
        max-width: 200px;
        border-radius: 10px;
    }

    .btn-primary {
        background-color: #28a745; /* Green button background */
        border-color: #28a745;
    }

    .btn-primary:hover {
        background-color: #218838; /* Slightly darker green for hover effect */
        border-color: #218838;
    }

    .btn-danger {
        background-color: #dc3545; /* Red button background */
        border-color: #dc3545;
    }

    .btn-danger:hover {
        background-color: #c82333; /* Slightly darker red for hover effect */
        border-color: #c82333;
    }

    .btn-primary,
    .btn-danger {
        color: #ffffff; /* White text color for buttons */
    }

    .text-muted {
        color: #6c757d; /* Gray text color for muted text */
    }

    .container {
        margin-top: 30px;
    }

    .text-right {
        text-align: right;
    }
</style>
@if(auth()->user())
    @if($cartitems->isEmpty())
        <div class="alert alert-info">Your cart is empty.</div>
    @else
        <div class="table-responsive mt-2">
            <table class="table table-bordered table-striped">
                <thead class="thead-dark">
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Product Image</th>
                        <th scope="col">Product Name</th>
                        <th scope="col">Quantity</th>
                        <th scope="col">Unit Price(NPR)</th>
                        <th scope="col">Total Price(NPR)</th>
                        <th scope="col">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($cartitems as $key => $cartItem)
                        <tr>
                            <th scope="row">{{ $key + 1 }}</th>
                            <td>
                                <img src="{{ asset('storage/' . $cartItem->product->product_image) }}" alt="" class="img-thumbnail">
                            </td>
                            <td>{{ $cartItem->product->product_name }}</td>
                            <td>
                                <form action="{{ route('cart.update', ['cartItem' => $cartItem->id]) }}" method="post">
                                    @csrf
                                    @method('PUT')
                                    <div class="input-group">
                                        <input type="number" name="quantity" value="{{ $cartItem->quantity }}" class="form-control" min="1">
                                        <div class="input-group-append">
                                            <button type="submit" class="btn btn-primary btn-sm">Update</button>
                                        </div>
                                    </div>
                                </form>
                            </td>
                            <td>{{ $cartItem->unit_price }}</td>
                            <td>{{ $cartItem->quantity * $cartItem->unit_price }}</td>
                            <td>
                                <form action="{{ route('cart.remove', ['cartItem' => $cartItem->id]) }}" method="post">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm">Remove</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="text-right mt-3">
            <a href="{{ route('checkout') }}" class="btn btn-primary">Proceed to Checkout</a>
        </div>
    @endif
@else
    <div class="alert alert-danger">Login into view cart.</div>
@endif
@endsection
