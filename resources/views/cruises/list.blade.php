@extends('template')

@section('content')
    
 

   <h2>Rejsy</h2>
   <a href="/cruises/add" class="secondary">Dodaj nowy rejs</a>

  <table>
    <thead>
          <tr>
            <th scope="col">Jacht</th> 
            <th scope="col">Nazwa</th> 
            <th scope="col">Start</th> 
            <th scope="col">Koniec</th> 
            <th scope="col">Porty</th> 
            <th></th>
          </tr>
    </thead>
   <tbody>
    @forelse ($cruises as $cr)
    <tr>
        <td>{{$cr->yacht->name}} | {{$cr->yacht->cabins * 2}}</td>
        <td>{{$cr->name}}</td>
        <td>{{$cr->date_from}}</td>
        <td>{{$cr->date_to}}</td>
         <td>{{$cr->portstart->name}} - {{$cr->portend->name}}</td>
        <td> 
            <a href="/cruises/documents/{{$cr->id}}"><i class="fa-solid fa-file-arrow-down" title="Dokumenty"></i></a>      
 
            <a href="/cruises/albums/{{$cr->id}}"><i class="fa-solid fa-camera" title="Zdjęcia"></i></a>
            <a href="/cruises/edit/{{$cr->id}}"><i class="fa-solid fa-pencil"></i></a>
            <a href="/cruises/delete/{{$cr->id}}" class="delrem"><i class="fa-solid fa-trash-can"></i></a>
        </td> 
    </tr> 
    @empty
       <tr><td colspan="5">Brak dodanych rejsów</td></tr>    
    @endforelse     
   </tbody>
</table>
@endsection('content')