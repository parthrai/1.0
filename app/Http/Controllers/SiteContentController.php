<?php

namespace App\Http\Controllers;

use App\SiteContent;
use Illuminate\Http\Request;

class SiteContentController extends Controller
{
    //

    public function test(){


        $content = SiteContent::find(1);

        return $content->content;


    }
}
