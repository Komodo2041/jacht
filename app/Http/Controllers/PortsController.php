<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Ports;
use App\Models\Nationality;

class PortsController extends Controller
{
   
    public function list() {

       $ports = Ports::with("country")->get(); 
       return view("ports/list", ["ports" => $ports]);
    }

    public function add(Request $request) {
       $save =  $request->input('save');
       $nationality = Nationality::all();
       if ($save) {
          $name =  trim($request->input('name'));
          $country = (int) $request->input('country_id');
          if ($name) {
              Ports::create(["name" => $name, "country_id" => $country]);
              return redirect("ports")->with('success', 'Port został dodany pomyślnie!');
          } else {
             return view("ports/add", ['errors' => "Podaj Nazwę", "country" => $nationality]);
          }
       }
       return view("ports/add", ['errors' => '', "country" => $nationality]);
    }

    public function edit($id, Request $request) {
        $port = Ports::find($id);
        $save =  $request->input('save');
        $nationality = Nationality::all();
        if ($port) { 
           if ($save ) {
                 $name =  trim($request->input('name'));
                 $country =  (int) $request->input('country_id');
                 if ($name) {
                    $port->name = $name;
                    $port->country_id = $country;
                    $port->save();
                    return redirect("ports")->with('success', 'Port został pomyślnie edytowany!');
                 } else {
                    return view("ports/edit", ['errors' => "Podaj Nazwę", 'port' => $port, "country" => $nationality]);
                 }
           }  
           return view("ports/edit", ['port' => $port, 'errors' => "", "country" => $nationality]);
        } 
        return redirect("ports")->with('error', 'Nie znaleziono portu');        
    }
    
    public function delete($id) {
        $port = Ports::find($id);
        if ($port) {
            $port->delete();
            return redirect("ports")->with('success', 'Port został usunięty');
        } 
        return redirect("ports")->with('error', 'Nie znaleziono portu');
    }    

}
