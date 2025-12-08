<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Yachts;

class YachtsController extends Controller
{
    public function list() {
 
       $jobs = Yachts::with("producrs, models")->get(); 
 
       return view("yachts/list", ["yachts" => $yachts]);
    }
}
