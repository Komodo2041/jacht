@extends('template') 
@section('content')


@if ($errors != "")   
    <div class="error">
        {{$errors}}
    </div> 
@endif

 

<form action="" method="Post">
     @csrf
     <label>Rejs</label>
     <input type="text" name="name" placeholder="Nazwa" value="{{$type->name}}"  >
 
     <label>Jacht</label>
      @foreach ($yachts AS $yacht)
      @endforeach

     <label>Port Startu</label>
     <select name="port_start_id">
        @foreach ($ports AS $port)
           <option value="{{$port->id}}"
            @if ($cr->port_start_id == $port->id) selected @endif
           >{{$port->name}}</option>
        @endforeach 
     </select>   

     <label>Port Końcowy</label>
     <select name="port_end_id">
        @foreach ($ports AS $port)
           <option value="{{$port->id}}"
            @if ($cr->port_end_id == $port->id) selected @endif
           >{{$port->name}}</option>
        @endforeach 
     </select>        

     <label>Data od</label>
     <input type="date" name="date_from"   value="{{$cr->date_from}}"  >

     <label>Data do</label>
     <input type="date" name="date_to" value="{{$cr->date_to}}"  >     
 

     <input type="hidden" value="1" name="save" />
     @if (isset($isedit) && $isedit)
         <input type="submit" value="Edytuj typ dokumentu" />
     @else
         <input type="submit" value="Dodaj nowy typ dokumentu" />
     @endif
     
    
</form>

@endsection('content')