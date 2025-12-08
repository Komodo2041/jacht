@extends('template')

@section('content')
    
 

   <h2>Jachty</h2>
   <a href="/yachts/add" class="secondary">Dodaj nowy jacht</a>

  <table>
    <thead>
          <tr>
            <th scope="col">Nazwa</th>
            <th scope="col">Rok Budowy</th>
            <th scope="col">Model</th> 
            <th scope="col">Liczba Kabin</th>
            <th></th>
          </tr>
    </thead>
   <tbody>
    @forelse ($yachts as $yacht)
    <tr>
        <td>{{$yacht->name}}</td>
        <td>{{$yacht->build_year}}</td>
        <td>{{$yacht->model}}</td> 
        <td>{{$yacht->cabins}}</td>  
        <td> 
           <a href="/yachts/show/{{$yacht->id}}"><i class="fa-solid fa-bars"></i></a>
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