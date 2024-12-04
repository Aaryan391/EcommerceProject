<!-- productdetail.blade.php -->
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
    .product-detail-container {
        padding: 20px;
        background-color: white; /* Light gray background */
        color: white; /* Dark gray text color */
    }

    .product-card {
        background-color: black; /* Lighter gray background */
        border: 2px solid black; /* Light gray border color */
        border-radius: 10px;
        overflow: hidden;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        color: white;
    }

    .product-image {
        border: 5px solid white; /* Light gray border color */
        width: 100%;
        height: auto;
        max-height: 300px;
        object-fit: contain;
    }

    .product-info {
        color: #333; /* Dark gray text color */
        padding: 20px;
        background-color: white; /* Light gray background color */
        border-radius: 0 0 10px 10px;
        border: 2px solid black;
    }

    .add-to-cart-form {
        margin-top: 20px;
        color: white;
    }

    /* Stylish Button */
    .btn-stylish {
        background-color: #ccc; /* Light gray background color */
        color: #333; /* Dark gray text color */
        border: none;
        border-radius: 5px;
        padding: 10px 20px;
        cursor: pointer;
    }

    .btn-stylish:hover {
        background-color: black; /* Slightly lighter gray on hover */
    }

    .card-text {
        color: #fff; /* White text color */
    }
</style>

<body>
<div class="container product-detail-container mt-4">
    <div class="row">
        <div class="col-md-6">
            <div class="card product-card">
                <img src="{{ asset('storage/' . $product->product_image) }}" alt="{{ $product->product_name }}" class="card-img-top product-image">
            </div>
        </div>
        <div class="col-md-6 product-info">
            <div class="card product-card">
                <div class="card-body">
                    <h2 class="card-title">{{ $product->product_name }}</h2>
                    <p class="card-text">Description: {{ $product->product_description }}</p>
                    <p class="card-text">Uniqueness: {{ $product->uniqueness }}</p>
                    <p class="card-text"><strong>Category:</strong> {{ $product->category->name }}</p>
                    <p class="card-text"><strong>Subcategory:</strong> {{ $product->subcategory->name }}</p>
                    <p class="card-text" >Price: NPR{{ $product->price }}</p>
                    <p class="card-text">Stock: {{ $product->stock }}</p>

                    <!-- Add to Cart Form -->
                    <form method="POST" action="{{ route('cart.add', $product->id) }}" class="add-to-cart-form">
                        @csrf
                        <div class="form-group">
                            <label for="quantity">Quantity:</label>
                            <input type="number" name="quantity" value="1" min="1" class="form-control">
                        </div>

                        <button type="submit" class="btn btn-stylish">Add to Cart</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
@endsection