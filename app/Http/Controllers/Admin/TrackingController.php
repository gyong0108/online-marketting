<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
class TrackingController extends Controller
{
    //
    public function trackingutm(){

        parse_str($uri[1], $params);
        if (isset($params['utm_source'])) {
            DB::table('trackingcampaigns')->insertGetId([
                'source' => $params['utm_source'],
                'medium' => $params['utm_medium'],
                'campaign' => $params['utm_campaign'],
                'term' => $params['utm_term'],
                'content' => $params['utm_content'],
                'uuid_id' => $uuid_id,
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now(),
                'created_by_id' => $page->created_by_id,
            ]);
        }
    }
}
