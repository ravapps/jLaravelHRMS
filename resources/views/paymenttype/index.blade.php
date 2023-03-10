@extends('layouts.dashboard')
@section('page-title')
    {{__('Payment Type')}}
@endsection
@section('content')
<div class="row mt-4">
    <div class="col-12">
        <div class="page-title-box-hori">
            <h4 class="page-title">{{__('Manage Payment Type')}}</h4>
            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                  <li class="breadcrumb-item"><a href="{{__('home')}}">{{__('Dashboard')}}</a></li>
                  <!-- <li class="breadcrumb-item"><a href="{{route('employee.index')}}">{{__('Pay Grade')}}</a></li> -->
                  <li class="breadcrumb-item active">{{__('Payment Type')}}</li>
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
                    <h4>{{__('Payment Type List')}}</h4>
                    @can('Create Payment Type')
                        <a href="#" data-url="{{ route('paymenttype.create') }}" class="btn btn-icon icon-left btn-success" data-ajax-popup="true" data-toggle="tooltip" data-title="{{__('Create New Payment Type')}}" data-original-title="{{__('Create Payment Type')}}">
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
                            <th>{{__('Payment Type')}}</th>
                            <th class="text-right">{{__('Action')}}</th>
                        </tr>
                        </thead>
                        <tbody class="fdont-style">
                        @foreach ($paymenttypes as $paymenttype)
                            <tr>
                                <td>{{ $paymenttype->name }}</td>

                                <td class="text-right">
                                    @can('Edit Payment Type')
                                        <a href="#" data-url="{{ URL::to('paymenttype/'.$paymenttype->id.'/edit') }}" data-size="lg" data-ajax-popup="true" data-title="{{__('Edit Payment Type')}}" class="btn btn-outline-success  mr-1" data-toggle="tooltip" data-original-title="{{__('Edit')}}"><i class="fas fa-pencil-alt"></i> <span>{{__('Edit')}}</span></a>
                                    @endcan
                                    @can('Delete Payment Type')
                                        <a href="#" class="btn btn-outline-danger " data-toggle="tooltip" data-original-title="{{__('Delete')}}" data-confirm="Are You Sure?|This action can not be undone. Do you want to continue?" data-confirm-yes="document.getElementById('delete-form-{{$paymenttype->id}}').submit();"><i class="fas fa-trash"></i> <span>{{__('Delete')}}</span></a>
                                        {!! Form::open(['method' => 'DELETE', 'route' => ['paymenttype.destroy', $paymenttype->id],'id'=>'delete-form-'.$paymenttype->id]) !!}
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
