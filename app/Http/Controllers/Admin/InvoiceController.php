<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Invoice;
use App\InvoiceData;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;
class InvoiceController extends Controller
{
    //

    public function getdata(){
        $query = Invoice::query()->where('created_by_id', Auth::user()->id);

        $query->select([
            'id',
            'company',
            'amount',
            'city',
            'zip',
            'country',
            'created_at',
        ]);

        $table = Datatables::of($query);

        $table->setRowAttr([
            'data-entry-id' => '{{$id}}',
        ]);
        $table->addColumn('massDelete', '&nbsp;');

        $table->editColumn('state', function ($row) {
            return $row->state ? $row->state : '';
        });

        $table->addColumn('download', '&nbsp;');

        $table->editColumn('download', function ($row) {
            return '<a href="/admin/invoices/' . $row->id . '/download">Download</a>';
        });

        $table->rawColumns(['massDelete', 'download']);

        return $table->make(true);
    }
}
