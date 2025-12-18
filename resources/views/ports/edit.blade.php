@extends('template') 
@section('content')


@if (isset($errors) && $errors != "")   
    <div class="error">
        {{$errors}}
    </div> 
@endif

@if ($port)
    <form action="" method="Post">
        @csrf
        <label>Nazwa Portu</label>
        <input type="text" name="name" placeholder="Nazwa" value="{{$port->name}}" >
     <label>Kraj</label>
       <select name="country_id">
          <option value="0">-</option>
        @foreach ($country AS $c)
          <option value="{{$c->id}}" @if ($port->country_id == $c->id) selected @endif>{{$c->name}}</option>
        @endforeach
        </select>

        <input type="hidden" value="1" name="save" />
        <input type="submit" value="Edytuj port" />    
    </form>
@else
    <div class="error">
        Nie znaleziono portu
    </div> 
@endif

@endsection('content')