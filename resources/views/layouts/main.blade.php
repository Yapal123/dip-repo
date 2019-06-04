<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" type="text/css" href="{{ URL::asset('/css/app.css') }}">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <title>Eccommerce</title>
  </head>
  <body>
    
  	<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <a class="navbar-brand" href="/">Каталог</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item ">
        <a class="nav-link" href="{{ route('cart') }}">Корзина(
          <?php if (!empty(session('cart'))):?>
          <?php echo count(session('cart')); ?>
        <?php else: ?> 
        0 
        <?php endif ?>
          ) <span class="sr-only">(current)</span></a>
      </li>
       <li class="nav-item ">
        <a class="nav-link" href="{{route('checkOrder')}}">Проверить заказ <span class="sr-only">(current)</span></a>
      </li>
      @if (Session::get('role') > 1)
              <li class="nav-item ">
        <a class="nav-link" href="{{ route('allOrders') }}">Все заказы <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item ">
        <a class="nav-link" href="{{ route('addProduct') }}">Добавить товар<span class="sr-only">(current)</span></a>
      </li>
      @endif

      @if (!Session::has('auth'))
          <li class="nav-item ">
        <a class="nav-link" href="{{ route('log') }}">Войти<span class="sr-only">(current)</span></a>
      </li>
    <li class="nav-item ">
        <a class="nav-link" href="{{ route('reg') }}">Зарегистрироваться<span class="sr-only">(current)</span></a>
      </li>
      @else
                <li class="nav-item ">
        <a class="nav-link" href="{{ route('myOrders') }}">Мои заказы<span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item ">
        <a class="nav-link" href="{{ route('logout') }}">Выйти<span class="sr-only">(current)</span></a>
      </li>
      @endif
     
    </ul>

  </div>
</nav>
<div class="content">
	<div class="container-fluid">
		@yield('content')
	</div>
</div>










    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script
  src="https://code.jquery.com/jquery-3.4.1.min.js"
  integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="
  crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

  </body>
</html>