<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;
use Auth;
use App\Contact;
use App\Form;
use App\Potential;
use App\Taskitem;
use App\Ticket;
use App\Trackingevent;
use App\Trackinguri;
use App\Trackinguuid;
use App\User;
use Cookie;
use DB;
use Carbon\Carbon;
use App\Campaign;
use App\Page;
use App\Adgroup;
use App\Keyword ;
use App\Negativebroad;
use App\Request as Campaignrequest;
use App\Owner;
use App\Payment;
use App\InvoiceData;
use App\Invoice;
class HomeController extends Controller
{


    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {




        $totals = [];

        $invoice_data = InvoiceData::where('created_by_id', Auth::user()->id)->first();
        if ($invoice_data == null) {
            $invoice_data = new InvoiceData();
            $invoice_data->created_by_id = Auth::user()->id;
        }
        $totals['visitors'] = \App\Trackinguri::where('created_by_id', Auth::user()->id)->count();

        $totals['calls'] = 0;

        $totals['leads'] = \App\Lead::where('is_newsletter', 0)->where('created_by_id', Auth::user()->id)->count();

        $totals['subscribers'] = \App\Lead::where('is_newsletter', 1)->where('created_by_id', Auth::user()->id)->count();
        $payments = Payment::all();
        $user = Auth::user();
        $client_token = '';
   
        return view('home', compact('countries', 'totals', 'languages', 'setupData', 'userCampaign', 'payments', 'invoice_data', 'client_token'));

    }

    public function download_csv(){
        $array1[] = ''; //Phone Number
        $array1[] = ''; //Country of Phone
        $array1[] = ''; //Call Reporting
        $array1[] = ''; //Conversion Action
        $array1[] = ''; //Feed Name
        $array1[] = ''; //Business name
        $array1[] = ''; //Address line 1
        $array1[] = ''; //City
        $array1[] = ''; //Postal code
        $array1[] = ''; //Country code
        $array1[] = ''; //Phone number

        $sql = "SELECT a.`name` as `Campaign`, a.`daily_budget` as `Campaign Daily Budget`,
               a.lanugage as  `Languages` , a.`location_address` as `Location ID` ,
                a.`location_address` as `Location` , 
                'Search' as `Network`, 'Ad Group' as `Ad Group`, 
                'Max CPC' as `Max CPC`, 'Flexible Reach' as `Flexible Reach` , 
                a.`keywords` as `Keyword`, 'Type' as `Type`, 'Bid adjustment' as `Bid adjustment`, 
                'Headline 1' as `Headline 1`, 'Headline 2' as `Headline 2`, 'Description' as `Description`,
                'Sitelink text' as `Sitelink text`, 'Path 1' as `Path 1`, 'Path 2' as `Path 2`, 
                'Final URL' as `Final URL` , 'Platform targeting' as `Platform targeting`,
                'Device Preference' as `Device Preference`, 'Ad Schedule' as `Ad Schedule` ,
                'Phone Number' as `Phone Number`, 'Country of Phone' as `Country of Phone` , 'Call Reporting' as `Call Reporting`,
                'Conversion Action' as `Conversion Action`, 'Feed Name' as `Feed Name`, 'Business name' as `Business name` , 'Address line 1' as `Address line 1`, 
                'City' as `City`, 'Postal code' as `Postal code`, 'Country code' as `Country code`, 'Phone number' as `Phone number`
                FROM `campaigns` as a   WHERE 1";
        $table =DB::select($sql);

        $file = fopen('file.csv', 'w');
        $firstRow = $table[0];
        $header_csv = array();
        foreach($firstRow as $key=>$val){
            $header_csv[] = $key;
        }
        fputcsv($file, $header_csv);
        $sql = "SELECT a.*, a.`switch`, a.`id`, a.`location_latitude`, a.`location_longitude`, a.`name` as `Campaign`, a.`daily_budget` as `Campaign Daily Budget`, a.lanugage as `Languages` , a.`location_address` as `Location ID` , a.`location_address` as `Location` , 'Search' as `Network`, 'Ad Group' as `Ad Group`, 'Max CPC' as `Max CPC`, 'Flexible Reach' as `Flexible Reach` , a.`keywords` as `Keyword`, 'Type' as `Type`, 'Bid adjustment' as `Bid adjustment`, a.`title`  , a.`undertitle` , a.description  , 'Sitelink text' as `Sitelink text`, 'Path 1' as `Path 1`, 'Path 2' as `Path 2`, 'Final URL' as `Final URL` , 'Platform targeting' as `Platform targeting`, 'Device Preference' as `Device Preference`, 'Ad Schedule' as `Ad Schedule`, a.`negatives`,  a.created_by_id, a.final_url FROM `campaigns` as a  WHERE 
        a.`deleted_at` is NULL   ";
        $table =DB::select($sql);
        foreach ($table as $rowObject) {
//            dd($rowObject);
            $user = User::find($rowObject->created_by_id);
            if($rowObject->switch == 'On'){
                $row = (array)$rowObject;
                $row['Type'] = 'Exact';
                $row['Bid adjustment'] ='';
                $row['Flexible Reach'] ='';
                $row['Max CPC'] = '';
                $i=0;

                $array1 = array();
                $array1[] = $row['Campaign'];
                $array1[] = $row['Campaign Daily Budget'];
                $array1[] = $row['Languages'];
                $array1[] = '';
                $array1[] = '';
                $array1[] = 'Google Search';
                $array1[] = '';
                $array1[] = '';
                $array1[] = '';
                $array1[] = '';
                $array1[] = '';
                $array1[] = $row['Bid adjustment'];
                $array1[] = '';
                $array1[] = '';
                $array1[] = '';
                $array1[] = '';
                $array1[] = '';
                $array1[] = '';
                $array1[] = '';
                $array1[] = '';
                $array1[] = '';
                $array1[] = '';
                // $page = new Page;
                // $adgroup = new Adgroup  ;
                // $keyword = new Keyword ;
                // $adgroup = Adgroup::where('campaign_id',$rowObject->id)->first();
                // $keywords = Keyword::where('adgroup_id', $adgroup->id)->get();
                $row['Flexible Reach'] ='';
                $row['Max CPC'] = '';
                // if(isset($adgroup)){
                //     $page = Page::where('adgroup_id',$adgroup->id)->first();
                //     $pages =   Page::where('adgroup_id',$adgroup->id)->get();
                // }
                // if(!isset($page->id)) $pageid = '1' ;
                // else $pageid = $page->id;
                // if(isset($page->is_subdomain) && $page->is_subdomain)     {
                //     $row['Path 1'] = $page->subdomain .".".$page->domain;
                //     $final_url   = $row['Path 1']."/".$pageid;
                // }
                // else{
                //     $row['Path 1'] = env('APP_URL');
                //     $final_url   = "https://ads.fsom.com/".$pageid;
                // }
                if($rowObject->location_latitude != NULL && $rowObject->location_longitude != NULL) $location_latitude = 1;
                else $location_latitude = 0;
                fputcsv($file, $array1);

                #---------new Inserted Row
                $array1 = array();
                $array1[] = $row['Campaign'];
                $array1[] = '';
                $array1[] = '';
                $array1[] = '';
                $array1[] = '';
                $array1[] = '';
                $array1[] = '';
                $array1[] = '';
                $array1[] = '';
                $array1[] = '';
                $array1[] = '';
                $array1[] = '';
                $array1[] = '';
                $array1[] = '';
                $array1[] = '';
                $array1[] = '';
                $array1[] = '';
                $array1[] = '';
                $array1[] = '';
                $array1[] = '';
                $array1[] = '';
                $array1[] = '';
                    #-----new columns
                $array1[] = $user->info_phone;
                $language =$rowObject->lanugage;
                $array1[] = $language;
                $array1[] = 'Enable'; //Call Reporting
                $array1[] = 'Calls from Ads'; //Conversion Action
                $array1[] = ''; //Feed Name
                $array1[] = ''; //Business name
                $array1[] = ''; //Address line 1
                $array1[] = ''; //City
                $array1[] = ''; //Postal code
                $array1[] = ''; //Country code
                $array1[] = ''; //Phone number
                    #----

                fputcsv($file, $array1);
                // $company = Company::where('created_by_id', $rowObject->created_by_id)->first();
//                foreach (($companies) as $company) {
                    // $country = Country::find($company->country_id);
                    #-------------------------
                    $array1 = array();
                    $array1[] = $row['Campaign'];
                    $array1[] = '';
                    $array1[] ='';
                    $array1[] = '';
                    $array1[] = '';
                    $array1[] = '';
                    $array1[] = '';
                    $array1[] = '';
                    $array1[] = '';
                    $array1[] = '';
                    $array1[] = '';
                    $array1[] = '';
                    $array1[] = '';
                    $array1[] = '';
                    $array1[] = '';
                    $array1[] = '';
                    $array1[] = '';
                    $array1[] = '';
                    $array1[] = '';
                    $array1[] = '';
                    $array1[] = '';
                    $array1[] = '';
                    #-----new columns
                    $array1[] = '';
                    $language = '';
                    $array1[] = '';
                    $array1[] = ''; //Call Reporting
                    $array1[] = ''; //Conversion Action
                    $array1[] = ''; //Feed Name
                    ['name', 'adress', 'zip', 'city', 'info_mail', 'info_phone', 'homepage', 'imprint', 'created_by_id','location_longitude' ,'location_latitude'];
                    $array1[] = $user->company_name; //Business name
                    $array1[] =  $user->company_adress;; //Address line 1
                    $array1[] = $user->company_city; //City
                    $array1[] = $user->company_zip; //Postal code
                    // if(isset($country->shortcode))
                    // $array1[] = strtoupper($country->shortcode); //Country code
                    // else
                        $array1[] = $language; //Country code
                    $array1[] = 'company_phone'; //Phone number
                    #----

                    fputcsv($file, $array1);
                    #-----------------------------------
//                }



                $array1 = array();
                $array1[] = $row['Campaign'];
                $array1[] = '';
                $array1[] = '';
                $array1[] = '';
                if($location_latitude) $array1[] = "(10mi:".$rowObject->location_latitude.":-".$rowObject->location_longitude.")";
                else $array1[] = "";
                $array1[] = '';
                $array1[] = '';
                $array1[] = '';
                $array1[] = '';
                $array1[] = '';
                $array1[] = '';
                $array1[] = $row['Bid adjustment'];
                $array1[] = '';
                $array1[] = '';
                $array1[] = '';
                $array1[] = '';
                $array1[] = '';
                $array1[] = '';
                $array1[] = '';
                $array1[] = '';
                $array1[] = '';
                $array1[] = '';
                fputcsv($file, $array1);

                $array1 = array();
                $array1[] = $row['Campaign'];
                $array1[] = '';
                $array1[] = '';
                $array1[] = '';
                if($location_latitude) $array1[] = "(10mi:".$rowObject->location_latitude.":-".$rowObject->location_longitude.")";
                else $array1[] = "";
                $array1[] = '';
                $array1[] = '';
                $array1[] = '';
                $array1[] = '';
                $array1[] = '';
                $array1[] = '';
                $array1[] = $row['Bid adjustment'];
                $array1[] = '';
                $array1[] = '';
                $array1[] = '';
                $array1[] = '';
                $array1[] = '';
                $array1[] = '';
                $array1[] = '';
                $array1[] = '';
                $array1[] = '';
                $array1[] = '';
                fputcsv($file, $array1);
               
             


                // $adgroups = Adgroup::where('campaign_id',$rowObject->id)->get();
                //we have not adgrups, how to foreach on this line? Campaign or no foreach
             
                    if ( $rowObject->switch == 'On' && !$rowObject->deleted_at &&  $rowObject->daily_budget <= $user->balance){
                       
                        //is this?
                            $array1 = array();
                            $array1[] = $row['Campaign'];
                            $array1[] = '';
                            $array1[] = '';
                            $array1[] = '';
                            $array1[] = '';
                            $array1[] = '';
                            $array1[] = 'Adgroup';
                            $array1[] = '';
                            $array1[] = '';
                            $array1[] = '';
                            $array1[] = '';
                            $array1[] = '';
                            $array1[] = $rowObject->title;
                            $array1[] = $rowObject->undertitle;
                            $array1[] = $rowObject->description;
                            $array1[] = 'link text';
                            $array1[] = $row['Path 1'];
                            $array1[] = '';
                            $array1[] = $rowObject->final_url;
                            $array1[] = '';
                            $array1[] = '';
                            $array1[] = '';
                            fputcsv($file, $array1);
                        
                        
                            //here we need to explode kyword..
                        //foreach ($keywords as $keyword) {
                            $keywords = $rowObject->keywords;
                            $keywords = str_replace(', ', ',', $keywords);
                            $keywords = explode(',', $keywords);
                            foreach ($keywords as $keyword) {
                            //in here?
                            //i think so
                            // if (!$keyword->deleted_at) {
                                
                                // if($limit >= $row_keywords_num){
                                // $row_keywords_num++; 
                                $array1 = array();
                                $array1[] = $row['Campaign'];
                                $array1[] = '';
                                $array1[] = '';
                                $array1[] = '';
                                $array1[] = '';
                                $array1[] = '';
                                $array1[] = 'Adgroup';
                                $array1[] = '';
                                $array1[] = '';
                                $array1[] = $keyword;

                                $array1[] = $row['Type'];
                                $array1[] = '';
                                $array1[] = '';
                                $array1[] = '';
                                $array1[] = '';
                                $array1[] = '';
                                $array1[] = '';
                                $array1[] = '';
                                $array1[] = '';
                                $array1[] = '';
                                $array1[] = '';
                                $array1[] = '';

                                fputcsv($file, $array1);
                                if (strpos($keyword, ' ') > 0) {
                                    $array1 = array();
                                    $array1[] = $row['Campaign'];
                                    $array1[] = '';
                                    $array1[] = '';
                                    $array1[] = '';
                                    $array1[] = '';
                                    $array1[] = '';
                                    $array1[] = 'Adgroup';
                                    $array1[] = '';
                                    $array1[] = '';
                                    $array1[] = $keyword;
                                    $array1[] = 'Phrase';
                                    $array1[] = '';
                                    $array1[] = '';
                                    $array1[] = '';
                                    $array1[] = '';
                                    $array1[] = '';
                                    $array1[] = '';
                                    $array1[] = '';
                                    $array1[] = '';
                                    $array1[] = '';
                                    $array1[] = '';
                                    $array1[] = '';

                                    fputcsv($file, $array1);
                                }
                                // }

                            }
                        }
                  
               
                $negatives = $rowObject->negatives;
                $negatives = str_replace(', ', ',', $negatives);
                $negatives = explode(',', $negatives);
                foreach($negatives as $negative){
                    $array1 = array();
                    $array1[] = $row['Campaign'];
                    $array1[] = '';
                    $array1[] = '';
                    $array1[] = '';
                    $array1[] = '';
                    $array1[] = '';
                    $array1[] = '';
                    $array1[] = '';
                    $array1[] = '';
                    $array1[] = $negative;
                    $array1[] = 'Campaign Negative Board';
                    $array1[] = '';
                    $array1[] = '';
                    $array1[] = '';
                    $array1[] = '';
                    $array1[] = '';
                    $array1[] = '';
                    $array1[] = '';
                    $array1[] = '';
                    $array1[] = '';
                    $array1[] = '';
                    $array1[] = '';

                    fputcsv($file, $array1);

                }

            }
        }

        fclose($file);
        return response()->download('file.csv');
    }


    public function firstrequest(Request $request){
        $firstrequest = new Campaignrequest;
        $firstrequest->landingpage = $request->langing_page;
        $firstrequest->target = $request->target;
        $firstrequest->city = $request->city;
        $firstrequest->created_by_id = Auth::user()->id;
        $firstrequest->save();
        return redirect()->back();
    }

    public function setup(Request $request)
    {
        $campaignArray = [
            'country_id' => $request->country_id,
            'language_id' => $request->language_id,
            'name' => $request->main_keyword,
            'created_by_id' => Auth::user()->id,
            'phone' => Auth::user()->phone,
            'email' => Auth::user()->email,
            'budget' => $request->budget,
            'location_address'=>$request->location_address,
            'location_latitude'=>$request->location_latitude,
            'location_longitude'=>$request->location_longitude,


        ];
        if (!$campaign = \App\Campaign::where($campaignArray)->first()) {
            $campaign = \App\Campaign::create($campaignArray);
        }
        $adgroupArray = [
            'mainkeyword' => $request->main_keyword,
            'campaign_id' => $campaign->id,
            'created_by_id' => Auth::user()->id
        ];
        if (!$adgroup = \App\Adgroup::where($adgroupArray)->first()) {
            $adgroup = \App\Adgroup::create($adgroupArray);
        }

        $allkeywordstoSave = json_decode($request->input('allkeywordstoSave'));

        if (count($allkeywordstoSave) > 0) {
            foreach ($allkeywordstoSave as $keywordToSave) {
                $keywordArray = [
                    'adgroup_id' => $adgroup->id,
                    'created_by_id' => Auth::user()->id,
                    'keyword' => urldecode($keywordToSave)
                ];
                if (!\App\Keyword::where($keywordArray)->exists()) {
                    try {
                        \App\Keyword::create($keywordArray);
                    } catch (\Exception $e) {

                    }
                }
            }
        }

        $request = $this->saveFiles($request);
        $array = $request->except('t1', 't2', 'description', 'longdescription');

        $templateHtml = \App\Template::where('id', $request->template)->first();
        $array['name'] = $request->main_keyword;
        $array['adgroup_id'] = $adgroup->id;
        $array['template_id'] = $request->template_id;
        $array['title1'] = $request->t1;
        $array['title2'] = $request->t2;
        $array['description'] = $request->description;
        $array['longdescription'] = $request->description2;
        //$array['html'] = $templateHtml->html;


        $array['created_by_id'] = Auth::user()->id;
        if (!$page = \App\Page::where(['name' => $request->main_keyword, 'adgroup_id' => $adgroup->id, 'created_by_id' => Auth::user()->id])->first()) {
            if (isset($array['maincolor']) && strlen(trim($array['maincolor']) < 1)) {
                $array['maincolor'] = '253c57';
            }
            $page = \App\Page::create($array);
            $page->hash = base64_encode($page->created_at . '&' . $page->id);
            $page->maincolor = '253c57';
            $page->save();
        }


        $keywords = $adgroup->keywords()->get();
        $company = \App\Company::where('created_by_id', \Auth::user()->id)->first();
        $keywordString = '';
        if ($keywords) {
            foreach ($keywords as $keyword) {
                $keywordString .= ($keywordString) ? ',' : '';
                $keywordString .= $keyword->keyword;
            }
        }
        $questions = $adgroup->questions()->where('created_by_id', \Auth::user()->id)->where('answer', '!=', null)->get();

        /////////////////////////
        //Changes on template
        /////////////////////////


        if ($page->information) {
            $info = $page->information;
        } else {
            $info = $page->longdescription;
        }

        $data = Array(
            't1' => $page->title1,
            't2' => $page->title2,
            'd80' => $page->description,
            'd160' => $page->longdescription,
            'info' => $info,
            'logo' => null,
            'image' => env('UPLOAD_PATH') . '/thumb/' . $page->image,
            'page_token' => base64_encode($page->created_at . '&' . $page->id),
            'keywords' => $keywordString,
            'phone' => $campaign->phone,
            'email' => $campaign->email,
            'faq' => null,
            'faq_link' => null,
            'maincolor' => $page->maincolor,
            'about_link' => null,
            'about' => null,
            'youtube-text' => null,
            'youtube-src' => $page->youtube_url,
            'companyadress' => $company->adress,
            'companyzip' => $company->zip,
            'companycity' => $company->city,
            'companyname' => $company->name,
            'companyphone' => $company->info_phone,
            'companymail' => $company->info_mail,
            'teaserbackgroundimage' => $page->teaserbackgroundimage,
            'facebook' => $page->facebook,
            'twitter' => $page->twitter,
            'google_plus' => $page->google_plus,
            'youtube' => $page->youtube,
            'xing' => $page->xing,
            'linkedin' => $page->linkedin,
            'skype' => $page->skype,
            'link_url' => $page->link_url,
            'link_text' => $page->link_text,
            'domain' => $page->domain,
            'subdomain' => $page->subdomain,
            'background-image' => env('UPLOAD_PATH') . '/' . $page->background_image,
            'footer'=>'',
            'lng'=>'',
            'lat'=>'',
            'hosting'=>'',
            'index'=>'',
            'imprint'=>''

        );
        $html = \App\Template::where('id', $page->template_id)->first()->html;
        $this->saveTemplate($html, $page->id, $data);

        return redirect('/admin/pages/' . $page->id . '/edit-index');

    }

    public function barChartData(Request $request)
    {
        if ($request->has('start') && $request->has('end')) {
            $lead_count = Trackingevent::select(
                DB::raw('DATE(`created_at`) as `date`'),
                DB::raw('COUNT(*) as `count`')
            )
                ->where('eventAction', 'Lead')
                ->where('created_at', '>=', Carbon::parse($request->input('start') . ' 00:00:00'))
                ->where('created_at', '<=', Carbon::parse($request->input('end') . ' 23:59:59'))
                ->groupBy('date')
                ->get('date', 'count');


            $output = [];
            $output['lead'] = json_decode(json_encode($lead_count->toArray()));

            $sale_count = Trackingevent::select(
                DB::raw('DATE(`created_at`) as `date`'),
                DB::raw('COUNT(*) as `count`')
            )
                ->where('eventAction', 'Sale')
                ->where('created_at', '>=', Carbon::parse($request->input('start') . ' 00:00:00'))
                ->where('created_at', '<=', Carbon::parse($request->input('end') . ' 23:59:59'))
                ->groupBy('date')
                ->get('date', 'count');

            $output['sale'] = json_decode(json_encode($sale_count->toArray()));

            $lead_count = 0;
            foreach ($output['lead'] as $lead) {
                $lead_count += $lead->count;
            }

            $sale_count = 0;
            foreach ($output['sale'] as $sale) {
                $sale_count += $sale->count;
            }


            foreach ($output['lead'] as $lead) {
                $found = false;
                foreach ($output['sale'] as $sale) {


                    if ($sale->date == $lead->date) {
                        $found = true;
                    }

                }

                if (!$found) {
                    $output['sale'][] = json_decode(json_encode([
                        'date' => $lead->date,
                        'count' => 0
                    ]));
                }

            }


            foreach ($output['sale'] as $sale) {
                $found = false;
                foreach ($output['lead'] as $lead) {
                    if ($sale->date == $lead->date) {
                        $found = true;
                    }
                }

                if (!$found) {
                    $output['lead'][] = json_decode(json_encode([
                        'date' => $sale->date,
                        'count' => 0
                    ]));
                }

            }


            usort($output['lead'], array($this, "cmp"));
            usort($output['sale'], array($this, "cmp"));

            return response()->json($output);
        } else {
            return abort(422);
        }
        if (request()->ajax()) {
            $query = Campaign::query();
            $query->with("country");
            $query->with("language");
            $query->with("created_by");
            $template = 'actionsTemplate';
            if(request('show_deleted') == 1) {

        if (! Gate::allows('campaign_delete')) {
            return abort(401);
        }
                $query->onlyTrashed();
                $template = 'restoreTemplate';
            }
            $query->select([
                'campaigns.id',
                'campaigns.name',
                'campaigns.country_id',
                'campaigns.language_id',
                'campaigns.email',
                'campaigns.phone',
                'campaigns.start',
                'campaigns.end',
                'campaigns.b2c',
                'campaigns.b2b',
                'campaigns.budget',
                'campaigns.location_address',
                'campaigns.created_by_id',
            ]);
            $table = Datatables::of($query);

            $table->setRowAttr([
                'data-entry-id' => '{{$id}}',
            ]);
            $table->addColumn('massDelete', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');
            $table->editColumn('actions', function ($row) use ($template) {
                $gateKey  = 'campaign_';
                $routeKey = 'admin.campaigns';

                return view($template, compact('row', 'gateKey', 'routeKey'));
            });
            $table->editColumn('name', function ($row) {
                return $row->name ? $row->name : '';
            });
            $table->editColumn('country.name', function ($row) {
                return $row->country ? $row->country->name : '';
            });
            $table->editColumn('language.name', function ($row) {
                return $row->language ? $row->language->name : '';
            });
            $table->editColumn('email', function ($row) {
                return $row->email ? $row->email : '';
            });
            $table->editColumn('phone', function ($row) {
                return $row->phone ? $row->phone : '';
            });
            $table->editColumn('start', function ($row) {
                return $row->start ? $row->start : '';
            });
            $table->editColumn('end', function ($row) {
                return $row->end ? $row->end : '';
            });
            $table->editColumn('b2c', function ($row) {
                return \Form::checkbox("b2c", 1, $row->b2c == 1, ["disabled"]);
            });
            $table->editColumn('b2b', function ($row) {
                return \Form::checkbox("b2b", 1, $row->b2b == 1, ["disabled"]);
            });
            $table->editColumn('location', function ($row) {
                return $row->location ? $row->location : '';
            });
            $table->editColumn('created_by.name', function ($row) {
                return $row->created_by ? $row->created_by->name : '';
            });

            $table->rawColumns(['actions','massDelete','b2c','b2b']);

            return $table->make(true);
        }
    }

    public function getDataForChart(Request $request)
    {
        if ($request->has('start') && $request->has('end')) {


            $d1 = \Carbon\Carbon::parse($request->input('start') . ' 00:00:00');
            $d2 = \Carbon\Carbon::parse($request->input('end') . ' 23:59:59');
            $days_btw = $d1->diffInDays($d2);
            $day = Carbon::parse($request->start);
            for ($i = 0; $i < $days_btw; $i++) {
                $days2 = $day->addDays(1);
                $day = Carbon::parse($days2);
                //dump($day);
                $data['uuid'][Carbon::parse($days2)->format('Y-m-d')] = ['date' => Carbon::parse($days2)->format('Y-m-d'), 'count' => 0];
                $data['uri'] [Carbon::parse($days2)->format('Y-m-d')] = ['date' => Carbon::parse($days2)->format('Y-m-d'), 'count' => 0];
            }




            $uuids_count = Trackinguuid::select(
                DB::raw('DATE(`created_at`) as `date`'),
                DB::raw('COUNT(*) as `count`')
            )
                ->where('created_at', '>=', Carbon::parse($request->input('start') . ' 00:00:00'))
                ->where('created_at', '<=', Carbon::parse($request->input('end') . ' 23:59:59'))
                ->groupBy('date')
                ->get('date', 'count');


            //together


            $uuids_count_array = $uuids_count->toArray();
            //dump($uuids_count_array);

            foreach ($uuids_count_array as $u) {

                $data['uuid'][$u['date']]['count'] = $u['count'];

            }

            $newTmp = [];
            foreach ($data['uuid'] as $key => $value) {
                $newTmp[] = $value;
            }

            $output['uuid'] = json_decode(json_encode($newTmp));


            $uri_count = Trackinguri::select(
                DB::raw('DATE(`created_at`) as `date`'),
                DB::raw('COUNT(*) as `count`')
            )
                ->where('created_at', '>=', Carbon::parse($request->input('start') . ' 00:00:00'))
                ->where('created_at', '<=', Carbon::parse($request->input('end') . ' 23:59:59'))
                ->groupBy('date')
                ->get('date', 'count');


            //{"uuid":[{"date":"2018-07-03","count":33},{"date":"2018-07-15","count":44},{"date":"2018-07-16","count":13},],"uri":[{"date":"2018-07-03","count":1},{"date":"2018-07-15","count":1},{"date":"2018-07-16","count":13}]}


            $uri_count_array = $uri_count->toArray();
            foreach ($uri_count_array as $u) {

                $data['uri'][$u['date']]['count'] = $u['count'];

            }

            $newTmp = [];
            foreach ($data['uri'] as $key => $value) {
                $newTmp[] = $value;
            }



            $output['uri'] = json_decode(json_encode($newTmp));

            return response()->json($output);
        } else {
            return abort(422);
        }
    }


    public function loginForSuperAdmin($id)
    {
        if (Auth::user()->id !== 1) {
            return abort(403);
        } else {
            $user = User::findOrFail($id);
            Auth::login($user);
            return redirect('/');
        }
    }

    public function viewSetup(Request $request)
    {
        $countries = \App\Country::pluck('name', 'id');
        $languages = \App\Language::pluck('name', 'id');
        $setupData = \App\Campaign::with(['adgroup' => function ($q) {
            return $q->with('keywords', 'page');
        }])->limit(1)->get();
        $userCampaign = \App\Campaign::where('created_by_id', Auth::user()->id)->get();
        $owner = Owner::find(Auth::user()->owners_id);

        $templates = \App\Template::select('id', 'preview','name','language_id')->where('language_id','=',$owner->country_id)->get();

        //if (count($userCampaign) <=0 || !$userCampaign){
        return view('quickSetup', compact('countries', 'languages', 'setupData', 'userCampaign', 'owner','templates'));
        //}
        //return redirect('/');
    }


    public function campaignoverview(Request $request)
    {
        $setupData = \App\Campaign::with(['adgroup' => function ($q) {
            return $q->with('keywords', 'page');
        }])->limit(1)->get();
        return view('campaignview', compact('setupData'));
    }


    public function getStats(Request $request)
    {
        // echo \Auth::user()->id;
        $startDate = $request->start . ' 00:00:00';
        $endDate = $request->end . ' 23:59:59';
        $totals['visitors'] = \App\Trackinguri::where('created_by_id', Auth::user()->id)
            ->where('created_at', '>=', $startDate)->where('created_at', '<=', $endDate)->count();

        $totals['calls'] = 0;

        $totals['leads'] = \App\Lead::where('is_newsletter', 0)->where('created_by_id', Auth::user()->id)
            ->where('created_at', '>=', $startDate)->where('created_at', '<=', $endDate)->count();

        $totals['subscribers'] = \App\Lead::where('is_newsletter', 1)->where('created_by_id', Auth::user()->id)
            ->where('created_at', '>=', $startDate)->where('created_at', '<=', $endDate)->count();

        return view('setup', compact('totals'));
    }
    public function export_csv(){
        $campaign = Campaign::all();

        return view('admin.export.exportcsvforadword' ,compact('campaign'));
    }


}
