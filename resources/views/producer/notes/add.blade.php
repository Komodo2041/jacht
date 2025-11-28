@extends('template') 
@section('content')


@if ($errors != "")   
    <div class="error">
        {{$errors}}
    </div> 
@endif

<form action="" method="Post">
     @csrf 
     <label>Wpis</label>
     <textarea name="body"></textarea>
     <label>Tagi <span class="sm">(podaj po przecinku)</span></label> 
     <input type="text" name="tags" value="" />
     <input type="hidden" value="1" name="save" />
     <input type="submit" value="Dodaj nowy wpis" />
    
</form>

@endsection('content')