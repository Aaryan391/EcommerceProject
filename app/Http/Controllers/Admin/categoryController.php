<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Subcategory;
use Illuminate\Http\Request;

class categoryController extends Controller
{
    function categoryview()
    {
        $categories = Category::all();
        return view('admin/category/category', compact('categories'));
    }
    // Store a new category
    public function storeCategory(Request $request)
    {
        $request->validate([
            'category_name' => 'required|string|max:255',
        ]);

        Category::create([
            'name' => $request->input('category_name'),
        ]);

        return redirect('/category')->with('message', 'Category update successfully');
    }

    // Store a new subcategory
    public function storeSubcategory(Request $request)
    {
        $request->validate([
            'subcategory_name' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
        ]);

        $subcategory = new Subcategory([
            'name' => $request->input('subcategory_name'),
        ]);

        // Associate the subcategory with the selected category
        $category = Category::find($request->input('category_id'));
        $category->subcategories()->save($subcategory);

        return redirect('/category')->with('message', 'SubCategory update successfully');
    }
    // Delete a category and its subcategories
    public function destroycategory(Category $category)
    {
        $category->subcategories()->delete(); // Delete associated subcategories
        $category->delete(); // Delete the category
        return redirect('/category')->with('message', 'Category and subcategories deleted successfully');
    }

    // Delete a subcategory individually
    public function destroySubcategory(Subcategory $subcategory)
    {
        $subcategory->delete();
        return redirect('/category')->with('message', 'Subcategory deleted successfully');
    }
    // Update category name
    public function updateCategory(Request $request, Category $category)
    {
        $request->validate([
            'edit_category_name' => 'required|string|max:255',
        ]);

        $category->update([
            'name' => $request->input('edit_category_name'),
        ]);

        return redirect('/category')->with('message', 'Category updated successfully');
    }

    // Update subcategory name
    public function updateSubcategory(Request $request, Category $category)
    {
        $request->validate([
            'edit_subcategory_name' => 'required|string|max:255',
        ]);

        $subcategory = Subcategory::findOrFail($request->input('subcategory_id'));
        $subcategory->update([
            'name' => $request->input('edit_subcategory_name'),
        ]);

        return redirect('/category')->with('message', 'Subcategory updated successfully');
    }
}
