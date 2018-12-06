@inject('request', 'Illuminate\Http\Request')
@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('global.requests.title')</h3>
    @can('request_create')
    <p>
        <a href="{{ route('admin.requests.create') }}" class="btn btn-success">@lang('global.app_add_new')</a>
        
        @if(!is_null(Auth::getUser()->role_id) && config('global.can_see_all_records_role_id') == Auth::getUser()->role_id)
            @if(Session::get('Request.filter', 'all') == 'my')
                <a href="?filter=all" class="btn btn-default">Show all records</a>
            @else
                <a href="?filter=my" class="btn btn-default">Filter my records</a>
            @endif
        @endif
    </p>
    @endcan

    <p>
        <ul class="list-inline">
            <li><a href="{{ route('admin.requests.index') }}" style="{{ request('show_deleted') == 1 ? '' : 'font-weight: 700' }}">@lang('global.app_all')</a></li> |
            <li><a href="{{ route('admin.requests.index') }}?show_deleted=1" style="{{ request('show_deleted') == 1 ? 'font-weight: 700' : '' }}">@lang('global.app_trash')</a></li>
        </ul>
    </p>
    

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('global.app_list')
        </div>

        <div class="panel-body table-responsive">
            <table class="table table-bordered table-striped ajaxTable @can('request_delete') @if ( request('show_deleted') != 1 ) dt-select @endif @endcan">
                <thead>
                    <tr>
                        @can('request_delete')
                            @if ( request('show_deleted') != 1 )<th style="text-align:center;"><input type="checkbox" id="select-all" /></th>@endif
                        @endcan

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
            </table>
        </div>
    </div>
@stop

@section('javascript') 
    <script>
        @can('request_delete')
            @if ( request('show_deleted') != 1 ) window.route_mass_crud_entries_destroy = '{{ route('admin.requests.mass_destroy') }}'; @endif
        @endcan
        $(document).ready(function () {
            window.dtDefaultOptions.ajax = '{!! route('admin.requests.index') !!}?show_deleted={{ request('show_deleted') }}';
            window.dtDefaultOptions.columns = [@can('request_delete')
                @if ( request('show_deleted') != 1 )
                    {data: 'massDelete', name: 'id', searchable: false, sortable: false},
                @endif
                @endcan{data: 'landingpage', name: 'landingpage'},
                {data: 'target', name: 'target'},
                {data: 'city', name: 'city'},
                {data: 'not_clear', name: 'not_clear'},
                {data: 'no_phonenumber', name: 'no_phonenumber'},
                {data: 'no_email', name: 'no_email'},
                {data: 'no_form', name: 'no_form'},
                {data: 'no_content', name: 'no_content'},
                {data: 'no_faq', name: 'no_faq'},
                {data: 'adgroup.title', name: 'adgroup.title'},
                {data: 'other_keywords', name: 'other_keywords'},
                {data: 'aswered', name: 'aswered'},
                {data: 'created_by.name', name: 'created_by.name'},
                
                {data: 'actions', name: 'actions', searchable: false, sortable: false}
            ];
            processAjaxTables();
        });
    </script>
@endsection