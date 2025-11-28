@extends('template') 
@section('content')


@if ($errors != "")   
    <div class="error">
        {{$errors}}
    </div> 
@endif

<form action="" method="Post">
     @csrf
     <label>Nazwa Modelu</label>
     <input type="text" name="name" placeholder="Nazwa" value="{{$data['name']}}">
     <label>Opis Modelu</label>
     <textarea name="body">{{$data['body']}}</textarea>    
     <input type="hidden" value="1" name="save" />
     <input type="submit" value="Dodaj nowy model" />
    
</form>

@endsection('content')