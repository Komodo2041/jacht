@extends('template') 
@section('content')


@if ($errors != "")   
    <div class="error">
        {{$errors}}
    </div> 
@endif

<form action="" method="Post">
     @csrf
     <label>Nazwa Producenta</label>
     <input type="text" name="name" placeholder="Nazwa" value="{{$data['name']}}" >
     <label>Skala Produkcji</label>
     <textarea name="volume">{{$data['volume']}}</textarea>
     <input type="hidden" value="1" name="save" />
     <input type="submit" value="Dodaj nowego Producenta" />
    
</form>

@endsection('content')