   @extends('template')

@section('content')
    
   <h2>Rejs</h2>
   <h2>Klienci</h2>
 
  <table>
    <thead>
          <tr>
            <th scope="col">Nazwa</th> 
            <th scope="col">Email</th> 
            <th scope="col">Telefon</th> 
            <th scope="col">payment</th> 
            <th scope="col"></th> 
          </tr>
    </thead>
   <tbody>
    @forelse ($clients as $c)
    <tr>
        <td>{{$c->firstname}} {{$c->lastname}}</td>
        <td>{{$c->email}} </td>
        <td>{{$c->phone}} </td>
        <td>@if ($c->payment == 1) Tak @else NIE @endif </td>
        <td>
             <a href="/cruises/clients/{{$cr->id}}/delete/{{$c->id}}" class="delrem"><i class="fa-solid fa-trash-can"></i></a>
        </td> 
    @empty
       <tr><td colspan="5">Brak dodanych klientów</td></tr>    
    @endforelse     
   </tbody>
   </tbody>
</table>
@endsection('content')