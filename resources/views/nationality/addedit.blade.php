@extends('template') 
@section('content')


@if ($errors != "")   
    <div class="error">
        {{$errors}}
    </div> 
@endif

 

<form action="" method="Post">
     @csrf
     <label>Nazwa kraju</label>
     <input type="text" name="name" placeholder="Nazwa" value="{{$country->name}}"  >
 

     <input type="hidden" value="1" name="save" />
     @if (isset($isedit) && $isedit)
         <input type="submit" value="Edytuj kraj" />
     @else
         <input type="submit" value="Dodaj kraj" />
     @endif
     
    
</form>

@endsection('content')