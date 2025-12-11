@extends('template') 
@section('content')


@if ($errors != "")   
    <div class="error">
        {{$errors}}
    </div> 
@endif

 

<form action="" method="POST" enctype='multipart/form-data'>
     @csrf
     <label>Nazwa</label>
     <input type="text" name="name" placeholder="Nazwa" value="{{$doc->title}}"  >
    
    <label>Notatki</label>
    <textarea name="notes">{{$doc->notes}}</textarea>

    <label>Typ Dokumentu</label>
    <select name="type_id">
        @foreach ($types AS $type)
           <option value="{{$type->id}}" @if ($type->id == $doc->type_id) selected @endif>{{$type->name}}</option>
        @endforeach
    </select>

    @if (!isset($isedit))
        <label>Dokument</label>
        <input type="file" name="file" accept=".doc, .pdf">
    @endif

    <label>Data Wydania</label>
    <input type="date"  " name="issued_at" value="{{$doc->issued_at}}">
     
    <label>Data Ważności</label>
    <input type="date"  " name="expires_at" value="{{$doc->expires_at}}">

     <input type="hidden" value="1" name="save" />
     @if (isset($isedit) && $isedit)
         <input type="submit" value="Edytuj dokument" />
     @else
         <input type="submit" value="Dodaj dokument" />
     @endif
     
    
</form>

@endsection('content')