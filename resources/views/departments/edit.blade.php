@extends('template') 
@section('content')


@if (isset($errors) && $errors != "")   
    <div class="error">
        {{$errors}}
    </div> 
@endif

@if ($dept)
    <form action="" method="Post">
        @csrf
        <label>Nazwa Departamentu</label>
        <input type="text" name="name" placeholder="Nazwa" value="{{$dept->name}}" >
        <input type="hidden" value="1" name="save" />
        <input type="submit" value="Edytuj departament" />    
    </form>
@else
    <div class="error">
        Nie znaleziono Departamentu
    </div> 
@endif

@endsection('content')