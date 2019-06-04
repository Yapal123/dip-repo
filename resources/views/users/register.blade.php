@extends('layouts.main')


@section('content')
@if (Session::get('error') == 1)
  <p class="text-center text-danger">
    Такой логин уже существует
  </p>
@endif
@if (Session::get('error') == 2)
  <p class="text-center text-success">
    Вы успешно зарегистрировались, теперь вы можете войти.
  </p>
@endif
<form method="POST" action="{{ route('regHandle') }}">
	@csrf
  <div class="form-group">
    <label for="login">Логин</label>
    <input type="text" class="form-control" id="login"  placeholder="Введите логин" name="login">

  </div>
    <div class="form-group">
    <label for="email">Email</label>
    <input type="email" class="form-control" id="email"  placeholder="Введите email" name="email">

  </div>
      <div class="form-group">
    <label for="fullName">ФИО</label>
    <input type="text" class="form-control" id="fullName"  placeholder="Введите ФИО" name="fullName">

  </div>
  <div class="form-group">
    <label for="bday">Дата рождения</label>
    <input type="text" class="form-control" id="bday"  placeholder="Введите дату рождения" name="bday">

  </div>
    <div class="form-group">
    <label for="city">Город</label>
    <input type="text" class="form-control" id="city"  placeholder="Введите дату город" name="city">

  </div>
    <div class="form-group">
    <label for="city">Улица</label>
    <input type="text" class="form-control" id="street"  placeholder="Введите улицу" name="street">

  </div>
    <div class="form-group">
    <label for="phone">Телефон</label>
    <input type="text" class="form-control" id="phone"  placeholder="Введите телефон" name="phone">

  </div>
    <div class="form-group">
    <label for="password">Пароль</label>
    <input type="password" class="form-control" id="password"  placeholder="Введите пароль" name="password">

  </div>
  <input type="submit" name="reg" value="Зарегистрироваться" class="btn btn-success">
</form>
@endsection