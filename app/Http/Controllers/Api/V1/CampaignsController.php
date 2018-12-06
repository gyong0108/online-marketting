<?php

namespace App\Http\Controllers\Api\V1;

use App\Campaign;
use Illuminate\Http\Request;
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

    public function index()
    {
        return Campaign::all();
    }

    public function show($id)
    {
        return Campaign::findOrFail($id);
    }

    public function update(UpdateCampaignsRequest $request, $id)
    {
        $request = $this->saveFiles($request);
        $campaign = Campaign::findOrFail($id);
        $campaign->update($request->all());
        

        return $campaign;
    }

    public function store(StoreCampaignsRequest $request)
    {
        $request = $this->saveFiles($request);
        $campaign = Campaign::create($request->all());
        

        return $campaign;
    }

    public function destroy($id)
    {
        $campaign = Campaign::findOrFail($id);
        $campaign->delete();
        return '';
    }
}
