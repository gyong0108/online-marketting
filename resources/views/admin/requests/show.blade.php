@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('global.requests.title')</h3>

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('global.app_view')
        </div>

        <div class="panel-body table-responsive">
            <div class="row">
                <div class="col-md-6">
                    <table class="table table-bordered table-striped">
                        <tr>
                            <th>@lang('global.requests.fields.landingpage')</th>
                            <td field-key='landingpage'>{{ $request->landingpage }}</td>
                        </tr>
                        <tr>
                            <th>@lang('global.requests.fields.target')</th>
                            <td field-key='target'>{{ $request->target }}</td>
                        </tr>
                        <tr>
                            <th>@lang('global.requests.fields.city')</th>
                            <td field-key='city'>{{ $request->city }}</td>
                        </tr>
                        <tr>
                            <th>@lang('global.requests.fields.not-clear')</th>
                            <td field-key='not_clear'>{{ $request->not_clear }}</td>
                        </tr>
                        <tr>
                            <th>@lang('global.requests.fields.no-phonenumber')</th>
                            <td field-key='no_phonenumber'>{{ Form::checkbox("no_phonenumber", 1, $request->no_phonenumber == 1 ? true : false, ["disabled"]) }}</td>
                        </tr>
                        <tr>
                            <th>@lang('global.requests.fields.no-email')</th>
                            <td field-key='no_email'>{{ Form::checkbox("no_email", 1, $request->no_email == 1 ? true : false, ["disabled"]) }}</td>
                        </tr>
                        <tr>
                            <th>@lang('global.requests.fields.no-form')</th>
                            <td field-key='no_form'>{{ Form::checkbox("no_form", 1, $request->no_form == 1 ? true : false, ["disabled"]) }}</td>
                        </tr>
                        <tr>
                            <th>@lang('global.requests.fields.no-content')</th>
                            <td field-key='no_content'>{{ Form::checkbox("no_content", 1, $request->no_content == 1 ? true : false, ["disabled"]) }}</td>
                        </tr>
                        <tr>
                            <th>@lang('global.requests.fields.no-faq')</th>
                            <td field-key='no_faq'>{{ Form::checkbox("no_faq", 1, $request->no_faq == 1 ? true : false, ["disabled"]) }}</td>
                        </tr>
                        <tr>
                            <th>@lang('global.requests.fields.adgroup')</th>
                            <td field-key='adgroup'>{{ $request->adgroup->title ?? '' }}</td>
                        </tr>
                        <tr>
                            <th>@lang('global.requests.fields.other-keywords')</th>
                            <td field-key='other_keywords'>{{ $request->other_keywords }}</td>
                        </tr>
                        <tr>
                            <th>@lang('global.requests.fields.aswered')</th>
                            <td field-key='aswered'>{{ $request->aswered }}</td>
                        </tr>
                        <tr>
                            <th>@lang('global.requests.fields.created-by')</th>
                            <td field-key='created_by'>{{ $request->created_by->name ?? '' }}</td>
                        </tr>
                    </table>
                </div>
            </div>

            <p>&nbsp;</p>

            <a href="{{ route('admin.requests.index') }}" class="btn btn-default">@lang('global.app_back_to_list')</a>
        </div>
    </div>
@stop

@section('javascript')
    @parent

    <script src="{{ url('adminlte/plugins/datetimepicker/moment-with-locales.min.js') }}"></script>
    <script src="{{ url('adminlte/plugins/datetimepicker/bootstrap-datetimepicker.min.js') }}"></script>
    <script>
        $(function(){
            moment.updateLocale('{{ App::getLocale() }}', {
                week: { dow: 1 } // Monday is the first day of the week
            });
            
            $('.datetime').datetimepicker({
                format: "{{ config('app.datetime_format_moment') }}",
                locale: "{{ App::getLocale() }}",
                sideBySide: true,
            });
            
        });
    </script>
            
@stop
