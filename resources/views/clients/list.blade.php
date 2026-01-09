@extends('template')

@section('content')
    

   <h2>Klienci</h2>
   <a href="/clients/add" class="secondary">Dodaj nowego klienta</a>

  <table>
    <thead>
          <tr>
            <th scope="col">Nazwa</th> 
            <th scope="col">Email</th> 
            <th scope="col">Telefon</th> 
            <th scope="col"></th> 
          </tr>
    </thead>
   <tbody>
    @forelse ($clients as $c)
    <tr>
        <td>{{$c->firstname}} {{$c->lastname}}</td>
        <td>{{$c->email}} </td>
        <td>{{$c->phone}} </td>
        <td> 
            <a href="/clients/cruises/{{$c->id}}"><i class="fa-solid fa-anchor" title="Rejsy"></i></a>
            <a href="/clients/documents/{{$c->id}}"><i class="fa-solid fa-file-arrow-down" title="Dokumenty"></i></a>
            <a href="/clients/edit/{{$c->id}}"><i class="fa-solid fa-pencil"></i></a>
            <a href="/clients/delete/{{$c->id}}" class="delrem"><i class="fa-solid fa-trash-can"></i></a>
        </td> 
    </tr> 
    @empty
       <tr><td colspan="4">Brak dodanych kleintów</td></tr>    
    @endforelse     
   </tbody>
</table>
@endsection('content')