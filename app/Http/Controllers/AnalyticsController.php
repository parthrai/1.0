<?php

namespace App\Http\Controllers;

use App\Helper\AnalyticsHelper;
use Illuminate\Http\Request;
use Analytics;
use Spatie\Analytics\AnalyticsClient;
use Spatie\Analytics\Period;


class AnalyticsController extends Controller
{
    //




    protected $viewId = '184198906';

    private $helper;

    public function __construct(AnalyticsHelper $helper)
    {
        $this->helper = $helper;



    }


    public function VisitorsAndPageViews(){




        $analyticsData = Analytics::fetchVisitorsAndPageViews(Period::days(7));


        return $analyticsData;
    }

    public function topReferrers(){

        $topReferrers =  Analytics::fetchTopReferrers(Period::days(7));
        $array_topReferrs = json_decode(json_encode($topReferrers), true);

        return $array_topReferrs;

    }

    public function topBrowsers(){

        $topBrowsers = Analytics::fetchTopBrowsers(Period::days(7));
        $array_topBrowsers = json_decode(json_encode($topBrowsers), true);

        return $array_topBrowsers;

    }

    public function UserTypes(){

        $UserTypes = Analytics::fetchUserTypes(Period::days(7));
        $array_UserTypes = json_decode(json_encode($UserTypes), true);

        return $array_UserTypes;

    }


    public function test2(){

        return $_COOKIE;
    }

}
