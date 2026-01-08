@extends('template') 
@section('content')


@if ($errors != "")   
    <div class="error">
        {{$errors}}
    </div> 
@endif

 

<form action="" method="Post">
     @csrf
 
    <label>Nazwa</label>
    <input type="text" name="name" value="{{$cr->name}}" />

    <label>Opis</label>
    <textarea name="body">{{$cr->body}}</textarea>

     <label>Jacht</label>
      @foreach ($yachts AS $yacht)
         <input type="radio" name="yacht_id" value="{{$yacht->id}}" 
          @if ($yacht->id == $cr->yacht_id) checked @endif
         /> {{$yacht->name}} ({{$yacht->port[0]->name}})<br/>
      @endforeach
     <br/>

     <label>Port Startu</label>
     <select name="port_start_id">
        <option value="">-</option> 
        @foreach ($ports AS $port)
           <option value="{{$port->id}}"
            @if ($cr->port_start_id == $port->id) selected @endif
           >{{$port->name}}</option>
        @endforeach 
     </select>   

     <label>Port Końcowy</label>
     <select name="port_end_id">
         <option value="">-</option> 
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
         <input type="submit" value="Edytuj rejs" />
     @else
         <input type="submit" value="Dodaj nowy rejs" />
     @endif
     
    
</form>

@endsection('content')