@extends('template')

@section('content')
  

   <h2>Wyposażenie</h2>
   <a href="/equipments/add" class="secondary">Dodaj nowe wyposażenie</a>

  <div>
     <form action="" method="GET">
    <select name="category_id" >
        <option value="0">-</option> 
    @foreach ($category as $cat)
        <option value="{{$cat->id}}" @if ($cat->id == $catid) selected @endif>{{$cat->name}}</option>
    @endforeach    
</select>      
      <input type="submit" value="Filtruj" />
</form>
</div>  

  <table>
    <thead>
          <tr>
            <th scope="col">Nazwa</th>
            <th scope="col">Opis</th> 
            <th scope="col">Kategoria</th> 
            <th scope="col"></th>
          </tr>
    </thead>
   <tbody>
    @forelse ($eqs as $eq)
    <tr>
        <td>{{$eq->name}}</td> 
        <td>{{$eq->body}}</td>
        <td>{{$eq->category->name}}</td> 
        <td> 
            <a href="/equipments/edit/{{$eq->id}}"><i class="fa-solid fa-pencil"></i></a>
            <a href="/equipments/delete/{{$eq->id}}" class="delrem"><i class="fa-solid fa-trash-can"></i></a>
        </td> 
    </tr> 
    @empty
       <tr><td colspan="4">Brak dodanego wyposażenia</td></tr>    
    @endforelse     
   </tbody>
</table>
@endsection('content')