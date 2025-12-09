@extends('template')

@section('content')
    
 

   <h2>Jacht {{$yacht->name}} - Parametry</h2>




   <a href="/yachts/parametrschange/{{$yacht->id}}" class="secondary">Zmień dodatkowe paramtry</a>

@endsection('content')   