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
       
       if ($yacht) {
            return view("yachts/show", ['yacht' => $yacht ]);
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

}
