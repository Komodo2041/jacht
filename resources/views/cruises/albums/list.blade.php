@extends('template')

@section('content')
 
 
   <h2>Albumy: Rejs {{$cr->name}}</h2>
   <a href="/cruises/albums/{{$cr->id}}/add" class="secondary">Dodaj nowy Album</a>

  <table>
    <thead>
          <tr>
            <th scope="col">Nazwa</th>
             <th scope="col">Opis</th> 
            <th scope="col"></th> 
          </tr>
    </thead>
   <tbody>
    @forelse ($albums as $album)
    <tr>
        <td>{{$album->name}}</td> 
        <td>{{$album->body}}</td> 
        <td> 
            <a href="/albums/{{$album->id}}"><i class="fa-solid fa-photo-film"></i></a>

            <a href="/cruises/albums/{{$cr->id}}/edit/{{$album->id}}"><i class="fa-solid fa-pencil"></i></a>
            <a href="/cruises/albums/{{$cr->id}}/delete/{{$album->id}}" class="delrem"><i class="fa-solid fa-trash-can"></i></a>
        </td> 
    </tr> 
    @empty
       <tr><td colspan="3">Brak Dodanych Albumów</td></tr>    
    @endforelse     
   </tbody>
</table>
@endsection('content')