@extends('layouts.app')
@section('content')
<div class="row">
   <div class="float-right">
      <a href="#"  class="btn btn-success btn-xs" data-toggle="modal" data-target="#settingsModal">
      <i class="fa  	fa fa-cogs "  style="font-size:24px;"></i>
      </a>
      <a href="#logout"  class="btn btn-success btn-xs" onclick="$('#logout').submit();">
            <i class="fa fa-sign-out" style="font-size:24px;"></i>
            <span class="title"></span>
        </a>
   </div>
</div>
<div class="modal fade" id="settingsModal" tabindex="-1" role="dialog" aria-labelledby="basicModal" aria-hidden="true">
   <div class="modal-dialog">
      <div class="modal-content">
         <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <h4 class="modal-title">@lang('global.settings')</h4>
         </div>
         <div class="modal-body">
            <div>
               <!-- Nav tabs -->
               <ul class="nav nav-tabs" role="tablist">
                  <li role="presentation" class="active"><a href="#home" aria-controls="home" role="tab" data-toggle="tab">Profile Settings</a></li>
                  <li role="presentation"><a href="#profile" aria-controls="profile" role="tab" data-toggle="tab">Change Password</a></li>
                  {{--
                  <li role="presentation"><a href="#messages" aria-controls="messages" role="tab" data-toggle="tab">Messages</a></li>
                  --}}
                  {{--
                  <li role="presentation"><a href="#settings" aria-controls="settings" role="tab" data-toggle="tab">Settings</a></li>
                  --}}
               </ul>
               <!-- Tab panes -->
               <div class="tab-content">
                  <div role="tabpanel" class="tab-pane fade in active" id="home">
                     {!! Form::model(Auth::user(), ['method' => 'POST', 'route' => ['admin.users.updateprofile']]) !!}
                     <div class="form-group">
                        <div class="row">
                           <div class="col-xs-12 form-group">
                              {!! Form::label('name', trans('global.users.fields.name').'*', ['class' => 'control-label']) !!}
                              {!! Form::text('name', old('name'), ['class' => 'form-control', 'placeholder' => '', 'required' => '']) !!}
                              <p class="help-block"></p>
                              @if($errors->has('name'))
                              <p class="help-block">
                                 {{ $errors->first('name') }}
                              </p>
                              @endif
                           </div>
                        </div>
                        <div class="row">
                           <div class="col-xs-12 form-group">
                              {!! Form::label('phone', 'Phone', ['class' => 'control-label']) !!}
                              {!! Form::text('phone', old('phone'), ['class' => 'form-control', 'placeholder' => '', 'required' => '']) !!}
                              <p class="help-block"></p>
                              @if($errors->has('name'))
                              <p class="help-block">
                                 {{ $errors->first('phone') }}
                              </p>
                              @endif
                           </div>
                        </div>
                     </div>
                     {!! Form::submit(trans('global.app_update'), ['class' => 'btn btn-danger']) !!}
                     {!! Form::close() !!}
                  </div>
                  <div role="tabpanel" class="tab-pane fade" id="profile">
                     {!! Form::open(['method' => 'PATCH', 'route' => ['auth.change_password']]) !!}
                     <!-- If no success message in flash session show change password form  -->
                     <div class="panel panel-default">
                        <div class="panel-heading">
                           @lang('global.app_edit')
                        </div>
                        <div class="panel-body">
                           <div class="row">
                              <div class="col-xs-12 form-group">
                                 {!! Form::label('current_password', trans('global.app_current_password'), ['class' => 'control-label']) !!}
                                 {!! Form::password('current_password', ['class' => 'form-control', 'placeholder' => '']) !!}
                                 <p class="help-block"></p>
                                 @if($errors->has('current_password'))
                                 <p class="help-block">
                                    {{ $errors->first('current_password') }}
                                 </p>
                                 @endif
                              </div>
                           </div>
                           <div class="row">
                              <div class="col-xs-12 form-group">
                                 {!! Form::label('new_password', trans('global.app_new_password'), ['class' => 'control-label']) !!}
                                 {!! Form::password('new_password', ['class' => 'form-control', 'placeholder' => '']) !!}
                                 <p class="help-block"></p>
                                 @if($errors->has('new_password'))
                                 <p class="help-block">
                                    {{ $errors->first('new_password') }}
                                 </p>
                                 @endif
                              </div>
                           </div>
                           <div class="row">
                              <div class="col-xs-12 form-group">
                                 {!! Form::label('new_password_confirmation', trans('global.app_password_confirm'), ['class' => 'control-label']) !!}
                                 {!! Form::password('new_password_confirmation', ['class' => 'form-control', 'placeholder' => '']) !!}
                                 <p class="help-block"></p>
                                 @if($errors->has('new_password_confirmation'))
                                 <p class="help-block">
                                    {{ $errors->first('new_password_confirmation') }}
                                 </p>
                                 @endif
                              </div>
                           </div>
                        </div>
                     </div>
                     {!! Form::submit(trans('global.app_save'), ['class' => 'btn btn-danger']) !!}
                     {!! Form::close() !!}
                  </div>
                  {{--
                  <div role="tabpanel" class="tab-pane fade" id="messages">...</div>
                  --}}
                  {{--
                  <div role="tabpanel" class="tab-pane fade" id="settings">...</div>
                  --}}
               </div>
            </div>
            {{--
            <div class="panel-heading">
               @lang('global.app_edit')
            </div>
            --}}
         </div>
         <div class="modal-footer">
         </div>
      </div>
   </div>
</div>
<div class="row" id ='stats'>
   <div class="col-md-3 col-sm-6 col-xs-12">
      <div class="info-box">
         <span class="info-box-icon bg-yellow"><i class="fa fa-mouse-pointer"></i></span>
         <div class="info-box-content">
            <span class="info-box-text">@lang('global.visits')</span>
            <span class="info-box-number">{{ $totals['visitors'] }}</span>
         </div>
         <!-- /.info-box-content -->
      </div>
      <!-- /.info-box -->
   </div>
   <!-- /.col -->
   <div class="col-md-3 col-sm-6 col-xs-12">
      <div class="info-box">
         <span class="info-box-icon bg-yellow"><i class="fa fa-phone"></i></span>
         <div class="info-box-content">
            <span class="info-box-text">@lang('global.calls')</span>
            <span class="info-box-number">{{ $totals['calls'] }}</span>
         </div>
         <!-- /.info-box-content -->
      </div>
      <!-- /.info-box -->
   </div>
   <!-- /.col -->
   <!-- fix for small devices only -->
   <div class="clearfix visible-sm-block"></div>
   <div class="col-md-3 col-sm-6 col-xs-12">
      <div class="info-box">
         <span class="info-box-icon bg-yellow"><i class="fa fa-inbox"></i></span>
         <div class="info-box-content">
            <span class="info-box-text">@lang('global.leads2')</span>
            <span class="info-box-number">{{ $totals['leads'] }}</span>
         </div>
         <!-- /.info-box-content -->
      </div>
      <!-- /.info-box -->
   </div>
   <!-- /.col -->
   <div class="col-md-3 col-sm-6 col-xs-12">
      <div class="info-box">
         <span class="info-box-icon bg-yellow"><i class="fa fa-envelope-o"></i></span>
         <div class="info-box-content">
            <span class="info-box-text">@lang('global.subscribers')</span>
            <span class="info-box-number">{{ $totals['subscribers'] }}</span>
         </div>
         <!-- /.info-box-content -->
      </div>
      <!-- /.info-box -->
   </div>
   <!-- /.col -->
</div>
<div class="row">
<div class="col-md-12">
   <div class="panel panel-default">
      <div class="panel-heading">@lang('global.stats')</div>
      <div class="form-group">
         <div class="portlet light portlet-fit ">
            <div class="portlet-title">
               <div class="caption">
                  <i class=" icon-layers font-green"></i>
                  <span class="caption-subject font-green bold uppercase">@lang('global.chartvisitors')</span>
               </div>
               <div class="actions">
                  <div class="form-group" style="float:right;">
                     <div class="input-group">
                        <button type="button" class="btn btn-default pull-right" id="daterange-btn">
                        <span>
                        <i class="fa fa-calendar"></i> Date range picker
                        </span>
                        <i class="fa fa-caret-down"></i>
                        </button>
                     </div>
                  </div>
               </div>
            </div>
            <div class="portlet-body">
               <style>
                  .chart {
                  height: auto !important;
                  }
               </style>
               <div class="box-body" id="chart_parent">
                  <div class="chart">
                     <canvas id="lineChart" style="height:250px"></canvas>
                  </div>
               </div>
            </div>
            <!-- /.box-body -->
         </div>
         <!--
            <div class="portlet light portlet-fit ">
              <div class="portlet-title">
                  <div class="caption">
                      <i class=" icon-layers font-green"></i>
                      <span class="caption-subject font-green bold uppercase">Sales/Leads</span>
                  </div>
                  <div class="actions">
                      <div class="form-group " style="float:right">
                          <div class="input-group">
                              <button type="button" class="btn btn-default pull-right" id="daterange-bar-btn">
                                  <span>
                                    <i class="fa fa-calendar"></i> Date range picker
                                  </span>
                                  <i class="fa fa-caret-down"></i>
                              </button>
                          </div>
                      </div>
                  </div>
              </div>
              <div class="portlet-body" id="bar_chart_parent">

                  <div class="chart">
                      <canvas id="barChart" style="height:230px"></canvas>
                  </div>
              </div>

            </div>
            -->
      </div>
   </div>
</div>
<div class="modal fade bs-example-modal-lg" id="payments_modal" tabindex="-1" role="dialog" aria-labelledby="payments_modal" aria-hidden="true">
   <div class="modal-dialog  modal-lg">
      <div class="modal-content">
         <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <h4 class="modal-title" id="myModalLabel">Payments</h4>
            <div class="panel-heading">
                    <a  data-toggle="modal" data-target="#sModal"  class="btn btn-success btn-xs">@lang('global.subscription')</a>
                    <a  data-toggle="modal" data-target="#pModal"  class="btn btn-warning btn-xs">@lang('global.prepaiment')</a>
                 </div>

         </div>
         <div class="modal-body">
                <ul class="nav nav-tabs" role="tablist">
                        <li role="presentation" class="active"><a href="#paymenttable" aria-controls="paymenttable" role="tab" data-toggle="tab">Payments</a></li>
                        {{-- <li role="presentation"><a href="#prepaiments" aria-controls="prepaiments" role="tab" data-toggle="tab">Prepaiments</a></li> --}}
                        <li role="presentation"><a href="#invoices" aria-controls="invoices" role="tab" data-toggle="tab">Invoices</a></li>
                        {{--
                        <li role="presentation"><a href="#messages" aria-controls="messages" role="tab" data-toggle="tab">Messages</a></li>
                        --}}
                        {{--
                        <li role="presentation"><a href="#settings" aria-controls="settings" role="tab" data-toggle="tab">Settings</a></li>
                        --}}
                     </ul>
                     <!-- Tab panes -->
                     <div class="tab-content">
                        <div role="tabpanel" class="tab-pane fade in active" id="paymenttable">
                                <table class="table table-bordered table-striped {{ count($payments) > 0 ? 'datatable' : '' }} ">
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

                        <div role="tabpanel" class="tab-pane fade in" id='invoices'>
                                <table class="table table-bordered table-striped {{ count($payments) > 0 ? 'datatable' : '' }} ">
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
                    </div>
         </div>

         </div>

      </div>
   </div>
</div>
<div class="modal fade bs-example-modal-lg" id="prepaiment_modal" tabindex="-1" role="dialog" aria-labelledby="prepaiment_modal" aria-hidden="true">
    <div class="modal-dialog  modal-lg">
       <div class="modal-content">
          <div class="modal-header">
             <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
             <h4 class="modal-title" id="myModalLabel">prepaiment_modal</h4>


          </div>
          <div class="modal-body">

          </div>

       </div>
    </div>
 </div>
<div class="modal fade  bs-example-modal-lg" id="createcampaignmodal" tabindex="-1" role="dialog" aria-labelledby="createcampaignmodal" aria-hidden="true">
    <div class="modal-dialog  modal-lg">
       <div class="modal-content">
          <div class="modal-header">
             <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
             <h4 class="modal-title" id="myModalLabel">Campaigns</h4>
          </div>
          <div class="modal-body">
            {!! Form::open(['method' => 'POST', 'route' => ['admin.campaigns.store'], 'files' => true,]) !!}

            <div class="panel panel-default">
                <div class="panel-heading">
                    @lang('global.app_create')
                </div>

                <div class="panel-body">

                        <div class="col-xs-12 form-group">
                            {!! Form::label('name', trans('global.campaigns.fields.name').'*', ['class' => 'control-label']) !!}
                            {!! Form::text('name', old('name'), ['class' => 'form-control', 'placeholder' => '', 'required' => '']) !!}
                            <p class="help-block"></p>
                            @if($errors->has('name'))
                                <p class="help-block">
                                    {{ $errors->first('name') }}
                                </p>
                            @endif
                        </div>

                        <div class="col-xs-12 form-group">
                            {!! Form::label('keywords', trans('global.campaigns.fields.keywords').'', ['class' => 'control-label']) !!}
                            {!! Form::textarea('keywords', old('keywords'), ['class' => 'form-control ', 'placeholder' => '']) !!}
                            <p class="help-block"></p>
                            @if($errors->has('keywords'))
                                <p class="help-block">
                                    {{ $errors->first('keywords') }}
                                </p>
                            @endif
                        </div>

                        <div class="col-xs-12 form-group">
                            {!! Form::label('daily_budget', trans('global.campaigns.fields.daily-budget').'*', ['class' => 'control-label']) !!}
                            {!! Form::number('daily_budget', old('daily_budget'), ['class' => 'form-control', 'placeholder' => '', 'required' => '']) !!}
                            <p class="help-block"></p>
                            @if($errors->has('daily_budget'))
                                <p class="help-block">
                                    {{ $errors->first('daily_budget') }}
                                </p>
                            @endif
                        </div>

                        <div class="col-xs-12 form-group">
                            {!! Form::label('title', trans('global.campaigns.fields.title').'*', ['class' => 'control-label']) !!}
                            {!! Form::text('title', old('title'), ['class' => 'form-control', 'placeholder' => '', 'required' => '']) !!}
                            <p class="help-block"></p>
                            @if($errors->has('title'))
                                <p class="help-block">
                                    {{ $errors->first('title') }}
                                </p>
                            @endif
                        </div>

                        <div class="col-xs-12 form-group">
                            {!! Form::label('undertitle', trans('global.campaigns.fields.undertitle').'*', ['class' => 'control-label']) !!}
                            {!! Form::text('undertitle', old('undertitle'), ['class' => 'form-control', 'placeholder' => '', 'required' => '']) !!}
                            <p class="help-block"></p>
                            @if($errors->has('undertitle'))
                                <p class="help-block">
                                    {{ $errors->first('undertitle') }}
                                </p>
                            @endif
                        </div>

                        <div class="col-xs-12 form-group">
                            {!! Form::label('shortdescription', trans('global.campaigns.fields.shortdescription').'*', ['class' => 'control-label']) !!}
                            {!! Form::text('shortdescription', old('shortdescription'), ['class' => 'form-control', 'placeholder' => '', 'required' => '']) !!}
                            <p class="help-block"></p>
                            @if($errors->has('shortdescription'))
                                <p class="help-block">
                                    {{ $errors->first('shortdescription') }}
                                </p>
                            @endif
                        </div>

                        <div class="col-xs-12 form-group">
                            {!! Form::label('description', trans('global.campaigns.fields.description').'*', ['class' => 'control-label']) !!}
                            {!! Form::text('description', old('description'), ['class' => 'form-control', 'placeholder' => '', 'required' => '']) !!}
                            <p class="help-block"></p>
                            @if($errors->has('description'))
                                <p class="help-block">
                                    {{ $errors->first('description') }}
                                </p>
                            @endif
                        </div>

                        <div class="col-xs-12 form-group">
                            {!! Form::label('logo', trans('global.campaigns.fields.logo').'', ['class' => 'control-label']) !!}
                            {!! Form::file('logo', ['class' => 'form-control', 'style' => 'margin-top: 4px;']) !!}
                            {!! Form::hidden('logo_max_size', 2) !!}
                            {!! Form::hidden('logo_max_width', 4096) !!}
                            {!! Form::hidden('logo_max_height', 4096) !!}
                            <p class="help-block"></p>
                            @if($errors->has('logo'))
                                <p class="help-block">
                                    {{ $errors->first('logo') }}
                                </p>
                            @endif
                        </div>

                        <div class="col-xs-12 form-group">
                            {!! Form::label('image', trans('global.campaigns.fields.image').'', ['class' => 'control-label']) !!}
                            {!! Form::file('image', ['class' => 'form-control', 'style' => 'margin-top: 4px;']) !!}
                            {!! Form::hidden('image_max_size', 2) !!}
                            {!! Form::hidden('image_max_width', 4096) !!}
                            {!! Form::hidden('image_max_height', 4096) !!}
                            <p class="help-block"></p>
                            @if($errors->has('image'))
                                <p class="help-block">
                                    {{ $errors->first('image') }}
                                </p>
                            @endif
                        </div>

                        <div class="col-xs-12 form-group">
                            {!! Form::label('email', trans('global.campaigns.fields.email').'', ['class' => 'control-label']) !!}
                            {!! Form::email('email', old('email'), ['class' => 'form-control', 'placeholder' => '']) !!}
                            <p class="help-block"></p>
                            @if($errors->has('email'))
                                <p class="help-block">
                                    {{ $errors->first('email') }}
                                </p>
                            @endif
                        </div>

                        <div class="col-xs-12 form-group">
                            {!! Form::label('active', trans('global.campaigns.fields.active').'', ['class' => 'control-label']) !!}
                            {!! Form::hidden('active', 0) !!}
                            {!! Form::checkbox('active', 1, old('active', true), []) !!}
                            <p class="help-block"></p>
                            @if($errors->has('active'))
                                <p class="help-block">
                                    {{ $errors->first('active') }}
                                </p>
                            @endif
                        </div>


                </div>
            </div>

            {!! Form::submit(trans('global.app_save'), ['class' => 'btn btn-danger']) !!}
            {!! Form::close() !!}
          </div>

       </div>
    </div>
 </div>
<div class="modal fade" id="add_agend_modal" tabindex="-1" role="dialog" aria-labelledby="add_agend_modal" aria-hidden="true">
   <div class="modal-dialog">
      <div class="modal-content">
         <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <h4 class="modal-title" id="myModalLabel">Basic Modal</h4>
         </div>
         <div class="modal-body">
            <h3>Modal Body</h3>
         </div>
         <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            <button type="button" class="btn btn-primary">Save changes</button>
         </div>
      </div>
   </div>
</div>
<div id="sModal" class="modal fade" role="dialog">
        <div class="modal-dialog">
           <!-- Modal content-->
           <div class="modal-content">
              <div class="modal-header">
                 <button type="button" class="close" data-dismiss="modal">&times;</button>
                 <h4 class="modal-title">@lang('global.app_terms')</h4>
              </div>
              <div class="modal-body">
                 <form method="POST" action="{{ url('admin/subscription') }}">
                    {{csrf_field()}}
                    <div class="form-group">
                       <label class="">
                       <label class="">
                          <div class="iradio_flat-green" aria-checked="false" aria-disabled="false" style="position: relative;"><input type="radio" {{ Auth::user()->plan === 'Free' || Auth::user()->plan === 'None'? 'checked' : ''}} value="Free" name="radio" class="flat-red" style="position: absolute; opacity: 0;"><ins class="iCheck-helper" style="position: absolute; top: 0%; left: 0%; display: block; width: 100%; height: 100%; margin: 0px; padding: 0px; background: rgb(255, 255, 255); border: 0px; opacity: 0;"></ins></div>
                          @lang('global.free')
                       </label>
                       <label class="">
                          <div class="iradio_flat-green" aria-checked="false" aria-disabled="false" style="position: relative;"><input type="radio" {{ Auth::user()->plan === 'Executive' ? 'checked' : ''}} value="Executive" name="radio" class="flat-red" style="position: absolute; opacity: 0;"><ins class="iCheck-helper" style="position: absolute; top: 0%; left: 0%; display: block; width: 100%; height: 100%; margin: 0px; padding: 0px; background: rgb(255, 255, 255); border: 0px; opacity: 0;"></ins></div>
                          @lang('global.s1')
                       </label>
                       <label class="">
                          <div class="iradio_flat-green" aria-checked="false" aria-disabled="false" style="position: relative;"><input type="radio" {{ Auth::user()->plan === 'Premier' ? 'checked' : ''}} value="Premier" name="radio" class="flat-red" style="position: absolute; opacity: 0;"><ins class="iCheck-helper" style="position: absolute; top: 0%; left: 0%; display: block; width: 100%; height: 100%; margin: 0px; padding: 0px; background: rgb(255, 255, 255); border: 0px; opacity: 0;"></ins></div>
                          @lang('global.s2')
                       </label>
                       <label class="">
                          <div class="iradio_flat-green" aria-checked="false" aria-disabled="false" style="position: relative;"><input type="radio" {{ Auth::user()->plan === 'Professional' ? 'checked' : ''}} value="Professional" name="radio" class="flat-red" style="position: absolute; opacity: 0;"><ins class="iCheck-helper" style="position: absolute; top: 0%; left: 0%; display: block; width: 100%; height: 100%; margin: 0px; padding: 0px; background: rgb(255, 255, 255); border: 0px; opacity: 0;"></ins></div>
                          @lang('global.s3')
                       </label>
                    </div>
                    <!--
                       <label class="container">@lang('global.free')
                           <input type="radio" {{ Auth::user()->plan === 'Free' || Auth::user()->plan === 'None'? 'checked' : ''}} value="Free" name="radio">
                       </label>
                       <label class="container">@lang('global.s1')
                           <input type="radio" {{ Auth::user()->plan === 'Executive' ? 'checked' : ''}} value="Executive" name="radio">
                       </label>
                       <label class="container">@lang('global.s2')
                           <input type="radio" {{ Auth::user()->plan === 'Premier' ? 'checked' : ''}} value="Premier" name="radio">
                       </label>
                       <label class="container">@lang('global.s3')
                           <input type="radio" {{ Auth::user()->plan === 'Professional' ? 'checked' : ''}} value="Professional" name="radio">
                       </label>
                       -->
                    <div id="dropin-container2"></div>
                    <br>
                    <div class="form-group row mb-0">
                       <div class="col-md-6 offset-md-4">
                       </div>
                    </div>
              </div>
              <div class="modal-footer">
              <button type="submit" class="btn btn-success">
              @lang('global.subscribe')
              </button></form>
              <button type="button" class="btn btn-default" data-dismiss="modal">@lang('global.app_close')</button>
              </div>
           </div>
        </div>
     </div>
     <!-- Modal -->
     <div id="pModal" class="modal fade" role="dialog">
        <div class="modal-dialog">
           <!-- Modal content-->
           <div class="modal-content">
              <div class="modal-header">
                 <button type="button" class="close" data-dismiss="modal">&times;</button>
                 <h4 class="modal-title">@lang('global.prepaiment')</h4>
              </div>
              <div class="modal-body">
                 <form method="POST" action="{{ route('admin.payment.onetime') }}">
                    @csrf
                    <div class="form-group row">
                       <label for="amount"
                          class="col-md-4 col-form-label text-md-right">@lang('global.amount')</label>
                       <div class="col-md-6">
                          <input id="amount" type="text"
                             class="form-control{{ $errors->has('amount') ? ' is-invalid' : '' }}"
                             name="amount" value="{{ old('amount') }}" required>
                          @if ($errors->has('amount'))
                          <span class="invalid-feedback" role="alert">
                          <strong>{{ $errors->first('amount') }}</strong>
                          </span>
                          @endif
                       </div>
                    </div>
                    <div id="dropin-container"></div>
                    <br>
                    <div class="form-group row mb-0">
                       <div class="col-md-6 offset-md-4">
                       </div>
                    </div>
              </div>
              <div class="modal-footer">
              <button type="submit" class="btn btn-success">
              @lang('global.pay_onetime')
              </button></form>
              <button type="button" class="btn btn-default" data-dismiss="modal">@lang('global.app_close')</button>
              </div>
           </div>
        </div>
     </div>
<h3 class="page-title">@lang('global.campaigns.title')</h3>
<div class="panel panel-default">
   <div class="panel-heading">
      @can('campaign_create')
      <a  class="btn btn-success btn-xs" data-toggle="modal" data-target="#createcampaignmodal">@lang('global.app_add_new')</a>
    
      <a href="#"  class="btn btn-success btn-xs" data-toggle="modal" data-target="#add_agend_modal">Add from Agend</a>
      @endcan
        @if(!(Auth::user()->partner_id  && Auth::user()->payment ==  'invoice'))
      <a href="#"  class="btn btn-success btn-xs" data-toggle="modal" data-target="#payments_modal">{{Auth::user()->balance}} €</a>
      @endif
      <ul class="list-inline pull-right">
         <li><a href="{{ route('admin.campaigns.index') }}" style="{{ request('show_deleted') == 1 ? '' : 'font-weight: 700' }}">@lang('global.app_all')</a></li>
         |
         <li><a href="{{ route('admin.campaigns.index') }}?show_deleted=1" style="{{ request('show_deleted') == 1 ? 'font-weight: 700' : '' }}">@lang('global.app_trash')</a></li>
      </ul>
   </div>
   <div class="panel-body table-responsive">
   
      <table class="table table-bordered table-striped ajaxTable @can('campaign_delete') @if ( request('show_deleted') != 1 ) dt-select @endif @endcan">
         <thead>
            <tr>
               @can('campaign_delete')
               @if ( request('show_deleted') != 1 )
               <th style="text-align:center;"><input type="checkbox" id="select-all" /></th>
               @endif
               @endcan
               <th>@lang('global.campaigns.fields.name')</th>
               <th>Budget</th>
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
@endsection
@section('javascript')
<script>
   function loadKeyword(){
     var country_id = $('#country_id').val();
     var keyword = $('#main_keyword').val();
     var all_keywords = Array();
     var html = '';
     var allkeywordHtml =  $('#allkeywords').html()
     if (keyword && country_id){
       $.get('/admin/fetch_keywords?keyword=' + keyword+ '&country='+country_id+'&limit=30', function (data) {
         if (typeof data == 'object'){
           for(key in data){
             all_keywords.push(data[key].keyword);
           }
         }
         if (all_keywords.length <= 0){
           $('#allkeywords').html('');
           alert('No Keyword Found ');
           return false;
         }
         for ( var i = 0; i <all_keywords.length; i++){
           html = ' <label class = "keywordsToSelect" data-keyword="'+all_keywords[i]+'"><input type="checkbox"><span class="">'+all_keywords[i]+'</span></label>';
           $('#allkeywords').html(allkeywordHtml + ' ' + html);
           allkeywordHtml = allkeywordHtml + ' ' + html;
         }
         $('.keywordsToSelect').each(function (index,element){
           $(element).on('click',function(){
             value = ($('#allkeywordstoSave').val() != '') ? ($('#allkeywordstoSave').val() + ',') : ($('#allkeywordstoSave').val());
             $('#allkeywordstoSave').val(value+encodeURI($(element).attr('data-keyword')));
           });
         });
       });
     }
   }


</script>
<script src="/adminlte/plugins/daterangepicker/moment.js"></script>
<script src="/adminlte/plugins/daterangepicker/daterangepicker.js"></script>
<script src="/adminlte/plugins/chartjs/Chart.min.js"></script>
<script type="text/javascript">
   $('#no_model_show').on('click', function () {
      $.get('/admin/set-user-setting?key=show_welcome_model&value=false');
       $('#modal-default').modal('hide');
   });

    $("#prepaimentbutton").click(function(){
        $(".modal").modal('hide');
        $("#prepaiment_modal").modal('show');
    });
    $("#invoicesbutton").click(function(){

    });


   @if(!isset(auth()->user()->settings['show_welcome_model']) || auth()->user()->settings['show_welcome_model'] == 'true')
       $(window).load(function(){
           $('#modal-default').modal('show');
       });
   @endif
</script>
<script>
   $('#daterange-btn').daterangepicker(
       {
         ranges: {
             'Last 7 Days': [moment().subtract(6, 'days'), moment()],
             'Last 30 Days': [moment().subtract(29, 'days'), moment()],
             'This Month': [moment().startOf('month'), moment().endOf('month')],
             'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
         },
         startDate: moment().subtract(29, 'days'),
         endDate: moment()
       },
       function (start, end) {
           $('#daterange-btn span').html(start.format('YYYY-MM-DD') + ' - ' + end.format('YYYY-MM-DD'));
           getDataForChart(start, end);
           getHomeStats(start,end);
       }
   );

   $('#daterange-btn span').html(moment().subtract(29, 'days').format('MMMM D, YYYY') + ' - ' + moment().format('MMMM D, YYYY'))


   $('daterange-campaigns-btn').daterangepicker(
     {
       ranges: {
           'Last 7 Days': [moment().subtract(6, 'days'), moment()],
           'Last 30 Days': [moment().subtract(29, 'days'), moment()],
           'This Month': [moment().startOf('month'), moment().endOf('month')],
           'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
       },
       startDate: moment().subtract(29, 'days'),
       endDate: moment()
     },
     function (start, end) {
         $('daterange-campaigns-btn span').html(start.format('YYYY-MM-DD') + ' - ' + end.format('YYYY-MM-DD'));
         getDataForCampaigns(start, end);
     }
   );

   $('daterange-campaigns-btn span').html(moment().subtract(29, 'days').format('MMMM D, YYYY') + ' - ' + moment().format('MMMM D, YYYY'))


   $('#daterange-bar-btn').daterangepicker(
       {
           ranges: {
               'Last 7 Days': [moment().subtract(6, 'days'), moment()],
               'Last 30 Days': [moment().subtract(29, 'days'), moment()],
               'This Month': [moment().startOf('month'), moment().endOf('month')],
               'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
           },
           startDate: moment().subtract(29, 'days'),
           endDate: moment()
       },
       function (start, end) {
           $('#daterange-bar-btn span').html(start.format('YYYY-MM-DD') + ' - ' + end.format('YYYY-MM-DD'));
           getDataForBarChart(start, end);
       }
   );

   $('#daterange-bar-btn span').html(moment().subtract(29, 'days').format('MMMM D, YYYY') + ' - ' + moment().format('MMMM D, YYYY'))

   $('#daterange-contact-btn').daterangepicker(
       {
           ranges: {
               'Last 7 Days': [moment().subtract(6, 'days'), moment()],
               'Last 30 Days': [moment().subtract(29, 'days'), moment()],
               'This Month': [moment().startOf('month'), moment().endOf('month')],
               'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
           },
           startDate: moment().subtract(29, 'days'),
           endDate: moment()
       },
       function (start, end) {
           $('#daterange-contact-btn span').html(start.format('YYYY-MM-DD') + ' - ' + end.format('YYYY-MM-DD'));
           getDataForContactChart(start, end);
           getDataForChart(start,end);
           getHomeStats(start,end);
       }
   );
   $('#daterange-contact-btn span').html(moment().subtract(29, 'days').format('MMMM D, YYYY') + ' - ' + moment().format('MMMM D, YYYY'))


   function getDataForChart(startDate, endDate) {
       $.get('/admin/home/chartdata?start=' + startDate.format('YYYY-MM-DD') + '&end=' + endDate.format('YYYY-MM-DD'), function (data) {

           var chartData = {
               labels: [],
               datasets: null
           };


           chartData.datasets = [
               {
                   label: '@lang('global.visitors')',
                   fillColor: 'rgba(210, 214, 222, 1)',
                   strokeColor: 'rgba(210, 214, 222, 1)',
                   pointColor: 'rgba(210, 214, 222, 1)',
                   pointStrokeColor: '#c1c7d1',
                   pointHighlightFill: '#fff',
                   pointHighlightStroke: 'rgba(220,220,220,1)',
                   data: []
               },
               {
                   label: '@lang('global.visits')',
                   fillColor: 'rgba(60,141,188,0.9)',
                   strokeColor: 'rgba(60,141,188,0.8)',
                   pointColor: '#3b8bba',
                   pointStrokeColor: 'rgba(60,141,188,1)',
                   pointHighlightFill: '#fff',
                   pointHighlightStroke: 'rgba(60,141,188,1)',
                   data: []
               }
           ];
           //console.log('chartdata');
           ///console.log(data);
           //console.log('endchardata');


           //console.log(data.uri);
           //console.log(data.uuid);

           for (var i = 0; i < data.uuid.length; i++) {
               chartData.labels.push(data.uuid[i].date);
               try {
                   chartData.datasets[0].data.push(data.uuid[i].count);
                   chartData.datasets[1].data.push(data.uri[i].count);
               } catch (e) {
                   console.log(i);
               }

           }


           var chartHtml = ' <div class="chart">\n' +
               '                        <canvas id="lineChart" style="height:250px"></canvas>\n' +
               '                    </div>';
           $('#chart_parent').html(chartHtml);

           var lineChartCanvas = $('#lineChart').get(0).getContext('2d');
           var lineChart = new Chart(lineChartCanvas);
           lineChartOptions = areaChartOptions;
           lineChartOptions.datasetFill = false;
           lineChart = lineChart.Line(chartData, lineChartOptions);

       });
   }


   function getHomeStats(startDate,endDate){
     $.get('/admin/home/stats?start=' + startDate.format('YYYY-MM-DD') + '&end=' + endDate.format('YYYY-MM-DD'), function (data) {
       if (data){
         $('#stats').html(data);
       }
     });
   }


   function getDataForBarChart(startDate, endDate) {
       $.get('/admin/home/barchartdata?start=' + startDate.format('YYYY-MM-DD') + '&end=' + endDate.format('YYYY-MM-DD'), function (data) {

           var chartData = {
               labels: [],
               datasets: null
           };

           chartData.datasets = [
               {
                   label: 'Lead',
                   fillColor: 'rgba(210, 214, 222, 1)',
                   strokeColor: 'rgba(210, 214, 222, 1)',
                   pointColor: 'rgba(210, 214, 222, 1)',
                   pointStrokeColor: '#c1c7d1',
                   pointHighlightFill: '#fff',
                   pointHighlightStroke: 'rgba(220,220,220,1)',
                   data: []
               },
               {
                   label: 'Sale',
                   fillColor: 'rgba(60,141,188,0.9)',
                   strokeColor: 'rgba(60,141,188,0.8)',
                   pointColor: '#3b8bba',
                   pointStrokeColor: 'rgba(60,141,188,1)',
                   pointHighlightFill: '#fff',
                   pointHighlightStroke: 'rgba(60,141,188,1)',
                   data: []
               }
           ];


           for (var i = 0; i < data.sale.length; i++) {
               chartData.labels.push(data.sale[i].date);
               chartData.datasets[0].data.push(data.sale[i].count);
               chartData.datasets[1].data.push(data.lead[i].count);
           }


           function onlyUnique(value, index, self) {
               return self.indexOf(value) === index;
           }


           console.log(chartData);

           var chartHtml = ' <div class="chart">\n' +
               '                        <canvas id="barChart" style="height:250px"></canvas>\n' +
               '                    </div>';
           $('#bar_chart_parent').html(chartHtml);


           //-------------
           //- BAR CHART -
           //-------------
           var barChartCanvas = $('#barChart').get(0).getContext('2d')
           var barChart = new Chart(barChartCanvas)
           var barChartData = chartData;
           barChartData.datasets[1].fillColor = '#00a65a'
           barChartData.datasets[1].strokeColor = '#00a65a'
           barChartData.datasets[1].pointColor = '#00a65a'
           var barChartOptions = {
               //Boolean - Whether the scale should start at zero, or an order of magnitude down from the lowest value
               scaleBeginAtZero: true,
               //Boolean - Whether grid lines are shown across the chart
               scaleShowGridLines: true,
               //String - Colour of the grid lines
               scaleGridLineColor: 'rgba(0,0,0,.05)',
               //Number - Width of the grid lines
               scaleGridLineWidth: 1,
               //Boolean - Whether to show horizontal lines (except X axis)
               scaleShowHorizontalLines: true,
               //Boolean - Whether to show vertical lines (except Y axis)
               scaleShowVerticalLines: true,
               //Boolean - If there is a stroke on each bar
               barShowStroke: true,
               //Number - Pixel width of the bar stroke
               barStrokeWidth: 2,
               //Number - Spacing between each of the X value sets
               barValueSpacing: 5,
               //Number - Spacing between data sets within X values
               barDatasetSpacing: 1,
               //String - A legend template
               legendTemplate: '<ul class="<%=name.toLowerCase()%>-legend"><% for (var i=0; i<datasets.length; i++){%><li><span style="background-color:<%=datasets[i].fillColor%>"></span><%if(datasets[i].label){%><%=datasets[i].label%><%}%></li><%}%></ul>',
             //Boolean - whether to make the chart responsive
             responsive              : true,
             maintainAspectRatio     : true
           }


           barChartOptions.datasetFill = false
           barChart.Bar(barChartData, barChartOptions)
       });
   }


   var areaChartOptions = {
     //Boolean - If we should show the scale at all
     showScale               : true,
     //Boolean - Whether grid lines are shown across the chart
     scaleShowGridLines      : false,
     //String - Colour of the grid lines
     scaleGridLineColor      : 'rgba(0,0,0,.05)',
     //Number - Width of the grid lines
     scaleGridLineWidth      : 1,
     //Boolean - Whether to show horizontal lines (except X axis)
     scaleShowHorizontalLines: true,
     //Boolean - Whether to show vertical lines (except Y axis)
     scaleShowVerticalLines  : true,
     //Boolean - Whether the line is curved between points
     bezierCurve             : true,
     //Number - Tension of the bezier curve between points
     bezierCurveTension      : 0.3,
     //Boolean - Whether to show a dot for each point
     pointDot                : false,
     //Number - Radius of each point dot in pixels
     pointDotRadius          : 4,
     //Number - Pixel width of point dot stroke
     pointDotStrokeWidth     : 1,
     //Number - amount extra to add to the radius to cater for hit detection outside the drawn point
     pointHitDetectionRadius : 20,
     //Boolean - Whether to show a stroke for datasets
     datasetStroke           : true,
     //Number - Pixel width of dataset stroke
     datasetStrokeWidth      : 2,
     //Boolean - Whether to fill the dataset with a color
     datasetFill             : true,
     //String - A legend template
     legendTemplate          : '<ul class="<%=name.toLowerCase()%>-legend"><% for (var i=0; i<datasets.length; i++){%><li><span style="background-color:<%=datasets[i].lineColor%>"></span><%if(datasets[i].label){%><%=datasets[i].label%><%}%></li><%}%></ul>',
     //Boolean - whether to maintain the starting aspect ratio or not when responsive, if set to false, will take up entire container
     maintainAspectRatio     : true,
     //Boolean - whether to make the chart responsive to window resizing
     responsive              : true
   }




   getDataForChart(moment().subtract(29, 'days'), moment());
   getDataForBarChart(moment().subtract(29, 'days'), moment());


   @can('campaign_delete')
             @if ( request('show_deleted') != 1 ) window.route_mass_crud_entries_destroy = '{{ route('admin.campaigns.mass_destroy') }}'; @endif
         @endcan
         $(document).ready(function () {
             window.dtDefaultOptions.ajax = '{!! route('admin.campaigns.index') !!}?show_deleted={{ request('show_deleted') }}';
             window.dtDefaultOptions.columns = [@can('campaign_delete')
                 @if ( request('show_deleted') != 1 )
                     {data: 'massDelete', name: 'id', searchable: false, sortable: false},
                 @endif
                 @endcan{data: 'name', name: 'name'},


                 {
                     "data": "budget",
                     "render": function (data, type, row, meta) {
                         data = ''+ row.budget ;
                         return data;
                     }
                 },

                 {data: 'actions', name: 'actions', searchable: false, sortable: false}
             ];
             processAjaxTables();
         });
</script>

<script>
        $(document).ready(function () {
            window.dtDefaultOptions.ajax = '{!! route('admin.invoice.getdata') !!}?show_deleted={{ request('show_deleted') }}';
            window.dtDefaultOptions.columns = [
                {data: 'id', name: 'id'},

                {data: 'amount', name: 'amount'},

                {data: 'created_at', name: 'created_at'},
                {data: 'download', name: 'download'}
            ];
            processAjaxTables();
        });
     </script>
     <script>
        @if(starts_with(strtolower($invoice_data->tax_id), strtolower('de')))
        $(document).ready(function () {
            $('#paypal_form').on('submit', function () {
                var amount = parseInt($('#amount_val').val());
                $('#amount_val').val(amount + (amount * 0.19));
            })
        });
        @endif
     </script>
     <script src="https://js.braintreegateway.com/js/braintree-2.32.1.min.js"></script>
     <script>
        braintree.setup('{{$client_token}}', 'dropin', {container: 'dropin-container'});
        braintree.setup('{{$client_token}}', 'dropin', {container: 'dropin-container2'});
        $(document).ready(function() {

        if(window.location.href.indexOf('#sModal') != -1) {
        $('#sModal').modal('show');
        }

        });
        $(document).ready(function() {

        if(window.location.href.indexOf('#pModal') != -1) {
        $('#pModal').modal('show');
        }

        });

     </script>
     <script src="{{ url('adminlte/plugins/iCheck/icheck.min.js') }}"></script>
     <script>
        //Flat red color scheme for iCheck
        $('input[type="checkbox"].flat-red, input[type="radio"].flat-red').iCheck({
        checkboxClass: 'icheckbox_flat-green',
        radioClass   : 'iradio_flat-green'
        })
     </script>
@endsection
