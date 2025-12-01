@extends('template') 
@section('content')


@if ($errors != "")   
    <div class="error">
        {{$errors}}
    </div> 
@endif

<form action="" method="Post">
     @csrf
     <label>Nazwa Stanowiska</label>
     <input type="text" name="name" placeholder="Nazwa"  >
     <label>Departament</label>
     <select name="dept" >
     @foreach ($depts as $dept)
         <option value="{{$dept->id}}">{{$dept->name}}</option>
     @endforeach
</select>   


     <input type="hidden" value="1" name="save" />
     <input type="submit" value="Dodaj nowe stanowisko " />
    
</form>

@endsection('content')