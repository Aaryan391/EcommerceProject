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
<div class="container mt-4">
    <div class="row">
        <div class="col-md-8 offset-md-2">

            <!-- Add Category Form Card -->
            <div class="card mb-4">
                <div class="card-body">
                    <h5 class="card-title mb-4">Add Category</h5>
                    <!-- Display success message if any -->
                    @if(session('message'))
                    <div class="alert alert-success">{{ session('message') }}</div>
                    @endif
                    <form action="{{ route('storeCategory') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="category_name">Category Name:</label>
                            <input type="text" class="form-control" id="category_name" name="category_name" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Add Category</button>
                    </form>
                </div>
            </div>

            <!-- Add Subcategory Form Card -->
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title mb-4">Add Subcategory</h5>
                    <form action="{{ route('storeSubcategory') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="subcategory_name">Subcategory Name:</label>
                            <input type="text" class="form-control" id="subcategory_name" name="subcategory_name" required>
                        </div>
                        <div class="form-group">
                            <label for="category_id">Select Category:</label>
                            <select class="form-control" id="category_id" name="category_id" required>
                                @foreach($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <button type="submit" class="btn btn-success">Add Subcategory</button>
                    </form>
                </div>
            </div>

            <!-- Display Categories and Subcategories in Card Style -->
            <div class="card mt-4 mb-4">
                <div class="card-body">
                    <h5 class="card-title mb-4">Categories and Subcategories</h5>

                    <!-- Display Categories Content -->
                    <h6 class="card-subtitle mb-2 text-muted">Categories:</h6>
                    <ul class="list-group">
                        @foreach($categories as $category)
                        <li class="list-group-item">
                            {{ $category->name }}
                            <div class="float-right">
                                <button type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#editCategoryModal{{ $category->id }}">Edit</button>
                                <form action="{{ route('deleteCategory', $category->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger ml-2">Delete</button>
                                </form>
                            </div>
                        </li>
                        @endforeach
                    </ul>

                    <!-- Display Subcategories Content -->
                    <h6 class="card-subtitle mt-4 mb-2 text-muted">Subcategories:</h6>
                    @foreach($categories as $category)
                        <div class="mb-3">
                            <strong>{{ $category->name }}</strong>:
                            <ul class="list-group">
                                @foreach($category->subcategories as $subcategory)
                                    <li class="list-group-item">
                                        {{ $subcategory->name }}
                                        <div class="float-right">
                                            <button type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#editSubcategoryModal{{ $subcategory->id }}">Edit</button>
                                            <form action="{{ route('deleteSubcategory', $subcategory->id) }}" method="POST" class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger ml-2">Delete</button>
                                            </form>
                                        </div>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    @endforeach
                </div>
            </div>

            <!-- Modals for Editing Category and Subcategory -->
            @foreach($categories as $category)
                <!-- Edit Category Modal -->
                <div class="modal" tabindex="-1" role="dialog" id="editCategoryModal{{ $category->id }}">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Edit Category</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form action="{{ route('updateCategory', $category->id) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <div class="form-group">
                                        <label for="edit_category_name">Category Name:</label>
                                        <input type="text" class="form-control" id="edit_category_name" name="edit_category_name" value="{{ $category->name }}" required>
                                    </div>
                                    <button type="submit" class="btn btn-primary">Save Changes</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Edit Subcategory Modal -->
                @foreach($category->subcategories as $subcategory)
                    <div class="modal" tabindex="-1" role="dialog" id="editSubcategoryModal{{ $subcategory->id }}">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Edit Subcategory</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <form action="{{ route('updateSubcategory', $subcategory->id) }}" method="POST">
                                        @csrf
                                        @method('PUT')
                                        <div class="form-group">
                                            <label for="edit_subcategory_name">Subcategory Name:</label>
                                            <input type="text" class="form-control" id="edit_subcategory_name" name="edit_subcategory_name" value="{{ $subcategory->name }}" required>
                                        </div>
                                        <button type="submit" class="btn btn-primary">Save Changes</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            @endforeach
        </div>
    </div>
</div>
@endsection
