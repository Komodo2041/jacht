<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


use App\Models\Nationality;


class NationalityController extends Controller
{
    public function list() {
       $nationality = Nationality::all(); 
       return view("nationality/list", ["nationality" => $nationality]);
    }

    public function add(Request $request) {
       $save =  $request->input('save');
       $country = new Nationality();
      
       if ($save) {
    
          $validator = Validator::make($request->all(), [
             'name' => 'required|max:100'
          ],
          [
             'name.required' => "Nazwa kraju jest wymagana"
          ]  
          );
 
         if ($validator->fails()) {
               $validated = $validator->errors()->all();
               $country = new Nationality($request->all());
               return view("nationality/addedit", ['errors' => implode(", ", $validated), 'country' => $country]);
         } else {
            $validated = $validator->validated();
            Nationality::create($validated);
            return redirect("nationality")->with('success', 'Kraj został dodany pomyślnie!');
         } 
 
       }
       return view("nationality/addedit", ['errors' => '', 'country' => $country]);
    }

    public function edit($id, Request $request) {
        $country = Nationality::find($id);
        $save =  $request->input('save');
        if ($country) { 
           if ($save ) {
                $validator = Validator::make($request->all(), [
                    'name' => 'required|max:100'
                ],
                [
                    'name.required' => "Nazwa kraju jest wymagana"
                ]  
                );
      
               if ($validator->fails()) {
                     $validated = $validator->errors()->all();
                     $country = new Nationality($request->all());
                     return view("nationality/addedit", ['errors' => implode(", ", $validated), 'country' => $country, 'isedit' => true]);
               } else {
                  $validated = $validator->validated();
                  $country->update($validated);
                  return redirect("nationality")->with('success', 'Kraj został edytowany pomyślnie!');
               } 
           }  
           return view("nationality/addedit", ['country' => $country, 'errors' => "", 'isedit' => true]);
        } 
        return redirect("nationality")->with('error', 'Nie znaleziono kraju');        
    }
    
    public function delete($id) {
        $country = Nationality::find($id);
        if ($country) {
            $country->delete();
            return redirect("nationality")->with('success', 'Kraj został usunięty');
        } 
        return redirect("nationality")->with('error', 'Nie znaleziono Kraju');
    }   
 
}
