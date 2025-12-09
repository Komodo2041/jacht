@extends('template') 
@section('content')


@if ($errors != "")   
    <div class="error">
        {{$errors}}
    </div> 
@endif

 

<form action="" method="Post">
     @csrf
     <label>Nazwa</label>
     <input type="text" name="name" placeholder="Nazwa" value="{{$param->name}}"  >
 
     <label>Jednostka</label>
     <input type="text" name="unit" placeholder="Jednostka"  value="{{$param->unit}}" >
 

     <input type="hidden" value="1" name="save" />
     @if (isset($isedit) && $isedit)
         <input type="submit" value="Edytuj parametr" />
     @else
         <input type="submit" value="Dodaj nowy parametr" />
     @endif
     
    
</form>

@endsection('content')