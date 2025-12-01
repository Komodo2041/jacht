@extends('template')

@section('content')
 

   <h2>Departamenty</h2>
   <a href="/departments/add" class="secondary">Dodaj nowy departament</a>

  <table>
    <thead>
          <tr>
            <th scope="col">Nazwa</th>
            <th scope="col"></th> 
          </tr>
    </thead>
   <tbody>
    @forelse ($depts as $dept)
        <tr>
            <td>{{$dept->name}}</td>
            <td>
                <a href="/departments/edit/{{$dept->id}}"><i class="fa-solid fa-pencil"></i></a>
                <a href="/departments/delete/{{$dept->id}}" class="delrem"><i class="fa-solid fa-trash-can"></i></a>
            </td> 
        </tr> 
    @empty
       <tr><td colspan="2">Brak dodanych departamentów</td></tr>    
    @endforelse     
   </tbody>
</table>
@endsection('content')