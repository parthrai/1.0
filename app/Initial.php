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

    public static function companyInitials(){

        $data= Initial::find(1);

        $words = explode(" ", $data->company_name);
        $acronym = "";

        foreach ($words as $w) {
            $acronym .= $w[0];
        }

        return $acronym;

    }
}
