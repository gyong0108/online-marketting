@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('global.users.title')</h3>

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('global.app_view')
        </div>

        <div class="panel-body table-responsive">
            <div class="row">
                <div class="col-md-6">
                    <table class="table table-bordered table-striped">
                        <tr>
                            <th>@lang('global.users.fields.name')</th>
                            <td field-key='name'>{{ $user->name }}</td>
                        </tr>
                        <tr>
                            <th>@lang('global.users.fields.email')</th>
                            <td field-key='email'>{{ $user->email }}</td>
                        </tr>
                        <tr>
                            <th>@lang('global.users.fields.role')</th>
                            <td field-key='role'>
                                @foreach ($user->role as $singleRole)
                                    <span class="label label-info label-many">{{ $singleRole->title }}</span>
                                @endforeach
                            </td>
                        </tr>
                        <tr>
                            <th>@lang('global.users.fields.approved')</th>
                            <td field-key='approved'>{{ Form::checkbox("approved", 1, $user->approved == 1 ? true : false, ["disabled"]) }}</td>
                        </tr>
                        <tr>
                            <th>@lang('global.users.fields.premium')</th>
                            <td field-key='premium'>{{ Form::checkbox("premium", 1, $user->premium == 1 ? true : false, ["disabled"]) }}</td>
                        </tr>
                        <tr>
                            <th>@lang('global.users.fields.stripe-customer-id')</th>
                            <td field-key='stripe_customer_id'>{{ $user->stripe_customer_id }}</td>
                        </tr>
                    </table>
                </div>
            </div><!-- Nav tabs -->
<ul class="nav nav-tabs" role="tablist">
    
<li role="presentation" class="active"><a href="#stripe_transactions" aria-controls="stripe_transactions" role="tab" data-toggle="tab">Stripe Transactions</a></li>
<li role="presentation" class=""><a href="#payments" aria-controls="payments" role="tab" data-toggle="tab">Payments</a></li>
<li role="presentation" class=""><a href="#user_actions" aria-controls="user_actions" role="tab" data-toggle="tab">User actions</a></li>
<li role="presentation" class=""><a href="#internal_notifications" aria-controls="internal_notifications" role="tab" data-toggle="tab">Notifications</a></li>
<li role="presentation" class=""><a href="#campaigns" aria-controls="campaigns" role="tab" data-toggle="tab">Campaigns</a></li>
<li role="presentation" class=""><a href="#requests" aria-controls="requests" role="tab" data-toggle="tab">Requests</a></li>
</ul>

<!-- Tab panes -->
<div class="tab-content">
    
<div role="tabpanel" class="tab-pane active" id="stripe_transactions">
<table class="table table-bordered table-striped {{ count($stripe_transactions) > 0 ? 'datatable' : '' }}">
    <thead>
        <tr>
            <th>@lang('global.stripe-transactions.created_at')</th>
                        <th>@lang('global.stripe-transactions.fields.transaction-user')</th>
                        <th>@lang('global.stripe-transactions.fields.amount')</th>
                        
        </tr>
    </thead>

    <tbody>
        @if (count($stripe_transactions) > 0)
            @foreach ($stripe_transactions as $stripe_transaction)
                <tr data-entry-id="{{ $stripe_transaction->id }}">
                    <td>{{ $stripe_transaction->created_at ?? '' }}</td>
                                <td field-key='transaction_user'>{{ $stripe_transaction->transaction_user->email ?? '' }}</td>
                                <td field-key='amount'>{{ $stripe_transaction->amount }}</td>
                                
                </tr>
            @endforeach
        @else
            <tr>
                <td colspan="5">@lang('global.app_no_entries_in_table')</td>
            </tr>
        @endif
    </tbody>
</table>
</div>
<div role="tabpanel" class="tab-pane " id="payments">
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
<div role="tabpanel" class="tab-pane " id="user_actions">
<table class="table table-bordered table-striped {{ count($user_actions) > 0 ? 'datatable' : '' }}">
    <thead>
        <tr>
            <th>@lang('global.user-actions.created_at')</th>
                        <th>@lang('global.user-actions.fields.user')</th>
                        <th>@lang('global.user-actions.fields.action')</th>
                        <th>@lang('global.user-actions.fields.action-model')</th>
                        <th>@lang('global.user-actions.fields.action-id')</th>
                        
        </tr>
    </thead>

    <tbody>
        @if (count($user_actions) > 0)
            @foreach ($user_actions as $user_action)
                <tr data-entry-id="{{ $user_action->id }}">
                    <td>{{ $user_action->created_at ?? '' }}</td>
                                <td field-key='user'>{{ $user_action->user->name ?? '' }}</td>
                                <td field-key='action'>{{ $user_action->action }}</td>
                                <td field-key='action_model'>{{ $user_action->action_model }}</td>
                                <td field-key='action_id'>{{ $user_action->action_id }}</td>
                                
                </tr>
            @endforeach
        @else
            <tr>
                <td colspan="7">@lang('global.app_no_entries_in_table')</td>
            </tr>
        @endif
    </tbody>
</table>
</div>
<div role="tabpanel" class="tab-pane " id="internal_notifications">
<table class="table table-bordered table-striped {{ count($internal_notifications) > 0 ? 'datatable' : '' }}">
    <thead>
        <tr>
            <th>@lang('global.internal-notifications.fields.text')</th>
                        <th>@lang('global.internal-notifications.fields.link')</th>
                        <th>@lang('global.internal-notifications.fields.users')</th>
                                                <th>&nbsp;</th>

        </tr>
    </thead>

    <tbody>
        @if (count($internal_notifications) > 0)
            @foreach ($internal_notifications as $internal_notification)
                <tr data-entry-id="{{ $internal_notification->id }}">
                    <td field-key='text'>{{ $internal_notification->text }}</td>
                                <td field-key='link'>{{ $internal_notification->link }}</td>
                                <td field-key='users'>
                                    @foreach ($internal_notification->users as $singleUsers)
                                        <span class="label label-info label-many">{{ $singleUsers->name }}</span>
                                    @endforeach
                                </td>
                                                                <td>
                                    @can('internal_notification_view')
                                    <a href="{{ route('admin.internal_notifications.show',[$internal_notification->id]) }}" class="btn btn-xs btn-primary">@lang('global.app_view')</a>
                                    @endcan
                                    @can('internal_notification_edit')
                                    <a href="{{ route('admin.internal_notifications.edit',[$internal_notification->id]) }}" class="btn btn-xs btn-info">@lang('global.app_edit')</a>
                                    @endcan
                                    @can('internal_notification_delete')
{!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['admin.internal_notifications.destroy', $internal_notification->id])) !!}
                                    {!! Form::submit(trans('global.app_delete'), array('class' => 'btn btn-xs btn-danger')) !!}
                                    {!! Form::close() !!}
                                    @endcan
                                </td>

                </tr>
            @endforeach
        @else
            <tr>
                <td colspan="8">@lang('global.app_no_entries_in_table')</td>
            </tr>
        @endif
    </tbody>
</table>
</div>
<div role="tabpanel" class="tab-pane " id="campaigns">
<table class="table table-bordered table-striped {{ count($campaigns) > 0 ? 'datatable' : '' }}">
    <thead>
        <tr>
            <th>@lang('global.campaigns.fields.name')</th>
                        <th>@lang('global.campaigns.fields.daily-budget')</th>
                        <th>@lang('global.campaigns.fields.title')</th>
                        <th>@lang('global.campaigns.fields.undertitle')</th>
                        <th>@lang('global.campaigns.fields.active')</th>
                        @if( request('show_deleted') == 1 )
                        <th>&nbsp;</th>
                        @else
                        <th>&nbsp;</th>
                        @endif
        </tr>
    </thead>

    <tbody>
        @if (count($campaigns) > 0)
            @foreach ($campaigns as $campaign)
                <tr data-entry-id="{{ $campaign->id }}">
                    <td field-key='name'>{{ $campaign->name }}</td>
                                <td field-key='daily_budget'>{{ $campaign->daily_budget }}</td>
                                <td field-key='title'>{{ $campaign->title }}</td>
                                <td field-key='undertitle'>{{ $campaign->undertitle }}</td>
                                <td field-key='active'>{{ Form::checkbox("active", 1, $campaign->active == 1 ? true : false, ["disabled"]) }}</td>
                                @if( request('show_deleted') == 1 )
                                <td>
                                    {!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'POST',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['admin.campaigns.restore', $campaign->id])) !!}
                                    {!! Form::submit(trans('global.app_restore'), array('class' => 'btn btn-xs btn-success')) !!}
                                    {!! Form::close() !!}
                                                                    {!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['admin.campaigns.perma_del', $campaign->id])) !!}
                                    {!! Form::submit(trans('global.app_permadel'), array('class' => 'btn btn-xs btn-danger')) !!}
                                    {!! Form::close() !!}
                                                                </td>
                                @else
                                <td>
                                    @can('campaign_view')
                                    <a href="{{ route('admin.campaigns.show',[$campaign->id]) }}" class="btn btn-xs btn-primary">@lang('global.app_view')</a>
                                    @endcan
                                    @can('campaign_edit')
                                    <a href="{{ route('admin.campaigns.edit',[$campaign->id]) }}" class="btn btn-xs btn-info">@lang('global.app_edit')</a>
                                    @endcan
                                    @can('campaign_delete')
{!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['admin.campaigns.destroy', $campaign->id])) !!}
                                    {!! Form::submit(trans('global.app_delete'), array('class' => 'btn btn-xs btn-danger')) !!}
                                    {!! Form::close() !!}
                                    @endcan
                                </td>
                                @endif
                </tr>
            @endforeach
        @else
            <tr>
                <td colspan="17">@lang('global.app_no_entries_in_table')</td>
            </tr>
        @endif
    </tbody>
</table>
</div>
<div role="tabpanel" class="tab-pane " id="requests">
<table class="table table-bordered table-striped {{ count($requests) > 0 ? 'datatable' : '' }}">
    <thead>
        <tr>
            <th>@lang('global.requests.fields.landingpage')</th>
                        <th>@lang('global.requests.fields.target')</th>
                        <th>@lang('global.requests.fields.city')</th>
                        <th>@lang('global.requests.fields.not-clear')</th>
                        <th>@lang('global.requests.fields.no-phonenumber')</th>
                        <th>@lang('global.requests.fields.no-email')</th>
                        <th>@lang('global.requests.fields.no-form')</th>
                        <th>@lang('global.requests.fields.no-content')</th>
                        <th>@lang('global.requests.fields.no-faq')</th>
                        <th>@lang('global.requests.fields.adgroup')</th>
                        <th>@lang('global.requests.fields.other-keywords')</th>
                        <th>@lang('global.requests.fields.aswered')</th>
                        <th>@lang('global.requests.fields.created-by')</th>
                        @if( request('show_deleted') == 1 )
                        <th>&nbsp;</th>
                        @else
                        <th>&nbsp;</th>
                        @endif
        </tr>
    </thead>

    <tbody>
        @if (count($requests) > 0)
            @foreach ($requests as $request)
                <tr data-entry-id="{{ $request->id }}">
                    <td field-key='landingpage'>{{ $request->landingpage }}</td>
                                <td field-key='target'>{{ $request->target }}</td>
                                <td field-key='city'>{{ $request->city }}</td>
                                <td field-key='not_clear'>{{ $request->not_clear }}</td>
                                <td field-key='no_phonenumber'>{{ Form::checkbox("no_phonenumber", 1, $request->no_phonenumber == 1 ? true : false, ["disabled"]) }}</td>
                                <td field-key='no_email'>{{ Form::checkbox("no_email", 1, $request->no_email == 1 ? true : false, ["disabled"]) }}</td>
                                <td field-key='no_form'>{{ Form::checkbox("no_form", 1, $request->no_form == 1 ? true : false, ["disabled"]) }}</td>
                                <td field-key='no_content'>{{ Form::checkbox("no_content", 1, $request->no_content == 1 ? true : false, ["disabled"]) }}</td>
                                <td field-key='no_faq'>{{ Form::checkbox("no_faq", 1, $request->no_faq == 1 ? true : false, ["disabled"]) }}</td>
                                <td field-key='adgroup'>{{ $request->adgroup->title ?? '' }}</td>
                                <td field-key='other_keywords'>{{ $request->other_keywords }}</td>
                                <td field-key='aswered'>{{ $request->aswered }}</td>
                                <td field-key='created_by'>{{ $request->created_by->name ?? '' }}</td>
                                @if( request('show_deleted') == 1 )
                                <td>
                                    {!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'POST',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['admin.requests.restore', $request->id])) !!}
                                    {!! Form::submit(trans('global.app_restore'), array('class' => 'btn btn-xs btn-success')) !!}
                                    {!! Form::close() !!}
                                                                    {!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['admin.requests.perma_del', $request->id])) !!}
                                    {!! Form::submit(trans('global.app_permadel'), array('class' => 'btn btn-xs btn-danger')) !!}
                                    {!! Form::close() !!}
                                                                </td>
                                @else
                                <td>
                                    @can('request_view')
                                    <a href="{{ route('admin.requests.show',[$request->id]) }}" class="btn btn-xs btn-primary">@lang('global.app_view')</a>
                                    @endcan
                                    @can('request_edit')
                                    <a href="{{ route('admin.requests.edit',[$request->id]) }}" class="btn btn-xs btn-info">@lang('global.app_edit')</a>
                                    @endcan
                                    @can('request_delete')
{!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['admin.requests.destroy', $request->id])) !!}
                                    {!! Form::submit(trans('global.app_delete'), array('class' => 'btn btn-xs btn-danger')) !!}
                                    {!! Form::close() !!}
                                    @endcan
                                </td>
                                @endif
                </tr>
            @endforeach
        @else
            <tr>
                <td colspan="18">@lang('global.app_no_entries_in_table')</td>
            </tr>
        @endif
    </tbody>
</table>
</div>
</div>

            <p>&nbsp;</p>

            <a href="{{ route('admin.users.index') }}" class="btn btn-default">@lang('global.app_back_to_list')</a>
        </div>
    </div>
@stop


