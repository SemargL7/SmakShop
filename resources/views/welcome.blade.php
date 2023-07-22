@extends('layouts.layout')
@section('title', 'Home')
@section('main_content')
    <link href="{{ asset('css/slider.css') }}" rel="stylesheet">
    <link href="{{ asset('css/categoryPreview.css') }}" rel="stylesheet">
    <link href="{{ asset('css/itemPreview.css') }}" rel="stylesheet">
    <div id="main-container" class="container mt-2 mb-2">
        <div class="row">
            <div class="col-md-2 d-none d-md-block bg-light">

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
                    @foreach($preview_categories as $category)
                        <div class="slider-item category-preview-item slider-item-active">
                            <a class="row" href="/search?category={{$category->id}}">
                                <div class="col-md-6">
                                    @if($category->images && count($category->images) > 0)
                                        @foreach($category->images as $image)
                                            <img src="data:{{ $image->image_type }};base64,{{ base64_encode($image->image) }}" class="w-100" alt="s">
                                        @endforeach
                                    @endif
                                </div>
                                <div class="col-md-6 row">
                                    <div class="col-md-12">
                                        <b>{{$category->name}}</b>
                                    </div>
                                    <div class="col-md-12">
                                        Подивитися
                                    </div>

                                </div>
                            </a>

                        </div>
                    @endforeach

                </div>
                <button id="prevBtn" class="btn btn-dark" onclick="goToPrevSlide('categories-slider')">&lt;</button>
                <button id="nextBtn" class="btn btn-dark" onclick="goToNextSlide('categories-slider')">&gt;</button>
            </div>
        </div>


        <div class="mt-3 mb-3">
            <div class="text-center h2">
                Популярне
            </div>
            <div id="popular-slider" class="slider">
                <div class="slider-content">
                    @foreach($popular_items as $item)
                        <div class="slider-item item-preview row slider-item-active">
                            <a class="btn" href="/product/{{$item->id}}">
                            <div class="col-md-12">
                                @if($item->images && count($category->images) > 0)
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
                <button id="prevBtn" class="btn btn-dark" onclick="goToPrevSlide('popular-slider')">&lt;</button>
                <button id="nextBtn" class="btn btn-dark" onclick="goToNextSlide('popular-slider')">&gt;</button>
            </div>
        </div>

        <div class="mt-3 mb-3">
            <div class="text-center h2">
                Новинки
            </div>
            <div id="new-slider" class="slider">
                <div class="slider-content">
                    @foreach($newest_items as $item)
                        <div class="slider-item item-preview row slider-item-active">
                            <a class="btn" href="/product/{{$item->id}}">
                                <div class="col-md-12">
                                    @if($item->images && count($category->images) > 0)
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
                <button id="prevBtn" class="btn btn-dark" onclick="goToPrevSlide('new-slider')">&lt;</button>
                <button id="nextBtn" class="btn btn-dark" onclick="goToNextSlide('new-slider')">&gt;</button>
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
                                    @if($item->images && count($category->images) > 0)
                                        @foreach($item->images as $image)
                                            <img src="data:{{ $image->image_type }};base64,{{ base64_encode($image->image) }}" class="w-100" alt="s">
                                        @endforeach
                                        {{--                                    <img src="data:{{ $category->images->image_type }};base64,{{ base64_encode($category->images->image) }}" class="w-100" alt="s">--}}
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

        <div class="seo-content" data-wow-duration="2s">
            <div class="mb2">

                <span class="h3 text-uppercase" style="text-transform: uppercase;">про магазин</span>
            </div>
            <hr class="mb25">
            <div>
                <h1>Інтернет-магазин гаджетів SmakShop</h1>
                <p>
                    <span>
                        Зробіть своє життя комфортнішим, легшим і цікавішим, звернувшись в SmakShop - інтернет-магазин цікавих речей, Україна вже давно гідно оцінила високу якість наших товарів! Хочете припіднести незабутній подарунок або спростити повсякденні турботи, зробивши користування улюблених гаджетів функціональнішим і цікавішим? Ми допоможемо вам підібрати і купити аксесуари в інтернет-магазині зі зручними умовами доставки та оплати.
                        <span>
                        </span>
                    </span>
                </p>

                <h2>
                    SmakShop - місце, де живуть найцікавіші речі
                </h2>
                <p>
                    Гаджети давно стали частиною нашого життя. Вони застосовуються в усіх сферах діяльності людини. Можна спростити і максимізувати користь від їх експлуатації, якщо заглянути в онлайн-магазин аксесуарів в Україні і вибрати відмінне доповнення, що розкриває всі функції придбаного пристрою. На нашому сайті ви знайдете цікаві речі для різних життєвих ситуацій.
                </p>
                <ol>
                    <li>Оригінальні подарунки.
                    </li>
                </ol>
                <p>У цій категорії знайдуться найцікавіші презенти, які чудово підійдуть і для любителів новинок, і для досвідчених користувачів. Тут ви можете купити нічник проектор зоряного неба в Україні, незвичайні маятники, плеєри, ударну установку, навушники, тамагочі і багато інших корисних аксесуари і пристрої.</p>
                <ol start="2">
                    <li>Прикольні речі.</li>
                </ol>
                <p>
                    Створіть з їх допомогою чарівну атмосферу на вечірці, в колі друзів і родичів, подарувавши всім гарний настрій і позитивні спогади.
                </p>
                <ol start="3">
                    <li>Цікаві гаджети.</li>
                </ol>
                <p>Як тільки ви заглянете в наш каталог товарів, напевно, дуже вразитесь від думки, що якось могли існувати без всіх цих дивовижних і практичних пристосувань. Ознайомтеся з нашим каталогом кумедних речей, які скрасять ваше дозвілля і суттєво спростять життя.</p>
                <ol start="4">
                    <li>Аксесуари для кухні.</li>
                </ol>
                <p>Магазин незвичайних аксесуарів SmakShop пропонує придбати практичні пристосування: преси, ваги, термометри, зручні контейнери та інші корисні речі. Вони зроблять процес приготування їжі набагато цікавіше.</p>
                <ol start="5">
                    <li>Автомобільні аксесуари.</li>
                </ol>
                <p>В наявності цікаві аксесуари для гаджетів, призначені для використання в автомобілі, і безліч інших дивовижних речей.</p>
                <ol start="6">
                    <li>USB-гаджети.</li>
                </ol>
                <p>Використання даного інтерфейсу відбувається повсюдно. USB-роз'єм дозволяє підключати елементи до обчислювальної техніки або інших пристроїв. І в нашому каталозі знайдуться пристосування для удосконалення різних побутових завдань і спрощення їх роботи.</p>
                <ol start="7">
                    <li>Гаджети для смартфона.</li>
                </ol>
                <p>Вони дозволяють урізноманітнити його функції і навіть наділити новими можливостями. Влаштуйте справжній тюнінг для вашого смартфона, не витративши на це зайвих коштів.</p>
                <ol start="8">
                    <li>Іграшки-антистрес.</li>
                </ol>
                <p>Величезну популярність завоювали хитромудрі вироби, призначені для перенесення уваги на приємний і захоплюючий тригер. Підберіть для себе ідеальний варіант і тримайте під контролем емоції разом з особливими товарами з нашого інтернет-магазину дивовижних речей.</p>
                <br>
                <h2>
                    SmakShop - кращі аксесуари для гаджетів в Україні
                </h2>
                <p>
                    Процес підбору цікавого пристосування теж може бути дуже захоплюючим. Вивчайте особливі властивості і характеристики, представлені в інтернет-магазині аксесуарів і подарунків SmakShop. Якщо у вас виникли питання, щодо особливостей роботи пристрою, звертайтеся до наших менеджерів. Оптимізуйте і розширюйте межі можливого разом з інтернет-магазином цікавих речей в Україні SmakShop. Ми гарантуємо гідну якість, ввічливе, співчутливе консультування і допомогу в підборі подарунків для вас, ваших рідних і друзів.
                </p>
            </div>
        </div>

    </div>
    <script src="{{ asset('js/slider.js') }}"></script>
@endsection
