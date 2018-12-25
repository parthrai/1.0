<?php

namespace App\Http\Controllers;

use App\Site;
use App\User;
use Illuminate\Http\Request;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Auth;
use Excel;

class SiteController extends Controller
{
    //
    private $server_id = '219450';
    private $token = "eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6ImM3Y2Q0M2ZjOGVlNGI3ZmQ0N2MyMjQ1OTYzNGE3N2ViMzU3MWVkZjkxYmY3NWZhMmYxOTg0N2NhZDQ4ZGQ1MzllYWM5NDhhZTZlM2QzMmNjIn0.eyJhdWQiOiIxIiwianRpIjoiYzdjZDQzZmM4ZWU0YjdmZDQ3YzIyNDU5NjM0YTc3ZWIzNTcxZWRmOTFiZjc1ZmEyZjE5ODQ3Y2FkNDhkZDUzOWVhYzk0OGFlNmUzZDMyY2MiLCJpYXQiOjE1NDM1MTAxMTUsIm5iZiI6MTU0MzUxMDExNSwiZXhwIjoxNTc1MDQ2MTE1LCJzdWIiOiIzNDMwNSIsInNjb3BlcyI6W119.BWp8Dq_vZQZC6PZce7w8XFnHbTf7K_CrbsrO0b2gBGCsFuHnnaYA9iGi9K-dCFBpMqUsgIbqB6Am95AJ77n5vuos9Y5K01Jup3EamipyAgWmwC8ybDTB6dc39WlXVJP2i7DBopO31bN4LZFIby-LDk-KaZc_U4ROx1cZHNeMv8WQ3kjNnsGTkO-kGISwFe2DQB5fdEZMExlvfK1myUdmZBALrUD_u6jsNKIqX5sbfYYC4j42BpOV6s8Konu3xHAY0weiu9mztlhbJEdGwm9yI9PNpeSTfmz8vFkiBPRqgWRp4n0wsjqydkWlYnNP3PSf4jejJlGR69qAyyOgfGhg2sB54di4VbkMyXNhhrmIKhZ1c1zlXK5rq9dGICFUPcdzu_WaN8QcwW9qtCoco45GA3cgGmphRGrlWpuHpZnmdd3HsxkCZFOVY97v4vmtfVu3DqlNYccoRW9Satc_c50ck6DcaBAgnRfB_LSoqDn6JdERAONPZPAcMxvLcTCwobEtPLNy-Cr7TEnbdY6eHRbRVpTDCmQlSPxhA6UJ0u7DvMykeKpptk76ZnQlH2EzeNv_1yQY_VNPNSvz6yN0mhxDhuFzbLpLaeYDU7d-80GgK6EzHYDTLQUeVaPfBZ-9Fa1J8p8xsvEYqW8QZ0JGKFMdAI39jcDzUVFrA3fKkXNSf-Q";



    public function index(){

        $sites = Site::with('user')->get();

       return $sites;





    }


    public function getSites(){


        $headers = [
            'Authorization' => 'Bearer ' . $this->token,
            'Accept'        => 'application/json',
        ];
        $client = new Client();
        $result = $client->get('https://forge.laravel.com/api/v1/servers/219450/sites', [
            'headers' => $headers,

        ]);
        $response=  json_decode($result->getBody()->getContents(),true);


        $sites = array();



        foreach ($response['sites'] as $list){

            $site_name = Site::with('user')->where('site_id',$list['id'])->first();

            $user_name = '';



            if($site_name['user']['name'] == null)
                $user_name='System';
            else
                $user_name= $site_name['user']['name'];


            $sites[] = array(
                'site_id' => $list['id'],
                'site_name' => $list['name'],
                'server_id' =>$this->server_id,
                'username' => $user_name,

            );



        }


        return $sites;









    }



    public function addSites(Request $request){

        $site_name = $request->site;



        $site = new Site();
        $site->user_id = Auth::user()->id;
        $site->server_id= $this->server_id;

        $site->save();
        $site_id = $site->id;

        $headers = [
            'Authorization' => 'Bearer ' . $this->token,
            'Accept'        => 'application/json',
        ];
            $client = new Client();
        $result = $client->post('https://forge.laravel.com/api/v1/servers/219450/sites', [
            'headers' => $headers,
            'form_params' => [
                'domain' => $site_name,
                'project_type' => 'php',
                'directroy' => '/'.$site_name,

            ]
        ]);

        $response=  json_decode($result->getBody()->getContents(),true);

        $site = Site::find($site_id);

        $site->site_id = $response["site"]["id"];

        $site->save();








      return $response;
    }

    public function addRepo(){


        $headers = [
            'Authorization' => 'Bearer ' . $this->token,
            'Accept'        => 'application/json',
        ];
        $client = new Client();
        $result = $client->post('https://forge.laravel.com/api/v1/servers/219450/sites/678255/git', [
            'headers' => $headers,
            'form_params' => [
                'provider' => 'github',

                'repository' => 'parthrai/1.0',

                'branch' => 'master'
            ]
        ]);
        $response= json_decode(json_decode(json_encode($result->getBody()->getContents(),true)));





        dd($result);



      //  return $response;

    }





   /******************************** SITE SSL FUNCTIONS  ************************************/

    public function getSites_SSL(){




        $headers = [
            'Authorization' => 'Bearer ' . $this->token,
            'Accept'        => 'application/json',
        ];
        $client = new Client();
        $result = $client->get('https://forge.laravel.com/api/v1/servers/219450/sites', [
            'headers' => $headers,

        ]);
        $response=  json_decode($result->getBody()->getContents(),true);


        $sites = array();



        foreach ($response['sites'] as $list){


            $sites[$list['id']] = "undef";





        }


        return $sites;









    }

    public function SSLCheck(Request $request){

        $site_id = $request->site;


        $headers = [
            'Authorization' => 'Bearer ' . $this->token,
            'Accept'        => 'application/json',
        ];

        $client = new Client();

        $result = $client->get('https://forge.laravel.com/api/v1/servers/219450/sites/'.$site_id.'/certificates', [
            'headers' => $headers,

        ]);

        $response=  json_decode($result->getBody()->getContents(),true);

        if(sizeof($response['certificates']) == 0 )
            return "not installed";
        else
            return "installed";




    }

    public function enableSSL(Request $request){


        $server_id= $request->server_id;
        $site_id= $request->site_id;
        $site_name = $request->site_name;


        $headers = [
            'Authorization' => 'Bearer ' . $this->token,
            'Accept'        => 'application/json',
        ];
        $client = new Client();
        $result = $client->post('https://forge.laravel.com/api/v1/servers/'.$this->server_id.'/sites/'.$site_id.'/certificates/letsencrypt', [

            'headers' => $headers,
            'form_params' => [
                'domains' => [ $site_name ] ,

            ]

        ]);


        $response=  json_decode($result->getBody()->getContents(),true);
        return $response;


    }


    /*******************************  END SITE SSL FUNCTION ********************************/



}
