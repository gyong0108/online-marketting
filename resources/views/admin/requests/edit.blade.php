@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('global.requests.title')</h3>
    
    {!! Form::model($request, ['method' => 'PUT', 'route' => ['admin.requests.update', $request->id]]) !!}

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('global.app_edit')
        </div>

        <div class="panel-body">
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('landingpage', trans('global.requests.fields.landingpage').'*', ['class' => 'control-label']) !!}
                    {!! Form::text('landingpage', old('landingpage'), ['class' => 'form-control', 'placeholder' => '', 'required' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('landingpage'))
                        <p class="help-block">
                            {{ $errors->first('landingpage') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('target', trans('global.requests.fields.target').'*', ['class' => 'control-label']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('target'))
                        <p class="help-block">
                            {{ $errors->first('target') }}
                        </p>
                    @endif
                    <div>
                        <label>
                            {!! Form::radio('target', 'contacts', false, ['required' => '']) !!}
                            get contacts
                        </label>
                    </div>
                    <div>
                        <label>
                            {!! Form::radio('target', 'infos', false, ['required' => '']) !!}
                            present informations
                        </label>
                    </div>
                    <div>
                        <label>
                            {!! Form::radio('target', 'views', false, ['required' => '']) !!}
                            video views
                        </label>
                    </div>
                    <div>
                        <label>
                            {!! Form::radio('target', 'clicks', false, ['required' => '']) !!}
                            external clicks
                        </label>
                    </div>
                    <div>
                        <label>
                            {!! Form::radio('target', 'subscriber', false, ['required' => '']) !!}
                            newsletter subscriber
                        </label>
                    </div>
                    
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('city', trans('global.requests.fields.city').'', ['class' => 'control-label']) !!}
                    {!! Form::text('city', old('city'), ['class' => 'form-control', 'placeholder' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('city'))
                        <p class="help-block">
                            {{ $errors->first('city') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('not_clear', trans('global.requests.fields.not-clear').'', ['class' => 'control-label']) !!}
                    {!! Form::text('not_clear', old('not_clear'), ['class' => 'form-control', 'placeholder' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('not_clear'))
                        <p class="help-block">
                            {{ $errors->first('not_clear') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('no_phonenumber', trans('global.requests.fields.no-phonenumber').'', ['class' => 'control-label']) !!}
                    {!! Form::hidden('no_phonenumber', 0) !!}
                    {!! Form::checkbox('no_phonenumber', 1, old('no_phonenumber', old('no_phonenumber')), []) !!}
                    <p class="help-block"></p>
                    @if($errors->has('no_phonenumber'))
                        <p class="help-block">
                            {{ $errors->first('no_phonenumber') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('no_email', trans('global.requests.fields.no-email').'', ['class' => 'control-label']) !!}
                    {!! Form::hidden('no_email', 0) !!}
                    {!! Form::checkbox('no_email', 1, old('no_email', old('no_email')), []) !!}
                    <p class="help-block"></p>
                    @if($errors->has('no_email'))
                        <p class="help-block">
                            {{ $errors->first('no_email') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('no_form', trans('global.requests.fields.no-form').'', ['class' => 'control-label']) !!}
                    {!! Form::hidden('no_form', 0) !!}
                    {!! Form::checkbox('no_form', 1, old('no_form', old('no_form')), []) !!}
                    <p class="help-block"></p>
                    @if($errors->has('no_form'))
                        <p class="help-block">
                            {{ $errors->first('no_form') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('no_content', trans('global.requests.fields.no-content').'', ['class' => 'control-label']) !!}
                    {!! Form::hidden('no_content', 0) !!}
                    {!! Form::checkbox('no_content', 1, old('no_content', old('no_content')), []) !!}
                    <p class="help-block"></p>
                    @if($errors->has('no_content'))
                        <p class="help-block">
                            {{ $errors->first('no_content') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('no_faq', trans('global.requests.fields.no-faq').'', ['class' => 'control-label']) !!}
                    {!! Form::hidden('no_faq', 0) !!}
                    {!! Form::checkbox('no_faq', 1, old('no_faq', old('no_faq')), []) !!}
                    <p class="help-block"></p>
                    @if($errors->has('no_faq'))
                        <p class="help-block">
                            {{ $errors->first('no_faq') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('adgroup_id', trans('global.requests.fields.adgroup').'', ['class' => 'control-label']) !!}
                    {!! Form::select('adgroup_id', $adgroups, old('adgroup_id'), ['class' => 'form-control select2']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('adgroup_id'))
                        <p class="help-block">
                            {{ $errors->first('adgroup_id') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('other_keywords', trans('global.requests.fields.other-keywords').'', ['class' => 'control-label']) !!}
                    {!! Form::text('other_keywords', old('other_keywords'), ['class' => 'form-control', 'placeholder' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('other_keywords'))
                        <p class="help-block">
                            {{ $errors->first('other_keywords') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('aswered', trans('global.requests.fields.aswered').'', ['class' => 'control-label']) !!}
                    {!! Form::text('aswered', old('aswered'), ['class' => 'form-control datetime', 'placeholder' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('aswered'))
                        <p class="help-block">
                            {{ $errors->first('aswered') }}
                        </p>
                    @endif
                </div>
            </div>
            
        </div>
    </div>

    {!! Form::submit(trans('global.app_update'), ['class' => 'btn btn-danger']) !!}
    {!! Form::close() !!}
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