<?php

namespace App\Http\Controllers\Admin;


use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Intervention\Image\Facades\Image;
use App\Campaign;

class TrackingImageController extends Controller
{
    public function __construct()
    {

    }

    public function track($img, Request $request)
    {
        $input = request()->all();

        $campaign_model = new Campaign;
        // $campaign_model->setDirect(true);




        $campaign = Campaign::find($request->input('key'));



        if($campaign==null) {
            abort(404, 'Campaign not found');
        }

        $uri = explode('?', $input['uri']);
        $params = [];
        if (isset($uri[1])) {
            parse_str($uri[1], $params);
        }

        $uri = $uri[0];


        $uri = explode('#', $uri);
        $uri = $uri[0];

        $uri = rtrim($uri, 'index.html');
        $uri = rtrim($uri, 'index.php');
        $uri = rtrim($uri, 'index.asp');

        $data = [];
        if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
            $data['ip'] = $_SERVER['HTTP_CLIENT_IP'];
        } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
            $data['ip'] = $_SERVER['HTTP_X_FORWARDED_FOR'];
        } else {
            $data['ip'] = $_SERVER['REMOTE_ADDR'];
        }


        $tracking_uuid_model = new \App\Trackinguuid;
        $tracking_uuid_model->setDirect(true);

        $uuid_id = $tracking_uuid_model->where('uuid', $input['uuid'])->first();

        if ($uuid_id == null) {

            $uuid_id = DB::table('trackinguuids')->insertGetId([
                'country' => 'th',
                'language' => 'lang',
                'resolution' => $input['width'] . 'x' . $input['height'],
                'javascript' => $input['js'],
                'uuid' => $input['uuid'],
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now(),
                'created_by_id' => $campaign->created_by_id,
                'domain_key' => $request->input('key')//we let could work
            ]);

        } else {
            $uuid_id = $uuid_id->id;
        }


        //I think taht this fields is not need. right? hmmmm this was the pages that he visit, let it


        $tracking_page_model = new \App\Trackingpage;
        $tracking_page_model->setDirect(true);
        $tracking_page = $tracking_page_model->where('uri', $uri)->first();
        if ($tracking_page == null) {
            $tracking_page = DB::table('trackingpages')->insertGetId([
                'domain_key' => $input['key'],
                'uri' => $uri,
                'title' => $input['title'],
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now(),
                'created_by_id' => $campaign->created_by_id,
            ]);
        } else {
            $tracking_page = $tracking_page->id;
        }


        $tracking_uri_model = new  \App\Trackinguri();
        $tracking_uri_model->setDirect(true);
        DB::table('trackinguris')->insertGetId([
            'timeonpage' => null,
            'referer' => $input['referrer'],
            'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now(),
            'uuid_id' => $uuid_id,
            'page_id' => $tracking_page,
            'created_by_id' => $campaign->created_by_id,
            'domain_key' => $request->input('key'),
            'whatIsDisplayed' => $request->input('whatIsDisplayed')
        ]);


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
                'created_by_id' => $campaign->created_by_id,
            ]);
        }



        $storagePath = public_path('tracking.png'); //This we need in public
        dd($storagePath);
        return Image::make($storagePath)->response()
            ->header('Pragma', 'public')
            ->header('Cache-Control', 'max-age=86400')
            ->header('Expires', gmdate('D, d M Y H:i:s \G\M\T', time() + 86400));
    }


    public function trackEvent($img, Request $request)
    {
        //what is this model??
        //where we get domain and page from?
        // $domain_model = new Domain;
        // $domain_model->setDirect(true);
        $campaign_model = new Campaign;
        $campaign_model->setDirect(true);

        $tracking_uuid_model = new \App\Trackinguuid;
        $tracking_uuid_model->setDirect(true);
        $tracking_page_model = new \App\Trackingpage;
        $tracking_page_model->setDirect(true);
        $tracking_uri_model = new  \App\Trackinguri();
        $tracking_uri_model->setDirect(true);
        $tracking_campaign_model = new \App\Trackingcampaign();
        $tracking_campaign_model->setDirect(true);

        // $domain = $domain_model->where('domain_key', $request->input('key'))->first();
        $campaign = $campaign_model->find( $request->input('key'));


        $input = request()->all();
        $uri = explode('?', $input['uri']);
        $uri = $uri[0];

        $uri = explode('#', $uri);
        $uri = $uri[0];

        $uri = rtrim($uri, 'index.html');
        $uri = rtrim($uri, 'index.php');
        $uri = rtrim($uri, 'index.asp');


        $uuid_id = $tracking_uuid_model->where('uuid', $input['uuid'])->first();
        if ($uuid_id == null) {
            $uuid_id = DB::table('trackinguuids')->insertGetId([
                'country' => 'th',
                'language' => 'lang',
                'resolution' => $input['width'] . 'x' . $input['height'],
                'javascript' => $input['js'],
                'uuid' => $input['uuid'],
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now(),
                'client_id' => $campaign->created_by_id //this must be campaing create by id//ok.
            ]);
        } else {
            $uuid_id = $uuid_id->id;
        }
//This is wrong or not we dont have pages
// I think this is not need.
// can we remove this section?but this show wich pagees you visit this could be correct
        $page = $tracking_page_model->where('uri', $uri)->first();
        if ($page == null) {
            $page = DB::table('trackingpages')->insertGetId([
                'domain_key' => $input['key'],
                'uri' => $uri,
                'title' => $input['title'],
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now(),
                'client_id' => $campaign->created_by_id
            ]);
        } else {
            $page = $page->id;
        }


        $tracking_event_model = new \App\Trackingevent;
        $tracking_event_model->setDirect(true);

        DB::tabble('trackingevents')->insertGetId([
            'eventCategory' => $input['eventCategory'],
            'eventLabel' => $input['eventLabel'] == 'undefined' ? null : $input['eventLabel'],
            'eventValue' => $input['eventValue'] == 'undefined' ? null : $input['eventValue'],
            'eventAction' => $input['eventAction'],
            'page_id' => $page,
            'uuid_id' => $uuid_id,
            'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now(),
            'client_id' => $campaign->created_by_id
        ]);

        //like this? i hope
    }


    public  function trackMailing($img, Request $request)
    {
        if (isset($_GET['eventCategory']) && isset($_GET['eventAction'])) {
            $newsletter_model = new Newsletter;
            $newsletter_model->setDirect(true);
            $newsletter =  $newsletter_model->findOrFail($_GET['nl_id']);
            \Illuminate\Support\Facades\DB::table('trackingmailings')->insert([
                'eventCategory' => $_GET['eventCategory'] ?? null,
                'eventLabel' => $_GET['eventLabel'] ?? null,
                'eventValue' => $_GET['eventValue'] ?? null,
                'eventAction' => $_GET['eventAction'] ?? null,
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now(),
                'nl_id' => $_GET['nl_id'] ?? null,
                'client_id' => $newsletter->client_id
            ]);
        }

    }
}
