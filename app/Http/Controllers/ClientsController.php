<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Validator;


use App\Models\Clients;

class ClientsController extends Controller
{
    public function list() {
       $clients = Clients::all(); 
       return view("clients/list", ["clients" => $clients]);
    }

    public function add(Request $request) {
       $save =  $request->input('save');
       $client = new Clients();
      
       if ($save) {
    
          $validator = Validator::make($request->all(), [
             'firstname' => 'required|max:100',
             'lastname' => 'required|max:200',
             'email' => 'required|email|max:200',
             'phone' => 'required|max:200'
          ]);
 
         if ($validator->fails()) {
               $validated = $validator->errors()->all();
               $client = new Clients($request->all());
               return view("clients/addedit", ['errors' => implode(", ", $validated), 'client' => $client]);
         } else {
            $validated = $validator->validated();
            Clients::create($validated);
            return redirect("clients")->with('success', 'Klient został dodany pomyślnie!');
         } 
 
       }
       return view("clients/addedit", ['errors' => '', 'client' => $client]);
    }

    public function edit($id, Request $request) {
        $client = Clients::find($id);
        $save =  $request->input('save');
        if ($client) { 
           if ($save ) {
                $validator = Validator::make($request->all(), [
                    'firstname' => 'required|max:100',
                    'lastname' => 'required|max:200',
                    'email' => 'required|email|max:200',
                    'phone' => 'required|max:200'
                ]);
      
               if ($validator->fails()) {
                     $validated = $validator->errors()->all();
                     $client = new Clients($request->all());
                     return view("clients/addedit", ['errors' => implode(", ", $validated), 'client' => $client, 'isedit' => true]);
               } else {
                  $validated = $validator->validated();
                  $client->update($validated);
                  return redirect("clients")->with('success', 'Klient został edytowany pomyślnie!');
               } 
           }  
           return view("clients/addedit", ['client' => $client, 'errors' => "", 'isedit' => true]);
        } 
        return redirect("clients")->with('error', 'Nie znaleziono klienta');        
    }
    
    public function delete($id) {
        $client = Clients::find($id);
        if ($client) {
            $client->delete();
            return redirect("clients")->with('success', 'Klient został usunięty');
        } 
        return redirect("clients")->with('error', 'Nie znaleziono klienta');
    }   
}
