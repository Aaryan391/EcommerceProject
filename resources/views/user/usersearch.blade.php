@extends('user.usermain')
@section('content')
<style>
    body{
        background-color: lightgrey;
    }
    .container {
        max-width: 1200px;
    }

    .card {
        transition: transform 0.3s;
        border: none;
        border-radius: 10px;
    }

    .card:hover {
        transform: scale(1.05);
        box-shadow: 0px 0px 20px rgba(0, 0, 0, 0.1);
    }

    .card-img-top {
        border-top-left-radius: 10px;
        border-top-right-radius: 10px;
        object-fit: cover;
        height: 200px;
    }

    .card-body {
        background-color: lightblue;
        border-bottom-left-radius: 10px;
        border-bottom-right-radius: 10px;
    }

    .card-title {
        font-size: 1.2rem;
        margin-bottom: 10px;
    }

    .btn-primary {
        background-color: #007bff;
        border-color: #007bff;
    }

    .btn-primary:hover {
        background-color: #0056b3;
        border-color: #0056b3;
    }
</style>

<div class="container mt-4">
    <h3 class="text-center mb-4"><u>Searched Products</u></h3>
    <div class="row">
        @foreach ($products as $product)
        <div class="col-md-4 mb-4">
            <div class="card">
                <img src="{{ asset('storage/' . $product->product_image) }}" class="card-img-top" alt="Product Image">
                <div class="card-body">
                    <h5 class="card-title">{{ $product->product_name }}</h5>
                    <p><strong>Category:</strong> {{ $product->category->name }}</p>
                    <p><strong>Subcategory:</strong> {{ $product->subcategory->name }}</p>
                    <a href="{{ route('product.detail', $product->id) }}" class="btn btn-primary">View Details</a>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection
