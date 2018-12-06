<?php

namespace App\Http\Controllers\Admin;

use App\Trackingpage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreTrackingpagesRequest;
use App\Http\Requests\Admin\UpdateTrackingpagesRequest;
use Yajra\DataTables\DataTables;

use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
class TrackingpagesController extends Controller
{
    /**
     * Display a listing of Trackingpage.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {


        
        if (request()->ajax()) {
            $query = Trackingpage::query();
            $template = 'actionsTemplate';
            
            $query->select([
                'trackingpages.id',
                'trackingpages.domain_key',
                'trackingpages.uri',
                'trackingpages.title',
            ]);
            $table = Datatables::of($query);

            $table->setRowAttr([
                'data-entry-id' => '{{$id}}',
            ]);
            $table->addColumn('massDelete', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');
            $table->editColumn('actions', function ($row) use ($template) {
                $gateKey  = 'trackingpage_';
                $routeKey = 'admin.trackingpages';

                return view($template, compact('row', 'gateKey', 'routeKey'));
            });
            $table->editColumn('domain_key', function ($row) {
                return $row->domain_key ? $row->domain_key : '';
            });
            $table->editColumn('uri', function ($row) {
                return $row->uri ? $row->uri : '';
            });
            $table->editColumn('title', function ($row) {
                return $row->title ? $row->title : '';
            });

            $table->rawColumns(['actions']);

            return $table->make(true);
        }

        return view('admin.trackingpages.index');
    }

    /**
     * Show the form for creating new Trackingpage.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.trackingpages.create');
    }

    /**
     * Store a newly created Trackingpage in storage.
     *
     * @param  \App\Http\Requests\StoreTrackingpagesRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreTrackingpagesRequest $request)
    {
        $trackingpage = Trackingpage::create($request->all());



        return redirect()->route('admin.trackingpages.index');
    }

}
