<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GemEase Admin Dashboard</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <style>
        body {
            padding-top: 70px;
            /* Adjusted padding for fixed navbar */
            font-family: 'Arial', sans-serif;
            background-color: #f8f9fa;
            /* Added background color */
        }

        /* Admin Navbar Styles */
        .admin-navbar {
            background: linear-gradient(to bottom, #ffffff, #ff6961);
            /* Improved gradient */
            color: black;
        }

        .admin-navbar .navbar-brand {
            background-color: #ffc0cb;
            /* Lighter pink background */
            color: black;
            padding: 10px 15px;
            border-radius: 5px;
        }

        .admin-navbar .navbar-toggler-icon {
            background-color: white;
        }

        .admin-navbar .nav-link {
            color: black;
            transition: color 0.3s;
        }

        .admin-navbar .nav-link:hover {
            color: #dc3545;
            /* Bootstrap danger color */
        }

        .admin-navbar .ml-auto .nav-item {
            margin-left: 10px;
        }

        /* Move links to the left */
        .ml-auto {
            margin-left: auto !important;
        }

        /* Improved content styling */
        .container {
            margin-top: 20px;
        }
    </style>
</head>

<body>
    <!-- Admin Dashboard Navigation -->
    <nav class="navbar navbar-expand-lg navbar-light admin-navbar fixed-top">
        <div class="container">
            <a class="navbar-brand">GemEase</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav">
                    <li class="nav-item active">
                        <a class="nav-link" href="/home">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/category">Categories</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/productview">Products</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/orders">Orders</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/revenue">Revenue Report</a>
                    </li>
                </ul>
                <!-- Added Profile and Logout -->
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('profile.edit') }}">Profile</a>
                    </li>
                    <li class="nav-item">
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="btn btn-link nav-link">Logout</button>
                        </form>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Content -->
    <div class="container">
        @yield('content')
    </div>
    <!-- Content ends -->
    <!-- Bootstrap and jQuery CDN Links -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</body>

</html>