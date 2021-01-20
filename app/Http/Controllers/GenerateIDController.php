<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class GenerateIDController extends Controller
{
    public function generateId()
    {

        $uniqueId = uniqid();

        session()->put('unique-id',$uniqueId);
        session()->save();


        return view('sender');
    print_r(session('unique-id'));
        exit();

    } 

}
