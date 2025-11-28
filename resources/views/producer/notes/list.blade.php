@extends('template')

@section('content')
 
   <a href="/producer" class="secondary">{{$producer->name}}</a> 
   <h2>Notatki</h2>
   <a href="/producer/{{$id}}/notes/add" class="secondary">Dodaj nowy wpis</a>

 
    @forelse ($notes as $note)
        <div class="boxes">
            <p>
               <span class="sm">{{$note->updated_at}}</span>
                <span class="tor">
                    <a href="/producer/{{$id}}/notes/edit/{{$note->id}}"><i class="fa-solid fa-pencil"></i></a>
                </span>    
            </p>
            {{$note->body}}
            <p><span class="sm">Tagi: </span></p>
         </div>  
    @empty
        <h3>Brak Dodanych Wpisów</h3>   
    @endforelse     
 
@endsection('content')