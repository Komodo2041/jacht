@extends('template') 
@section('content')


@if ($errors != "")   
    <div class="error">
        {{$errors}}
    </div> 
@endif

<form action="" method="Post">
     @csrf
     <label>Nazwa Portu</label>
     <input type="text" name="name" placeholder="Nazwa"  >
     <label>Kraj</label>
     <select name="country_id">
        <option value="0">-</option>
        @foreach ($country AS $c)
          <option value="{{$c->id}}">{{$c->name}}</option>
        @endforeach
     </select>

     country
     <input type="hidden" value="1" name="save" />
     <input type="submit" value="Dodaj nowy port" />
    
</form>

@endsection('content')