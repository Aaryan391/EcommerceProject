@extends('user.usermain')
@section('content')
<style>
    body {
        font-family: 'Arial', sans-serif;
        background-color: #f2f2f2; /* Light gray background */
        color: #333; /* Dark text color */
    }

    .featured-banner {
        background-position: center;
        height: 60px; /* Increased height for better visibility */
        display: flex;
        align-items: center;
        justify-content: center;
        color: white; /* White text color for better contrast */
        font-size: 24px;
        text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.8);
        background-color: #333; /* Dark background color */
    }

    .product-container {
        margin: 20px auto;
        padding: 20px;
        background-color: white; /* Light orange background */
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        border-radius: 8px;
        border: 2px solid black;
    }
    .product-container h2{
        text-align: center;
        margin-bottom: 20px;
        color: #333; /* Dark text color */
    }

    .product-row {
        display: flex;
        flex-wrap: wrap;
        justify-content: space-around;
    }

    .product-card {
        width: 300px;
        background-color: #f2f2f2; /* Light gray background */
        border: 2px solid black; /* White border */
        border-radius: 8px;
        padding: 20px;
        margin: 20px 10px;
        transition: transform 0.3s ease-in-out, box-shadow 0.3s ease-in-out;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        font-weight: bold;
        color: #333; /* Dark text color */
    }

    .product-card:hover {
        transform: scale(1.05);
        box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
    }

    .card-img-top {
        width: 100%;
        height: auto;
        border-radius: 4px;
        margin-bottom: 10px;
        border: 2px solid black;
    }

    .card-title {
        font-size: 18px;
        margin-bottom: 10px;
        color: #333; /* Dark text color */
    }

    .card-text {
        color: #555; /* Slightly lighter text color */
        margin-bottom: 5px;
    }

    .btn-outline-custom {
        background-color: #333; /* Dark background color */
        display: inline-block;
        padding: 8px 16px;
        margin-top: 10px;
        font-size: 14px;
        font-weight: bold;
        text-align: center;
        text-decoration: none;
        border: 2px solid #333; /* Dark border color */
        color: #fff; /* White text color */
        border-radius: 4px;
    }

    .btn-outline-custom:hover {
        background-color: black; /* Light red color on hover */
        color: #fff; /* White text color on hover */
    }
</style>

</head>

<body>
    <div class="featured-banner">
        <p>Check out our latest arrivals!</p>
    </div>

    <!-- Container for Category 1 -->
    <div class="container product-container">
        @foreach($categories as $category)
        <h2>{{ $category->name }}</h2>
        <div class="product-row">
            @foreach($latestProducts[$category->id] as $product)
            <div class="product-card">
                <img src="{{ asset('storage/' . $product->product_image) }}" alt="{{ $product->product_name }}" class="card-img-top">
                <h5 class="card-title">{{ $product->product_name }}</h5>
                <p class="card-text"><strong>Price:</strong> NPR {{ $product->price }}</p>
                <p class="card-text"><strong>Stock:</strong> {{ $product->stock }}</p>
                <p class="card-text"><strong>Uniqueness:</strong> {{ $product->uniqueness }}</p>
                <p class="card-text"><strong>Category:</strong> {{ $product->category->name }}</p>
                <p class="card-text"><strong>Subcategory:</strong> {{ $product->subcategory->name }}</p>
                <a href="{{ route('product.detail', $product->id) }}" class="btn btn-outline-custom">View Details</a>
            </div>
            @endforeach
        </div>
        @endforeach
    </div>
</body>
@endsection
