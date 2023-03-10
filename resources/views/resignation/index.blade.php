@extends('layouts.dashboard')
@section('page-title')
    {{__('Resignation')}}
@endsection
@section('content')
<div class="row mt-4">
    <div class="col-12">
        <div class="page-title-box-hori">
            <h4 class="page-title">{{__('Manage Resignation')}}</h4>
            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                  <li class="breadcrumb-item"><a href="{{__('home')}}">{{__('Dashboard')}}</a></li>
                    <li class="breadcrumb-item active">{{__('Resignation')}}</li>
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
                    <h4>{{--__('Resignation List')--}}</h4>
                    @can('Create Resignation')
                        <a href="#" data-url="{{ route('resignation.create') }}" class="btn btn-icon icon-left btn-success" data-ajax-popup="true" data-toggle="tooltip" data-title="{{__('Create New Resignation')}}" data-original-title="{{__('Create Resignation')}}">
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
                            <th>{{__('Notice Date')}}</th>
                            <th>{{__('Resignation Date')}}</th>
                            <th>{{__('Description')}}</th>
                            @if(Gate::check('Edit Resignation') || Gate::check('Delete Resignation'))
                                <th class="text-right">{{__('Action')}}</th>
                            @endif
                        </tr>
                        </thead>
                        <tbody class="font-style">
                        @foreach ($resignations as $resignation)
                            <tr>
                                @role('company')
                                <td>{{ !empty($resignation->employee())?$resignation->employee()->name:'' }}</td>
                                @endrole
                                <td>{{  \Auth::user()->dateFormat($resignation->notice_date) }}</td>
                                <td>{{  \Auth::user()->dateFormat($resignation->resignation_date) }}</td>
                                <td>{{ $resignation->description }}</td>
                                @if(Gate::check('Edit Resignation') || Gate::check('Delete Resignation'))
                                    <td class="text-right">
                                        @can('Edit Resignation')
                                            <a href="#" data-url="{{ URL::to('resignation/'.$resignation->id.'/edit') }}" data-size="lg" data-ajax-popup="true" data-title="{{__('Edit Resignation')}}" class="btn btn-outline-success  mr-1" data-toggle="tooltip" data-original-title="{{__('Edit')}}"><i class="fas fa-pencil-alt"></i> <span>{{__('Edit')}}</span></a>
                                        @endcan
                                        @can('Delete Resignation')
                                            <a href="#" class="btn btn-outline-danger " data-toggle="tooltip" data-original-title="{{__('Delete')}}" data-confirm="Are You Sure?|This action can not be undone. Do you want to continue?" data-confirm-yes="document.getElementById('delete-form-{{$resignation->id}}').submit();"><i class="fas fa-trash"></i> <span>{{__('Delete')}}</span></a>
                                            {!! Form::open(['method' => 'DELETE', 'route' => ['resignation.destroy', $resignation->id],'id'=>'delete-form-'.$resignation->id]) !!}
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
