<?php

namespace App\Http\Controllers;

use App\Site;
use App\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    //

    public function getStats(){

       $totalUsers = User::get()->count();
       $totalSites = Site::get()->count();

        $stats = array(
            "Users" => $totalUsers,
            "Sites" => $totalSites
        );

       return $stats;
    }

    public function getSites(){

    }
}
