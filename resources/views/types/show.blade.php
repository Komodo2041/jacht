@extends('template') 
@section('content')
  
  <div class="info">
     <label>Typ jachtu</label>
     <div class="info">{{$type->name}}</div>
 
     <label>Główne cechy</label> 
     <div>{{$type->feature}}</div>

     <label>Liczba osób (typowa)</label> 
     <div>{{$type->number_of_people}}</div>

      <label>Trasy i warunki</label>
      <div>{{$type->routes}}</div> 

     <label>Koszty organizacji</label>
     <div>{{$type->organization_costs}}</div> 
 
     <label>Wymagania umiejętności i bezpieczeństwa</label>
     <div>{{$type->requirements}}</div> 
 
    <label>Aktywności i różnice w organizacji wycieczek</label>
     <div>{{$type->body}}</div>  
</div>
@endsection('content')