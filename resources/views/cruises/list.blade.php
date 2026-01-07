@extends('template')

@section('content')
    
 

   <h2>Rejsy</h2>
   <a href="/cruises/add" class="secondary">Dodaj nowy rejs</a>

  <table>
    <thead>
          <tr>
            <th scope="col">Jacht</th> 
            <th scope="col">Liczba miejsc</th> 
            <th scope="col">Start</th> 
            <th scope="col">Koniec</th> 
          </tr>
    </thead>
   <tbody>
    @forelse ($cruises as $cr)
    <tr>
        <td>{{$cr->name}}</td>
        <td>{{$cr->name}}</td>
        <td>{{$cr->date_from}}</td>
        <td>{{$cr->date_to}}</td>
        <td> 
    
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