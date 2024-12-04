<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\categoryController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\User\CartController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [ProductController::class,'dataview']);
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/category', [CategoryController::class, 'categoryview'])->middleware('admin');
    Route::get('/home',[AdminController::class,'index'])->middleware('admin');
    Route::get('/home',[AdminController::class,'totalindex'])->name('totalindex')->middleware('admin');
    Route::get('/salesChart', [AdminController::class,'getrevenuereport'])->name('salesChart');
//Route::get('/category',[categoryController::class,'categoryview']);
Route::post('/storeCategory', [CategoryController::class, 'storeCategory'])->name('storeCategory')->middleware('admin');
Route::post('/storeSubcategory', [CategoryController::class, 'storeSubcategory'])->name('storeSubcategory')->middleware('admin');
// Delete a category and its subcategories
Route::delete('/category/{category}', [categoryController::class, 'destroycategory'])->name('deleteCategory')->middleware('admin');
// Delete a subcategory individually
Route::delete('/subcategory/{subcategory}', [categoryController::class, 'destroySubcategory'])->name('deleteSubcategory')->middleware('admin');
Route::put('/category/{category}', [categoryController::class, 'updateCategory'])->name('updateCategory')->middleware('admin');
Route::put('/subcategory/{category}',[categoryController::class, 'updateSubcategory'])->name('updateSubcategory')->middleware('admin');

Route::get('/productview', [ProductController::class, 'productview'])->name('productview')->middleware('admin');
Route::post('/products/store', [ProductController::class, 'store'])->name('products.store')->middleware('admin');
Route::delete('/products/{product}', [ProductController::class, 'destroy'])->name('deleteproduct')->middleware('admin');
Route::get('/product/{product}/edit', [ProductController::class, 'edit'])->name('editproduct')->middleware('admin');
Route::put('/product/{product}', [ProductController::class, 'update'])->name('updateproduct')->middleware('admin');
Route::get('/get-subcategories', [ProductController::class,'getSubcategories'])->name('getSubcategories')->middleware('admin');
//revenue
Route::get('/revenue',[AdminController::class,'revenueReport']);
Route::get('/clear-revenue', [AdminController::class, 'clearRevenueTable'])->name('revenue.clear');
});
Route::get('/cart',[CartController::class,'Cartview'])->name('Cartview');
Route::get('/userproduct',[ProductController::class,'userproductview'])->name('userproductview');
Route::get('/product/{id}', [ProductController::class, 'show'])->name('product.detail');
Route::post('/cart/add/{product}', [CartController::class, 'addToCart'])->name('cart.add')->middleware('auth');
Route::put('/cart/update/{cartItem}', [CartController::class,'updateCartQuantity'])->name('cart.update');
Route::delete('/cart/remove/{cartItem}', [CartController::class,'removeFromCart'])->name('cart.remove');

Route::get('/checkout',[CheckoutController::class,'checkout'])->name('checkout');
Route::get('/update-order/{id}',[CheckoutController::class,'updateOrder']);

Route::post('/place-order', [CheckoutController::class,'placeOrder']);

Route::get('/pay-with-khalti/{price}/{order_id}', [CheckoutController::class,'payWithKhalti']);


//orders routes
Route::post('/change-order-details/{id}',[OrderController::class,'changeOrderDetails']);
Route::get('/orders',[OrderController::class,'index'])->name('order.index');
Route::get('/orders/{id}',[OrderController::class,'orderdestroy'])->name('orders.destroy');

//userorderdetails
Route::get('/userOrder',[OrderController::class,'userindex'])->name('userOrder');

//khaltiordercancel
Route::get('/cancel-order/{order_id}', [OrderController::class, 'cancelOrder'])->name('order.cancelled');
//searchproduct
Route::get('/search', [ProductController::class, 'search'])->name('search');
Route::get('/get-ssubcategories',[ProductController::class,'getSsubcategories'])->name('get-ssubcategories');
//products
Route::get('/user/product/filter',[ProductController::class,'userProductFilter'])->name('user.product.filter');
//collections
Route::get('/category-products', [ProductController::class, 'categoryProducts'])->name('category.products');
//homeuserlatestprouductview
Route::get('/', [AdminController::class, 'latestproductview'])->name('latestproductview');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
