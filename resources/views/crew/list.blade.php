@extends('template')

@section('content')
    
 

   <h2>Załoga</h2>
   <a href="/crew/add" class="secondary">Dodaj nowy członka załogi</a>

  <table>
    <thead>
          <tr>
            <th scope="col">Imię i Nazwisko</th>         
            <th scope="col">Stanowisko</th>   
            <th scope="col">Status</th>
            <th scope="col">Port</th> 
            <th scope="col"></th> 
          </tr>
    </thead>
   <tbody>
    @forelse ($crew as $person)
    <tr>
        <td>{{$person->firstname}} {{$person->lastname}}</td> 
        <td>{{$person->job?->name}}</td>     
        <td>{{$person->status}}</td>
        <td>{{$person->port?->name}}  </td>
        <td> 
          <a href="/crew/changeport/{{$person->id}}"><i class="fa-solid fa-anchor" title="Change Port"></i></a>
           <a href="/crew/documents/{{$person->id}}"><i class="fa-solid fa-file-arrow-down" title="Dokumenty"></i></a>
           <a href="/crew/show/{{$person->id}}"><i class="fa-solid fa-list"></i></a>
            <a href="/crew/edit/{{$person->id}}"><i class="fa-solid fa-pencil"></i></a>
            <a href="/crew/delete/{{$person->id}}" class="delrem"><i class="fa-solid fa-trash-can"></i></a>
        </td> 
    </tr> 
    @empty
       <tr><td colspan="6">Nie dodano załogi</td></tr>    
    @endforelse     
   </tbody>
</table>
@endsection('content')