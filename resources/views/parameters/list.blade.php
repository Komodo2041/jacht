@extends('template')

@section('content')
    
 

   <h2>Parametry</h2>
   <a href="/parameters/add" class="secondary">Dodaj nowy parametr</a>

  <table>
    <thead>
          <tr>
            <th scope="col">Nazwa</th>
            <th scope="col">Jednostka</th> 
            <th scope="col"></th> 
          </tr>
    </thead>
   <tbody>
    @forelse ($params as $param)
    <tr>
        <td>{{$param->name}}</td> 
        <td>{{$param->unit}}</td>       
        <td>   
            <a href="/parameters/edit/{{$param->id}}"><i class="fa-solid fa-pencil"></i></a>
            <a href="/parameters/delete/{{$param->id}}" class="delrem"><i class="fa-solid fa-trash-can"></i></a>
        </td> 
    </tr> 
    @empty
       <tr><td colspan="3">Brak dodanych parametrów</td></tr>    
    @endforelse     
   </tbody>
</table>
@endsection('content')