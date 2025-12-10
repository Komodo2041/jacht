<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Yachts;
use App\Models\Producer;
use App\Models\Models;
use App\Models\Types;

use App\Models\Ports;
use App\Models\ActualPort;
use App\Models\Parameters;
use App\Models\YachtsParametrs;
use App\Models\Equipment_category;
use App\Models\YachtEq;

 
use Illuminate\Support\Facades\Validator;

class YachtsController extends Controller
{
    public function list() {
 
       $yachts = Yachts::with(["models", "type", "port"])->get();
       return view("yachts/list", ["yachts" => $yachts]);
    }

    public function add(Request $request) {
       $save =  $request->input('save');
       $producer = Producer::with("models")->get();
       $yacht = new Yachts();
       $types = Types::all();
       $ports = Ports::all();
 
       if ($save) {

        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'build_year' => 'required|integer',
            'length_meters' => 'required|integer',
            'producer_id' => 'nullable|integer',
            'model_id' => 'nullable|integer',
            'engine_count' => 'required|integer|min:1',
            'cabins' => 'required|integer|min:1',
            'berths' => 'required|integer|min:1',
            'fuel_tank_liters' => 'required|integer|min:1',
            'water_tank_liters' => 'required|integer|min:1',
            'propeller_type' => 'required|in:fixed,folding',
            'engine_brand' => 'nullable|string|max:200',
            'engine_model' => 'nullable|string|max:200',
            'model' => 'nullable|string|max:200',
            'type_id' => 'required|integer', 
            'port_id' => 'required|integer',
            'engine_power_hp' => 'required|integer',
        ]);

        if ($validator->fails()) {
            $yacht = new Yachts($request->all()); 
            return view("yachts/addedit", ['errors' => $this->getErrors($validator->errors()), "producer" => $producer, 'yacht' => $yacht, 'types' => $types, 'ports' => $ports]);
        } else {
            $yacht = Yachts::create($request->all());
            ActualPort::create(["yachts_id" => $yacht->id, "port_id" => $request->input('port_id')]);
            return redirect("yachts")->with('success', 'Statek został dodany pomyślnie!');
        }
 
       }
       return view("yachts/addedit", ['errors' => '', "producer" => $producer, 'yacht' => $yacht, 'types' => $types, 'ports' => $ports]);
    }

   public function edit($id, Request $request) {
        $yacht = Yachts::find($id);
        $save =  $request->input('save');
        $producer = Producer::with("models")->get();
        $types = Types::all();
        $ports = Ports::all();

        if ($yacht) { 
           if ($save) {
 
                $validator = Validator::make($request->all(), [
                    'name' => 'required|string|max:255',
                    'build_year' => 'required|integer',
                    'length_meters' => 'required|integer',
                    'producer_id' => 'nullable|integer',
                    'model_id' => 'nullable|integer',
                    'engine_count' => 'required|integer|min:1',
                    'cabins' => 'required|integer|min:1',
                    'berths' => 'required|integer|min:1',
                    'fuel_tank_liters' => 'required|integer|min:1',
                    'water_tank_liters' => 'required|integer|min:1',
                    'propeller_type' => 'required|in:fixed,folding',
                    'engine_brand' => 'nullable|string|max:200',
                    'engine_model' => 'nullable|string|max:200',
                    'model' => 'nullable|string|max:200',
                    'type_id' => 'required|integer',
                    'port_id' => 'required|integer',
                    'engine_power_hp' => 'required|integer',                    
                ]);     

                 if (!$validator->fails()) {
                    $yacht->update($request->all()); 
                    $yacht->save();
                    $this->saveport($yacht->id, $request->input('port_id')); 
                    return redirect("yachts")->with('success', 'Statek został pomyślnie edytowany!');
                 } else {
                    $yacht = new Yachts($request->all()); 
                    return view("yachts/addedit", ['errors' => $this->getErrors($validator->errors()), "producer" => $producer, 'yacht' => $yacht, 'isedit' => true, 'types' => $types, 'ports' => $ports]);
                 }
           }  
           return view("yachts/addedit", ['errors' => '', "producer" => $producer, 'yacht' => $yacht, 'isedit' => true, 'types' => $types, 'ports' => $ports]);
        } 
        return redirect("yachts")->with('error', 'Nie znaleziono statku');        
    }
 
    private function saveport($yacht_id, $port_id) {
        $actport = ActualPort::where("yachts_id", $yacht_id)->first();
        if ($actport) {
            $actport->port_id = $port_id;
            $actport->save();
        } else {
            ActualPort::create(["yachts_id" => $yacht_id, "port_id" => $port_id]);
        }
        
    } 

    private function getErrors($errors) {
        return implode(", ", $errors->all());
    }

    public function changeport($id, Request $request) {
        $save =  $request->input('save');
        $yacht = Yachts::find($id);
        $ports = Ports::all();
        if ($yacht) {
            if ($save) {
                $validator = Validator::make($request->all(), ['port_id' => 'required|integer'], ['port_id.required' => "Port jest wymagany"]);
                if (!$validator->fails()) {
                    $this->saveport($yacht->id, $request->input('port_id'));
                    return redirect("yachts")->with('success', 'Port został zmieniony!');
                } else {
                  return view("yachts/changeport", ['errors' => $this->getErrors($validator->errors()), 'yacht' => $yacht, 'ports' => $ports]);
                }
            }
            return view("yachts/changeport", ['errors' => '', 'yacht' => $yacht, 'ports' => $ports]);
        }
        return redirect("yachts")->with('error', 'Nie znaleziono statku');
    }  

    public function show($id) {
       $yacht = Yachts::find($id); 
       $usedEq = $yacht->equimpents()->with("category")->get(); 
       $res = [];
       foreach ($usedEq AS $eq) {
          $res[$eq->category->name][] = ["id" => $eq->id, "name" => $eq->name, "value" => $eq->pivot->value ];
       }
 
       if ($yacht) {
            return view("yachts/show", ['yacht' => $yacht, 'eqs' => $res]);
       }
    }

    public function delete($id) {
        $yacht = Yachts::find($id);
        if ($yacht) {
            $yacht->delete();
            return redirect("yachts")->with('success', 'Statek został usunięty');
        } 
        return redirect("yachts")->with('error', 'Nie znaleziono statku');
    }
    
    public function parametrs($id) {

       $yacht = Yachts::find($id);
       $usedparams = $yacht->parametrs;
 
       if ($yacht) {
          return view("yachts/params", ['yacht' => $yacht, 'usedparams' => $usedparams ]);
       }
       return redirect("yachts")->with('error', 'Nie znaleziono statku');
    }     

    public function parametrsChange($id, Request $request) {
       $save =  $request->input('save');
       $params = Parameters::all();
       $yacht = Yachts::find($id);
       $usedparams = $yacht->parametrs;
       $currentValues = $usedparams->pluck('pivot.value', 'id')->toArray();
 
       if ($yacht) {
           if ($save) {
                $messages = $this->createMessagesParametrs($params);
                $validator = Validator::make($request->all(), [ 
                    'params.*' => 'nullable|string|max:100',
                ], $messages);
                if (!$validator->fails()) {
                    YachtsParametrs::where("yacht_id", $yacht->id)->delete();
                    $data = $request->input('params');
                    foreach ($data AS $key => $value) {
                        if (trim($value)) {
                            YachtsParametrs::create(["yacht_id" => $yacht->id, "parametr_id" => $key, "value" => trim($value)]);
                        }
                    }
                    return redirect("/yachts/parameters/".$id)->with('error', 'Zmieniono dodatkowe parametry');
                     
                } else {
                    return view("yachts/paramschange", ['errors' => $this->getErrors($validator->errors()), 'params' => $params, 'yacht' => $yacht, 'currentValues' => $currentValues]);
                }
           }  
           return view("yachts/paramschange", ['errors' => '', 'params' => $params, 'yacht' => $yacht, 'usedparams' => $usedparams, 'currentValues' => $currentValues]);
       }
       return redirect("yachts")->with('error', 'Nie znaleziono statku');
    }

    public function equimpents($id, Request $request) {
       $save =  $request->input('save');
       $eqs = Equipment_category::with("equipments")->get();
       $yacht = Yachts::find($id);
       $usedEq = $yacht->equimpents()->pluck('yacht_equipments.value' , 'equipment.id')->toArray();
       
       if ($yacht) {
           if ($save) {    
               
                $messages = $this->createMessagesEq($eqs);
                $validator = Validator::make($request->all(), [ 
                    'eq.val*' => 'nullable|string|max:100',
                ], $messages);
                if (!$validator->fails()) {
                    YachtEq::where("yacht_id", $yacht->id)->delete();
                    $data = $this->getEqsData($request->input('eq'));
                    foreach ($data AS $key => $param) {
                      
                       YachtEq::create([
                           "yacht_id" =>  $yacht->id,
                           "eq_id" =>  (int) $key,
                           "value" => isset($param['value']) ? $param['value'] : null
                       ]);
                    }
                     return redirect("/yachts/show/".$id)->with('error', 'Zmieniono wyposażenie');
               
                } else {
                    return view("yachts/eqs", ['errors' => $this->getErrors($validator->errors()), 'yacht' => $yacht, "eqs" =>  $eqs, 'currentValues' => $usedEq]);
                }
           }  
           return view("yachts/eqs", ['errors' => '', 'yacht' => $yacht, "eqs" =>  $eqs, 'currentValues' => $usedEq]);
       }
       return redirect("yachts")->with('error', 'Nie znaleziono statku');               
    }

    private function createMessagesParametrs($params) {
        $res = [];
        foreach ($params AS $param) {
           $res['params.'.$param->id] = "Pole '".$param->name."' jest za długie";
        }
        return $res;
    }

    private function createMessagesEq($eqs) {
        $res = [];
        foreach ($eqs AS $eq) {
            foreach ($eq->equipments AS $param) {
                $res['eq.val'.$param->id] = "Pole '".$param->name."' jest za długie";
            }
        }
        return $res;       
    }

    private function getEqsData($param) {
        $res = [];    
        foreach ($param AS $key => $value) {
           if ($value) {
            if (str_starts_with($key, "val")) {
                $id = str_replace( "val", "", $key);
                $res[$id]['value'] = $value;
            } else {
                $res[$key]['is'] = 1;
            }
           }
        }
        return $res;
    }

    /*
    $yacht->albums()->create([
    'title'       => 'Wnętrze 2025',
    'description' => 'Zdjęcia po remoncie',
     ]);
     */

    public function albums() {

    }
 

}
