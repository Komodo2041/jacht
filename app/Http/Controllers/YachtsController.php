<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Yachts;
use App\Models\Producer;
use App\Models\Models;
use App\Models\Types;

use Illuminate\Support\Facades\Validator;

class YachtsController extends Controller
{
    public function list() {
 
       $yachts = Yachts::with(["models", "type"])->get();
       return view("yachts/list", ["yachts" => $yachts]);
    }

    public function add(Request $request) {
       $save =  $request->input('save');
       $producer = Producer::with("models")->get();
       $yacht = new Yachts();
       $types = Types::all();

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
            'type_id' => 'required|integer'
        ]);

        if ($validator->fails()) {
            $yacht = new Yachts($request->all()); 
            return view("yachts/addedit", ['errors' => $this->getErrors($validator->errors()), "producer" => $producer, 'yacht' => $yacht, 'types' => $types]);
        } else {
            Yachts::create($request->all());
            return redirect("yachts")->with('success', 'Statek został dodany pomyślnie!');
        }
 
       }
       return view("yachts/addedit", ['errors' => '', "producer" => $producer, 'yacht' => $yacht, 'types' => $types]);
    }

   public function edit($id, Request $request) {
        $yacht = Yachts::find($id);
        $save =  $request->input('save');
        $producer = Producer::with("models")->get();
        $types = Types::all();

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
                    'type_id' => 'required|integer'
                ]);     

                 if (!$validator->fails()) {
                    $yacht->update($request->all());
                    $yacht->save();
                    return redirect("yachts")->with('success', 'Statek został pomyślnie edytowany!');
                 } else {
                    $yacht = new Yachts($request->all()); 
                    return view("yachts/addedit", ['errors' => $this->getErrors($validator->errors()), "producer" => $producer, 'yacht' => $yacht, 'isedit' => true, 'types' => $types]);
                 }
           }  
           return view("yachts/addedit", ['errors' => '', "producer" => $producer, 'yacht' => $yacht, 'isedit' => true, 'types' => $types]);
        } 
        return redirect("yachts")->with('error', 'Nie znaleziono statku');        
    }


    private function getErrors($errors) {
        return implode(", ", $errors->all());
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
