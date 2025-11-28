@extends('template') 
@section('content')


@if (isset($errors) && $errors != "")   
    <div class="error">
        {{$errors}}
    </div> 
@endif

@if ($model)
    <form action="" method="Post">
        @csrf
        <label>Nazwa Modelu</label>
        <input type="text" name="name" placeholder="Nazwa" value="{{$model->name}}" >
        <label>Opis Modelu</label>
        <textarea name="body">{{$model->body}}</textarea>            
        <input type="hidden" value="1" name="save" />
        <input type="submit" value="Edytuj model" />    
    </form>
@else
    <div class="error">
        Nie znaleziono modelu
    </div> 
@endif

@endsection('content')