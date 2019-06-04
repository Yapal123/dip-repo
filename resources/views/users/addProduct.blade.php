@extends('layouts.main')


@section('content')
@if (Session::get('message') != '')
  <p class="text-success">
    Успешно
  </p>
@endif
<form method="POST" action="{{ route('addHandle') }}" enctype="multipart/form-data">
  @csrf
  <div class="form-group">
    <label for="name">Название</label>
    <input type="text" class="form-control" id="name"  placeholder="Введите название" name="title" required>

  </div>
    <div class="form-group">
    <label for="img">Изображение</label>
    <input type="file" class="form-control" id="img"  name="img" required>

  </div>
    <div class="form-group">
    <label for="category">Категория</label>
    <select class="form-control" id="category" name="category" required>
      @foreach ($cats as $cat)
       <option value="{{$cat->id}}">{{$cat->category_title}}</option>
      @endforeach

    </select>
  </div>

  <div class="form-group">
    <label for="manufacturer">Производитель</label>
    <select class="form-control" id="manufacturer" name="manufacturer" required>
      @foreach ($mans as $man)
        <option value="{{$man->id}}">{{$man->manufacturer_title}}</option>
      @endforeach

    </select>
  </div>
  <div class="form-group">
    <label for="manufacturer">Ед. измерения</label>
    <select class="form-control" id="units" name="units" required>
      @foreach ($units as $unit)
        <option value="{{$unit->id}}">{{$unit->units_title}}</option>
      @endforeach
      

    </select>
  </div>
  <div class="form-group">
    <label for="desc">Описание</label>
    <input type="text" class="form-control" id="desc"  placeholder="Введите описание" name="descr" required>

  </div>
    <div class="form-group" required>
    <label for="price">Цена</label>
    <input type="text" class="form-control" id="price"  placeholder="Введите цену" name="price">

  </div>
  <input type="submit" name="add" class="btn btn-success" value="Добавить">
</form>

@endsection