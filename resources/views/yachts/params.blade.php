@extends('template')

@section('content')
    
 

   <h2>Jacht {{$yacht->name}} - Parametry</h2>

    @if ($usedparams)
       <table>
          
       @foreach ($usedparams AS $used)
          <tr>
              <td>{{$used->name}}</td>
              <td>{{ $used->pivot->value }}</td>
          </tr>
       @endforeach  
    @endif

   <a href="/yachts/parametrschange/{{$yacht->id}}" class="secondary">Zmień dodatkowe parametry</a>

@endsection('content')   