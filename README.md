# YachtFleet Manager - System Zarządzania Flotą i Rejsami Turystycznymi

YachtFleet Manager to zaawansowany system typu ERP/CRM stworzony w celu automatyzacji i koordynacji operacji w firmach zajmujących się czarterem oraz organizacją turystycznych rejsów jachtowych. Aplikacja zarządza zasobami floty, uprawnieniami załogi, logistyką portową oraz procesem rezerwacji dla klientów.

## 🚀 Kluczowe Moduły i Funkcjonalności

- **Zarządzanie Flotą (Yacht CRUD & Logistics):** Pełna ewidencja jachtów, parametrów technicznych, przypisanego wyposażenia oraz historii relokacji między portami.
- **System Rezerwacji i Rejsów (Voyage Management):** Planowanie kursów, przypisywanie klientów do rejsów (relacje Many-to-Many) oraz zarządzanie statusami rejsów na żywo.
- **Zarządzanie Załogą (Crew & HR Hub):** Ewidencja członków załogi, weryfikacja ważności dokumentów i uprawnień morskich oraz algorytm konfiguracji wymaganych stanowisk na dany rejs (np. wymagany kapitan + kucharz).
- **Logistyka i Magazyn:** Monitorowanie aktualnego położenia jednostek (Porty), kategoryzacja wyposażenia oraz zaawansowany system tagowania producentów do szybkiego filtrowania zasobów.

## 🛠️ Stack Technologiczny

- **Backend:** PHP 8.x, Laravel Framework
- **Frontend:** Livewire (Reactive UI), Blade, Pico.css (Lightweight CSS Framework)
- **Baza danych:** MySQL / PostgreSQL (zaawansowane tabele pivot, relacje polimorficzne do obsługi albumów zdjęć/dokumentów)

## 🐳 Architektura i Dobre Praktyki (Do wdrożenia)

- **Architektura:** Wykorzystanie Form Requests do walidacji, Service Pattern do izolacji logiki biznesowej.
- **Optymalizacja:** Zapytania Eloquent zoptymalizowane pod kątem problemu N+1 (Eager Loading).
- **Środowisko:** Pełna konteneryzacja za pomocą Dockera (Laravel Sail).

## 💻 Instalacja i Uruchomienie

1. Sklonuj repozytorium:
   ```bash
   git clone https://github.com
   cd jacht
   ```
2. Skopiuj plik środowiskowy i zainstaluj zależności:
   ```bash
   cp .env.example .env
   composer install
   npm install && npm run dev
   ```
3. Wygeneruj klucz aplikacji i uruchom migracje wraz z testowymi danymi (Seeders):
   ```bash
   php artisan key:generate
   php artisan migrate --seed
   ``` 
 
 
 Tutaj będzie projekt Laravel korzystający z LiveWire mający za zadania pomóc
 obsłudze firmy zajmującej się podróżami jachtami dla turystów
 Duże moduły: Statki, Kursy, Załoga, miejsca na statku

Na froncie postanowiłem użyć pico.css  

 Obecny stan : 
 
 CRUD ports,  
 CRUD producentów  
 ----CRUD modeli  
 ----CRUD informacji nt producentów  
 --------PIVOT informacji nt producentów na tabelę tagów         
 --------TAGI -> Do filtrowania informacji użyta w różnych miejcach  
 CRUD departamentów  
 ----CRUD stanowisk  
 CRUD kategorie wyposażenia  
 ----CRUD wyposażenie  
 CRUD Typy Dokumentów    
 CRUD jachty  *Filtrowanie*  
 ---- U Aktualny Port  
 ---- CRUD dodatkowe parametry  
 -------- PIVOT Dodatkowe parametry    
 ---- PIVOT wyposażenie   
 ---- CRUD Albums   
 -------- CRUD Images  
 ---- CRUD Dokumenty         
 ---- CRUD Konfiguracja stanowisk  (np do rejsu jest wymgany kucharz i kapitan)  
 ---- Pivot - > JACHT <> ZAŁOGA  
 CRUD Kraje  
 CRUD Załoga *Filtrowanie*    
 ---- CRUD Dokumenty  
 ---- U Aktualny Port  
 ---- Pivot - > ZAŁOGA <> JACHT  
 CRUD Rejsy   
 ---- CRUD Albums   
 -------- CRUD Images  
 ---- CRUD Dokumenty   
 ---- Pivot rejs <> klienci  
 CRUD Klienci  
 ---- CRUD Dokumenty   
 ---- Pivot klienci <> rejs   


 
rejs zmiana statusu

załog -> Urlopy? Wynagrodzenia?
 
  
 
 
 

 
   

