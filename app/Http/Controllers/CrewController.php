<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Crew; 
use App\Models\Departments;
use App\Models\Nationality;

use App\Models\CrewPort;
use App\Models\Ports;
use App\Models\Yachts; 
use App\Models\Yachtcrew;

use Illuminate\Support\Facades\Validator;

class CrewController extends Controller
{

    public $statuses = [
       "pracuje" => "Pracuje",
       "zwolniony" => "Zwolniony",
       "już nie pracuje" => "Już nie pracuje",
       "okres próbny" => "Okres próbny"
    ];

    public function list() {
       $crew = Crew::with(["job", "country"])->get(); 
       return view("crew/list", ["crew" => $crew]);
    }

    public function add(Request $request) {
       $save =  $request->input('save');
       $jobs = Departments::with("jobs")->get();
       $country = Nationality::all();
       $ports = Ports::all();
       $crew = new Crew();
      
       if ($save) {
    
          $validator = Validator::make($request->all(), [
             'firstname' => 'required|string|max:100',
             'lastname' => 'required|string|max:100',
             'notes' => 'required|string',
             'email' => 'required|email|unique:crew,email|max:100',
             'passport_number' => 'required|string|max:100',
             'job_id' => 'required|integer',
             'birthday' => 'required|date',
             'country_id' => 'required|integer',
             'status' => 'required|in:pracuje,zwolniony,już nie pracuje,okres próbny',
             'port_id' => 'required|integer'
          ],
           [
             'firstname.required' => "Imię jest wymagane",
             'lastname.required' => "Nazwisko jest wymagane",
             'notes.required' => "Pole notatki jest wymagane",
             'email.required' => "Email jest wymagany",
             'passport_number.required' => "Pole NUmer paszportu jest wymagane",
             'job_id.required' => "Nie wybrano stanowiska",
             'country_id.required' => "Nie wybrano kraju",
             'status.required' => "Nie wybrano statusu",
             'job_id.integer' => "Nie wybrano stanowiska",
             'country_id.integer' => "Nie wybrano kraju",            
             'email.email' => "Nie podano prawidłowego emaila",
             'email.unique' => "Podany email jest już użyty",
             'birthday.required' => "Wymagana jest data urodzenia",
             'birthday.date' => "Data urodzenia powinna być datą",
             'status.in' => "Nie wybrano prawidłowego statusu",
             'port_id.required' => "Należy ustawić port"
           ]
        );
      
         if ($validator->fails()) {
               $validated = $validator->errors()->all();
               $crew = new Crew($request->all());
               return view("crew/addedit", ['errors' => implode(", ", $validated), 'person' => $crew, 'jobs' => $jobs, 'country' => $country, 'status' => $this->statuses, 'ports' => $ports]);
         } else {
            $validatedCrew =  $validated = $validator->validated();
            unset($validatedCrew['port_id']); 
            $crew = Crew::create($validatedCrew);
            CrewPort::create(["crew_id" => $crew->id, "port_id" => $validated["port_id"]]);
            return redirect("crew")->with('success', 'Pracownik został dodany pomyślnie!');
         } 
 
       }
       return view("crew/addedit", ['errors' => '', 'person' => $crew, 'jobs' => $jobs, 'country' => $country, 'status' => $this->statuses, 'ports' => $ports]);
    }


    public function edit($id, Request $request) {
        $crew = Crew::find($id);
        $jobs = Departments::with("jobs")->get();
        $country = Nationality::all();

        $save =  $request->input('save');
        if ($crew) { 
           if ($save ) {
                $validator = Validator::make($request->all(), [
                    'firstname' => 'required|string|max:100',
                    'lastname' => 'required|string|max:100',
                    'notes' => 'required|string',
                    'email' => 'required|email|unique:crew,email|max:100',
                    'passport_number' => 'required|string|max:100',
                    'job_id' => 'required|integer',
                    'birthday' => 'required|date',
                    'country_id' => 'required|integer',
                    'status' => 'required|in:pracuje,zwolniony,już nie pracuje,okres próbny',
                ],
                [
                    'firstname.required' => "Imię jest wymagane",
                    'lastname.required' => "Nazwisko jest wymagane",
                    'notes.required' => "Pole notatki jest wymagane",
                    'email.required' => "Email jest wymagany",
                    'passport_number.required' => "Pole NUmer paszportu jest wymagane",
                    'job_id.required' => "Nie wybrano stanowiska",
                    'country_id.required' => "Nie wybrano kraju",
                    'status.required' => "Nie wybrano statusu",
                    'job_id.integer' => "Nie wybrano stanowiska",
                    'country_id.integer' => "Nie wybrano kraju",            
                    'email.email' => "Nie podano prawidłowego emaila",
                    'email.unique' => "Podany email jest już użyty",
                    'birthday.required' => "Wymagana jest data urodzenia",
                    'birthday.date' => "Data urodzenia powinna być datą",
                    'status.in' => "Nie wybrano prawidłowego statusu",
                ]
                );
      
               if ($validator->fails()) {
                     $validated = $validator->errors()->all();
                     $crew = new Crew($request->all());
                    return view("crew/addedit", ['errors' => implode(", ", $validated), 'person' => $crew, 'jobs' => $jobs, 'country' => $country, 'status' => $this->statuses, 'isedit' => true]);
               } else {
                  $validated = $validator->validated();
                  $crew->update($validated);
                  return redirect("crew")->with('success', 'Pracownik został edytowany pomyślnie!');
               } 
           }  
             return view("crew/addedit", ['errors' => '', 'person' => $crew, 'jobs' => $jobs, 'country' => $country, 'status' => $this->statuses, 'isedit' => true]);
        } 
        return redirect("crew")->with('error', 'Nie znaleziono pracownika');        
    }
    
    public function delete($id) {
        $crew = Crew::find($id);
        if ($crew) {
            $crew->delete();
            return redirect("crew")->with('success', 'Pracownik został usunięty');
        } 
        return redirect("crew")->with('error', 'Nie znaleziono pracownika');
    }   

    public function show($id) {
        $crew = Crew::find($id);
        if ($crew) {
            return view("crew/show", ['crew' => $crew ]);
        } 
        return redirect("crew")->with('error', 'Nie znaleziono Pracownika');    
    }

    public function changeport($id, Request $request) {
        $save =  $request->input('save');
        $crew = Crew::find($id);
        $ports = Ports::all();
        if ($crew) {
            if ($save) {
                $validator = Validator::make($request->all(), ['port_id' => 'required|integer'], ['port_id.required' => "Port jest wymagany"]);
                if (!$validator->fails()) {
                    $this->saveport($crew->id, $request->input('port_id'));
                    return redirect("crew")->with('success', 'Port został zmieniony!');
                } else {
                  return view("crew/changeport", ['errors' => implode(", ", $validator->errors()->all()), 'crew' => $crew, 'ports' => $ports]);
                }
            }
            return view("crew/changeport", ['errors' => '', 'crew' => $crew, 'ports' => $ports]);
        }
        return redirect("crew")->with('error', 'Nie znaleziono pracownika');
    }  


    private function saveport($crew_id, $port_id) {
        $actport = CrewPort::where("crew_id", $crew_id)->first();
        if ($actport) {
            $actport->port_id = $port_id;
            $actport->save();
        } else {
            CrewPort::create(["crew_id" => $crew_id, "port_id" => $port_id]);
        } 
    }

    public function changeyacht($id, Request $request) {
        $save =  $request->input('save');
        $crew = Crew::find($id);
        if (!$crew) {
            return redirect("crew")->with('error', 'Nie znaleziono pracownika');
        }
        $isport = 0;
        
        if ($crew->port?->id) {
           $yachts = Yachts::select("yachts.id", "yachts.name")->join("actualport", 'yachts.id', '=', 'actualport.yachts_id')->where("actualport.port_id", $crew->port->id)->get();
           $isport = 1;
        } else {
           $yachts = Yachts::all();
        }
        if ($save) {
 
                $validator = Validator::make($request->all(), ['yacht_id' => 'required|integer'], ['yacht_id.required' => "Jacht jest wymagany"]);
 
                if (!$validator->fails()) {
                    $validated = $validator->validated();
                    $yacht = Yachts::find($validated['yacht_id']);
                    if (!$yacht) {
                        return view("crew/changeyacht", ['errors' => "nie znaleziono jachtu",  'crew' => $crew, 'yachts' => $yachts, 'isport' => $isport]);
                    }
                    $actJacht = Yachtcrew::where("crew_id", $crew->id)->first();
                    if ($actJacht) {
                        $actJacht->yacht_id = $validated['yacht_id'];
                        $actJacht->save();
                    } else {
                        Yachtcrew::create(["crew_id" => $crew->id, "yacht_id" => $validated['yacht_id']]);
                    }
                    if (!$isport) {

                         CrewPort::create(["crew_id" => $crew->id, "port_id" => $yacht->port[0]?->id]);
                    }   
                    return redirect("crew")->with('success', 'Jacht został zmieniony!');
                } else {
                  return view("crew/changeyacht", ['errors' => implode(", ", $validator->errors()->all()),  'crew' => $crew, 'yachts' => $yachts, 'isport' => $isport]);
                }


        }
        return view("crew/changeyacht", ['errors' => '', 'crew' => $crew, 'yachts' => $yachts, 'isport' => $isport]);
    }

}
