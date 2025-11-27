<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Producer;


class ProducerController extends Controller
{
       public function list() {

       $producer = Producer::all(); 
       return view("producer/list", ["producer" => $producer]);
    }

    public function add(Request $request) {
       $save =  $request->input('save');
       $name = "";
       $volume = "";
       if ($save) {
          $name =  trim($request->input('name'));
          $volume = trim($request->input('volume'));
          $errors = $this->valid($name, $volume);
          if (!$errors) {
              Producer::create([
                 "name" => $name,
                 "volume" => $volume
              ]);
              return redirect("producer")->with('success', 'Producent został dodany pomyślnie!');
          } else {
             return view("producer/add", ['errors' => implode(", ", $errors), 'data' => ['name' => $name, 'volume' => $volume]]);
          }
       }
       return view("producer/add", ['errors' => '', 'data' => ['name' => $name, 'volume' => $volume]]);
    }

    public function edit($id, Request $request) {
        $producer = Producer::find($id);
        $save =  $request->input('save');
        if ($producer) { 
           if ($save ) {
                 $name =  trim($request->input('name'));
                 $volume = trim($request->input('volume'));
                 $errors = $this->valid($name, $volume);
                 if (!$errors) {
                    $producer->name = $name;
                    $producer->volume = $volume;
                    $producer->save();
                    return redirect("producer")->with('success', 'Producent został pomyślnie edytowany!');
                 } else {
                    return view("producer/edit", ['errors' => implode(", ", $errors), 'producer' => $producer]);
                 }
           }  
           return view("producer/edit", ['producer' => $producer, 'errors' => ""]);
        } 
        return redirect("producer")->with('error', 'Nie znaleziono producenta');        
    }

    private function valid($name, $volume) {
        $errors = [];
        if (!$name) {
            $errors[] = "Podaj nazwę";
        }
        if (!$volume) {
            $errors[] = "Podaj skalę produkcji";
        }        
        return $errors;
    }
    
    public function delete($id) {
        $producer = Producer::find($id);
        if ($producer) {
            $producer->delete();
            return redirect("producer")->with('success', 'Producent został usunięty');
        } 
        return redirect("producer")->with('error', 'Nie znaleziono producenta');
    }    
}
