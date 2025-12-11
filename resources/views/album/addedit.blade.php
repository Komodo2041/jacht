@extends('template') 
@section('content')


@if ($errors != "")   
    <div class="error">
        {{$errors}}
    </div> 
@endif

 

<form action="" method="Post" enctype='multipart/form-data'>
     @csrf
     <label>Nazwa</label>
     <input type="text" name="name" placeholder="Nazwa" value="{{$image->title}}"  >
    
    <label>Opis</label>
    <textarea name="description">{{$image->description}}</textarea>
    @if (!isset($isedit))
        <label>Zdjęcie</label>
        <input type="file" name="file" accept=".png, .jpg">
    @endif

     <input type="hidden" value="1" name="save" />
     @if (isset($isedit) && $isedit)
         <input type="submit" value="Edytuj zdjęcie" />
     @else
         <input type="submit" value="Dodaj nowe zdjęcie" />
     @endif
     
    
</form>

@endsection('content')