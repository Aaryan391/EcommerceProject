@extends('user.usermain')
@section('content')
<style>
    ::-webkit-scrollbar {
        display: none;
    }

    .category-heading {
        color: #fff; /* White text color */
        font-size: 24px;
        padding: 10px;
        border-radius: 10px;
        background-color: black; /* Black background color */
        margin-bottom: 20px;
    }

    .product-card {
        transition: transform 0.3s ease-in-out;
        border: 2px solid #fff; /* White border color */
        border-radius: 5px;
    }

    .product-card:hover {
        transform: scale(1.05);
    }

    .product-card img {
        border-radius: 10px 10px 0 0;
        object-fit: cover;
        height: 225px;
        border: 8px solid black; /* Black border color */
        width: 100%;
    }

    .product-card .card-body {
        background-color: #000; /* Black background color */
        color: #fff; /* White text color */
        border: 2px solid black; /* Black border color */
        border-top: none;
        border-radius: 0 0 10px 10px;
    }

    .product-card .card-title {
        color: #fff; /* White text color */
        font-size: 18px;
    }

    .product-card .btn-outline-custom {
        color: #fff; /* White text color */
        border-color: white; /* Black border color */
        border: 2px solid white;
    }

    .btn-outline-custom {
        background-color: #000; /* Black background color */
    }

    .product-card .btn-outline-custom:hover {
        color: #000; /* Black text color */
        background-color: white; /* Slightly darker black for hover */
        border-color: #fff; /* White border color */
    }
</style>


<div class="container">
    @foreach($categories as $category)
    <div class="category-container">
        <div class="category-heading">Category: {{ $category->name }}</div>
        <div class="row">
            @foreach($category->products as $product)
            <div class="col-md-4">
                <div class="card mb-4 shadow product-card">
                    <img src="{{ asset('storage/' . $product->product_image) }}" alt="{{ $product->product_name }}" class="card-img-top">
                    <div class="card-body">
                        <h5 class="card-title">{{ $product->product_name }}</h5>
                        <p class="card-text"><strong>Price:</strong> RS:{{ $product->price }}</p>
                        <p class="card-text"><strong>Stock:</strong> {{ $product->stock }}</p>
                        <p class="card-text"><strong>Uniqueness:</strong> {{ $product->uniqueness }}</p>
                        <p class="card-text"><strong>Category:</strong> {{ $product->category->name }}</p>
                        <p class="card-text"><strong>Subcategory:</strong> {{ $product->subcategory->name }}</p>
                        <a href="{{ route('product.detail', $product->id) }}" class="btn btn-outline-custom">View Details</a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
    @endforeach
</div>
@endsection
