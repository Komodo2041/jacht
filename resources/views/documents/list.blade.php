@extends('template')

@section('content')
    
 
   @if ($type == "yachts")
     <h2>Jacht: {{$parent->name}}</h2>
     <a href="/yachts" class="secondary">Jachty</a> 
   @else 
     --##--
   @endif
   <br/>
   <a href="/{{$type}}/documents/{{$parent->id}}/add" class="secondary">Dodaj nowy dokument</a>

  <table>
    <thead>
          <tr>
            <th scope="col">Nazwa</th>
            <th scope="col">Type</th> 
            <th scope="col">Data Ważności</th>
            <th scope="col"></th> 
          </tr>
    </thead>
   <tbody>
    @forelse ($documents as $doc)
    <tr>
        <td>{{$doc->title}}</td> 
        <td>{{$doc->type->name}}</td> 
        <td>{{$doc->expires_at}}</td> 
        
        <td>
            <a href="/{{$type}}/documents/{{$parent->id}}/edit/{{$doc->id}}"><i class="fa-solid fa-pencil"></i></a>
            <a href="/{{$type}}/documents/{{$parent->id}}/delete/{{$doc->id}}" class="delrem"><i class="fa-solid fa-trash-can"></i></a>
        </td> 
    </tr> 
    @empty
       <tr><td colspan="4">Brak dodanych dokumentów</td></tr>    
    @endforelse     
   </tbody>
</table>

<div>
@foreach ($documents as $doc)
   <a href="{{ $doc->url }}" target="_blank"> {{ $doc->title }}</a>  <br/>

@endforeach
</div>

@endsection('content')