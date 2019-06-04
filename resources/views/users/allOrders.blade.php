@extends('layouts.main')

@section('content')


<h1 class="text-center">
	Все заказы
</h1>


<table class="table" id="showOrder">
  <thead>
    <tr>
      <th scope="col">Номер заказа </th>
      <th scope="col">Кол-Во</th>
      <th scope="col">Всего</th>
      <th scope="col">Почта</th>
       <th scope="col">Название</th>
      <th scope="col">Статус</th>
      <th scope="col">Действие</th>

    </tr>
  </thead>
  <tbody>
    @foreach ($orders as $order)
      <tr>
      <th scope="row">{{$order->order_number}}</th>
      <td>{{$order->quantity}}</td>
      <td>{{$order->total}}р</td>
      <td>{{$order->email}}р</td>
      <?php
        $ords =  DB::table('orders')
        ->join('users','orders.profile_id','=','users.id')
        ->join('products','orders.product_id','=','products.id')
        ->join('statuses','orders.status_id','=','statuses.id')
        ->select('*')
        ->where('order_number',$order->order_number)
        ->get();
      ?>
      <td>
      @foreach ($ords as $ord)
       {{$ord->title}} 

      @endforeach
      </td>
       <td>
       {{$ord->status_title}}

    </td>
      <td>
<a href="{{ route('editOrder',$order->order_number) }}"><button class="btn btn-info">Редактировать</button></a>   <form method="POST" action="{{ route('deleteOrder',$order->order_number) }}"> @csrf<input type="submit" name="del" value="Удалить" class="btn btn-danger"></form>   
 </td>
    </tr>
    @endforeach

  </tbody>
</table>
@endsection