<?php

namespace App\Http\Controllers;

use App\Site;
use App\SiteContent;
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

    /******************************** SITE CRUD FUNCTIONS  ************************************/

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
        $site->site_name = $site_name;




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
                'directory' => '/public',

            ]
        ]);

        $response=  json_decode($result->getBody()->getContents(),true);

        $site = Site::find($site_id);

        $site->site_id = $response["site"]["id"];

        $site->save();


        $siteContent = new SiteContent();
        $siteContent->site_id = $site->id;
        $siteContent->modified_by = Auth::user()->id;
        $siteContent->content = "";
        $siteContent->save();





        return $response;
    }

    public function deleteSite(Request $request){



        $site_id = $request->site_id;

        $site = Site::where('site_id',$site_id)->first();


        $headers = [
            'Authorization' => 'Bearer ' . $this->token,
            'Accept'        => 'application/json',
        ];

        try {
            $client = new Client();
            $result = $client->delete('https://forge.laravel.com/api/v1/servers/219450/sites/' . $site_id,
                [ 'headers' => $headers]);
        }
        catch (\Exception $exception)
        {
            return $exception;
        }




        $response=  json_decode($result->getBody()->getContents(),true);

         Site::destroy($site->id);

        $siteContent = SiteContent::where('site_id',$site->id)->first();

        SiteContent::destroy($siteContent->id);








        return $response;

    }


    /******************************** END SITE CRUD FUNCTIONS  ************************************/




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


    /*******************************  END SITE SSL FUNCTIONS ********************************/


    /******************************* INSTALLING & DEPLOYING TEMPLATE FUNCTIONS ********************************/

    public function addRepo(Request $request){


        $site_id = $request->site_id;
        $site_name = $request->site_name;
        $template = $request->template;





        $headers = [
            'Authorization' => 'Bearer ' . $this->token,
            'Accept'        => 'application/json',
        ];
        $client = new Client();
        $result = $client->post('https://forge.laravel.com/api/v1/servers/219450/sites/'.$site_id.'/git', [
            'headers' => $headers,
            'form_params' => [
                'provider' => 'github',

                'repository' => 'parthrai/templates',

                'branch' => $template
            ]
        ]);

        sleep(6);


        $d_script= "cd /home/forge/".$site_name."

            composer install --no-interaction --prefer-dist --optimize-autoloader
            echo \"\" | sudo -S service php7.2-fpm reload
            
            if [ -f artisan ]
            then
                php artisan key:generate   
                php artisan migrate --force
               
            fi";


        $result = $client->put('https://forge.laravel.com/api/v1/servers/219450/sites/'.$site_id.'/deployment/script', [
            'headers' => $headers,
            'form_params' => [


                'content' => $d_script
            ]

        ]);







        $response=  json_decode($result->getBody()->getContents(),true);












          return $response;

    }


    public function deploy(Request $request){
        $site_id = $request->site_id;
        $site_name = $request->site_name;

        $headers = [
            'Authorization' => 'Bearer ' . $this->token,
            'Accept'        => 'application/json',
        ];

        $client = new Client();
        $deployment = $client->post('https://forge.laravel.com/api/v1/servers/219450/sites/'.$site_id.'/deployment/deploy', [
            'headers' => $headers,

        ]);


        $response=  json_decode($deployment->getBody()->getContents(),true);


        return $response;



    }


    /******************************* INSTALLING & DEPLOYING TEMPLATE FUNCTIONS ********************************/

}
