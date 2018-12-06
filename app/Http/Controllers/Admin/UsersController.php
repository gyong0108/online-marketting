<?php

namespace App\Http\Controllers\Admin;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreUsersRequest;
use App\Http\Requests\Admin\UpdateUsersRequest;
use Braintree_Customer;
use Braintree_Transaction;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
class UsersController extends Controller
{
    /**
     * Display a listing of User.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (! Gate::allows('user_access')) {
            return abort(401);
        }


                $users = User::all();

        return view('admin.users.index', compact('users'));
    }

    /**
     * Show the form for creating new User.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (! Gate::allows('user_create')) {
            return abort(401);
        }

        $roles = \App\Role::get()->pluck('title', 'id');


        return view('admin.users.create', compact('roles'));
    }

    /**
     * Store a newly created User in storage.
     *
     * @param  \App\Http\Requests\StoreUsersRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUsersRequest $request)
    {
        if (! Gate::allows('user_create')) {
            return abort(401);
        }
        $user = User::create($request->all());
        $user->role()->sync(array_filter((array)$request->input('role')));



        return redirect()->route('admin.users.index');
    }


    /**
     * Show the form for editing User.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (! Gate::allows('user_edit')) {
            return abort(401);
        }

        $roles = \App\Role::get()->pluck('title', 'id');


        $user = User::findOrFail($id);

        return view('admin.users.edit', compact('user', 'roles'));
    }

    /**
     * Update User in storage.
     *
     * @param  \App\Http\Requests\UpdateUsersRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateUsersRequest $request, $id)
    {
        if (! Gate::allows('user_edit')) {
            return abort(401);
        }
        $user = User::findOrFail($id);
        $user->update($request->all());
        $user->role()->sync(array_filter((array)$request->input('role')));



        return redirect()->route('admin.users.index');
    }


    /**
     * Display User.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (! Gate::allows('user_view')) {
            return abort(401);
        }

        $roles = \App\Role::get()->pluck('title', 'id');
$stripe_transactions = \App\StripeTransaction::where('transaction_user_id', $id)->get();$payments = \App\Payment::where('user_id', $id)->get();$user_actions = \App\UserAction::where('user_id', $id)->get();$internal_notifications = \App\InternalNotification::whereHas('users',
                    function ($query) use ($id) {
                        $query->where('id', $id);
                    })->get();$campaigns = \App\Campaign::where('created_by_id', $id)->get();$requests = \App\Request::where('created_by_id', $id)->get();

        $user = User::findOrFail($id);

        return view('admin.users.show', compact('user', 'stripe_transactions', 'payments', 'user_actions', 'internal_notifications', 'campaigns', 'requests'));
    }


    /**
     * Remove User from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (! Gate::allows('user_delete')) {
            return abort(401);
        }
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->route('admin.users.index');
    }

    /**
     * Delete all selected User at once.
     *
     * @param Request $request
     */
    public function massDestroy(Request $request)
    {
        if (! Gate::allows('user_delete')) {
            return abort(401);
        }
        if ($request->input('ids')) {
            $entries = User::whereIn('id', $request->input('ids'))->get();

            foreach ($entries as $entry) {
                $entry->delete();
            }
        }
    }

    //////////////////////////////////////////
    public function updateprofile(Request $request)
    {
        $user = Auth::getUser();

        //only name, email and phone PASSWORD is done
       $validator =  \Validator::make($request->all(), [
            'name' => 'required',

            'phone' => 'required',
        ]);

        if ($validator->fails()) {

             return back()->withErrors($validator)->withInput();

        } else {
            $user->name = $request->get('name');

             $user->phone = $request->get('phone');
            $user->save();
            return redirect()->back()->with('success', 'Profile Update successfully!');
            //return redirect()->back()->withErrors();

        }
    }


    public function addCustomer()
    {
        $user = Auth::user();
        if(!empty($user->braintree_cid)) {
            return $user->braintree_cid;
        } else {
            $result = Braintree_Customer::create(array(
                'firstName' => $user->name,
                'email' => $user->email,
            ));

            if ($result->success) {
                $user->braintree_cid = $result->customer->id;
                $user->save();
                return $result->customer->id;
            } else {
                $errorFound = '';
                foreach ($result->errors->deepAll() as $error) {
                    $errorFound .= $error->message . "<br />";
                }
                throw new \Exception($errorFound);
            }
        }
    }


}
