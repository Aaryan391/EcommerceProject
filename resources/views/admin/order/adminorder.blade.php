@extends('admin.layouts.adminmain')
@section('content')
@if(session('message'))
<div class="alert alert-success container mt-2">
    {{ session('message') }}
</div>
@endif
<style>
    /* Container styles */
    .container {
        margin: 0 auto;
        max-width: 1200px;
    }

    /* Table styles */
    table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 20px;
    }

    th,
    td {
        padding: 10px;
        border: 1px solid #ddd;
        text-align: left;
    }

    th {
        background-color: #f2f2f2;
    }

    /* Modal styles */
    .modal {
        background: rgba(0, 0, 0, 0.5);
    }

    .modal-content {
        background-color: #fff;
        border-radius: 5px;
    }

    .modal-header {
        background-color: #007bff;
        color: #fff;
        border-bottom: 1px solid #ddd;
        padding: 10px;
        border-radius: 5px 5px 0 0;
    }

    .modal-body,
    .modal-footer {
        padding: 20px;
    }

    /* Buttons styles */
    .btn {
        padding: 8px 16px;
        border-radius: 4px;
        cursor: pointer;
    }

    .btn-primary {
        background-color: #007bff;
        color: #fff;
        border: 1px solid #007bff;
    }

    .btn-danger {
        background-color: #dc3545;
        color: #fff;
        border: 1px solid #dc3545;
    }

    .btn-secondary {
        background-color: #6c757d;
        color: #fff;
        border: 1px solid #6c757d;
    }

    /* Alert styles */
    .alert {
        padding: 15px;
        margin-bottom: 20px;
        border: 1px solid transparent;
        border-radius: 4px;
    }

    .alert-success {
        background-color: #d4edda;
        border-color: #c3e6cb;
        color: #155724;
    }

</style>

<div class="container mt-8">
    <h3>Orders</h3>
</div>

<div class="container mt-4">
    <table class="table">
        <thead>
            <tr>
                <th width="30%">Order Details</th>
                <th>Order Status</th>
                <th>Payment Status</th>
                <th>Order Total Amount</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($orders as $order)
            <tr>
                <td>
                    <strong>Order ID:</strong> {{ $order->id }} <br>
                    <strong>Customer Name:</strong> {{ $order->customer_name }} <br>
                    <strong>Customer Phone:</strong> {{ $order->customer_phone_number }} <br>
                    <strong>Customer Address:</strong> {{ $order->customer_address }} <br>
                    <strong>Customer Town City:</strong> {{ $order->customer_town_city }} <br>
                    <strong>Customer Note:</strong> {{ $order->customer_note }} <br>
                    <strong>Order Date:</strong> {{ $order->created_at->format('d-m-Y') }} <br>
                    <strong>Payment Method:</strong> {{ $order->order_payment_type }}
                </td>
                <td>{{ $order->order_status }}</td>
                <td>{{ $order->payment_status }}</td>
                <td>NPR &nbsp; {{ $order->order_total }}</td>
                <td>
                    <a href="/View/{{ $order->id }}" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#exampleModal-{{ $order->id }}">View Orders</a>
                    <a href="/orders/{{ $order->id }}" class="btn btn-danger btn-sm">Delete</a>
                </td>
            </tr>

            <div class="modal fade" id="exampleModal-{{ $order->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="exampleModalLabel">Order Details</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>

                        <div class="modal-body">
                            <div class="header row">
                                <div class="col">Item</div>
                                <div class="col">Quantity</div>
                                <div class="col">Unit Price</div>
                                <div class="col">Total</div>
                            </div>

                            @foreach($order['order_details'] as $item)
                            <div class="item row">
                                <div class="col-4">{{ $item->product_name }}</div>
                                <div class="col">{{ $item->quantity }}</div>
                                <div class="col">{{ $item->unit_price }}</div>
                                <div class="col">{{ $item->quantity * $item->unit_price }}</div>
                            </div>
                            @endforeach
                        </div>

                        <form action="/change-order-details/{{ $order->id }}" method="post">
                            @csrf
                            <div class="form-group my-3 container">
                                <label for="payment_status">Payment Status</label>
                                <select name="payment_status" id="payment_status">
                                    <option value="unpaid">Unpaid</option>
                                    <option value="paid">Paid</option>
                                </select>
                            </div>

                            <div class="form-group my-3 container">
                                <label for="order_status">Order Status</label>
                                <select name="order_status" id="order_status">
                                    <option value="pending">Pending</option>
                                    <option value="delivering">Delivering</option>
                                    <option value="delivered">Delivered</option>
                                </select>
                            </div>

                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Save changes</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            @endforeach
        </tbody>
    </table>
</div>
@endsection