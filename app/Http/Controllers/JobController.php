<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Job;
use App\Models\Departments;

class JobController extends Controller
{
    public function list() {
 
       $jobs = Job::with("department")->get(); 
 
       return view("jobs/list", ["jobs" => $jobs]);
    }

    public function add(Request $request) {
       $save =  $request->input('save');
       $depts = Departments::all();
       if ($save) {
          $name = trim($request->input('name'));
          $dept = (int) trim($request->input('dept'));
          if ($name) {
              Job::create(["name" => $name, "dept_id" => $dept]);
              return redirect("jobs")->with('success', 'Stanowisko zostało dodane pomyślnie!');
          } else {
             return view("jobs/add", ['errors' => "Podaj Nazwę", "depts" => $depts]);
          }
       }
       return view("jobs/add", ['errors' => '', "depts" => $depts]);
    }

    public function edit($id, Request $request) {
        $job = Job::find($id);
        $depts = Departments::all();
        $save =  $request->input('save');
        if ($job) { 
           if ($save ) {
                 $name =  trim($request->input('name'));
                 $dept = (int) trim($request->input('dept'));
                 if ($name) {
                    $job->name = $name;
                    $job->dept_id = $dept;
                    $job->save();
                    return redirect("jobs")->with('success', 'Stanowisko zostało pomyślnie edytowane!');
                 } else {
                    return view("jobs/edit", ['errors' => "Podaj Nazwę", 'job' => $job, "depts" => $depts]);
                 }
           }  
           return view("jobs/edit", ['job' => $job, 'errors' => "", "depts" => $depts]);
        } 
        return redirect("job")->with('error', 'Nie znaleziono stanowiska');        
    }
    
    public function delete($id) {
        $job = Job::find($id);
        if ($job) {
            $job->delete();
            return redirect("jobs")->with('success', 'Stanowisko zostało usunięte');
        } 
        return redirect("jobs")->with('error', 'Nie znaleziono stanowiska');
    } 
}
