@extends('template') 
@section('content')
  
  <h4>Pracownik</h4>
  <div class="info">

     <label>Stanowisko</label>
     <div class="info">{{$crew->job->name}}</div>   

     <label>Status</label>
     <div class="info">{{$crew->status}}</div>       

     <label>Imię</label>
     <div class="info">{{$crew->firstname}}</div>
 
     <label>Nazwisko</label>
     <div class="info">{{$crew->lastname}}</div>

     <label>Email</label>
     <div class="info">{{$crew->email}}</div>     

     <label>Numer paszportu</label>
     <div class="info">{{$crew->passport_number}}</div>

     <label>Data urodzenia</label>
     <div class="info">{{$crew->birthday}}</div>     
 
     <label>Kraj</label>
     <div class="info">{{$crew->country->name}}</div>      
 
    <label>Notatki</label>
     <div>{{$crew->notes}}</div>  
</div>
@endsection('content')