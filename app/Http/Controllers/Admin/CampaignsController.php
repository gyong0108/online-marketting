<?php

namespace App\Http\Controllers\Admin;

use App\Campaign;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreCampaignsRequest;
use App\Http\Requests\Admin\UpdateCampaignsRequest;
use App\Http\Controllers\Traits\FileUploadTrait;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Input;

use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
class CampaignsController extends Controller
{
    use FileUploadTrait;

    /**
     * Display a listing of Campaign.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (! Gate::allows('campaign_access')) {
            return abort(401);
        }
        if ($filterBy = Input::get('filter')) {
            if ($filterBy == 'all') {
                Session::put('Campaign.filter', 'all');
            } elseif ($filterBy == 'my') {
                Session::put('Campaign.filter', 'my');
            }
        }


        if (request()->ajax()) {
            $query = Campaign::query();
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
                'campaigns.keywords',
                'campaigns.daily_budget',
                'campaigns.title',
                'campaigns.undertitle',
                'campaigns.shortdescription',
                'campaigns.description',
                'campaigns.logo',
                'campaigns.image',
                'campaigns.email',
                'campaigns.active',
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
            $table->editColumn('keywords', function ($row) {
                return $row->keywords ? $row->keywords : '';
            });
            $table->editColumn('daily_budget', function ($row) {
                return $row->daily_budget ? $row->daily_budget : '';
            });
            $table->editColumn('shortdescription', function ($row) {
                return $row->shortdescription ? $row->shortdescription : '';
            });
            $table->editColumn('logo', function ($row) {
                if($row->logo) { return '<a href="'. asset(env('UPLOAD_PATH').'/' . $row->logo) .'" target="_blank"><img src="'. asset(env('UPLOAD_PATH').'/thumb/' . $row->logo) .'"/>'; };
            });
            $table->editColumn('image', function ($row) {
                if($row->image) { return '<a href="'. asset(env('UPLOAD_PATH').'/' . $row->image) .'" target="_blank"><img src="'. asset(env('UPLOAD_PATH').'/thumb/' . $row->image) .'"/>'; };
            });
            $table->editColumn('email', function ($row) {
                return $row->email ? $row->email : '';
            });
            $table->editColumn('active', function ($row) {
                return \Form::checkbox("active", 1, $row->active == 1, ["disabled"]);
            });
            $table->editColumn('created_by.name', function ($row) {
                return $row->created_by ? $row->created_by->name : '';
            });

            $table->rawColumns(['actions','massDelete','logo','image','active']);

            return $table->make(true);
        }

        return view('admin.campaigns.index');
    }

    /**
     * Show the form for creating new Campaign.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (! Gate::allows('campaign_create')) {
            return abort(401);
        }

        $created_bies = \App\User::get()->pluck('name', 'id')->prepend(trans('global.app_please_select'), '');

        return view('admin.campaigns.create', compact('created_bies'));
    }

    /**
     * Store a newly created Campaign in storage.
     *
     * @param  \App\Http\Requests\StoreCampaignsRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCampaignsRequest $request)
    {
        if (! Gate::allows('campaign_create')) {
            return abort(401);
        }
        $request = $this->saveFiles($request);
        $campaign = Campaign::create($request->all());



        return redirect()->route('admin.home');
    }


    /**
     * Show the form for editing Campaign.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (! Gate::allows('campaign_edit')) {
            return abort(401);
        }

        $created_bies = \App\User::get()->pluck('name', 'id')->prepend(trans('global.app_please_select'), '');

        $campaign = Campaign::findOrFail($id);

        return view('admin.campaigns.edit', compact('campaign', 'created_bies'));
    }

    /**
     * Update Campaign in storage.
     *
     * @param  \App\Http\Requests\UpdateCampaignsRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCampaignsRequest $request, $id)
    {
        if (! Gate::allows('campaign_edit')) {
            return abort(401);
        }
        $request = $this->saveFiles($request);
        $campaign = Campaign::findOrFail($id);
        $campaign->update($request->all());



        return redirect()->route('admin.campaigns.index');
    }


    /**
     * Display Campaign.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (! Gate::allows('campaign_view')) {
            return abort(401);
        }

        $created_bies = \App\User::get()->pluck('name', 'id')->prepend(trans('global.app_please_select'), '');$requests = \App\Request::where('adgroup_id', $id)->get();

        $campaign = Campaign::findOrFail($id);

        return view('admin.campaigns.show', compact('campaign', 'requests'));
    }


    /**
     * Remove Campaign from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (! Gate::allows('campaign_delete')) {
            return abort(401);
        }
        $campaign = Campaign::findOrFail($id);
        $campaign->delete();

        return redirect()->route('admin.campaigns.index');
    }

    /**
     * Delete all selected Campaign at once.
     *
     * @param Request $request
     */
    public function massDestroy(Request $request)
    {
        if (! Gate::allows('campaign_delete')) {
            return abort(401);
        }
        if ($request->input('ids')) {
            $entries = Campaign::whereIn('id', $request->input('ids'))->get();

            foreach ($entries as $entry) {
                $entry->delete();
            }
        }
    }


    /**
     * Restore Campaign from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function restore($id)
    {
        if (! Gate::allows('campaign_delete')) {
            return abort(401);
        }
        $campaign = Campaign::onlyTrashed()->findOrFail($id);
        $campaign->restore();

        return redirect()->route('admin.campaigns.index');
    }

    /**
     * Permanently delete Campaign from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function perma_del($id)
    {
        if (! Gate::allows('campaign_delete')) {
            return abort(401);
        }
        $campaign = Campaign::onlyTrashed()->findOrFail($id);
        $campaign->forceDelete();

        return redirect()->route('admin.campaigns.index');
    }
}
