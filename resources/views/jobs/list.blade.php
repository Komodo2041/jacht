@extends('template')

@section('content')
    
 

   <h2>Porty</h2>
   <a href="/ports/add" class="secondary">Dodaj nowy port</a>

  <table>
    <thead>
          <tr>
            <th scope="col">Nazwa</th>
            <th scope="col"></th> 
          </tr>
    </thead>
   <tbody>
    @forelse ($ports as $port)
    <tr>
        <td>{{$port->name}}</td> 
        <td> 
            <a href="/ports/edit/{{$port->id}}"><i class="fa-solid fa-pencil"></i></a>
            <a href="/ports/delete/{{$port->id}}" class="delrem"><i class="fa-solid fa-trash-can"></i></a>
        </td> 
    </tr> 
    @empty
       <tr><td colspan="2">Brak dodanych portów</td></tr>    
    @endforelse     
   </tbody>
</table>
@endsection('content')