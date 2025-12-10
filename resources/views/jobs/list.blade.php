@extends('template')

@section('content')
    
 

   <h2>Stanowiska</h2>
   <a href="/jobs/add" class="secondary">Dodaj nowe stanowisko</a>

  <table>
    <thead>
          <tr>
            <th scope="col">Nazwa</th>
            <th scope="col">Departament</th>
            <th scope="col"></th> 
          </tr>
    </thead>
   <tbody>
    @forelse ($jobs as $job)
    <tr>
        <td>{{$job->name}}</td>
        <td>{{$job->department?->name}}</td> 
        <td> 
            <a href="/jobs/edit/{{$job->id}}"><i class="fa-solid fa-pencil"></i></a>
            <a href="/jobs/delete/{{$job->id}}" class="delrem"><i class="fa-solid fa-trash-can"></i></a>
        </td> 
    </tr> 
    @empty
       <tr><td colspan="2">Brak dodanych stanowisk</td></tr>    
    @endforelse     
   </tbody>
</table>
@endsection('content')