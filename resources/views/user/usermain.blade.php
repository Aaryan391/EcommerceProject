<?php

use App\Models\Category;
use App\Models\Subcategory;

$categories = Category::all();
$subcategories = Subcategory::all();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <script src="https://khalti.s3.ap-south-1.amazonaws.com/KPG/dist/2020.12.17.0.0.0/khalti-checkout.iffe.js"></script>
    <style>
        body {
            padding-top: 150px;
            background-color: #f8f9fa;
            /* Light gray background */
            color: #343a40;
            /* Dark text color */
        }

        .sidenav {
            height: 100%;
            width: 0;
            position: fixed;
            z-index: 1;
            top: 0;
            left: 0;
            background-color: #343a40;
            /* Dark background */
            overflow: hidden;
            transition: 0.5s;
            padding-top: 60px;
        }

        .sidenav .closebtn {
            position: absolute;
            top: 0;
            font-size: 36px;
            margin-left: 50px;
            color: #fff;
            /* White close button */
        }

        .sidenav a {
            padding: 8px 8px 8px 32px;
            text-decoration: none;
            font-size: 20px;
            color: #dee2e6;
            /* Light text color */
            display: block;
            transition: 0.3s;
        }

        .sidenav a:hover {
            color: #adb5bd;
            /* Lighter text color on hover */
        }

        .sidenav .closebtn:hover {
            color: #adb5bd;
            /* Lighter text color on hover */
        }

        .openbtn {
            cursor: pointer;
            background-color: #343a40;
            /* Dark background for button */
            color: #fff;
            /* White text color */
            padding: 10px 15px;
            border: none;
        }

        .openbtn:hover {
            background-color: #495057;
            /* Slightly lighter background on hover */
        }

        #main {
            transition: margin-left .5s;
            padding: 20px;
        }

        .navbar {
            background: #f0f0f0;
            /* Light gray navbar background */
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .navbar-brand img {
            max-height: 50px;
        }

        .navbar-toggler-icon {
            background-color: #28a745;
            /* Green color for toggler icon */
        }

        .navbar-nav .nav-item {
            margin-right: 10px;
        }

        .navbar-nav .nav-item:last-child {
            margin-right: 0;
        }

        .navbar-nav .nav-link {
            color: #495057;
            /* Dark text color */
            font-weight: bold;
            transition: color 0.3s;
        }

        .navbar-nav .nav-link:hover {
            color: #28a745;
            /* Green color on hover */
        }

        .dropdown-menu {
            border: 1px solid #ddd;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        .dropdown-menu a {
            color: #495057;
            /* Dark text color */
            font-weight: bold;
        }

        .dropdown-menu a:hover {
            color: #6c757d;
            /* Slightly lighter text color on hover */
        }

        .top_right {
            margin-left: auto;
        }

        .top_right a {
            color: #495057;
            /* Dark text color */
            text-decoration: none;
            font-weight: bold;
            transition: color 0.3s;
            margin-left: 20px;
        }

        .top_right a:hover {
            color: #28a745;
            /* Green color on hover */
        }

        .footer {
            background: lightseagreen;
            /* Light gray footer background */
            padding: 50px 0;
            color: #495057;
            /* Dark text color */
        }

        .footer-logo {
            margin-bottom: 20px;
        }

        .footer-logo img {
            max-width: 150px;
            max-height: 50px;
        }

        .footer-text {
            color: #495057;
            /* Dark text color */
        }

        .footer-links {
            list-style: none;
            padding: 0;
        }

        .footer-links li {
            margin-bottom: 10px;
        }

        .footer-links a {
            color: #495057;
            /* Dark text color */
            text-decoration: none;
            transition: color 0.3s;
        }

        .footer-links a:hover {
            color: #6c757d;
            /* Slightly lighter text color on hover */
        }

        .footer-social {
            margin-top: 20px;
        }

        .footer-social a {
            display: inline-block;
            margin-right: 20px;
            color: #007bff;
            /* Blue color for social icons */
            font-size: 24px;
            transition: color 0.3s;
        }

        .footer-social a:hover {
            color: #0056b3;
            /* Darker blue color on hover */
        }

        /* Custom styling for the error message */
        .custom-error {
            background-color: #ff5c5c;
            color: #fff;
            border: 1px solid #e65252;
            border-radius: 5px;
            padding: 10px;
            opacity: 0.9;
        }

        /* Add this to your existing styles */
        .form-control {
            border: 2px solid #dee2e6;
            /* Light border color */
            border-radius: 25px;
        }

        select.form-control {
            border-radius: 25px;
        }

        button.btn-primary {
            border-radius: 25px;
            background-color: #28a745;
            /* Green color for button */
            border: 2px solid #28a745;
            color: #fff;
            transition: background-color 0.3s, border-color 0.3s, color 0.3s;
        }

        input::placeholder {
            color: #adb5bd;
            /* Light text color for placeholder */
        }

        .form-group {
            display: flex;
            align-items: center;
        }

        .btn-primary:hover {
            background-color: #218838;
            /* Darker green color on hover */
            border-color: #218838;
        }
    </style>
    <title>GemEase</title>
</head>

<body>
    <!-- Display validation errors with pop and fade effect -->
    @if(session('errors') && count(session('errors')->all()) > 0)
    <div class="alert alert-danger fade show custom-error" role="alert">
        <ul class="mb-0">
            @foreach(session('errors')->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif
    <!-- Navigation Bar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top">
        <div id="mySidenav" class="sidenav">
            <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
            <a class="nav-link" href="/">Home</a>
            <a class="nav-link" href="{{ route('userproductview') }}">Shop</a>
            <a class="nav-link" href="{{ route('category.products') }}">Collections</a>
            <a class="nav-link" href="{{ route('Cartview') }}">Cart</a>
            <a class="nav-link" href="{{ route('checkout') }}">CheckOut</a>
            <a class="nav-link" href="{{route('userOrder')}}">Order</a>
            

        </div>
        <div id="main">
            <button class="openbtn" onclick="openNav()">&#9776;Main Menu</button>
        </div>
        <div class="container">
            <!-- Logo -->
            <a class="navbar-brand" href="">
                <img src="{{ asset('images/gemease.png') }}" alt="Logo" width="100px">
            </a>

            <!-- Navigation Links -->
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <!-- Navigation Links -->
            <div class="collapse navbar-collapse" id="navbarNav">
                <!-- Replace the existing search form with this code -->
                <form action="{{ route('search') }}" method="GET" class="form-group">
                    <input class="form-control" placeholder="Search for products..." name="search" type="text">

                    <!-- Category Dropdown -->
                    <select class="form-control" name="category_id">
                        <option value="" selected>Select Category</option>
                        @foreach ($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>

                    <!-- Subcategory Dropdown -->
                    <select class="form-control" name="subcategory_id">
                        <option value="" selected>Select Subcategory</option>
                        @foreach ($subcategories as $subcategory)
                        <option value="{{ $subcategory->id }}">{{ $subcategory->name }}</option>
                        @endforeach
                    </select>

                    <button class="btn btn-primary" type="submit">Search</button>
                </form>

                <!-- User Settings Dropdown -->
                <ul class="navbar-nav top_right">
                    @if(auth()->user())
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            {{ Auth::user()->name }}
                        </a>
                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
                            <a class="dropdown-item" href="{{ route('profile.edit') }}">Profile</a>
                            <div class="dropdown-divider"></div>
                            <!-- Authentication -->
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="dropdown-item">Log Out</button>
                            </form>
                        </div>
                    </li>
                    @else
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('login') }}">Log in</a>
                    </li>
                    @if (Route::has('register'))
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('register') }}">Register</a>
                    </li>
                    @endif
                    @endif
                </ul>
            </div>
        </div>
    </nav>
    <!-- content -->
    @yield('content')

    <!-- content ends -->
    <!-- Footer Section -->
    <footer class="footer mt-4">
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <div class="footer-logo">
                        <img src="{{ asset('images/gemease.png') }}" alt="Logo" width="100px">
                    </div>
                    <p class="footer-text">Discover exquisite jewelry and accessories for every occasion.</p>
                    <p class="footer-text">&copy; 2024 Your Jewelry Store. All rights reserved.</p>
                </div>
                <div class="col-md-4">
                    <h5>Quick Links</h5>
                    <ul class="footer-links">
                        <li><a href="">Home</a></li>
                        <li><a href="{{ route('userproductview') }}">Shop</a></li>
                        <li><a href="{{ route('category.products') }}">Collections</a></li>
                        <li><a href="{{ route('Cartview') }}">Cart</a></li>
                        <li><a href="{{ route('checkout') }}">CheckOut</a></li>
                        <li><a href="{{route('userOrder')}}">Order</a></li>
                    </ul>
                </div>
                <div class="col-md-4">
                    <h5>Connect with Us</h5>
                    <div class="footer-social">
                        <a href="#" target="_blank"><i class="fab fa-facebook"></i></a>
                        <a href="#" target="_blank"><i class="fab fa-twitter"></i></a>
                        <a href="#" target="_blank"><i class="fab fa-instagram"></i></a>
                        <a href="#" target="_blank"><i class="fab fa-pinterest"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </footer>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
    <!-- Add this script at the end of the file -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script>
        $(document).ready(function() {
            // Event listener for the category dropdown change
            $('select[name="category_id"]').change(function() {
                var categoryId = $(this).val();

                // Make an AJAX request to get subcategories for the selected category
                $.ajax({
                    url: '{{ route("get-ssubcategories") }}',
                    method: 'GET',
                    data: {
                        category_id: categoryId
                    },
                    success: function(response) {
                        // Clear existing subcategories and add new ones
                        $('select[name="subcategory_id"]').empty();
                        $('select[name="subcategory_id"]').append('<option value="" selected>Select Subcategory</option>');

                        // Add the retrieved subcategories to the dropdown
                        $.each(response, function(index, subcategory) {
                            $('select[name="subcategory_id"]').append('<option value="' + subcategory.id + '">' + subcategory.name + '</option>');
                        });
                    },
                    error: function(error) {
                        console.log('Error fetching subcategories: ' + error.responseText);
                    }
                });
            });
        });

        function openNav() {
            document.getElementById("mySidenav").style.width = "250px";
            document.getElementById("main").style.marginLeft = "250px";
        }

        function closeNav() {
            document.getElementById("mySidenav").style.width = "0px";
            document.getElementById("main").style.marginLeft = "0px";
        }
    </script>

</body>

</html>