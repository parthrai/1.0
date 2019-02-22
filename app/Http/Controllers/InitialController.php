<?php

namespace App\Http\Controllers;

use App\Initial;
use Illuminate\Http\Request;

class InitialController extends Controller
{
    //

    public function Index(){

        $check = Initial::find(1);


        if($check->company_name=="")
            return view('Install');
        else
            return redirect('/login');


    }
}
