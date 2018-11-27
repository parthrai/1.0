<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    //

    public function getUsers(){

        $users= User::all();

        return $users;
    }
}
