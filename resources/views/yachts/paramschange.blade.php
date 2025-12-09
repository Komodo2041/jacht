@extends('template')

@section('content')
    
 @if ($errors != "")   
    <div class="error">
        {{$errors}}
    </div> 
@endif

 <h2>Jacht {{$yacht->name}} - Parametry</h2>

 
@if ($params)
<form action="" method="Post">
     @csrf

      @foreach ($params as $param)
        <label>{{$param->name}} @if ($param->unit) ({{$param->unit}}) @endif</label>
        <input type="text" name="params[{{$param->id}}]" placeholder=""            
          value="{{ $currentValues[$param->id] ?? '' }}"
          
          /> 
      @endforeach

    <input type="hidden" value="1" name="save" /> 
    <input type="submit" value="Ustaw parametry" /> 
</form>
@else 
  <p> Brak parametrów </p>
@endif


@endsection('content')