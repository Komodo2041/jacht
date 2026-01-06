@extends('template')

@section('content')
    
 

   <h2>Jachty</h2>
   <a href="/yachts/add" class="secondary">Dodaj nowy jacht</a>

  <table>
    <thead>
          <tr>
            <th scope="col">Nazwa</th>
            <th scope="col">Rok Budowy</th>
            <th scope="col">Typ</th> 
            <th scope="col">Liczba Kabin</th>
            <th scope="col">Port</th>
            <th></th>
          </tr>
    </thead>
   <tbody>
    @forelse ($yachts as $yacht)
    <tr>
        <td>{{$yacht->name}}</td>
        <td>{{$yacht->build_year}}</td>
        <td>{{$yacht->type?->name}}</td> 
        <td>{{$yacht->cabins}}</td>  
        <td>
         @if (isset($yacht->port[0]))
          {{$yacht->port[0]->name}}
         @else
            -
         @endif
         </td> 
        <td> 

            <a href="/yachts/crew/{{$yacht->id}}"><i class="fa-solid fa-users" title="Załoga"></i></a>

            <a href="/yachts/positionconfiguration/{{$yacht->id}}"><i class="fa-solid fa-bars-progress" title="Stanowiska - konfiguracje "></i></a>

            <a href="/yachts/documents/{{$yacht->id}}"><i class="fa-solid fa-file-arrow-down" title="Dokumenty"></i></a>
            <a href="/yachts/albums/{{$yacht->id}}"><i class="fa-solid fa-camera" title="Zdjęcia"></i></a>
  
           <a href="/yachts/equimpents/{{$yacht->id}}"><i class="fa-solid fa-binoculars" title="Wyposażenie"></i></a>
            <a href="/yachts/show/{{$yacht->id}}"><i class="fa-solid fa-bars"></i></a>
            <a href="/yachts/changeport/{{$yacht->id}}"><i class="fa-solid fa-anchor" title="Change Port"></i></a>
            <a href="/yachts/parameters/{{$yacht->id}}"><i class="fa-solid fa-bolt" title="Parameters"></i></a>

            <a href="/yachts/edit/{{$yacht->id}}"><i class="fa-solid fa-pencil"></i></a>
            <a href="/yachts/delete/{{$yacht->id}}" class="delrem"><i class="fa-solid fa-trash-can"></i></a>
        </td> 
    </tr> 
    @empty
       <tr><td colspan="2">Brak dodanych stanowisk</td></tr>    
    @endforelse     
   </tbody>
</table>
@endsection('content')