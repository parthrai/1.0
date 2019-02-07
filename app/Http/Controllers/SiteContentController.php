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

    public function add($site_id){



        $html = '
            <div class="row">
                <div class="col-lg-4">
                    <h1>Section 1</h1>    
                </div>
                
                 <div class="col-lg-4">
                    <h1>Section 2</h1>    
                </div>
                
                 <div class="col-lg-4">
                    <h1>Section 3</h1>    
                </div>
            
            </div>
        
        
        ';


        $html = base64_encode($html);



       // $html = "hello";


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
                                    "content": "'.$html.'"
                    }
                  }
               }';





        $array = json_decode($json, true);
        var_dump($array['site']);




      //  SiteContent::create($array['site']);

        $siteContent = SiteContent::where('site_id',$site_id)->first();

        $tt = SiteContent::find($siteContent->id);

        $tt->content = $json;

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
