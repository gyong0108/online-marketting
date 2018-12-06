@inject('request', 'Illuminate\Http\Request')
@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('global.stripe-transactions.title')</h3>
    @can('stripe_transaction_create')
    <p>
        
        
    </p>
    @endcan

    

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('global.app_list')
        </div>

        <div class="panel-body table-responsive">
            <table class="table table-bordered table-striped {{ count($stripe_transactions) > 0 ? 'datatable' : '' }} ">
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
    </div>
@stop

@section('javascript') 
    <script>
        
    </script>
@endsection