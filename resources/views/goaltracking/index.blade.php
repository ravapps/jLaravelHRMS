@extends('layouts.dashboard')
@section('page-title')
    {{__('Goal Tracking')}}
@endsection
@section('content')

<div class="row mt-4">
    <div class="col-12">
        <div class="page-title-box-hori">
            <h4 class="page-title">{{__('Manage Goal Tracking')}}</h4>
            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item"><a href="{{__('home')}}">{{__('Dashboard')}}</a></li>
                    <li class="breadcrumb-item active">{{__('Goal Tracking')}}</li>
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
                    <h4>{{--__('Goal Tracking List')--}}</h4>
                    @can('Create Goal Tracking')
                        <a href="#" data-url="{{ route('goaltracking.create') }}" class="btn btn-icon icon-left btn-success" data-ajax-popup="true" data-title="{{__('Create New Goal Tracking')}}">
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
                            <th>{{__('Goal Type')}}</th>
                            <th>{{__('Subject')}}</th>
                            <th>{{__('Branch')}}</th>
                            <th>{{__('Target Achievement')}}</th>
                            <th>{{__('Start Date')}}</th>
                            <th>{{__('End Date')}}</th>
                            <th width="20%">{{__('Progress')}}</th>
                            @if( Gate::check('Edit Goal Tracking') ||Gate::check('Delete Goal Tracking'))
                                <th class="text-right">{{__('Action')}}</th>
                            @endif
                        </tr>
                        </thead>
                        <tbody class="font-style">
                        @foreach ($goalTrackings as $goalTracking)

                            <tr>
                                <td>{{ !empty($goalTracking->goalType)?$goalTracking->goalType->name:'' }}</td>
                                <td>{{$goalTracking->subject}}</td>
                                <td>{{ !empty($goalTracking->branches)?$goalTracking->branches->name:'' }}</td>
                                <td>{{$goalTracking->target_achievement}}</td>
                                <td>{{\Auth::user()->dateFormat($goalTracking->start_date)}}</td>
                                <td>{{\Auth::user()->dateFormat($goalTracking->end_date)}}</td>
                                <td>
                                    <div class="progress">
                                        <div class="progress-bar bg-warning" style="width:{{$goalTracking->progress}}%">{{$goalTracking->progress}}%</div>
                                    </div>
                                </td>
                                @if( Gate::check('Edit Goal Tracking') ||Gate::check('Delete Goal Tracking'))
                                    <td class="text-right">
                                        @can('Edit Goal Tracking')
                                            <a href="#" data-url="{{ route('goaltracking.edit',$goalTracking->id) }}" data-size="lg" data-ajax-popup="true" data-title="{{__('Edit Goal Tracking')}}" class="btn btn-outline-success  mr-1"><i class="fas fa-pencil-alt"></i> <span>{{__('Edit')}}</span></a>
                                        @endcan
                                        @can('Delete Goal Tracking')
                                            <a href="#" class="btn btn-outline-danger " data-confirm="Are You Sure?|This action can not be undone. Do you want to continue?" data-confirm-yes="document.getElementById('delete-form-{{$goalTracking->id}}').submit();"><i class="fas fa-trash"></i> <span>{{__('Delete')}}</span></a>
                                            {!! Form::open(['method' => 'DELETE', 'route' => ['goaltracking.destroy', $goalTracking->id],'id'=>'delete-form-'.$goalTracking->id]) !!}
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
