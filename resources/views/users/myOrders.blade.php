@extends('layouts.main')


@section('content')
<table class="table" id="showOrder">
  <thead>
     <tr>
      <th scope="col">Номер заказа</th>
      <th scope="col">Товар</th>
      <th scope="col">Статус</th>
      <th scope="col">Количество</th>
      <th scope="col">Цена</th>
    </tr>
 
   
  </thead>
  <tbody>
     @foreach ($ords as $ord)
     <tr>
      <th scope="row">{{$ord->order_number}}</th>
      <td>{{$ord->title}}</td>
      <td>{{$ord->status_title}}</td>
       <td>{{$ord->quantity}}</td>
      <td>{{$ord->total}}</td>
    </tr>
    @endforeach
    

  </tbody>
</table>

@endsection