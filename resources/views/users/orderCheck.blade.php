@extends('layouts.main')


@section('content')
	<h1 class="text-center">
		Проверка заказа
	</h1>
  <form method="POST" action="{{ route('getOrder') }}">
    @csrf
  <div class="form-group">
    <label for="orderNum">Номер</label>
    <input type="number" class="form-control" id="orderNum"  placeholder="Введите номер заказа" name="orderNum">

  </div>
  <input type="submit" name="findOrder" value="Найти">

</form>



<script
  src="https://code.jquery.com/jquery-3.4.1.min.js"
  integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="
  crossorigin="anonymous"></script>

@endsection