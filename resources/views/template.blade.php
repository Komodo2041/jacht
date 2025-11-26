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
         @yield("content")
    </div>    
</body>     
</html>