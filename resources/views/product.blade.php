@extends('layouts.layout')
@section('title', 'Home')
@section('main_content')
    <link href="{{ asset('css/slider.css') }}" rel="stylesheet">
    <link href="{{ asset('css/product.css') }}" rel="stylesheet">
    <link href="{{ asset('css/itemPreview.css') }}" rel="stylesheet">
    <div id="main-container" class="container mt-2 mb-2">
        <div class="row">
            <div class="col-md-9 row">
                <div class="col-md-6 row">
                    <div class="col-md-3 text-center">
                        <button id="prevBtnProduct" class="btn btn-light w-100 rounded-0" onclick="goToPrevSlideProduct('detail-product-gallery')">&bigwedge;</button>
                        <div id="detail-product-gallery" class="slider">
                            <div class="detail-product-slider-content">
                                @foreach($item->images as $image)
                                    <div class="detail-product-slider-item row">
                                        <img src="data:{{ $image->image_type }};base64,{{ base64_encode($image->image) }}">
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        <button id="nextBtnProduct" class="btn btn-light w-100 rounded-0" onclick="goToNextSlideProduct('detail-product-gallery')">&bigvee;</button>
                    </div>
                    <div class="col-md-9">
                        <img src="" id="showImage" class="w-100">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="col-md-12 row pt-3 pb-3 product-price-info">
                        <div class="col">
                            <small>Ціна:</small>
                            <div class="h4"><span class="h1">{{$item->price}}</span>грн</div>
                        </div>
                        <div class="col">
                            <form action="/product/{{$item->id}}/addToBasket" method="get" class="h-100 w-100">
                                <button class="btn btn-dark w-100 h-100 rounded-0 m-0">
                                    Купити
                                </button>
                            </form>
                        </div>
                    </div>
                    <div class="col-md-12 row pt-2 pb-2">
                        <div class="col-md-6">В наявності</div>
                        <div class="col-md-6 text-end">Код: {{$item->code}}</div>
                    </div>
                    <div class="col-md-12 star-rating">{{$item->average_stars}}</div>
                </div>
            </div>
            <div class="col-md-3 row">
                <div class="col-md-12">
                    <div>
                        <a href="#">Доставка</a>
                    </div>
                    <div>
                        Нова пошта
                    </div>
                </div>
                <div class="col-md-12">
                    <div>
                        <a href="#">Оплата</a>
                    </div>
                    <div>
                        При отриманні посилки; Безготівковій розрахунок.
                    </div>
                </div>
                <div class="col-md-12">
                    <div>
                        <a href="#">Гарантія</a>
                    </div>
                    <div>
                        Обмін / повернення товару протягом 14 днів.
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-8">
                <div>
                    <h4>ОПИС</h4>
                    <div>
                        {!! $item->description !!}
                    </div>
                </div>
                <div>
                    <h4>ХАРАКТЕРИСТИКИ</h4>
                    <div>
                        <table class="table table-bordered">
                            <tbody>
                            @foreach($item->characteristics as $characteristic)
                                <tr>
                                    <td class="text-end">{{$characteristic->name}}</td>
                                    <td class="text-start">{{$characteristic->value}}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div>
                    <h4>ВІДГУКИ ПОКУПЦІВ</h4>
                    <div id="reviews" class="row">
                        @if($item->reviews)
                        @foreach($item->reviews as $review)
                            <div class="col-md-12 row reviews-item bg-light m-1 p-2">
                                <div class="col-md-12 row ">
                                    <div class="col-md-6"><b>{{$review->user_name}}</b></div>
                                    <div class="col-md-6 text-end star-rating">{{$review->stars}}</div>
                                </div>
                                <div class="col-md-12">
                                    <div class=""><b>Опис:</b></div>
                                    <div class="">{{$review->review}}</div>
                                </div>
                            </div>
                        @endforeach
                        @else
                            <h5>Немає відгуків</h5>
                        @endif
                    </div>
                </div>
                <div>
                    <h4>НАПИСАТИ ВІДГУК</h4>
                    <form action="/review/post" method="post">
                        @csrf
                        <input id="product_id" name="product_id" class="form-control rounded-0" required hidden="hidden" value="{{$item->id}}">
                        <div class="form-floating m-1">
                            <div id="feedback_star_rating" class="star-rating-feedback">0</div>
                            <input id="feedback_stars" name="feedback_stars" class="form-control rounded-0" required hidden="hidden">
                        </div>
                        <div class="form-floating m-1">
                            <input id="name" name="name" class="form-control rounded-0" required>
                            <label for="name">*Імя:</label>
                        </div>
                        <div class="form-floating m-1">
                            <input id="email" name="email" class="form-control rounded-0" required>
                            <label for="email" >*Почта:</label>
                        </div>
                        <div class="form-floating m-1">
                            <textarea id="feedback" name="feedback" class="form-control"></textarea>
                            <label for="feedback">*Текст:</label>
                        </div>
                        <button class="btn btn-dark rounded-0 m-1 float-end" type="submit">Залишити відгук</button>
                    </form>
                </div>
            </div>
        </div>

        <div class="mt-3 mb-3">
            <div class="text-center h2">
                ТАКОЖ ВАС МОЖУТЬ ЗАЦІКАВИТИ
            </div>
            <div id="interest-items-slider" class="slider">
                <div class="slider-content">
                    @foreach($interest_items as $item)
                        <div class="slider-item item-preview row slider-item-active">
                            <a class="btn" href="/product/{{$item->id}}">
                                <div class="col-md-12">
                                    @if($item->images && count($item->images) > 0)
                                        @foreach($item->images as $image)
                                            <img src="data:{{ $image->image_type }};base64,{{ base64_encode($image->image) }}" class="w-100" alt="s">
                                        @endforeach
                                    @else
                                        <img src="https://icons.iconarchive.com/icons/toma4025/rumax/256/camera-icon.png" alt="s">
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
                <button id="prevBtn" class="btn btn-dark" onclick="goToPrevSlide('interest-items-slider')">&lt;</button>
                <button id="nextBtn" class="btn btn-dark" onclick="goToNextSlide('interest-items-slider')">&gt;</button>
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
    </div>
    <script src="{{ asset('js/feedback.js') }}"></script>
    <script src="{{ asset('js/slider.js') }}"></script>
    <script src="{{ asset('js/product.js') }}"></script>
@endsection
