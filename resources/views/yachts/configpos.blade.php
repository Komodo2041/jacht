@extends('template')

@section('content')
    
 @if ($errors != "")   
    <div class="error">
        {{$errors}}
    </div> 
@endif

 <h2>Jacht {{$yacht->name}} - Stanowiska Konfiguracje</h2>
  <form action="" method="Post">
     @csrf

    <fieldset>
    <label>
        <input name="hasoptions" type="checkbox" role="switch" value="1" 
        @if ($yacht->has_pos_conf) checked @endif
        />
        Ma korzystać z tej konfiguracji
    </label> 
    </fieldset>

    <div>
        @forelse ($dept AS $d)
            <h4 class="cm">{{$d->name}}</h4>
            @forelse ($d->jobs AS $job)
                <label>  {{$job->name}}: </label>  
                
                <input type="number" name="conf[val{{$job->id}}]" value="{{ $currentValues[$job->id] ?? '' }}" id="eqval{{$job->id}}" /> 
            @empty
                <p>-</p>
            @endforelse 
        @empty
                <p>Brak stanowisk</p>
        @endforelse
    </div>
     <input type="hidden" value="1" name="save" />
    <input type="submit" value="Edytuj Konfigurację" />
</form> 


  @endsection('content')