@extends('template')
@section('content')

@if ($errors != "")   
    <div class="error">
        {{$errors}}
    </div> 
@endif

<div>
   <h5>Jacht {{$yacht->name}}</h5>
   @forelse  ($crews as $crew)
   <form action="" method="Post">
     @csrf
     <label>
      <input type="checkbox" value="1" name="crew[{{$crew->id}}]" 
        @if (isset($selected_crew[$crew->id])) checked @endif
      />
          {{$crew->firstname}} {{$crew->lastname}} ({{$crew->status}})
     </label> 
     <br/>
      <input type="hidden" value="1" name="save" />
       <input type="submit" value="Edytuj załogę" />
</form>
   @empty
      <p>Brak możliwej załogi która jest w porcie</p>
   @endforelse

</div>   

@endsection('content')