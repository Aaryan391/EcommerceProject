<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderDetails;
use App\Models\Product;
use Illuminate\Http\Request;

class CheckoutController extends Controller
{
    function checkout()
    {
        return view('user.usercheckout');
    }
    function placeOrder(Request $request)
    {
        if ($request->order_payment_type == 'khalti') {
            $order = new Order();
            $order->user_id = auth()->id();
            $order->order_payment_type = $request->order_payment_type;
            $order->order_total =  0;
            $order->order_status = 'pending';
            $order->customer_name = $request->customer_name;
            $order->customer_phone_number = $request->customer_phone_number;
            $order->customer_address = $request->customer_address;
            $order->customer_note = $request->customer_note;
            $order->customer_company = $request->customer_company;
            $order->customer_town_city = $request->customer_town_city;
            $order->save();


            $carts = Cart::where('user_id', auth()->user()->id)->get();

            foreach ($carts as  $cart) {
                $order_details = new OrderDetails();
                $order_details->product_id = $cart->product_id;
                $order_details->quantity = $cart->quantity;
                $order_details->unit_price = $cart->unit_price;
                $order_details->order_id = $order->id;
                $order_details->save();

                // Decrease the product stock
                $product = Product::find($cart->product_id);

                // Decrease the stock based on the quantity ordered
                $product->stock -= $cart->quantity;
                $product->save();

                $order->order_total += $cart->quantity * $cart->unit_price;
                $order->update();

                $cart->delete();
            }

            $url = 'pay-with-khalti/' . $order->order_total . '/' . $order->id;
            return redirect($url);
        } else {
            $order = new Order();
            $order->user_id = auth()->id();
            $order->order_payment_type = $request->order_payment_type;
            $order->order_total =  0;
            $order->order_status = 'pending';
            $order->customer_name = $request->customer_name;
            $order->customer_phone_number = $request->customer_phone_number;
            $order->customer_address = $request->customer_address;
            $order->customer_note = $request->customer_note;
            $order->customer_company = $request->customer_company;
            $order->customer_town_city = $request->customer_town_city;
            $order->save();


            $carts = Cart::where('user_id', auth()->user()->id)->get();

            foreach ($carts as  $cart) {
                $order_details = new OrderDetails();
                $order_details->product_id = $cart->product_id;
                $order_details->quantity = $cart->quantity;
                $order_details->unit_price = $cart->unit_price;
                $order_details->order_id = $order->id;
                $order_details->save();
                // Decrease the product stock
                $product = Product::find($cart->product_id);

                // Decrease the stock based on the quantity ordered
                $product->stock -= $cart->quantity;
                $product->save();

                $order->order_total += $cart->quantity * $cart->unit_price;
                $order->update();

                $cart->delete();
            }
            return redirect('/')->with('message', 'Your Order Has Been Placed');
        }
    }

    function payWithKhalti($total_price, $order_id)
    {
        return view('user.paywithkhalti', compact('total_price', 'order_id'));
    }


    function updateOrder($id)
    {
        $order = Order::find($id);
        $order->payment_status = 'paid';
        $order->update();

        return redirect('/')->with('message', 'Your Order Has Been Placed Successfully');
    }
}
