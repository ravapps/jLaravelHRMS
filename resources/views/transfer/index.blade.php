@extends('layouts.dashboard')
@section('page-title')
    {{__('Transfer')}}
@endsection
@section('content')
<div class="row mt-4">
    <div class="col-12">
        <div class="page-title-box-hori">
            <h4 class="page-title">{{__('Manage Transfer')}}</h4>
            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                  <li class="breadcrumb-item"><a href="{{__('home')}}">{{__('Dashboard')}}</a></li>
                    <li class="breadcrumb-item active">{{__('Transfer')}}</li>
                </ol>
            </div>
        </div>
    </div>
</div>
<hr class="mt-0 mb-2">

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <div class="d-flex justify-content-between w-100">
                    <h4>{{--__('Transfer List')--}}</h4>
                    @can('Create Transfer')
                        <a href="#" data-url="{{ route('transfer.create') }}" class="btn btn-icon icon-left btn-success" data-ajax-popup="true" data-toggle="tooltip" data-title="{{__('Create New Transfer')}}" data-original-title="{{__('Create Transfer')}}">
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
                            @role('company')
                            <th>{{__('Employee Name')}}</th>
                            @endrole
                            <th>{{__('Branch')}}</th>
                            <th>{{__('Department')}}</th>
                            <th>{{__('Transfer Date')}}</th>
                            <th>{{__('Description')}}</th>
                            @if(Gate::check('Edit Transfer') || Gate::check('Delete Transfer'))
                                <th class="text-right">{{__('Action')}}</th>
                            @endif
                        </tr>
                        </thead>
                        <tbody class="font-style">
                        @foreach ($transfers as $transfer)
                            <tr>
                                @role('company')
                                <td>{{ !empty($transfer->employee())?$transfer->employee()->name:'' }}</td>
                                @endrole
                                <td>{{ !empty($transfer->branch())?$transfer->branch()->name:'' }}</td>
                                <td>{{ !empty($transfer->department())?$transfer->department()->name:'' }}</td>
                                <td>{{  \Auth::user()->dateFormat($transfer->transfer_date) }}</td>
                                <td>{{ $transfer->description }}</td>
                                @if(Gate::check('Edit Transfer') || Gate::check('Delete Transfer'))
                                    <td class="text-right">
                                        @can('Edit Transfer')
                                            <a href="#" data-url="{{ URL::to('transfer/'.$transfer->id.'/edit') }}" data-size="lg" data-ajax-popup="true" data-title="{{__('Edit Transfer')}}" class="btn btn-outline-success  mr-1" data-toggle="tooltip" data-original-title="{{__('Edit')}}"><i class="fas fa-pencil-alt"></i> <span>{{__('Edit')}}</span></a>
                                        @endcan
                                        @can('Delete Transfer')
                                            <a href="#" class="btn btn-outline-danger " data-toggle="tooltip" data-original-title="{{__('Delete')}}" data-confirm="Are You Sure?|This action can not be undone. Do you want to continue?" data-confirm-yes="document.getElementById('delete-form-{{$transfer->id}}').submit();"><i class="fas fa-trash"></i> <span>{{__('Delete')}}</span></a>
                                            {!! Form::open(['method' => 'DELETE', 'route' => ['transfer.destroy', $transfer->id],'id'=>'delete-form-'.$transfer->id]) !!}
                                            {!! Form::close() !!}
                                        @endcan
                                    </td>
                                @endif
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
