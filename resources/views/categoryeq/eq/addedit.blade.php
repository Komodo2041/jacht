@extends('template') 
@section('content')


@if ($errors != "")   
    <div class="error">
        {{$errors}}
    </div> 
@endif

 
<form action="" method="Post">
     @csrf
     <label>Nazwa Wyposażenia</label>
     <input type="text" name="name" placeholder="Nazwa" value="{{$eq->name}}"  >
  
    <label>Opis</label>
    <textarea name="body">{{$eq->body}}</textarea>

    <label>Kategoria Wyposażenia</label>
    <select name="category_id" >
        <option value="0">-</option> 
    @foreach ($category as $cat)
        <option value="{{$cat->id}}" @if ($cat->id == $eq->category_id) selected @endif>{{$cat->name}}</option>
    @endforeach    
</select>

     <input type="hidden" value="1" name="save" />
     @if (isset($isedit) && $isedit)
         <input type="submit" value="Edytuj wyposażenie" />
     @else
         <input type="submit" value="Dodaj nowe wyposażenie" />
     @endif
     
    
</form>

@endsection('content')