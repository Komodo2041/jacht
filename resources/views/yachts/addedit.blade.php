@extends('template') 
@section('content')


@if ($errors != "")   
    <div class="error">
        {{$errors}}
    </div> 
@endif

<form action="" method="Post">
     @csrf
     <label>Nazwa statku</label>
     <input type="text" name="name" value="{{$yacht->name}}" placeholder="Nazwa"  />
 
     <label>Rok budowy</label>
     <input type="number" name="build_year" min="0" value="{{$yacht->build_year}}"  /> 

     <label>Długośc statku w metrach</label>
     <input type="number" name="length_meters" min="0" value="{{$yacht->length_meters}}"  /> 
 
    <label>Typ statku</label>
    <select name="type_id" >
          <option value="">-</option>
            @foreach ($types as $type)
                <option value="{{$type->id}}"  
                {{ $type->id == $yacht?->type_id ? 'selected' : '' }}>
                {{$type->name}}</option>
            @endforeach
    </select> 


    <label>Typ śruby</label> 
    <select name="propeller_type">
        <option value="fixed" 
       {{ $yacht->propeller_type == "fixed" ? 'selected' : '' }}
        >Stały</option>
        <option value="folding"
         {{ $yacht->propeller_type == "folding" ? 'selected' : '' }}
        >Składany</option>
    </select>    
 
    <label>Producent</label> 
    <select name="producer_id" id="producer_id" >
          <option value="">-</option>
            @foreach ($producer as $prod)
                <option value="{{$prod->id}}"  
                {{ $prod->id == $yacht?->producer_id ? 'selected' : '' }}>
                {{$prod->name}}</option>
            @endforeach
    </select>    
    
    <label>Modele producenta</label> 
    <select name="model_id" id="model_id">
          <option value="">-</option>
            @foreach ($producer as $prod)
                @foreach ($prod->models AS $m)
                    <option value="{{$m->id}}" class=" mdpd model{{$prod->id}} "
                      {{ $m->id == $yacht?->model_id ? 'selected' : '' }} 
                    style="display:none" >{{$m->name}}</option>
                @endforeach
            @endforeach
    </select>     

     <label>Model</label>
     <input type="text" name="model" placeholder="Model" value="{{$yacht->model}}" / >

     <label>Marka silnika</label>
     <input type="text" name="engine_brand" placeholder="Marka Silnika" value="{{$yacht->engine_brand}}"  />

     <label>Model Silnika</label>
     <input type="text" name="engine_model" placeholder="Model silnika" value="{{$yacht->engine_model}}" />    
     
     <label>Liczba Silników</label>
     <input type="number" name="engine_count" min="1" value="{{$yacht->engine_count}}"  >      

     <label>Liczba Kabin</label>
     <input type="number" name="cabins" min="0" value="{{$yacht->cabins}}" >  
     
     <label>Liczba koi</label>
     <input type="number" name="berths" min="0" value="{{$yacht->berths}}" >       

     <label>Pojemność paliwa</label>
     <input type="number" name="fuel_tank_liters" min="0"  value="{{$yacht->fuel_tank_liters}}" >    

     <label>Pojemność wody</label>
     <input type="number" name="water_tank_liters" min="0"  value="{{$yacht->water_tank_liters}}" >         
 


     <input type="hidden" value="1" name="save" />
     @if (isset($isedit))
     <input type="submit" value="Edytuj statek" />
     @else
     <input type="submit" value="Dodaj nowy statek" />
     @endif
    
</form>

@endsection('content')