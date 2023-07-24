@extends('layouts.layout')
@section('title', 'Home')
@section('main_content')
    <link href="{{ asset('css/slider.css') }}" rel="stylesheet">
    <link href="{{ asset('css/itemPreview.css') }}" rel="stylesheet">
    <link href="{{ asset('css/basket.css') }}" rel="stylesheet">
    <div id="main-container" class="container mt-2 mb-2">
        <div class="row">
            <div class="col-md-5">
                <div id="ordering">
                    <div class="mb-2">
                        <h3 class="text-uppercase">ОФОРМЛЕННЯ ЗАМОВЛЕННЯ</h3>
                    </div>
                    <form action="/basket" method="post" class="border-top p-3" id="checkoutForm">
                        @csrf
                        <div class="form-floating mb-3">
                            <input type="phone" class="form-control" id="cart_input_phone" name="checkout[phone]" required>
                            <label for="cart_input_phone" class="form-label">Телефон<i>*</i>:</label>
                            <span>Невірно введений номер телефону</span>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" id="fio" name="checkout[name]">
                            <label for="fio" class="form-label">ПІБ<i>*</i>:</label>
                            <span>Невірно введена електронна адреса</span>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="email" class="form-control" id="checkout[email]" name="checkout[email]">
                            <label for="checkout[email]" class="form-label">Ел.пошта:</label>
                            <span>Невірно введена електронна адреса</span>
                        </div>
                        <input type="hidden" id="formData" name="formData" value="">
                        <button type="submit" hidden="hidden" id="submitButton"></button>
                    </form>
                </div>
            </div>

            <div class="col-md-7">
                <div class="title-underline mb-2 cg_menu_btn">
                    <h3 class="text-uppercase">КОШИК ПОКУПОК</h3>
                </div>
                <div id="products">
                    @foreach($items as $item)
                        <table class="table basket border-top" id="product-{{$item->id}}" data-content="{{$item->id}}">
                            <thead class="table-secondary">
                            <tr>
                                <th scope="col">Фото</th>
                                <th scope="col">Найменування товару</th>
                                <th scope="col">Кількість</th>
                                <th scope="col">Грн/шт.</th>
                                <th scope="col"></th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td>
                                    @if($item->images && count($item->images) > 0)
                                        @foreach($item->images as $image)
                                            <img src="data:{{ $image->image_type }};base64,{{ base64_encode($image->image) }}" class="w-100" alt="s">
                                        @endforeach
                                    @endif
                                </td>
                                <td>{{$item->name}}</td>
                                <td>
                                    <div class="input-group counter">
                                        <div class="input-group-prepend">
                                            <button class="btn btn-dark rounded-0" id="decrement">-</button>
                                        </div>
                                        <input type="number" class="form-control text-center" id="counter" name="counter" value="1" min="1">
                                        <div class="input-group-append">
                                            <button class="btn btn-dark rounded-0" id="increment">+</button>
                                        </div>
                                    </div>
                                </td>
                                <td class="td-price">
                                    {{$item->price}}
                                </td>
                                <td>
                                    <a href="/basket/remove/{{$item->id}}">X</a>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    @endforeach
                </div>

                <div class="text-end">
                    <b>Разом до сплати: </b><span id="totalPrice">100</span> грн
                </div>
            </div>
        </div>
        <div class="row bg-light p-4">
            <div class="col-md-6">
                <a href="#">Продовжити покупки</a>
            </div>
            <div class="col-md-6 text-end">
                <button type="submit" class="btn btn-dark rounded-0" id="submitOrderBtn">Оформити замовлення</button>
            </div>

        </div>
    </div>
    <script src="{{asset('js/basket.js')}}"></script>
@endsection

