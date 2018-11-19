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


            $view = Initial::isSetup();


        return view($view);
    }


    public function setup(Request $request){

        $companyName = $request->companyName;
        $licenseKey =  $request->licenseKey;


        $data =Initial::find(1);
        $data->company_name =  $companyName;
        $data->license_key = $licenseKey;
        $data->save();

        return "success";



    }
}
