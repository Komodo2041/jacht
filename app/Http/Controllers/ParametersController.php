<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Parameters;

use Illuminate\Support\Facades\Validator;

class ParametersController extends Controller
{
    public function list() {
       $param = Parameters::all(); 
       return view("parameters/list", ["params" => $param]);
    }

    public function add(Request $request) {
       $save =  $request->input('save');
       $paramModel = new Parameters();
      
       if ($save) {
    
          $validator = Validator::make($request->all(), [
             'name' => 'required|max:100',
             'unit' => 'nullable|max:20', 
          ], [
             'name.required' => "Pola nazwa jest wymagane",
             'name.max' => "Pola nazwa została podana za długa",
             'unit.max' => "Pole jednostka jest za długie"
          ]       
        );
 
         if ($validator->fails()) {
               $validated = $validator->errors()->all();
               $paramModel = new Parameters($request->all());
               return view("parameters/addedit", ['errors' => implode(", ", $validated), 'param' => $paramModel]);
         } else {
            $validated = $validator->validated();
            Parameters::create($validated);
            return redirect("parameters")->with('success', 'Parametr został dodany pomyślnie!');
         } 
 
       }
       return view("parameters/addedit", ['errors' => '', 'param' => $paramModel]);
    }

    public function edit($id, Request $request) {
        $paramModel = Parameters::find($id);
        $save =  $request->input('save');
        if ($paramModel) { 
           if ($save ) {
                $validator = Validator::make($request->all(), [
                    'name' => 'required|max:100',
                    'unit' => 'nullable|max:20', 
                ], [
                    'name.required' => "Pola nazwa jest wymagane",
                    'name.max' => "Pola nazwa została podana za długa",
                    'unit.max' => "Pole jednostka jest za długie"
                ]       
                );
      
               if ($validator->fails()) {
                     $validated = $validator->errors()->all();
                     $paramModel = new Parameters($request->all());
                     return view("parameters/addedit", ['errors' => implode(", ", $validated), 'param' => $paramModel, 'isedit' => true]);
               } else {
                  $validated = $validator->validated();
                  $paramModel->update($validated);
                  return redirect("parameters")->with('success', 'Parametr został edytowany pomyślnie!');
               } 
           }  
           return view("parameters/addedit", ['param' => $paramModel, 'errors' => "", 'isedit' => true]);
        } 
        return redirect("parameters")->with('error', 'Nie znaleziono parametru');        
    }
    
    public function delete($id) {
        $param = Parameters::find($id);
        if ($param) {
            $param->delete();
            return redirect("parameters")->with('success', 'Parametr został usunięty');
        } 
        return redirect("parameters")->with('error', 'Nie znaleziono parametru');
    }   
}
