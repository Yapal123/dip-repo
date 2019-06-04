@extends('layouts.main')


@section('content')
@if (Session::has('error'))
	<p>
		Неверный логин или пароль
	</p>
@endif
<form method="POST" action="{{ route('logHandle') }}">
@csrf

  <div class="form-group">
    <label for="login">Логин</label>
    <input type="text" class="form-control" id="login"  placeholder="Введите логин" name="login">

  </div>
    <div class="form-group">
    <label for="password">Пароль</label>
    <input type="password" class="form-control" id="password"  placeholder="Введите пароль" name="password">

  </div>
  <input type="submit" name="log" value="Войти" class="btn btn-success">
</form>
@endsection