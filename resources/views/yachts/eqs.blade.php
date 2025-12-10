@extends('template')

@section('content')
    
 @if ($errors != "")   
    <div class="error">
        {{$errors}}
    </div> 
@endif

 <h2>Jacht {{$yacht->name}} - Wyposażenie</h2>
 
  <form action="" method="Post">
     @csrf
   @forelse ($eqs AS $eq)
       <h4 class="cm">{{$eq->name}}</h4>
       @forelse ($eq->equipments AS $p)
          <label><input type="checkbox" name="eq[{{$p->id}}]" class="eq" data-id="{{$p->id}}" value="1"
           @if ( array_key_exists($p->id, $currentValues) ) checked @endif
          />  {{$p->name}}: </label>  
          
          <input type="text" name="eq[val{{$p->id}}]" value="{{ $currentValues[$p->id] ?? '' }}" id="eqval{{$p->id}}"
             
            @if ( array_key_exists($p->id, $currentValues)) style="display:block;" @else style="display:none;" @endif 
          /> 
       @empty
         <p>-</p>
       @endforelse 
   @empty
        <p>Brak wyposeżenia</p>
   @endforelse
     <input type="hidden" value="1" name="save" />
    <input type="submit" value="Edytuj wyposażenie" />
</form> 
 


 @endsection('content')