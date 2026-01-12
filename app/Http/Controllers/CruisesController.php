<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Cruises;
use App\Models\Ports; 
use App\Models\Yachts;
use App\Models\Albums;
use App\Models\Clients;
use App\Models\ClientCourses;


use Illuminate\Support\Facades\Validator;

class CruisesController extends Controller
{

    public function list() {
       $cruises = Cruises::with(["portstart", "portend", "yacht"])->get(); 
       return view("cruises/list", ["cruises" => $cruises]);
    }

    public function add(Request $request) {
       $save =  $request->input('save');
       $cr = new Cruises();
       $ports = Ports::all();
       $yachts = Yachts::with("port")->get();

       
       if ($save) {
    
          $validator = Validator::make($request->all(), [
             'yacht_id' => 'required|integer',
             'port_start_id' => 'required|integer',
             'port_end_id' => 'required|integer',
             'date_from' => 'required|date',
             'date_to' => 'required|date|after:date_from',
             'name' => 'required|string',
             'body' => 'required|string',
          ],
          [
             'yacht_id.required' => "Jacht jest wymagany",
             'port_start_id.required' => "port początkowy jest wymagany",
             'port_end_id.required' => "port końcowy jest wymagany",
             'date_from.required' => "data startu jest wymagana",
             'date_to.required' => "data końca jest wymagana",
             'date_to.after' => "data do musi być większa niż data od",
             'name.required' => "Pole nazwa jest wymagane",
             'body.required' => "Opis jest wymagany",
          ]  
          );
 
        $validator->after(function ($validator) use ($request) {
            $yachtId = $request->input('yacht_id');
            $portStartId = $request->input('port_start_id');

            if ($yachtId && $portStartId) {
                $yacht = Yachts::find($yachtId);

                if (!$yacht || $yacht->port[0]?->id != $portStartId) {
                    $validator->errors()->add('yacht_id', 'Wybrany jacht nie znajduje się obecnie w porcie startowym.');
                }
            }

            $date_from = $request->input('date_from');
            $date_to = $request->input('date_to');    
            
            $calc = Cruises::select('cruises.id')
                     ->where('cruises.yacht_id', $yachtId)
                     ->where(function ($query) use ($date_from, $date_to) {
                        $query->where(function ($q) use ($date_from) {
                              $q->where('cruises.date_from', '<', $date_from)
                              ->where('cruises.date_to', '>', $date_from);
                        })->orWhere(function ($q) use ($date_to) {
                              $q->where('cruises.date_from', '<', $date_to)
                              ->where('cruises.date_to', '>', $date_to);
                        });
                     })->count();

            if ($calc) {
                $validator->errors()->add('yacht_id', 'Podany Jacht ma w tym okresie planowany rejs');
            }

 
        });

         if ($validator->fails()) {
               $validated = $validator->errors()->all();
               $cr = new Cruises($request->all());
               return view("cruises/addedit", ['errors' => implode(", ", $validated), 'cr' => $cr, 'ports' => $ports, 'yachts' => $yachts]);
         } else {
            $validated = $validator->validated();
            Cruises::create($validated);
            return redirect("cruises")->with('success', 'Rejs został edytowany pomyślnie!');  
         } 
 
       } 
       return view("cruises/addedit", ['errors' => '', 'cr' => $cr, 'ports' => $ports, 'yachts' => $yachts ]);
    }

    public function edit($id, Request $request) {
       $save =  $request->input('save');
       $cr = Cruises::find($id);
       if (!$cr) {
         return redirect("cruises")->with('error', 'Nie znaleziono rejsu');
       }
       $ports = Ports::all();
       $yachts = Yachts::with("port")->get();

       
       if ($save) {
    
          $validator = Validator::make($request->all(), [
             'yacht_id' => 'required|integer',
             'port_start_id' => 'required|integer',
             'port_end_id' => 'required|integer',
             'date_from' => 'required|date',
             'date_to' => 'required|date|after:date_from',
             'name' => 'required|string',
             'body' => 'required|string',             
          ],
          [
             'yacht_id.required' => "Jacht jest wymagany",
             'port_start_id.required' => "port początkowy jest wymagany",
             'port_end_id.required' => "port końcowy jest wymagany",
             'date_from.required' => "data startu jest wymagana",
             'date_to.required' => "data końca jest wymagana",
             'date_to.after' => "data do musi być większa niż data od",
             'name.required' => "Pole nazwa jest wymagane",
             'body.required' => "Opis jest wymagany",             
          ]  
          );
 
        $validator->after(function ($validator) use ($request) {
            $yachtId = $request->input('yacht_id');
            $portStartId = $request->input('port_start_id');

            if ($yachtId && $portStartId) {
                $yacht = Yachts::find($yachtId);

                if (!$yacht || $yacht->port[0]?->id != $portStartId) {
                    $validator->errors()->add('yacht_id', 'Wybrany jacht nie znajduje się obecnie w porcie startowym.');
                }
            }

            $date_from = $request->input('date_from');
            $date_to = $request->input('date_to');    
            
            $calc = Cruises::select('cruises.id')
                     ->where('cruises.yacht_id', $yachtId)
                     ->where(function ($query) use ($date_from, $date_to) {
                        $query->where(function ($q) use ($date_from) {
                              $q->where('cruises.date_from', '<', $date_from)
                              ->where('cruises.date_to', '>', $date_from);
                        })->orWhere(function ($q) use ($date_to) {
                              $q->where('cruises.date_from', '<', $date_to)
                              ->where('cruises.date_to', '>', $date_to);
                        });
                     })->count();

            if ($calc) {
                $validator->errors()->add('yacht_id', 'Podany Jacht ma w tym okresie planowany rejs');
            }

        });

         if ($validator->fails()) {
               $validated = $validator->errors()->all();
               $cr = new Cruises($request->all());
               return view("cruises/addedit", ['errors' => implode(", ", $validated), 'cr' => $cr, 'ports' => $ports, 'yachts' => $yachts, 'isedit' => true]);
         } else {
            $validated = $validator->validated();
            $cr->update($validated);
            return redirect("cruises")->with('success', 'Rejs został dodany pomyślnie!');  
         } 
 
       } 
       return view("cruises/addedit", ['errors' => '', 'cr' => $cr, 'ports' => $ports, 'yachts' => $yachts, 'isedit' => true ]);      
    }
    
    public function delete($id) {
        $cr = Cruises::find($id);
        if ($cr) {
            $cr->delete();
            return redirect("cruises")->with('success', 'Rejs został usunięty');
        } 
        return redirect("cruises")->with('error', 'Nie znaleziono rejsu');
    }   


    public function albums($id) {
        $cr = Cruises::find($id);
      
        if ($cr) {
            $albums = $cr->albums()->get();
      
            return view("cruises/albums/list", ["cr" => $cr, 'albums' => $albums]);
        }
        return redirect("cruises")->with('error', 'Nie znaleziono statku');  
    }

    public function album_add($id, Request $request) {
       $save =  $request->input('save');
       $album = new Albums();
       $cr = Cruises::find($id);
       if ($cr) {
            if ($save) { 
                $validator = Validator::make($request->all(), 
                    [
                        'name' => 'required|string|max:100',
                    ],
                    [
                        'name.required' => "Pole Nazwa jest wymagane",
                        'name.max' => "Pole Nazwa jest za długie",
                    ]
                );
        
                if ($validator->fails()) {
                    $validated = $validator->errors()->all();
                    $album = new Albums($request->all());
                    return view("cruises/albums/addedit", ['errors' => implode(", ", $validated), 'album' => $album]);
                } else {
                    $validated = $validator->validated();
                    $cr->albums()->create($request->all());
                    return redirect("cruises/albums/".$cr->id)->with('success', 'Album został dodany pomyślnie!');
                } 
            }
            return view("cruises/albums/addedit", ['errors' => '', 'album' => $album]);
       }
       return redirect("cruises")->with('error', 'Nie znaleziono rejsu');  
    }

    public function album_edit($id, $aid, Request $request) {
       $save =  $request->input('save');
       $album = Albums::find($aid);
       if (!$album) {
            return redirect("cruises")->with('error', 'Nie znaleziono albumu');  
       }
       $cr = Cruises::find($id);
       if ($cr) {
            if ($save) { 
                $validator = Validator::make($request->all(), 
                    [
                        'name' => 'required|string|max:100',
                    ],
                    [
                        'name.required' => "Pole Nazwa jest wymagane",
                        'name.max' => "Pole Nazwa jest za długie",
                    ]
                );
        
                if ($validator->fails()) {
                    $validated = $validator->errors()->all();
                    $album = new Albums($request->all());
                    return view("cruises/albums/addedit", ['errors' => implode(", ", $validated), 'album' => $album, 'isedit' => true]);
                } else {
                    $validated = $validator->validated();
                    $album->update($request->all());
                    return redirect("cruises/albums/".$cr->id)->with('success', 'Album został edytowany pomyślnie!');
                } 
            }
            return view("cruises/albums/addedit", ['errors' => '', 'album' => $album, 'isedit' => true]);
       }
       return redirect("cruises")->with('error', 'Nie znaleziono rejsu');  
 
    }
 
    public function album_delete($id, $aid) {
       $album = Albums::find($aid);
       if (!$album) {
            return redirect("cruises")->with('error', 'Nie znaleziono albumu');  
       }
       $cr =  Cruises::find($id);
       if ($cr) {
           $album->delete();
           return redirect("cruises/albums/".$cr->id)->with('success', 'Album został usunięty');
       }
       return redirect("cruises")->with('error', 'Nie znaleziono rejsu'); 
    }


    

    public function clients($id, Request $request) {
       $cr = Cruises::find($id);
       if (!$cr) {
            return redirect("cruises")->with('error', 'Nie znaleziono rejsu'); 
       }
       $clients = $cr->clients()->get();
       return view("cruises/clients", ['errors' => '', 'clients' => $clients, 'cr' => $cr]);
    }

    public function cruises_delete($id, $cid) {
        $cr = Cruises::find($id);
        if ($cr) {
            ClientCourses::where("client_id", $cid)->where("course_id", $id)->delete();
            return redirect("cruises/clients/".$id)->with('success', 'Klient został usunięty usunięty z rejsu');
        } 
        return redirect("cruises")->with('error', 'Nie znaleziono rejsu');

    }


}
