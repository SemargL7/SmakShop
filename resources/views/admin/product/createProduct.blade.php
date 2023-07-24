@extends('layouts.layout')
@section('title', 'Create Product')
@section('main_content')
    <div class="container">
        <div>
            <form action="/admin/product/create" method="post" enctype="multipart/form-data">
                @csrf
                <!-- Category Selector -->
                <div class="mb-3">
                    <label for="category_id" class="form-label">Category</label>
                    <select class="form-control" id="category_id" name="category_id" >
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

                <!-- Product Code -->
                <div class="mb-3">
                    <label for="code" class="form-label">Code</label>
                    <input type="number" class="form-control" id="code" name="code" required>
                </div>

                <!-- Product Description -->
                <div class="mb-3">
                    <label for="description" class="form-label">Description</label>
                    <textarea class="form-control" id="description" name="description" rows="5" required></textarea>
                </div>

                <!-- Product Price -->
                <div class="mb-3">
                    <label for="price" class="form-label">Price</label>
                    <input type="number" step="0.01" class="form-control" id="price" name="price" required>
                </div>

                <!-- Available Count -->
                <div class="mb-3">
                    <label for="count_available" class="form-label">Available Count</label>
                    <input type="number" class="form-control" id="count_available" name="count_available" required>
                </div>

                <!-- Total Count -->
                <div class="mb-3">
                    <label for="count_total" class="form-label">Total Count</label>
                    <input type="number" class="form-control" id="count_total" name="count_total" required>
                </div>

                <label for="characteristics">Characteristics</label>
                <div class="characteristics">
                    <div class="m-2">
                        <input type="text" name="characteristics[]" placeholder="Characteristic" class="form-control">
                        <input type="text" name="value[]" placeholder="Value" class="form-control">
                    </div>
                </div>
                <button id="addCharacteristicButton" class="btn btn-dark m-1" type="button">Add Characteristic</button>

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
    <script src="{{ asset('js/createProduct.js') }}"></script>
@endsection
