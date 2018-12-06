<?php

namespace App\Http\Controllers\Admin;

use App\Trackinguri;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreTrackingurisRequest;
use App\Http\Requests\Admin\UpdateTrackingurisRequest;
use Yajra\DataTables\DataTables;

use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
class TrackingurisController extends Controller
{
    /**
     * Display a listing of Trackinguri.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {


        
        if (request()->ajax()) {
            $query = Trackinguri::query();
            $query->with("uuid");
            $query->with("page");
            $template = 'actionsTemplate';
            
            $query->select([
                'trackinguris.id',
                'trackinguris.uuid_id',
                'trackinguris.page_id',
                'trackinguris.pageloadingtime',
                'trackinguris.timeonpage',
                'trackinguris.referer',
            ]);
            $table = Datatables::of($query);

            $table->setRowAttr([
                'data-entry-id' => '{{$id}}',
            ]);
            $table->addColumn('massDelete', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');
            $table->editColumn('actions', function ($row) use ($template) {
                $gateKey  = 'trackinguri_';
                $routeKey = 'admin.trackinguris';

                return view($template, compact('row', 'gateKey', 'routeKey'));
            });
            $table->editColumn('uuid.country', function ($row) {
                return $row->uuid ? $row->uuid->country : '';
            });
            $table->editColumn('page.domain_key', function ($row) {
                return $row->page ? $row->page->domain_key : '';
            });

            $table->rawColumns(['actions']);

            return $table->make(true);
        }

        return view('admin.trackinguris.index');
    }
}
