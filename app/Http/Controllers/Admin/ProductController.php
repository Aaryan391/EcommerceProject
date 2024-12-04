<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use App\Models\Subcategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    function productview()
    {
        $products = Product::all();
        $categories = Category::all();
        $subcategories = Subcategory::all();
        return view('admin\product\product', compact('products','categories','subcategories'));
    }
    public function store(Request $request)
    {
        $request->validate([
            'product_name' => 'required|string|max:255',
            'product_description' => 'required|string',
            'price' => 'required|numeric',
            'color' => 'nullable|string|max:255',
            'uniqueness' => 'nullable|string|max:255',
            'stock'=>'required|numeric',
            'category_id' => 'required|exists:categories,id',
            'subcategory_id' => 'required|exists:subcategories,id',
            'product_image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $imageName = time().'.'.$request->product_image->getClientOriginalExtension();
        $request->product_image->storeAs('public/images', $imageName);
        Product::create([
            'product_name' => $request->product_name,
            'product_description' => $request->product_description,
            'price' => $request->price,
            'color' => $request->color,
            'uniqueness' => $request->uniqueness,
            'stock'=>$request->stock,
            'category_id' => $request->category_id,
            'subcategory_id' => $request->subcategory_id,
            'product_image' => 'images/'.$imageName,
        ]);
        return redirect('/productview')->with('message', 'product updated successfully');
    }
    public function update(Request $request, $id)
    {
        $request->validate([
            'edit_product_name' => 'required|string|max:255',
            'edit_product_description' => 'required|string',
            'edit_price' => 'required|numeric',
            'edit_color' => 'nullable|string|max:255',
            'edit_uniqueness' => 'nullable|string|max:255',
            'edit_stock' => 'required|numeric',
            'edit_category_id' => 'required|exists:categories,id',
            'edit_subcategory_id' => 'required|exists:subcategories,id',
            'edit_product_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $product = Product::findOrFail($id);

        $data = [
            'product_name' => $request->edit_product_name,
            'product_description' => $request->edit_product_description,
            'price' => $request->edit_price,
            'color' => $request->edit_color,
            'uniqueness' => $request->edit_uniqueness,
            'stock' => $request->edit_stock,
            'category_id' => $request->edit_category_id,
            'subcategory_id' => $request->edit_subcategory_id,
        ];

        // Check if a new image is provided
        if ($request->hasFile('edit_product_image')) {
            // Delete the existing image file
            Storage::delete('public/' . $product->product_image);

            // Upload the new image
            $imageName = time() . '.' . $request->edit_product_image->getClientOriginalExtension();
            $request->edit_product_image->storeAs('public/images', $imageName);
            $data['product_image'] = 'images/' . $imageName;
        }

        // Update the product with the new data
        $product->update($data);

        return redirect('/productview')->with('message', 'Product updated successfully');
    }
    public function destroy($id)
    {
        $product = Product::findOrFail($id);

        // Delete the associated image file
        Storage::delete('public/' . $product->product_image);

        // Delete the product record from the database
        $product->delete();

        return redirect('/productview')->with('message', 'Product deleted successfully');
    }
    public function userproductview()
    {
        $products = Product::all();
        $categories = Category::all();
        $subcategories = Subcategory::all();
        return view('user\productview', compact('products','categories','subcategories'));
    }
    public function show($id)
    {
        $product = Product::findOrFail($id);
        return view('user\productdetail', compact('product'));
    }
    public function getSubcategories(Request $request)
    {
        $category_id = $request->input('category_id');
        $subcategories = Subcategory::where('category_id', $category_id)->get();

        return response()->json($subcategories);
    }
    public function search(Request $request)
    {
        $request->validate([
            'search' => 'nullable|string|max:255',
            'category_id' => 'nullable|exists:categories,id',
            'subcategory_id' => 'nullable|exists:subcategories,id',
        ]);
        // Check if none of the search parameters are provided
        if (!$request->filled('search') && !$request->filled('category_id') && !$request->filled('subcategory_id')) {
            return redirect()->back()->withErrors(['search' => 'At least one search parameter is required.']);
        }
        $query = Product::query();
    
        if ($request->filled('search')) {
            $searchTerm = $request->input('search');
            $query->where('product_name', 'like', '%' . $searchTerm . '%');
        }
    
        if ($request->filled('category_id')) {
            $categoryID = $request->input('category_id');
            $query->where('category_id', $categoryID);
        }
    
        if ($request->filled('subcategory_id')) {
            $subcategoryID = $request->input('subcategory_id');
            $query->where('subcategory_id', $subcategoryID);
        }
    
        $products = $query->get();
    
        return view('user.usersearch', compact('products'));
    }
    
    public function dataview(Request $request)
    {
        $categories = Category::all();
        $subcategories = Subcategory::all();
        return view('user.usermain', compact('categories','subcategories'));
    }
    public function getSsubcategories(Request $request)
    {
        $category_id = $request->input('category_id');
        $subcategories = Subcategory::where('category_id', $category_id)->get();

        return response()->json($subcategories);
    }
    public function userProductFilter(Request $request)
    {
        $categoryId = $request->input('category');

        $query = Product::query();

        if ($categoryId) {
        $query->where('category_id', $categoryId);
        }

        $products = $query->get();
        $categories = Category::all();

        return view('user.productview', compact('products', 'categories'));
    }
    public function categoryProducts()
    {
        $categories = Category::with('products')->get();
        $subcategories = Subcategory::all();
        $products = Product::all();
        return view('user.usercollection', compact('products','categories','subcategories'));
    }

}
