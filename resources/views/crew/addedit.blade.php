@extends('template') 
@section('content')


@if ($errors != "")   
    <div class="error">
        {{$errors}}
    </div> 
@endif

 

<form action="" method="Post">
     @csrf
     <label>Imię</label>
     <input type="text" name="firstname" placeholder="Imię" value="{{$person->firstname}}"  >
 
     <label>Nazwisko</label>
     <input type="text" name="lastname" placeholder="Nazwisko" value="{{$person->lastname}}"  >

     <label>Email</label>
     <input type="text" name="email" placeholder="email" value="{{$person->email}}"  >     

     <label>Numer Paszportu</label>
     <input type="text" name="passport_number" placeholder="Numer paszportu" value="{{$person->passport_number}}"  >          

     <label>Data urodzenia</label>
     <input type="date" name="birthday" placeholder="Data" value="{{$person->birthday}}"  > 
 
    @if (!isset($isedit)) 
    <label>Aktualny port</label>
    <select name="port_id" >
          <option value="">-</option>
            @foreach ($ports as $port)
                <option value="{{$port->id}}" 
                   {{ $port->id == $person->port_id ? 'selected' : '' }} 
                >
                {{$port->name}}</option>
            @endforeach
    </select> 
    @endif     


    <label>Notatki</label>
    <textarea name="notes">{{$person->notes}}</textarea>

    <label>Stanowisko</label>
    <select name="job_id">
        <option>-</option>
        @foreach ($jobs AS $dept)
            <optgroup label="{{$dept->name}} "> 
                @foreach ($dept->jobs AS $job)
                <option value="{{$job->id}}" 
                    @if ($job->id == $person->job_id) selected @endif
                >{{$job->name}}</option>
                @endforeach
            </optgroup>
        @endforeach
    </select>

    <label>Kraj</label>
    <select name="country_id">
        <option>-</option>
        @foreach ($country AS $c)    
              <option value="{{$c->id}}" 
                 @if ($c->id == $person->country_id) selected @endif
               >{{$c->name}}</option>
        @endforeach
    </select> 

    <label>Status</label>
    <select name="status">
        <option>-</option> 
        @foreach ($status AS $key => $value)    
              <option value="{{$key}}" 
                 @if ($key == $person->status) selected @endif
               >{{$value}}</option>
        @endforeach
    </select>     
    
     <input type="hidden" value="1" name="save" />
     @if (isset($isedit) && $isedit)
         <input type="submit" value="Edytuj pracownika" />
     @else
         <input type="submit" value="Dodaj Pracownika" />
     @endif
     
    
</form>

@endsection('content')