<?php

namespace App\Http\Controllers\Admin;

use App\Request;

use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreRequestsRequest;
use App\Http\Requests\Admin\UpdateRequestsRequest;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Input;

use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
class RequestsController extends Controller
{
    /**
     * Display a listing of Request.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (! Gate::allows('request_access')) {
            return abort(401);
        }
        if ($filterBy = Input::get('filter')) {
            if ($filterBy == 'all') {
                Session::put('Request.filter', 'all');
            } elseif ($filterBy == 'my') {
                Session::put('Request.filter', 'my');
            }
        }


        if (request()->ajax()) {
            $query = Request::query();
            $query->with("adgroup");
            $query->with("created_by");
            $template = 'actionsTemplate';
            if(request('show_deleted') == 1) {

        if (! Gate::allows('request_delete')) {
            return abort(401);
        }
                $query->onlyTrashed();
                $template = 'restoreTemplate';
            }
            $query->select([
                'requests.id',
                'requests.landingpage',
                'requests.target',
                'requests.city',
                'requests.not_clear',
                'requests.no_phonenumber',
                'requests.no_email',
                'requests.no_form',
                'requests.no_content',
                'requests.no_faq',
                'requests.adgroup_id',
                'requests.other_keywords',
                'requests.aswered',
                'requests.created_by_id',
            ]);
            $table = Datatables::of($query);

            $table->setRowAttr([
                'data-entry-id' => '{{$id}}',
            ]);
            $table->addColumn('massDelete', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');
            $table->editColumn('actions', function ($row) use ($template) {
                $gateKey  = 'request_';
                $routeKey = 'admin.requests';

                return view($template, compact('row', 'gateKey', 'routeKey'));
            });
            $table->editColumn('target', function ($row) {
                return $row->target ? $row->target : '';
            });
            $table->editColumn('city', function ($row) {
                return $row->city ? $row->city : '';
            });
            $table->editColumn('not_clear', function ($row) {
                return $row->not_clear ? $row->not_clear : '';
            });
            $table->editColumn('no_phonenumber', function ($row) {
                return \Form::checkbox("no_phonenumber", 1, $row->no_phonenumber == 1, ["disabled"]);
            });
            $table->editColumn('no_email', function ($row) {
                return \Form::checkbox("no_email", 1, $row->no_email == 1, ["disabled"]);
            });
            $table->editColumn('no_form', function ($row) {
                return \Form::checkbox("no_form", 1, $row->no_form == 1, ["disabled"]);
            });
            $table->editColumn('no_content', function ($row) {
                return \Form::checkbox("no_content", 1, $row->no_content == 1, ["disabled"]);
            });
            $table->editColumn('no_faq', function ($row) {
                return \Form::checkbox("no_faq", 1, $row->no_faq == 1, ["disabled"]);
            });
            $table->editColumn('adgroup.title', function ($row) {
                return $row->adgroup ? $row->adgroup->title : '';
            });
            $table->editColumn('other_keywords', function ($row) {
                return $row->other_keywords ? $row->other_keywords : '';
            });
            $table->editColumn('aswered', function ($row) {
                return $row->aswered ? $row->aswered : '';
            });
            $table->editColumn('created_by.name', function ($row) {
                return $row->created_by ? $row->created_by->name : '';
            });

            $table->rawColumns(['actions','massDelete','no_phonenumber','no_email','no_form','no_content','no_faq']);

            return $table->make(true);
        }

        return view('admin.requests.index');
    }

    /**
     * Show the form for creating new Request.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (! Gate::allows('request_create')) {
            return abort(401);
        }

        $adgroups = \App\Campaign::get()->pluck('title', 'id')->prepend(trans('global.app_please_select'), '');
        $created_bies = \App\User::get()->pluck('name', 'id')->prepend(trans('global.app_please_select'), '');

        return view('admin.requests.create', compact('adgroups', 'created_bies'));
    }

    /**
     * Store a newly created Request in storage.
     *
     * @param  \App\Http\Requests\StoreRequestsRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRequestsRequest $request)
    {
        if (! Gate::allows('request_create')) {
            return abort(401);
        }
        $request = Request::create($request->all());



        return redirect()->route('admin.requests.index');
    }


    /**
     * Show the form for editing Request.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (! Gate::allows('request_edit')) {
            return abort(401);
        }

        $adgroups = \App\Campaign::get()->pluck('title', 'id')->prepend(trans('global.app_please_select'), '');
        $created_bies = \App\User::get()->pluck('name', 'id')->prepend(trans('global.app_please_select'), '');

        $request = Request::findOrFail($id);

        return view('admin.requests.edit', compact('request', 'adgroups', 'created_bies'));
    }

    /**
     * Update Request in storage.
     *
     * @param  \App\Http\Requests\UpdateRequestsRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRequestsRequest $request, $id)
    {
        if (! Gate::allows('request_edit')) {
            return abort(401);
        }
        $request = Request::findOrFail($id);
        $request->update($request->all());



        return redirect()->route('admin.requests.index');
    }


    /**
     * Display Request.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (! Gate::allows('request_view')) {
            return abort(401);
        }
        $request = Request::findOrFail($id);

        return view('admin.requests.show', compact('request'));
    }


    /**
     * Remove Request from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (! Gate::allows('request_delete')) {
            return abort(401);
        }
        $request = Request::findOrFail($id);
        $request->delete();

        return redirect()->route('admin.requests.index');
    }

    /**
     * Delete all selected Request at once.
     *
     * @param Request $request
     */
    public function massDestroy(Request $request)
    {
        if (! Gate::allows('request_delete')) {
            return abort(401);
        }
        if ($request->input('ids')) {
            $entries = Request::whereIn('id', $request->input('ids'))->get();

            foreach ($entries as $entry) {
                $entry->delete();
            }
        }
    }


    /**
     * Restore Request from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function restore($id)
    {
        if (! Gate::allows('request_delete')) {
            return abort(401);
        }
        $request = Request::onlyTrashed()->findOrFail($id);
        $request->restore();

        return redirect()->route('admin.requests.index');
    }

    /**
     * Permanently delete Request from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function perma_del($id)
    {
        if (! Gate::allows('request_delete')) {
            return abort(401);
        }
        $request = Request::onlyTrashed()->findOrFail($id);
        $request->forceDelete();

        return redirect()->route('admin.requests.index');
    }
}
