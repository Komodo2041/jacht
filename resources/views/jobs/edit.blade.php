@extends('template') 
@section('content')


@if (isset($errors) && $errors != "")   
    <div class="error">
        {{$errors}}
    </div> 
@endif

@if ($job)
    <form action="" method="Post">
        @csrf
        <label>Nazwa Stanowiska</label>
        <input type="text" name="name" placeholder="Nazwa" value="{{$job->name}}" >
        <input type="hidden" value="1" name="save" />
        <label>Departament</label>
        <select name="dept" >
        @foreach ($depts as $dept)
            <option value="{{$dept->id}}" @if ($dept->id == $job->dept_id) selected @endif>{{$dept->name}}</option>
        @endforeach        
        <input type="submit" value="Edytuj stanowisko" />
    </form>
@else
    <div class="error">
        Nie znaleziono stanowiska
    </div> 
@endif

@endsection('content')