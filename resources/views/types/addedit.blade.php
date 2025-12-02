@extends('template') 
@section('content')


@if ($errors != "")   
    <div class="error">
        {{$errors}}
    </div> 
@endif

 

<form action="" method="Post">
     @csrf
     <label>Typ jachtu</label>
     <input type="text" name="name" placeholder="Nazwa" value="{{$type->name}}"  >
 
     <label>Główne cechy</label>
     <input type="text" name="feature" placeholder="Główne cechy"  value="{{$type->feature}}" >

     <label>Liczba osób (typowa)</label>
     <input type="text" name="number_of_people" placeholder="Liczba osób (typowa)" value="{{$type->number_of_people}}" >

    <label>Trasy i warunki</label>
     <input type="text" name="routes" placeholder="Trasy i warunki" value="{{$type->routes}}" >

     <label>Koszty organizacji</label>
     <input type="text" name="organization_costs" placeholder="Koszty organizacji" value="{{$type->organization_costs}}" >

     <label>Wymagania umiejętności i bezpieczeństwa</label>
     <input type="text" name="requirements" placeholder="Wymagania umiejętności i bezpieczeństwa" value="{{$type->requirements}}" >

    <label>Aktywności i różnice w organizacji wycieczek</label>
    <textarea name="body">{{$type->body}}</textarea>

     <input type="hidden" value="1" name="save" />
     @if (isset($isedit) && $isedit)
         <input type="submit" value="Edytuj typ" />
     @else
         <input type="submit" value="Dodaj nowy typ" />
     @endif
     
    
</form>

@endsection('content')