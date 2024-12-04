@extends('user.usermain')
@section('content')
<style>
    /* Styling for the modal body */
    .login-section {
        background-color: #f0f5e1; /* Light green */
        padding: 20px;
        border-radius: 5px;
        display: flex;
        justify-content: center;
        border: 2px solid #394240; /* Dark green */
    }

    .login-section__content {
        text-align: center;
    }

    .login-section__text {
        font-weight: bold;
        font-size: 16px;
        margin-bottom: 10px;
        color: #394240; /* Dark green */
    }

    .login-section__footer {
        display: flex;
        justify-content: center;
    }

    .login-section__button {
        background-color: #9b9b7a; /* Beige */
        padding: 10px 20px;
        border-radius: 3px;
    }

    .login-section__link {
        color: #fff;
        text-decoration: none;
        font-weight: bold;
        font-size: 14px;
    }

    .login-section__link:hover {
        text-decoration: underline;
    }

    .card-container {
        display: flex;
        flex-wrap: wrap;
        justify-content: space-around;
        margin-top: 20px;
        background-color: #5a789f;
    }

    .card {
        width: 300px;
        margin: 10px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        border-radius: 10px;
        overflow: hidden;
        transition: transform 0.3s;
        background-color:lightseagreen;
    }

    .card:hover {
        transform: scale(1.05);
    }

    .card-header {
        background-color: #394240; /* Dark green */
        color: #fff;
        padding: 10px;
        text-align: center;
        font-weight: bold;
    }

    .card-body {
        padding: 20px;
    }

    .order-details {
        margin-bottom: 10px;
    }

    .order-details p {
        margin: 0;
        padding: 8px;
    }

    .order-details p:nth-child(odd) {
        background-color: #81a2be; /* Sky blue */
        color: dark;
    }

    .order-details p:nth-child(even) {
        background-color: #5a789f; /* Darker blue */
        color: dark;
    }

    .order-btn {
        background-color: #edf6e5; /* Sky blue */
        color: black;
        padding: 8px 15px;
        border: none;
        border-radius: 3px;
        cursor: pointer;
        transition: background-color 0.3s;
    }

    .order-btn:hover {
        background-color: lightslategrey; /* Darker blue on hover */
    }

    .modal-body .header-item {
        flex-basis: 25%;
        padding: 10px;
    }

    .modal-body .item {
        display: flex;
        justify-content: space-between;
        padding: 10px;
        border-bottom: 1px solid #394240; /* Dark green */
    }

    .modal-body .item p {
        flex-basis: 25%;
        margin: 0;
        padding: 8px;
    }

    .modal-body .item:nth-child(odd) {
        background-color: #edf6e5; /* Light green */
    }

    .modal-body .item:nth-child(even) {
        background-color: #f9f5e1; /* Light beige */
    }
</style>
@if(auth()->user())
<div class="container mt-4">
    <div class="card-container">
        <!-- loop through orders variable -->
        @foreach($orders as $order)
        <div class="card">
            <div class="card-header">
                Order
            </div>
            <div class="card-body">
                <div class="order-details">
                    <p>Customer Name: {{ $order->customer_name }}</p>
                    <p>Order Date: {{ $order->created_at->format('d-m-Y') }}</p>
                    <p>Order Status: {{ $order->order_status }}</p>
                    <p>Payment Status: {{ $order->payment_status }}</p>
                    <p>Order Total: NPR &nbsp; {{ $order->order_total }}</p>
                </div>
                <button type="button" class="order-btn view-orders-btn" data-bs-toggle="modal" data-bs-target="#exampleModal-{{ $order->id }}">View Order</button>
            </div>
        </div>

        <!-- Modal -->
        <div class="modal fade" id="exampleModal-{{ $order->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-scrollable modal-custom">
                <div class="modal-content">
                    <div class="modal-header bg-primary text-white">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Order Details</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="header d-flex justify-content-between bg-info text-white">
                            <p class="header-item">Item</p>
                            <p class="header-item">Quantity</p>
                            <p class="header-item">Unit Price (NPR)</p>
                            <p class="header-item">Total</p>
                        </div>
                        @foreach($order->order_details as $item)
                        <div class="item">
                            <p>{{ $item->product_name }}</p>
                            <p>{{ $item->quantity }}</p>
                            <p>{{ $item->unit_price }}</p>
                            <p>{{ $item->quantity * $item->unit_price }}</p>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
@else
<div class="login-section">
    <div class="login-section__content">
        <p class="login-section__text"><b>Please Log in to view your order</b></p>
        <div class="login-section__button">
            <a class="btn btn-light" href="/login">Login</a>
        </div>
    </div>
</div>
@endif

@endsection
