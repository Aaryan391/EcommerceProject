@extends('user.usermain')
@section('content')
<style>
    body {
        color: #fff; /* White text color */
    }

    .product-card {
        border: 4px solid black; /* White border color */
        border-radius: 15px;
        overflow: hidden;
        transition: transform 0.3s;
        background-color: #111; /* Darker card background color */
    }

    .product-card:hover {
        transform: scale(1.05);
    }

    .card-body {
        background-color: black; /* Black background color */
        color: white; /* White text color */
        border-radius: 0 0 10px 10px;
        border: 2px solid white;
    }

    .card-title {
        color: #fff; /* White title color */
    }

    .btn-light {
        background-color: black; /* Black button background color */
        color: white; /* White text color */
        border: 2px solid white;
    }

    @media (max-width: 768px) {
        .col-md-4 {
            flex: 0 0 100%;
            max-width: 100%;
        }
    }
</style>


<div class="container mt-3 mb-5">
    <div class="row">
        <div class="col-md-12 mb-4">
            <form action="{{ route('user.product.filter') }}" method="GET" class="filter-form">
                <div class="form-row align-items-center">
                    <div class="col-auto">
                        <label class="sr-only" for="category">Category</label>
                        <select class="form-control mb-2" id="category" name="category">
                            <option value="">Select Category</option>
                            @foreach($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-auto">
                        <button type="submit" class="btn btn-light mb-2">Filter</button>
                    </div>
                </div>
            </form>
        </div>
        <div class="container mt-5 mb-5">
            <div class="row">
                @foreach($products as $product)
                <div class="col-md-4">
                    <div class="card mb-4 shadow product-card">
                        <img src="{{ asset('storage/' . $product->product_image) }}" alt="{{ $product->product_name }}" class="bd-placeholder-img card-img-top" width="100%" height="225">
                        <div class="card-body">
                            <h5 class="card-title">{{ $product->product_name }}</h5>
                            <p class="card-text">Price: NPR{{ $product->price }}</p>
                            <p class="card-text">Stock: {{ $product->stock }}</p>
                            <p class="card-text">Uniqueness: {{ $product->uniqueness }}</p>
                            <p><strong>Category:</strong> {{ $product->category->name }}</p>
                            <p><strong>Subcategory:</strong> {{ $product->subcategory->name }}</p>
                            <a href="{{ route('product.detail', $product->id) }}" class="btn btn-light">View Details</a>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
@endsection
