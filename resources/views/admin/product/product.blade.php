@extends('admin.layouts.adminmain')
@section('content')
<style>
    body{
        background-color: #495057;
    }
    ::-webkit-scrollbar{
        display: none;
    }
</style>
<div class="container mt-5 mb-4">
    @if(session('message'))
    <div class="alert alert-success">{{ session('message') }}</div>
    @endif
    <div class="card">
        <div class="card-header">
            <h5 class="mb-0">Add New Product</h5>
        </div>
        <div class="card-body">
            <form action="{{ route('products.store') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label for="product_name">Product Name</label>
                    <input type="text" class="form-control" id="product_name" name="product_name" required>
                </div>
                <div class="form-group">
                    <label for="product_description">Product Description</label>
                    <textarea class="form-control" id="product_description" name="product_description" rows="3" required></textarea>
                </div>
                <div class="form-group">
                    <label for="price">Price</label>
                    <input type="number" class="form-control" id="price" name="price" required>
                </div>
                <div class="form-group">
                    <label for="color">Color</label>
                    <input type="text" class="form-control" id="color" name="color">
                </div>
                <div class="form-group">
                    <label for="uniqueness">Uniqueness</label>
                    <input type="text" class="form-control" id="uniqueness" name="uniqueness">
                </div>
                <div class="form-group">
                    <label for="stock">Stock</label>
                    <input type="number" class="form-control" id="stock" name="stock" required>
                </div>
                <div class="form-group">
                    <label for="category_id">Category</label>
                    <select class="form-control" id="category_id" name="category_id" required>
                        {{-- Display categories from your database --}}
                        @foreach($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="subcategory_id">Subcategory</label>
                    <select class="form-control" id="subcategory_id" name="subcategory_id" required>
                        {{-- Display subcategories based on the selected category --}}
                        {{-- This will be populated dynamically using JavaScript --}}
                    </select>
                </div>
                <div class="form-group">
                    <label for="replace_image">Replace Image</label>
                    <input type="checkbox" id="replace_image">
                </div>
                <div class="form-group" id="new_image_field" style="display: none;">
                    <label for="product_image">New Product Image</label>
                    <input type="file" class="form-control-file" id="product_image" name="product_image">
                </div>
                <button type="submit" class="btn btn-primary">Add Product</button>
            </form>
        </div>
    </div>
</div>

<!-- Display Added Products Card -->
<div class="card mt-4 mb-2">
    <div class="card-header">
        <h5 class="mb-0">Added Products</h5>
    </div>
    <div class="card-body">
        <div class="row">
            @foreach($products as $product)
            <div class="col-lg-4 col-md-6 mb-4">
                <div class="card">
                    <img src="{{ url('storage/' . $product->product_image) }}" class="card-img-top" alt="">
                    <div class="card-body">
                        <h5 class="card-title">{{ $product->product_name }}</h5>
                        <p class="card-text">{{ $product->product_description }}</p>
                        <p class="card-text">Price: ${{ $product->price }}</p>
                        <!-- Add more details as needed -->
                        <p class="card-text">Category: {{ $product->category->name }}</p>
                        <p class="card-text">Subcategory: {{ $product->subcategory->name }}</p>
                        <p class="card-text">stock: {{ $product->stock }}</p>
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="btn-group">
                                <!-- Edit button linking to edit route -->
                                <button type="button" class="btn btn-sm btn-outline-secondary" data-toggle="modal" data-target="#editProductModal{{ $product->id }}">Edit</button>
                                <!-- Delete button triggering a confirmation modal or form -->
                                <form action="{{ route('deleteproduct', $product->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger ml-2">Delete</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Edit Product Modal -->
            <div class="modal" tabindex="-1" role="dialog" id="editProductModal{{ $product->id }}">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Edit Product</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <!-- Edit Product Form -->
                            <form action="{{ route('updateproduct', $product->id) }}" method="post" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')

                                <!-- Include your form fields here with names prefixed with "edit_" -->
                                <div class="form-group">
                                    <label for="edit_product_name">Product Name</label>
                                    <input type="text" class="form-control" id="edit_product_name" name="edit_product_name" value="{{ $product->product_name }}" required>
                                </div>
                                <div class="form-group">
                                    <label for="edit_product_description">Product Description</label>
                                    <textarea class="form-control" id="edit_product_description" name="edit_product_description" rows="3" required>{{ $product->product_description }}</textarea>
                                </div>
                                <div class="form-group">
                                    <label for="edit_price">Price</label>
                                    <input type="text" class="form-control" id="edit_price" name="edit_price" value="{{ $product->price }}" required>
                                </div>
                                <div class="form-group">
                                    <label for="edit_color">Color</label>
                                    <input type="text" class="form-control" id="edit_color" name="edit_color" value="{{ $product->color }}">
                                </div>
                                <div class="form-group">
                                    <label for="edit_uniqueness">Uniqueness</label>
                                    <input type="text" class="form-control" id="edit_uniqueness" name="edit_uniqueness" value="{{ $product->uniqueness }}">
                                </div>
                                <div class="form-group">
                                    <label for="edit_stock">Stock</label>
                                    <input type="number" class="form-control" id="edit_stock" name="edit_stock" value="{{ $product->stock }}" required>
                                </div>
                                <div class="form-group">
                                    <label for="edit_category_id">Category</label>
                                    <select class="form-control" id="edit_category_id" name="edit_category_id" required>
                                        {{-- Display categories from your database --}}
                                        @foreach($categories as $category)
                                        <option value="{{ $category->id }}" @if($category->id == $product->category_id) selected @endif>{{ $category->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="edit_subcategory_id">Subcategory</label>
                                    <select class="form-control" id="edit_subcategory_id" name="edit_subcategory_id" required>
                                        {{-- Display subcategories based on the selected category --}}
                                        @foreach($subcategories as $subcategory)
                                        <option value="{{ $subcategory->id }}" @if($subcategory->id == $product->subcategory_id) selected @endif>{{ $subcategory->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="edit_replace_image">Replace Image</label>
                                    <input type="checkbox" id="edit_replace_image">
                                </div>
                                <div class="form-group" id="edit_new_image_field" style="display: none;">
                                    <label for="edit_product_image">New Product Image</label>
                                    <input type="file" class="form-control-file" id="edit_product_image" name="edit_product_image">
                                </div>
                                <button type="submit" class="btn btn-primary">Save Changes</button>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>

<!-- JavaScript to toggle the visibility of the new image field based on the checkbox state -->
<script>
// JavaScript to toggle the visibility of the new image field based on the checkbox state
document.getElementById('replace_image').addEventListener('change', function () {
    document.getElementById('new_image_field').style.display = this.checked ? 'block' : 'none';
});

// For the edit modal
document.getElementById('edit_replace_image').addEventListener('change', function () {
    document.getElementById('edit_new_image_field').style.display = this.checked ? 'block' : 'none';
});

// AJAX to fetch and update subcategories based on the selected category
document.getElementById('category_id').addEventListener('change', function () {
    var categoryId = this.value;

    // Make an AJAX request to fetch subcategories
    fetch('/get-subcategories?category_id=' + categoryId)
        .then(response => response.json())
        .then(data => {
            // Update the subcategory dropdown options
            var subcategoryDropdown = document.getElementById('subcategory_id');
            subcategoryDropdown.innerHTML = '';

            data.forEach(subcategory => {
                var option = document.createElement('option');
                option.value = subcategory.id;
                option.text = subcategory.name;
                subcategoryDropdown.appendChild(option);
            });
        })
        .catch(error => console.error('Error:', error));
});

</script>

@endsection
