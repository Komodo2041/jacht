@extends('template')

@section('content')
  

   <h2>Kategorie podzespołów</h2>
   <a href="/categories/add" class="secondary">Dodaj nową kategorię</a>

  <table>
    <thead>
          <tr>
            <th scope="col">Nazwa</th>
            <th scope="col">Opis</th> 
            <th scope="col"></th>
          </tr>
    </thead>
   <tbody>
    @forelse ($category as $c)
    <tr>
        <td>{{$c->name}}</td> 
        <td>{{$c->body}}</td>  
        <td> 
            <a href="/categories/edit/{{$c->id}}"><i class="fa-solid fa-pencil"></i></a>
            <a href="/categories/delete/{{$c->id}}" class="delrem"><i class="fa-solid fa-trash-can"></i></a>
        </td> 
    </tr> 
    @empty
       <tr><td colspan="3">Brak dodanych kategorii</td></tr>    
    @endforelse     
   </tbody>
</table>
@endsection('content')