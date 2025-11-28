@extends('template') 
@section('content')


@if (isset($errors) && $errors != "")   
    <div class="error">
        {{$errors}}
    </div> 
@endif

@if ($note)
    <form action="" method="Post">
        @csrf
        <label>Wpis</label>
        <textarea name="body">{{$note->body}}</textarea>
        <label>Tagi <span class="sm">(podaj po przecinku)</span></label> 
        <input type="text" name="tags" value="" />        
        <input type="hidden" value="1" name="save" />
        <input type="submit" value="Edytuj Wpis" />    
    </form>
@else
    <div class="error">
        Nie znaleziono wpsiu
    </div> 
@endif

@endsection('content')