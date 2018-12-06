<?php

namespace App\Http\Controllers\Admin;

use App\Trackingevent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreTrackingeventsRequest;
use App\Http\Requests\Admin\UpdateTrackingeventsRequest;
use Yajra\DataTables\DataTables;

use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
class TrackingeventsController extends Controller
{
    /**
     * Display a listing of Trackingevent.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {


        
        if (request()->ajax()) {
            $query = Trackingevent::query();
            $query->with("uuid");
            $query->with("page");
            $template = 'actionsTemplate';
            
            $query->select([
                'trackingevents.id',
                'trackingevents.uuid_id',
                'trackingevents.page_id',
                'trackingevents.eventcategory',
                'trackingevents.eventaction',
                'trackingevents.eventlabel',
                'trackingevents.eventvalue',
            ]);
            $table = Datatables::of($query);

            $table->setRowAttr([
                'data-entry-id' => '{{$id}}',
            ]);
            $table->addColumn('massDelete', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');
            $table->editColumn('actions', function ($row) use ($template) {
                $gateKey  = 'trackingevent_';
                $routeKey = 'admin.trackingevents';

                return view($template, compact('row', 'gateKey', 'routeKey'));
            });
            $table->editColumn('uuid.country', function ($row) {
                return $row->uuid ? $row->uuid->country : '';
            });
            $table->editColumn('page.domain_key', function ($row) {
                return $row->page ? $row->page->domain_key : '';
            });
            $table->editColumn('eventcategory', function ($row) {
                return $row->eventcategory ? $row->eventcategory : '';
            });
            $table->editColumn('eventaction', function ($row) {
                return $row->eventaction ? $row->eventaction : '';
            });
            $table->editColumn('eventlabel', function ($row) {
                return $row->eventlabel ? $row->eventlabel : '';
            });
            $table->editColumn('eventvalue', function ($row) {
                return $row->eventvalue ? $row->eventvalue : '';
            });

            $table->rawColumns(['actions']);

            return $table->make(true);
        }

        return view('admin.trackingevents.index');
    }
}
