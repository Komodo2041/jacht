@extends('template') 
@section('content')


@if (isset($errors) && $errors != "")   
    <div class="error">
        {{$errors}}
    </div> 
@endif

@if ($producer)
    <form action="" method="Post">
        @csrf
        <label>Nazwa Producenta</label>
        <input type="text" name="name" placeholder="Nazwa" value="{{$producer->name}}" >
        <label>Skala Produkcji</label>
        <textarea name="volume">{{$producer->volume}}</textarea>        
        <input type="hidden" value="1" name="save" />
        <input type="submit" value="Edytuj producenta" />    
    </form>
@else
    <div class="error">
        Nie znaleziono producenta
    </div> 
@endif

@endsection('content')