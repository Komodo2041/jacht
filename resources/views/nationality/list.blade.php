@extends('template')

@section('content')
    

   <h2>Kraje</h2>
   <a href="/nationality/add" class="secondary">Dodaj nowy kraj</a>

  <table>
    <thead>
          <tr>
            <th scope="col">Nazwa</th> 
            <th scope="col"></th> 
          </tr>
    </thead>
   <tbody>
    @forelse ($nationality as $n)
    <tr>
        <td>{{$n->name}}</td>
        <td> 
    
            <a href="/nationality/edit/{{$n->id}}"><i class="fa-solid fa-pencil"></i></a>
            <a href="/nationality/delete/{{$n->id}}" class="delrem"><i class="fa-solid fa-trash-can"></i></a>
        </td> 
    </tr> 
    @empty
       <tr><td colspan="2">Brak dodanych krajów</td></tr>    
    @endforelse     
   </tbody>
</table>
@endsection('content')