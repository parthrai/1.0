<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Initial extends Model
{
    //

    public static function isSetup(){
        $data = Initial::find(1);

        if(!$data->isSetup)
            return "Install";
        else
            return "home";

    }
}
