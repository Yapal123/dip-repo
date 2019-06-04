@extends('layouts.main')


@section('content')
 @if (!empty(Session::get('cart')))
      <table class="table">
  <thead>
    <tr>
      <th scope="col">Название </th>
      <th scope="col">Категория</th>
      <th scope="col">Производитель</th>
      <th scope="col">Количеcтво</th>
      <th scope="col">Цена</th>
      <th scope="col">Действие</th>
    </tr>
  </thead>
  <tbody>
   
    @foreach (session('cart') as $prod => $details)
    <tr>
      <td>{{$details['title']}}</td>
      <td>{{$details['category']}}</td>
      <td>{{$details['manufacturer']}}</td>
      <td>
      <input type="" name="quantity" id="quantity" value="{{$details['quantity']}}" class="quantity">
    </td>
      <td>{{$details['price'] }}</td>
      <td class="actions" data-th="" >
        <button  data-id="{{ $prod }}" class="update-cart">
                
                  Обновить
                
              </button>
              <button  class="remove-from-cart" data-id="{{ $prod }}">
                
                  Убрать
                
            </button>
      </td>
    </tr>
    @endforeach
    

 

  </tbody>
</table>
<a href="{{ route('createOrder') }}">Оформить покупку</a>

    @else
    <h2 class="text-center">Корзина пуста</h2>
    @endif

<script
  src="https://code.jquery.com/jquery-3.4.1.min.js"
  integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="
  crossorigin="anonymous"></script>
<script type="text/javascript">
 
        $(".update-cart").click(function (e) {
           e.preventDefault();
 
           var ele = $(this);
 
            $.ajax({
               url: '{{ url('update-cart') }}',
               method: "patch",
               data: {_token: '{{ csrf_token() }}', id: ele.attr("data-id"), quantity: ele.parents("tr").find(".quantity").val()},
               success: function (response) {
                   window.location.reload();
               }
            });
        });
 
        $(".remove-from-cart").click(function (e) {
            e.preventDefault();
 
            var ele = $(this);
 
            if(confirm("Вы уверены?")) {
                $.ajax({
                    url: '{{ url('remove-from-cart') }}',
                    method: "DELETE",
                    data: {_token: '{{ csrf_token() }}', id: ele.attr("data-id")},
                    success: function (response) {
                        window.location.reload();
                    }
                });
            }
        });
 
    </script>
@endsection