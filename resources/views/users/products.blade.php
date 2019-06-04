@extends('layouts.main')
<style type="text/css">
	.img img{
		width: 15rem;
		height:250px;
		text-align: center;
	}
</style>

@section('content')
	<div class="row">
			<div class="col-3">
				<div class="filters ">
					<form method="GET" action="{{ route('catalog') }}">
						<div class="from-group text-center">
							<h4>Цена</h4>
							<input type="text" name="price" id="price" class="form-control" >
						</div>
						<div class="form-group">
							<h4>Единица измерения</h4>
							@foreach($uns as $unit)
							<label>{{$unit->units_title}}</label>
							<input type="checkbox" name="units[]" value="{{$unit->id}}"><br>
							@endforeach

						</div>
						<div class="form-group">
							<h4>Производители</h4>
							@foreach($mans as $man)
							<label>{{$man->manufacturer_title}}</label>
							<input type="checkbox" name="mans[]" value="{{$man->id}}"><br>
							@endforeach


						</div>
						<input type="submit" name="submit" class="btn btn-success text-center w-100" value="Найти">
					</form>
				</div>
			</div>
			<div class="col-9">
				<div class="products">
					@if ($error == '')
						@foreach($prods as $prod)
					<div class="card" style="width: 18rem;">
					  <div class="card-body">
					  	<div class="img" style="width: 100%;height: 250px;text-align: center;">
					  		<img src="{{ URL::asset('/img') }}/{{$prod->id}}.jpg">
					  	</div>
					    <h5 class="card-title">{{$prod->title}}</h5>
					    <h6 class="card-subtitle mb-2 text-muted">{{$prod->price}}</h6>
					    <p class="card-text">Описание: <strong>{{$prod->description}}</strong></p><br>
					    <p class="card-text">Категория: <strong>{{$prod->category_title}}</strong></p><br>
					    <p class="card-text">Производитель: <strong>{{$prod->manufacturer_title}}</strong></p><br>
					    <p class="card-text">Единицы измерения: <strong>{{$prod->units_title}}</strong></p><br>
					    @if (Session::has('auth'))
					    	<a href="{{ route('addToCart',$prod->id) }}" class="card-link">В корзину</a>
					    @else
					    	<a href="" class="card-link" onclick="alert('Вам нужно авторизоваться на сайте');return false">В корзину</a>
					    @endif
					    
					  </div>
					</div>
					@endforeach
					
					<div class="pagination">
						{{$prods->links()}}
		
					</div>
					@else 
					<h1 class="text-center">{{$error}}</h1>

					@endif
					
				</div>
			</div>
		</div>
@endsection