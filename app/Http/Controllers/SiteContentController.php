<?php

namespace App\Http\Controllers;

use App\Site;
use App\SiteContent;
use Illuminate\Http\Request;

class SiteContentController extends Controller
{
    //

    public function test(){


        $content = SiteContent::find(1);

        $array = json_decode($content->content,true);

          //  var_dump($array['site']);


            $nav = array();

            foreach ($array['site']['nav'] as $key => $test){
                echo $key. "  " . $test;
                echo "<br>";

            }

    }

    public function add(){
        $json='{
                            "site": {
                                "title": "this is some title",
                    "nav": {
                                    "home": "/home.html",
                      "about": "/about.html",
                      "contact": "contact.html"
                    },
                    "header": {
                                    "heading": "this is some heading",
                      "tagline": "this is some tagline"
                    },
                    "footer": {
                                    "text": "the is some footer text"
                    }
                  }
               }';

        $array = json_decode($json, true);
        var_dump($array['site']);


      //  SiteContent::create($array['site']);
        $tt = SiteContent::find(1);

        $tt->content = $array['site'];

        $tt->update();




    }


    public function test3(Request $request){

        $site_name = $request->site;

        $site = Site::where('site_name',$site_name)->first();

        $site_content = SiteContent::where('site_id',$site->id)->first();

        return $site_content->content;



        return "hello, this is the response" . $site;




    }




    public function get($site_id){


        $site = Site::findOrFail($site_id);



        return view('sites.ManageSite')->with(['site' => $site]);
    }
}
