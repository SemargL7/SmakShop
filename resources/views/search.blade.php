@extends('layouts.layout')
@section('title', 'Home')
@section('main_content')
    <link href="{{ asset('css/slider.css') }}" rel="stylesheet">
    <link href="{{ asset('css/itemPreview.css') }}" rel="stylesheet">
    <link href="{{ asset('css/paramBlock.css') }}" rel="stylesheet">
    <link href="{{ asset('css/stars.css') }}" rel="stylesheet">
    <div id="main-container" class="container mt-2 mb-2">
        <div class="row">
            <div class="col-md-2">
                <div class="pt-2 pb-2 mt-2 mb-2 border-0 border-top border-bottom">
                    <h5>Ціна:</h5>
                    <form class="filter-search">
                        <div class="row">
                            <input placeholder="від" class="form-control rounded-0 col" name="price_from">
                            <input placeholder="до" class="form-control rounded-0 col" name="price_to">
                            <button type="submit" class="btn btn-dark rounded-0 col">ок</button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-md-10">
                <div>
                    <h1>
                        Search
                    </h1>
                </div>
                <div class="row">
                    <div class="col" id="blocks-container"></div>
                    <div class="col-md-3 justify-content-end">
                        <select class="form-select rounded-0" aria-label="Default select example">
                            <option selected>Open this select menu</option>
                            <option value="1">One</option>
                            <option value="2">Two</option>
                            <option value="3">Three</option>
                        </select>
                    </div>
                </div>
                <div id='itemsContainer' class="row">
                    <div class="col">
                        <div class="item-preview row">
                            <div class="col-md-12">
                                <img src="https://icons.iconarchive.com/icons/toma4025/rumax/256/camera-icon.png" alt="s">
                            </div>
                            <div class="col-md-12 row text-center mx-auto">
                                <div class="col-md-12">
                                    <b>Name of item</b>
                                </div>
                                <div class="col-md-12">
                                    <b>Price</b>
                                    <span>300.00</span>
                                </div>
                                <div class="col-md-12">
                                    <a class="btn btn-dark w-100 rounded-0">Buy</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @if($lookedItems)
            <div class="mt-3 mb-3">
                <div class="text-center h2">
                    Недавно переглянуті
                </div>
                <div id="looked-items-slider" class="slider">
                    <div class="slider-content">
                        @foreach($lookedItems as $item)
                            <div class="slider-item item-preview row slider-item-active">
                                <a class="btn" href="/product/{{$item->id}}">
                                    <div class="col-md-12">
                                        @if($item->images && count($item->images) > 0)
                                            @foreach($item->images as $image)
                                                <img src="data:{{ $image->image_type }};base64,{{ base64_encode($image->image) }}" class="w-100" alt="s">
                                            @endforeach
                                        @endif
                                    </div>
                                    <div class="col-md-12 row text-center mx-auto">
                                        <div class="col-md-12">
                                            <b>{{$item->name}}</b>
                                        </div>
                                        <div class="col-md-12">
                                            <b>Ціна: </b>
                                            <span>{{$item->price}}</span>
                                        </div>
                                        <div class="col-md-12 star-rating">{{$item->average_stars}}</div>
                                        <div class="col-md-12">
                                            <button class="btn btn-dark w-100 rounded-0">Купити</button>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        @endforeach
                    </div>
                    <button id="prevBtn" class="btn btn-dark" onclick="goToPrevSlide('looked-items-slider')">&lt;</button>
                    <button id="nextBtn" class="btn btn-dark" onclick="goToNextSlide('looked-items-slider')">&gt;</button>
                </div>
            </div>
        @endif
        <script src="{{ asset('js/search.js') }}"></script>
        <script src="{{asset('js/slider.js')}}"></script>
@endsection
