<!DOCTYPE html>
<html lang="en">

<head>
    @include('partials.head')
</head>


<body class="hold-transition skin-blue sidebar-mini">

<div id="wrapper">

{{--  @include('partials.topbar')  --}}
 {{-- @include('partials.sidebar') --}}

<!-- Content Wrapper. Contains page content -->
    <div class=" container-fluid">
        <!-- Main content -->
        <section class="content">
            @if(isset($siteTitle))
                <h3 class="page-title">
                    {{ $siteTitle }}
                </h3>
            @endif

            <div class="row">
                <div class="col-md-12">

                    @if (Session::has('message'))
                        <div class="alert alert-info">
                            <p>{{ Session::get('message') }}</p>
                        </div>
                    @endif
                    @if ($errors->count() > 0)
                        <div class="alert alert-danger">
                            <ul class="list-unstyled">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    @yield('content')

                </div>
            </div>
        </section>
    </div>
</div>

{!! Form::open(['route' => 'auth.logout', 'style' => 'display:none;', 'id' => 'logout']) !!}
<button type="submit">Logout</button>
{!! Form::close() !!}

@include('partials.javascripts')
{{--  {{ dd(Auth::user()->getCampaigns()->count()) }}  --}}
@if(Auth::user()->getCampaigns()->count() == '0')
<div class="modal fade" id="campaignmodal" tabindex="-1" role="dialog" aria-labelledby="basicModal" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
            <form class="form-horizontal"   role="form"
            method="POST"
            action="{{ route('admin.firstrequest') }}">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          <h4 class="modal-title" id="myModalLabel">First Campaing Request</h4>
        </div>
        <div class="modal-body">


                <input type="hidden"
                        name="_token"
                        value="{{ csrf_token() }}">
                        <div class="form-group">
                                <label class="col-md-4 control-label">@lang('global.langing_page')</label>

                                <div class="col-md-6">
                                    <input type="text"
                                           class="form-control"
                                           name="langing_page"
                                           value="{{ old('langing_page') }}">
                                </div>
                            </div>
                        <div class="form-group">
                                <label class="col-md-4 control-label">@lang('global.target')</label>

                                <div class="col-md-6">
                                    <input type="text"
                                            class="form-control"
                                            name="target"
                                            value="{{ old('target') }}">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-4 control-label">@lang('global.city')</label>

                            <div class="col-md-6">
                                <input type="text"
                                        class="form-control"
                                        name="city"
                                        value="{{ old('city') }}">
                            </div>
                        </div>



        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Create</button>
        </div>
    </form>
      </div>
    </div>
  </div>
  <script >
      $("#campaignmodal").modal('show');
  </script>
@endif

</body>
</html>
