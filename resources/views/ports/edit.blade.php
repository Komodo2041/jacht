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
        <input type="hidden" value="1" name="save" />
        <input type="submit" value="Edytuj port" />    
    </form>
@else
    <div class="error">
        Nie znaleziono portu
    </div> 
@endif

@endsection('content')