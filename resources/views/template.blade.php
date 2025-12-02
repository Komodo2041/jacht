<!DOCTYPE html>
<html  lang="pl" data-theme="light" >
   <head>
     <title>Projekt - Jachty</title>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="color-scheme" content="dark">
 
<!-- Pico CSS – najnowsza wersja -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@picocss/pico@2/css/pico.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
  <!-- Nadpisanie kolorów – ZAWSZE PO Pico! -->
 
     <link rel="stylesheet"  href="{{URL::asset('css/style.css')}}" />
   
</head>
<body>
    <div class="container" >

     @if (session('success'))
        <div  class="success">
            {{ session('success') }}
        </div>
    @endif
    @if (session('error'))
        <div  class="error">
            {{ session('error') }}
        </div>
    @endif
 
        <div class="grid-1-5">
            <div id="menu" class="no-bullets" >
                
                <details name="menu1">
                <summary>Organizacja</summary>
                   <ul  >
                     <li>
                        <a href="/departments">Departamenty</a>
                     </li>
                     <li>
                        <a href="/jobs">Stanowiska</a>
                     </li>  
                   </ul>
                </details>
                <details name="menu2">
                <summary>Rejsy</summary>
                   <ul  >
                     <li>
                        <a href="/ports">Porty</a>
                     </li> 
                   </ul>
                </details>          
                <details name="menu3">
                <summary>Statki</summary>
                   <ul >
                     <li>
                        <a href="/yachts">Statki</a>
                     </li>
                     <li>
                        <a href="/types">Typy</a>
                     </li>
                     <li>
                        <a href="/categories">Kategorie podzespołów</a>
                     </li>
                     <li>
                        <a href="/equipments">Podzespoły</a>
                     </li>  
                   </ul>
                </details>
                <details name="menu4">
                <summary>Producenci statków</summary>
                   <ul >
                     <li>
                        <a href="/producer">Producenci</a>
                     </li>                      
                   </ul>
                </details>
                <hr />

            </div>    
            <div id="content">
              @yield("content")
            </div>  
        </div>    
  
 
    
    </div>   
     <script src="{{URL::asset('js/main.js')}}" ></script>
      
</body>
   
</html>