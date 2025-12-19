@extends('template') 
@section('content')


@if ($errors != "")   
    <div class="error">
        {{$errors}}
    </div> 
@endif

<form action="" method="Post">
    @csrf

    <label>Aktualny port</label>
    <select name="port_id" >
          <option value="">-</option>
            @foreach ($ports as $port)
                <option value="{{$port->id}}"
                {{ $port->id == $crew->port?->id ? 'selected' : '' }}
                >
                {{$port->name}}</option>
            @endforeach
    </select> 

     <input type="hidden" value="1" name="save" />
     <input type="submit" value="Zmień Port" />

</form>

@endsection('content')