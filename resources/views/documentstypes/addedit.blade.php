@extends('template') 
@section('content')


@if ($errors != "")   
    <div class="error">
        {{$errors}}
    </div> 
@endif

 

<form action="" method="Post">
     @csrf
     <label>Typ Dokumentu</label>
     <input type="text" name="name" placeholder="Nazwa" value="{{$type->name}}"  >
 

     <input type="hidden" value="1" name="save" />
     @if (isset($isedit) && $isedit)
         <input type="submit" value="Edytuj typ dokumentu" />
     @else
         <input type="submit" value="Dodaj nowy typ dokumentu" />
     @endif
     
    
</form>

@endsection('content')