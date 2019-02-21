<?php
/**
 * Created by PhpStorm.
 * User: parths
 * Date: 2/7/2019
 * Time: 11:50 PM
 */

namespace App\Helper;

use Analytics;
use Spatie\Analytics\AnalyticsClientFactory;


class AnalyticsHelper
{
    public function getView($viewId)
    {
        $config = config('analytics');
        $client = AnalyticsClientFactory::createForConfig($config);
        return new Analytics($client, $viewId);
    }
}