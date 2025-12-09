@extends('template')
@section('content')

<div>
   
   <table>
       <tr>
           <td>Nazwa Statku</td>
           <td>{{$yacht->name}}</td>
       </tr>
       <tr>
           <td>Typ</td>
           <td>{{$yacht?->type?->name}}</td>
       </tr>       
       <tr>
           <td>Rok budowy</td>
           <td>{{$yacht->build_year}}</td>
       </tr>
       <tr>
           <td>Długośc statku w metrach</td>
           <td>{{$yacht->length_meters}}</td>
       </tr>
       <tr>
           <td>Typ śruby</td>
           <td>
             @if ($yacht->propeller_type == "fixed")
                Stały
             @else
                Składany
             @endif
            </td>
       </tr>
       
        <tr>
           <td>Producent</td>
           <td>{{$yacht?->producers?->name}}</td>
       </tr> 
       <tr>
           <td>Model Producenta</td>
           <td>{{$yacht?->models?->name}}</td>
       </tr> 

       <tr>
           <td>Model</td>
           <td>{{$yacht->model}}</td>
       </tr>       
       <tr>
           <td>Marka silnika</td>
           <td>{{$yacht->engine_brand}}</td>
       </tr>
       <tr>
           <td>Model Silnika</td>
           <td>{{$yacht->engine_model}}</td>
       </tr>
       <tr>
            <td>Moc silnika</td>
            <td>{{$yacht->engine_power_hp}} KM</td>
       </tr>
       <tr>
           <td>Liczba Silników</td>
           <td>{{$yacht->engine_count}}</td>
       </tr>   
       <tr>
           <td>Liczba Kabin</td>
           <td>{{$yacht->cabins}}</td>
       </tr>  
       <tr>
           <td>Liczba koi</td>
           <td>{{$yacht->berths}}</td>
       </tr>         
       <tr>
           <td>Pojemność paliwa</td>
           <td>{{$yacht->fuel_tank_liters}}</td>
       </tr>  
       <tr>
           <td>Pojemność wody</td>
           <td>{{$yacht->water_tank_liters}}</td>
       </tr>  

   </table>
   
   <hr/>
 
   <b>Port: {{$yacht->port[0]->name}}</b> 

</div>

@endsection('content')