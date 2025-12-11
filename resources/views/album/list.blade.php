@extends('template')

@section('content')
    
 

   <h2>Album: {{$album->name}}</h2>
   
   @if ($album->albumable_type == "App\Models\Yachts")
     <a href="/yachts" class="secondary">Jachty</a> {{$album->albumable->name}}
   @else 
     --##--
   @endif
   <br/>
   <a href="/albums/{{$album->id}}/add" class="secondary">Dodaj nowe zdjęcie</a>

  <table>
    <thead>
          <tr>
            <th scope="col">Nazwa</th>
            <th scope="col">Opis</th>
            <th scope="col">Type</th> 
            <th scope="col"></th> 
          </tr>
    </thead>
   <tbody>
    @forelse ($images as $im)
    <tr>
        <td>{{$im->title}}</td> 
        <td>{{$im->description}}</td> 
        <td>{{$im->mime_type}}</td> 
        <td>
            <a href="/albums/{{$album->id}}/edit/{{$im->id}}"><i class="fa-solid fa-pencil"></i></a>
            <a href="/albums/{{$album->id}}/delete/{{$im->id}}" class="delrem"><i class="fa-solid fa-trash-can"></i></a>
        </td> 
    </tr> 
    @empty
       <tr><td colspan="4">Brak dodanych zdjęć</td></tr>    
    @endforelse     
   </tbody>
</table>

<div>
@foreach ($images as $image)
   {{ $image->title }}
   <img src="{{ $image->url }}" alt="{{ $image->title }}">
   <br/>

@endforeach
</div>

@endsection('content')