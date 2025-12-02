<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Equipment_category AS Category;
use App\Models\Equipments;


class EquipmentController extends Controller
{
 
    public function list(Request $request) {
       $cats = Category::all();
       $catId = (int) trim($request->input('category_id'));
        
       if ($catId) {
           $eqs = Equipments::with("category")->where('category_id', $catId)->get();
       } else {
           $eqs = Equipments::with("category")->get();
       } 
       return view("categoryeq/eq/list", ["eqs" => $eqs, 'category' => $cats, 'catid' => $catId]);
    }

    public function add(Request $request) {
       $save =  $request->input('save');
       $cats = Category::all();
       $eq = new Equipments();
       if ($save) {
          $name = trim($request->input('name'));
          $body = trim($request->input('body'));
          $catId = trim($request->input('category_id'));
          $errors = $this->valid($name, $body, $catId);
          if (!$errors) {
              Equipments::create(["name" => $name, "body" => $body, "category_id" => $catId]);
              return redirect("equipments")->with('success', 'Wyposażenie zostało dodane pomyślnie!');
          } else {
             $eq = new Equipments(["name" => $name, "body" => $body, "category_id" => $catId]);
             return view("categoryeq/eq/addedit", ['errors' => implode(", ", $errors), "eq" => $eq, 'category' => $cats]);
          }
       }
       return view("categoryeq/eq/addedit", ['errors' => '', "eq" => $eq, 'category' => $cats]);
    }

    private function valid($name, $body, $catId) {
        $errors = [];
        if (!$name) {
            $errors[] = "Podaj nazwę kategori";
        }
        if (!$body) {
            $errors[] = "Podaj opis";
        }
        if (!$catId) {
            $errors[] = "Podaj kategorię wyposażenia";
        }               
        return $errors;
    }

    public function edit($id, Request $request) {
        $eq = Equipments::find($id);
        $save =  $request->input('save');
        $cats = Category::all();
        if ($eq) { 
           if ($save ) {
                $name = trim($request->input('name'));
                $body = trim($request->input('body'));
                $catId = trim($request->input('category_id'));
                $errors = $this->valid($name, $body, $catId);
                 if (!$errors) {
                    $eq->name = $name;
                    $eq->body = $body;
                    $eq->category_id = $catId;
                    $eq->save();
                    return redirect("equipments")->with('success', 'Wyposażenie zostało pomyślnie edytowane!');
                 } else {
                    $eq = new Equipments(["name" => $name, "body" => $body, "category_id" => $catId]);
                    return view("categoryeq/eq/addedit", ['errors' => implode(", ", $errors), 'eq' => $eq, "isedit" => true, 'category' => $cats]);
                 }
           }  
           return view("categoryeq/eq/addedit", ['eq' => $eq, 'errors' => "", "isedit" => true, 'category' => $cats]);
        } 
        return redirect("equipments")->with('error', 'Nie znaleziono wyposażenia');        
    }
    
    public function delete($id) {
        $eq = Equipments::find($id);
        if ($eq) {
            $eq->delete();
            return redirect("equipments")->with('success', 'Wyposażenie zostało usunięte');
        } 
        return redirect("equipments")->with('error', 'Nie znaleziono wyposażenia');
    }        

}
