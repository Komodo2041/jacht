@extends('template')

@section('content')
    
 

   <h2>Typy</h2>
   <a href="/types/add" class="secondary">Dodaj nowy typ</a>

  <table>
    <thead>
          <tr>
            <th scope="col">Nazwa</th>
            <th scope="col">Liczba osób</th>
            <th scope="col">Warunki</th> 
            <th scope="col"></th> 
          </tr>
    </thead>
   <tbody>
    @forelse ($types as $typ)
    <tr>
        <td>{{$typ->name}}</td> 
        <td>{{$typ->number_of_people}}</td> 
        <td>{{$typ->routes}}</td> 
        <td> 
           <a href="/types/show/{{$typ->id}}"><i class="fa-solid fa-list"></i></a>
            <a href="/types/edit/{{$typ->id}}"><i class="fa-solid fa-pencil"></i></a>
            <a href="/types/delete/{{$typ->id}}" class="delrem"><i class="fa-solid fa-trash-can"></i></a>
        </td> 
    </tr> 
    @empty
       <tr><td colspan="4">Brak dodanych typów</td></tr>    
    @endforelse     
   </tbody>
</table>
@endsection('content')