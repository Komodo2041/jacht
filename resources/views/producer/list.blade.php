@extends('template')
@section('content')
    
    @if (session('success'))
        <div  class="success">
            {{ session('success') }}
        </div>
    @endif
    @if (session('error'))
        <div  class="error">
            {{ session('error') }}
        </div>
    @endif

   <h2>Producenci</h2>
   <a href="/producer/add" class="secondary">Dodaj nowego producenta</a>

  <table>
    <thead>
          <tr>
            <th scope="col">Nazwa</th>
            <th scope="col">Skala Produkcji</th>
            <th scope="col">Modele</th>
            <th scope="col"></th> 
          </tr>
    </thead>
   <tbody>
    @forelse ($producer as $p)
    <tr>
        <td>{{$p->name}}</td> 
        <td>{{$p->volume}}</td>
        <td>
           @forelse ($p->models as $model)
              {{$model->name}}@if($loop->last) @else,&nbsp; @endif
           @empty
            -
            @endforelse
        </td>
        <td> 
            <a href="/producer/{{$p->id}}/models" title="models"><i class="fa-solid fa-list"></i></a>
            <a href="/producer/edit/{{$p->id}}"><i class="fa-solid fa-pencil"></i></a>
            <a href="/producer/delete/{{$p->id}}" class="delrem"><i class="fa-solid fa-trash-can"></i></a>
        </td> 
    </tr> 
    @empty
       <tr><td colspan="2">Brak dodanych producentów</td></tr>    
    @endforelse     
   </tbody>
</table>
@endsection('content')