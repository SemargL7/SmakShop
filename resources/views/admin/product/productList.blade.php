@extends('layouts.layout')
@section('title', 'Products')
@section('main_content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <a href="/admin/product/create">Create product</a>
            </div>
            <div>
                @foreach($items as $item)
                    <div class="card-body row bg-light p-1 mt-2 border">
                        <div class="row col-md-3">
                            @if($item->image)
                                <div class="col-md-12">
                                    <strong>Photo:</strong>
                                    {{ $item->image->path }}
                                </div>
                            @endif
                            <div class="col-md-12">
                                <strong>ID:</strong>
                                {{ $item->id }}
                            </div>
                            <div class="col-md-12">
                                <strong>Category ID:</strong>
                                {{ $item->category_id }}
                            </div>
                            <div class="col-md-12">
                                <strong>Name:</strong>
                                {{ $item->name }}
                            </div>
                        </div>
                        <div class="row col-md-3">
                            <div class="col-md-12">
                                <strong>Available:</strong>
                                {{ $item->count_available }}
                            </div>
                            <div class="col-md-12">
                                <strong>Total:</strong>
                                {{ $item->count_total }}
                            </div>
                            <div class="col-md-12">
                                <strong>Code:</strong>
                                {{ $item->code }}
                            </div>
                            <div class="col-md-12">
                                <strong>Price:</strong>
                                {{ $item->price }}
                            </div>
                        </div>
                        <div class="row col-md-3">


                            <div class="col-md-12">
                                <strong>Created At:</strong>
                                {{ $item->created_at }}
                            </div>
                            <div class="col-md-12">
                                <strong>Updated At:</strong>
                                {{ $item->updated_at }}
                            </div>
                        </div>
                        <div class="row col-md-3">
                            <div class="col-md-12">
                                <a href="/admin/product/edit/{{$item->id}}" class="btn btn-dark rounded-0 w-100">Edit</a>
                            </div>
                            <div class="col-md-12">
                                <a href="/admin/product/delete/{{$item->id}}" class="btn btn-dark rounded-0 w-100">Delete</a>
                            </div>
                        </div>
                    </div>

                @endforeach
            </div>

            {{ $items->links() }}
        </div>
    </div>
@endsection
