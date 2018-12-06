<?php

namespace App\Http\Controllers\Api\V1;

use App\Request;
use Illuminate\Http\Request;
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
    public function index()
    {
        return Request::all();
    }

    public function show($id)
    {
        return Request::findOrFail($id);
    }

    public function update(UpdateRequestsRequest $request, $id)
    {
        $request = Request::findOrFail($id);
        $request->update($request->all());
        

        return $request;
    }

    public function store(StoreRequestsRequest $request)
    {
        $request = Request::create($request->all());
        

        return $request;
    }

    public function destroy($id)
    {
        $request = Request::findOrFail($id);
        $request->delete();
        return '';
    }
}
