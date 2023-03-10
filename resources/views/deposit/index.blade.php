@extends('layouts.dashboard')
@section('page-title')
    {{__('Deposite')}}
@endsection
@section('content')
<div class="row mt-4">
    <div class="col-12">
        <div class="page-title-box-hori">
            <h4 class="page-title">{{__('Manage Deposit')}}</h4>
            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                  <li class="breadcrumb-item"><a href="{{__('home')}}">{{__('Dashboard')}}</a></li>
                  <li class="breadcrumb-item active">{{__('Deposit')}}</li>
                </ol>
            </div>
        </div>
    </div>
</div>
<hr class="mt-0">

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <div class="d-flex justify-content-between w-100">
                    <h4>{{--__('Deposit List')--}}</h4>
                    @can('Create Deposit')
                        <a href="#" data-url="{{ route('deposit.create') }}" class="btn btn-icon icon-left btn-success" data-ajax-popup="true" data-toggle="tooltip" data-title="{{__('Create New Deposit')}}" data-original-title="{{__('Create Deposit')}}">
                            <i class="fa fa-plus"></i> {{__('Create')}}
                        </a>
                    @endcan
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped mb-0" id="dataTable">
                        <thead>
                        <tr>
                            <th>{{__('Account')}}</th>
                            <th>{{__('Payer')}}</th>
                            <th>{{__('Amount')}}</th>
                            <th>{{__('Category')}}</th>
                            <th>{{__('Ref#')}}</th>
                            <th>{{__('Payment')}}</th>
                            <th>{{__('Date')}}</th>
                            <th class="text-right">{{__('Action')}}</th>
                        </tr>
                        </thead>
                        <tbody class="font-style">
                        @foreach ($deposits as $deposit)
                            <tr>
                                <td>{{ !empty($deposit->account($deposit->account_id))?$deposit->account($deposit->account_id)->account_name:'' }}</td>
                                <td>{{!empty( $deposit->payer($deposit->payer_id))? $deposit->payer($deposit->payer_id)->payer_name:'' }}</td>
                                <td>{{ \Auth::user()->priceFormat( $deposit->amount) }}</td>
                                <td>{{ !empty($deposit->income_category($deposit->income_category_id))?$deposit->income_category($deposit->income_category_id)->name:'' }}</td>
                                <td>{{ $deposit->referal_id }}</td>
                                <td>{{ !empty($deposit->payment_type($deposit->payment_type_id))?$deposit->payment_type($deposit->payment_type_id)->name:'' }}</td>
                                <td>{{  \Auth::user()->dateFormat($deposit->date) }}</td>

                                <td class="text-right">
                                    @can('Edit Deposit')
                                        <a href="#" data-url="{{ URL::to('deposit/'.$deposit->id.'/edit') }}" data-size="lg" data-ajax-popup="true" data-title="{{__('Edit Deposit')}}" class="btn btn-outline-success  mr-1" data-toggle="tooltip" data-original-title="{{__('Edit')}}"><i class="fas fa-pencil-alt"></i> <span>{{__('Edit')}}</span></a>
                                    @endcan
                                    @can('Delete Deposit')
                                        <a href="#" class="btn btn-outline-danger " data-toggle="tooltip" data-original-title="{{__('Delete')}}" data-confirm="Are You Sure?|This action can not be undone. Do you want to continue?" data-confirm-yes="document.getElementById('delete-form-{{$deposit->id}}').submit();"><i class="fas fa-trash"></i> <span>{{__('Delete')}}</span></a>
                                        {!! Form::open(['method' => 'DELETE', 'route' => ['deposit.destroy', $deposit->id],'id'=>'delete-form-'.$deposit->id]) !!}
                                        {!! Form::close() !!}
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
