@extends('template') 
@section('content')


@if (isset($errors) && $errors != "")   
    <div class="error">
        {{$errors}}
    </div> 
@endif

@if ($album)
    <form action="" method="Post">
        @csrf
        <label>Nazwa Albumu</label>
        <input type="text" name="name" placeholder="Nazwa" value="{{$album->name}}" >
        <label>Opis Albumu</label>
        <textarea name="body">{{$album->body}}</textarea>            
        <input type="hidden" value="1" name="save" />
        @if (isset($isedit))
           <input type="submit" value="Edytuj Album" />
        @else
           <input type="submit" value="Dodaj Album" />
        @endif   
    </form>
@else
    <div class="error">
        Nie znaleziono Albumu
    </div> 
@endif

@endsection('content')