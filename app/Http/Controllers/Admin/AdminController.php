<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Order;
use App\Models\Product;
use App\Models\Revenue;
use App\Models\Subcategory;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    function index()
    {
        return view('admin/layouts/adminmain');
    }
    function totalindex()
    {
        $totalUsers = User::count();
        $totalProducts = Product::count();
        $totalOrders = Order::count();
        return view('admin/layouts/admindashboard', compact('totalUsers', 'totalProducts', 'totalOrders'));
    }
    public function revenueReport()
    {
        $revenues = Revenue::orderBy('created_at', 'asc')->get();
        return view('admin.revenue', compact('revenues'));
    }
    function clearRevenueTable()
    {
        Revenue::truncate();
        return redirect()->back()->with('success', 'Revenue Data has been Cleared successfully.');
    }
    public function getrevenuereport()
    {
        // Get the current month's start and end date
        $startOfMonth = Carbon::now()->startOfMonth();
        $endOfMonth = Carbon::now()->endOfMonth();

        // Fetch revenue data for the current month
        $revenues = DB::table('revenue')
            ->whereBetween('created_at', [$startOfMonth, $endOfMonth])
            ->get();

        // Calculate total revenue for the current month
        $totalRevenue = $revenues->sum('price');

        // Pass the data to the view
        return view('admin.layouts.admindashboard', compact('revenues', 'totalRevenue'));
    }
    function latestproductview()
    {
        // Get distinct category ids
        $categoryIds = DB::table('products')->distinct()->pluck('category_id');

        // Fetch the latest 3 products for each category
        $latestProducts = [];
        foreach ($categoryIds as $categoryId) {
            $latestProducts[$categoryId] = Product::where('category_id', $categoryId)
                ->orderBy('created_at', 'desc')
                ->take(3)
                ->get();
        }

        $categories = Category::all();
        $subcategories = Subcategory::all();

        return view('user.latestproduct', compact('latestProducts', 'categories', 'subcategories'));
    }

}
