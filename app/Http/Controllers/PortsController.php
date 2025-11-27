<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Ports;

class PortsController extends Controller
{
   
    public function list() {

       $ports = Ports::all(); 
       return view("ports/list", ["ports" => $ports]);
    }

    public function add(Request $request) {
       $save =  $request->input('save');
       if ($save) {
          $name =  trim($request->input('name'));
          if ($name) {
              Ports::create(["name" => $name]);
              return redirect("ports")->with('success', 'Port został dodany pomyślnie!');
          } else {
             return view("ports/add", ['errors' => "Podaj Nazwę"]);
          }
       }
       return view("ports/add", ['errors' => '']);
    }

    public function edit($id, Request $request) {
        $port = Ports::find($id);
        $save =  $request->input('save');
        if ($port) { 
           if ($save ) {
                 $name =  trim($request->input('name'));
                 if ($name) {
                    $port->name = $name;
                    $port->save();
                    return redirect("ports")->with('success', 'Port został pomyślnie edytowany!');
                 } else {
                    return view("ports/edit", ['errors' => "Podaj Nazwę", 'port' => $port]);
                 }
           }  
           return view("ports/edit", ['port' => $port, 'errors' => ""]);
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
