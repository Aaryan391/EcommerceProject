<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Category;
use App\Models\Product;
use App\Models\Subcategory;
use Illuminate\Http\Request;

class CartController extends Controller
{
    function Cartview()
    {
        $cartitems = Cart::where('user_id', auth()->id())->get();
        return view('user\usercart', compact('cartitems'));
    }
    public function addToCart(Request $request, Product $product)
    {
        // Validate the request
        $request->validate([
            'quantity' => 'required|numeric|min:1',
        ]);
    
        // Get the authenticated user
        $user = auth()->user();
    
        // Check if the product is already in the cart
        $cartItem = Cart::where('user_id', $user->id)
            ->where('product_id', $product->id)
            ->first();
    
        // Calculate the total quantity including the existing quantity in the cart
        $totalQuantityInCart = $cartItem ? $cartItem->quantity : 0;
        $requestedQuantity = $request->input('quantity');
        $newTotalQuantity = $totalQuantityInCart + $requestedQuantity;
    
        // Check if the new total quantity exceeds the available stock
        if ($newTotalQuantity > $product->stock) {
            // Optionally, you may want to flash an error message or return a response
            // indicating that the requested quantity exceeds the available stock.
            return redirect()->back()->with('error', 'Total quantity in cart exceeds available stock');
        }
    
        if ($cartItem) {
            // Update the quantity and unit_price if the product is already in the cart
            $cartItem->update([
                'quantity' => $newTotalQuantity,
                'unit_price' => $product->price,
            ]);
        } else {
            // Add a new item to the cart
            Cart::create([
                'user_id' => $user->id,
                'product_id' => $product->id,
                'quantity' => $requestedQuantity,
                'unit_price' => $product->price,
            ]);
        }
    
        // Optionally, you may want to flash a message or return a response
        // indicating that the product has been added to the cart successfully.
    
        return redirect()->back()->with('success', 'Product added to cart successfully');
    }
    public function removeFromCart(Cart $cartItem)
    {
        // Check if the authenticated user owns the cart item
        if (auth()->id() !== $cartItem->user_id) {
            abort(403, 'Unauthorized action.');
        }

        // Delete the cart item
        $cartItem->delete();

        // Optionally, you may want to flash a message or return a response
        // indicating that the product has been removed from the cart successfully.

        return redirect()->back()->with('success', 'Product removed from cart successfully');
    }
    // Add this method to your CartController
    public function updateCartQuantity(Request $request, Cart $cartItem)
    {
        // Validate the request
        $request->validate([
            'quantity' => 'required|numeric|min:1',
        ]);
        $requestedQuantity = $request->input('quantity');
        if ($cartItem->product->stock < $requestedQuantity) {
            // Optionally, you may want to flash an error message or return a response
            // indicating that the requested quantity exceeds the available stock.
            return redirect()->back()->with('error', 'Requested quantity exceeds available stock');
        }
        // Update the quantity
        $cartItem->update([
            'quantity' => $request->input('quantity'),
        ]);

        // Optionally, you may want to flash a message or return a response
        // indicating that the quantity has been updated successfully.

        return redirect()->back()->with('success', 'Quantity updated successfully');
    }
}
