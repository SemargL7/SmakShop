@extends('layouts.layout')
@section('title', 'Home')
@section('main_content')
    <link href="{{ asset('css/slider.css') }}" rel="stylesheet">
    <link href="{{ asset('css/categoryPreview.css') }}" rel="stylesheet">
    <div id="main-container" class="container">
        <div class="row">
            <div class="col-md-2">
            </div>
            <div class="col-md-10">
                <div id="slider_advantages" class="carousel slide">
                    <div class="carousel-indicators">
                        <button type="button" data-bs-target="#slider_advantages" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                        <button type="button" data-bs-target="#slider_advantages" data-bs-slide-to="1" aria-label="Slide 2"></button>
                        <button type="button" data-bs-target="#slider_advantages" data-bs-slide-to="2" aria-label="Slide 3"></button>
                    </div>
                    <div class="carousel-inner">
                        <div class="carousel-item active">
                            <img src="http://www.icheck.co.nz/wp-content/uploads/2013/10/1000x500.gif" class="d-block w-100" alt="...">
                        </div>
                        <div class="carousel-item">
                            <img src="http://www.icheck.co.nz/wp-content/uploads/2013/10/1000x500.gif" class="d-block w-100" alt="...">
                        </div>
                        <div class="carousel-item">
                            <img src="http://www.icheck.co.nz/wp-content/uploads/2013/10/1000x500.gif" class="d-block w-100" alt="...">
                        </div>
                    </div>
                    <button class="carousel-control-prev" type="button" data-bs-target="#slider_advantages" data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#slider_advantages" data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                    </button>
                </div>
            </div>
        </div>

        <div class="mt-3 mb-3">
            <div class="text-center h2">
                Категорії
            </div>
            <div id="categories-slider" class="slider">
                <div class="slider-content">
                    <div class="slider-item row category-preview-item slider-item-active">
                        <div class="col-md-6">
                            <img src="https://icons.iconarchive.com/icons/toma4025/rumax/256/camera-icon.png" class="w-100" alt="s">
                        </div>
                        <div class="col-md-6 row">
                            <div class="col-md-12">
                                <b>Name of item</b>
                            </div>
                            <div class="col-md-12">
                                Buy
                            </div>
                        </div>
                    </div>
                    <div class="slider-item category-preview-item row">
                        <div class="col-md-6">
                            <img src="https://icons.iconarchive.com/icons/toma4025/rumax/256/camera-icon.png" class="w-100" alt="s">
                        </div>
                        <div class="col-md-6 row">
                            <div class="col-md-12">
                                <b>Name of item</b>
                            </div>
                            <div class="col-md-12">
                                Buy
                            </div>
                        </div>
                    </div>
                    <div class="slider-item category-preview-item row">
                        <div class="col-md-6">
                            <img src="https://icons.iconarchive.com/icons/toma4025/rumax/256/camera-icon.png" class="w-100" alt="s">
                        </div>
                        <div class="col-md-6 row">
                            <div class="col-md-12">
                                <b>Name of item</b>
                            </div>
                            <div class="col-md-12">
                                Buy
                            </div>
                        </div>
                    </div>
                    <div class="slider-item category-preview-item row">
                        <div class="col-md-6">
                            <img src="https://icons.iconarchive.com/icons/toma4025/rumax/256/camera-icon.png" class="w-100" alt="s">
                        </div>
                        <div class="col-md-6 row">
                            <div class="col-md-12">
                                <b>Name of item</b>
                            </div>
                            <div class="col-md-12">
                                Buy
                            </div>
                        </div>
                    </div>
                </div>
                <button id="prevBtn" class="btn btn-dark" onclick="goToPrevSlide('categories-slider')">&lt;</button>
                <button id="nextBtn" class="btn btn-dark" onclick="goToNextSlide('categories-slider')">&gt;</button>
            </div>
        </div>






    </div>
    <script src="{{ asset('js/slider.js') }}"></script>
@endsection
