<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <link href="{{ asset('css/stars.css') }}" rel="stylesheet">
    <link href="{{ asset('css/categoriesBlock.css') }}" rel="stylesheet">
</head>
<body>
<nav class="navbar navbar-expand-lg border-bottom container">
    <div class="container-fluid">
        <a class="navbar-brand" href="/">SmakShop</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse w-100" id="navbarNavDropdown">
            <ul class="navbar-nav row w-100">
                <li class="nav-item col-md-5">
                    <ul>
                        <li>
                            <a class="nav-link p-0" href="#">Доставка і оплата</a>
                        </li>
                        <li>
                            <a class="nav-link p-0" href="#">Гарантії</a>
                        </li>
                        <li>
                            <a class="nav-link p-0" href="#">Про нас</a>
                        </li>
                        <li>
                            <a class="nav-link p-0" href="#">Контакти</a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item dropdown col-md-7">
                    <div class="row">
                        <div class="col-md-9">
                            <div class="row">
                                <ul class="col-md-6">
                                    <li>
                                        <a class="nav-link p-0" href="#">+380984041302</a>
                                    </li>
                                    <li>
                                        <a class="nav-link p-0" href="#">romandubil03@gmail.com</a>
                                    </li>
                                </ul>
                                <div class="col-md-6">

                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 text-center">
                            В кошику <span>0</span> товару
                            <a href="/basket" class="btn btn-dark w-100 rounded-0">Оформити заказ</a>
                        </div>
                    </div>
                </li>
            </ul>
        </div>
    </div>
</nav>
<div class="container">
    <form class="filter-search" action="/search" method="GET">
        <div class="row">
            <div class="col-md-2 p-0">
                <a class="btn btn-dark w-100 rounded-0 dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    Категорії
                </a>
                <ul class="dropdown-menu rounded-0" id="category-container">
                    <li><div id="categoriesBlock"></div></li>
                </ul>
            </div>
            <div class="col-md-8 p-0">
                <input class="form-control rounded-0 w-100" placeholder="Пошук на сайті" name="filter">
            </div>
            <div class="col-md-2 p-0">
                <button class="btn btn-dark rounded-0 w-100">Пошук</button>
            </div>
        </div>
    </form>

</div>

@yield('main_content')

<footer class="d-flex border-top bottom-0 container">
    <div class="row w-100">
        <div class="col-md-3 d-flex align-items-center">
            <a href="/" class="mb-3 me-2 mb-md-0 text-muted text-decoration-none lh-1">
                <svg class="bi" width="30" height="24"><use xlink:href="#bootstrap"></use></svg>
            </a>
            <span class="mb-3 mb-md-0">SmakShop</span>
        </div>
        <div class="col-md-3">
            <h5>Наші контакти:</h5>
            <ul>
                <li>
                    <a class="nav-link p-0" href="#">+380984041302</a>
                </li>
                <li>
                    <a class="nav-link p-0" href="#">romandubil03@gmail.com</a>
                </li>
            </ul>
        </div>
        <div class="col-md-3">
            <h5>Інформація:</h5>
            <ul>
                <li>
                    <a class="nav-link p-0" href="#">Монобанк</a>
                </li>
                <li>
                    <a class="nav-link p-0" href="#">Гарантії</a>
                </li>
                <li>
                    <a class="nav-link p-0" href="#">Про нас</a>
                </li>
                <li>
                    <a class="nav-link p-0" href="#">Контакти</a>
                </li>
            </ul>
        </div>
        <div class="col-md-3">
            <h5>Доставка і оплата:</h5>
            <ul>
                <li>
                    <a class="nav-link p-0" href="#">Visa</a>
                </li>
                <li>
                    <a class="nav-link p-0" href="#">Mastercard</a>
                </li>
                <li>
                    <a class="nav-link p-0" href="#">Новапочта</a>
                </li>
            </ul>
        </div>
    </div>

</footer>
<script src="{{ asset('js/getCategories.js') }}"></script>
<script src="{{ asset('js/reviewStars.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
</body>
</html>
