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

        $analytics = $this->helper->getView(184198906);


        $analyticsData = Analytics::fetchVisitorsAndPageViews(Period::days(7));


        return $analyticsData;
    }

    public function topReferrers(){

        $topReferrers =  Analytics::fetchTopReferrers(Period::days(7));

        return $topReferrers;

    }


    public function test2(){

        return $_COOKIE;
    }

}
