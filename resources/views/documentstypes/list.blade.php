@extends('template')

@section('content')
    
 

   <h2>Typy Dokumentów</h2>
   <a href="/documentstypes/add" class="secondary">Dodaj nowy typ dokumentu</a>

  <table>
    <thead>
          <tr>
            <th scope="col">Nazwa</th> 
            <th scope="col"></th> 
          </tr>
    </thead>
   <tbody>
    @forelse ($types as $typ)
    <tr>
        <td>{{$typ->name}}</td>
        <td> 
    
            <a href="/documentstypes/edit/{{$typ->id}}"><i class="fa-solid fa-pencil"></i></a>
            <a href="/documentstypes/delete/{{$typ->id}}" class="delrem"><i class="fa-solid fa-trash-can"></i></a>
        </td> 
    </tr> 
    @empty
       <tr><td colspan="2">Brak dodanych typów dokumentu</td></tr>    
    @endforelse     
   </tbody>
</table>
@endsection('content')