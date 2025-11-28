@extends('template')

@section('content')
 
   <a href="/producer" class="secondary">{{$producer->name}}</a> 
   <h2>Modele</h2>
   <a href="/producer/{{$id}}/models/add" class="secondary">Dodaj nowy model</a>

  <table>
    <thead>
          <tr>
            <th scope="col">Nazwa</th>
             <th scope="col">Opis</th> 
            <th scope="col"></th> 
          </tr>
    </thead>
   <tbody>
    @forelse ($models as $model)
    <tr>
        <td>{{$model->name}}</td> 
        <td>{{$model->body}}</td> 
        <td> 
            <a href="/producer/{{$id}}/models/edit/{{$model->id}}"><i class="fa-solid fa-pencil"></i></a>
            <a href="/producer/{{$id}}/models/delete/{{$model->id}}" class="delrem"><i class="fa-solid fa-trash-can"></i></a>
        </td> 
    </tr> 
    @empty
       <tr><td colspan="2">Brak Dodanych modeli</td></tr>    
    @endforelse     
   </tbody>
</table>
@endsection('content')