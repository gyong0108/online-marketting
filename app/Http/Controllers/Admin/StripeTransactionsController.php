<?php

namespace App\Http\Controllers\Admin;

use App\StripeTransaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreStripeTransactionsRequest;
use App\Http\Requests\Admin\UpdateStripeTransactionsRequest;

use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
class StripeTransactionsController extends Controller
{
    /**
     * Display a listing of StripeTransaction.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (! Gate::allows('stripe_transaction_access')) {
            return abort(401);
        }


                $stripe_transactions = StripeTransaction::all();

        return view('admin.stripe_transactions.index', compact('stripe_transactions'));
    }
}
