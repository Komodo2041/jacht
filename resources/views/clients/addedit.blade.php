@extends('template') 
@section('content')


@if ($errors != "")   
    <div class="error">
        {{$errors}}
    </div> 
@endif

 

<form action="" method="Post">
     @csrf
     <label>Imię klienta</label>
     <input type="text" name="firstname" placeholder="Imię" value="{{$client->firstname}}"  >
 
     <label>Nazwisko klienta</label>
     <input type="text" name="lastname" placeholder="Nazwisko" value="{{$client->lastname}}"  >
    
     <label>Email</label>
     <input type="email" name="email" placeholder="Email" value="{{$client->email}}"  >
     
     <label>Telefon</label>
     <input type="text" name="phone" placeholder="Telefon" value="{{$client->phone}}"  >     

     <input type="hidden" value="1" name="save" />
     @if (isset($isedit) && $isedit)
         <input type="submit" value="Edytuj Klienta" />
     @else
         <input type="submit" value="Dodaj Klienta" />
     @endif
     
    
</form>

@endsection('content')