<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Equipment_category AS Category;

class EquipmentCategoryController extends Controller
{
    public function list() {

       $category = Category::all(); 
       return view("categoryeq/list", ["category" => $category]);
    }

    public function add(Request $request) {
       $save =  $request->input('save');
       $category = new Category();
       if ($save) {
          $name =  trim($request->input('name'));
          $body =  trim($request->input('body'));
          $errors = $this->valid($name, $body);
          if (!$errors) {
              Category::create(["name" => $name, "body" => $body]);
              return redirect("categories")->with('success', 'Kategoria została dodana pomyślnie!');
          } else {
            $category = new Category(["name" => $name, "body" => $body]);
            return view("categoryeq/addedit", ['errors' =>  implode(", ", $errors), 'category' => $category]);
          }
       }
       return view("categoryeq/addedit", ['errors' => '', 'category' => $category]);
    }

    private function valid($name, $body) {
        $errors = [];
        if (!$name) {
            $errors[] = "Podaj nazwę kategori";
        }
        if (!$body) {
            $errors[] = "Podaj opis";
        }        
        return $errors;
    }

    public function edit($id, Request $request) {
        $category = Category::find($id);
        $save =  $request->input('save');
        if ($category) { 
           if ($save) {
                 $name =  trim($request->input('name'));
                 $body =  trim($request->input('body'));
                 $errors = $this->valid($name, $body);
                 if (!$errors ) {
                    $category->name = $name;
                    $category->body = $body;
                    $category->save();
                    return redirect("categories")->with('success', 'Kategoria została pomyślnie edytowana!');
                 } else {
                    $category = new Category(["name" => $name, "body" => $body]);
                    return view("categoryeq/addedit", ['errors' => implode(", ", $errors), 'category' => $category, "isedit" => true]);
                 }
           }  
           return view("categoryeq/addedit", ['category' => $category, 'errors' => "", "isedit" => true]);
        } 
        return redirect("categories")->with('error', 'Nie znaleziono kategorii');        
    }
    
    public function delete($id) {
        $category = Category::find($id);
        if ($category) {
            $category->delete();
            return redirect("categories")->with('success', 'Kategoria została usunięta');
        } 
        return redirect("categories")->with('error', 'Nie znaleziono Kategorii');
    }   
}
