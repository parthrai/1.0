<?php

namespace App\Http\Controllers;

use App\Initial;
use App\InitialModel;
use Illuminate\Http\Request;

class SetupController extends Controller
{

    //

    public function __construct()
    {

    }

    public function index(){

        Initial::isSetup();

        return view('Install');
    }
}
