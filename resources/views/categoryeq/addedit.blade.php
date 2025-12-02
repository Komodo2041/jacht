@extends('template') 
@section('content')


@if ($errors != "")   
    <div class="error">
        {{$errors}}
    </div> 
@endif

 
<form action="" method="Post">
     @csrf
     <label>Nazwa Kategorii</label>
     <input type="text" name="name" placeholder="Nazwa" value="{{$category->name}}"  >
  
    <label>Opis</label>
    <textarea name="body">{{$category->body}}</textarea>

     <input type="hidden" value="1" name="save" />
     @if (isset($isedit) && $isedit)
         <input type="submit" value="Edytuj kategorię" />
     @else
         <input type="submit" value="Dodaj nową kategorię" />
     @endif
     
    
</form>

@endsection('content')