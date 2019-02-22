<?php

namespace App\Http\Controllers;

use App\Initial;
use App\InitialModel;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

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
        $data->isSetup=true;
        $data->save();

        return "success";



    }

    public function addAdminUsers(Request $request){

        $user = new User();

        $user->name  = $request->name;
        $user->type= "admin";
        $user->email = $request->email;
        $user->password = Hash::make($request->password);

        $user->save();

    }



}
