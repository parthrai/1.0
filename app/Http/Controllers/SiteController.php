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

    public function index(){

        $sites = Site::with('user')->get();

       return $sites;





    }


    public function importSites(Request $request){

        $path = $request->file('excel')->getRealPath();
        $data = Excel::load($path)->get();

        foreach ($data as $key => $value) {
            print_r($value->site);
        }



    }

    public function addSites(Request $request){

        $site_name = $request->site;
        $server_id = '219450';

        $site = new Site();
        $site->name = $site_name;
        $site->user_id = Auth::user()->id;
        $site->server_id= $server_id;
        $site->SSL = false;
        $site->save();
        $site_id = $site->id;

        $token = "eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6ImM3Y2Q0M2ZjOGVlNGI3ZmQ0N2MyMjQ1OTYzNGE3N2ViMzU3MWVkZjkxYmY3NWZhMmYxOTg0N2NhZDQ4ZGQ1MzllYWM5NDhhZTZlM2QzMmNjIn0.eyJhdWQiOiIxIiwianRpIjoiYzdjZDQzZmM4ZWU0YjdmZDQ3YzIyNDU5NjM0YTc3ZWIzNTcxZWRmOTFiZjc1ZmEyZjE5ODQ3Y2FkNDhkZDUzOWVhYzk0OGFlNmUzZDMyY2MiLCJpYXQiOjE1NDM1MTAxMTUsIm5iZiI6MTU0MzUxMDExNSwiZXhwIjoxNTc1MDQ2MTE1LCJzdWIiOiIzNDMwNSIsInNjb3BlcyI6W119.BWp8Dq_vZQZC6PZce7w8XFnHbTf7K_CrbsrO0b2gBGCsFuHnnaYA9iGi9K-dCFBpMqUsgIbqB6Am95AJ77n5vuos9Y5K01Jup3EamipyAgWmwC8ybDTB6dc39WlXVJP2i7DBopO31bN4LZFIby-LDk-KaZc_U4ROx1cZHNeMv8WQ3kjNnsGTkO-kGISwFe2DQB5fdEZMExlvfK1myUdmZBALrUD_u6jsNKIqX5sbfYYC4j42BpOV6s8Konu3xHAY0weiu9mztlhbJEdGwm9yI9PNpeSTfmz8vFkiBPRqgWRp4n0wsjqydkWlYnNP3PSf4jejJlGR69qAyyOgfGhg2sB54di4VbkMyXNhhrmIKhZ1c1zlXK5rq9dGICFUPcdzu_WaN8QcwW9qtCoco45GA3cgGmphRGrlWpuHpZnmdd3HsxkCZFOVY97v4vmtfVu3DqlNYccoRW9Satc_c50ck6DcaBAgnRfB_LSoqDn6JdERAONPZPAcMxvLcTCwobEtPLNy-Cr7TEnbdY6eHRbRVpTDCmQlSPxhA6UJ0u7DvMykeKpptk76ZnQlH2EzeNv_1yQY_VNPNSvz6yN0mhxDhuFzbLpLaeYDU7d-80GgK6EzHYDTLQUeVaPfBZ-9Fa1J8p8xsvEYqW8QZ0JGKFMdAI39jcDzUVFrA3fKkXNSf-Q";
        $headers = [
            'Authorization' => 'Bearer ' . $token,
            'Accept'        => 'application/json',
        ];
            $client = new Client();
        $result = $client->post('https://forge.laravel.com/api/v1/servers/219450/sites', [
            'headers' => $headers,
            'form_params' => [
                'domain' => $site_name,
                'project_type' => 'php',
                'directroy' => '/'.$site_name,
                'repository' => 'parthrai/1.0'
            ]
        ]);
        $response= json_decode(json_decode(json_encode($result->getBody()->getContents(),true)));

        $site = Site::find($site_id);
        $site->site_id = $response->site->id;

        $site->save();








      return $response;
    }

    public function addRepo(){


        $token = "eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6ImM3Y2Q0M2ZjOGVlNGI3ZmQ0N2MyMjQ1OTYzNGE3N2ViMzU3MWVkZjkxYmY3NWZhMmYxOTg0N2NhZDQ4ZGQ1MzllYWM5NDhhZTZlM2QzMmNjIn0.eyJhdWQiOiIxIiwianRpIjoiYzdjZDQzZmM4ZWU0YjdmZDQ3YzIyNDU5NjM0YTc3ZWIzNTcxZWRmOTFiZjc1ZmEyZjE5ODQ3Y2FkNDhkZDUzOWVhYzk0OGFlNmUzZDMyY2MiLCJpYXQiOjE1NDM1MTAxMTUsIm5iZiI6MTU0MzUxMDExNSwiZXhwIjoxNTc1MDQ2MTE1LCJzdWIiOiIzNDMwNSIsInNjb3BlcyI6W119.BWp8Dq_vZQZC6PZce7w8XFnHbTf7K_CrbsrO0b2gBGCsFuHnnaYA9iGi9K-dCFBpMqUsgIbqB6Am95AJ77n5vuos9Y5K01Jup3EamipyAgWmwC8ybDTB6dc39WlXVJP2i7DBopO31bN4LZFIby-LDk-KaZc_U4ROx1cZHNeMv8WQ3kjNnsGTkO-kGISwFe2DQB5fdEZMExlvfK1myUdmZBALrUD_u6jsNKIqX5sbfYYC4j42BpOV6s8Konu3xHAY0weiu9mztlhbJEdGwm9yI9PNpeSTfmz8vFkiBPRqgWRp4n0wsjqydkWlYnNP3PSf4jejJlGR69qAyyOgfGhg2sB54di4VbkMyXNhhrmIKhZ1c1zlXK5rq9dGICFUPcdzu_WaN8QcwW9qtCoco45GA3cgGmphRGrlWpuHpZnmdd3HsxkCZFOVY97v4vmtfVu3DqlNYccoRW9Satc_c50ck6DcaBAgnRfB_LSoqDn6JdERAONPZPAcMxvLcTCwobEtPLNy-Cr7TEnbdY6eHRbRVpTDCmQlSPxhA6UJ0u7DvMykeKpptk76ZnQlH2EzeNv_1yQY_VNPNSvz6yN0mhxDhuFzbLpLaeYDU7d-80GgK6EzHYDTLQUeVaPfBZ-9Fa1J8p8xsvEYqW8QZ0JGKFMdAI39jcDzUVFrA3fKkXNSf-Q";
        $headers = [
            'Authorization' => 'Bearer ' . $token,
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

    public function getSites(){

        $token = "eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6ImM3Y2Q0M2ZjOGVlNGI3ZmQ0N2MyMjQ1OTYzNGE3N2ViMzU3MWVkZjkxYmY3NWZhMmYxOTg0N2NhZDQ4ZGQ1MzllYWM5NDhhZTZlM2QzMmNjIn0.eyJhdWQiOiIxIiwianRpIjoiYzdjZDQzZmM4ZWU0YjdmZDQ3YzIyNDU5NjM0YTc3ZWIzNTcxZWRmOTFiZjc1ZmEyZjE5ODQ3Y2FkNDhkZDUzOWVhYzk0OGFlNmUzZDMyY2MiLCJpYXQiOjE1NDM1MTAxMTUsIm5iZiI6MTU0MzUxMDExNSwiZXhwIjoxNTc1MDQ2MTE1LCJzdWIiOiIzNDMwNSIsInNjb3BlcyI6W119.BWp8Dq_vZQZC6PZce7w8XFnHbTf7K_CrbsrO0b2gBGCsFuHnnaYA9iGi9K-dCFBpMqUsgIbqB6Am95AJ77n5vuos9Y5K01Jup3EamipyAgWmwC8ybDTB6dc39WlXVJP2i7DBopO31bN4LZFIby-LDk-KaZc_U4ROx1cZHNeMv8WQ3kjNnsGTkO-kGISwFe2DQB5fdEZMExlvfK1myUdmZBALrUD_u6jsNKIqX5sbfYYC4j42BpOV6s8Konu3xHAY0weiu9mztlhbJEdGwm9yI9PNpeSTfmz8vFkiBPRqgWRp4n0wsjqydkWlYnNP3PSf4jejJlGR69qAyyOgfGhg2sB54di4VbkMyXNhhrmIKhZ1c1zlXK5rq9dGICFUPcdzu_WaN8QcwW9qtCoco45GA3cgGmphRGrlWpuHpZnmdd3HsxkCZFOVY97v4vmtfVu3DqlNYccoRW9Satc_c50ck6DcaBAgnRfB_LSoqDn6JdERAONPZPAcMxvLcTCwobEtPLNy-Cr7TEnbdY6eHRbRVpTDCmQlSPxhA6UJ0u7DvMykeKpptk76ZnQlH2EzeNv_1yQY_VNPNSvz6yN0mhxDhuFzbLpLaeYDU7d-80GgK6EzHYDTLQUeVaPfBZ-9Fa1J8p8xsvEYqW8QZ0JGKFMdAI39jcDzUVFrA3fKkXNSf-Q";
        $headers = [
            'Authorization' => 'Bearer ' . $token,
            'Accept'        => 'application/json',
        ];
        $client = new Client();
        $result = $client->get('https://forge.laravel.com/api/v1/servers/219450/sites', [
            'headers' => $headers,


        ]);


        $data = json_encode($result->getBody()->getContents(),true);


        print_r($data);








    }

    public function enableSSL(Request $request){


        $server_id= $request->server_id;
        $site_id= $request->site_id;
        $site_name = $request->site_name;

        $token = "eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6ImM3Y2Q0M2ZjOGVlNGI3ZmQ0N2MyMjQ1OTYzNGE3N2ViMzU3MWVkZjkxYmY3NWZhMmYxOTg0N2NhZDQ4ZGQ1MzllYWM5NDhhZTZlM2QzMmNjIn0.eyJhdWQiOiIxIiwianRpIjoiYzdjZDQzZmM4ZWU0YjdmZDQ3YzIyNDU5NjM0YTc3ZWIzNTcxZWRmOTFiZjc1ZmEyZjE5ODQ3Y2FkNDhkZDUzOWVhYzk0OGFlNmUzZDMyY2MiLCJpYXQiOjE1NDM1MTAxMTUsIm5iZiI6MTU0MzUxMDExNSwiZXhwIjoxNTc1MDQ2MTE1LCJzdWIiOiIzNDMwNSIsInNjb3BlcyI6W119.BWp8Dq_vZQZC6PZce7w8XFnHbTf7K_CrbsrO0b2gBGCsFuHnnaYA9iGi9K-dCFBpMqUsgIbqB6Am95AJ77n5vuos9Y5K01Jup3EamipyAgWmwC8ybDTB6dc39WlXVJP2i7DBopO31bN4LZFIby-LDk-KaZc_U4ROx1cZHNeMv8WQ3kjNnsGTkO-kGISwFe2DQB5fdEZMExlvfK1myUdmZBALrUD_u6jsNKIqX5sbfYYC4j42BpOV6s8Konu3xHAY0weiu9mztlhbJEdGwm9yI9PNpeSTfmz8vFkiBPRqgWRp4n0wsjqydkWlYnNP3PSf4jejJlGR69qAyyOgfGhg2sB54di4VbkMyXNhhrmIKhZ1c1zlXK5rq9dGICFUPcdzu_WaN8QcwW9qtCoco45GA3cgGmphRGrlWpuHpZnmdd3HsxkCZFOVY97v4vmtfVu3DqlNYccoRW9Satc_c50ck6DcaBAgnRfB_LSoqDn6JdERAONPZPAcMxvLcTCwobEtPLNy-Cr7TEnbdY6eHRbRVpTDCmQlSPxhA6UJ0u7DvMykeKpptk76ZnQlH2EzeNv_1yQY_VNPNSvz6yN0mhxDhuFzbLpLaeYDU7d-80GgK6EzHYDTLQUeVaPfBZ-9Fa1J8p8xsvEYqW8QZ0JGKFMdAI39jcDzUVFrA3fKkXNSf-Q";
        $headers = [
            'Authorization' => 'Bearer ' . $token,
            'Accept'        => 'application/json',
        ];
        $client = new Client();
        $result = $client->post('https://forge.laravel.com/api/v1/servers/'.$server_id.'/sites/'.$site_id.'/certificates/letsencrypt', [

            'headers' => $headers,
            'form_params' => [
                'domains' => [ $site_name ] ,

            ]

        ]);


        $response= json_decode(json_decode(json_encode($result->getBody()->getContents(),true)));
        return $response;


    }

    public function disableSSL(Request $request){}
}
