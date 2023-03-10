@extends('layouts.dashboard')
@section('page-title')
    {{__('Leave Type')}}
@endsection
@section('content')
<div class="row mt-4">
    <div class="col-12">
        <div class="page-title-box-hori">
            <h4 class="page-title">{{__('Manage Leave Type')}}</h4>
            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                  <li class="breadcrumb-item"><a href="{{__('home')}}">{{__('Dashboard')}}</a></li>
                    <li class="breadcrumb-item active">{{__('Leave Type')}}</li>
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
                    <h4>{{--__('Leave Type List')--}}</h4>
                    @can('Create Leave Type')
                        <a href="#" data-url="{{ route('leavetype.create') }}" class="btn btn-icon icon-left btn-success" data-ajax-popup="true" data-toggle="tooltip" data-title="{{__('Create New Leave Type')}}" data-original-title="{{__('Create Leave Type')}}">
                            <i class="fa fa-plus"></i>  {{__('Create')}}
                        </a>
                    @endcan
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped mb-0" id="dataTable">
                        <thead>
                        <tr>
                            <th>{{__('Leave Type')}}</th>
                            <th>{{__('Priority.')}}</th>
                            <th>{{__('No Of Days.')}}</th>
                            <th class="text-right">{{__('Action')}}</th>
                        </tr>
                        </thead>
                        <tbody class="font-style">
                        @foreach ($leavetypes as $leavetype)
                            <tr>
                                <td>{{ $leavetype->title }}</td>
                                <td>{{ $leavetype->days}}</td>
                                <td>{{ $leavetype->leaves_days}}</td>
                                <td class="text-right">
                                    @can('Edit Leave Type')
                                        <a href="#" data-url="{{ URL::to('leavetype/'.$leavetype->id.'/edit') }}" data-size="lg" data-ajax-popup="true" data-title="{{__('Edit Leave Type')}}" class="btn btn-outline-success  mr-1" data-toggle="tooltip" data-original-title="{{__('Edit')}}"><i class="fas fa-pencil-alt"></i> <span>{{__('Edit')}}</span></a>
                                    @endcan
                                    @can('Delete Leave Type')
                                        <a href="#" class="btn btn-outline-danger " data-toggle="tooltip" data-original-title="{{__('Delete')}}" data-confirm="Are You Sure?|This action can not be undone. Do you want to continue?" data-confirm-yes="document.getElementById('delete-form-{{$leavetype->id}}').submit();"><i class="fas fa-trash"></i> <span>{{__('Delete')}}</span></a>
                                        {!! Form::open(['method' => 'DELETE', 'route' => ['leavetype.destroy', $leavetype->id],'id'=>'delete-form-'.$leavetype->id]) !!}
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
