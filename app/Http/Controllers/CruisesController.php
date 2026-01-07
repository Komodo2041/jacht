<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Cruises;
use App\Models\Ports; 

use Illuminate\Support\Facades\Validator;

class CruisesController extends Controller
{

    public function list() {
       $cruises = Cruises::all(); 
       return view("cruises/list", ["cruises" => $cruises]);
    }

    public function add(Request $request) {
       $save =  $request->input('save');
       $cr = new Cruises();
       $ports = Ports::all();
       $yachts = Yachts::with("port")->get();

       /*
       if ($save) {
    
          $validator = Validator::make($request->all(), [
             'name' => 'required|max:100'
          ],
          [
             'name.required' => "Nazwa dokumentu jest wymagana"
          ]  
          );
 
         if ($validator->fails()) {
               $validated = $validator->errors()->all();
               $typeModel = new DocumentsTypes($request->all());
               return view("documentstypes/addedit", ['errors' => implode(", ", $validated), 'type' => $typeModel]);
         } else {
            $validated = $validator->validated();
            DocumentsTypes::create($validated);
            return redirect("documentstypes")->with('success', 'Typ dokumentu został dodany pomyślnie!');
         } 
 
       } */
       return view("cruises/addedit", ['errors' => '', 'cr' => $cr, 'ports' => $ports, 'yachts' => $yachts ]);
    }

    public function edit($id, Request $request) {
        $type = DocumentsTypes::find($id);
        $save =  $request->input('save');
        if ($type) { 
           if ($save ) {
                $validator = Validator::make($request->all(), [
                    'name' => 'required|max:100'
                ],
                [
                    'name.required' => "Nazwa dokumentu jest wymagana"
                ]  
                );
      
               if ($validator->fails()) {
                     $validated = $validator->errors()->all();
                     $typeModel = new DocumentsTypes($request->all());
                     return view("documentstypes/addedit", ['errors' => implode(", ", $validated), 'type' => $type, 'isedit' => true]);
               } else {
                  $validated = $validator->validated();
                  $type->update($validated);
                  return redirect("documentstypes")->with('success', 'Typ dokumentu został edytowany pomyślnie!');
               } 
           }  
           return view("documentstypes/addedit", ['type' => $type, 'errors' => "", 'isedit' => true]);
        } 
        return redirect("documentstypes")->with('error', 'Nie znaleziono typu dokumentu');        
    }
    
    public function delete($id) {
        $type = DocumentsTypes::find($id);
        if ($type) {
            $type->delete();
            return redirect("documentstypes")->with('success', 'Typ dokumentu został usunięty');
        } 
        return redirect("documentstypes")->with('error', 'Nie znaleziono typu dokumentu');
    }   


}
