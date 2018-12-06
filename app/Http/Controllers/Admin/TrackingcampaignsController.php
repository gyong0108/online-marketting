<?php

namespace App\Http\Controllers\Admin;

use App\Trackingcampaign;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreTrackingcampaignsRequest;
use App\Http\Requests\Admin\UpdateTrackingcampaignsRequest;
use Yajra\DataTables\DataTables;

use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
class TrackingcampaignsController extends Controller
{
    /**
     * Display a listing of Trackingcampaign.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {


        
        if (request()->ajax()) {
            $query = Trackingcampaign::query();
            $query->with("uuid");
            $template = 'actionsTemplate';
            
            $query->select([
                'trackingcampaigns.id',
                'trackingcampaigns.uuid_id',
                'trackingcampaigns.source',
                'trackingcampaigns.medium',
                'trackingcampaigns.campaign',
                'trackingcampaigns.term',
                'trackingcampaigns.content',
            ]);
            $table = Datatables::of($query);

            $table->setRowAttr([
                'data-entry-id' => '{{$id}}',
            ]);
            $table->addColumn('massDelete', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');
            $table->editColumn('actions', function ($row) use ($template) {
                $gateKey  = 'trackingcampaign_';
                $routeKey = 'admin.trackingcampaigns';

                return view($template, compact('row', 'gateKey', 'routeKey'));
            });
            $table->editColumn('uuid.country', function ($row) {
                return $row->uuid ? $row->uuid->country : '';
            });

            $table->rawColumns(['actions']);

            return $table->make(true);
        }

        return view('admin.trackingcampaigns.index');
    }
}
