<?php

namespace App\Http\Controllers\Admin;

use App\Trackinguuid;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreTrackinguuidsRequest;
use App\Http\Requests\Admin\UpdateTrackinguuidsRequest;
use Yajra\DataTables\DataTables;

use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
class TrackinguuidsController extends Controller
{
    /**
     * Display a listing of Trackinguuid.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {


        
        if (request()->ajax()) {
            $query = Trackinguuid::query();
            $template = 'actionsTemplate';
            
            $query->select([
                'trackinguuids.id',
                'trackinguuids.country',
                'trackinguuids.language',
                'trackinguuids.resolution',
                'trackinguuids.javascript',
            ]);
            $table = Datatables::of($query);

            $table->setRowAttr([
                'data-entry-id' => '{{$id}}',
            ]);
            $table->addColumn('massDelete', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');
            $table->editColumn('actions', function ($row) use ($template) {
                $gateKey  = 'trackinguuid_';
                $routeKey = 'admin.trackinguuids';

                return view($template, compact('row', 'gateKey', 'routeKey'));
            });
            $table->editColumn('country', function ($row) {
                return $row->country ? $row->country : '';
            });
            $table->editColumn('language', function ($row) {
                return $row->language ? $row->language : '';
            });
            $table->editColumn('resolution', function ($row) {
                return $row->resolution ? $row->resolution : '';
            });
            $table->editColumn('javascript', function ($row) {
                return \Form::checkbox("javascript", 1, $row->javascript == 1, ["disabled"]);
            });

            $table->rawColumns(['actions','javascript']);

            return $table->make(true);
        }

        return view('admin.trackinguuids.index');
    }
}
