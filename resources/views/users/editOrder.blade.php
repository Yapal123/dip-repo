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
      <form action="{{ route('editStatus',$order->order_number) }}" method="POST">
        @csrf
       <td>
       {{$ord->status_title}}
       <select class="form-controll" name="status">
        @foreach ($statuses as $status)
         <option value="{{$status->id}}">{{$status->status_title}}</option>
        @endforeach
         
       </select>
    </td>
  
    </tr>
    @endforeach

  </tbody>
</table>
  <input type="submit" name="sub" value="Обновить" class="btn btn-success">
</form>
@endsection