<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Analytics;
use Spatie\Analytics\AnalyticsClient;
use Spatie\Analytics\Period;

class AnalyticsController extends Controller
{
    //


    protected $viewId = '184198906';




    public function VisitorsAndPageViews(){


     
        $analyticsData = Analytics::fetchVisitorsAndPageViews(Period::days(7));


        return $analyticsData;
    }

    public function topReferrers(){

        $topReferrers =  Analytics::fetchTopReferrers(Period::days(7));

        return $topReferrers;

    }

}
