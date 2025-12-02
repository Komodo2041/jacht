<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Types;

class TypesController extends Controller
{
    public function list() {
       $types = Types::all(); 
       return view("types/list", ["types" => $types]);
    }

    public function add(Request $request) {
       $save =  $request->input('save');
       $typeModel = new Types();
      
       if ($save) {
    
          $validator = Validator::make($request->all(), [
             'name' => 'required|max:100',
             'feature' => 'required|max:200',
             'number_of_people' => 'required|max:200',
             'routes' => 'required|max:200',
             'organization_costs' => 'required|max:200',
             'requirements' => 'required|max:200',
             'body' => 'required',
          ]);
 
         if ($validator->fails()) {
               $validated = $validator->errors()->all();
               $typeModel = new Types($request->all());
               return view("types/addedit", ['errors' => implode(", ", $validated), 'type' => $typeModel]);
         } else {
            $validated = $validator->validated();
            Types::create($validated);
            return redirect("types")->with('success', 'Typ został dodany pomyślnie!');
         } 
 
       }
       return view("types/addedit", ['errors' => '', 'type' => $typeModel]);
    }

    public function edit($id, Request $request) {
        $type = Types::find($id);
        $save =  $request->input('save');
        if ($type) { 
           if ($save ) {
               $validator = Validator::make($request->all(), [
                  'name' => 'required|max:100',
                  'feature' => 'required|max:200',
                  'number_of_people' => 'required|max:200',
                  'routes' => 'required|max:200',
                  'organization_costs' => 'required|max:200',
                  'requirements' => 'required|max:200',
                  'body' => 'required',
               ]);
      
               if ($validator->fails()) {
                     $validated = $validator->errors()->all();
                     $typeModel = new Types($request->all());
                     return view("types/addedit", ['errors' => implode(", ", $validated), 'type' => $type, 'isedit' => true]);
               } else {
                  $validated = $validator->validated();
                  $type->update($validated);
                  return redirect("types")->with('success', 'Typ został edytowany pomyślnie!');
               } 
           }  
           return view("types/addedit", ['type' => $type, 'errors' => "", 'isedit' => true]);
        } 
        return redirect("types")->with('error', 'Nie znaleziono typu');        
    }
    
    public function delete($id) {
        $type = Types::find($id);
        if ($type) {
            $type->delete();
            return redirect("types")->with('success', 'Typ został usunięty');
        } 
        return redirect("types")->with('error', 'Nie znaleziono typu');
    }   

    public function show($id) {
        $type = Types::find($id);
        if ($type) {
            return view("types/show", ['type' => $type ]);
        } 
        return redirect("types")->with('error', 'Nie znaleziono typu');    
    }
}
