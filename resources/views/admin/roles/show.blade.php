@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('global.roles.title')</h3>

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('global.app_view')
        </div>

        <div class="panel-body table-responsive">
            <div class="row">
                <div class="col-md-6">
                    <table class="table table-bordered table-striped">
                        <tr>
                            <th>@lang('global.roles.fields.title')</th>
                            <td field-key='title'>{{ $role->title }}</td>
                        </tr>
                        <tr>
                            <th>@lang('global.roles.fields.permission')</th>
                            <td field-key='permission'>
                                @foreach ($role->permission as $singlePermission)
                                    <span class="label label-info label-many">{{ $singlePermission->title }}</span>
                                @endforeach
                            </td>
                        </tr>
                        <tr>
                            <th>@lang('global.roles.fields.price')</th>
                            <td field-key='price'>{{ $role->price }}</td>
                        </tr>
                        <tr>
                            <th>@lang('global.roles.fields.stripe-plan-id')</th>
                            <td field-key='stripe_plan_id'>{{ $role->stripe_plan_id }}</td>
                        </tr>
                    </table>
                </div>
            </div><!-- Nav tabs -->
<ul class="nav nav-tabs" role="tablist">
    
<li role="presentation" class="active"><a href="#payments" aria-controls="payments" role="tab" data-toggle="tab">Payments</a></li>
<li role="presentation" class=""><a href="#users" aria-controls="users" role="tab" data-toggle="tab">Users</a></li>
</ul>

<!-- Tab panes -->
<div class="tab-content">
    
<div role="tabpanel" class="tab-pane active" id="payments">
<table class="table table-bordered table-striped {{ count($payments) > 0 ? 'datatable' : '' }}">
    <thead>
        <tr>
            <th>@lang('global.payments.fields.user')</th>
                        <th>@lang('global.payments.fields.role')</th>
                        <th>@lang('global.payments.fields.payment-amount')</th>
                        
        </tr>
    </thead>

    <tbody>
        @if (count($payments) > 0)
            @foreach ($payments as $payment)
                <tr data-entry-id="{{ $payment->id }}">
                    <td field-key='user'>{{ $payment->user->email ?? '' }}</td>
                                <td field-key='role'>{{ $payment->role->title ?? '' }}</td>
                                <td field-key='payment_amount'>{{ $payment->payment_amount }}</td>
                                
                </tr>
            @endforeach
        @else
            <tr>
                <td colspan="6">@lang('global.app_no_entries_in_table')</td>
            </tr>
        @endif
    </tbody>
</table>
</div>
<div role="tabpanel" class="tab-pane " id="users">
<table class="table table-bordered table-striped {{ count($users) > 0 ? 'datatable' : '' }}">
    <thead>
        <tr>
            <th>@lang('global.users.fields.name')</th>
                        <th>@lang('global.users.fields.email')</th>
                        <th>@lang('global.users.fields.role')</th>
                        <th>@lang('global.users.fields.approved')</th>
                        <th>@lang('global.users.fields.premium')</th>
                                                <th>&nbsp;</th>

        </tr>
    </thead>

    <tbody>
        @if (count($users) > 0)
            @foreach ($users as $user)
                <tr data-entry-id="{{ $user->id }}">
                    <td field-key='name'>{{ $user->name }}</td>
                                <td field-key='email'>{{ $user->email }}</td>
                                <td field-key='role'>
                                    @foreach ($user->role as $singleRole)
                                        <span class="label label-info label-many">{{ $singleRole->title }}</span>
                                    @endforeach
                                </td>
                                <td field-key='approved'>{{ Form::checkbox("approved", 1, $user->approved == 1 ? true : false, ["disabled"]) }}</td>
                                <td field-key='premium'>{{ Form::checkbox("premium", 1, $user->premium == 1 ? true : false, ["disabled"]) }}</td>
                                                                <td>
                                    @can('user_view')
                                    <a href="{{ route('admin.users.show',[$user->id]) }}" class="btn btn-xs btn-primary">@lang('global.app_view')</a>
                                    @endcan
                                    @can('user_edit')
                                    <a href="{{ route('admin.users.edit',[$user->id]) }}" class="btn btn-xs btn-info">@lang('global.app_edit')</a>
                                    @endcan
                                    @can('user_delete')
{!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['admin.users.destroy', $user->id])) !!}
                                    {!! Form::submit(trans('global.app_delete'), array('class' => 'btn btn-xs btn-danger')) !!}
                                    {!! Form::close() !!}
                                    @endcan
                                </td>

                </tr>
            @endforeach
        @else
            <tr>
                <td colspan="12">@lang('global.app_no_entries_in_table')</td>
            </tr>
        @endif
    </tbody>
</table>
</div>
</div>

            <p>&nbsp;</p>

            <a href="{{ route('admin.roles.index') }}" class="btn btn-default">@lang('global.app_back_to_list')</a>
        </div>
    </div>
@stop


