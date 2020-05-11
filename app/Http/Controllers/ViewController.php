<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ViewController extends Controller
{
    protected function home(){
        return view('welcome');
    }
}
