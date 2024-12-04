@extends('user.usermain')
@section('content')
<?php

use App\Models\Cart;
use Illuminate\Support\Facades\Auth;

if (auth()->user()) {
    $carts = Cart::where('user_id', Auth::user()->id)->get();
} else {
    $carts = null;
}
?>
<style>
.Checkout_section {
  padding: 60px 0;
  background-color:white ;
  color: black;
  border: 2px solid black;
}

.checkout_form h3 {
  margin-bottom: 30px;
  font-weight: bold;
  color: black;
}

.checkout_form label {
  font-weight: bold;
  color: black;
}

.order_table th,
.order_table td {
  padding: 15px;
  text-align: center;
  vertical-align: middle;
  color: white;
  border: 2px solid white;
}
.order_table tbody tr:nth-child(odd) {
  background-color: white;
}

.order_table tbody tr:nth-child(even) {
  background-color:lightgrey;
}

.order_table th {
  background-color: black;
  font-weight: bold;
}
.order_total{
    background-color:black;
}
.payment_method .panel-default {
  margin-bottom: 15px;
}

.payment_method label {
  cursor: pointer;
  color: black;
}

.order_button button {
  padding: 10px 20px;
  background-color: black;
  color: white;
  border: none;
  border-radius: 5px;
  font-size: 16px;
  cursor: pointer;
}

.order_button button:hover {
  background-color: #ff5500;
}

.login-section {
  text-align: center;
  margin-top: 1px;
  margin-bottom: 1px;
  background-color: rgb(166, 224, 240);
  padding: 30px;
}

.login-section__text {
  margin-bottom: 20px;
  font-weight: bold;
  color: #333333;
}

.login-section__link {
  padding: 10px 20px;
  background-color: #ff6600;
  color: #ffffff;
  border: none;
  border-radius: 5px;
  font-size: 16px;
  text-decoration: none;
}

.login-section__link:hover {
  background-color: #ff5500;
}
</style>

<!--Checkout page section-->
@if(auth()->user())
<div class="Checkout_section mt-1 mb-1">
    <div class="container">
        <div class="checkout_form">
            <form id="checkout-form" action="/place-order" method="post">
                @csrf
                <div class="row">
                    <div class="col-lg-6 col-md-6">
                        <h3>Billing Details</h3>
                        <div class="row">
                            <div class="col-lg-6 mb-20">
                                <label for="customer_name">Name <span>*</span></label>
                                <input class="form-control" type="text" id="customer_name" name="customer_name" required>
                            </div>
                            <div class="col-6 mb-20">
                                <label for="customer_company">Company Name</label>
                                <input class="form-control" type="text" id="customer_company" name="customer_company">
                            </div>
                            <div class="col-12 mb-20">
                                <label for="customer_address">Address <span>*</span></label>
                                <input class="form-control" placeholder="House number and street name" type="text" id="customer_address" name="customer_address" required>
                            </div>
                            <div class="col-6 mb-20">
                                <label for="customer_town_city">Town / City <span>*</span></label>
                                <input class="form-control" type="text" id="customer_town_city" name="customer_town_city" required>
                            </div>
                            <div class="col-lg-6 mb-20">
                                <label for="customer_phone_number">Phone<span>*</span></label>
                                <input class="form-control" type="text" id="customer_phone_number" name="customer_phone_number" required>
                            </div>
                            <div class="col-12">
                                <div class="order-notes">
                                    <label for="order_note">Order Notes</label>
                                    <textarea class="form-control" id="order_note" rows="2" name="customer_note" placeholder="Notes about your order, e.g. special notes for delivery." required></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6">
                        <h3>Your order</h3>
                        <div class="order_table table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>Product</th>
                                        <th>Unit Price</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $total = 0;
                                    ?>
                                    @if(!is_null($carts))
                                    @foreach($carts as $cart)
                                    <tr>
                                        <td>{{ $cart->product->product_name }} <strong> × {{$cart->quantity}}</strong></td>
                                        <td>NPR {{$cart->unit_price}}</td>
                                    </tr>
                                    <?php
                                    $total += $cart->quantity * $cart->unit_price;
                                    ?>
                                    @endforeach
                                    @endif
                                </tbody>
                                <tfoot>
                                    <tr class="order_total">
                                        <th>Total Price</th>
                                        <td><strong>NPR {{$total}}</strong></td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                        <div class="payment_method">
                            <div class="panel-default">
                                <input id="payment_cod" name="order_payment_type" value="cod" type="radio" data-target="createp_account" />
                                <label for="payment_cod" data-toggle="collapse" data-target="#collapseThree" aria-controls="collapseThree">Cash On Delivery</label>

                                <div id="collapseThree" class="collapse" data-parent="#accordionExample">
                                    <div class="card-body1">
                                        <p>Please send a check to Store Name, Store Street, Store Town, Store State / County, Store Postcode.</p>
                                    </div>
                                </div>
                            </div>
                            <div class="panel-default">
                                <input id="payment_khalti" name="order_payment_type" value="khalti" type="radio" data-target="createp_account" />
                                <label for="payment_khalti" data-toggle="collapse" data-target="#collapseFour" aria-controls="collapseFour">Khalti <img src="{{asset('user/assets/img/icon/papyel.png')}}" alt=""></label>

                                <div id="collapseFour" class="collapse" data-parent="#accordionExample">
                                    <div class="card-body1">
                                        <p>Pay via Khalti; you can pay with your Khalti account. <a href="#">What is Khalti?</a></p>
                                    </div>
                                </div>
                            </div>
                            <div class="order_button">
                                @if (!is_null($carts) && count($carts) > 0)
                                <button class="btn" id="submitBtn" type="submit" disabled>Proceed to Buy</button>
                                @else
                                <p>No products in the cart. Please add products before proceeding.</p>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@else
<div class="login-section">
    <div class="login-section__content">
        <p class="login-section__text"><b>Please Log in to Proceed to Checkout</b></p>
        <div class="login-section__footer">
            <div class="login-section__button">
                <a href="/login" class="btn btn-light">Log In</a>
            </div>
        </div>
    </div>
</div>
@endif
<!--Checkout page section end-->
<script>
    // Listen for changes in payment method selection
    const paymentCod = document.getElementById('payment_cod');
    const paymentKhalti = document.getElementById('payment_khalti');
    const submitBtn = document.getElementById('submitBtn');

    paymentCod.addEventListener('change', handlePaymentChange);
    paymentKhalti.addEventListener('change', handlePaymentChange);

    function handlePaymentChange() {
        // Enable or disable the submit button based on the selected payment method
        if (paymentCod.checked || paymentKhalti.checked) {
            submitBtn.disabled = false;
        } else {
            submitBtn.disabled = true;
        }
    }
</script>
<script>
    document.getElementById('payment_khalti').addEventListener('change', function() {
        // When the user selects Khalti as the payment method, enable the "Proceed to Buy" button
        document.getElementById('submitBtn').disabled = false;
    });
</script>
@endsection