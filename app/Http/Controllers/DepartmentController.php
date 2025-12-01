<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Departments;

class DepartmentController extends Controller
{
    
    public function list() {
       $dept = Departments::all();
       return view("departments/list", ["depts" => $dept]);
    }

    public function add(Request $request) {
       $save =  $request->input('save');
       if ($save) {
          $name =  trim($request->input('name'));
          if ($name) {
              Departments::create(["name" => $name]);
              return redirect("departments")->with('success', 'Departament został dodany pomyślnie!');
          } else {
             return view("departments/add", ['errors' => "Podaj Nazwę"]);
          }
       }
       return view("departments/add", ['errors' => '']);
    }

    public function edit($id, Request $request) {
        $dept = Departments::find($id);
        $save =  $request->input('save');
        if ($dept) { 
           if ($save ) {
                 $name = trim($request->input('name'));
                 if ($name) {
                    $dept->name = $name;
                    $dept->save();
                    return redirect("departments")->with('success', 'Departament został pomyślnie edytowany!');
                 } else {
                    return view("departments/edit", ['errors' => "Podaj Nazwę", 'dept' => $dept]);
                 }
           }  
           return view("departments/edit", ['dept' => $dept, 'errors' => ""]);
        }
        return redirect("departments")->with('error', 'Nie znaleziono departamentu');        
    }
    
    public function delete($id) {
        $dept = Departments::find($id);
        if ($dept) {
            $dept->delete();
            return redirect("departments")->with('success', 'Departament został usunięty');
        } 
        return redirect("departments")->with('error', 'Nie znaleziono Departament został');
    }    


}
