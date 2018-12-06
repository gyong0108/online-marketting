@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('global.campaigns.title')</h3>

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('global.app_view')
        </div>

        <div class="panel-body table-responsive">
            <div class="row">
                <div class="col-md-6">
                    <table class="table table-bordered table-striped">
                        <tr>
                            <th>@lang('global.campaigns.fields.name')</th>
                            <td field-key='name'>{{ $campaign->name }}</td>
                        </tr>
                        <tr>
                            <th>@lang('global.campaigns.fields.keywords')</th>
                            <td field-key='keywords'>{!! $campaign->keywords !!}</td>
                        </tr>
                        <tr>
                            <th>@lang('global.campaigns.fields.daily-budget')</th>
                            <td field-key='daily_budget'>{{ $campaign->daily_budget }}</td>
                        </tr>
                        <tr>
                            <th>@lang('global.campaigns.fields.title')</th>
                            <td field-key='title'>{{ $campaign->title }}</td>
                        </tr>
                        <tr>
                            <th>@lang('global.campaigns.fields.undertitle')</th>
                            <td field-key='undertitle'>{{ $campaign->undertitle }}</td>
                        </tr>
                        <tr>
                            <th>@lang('global.campaigns.fields.shortdescription')</th>
                            <td field-key='shortdescription'>{{ $campaign->shortdescription }}</td>
                        </tr>
                        <tr>
                            <th>@lang('global.campaigns.fields.description')</th>
                            <td field-key='description'>{{ $campaign->description }}</td>
                        </tr>
                        <tr>
                            <th>@lang('global.campaigns.fields.logo')</th>
                            <td field-key='logo'>@if($campaign->logo)<a href="{{ asset(env('UPLOAD_PATH').'/' . $campaign->logo) }}" target="_blank"><img src="{{ asset(env('UPLOAD_PATH').'/thumb/' . $campaign->logo) }}"/></a>@endif</td>
                        </tr>
                        <tr>
                            <th>@lang('global.campaigns.fields.image')</th>
                            <td field-key='image'>@if($campaign->image)<a href="{{ asset(env('UPLOAD_PATH').'/' . $campaign->image) }}" target="_blank"><img src="{{ asset(env('UPLOAD_PATH').'/thumb/' . $campaign->image) }}"/></a>@endif</td>
                        </tr>
                        <tr>
                            <th>@lang('global.campaigns.fields.email')</th>
                            <td field-key='email'>{{ $campaign->email }}</td>
                        </tr>
                        <tr>
                            <th>@lang('global.campaigns.fields.active')</th>
                            <td field-key='active'>{{ Form::checkbox("active", 1, $campaign->active == 1 ? true : false, ["disabled"]) }}</td>
                        </tr>
                    </table>
                </div>
            </div><!-- Nav tabs -->
<ul class="nav nav-tabs" role="tablist">
    
<li role="presentation" class="active"><a href="#requests" aria-controls="requests" role="tab" data-toggle="tab">Requests</a></li>
</ul>

<!-- Tab panes -->
<div class="tab-content">
    
<div role="tabpanel" class="tab-pane active" id="requests">
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

            <a href="{{ route('admin.campaigns.index') }}" class="btn btn-default">@lang('global.app_back_to_list')</a>
        </div>
    </div>
@stop


