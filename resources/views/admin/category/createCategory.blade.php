@extends('layouts.layout')
@section('title', 'Create Category')
@section('main_content')
    <div class="container">
        <div>
            <form action="/admin/category/create" method="post" enctype="multipart/form-data">
                @csrf
                <!-- Category Selector -->
                <div class="mb-3">
                    <label for="category_id" class="form-label">Category</label>
                    <select class="form-control" id="category_id" name="category_id">
                        <option value="" selected disabled>Select Category</option>
                        @foreach($categories as $category)
                            <option value="{{$category->id}}">{{$category->name}}</option>
                        @endforeach
                    </select>
                </div>

                <!-- Product Name -->
                <div class="mb-3">
                    <label for="name" class="form-label">Name</label>
                    <input type="text" class="form-control" id="name" name="name" required>
                </div>

                <!-- Product Images -->
                <div>
                    <label for="image">Images</label>
                    <input type="file" class="form-control-file" multiple name="image[]" id="image">
                </div>

                <!-- Submit Button -->
                <button type="submit" class="btn btn-primary">Add Product</button>
            </form>
        </div>
    </div>
@endsection
