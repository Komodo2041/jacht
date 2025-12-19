@extends('template') 
@section('content')


@if ($errors != "")   
    <div class="error">
        {{$errors}}
    </div> 
@endif

@if ($isport == 0)
   <div>Ustawienie jachtu, ustwi jednocześnie port Pracownika na Port Jachtu</div>
@endif

<form action="" method="Post">
    @csrf

    <label>Aktualny Jacht</label>
    <select name="yacht_id" >
          <option value="">-</option>
            @foreach ($yachts as $yacht)
                <option value="{{$yacht->id}}"
                {{ $yacht->id == $crew->yacht?->id ? 'selected' : '' }}
                >
                {{$yacht->name}}</option>
            @endforeach
    </select> 

     <input type="hidden" value="1" name="save" />
     <input type="submit" value="Zmień Jacht" />

</form>

@endsection('content')