<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Producer;
use App\Models\Models;

class ProducerController extends Controller
{
    public function list() {

       $producer = Producer::with('models')->get();
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

    public function modelList($id) {
       $models = Models::where("producer_id", $id)->get(); 
       $producer = Producer::find($id);
       return view("producer/models/list", ["models" => $models, "id" => $id, "producer" => $producer]);
    }

    public function modelAdd($id, Request $request) {
       $save =  $request->input('save');
       $name = "";
       $body = "";
       if ($save) {
          $name =  trim($request->input('name'));
          $body = trim($request->input('body'));
          $errors = $this->validModel($name, $body);
          if (!$errors) {
              Models::create([
                 "producer_id" => $id,
                 "name" => $name,
                 "body" => $body
              ]);
              return redirect("/producer/".$id."/models")->with('success', 'Model został dodany pomyślnie!');
          } else {
             return view("producer/models/add", ['errors' => implode(", ", $errors), 'data' => ['name' => $name, 'body' => $body]]);
          }
       }
       return view("producer/models/add", ['errors' => '', 'data' => ['name' => $name, 'body' => $body]]);        
    }

    public function modelEdit($id, $modelid, Request $request) {
        $model = Models::find($modelid);
        $save =  $request->input('save');
        if ($model) { 
           if ($save ) {
                 $name =  trim($request->input('name'));
                 $body = trim($request->input('body'));
                 $errors = $this->validModel($name, $body);
                 if (!$errors) {
                    $model->name = $name;
                    $model->body = $body;
                    $model->save();
                    return redirect("/producer/".$id."/models")->with('success', 'Model został pomyślnie edytowany!');
                 } else {
                    return view("producer/models/edit", ['model' => $model, 'errors' => implode(", ", $errors)]);
                 }
           }  
           return view("producer/models/edit", ['model' => $model, 'errors' => ""]);
        } 
        return redirect("/producer/".$id."/models")->with('error', 'Nie znaleziono modelu');        
    }


    private function validModel($name, $body) {
        $errors = [];
        if (!$name) {
            $errors[] = "Podaj nazwę";
        }
        if (!$body) {
            $errors[] = "Podaj Opis modelu";
        }        
        return $errors;
    }

    public function modelDelete($id, $modelId) {
        $model = Models::find($modelId);
        if ($model) {
            $model->delete();
            return redirect("/producer/".$id."/models")->with('success', 'Model został usunięty');
        } 
        return redirect("/producer/".$id."/models")->with('error', 'Nie znaleziono modelu');       
    }

}
