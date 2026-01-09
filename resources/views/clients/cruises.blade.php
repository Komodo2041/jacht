@extends('template')

@section('content')
    

   <h2>Klient {{$client->firstname}} {{$client->lastname}}</h2>

   @if ($errors != "")   
    <div class="error">
        {{$errors}}
    </div> 
   @endif

  <table>
    <thead>
          <tr>
            <th scope="col">Nazwa</th> 
            <th scope="col">Data</th> 
            <th scope="col">Trasa</th> 
            <th scope="col">Zapłacono</th> 
            <th scope="col"></th> 
          </tr>
    </thead>
   <tbody>
    @forelse ($cruises as $c)
    <tr>
        <td>{{$c->name}}</td>
        <td>{{$c->date_from}} - {{$c->date_to}} </td>
        <td>{{$c->portstart->name}} - {{$c->portend->name}}</td>
        <td>@if ($c->payment) TAK @else NIE @endif</td>
        <td> 
 
            <a href="/clients/cruises/{{$client->id}}/delete/{{$c->id}}" class="delrem"><i class="fa-solid fa-trash-can"></i></a>
        </td> 
    </tr> 
    @empty
       <tr><td colspan="5">Brak dodanych rejsów</td></tr>    
    @endforelse     
   </tbody>
</table>

<h4>Dodaj Rejs</h4>
<form action="" method="Post">
     @csrf
     
     <label>Rejs</label>
     <select name="course_id">
         <option value="">-</option>
         @foreach ($allcruises as $ac)
            <option value="{{$ac->id}}">{{$ac->name}} ({{$ac->portstart->name}} - {{$ac->portend->name}})</option> 
         @endforeach 
     </select>
   
    <label>Zapłacono</label>
    <select name="payment">
       <option value="0">Nie</option>
       <option value="1">Tak</option>
     </select>

     <input type="hidden" value="1" name="save" />
     <input type="submit" value="Dodaj Rejs" />
 
</form>          



@endsection('content')