@extends('layouts.dashboard')
@section('page-title')
    {{__('Award')}}
@endsection
@section('content')
<div class="row mt-4">
    <div class="col-12">
        <div class="page-title-box-hori">
            <h4 class="page-title">{{__('Manage Award')}}</h4>
            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                  <li class="breadcrumb-item"><a href="{{__('home')}}">{{__('Dashboard')}}</a></li>
                    <li class="breadcrumb-item active">{{__('Award')}}</li>
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
                    <h4>{{--__('Award List')--}}</h4>
                    @can('Create Award')
                        <a href="#" data-url="{{ route('award.create') }}" class="btn btn-icon icon-left btn-success" data-ajax-popup="true" data-toggle="tooltip" data-title="{{__('Create New Award')}}" data-original-title="{{__('Create Award')}}">
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
                            <th>{{__('Employee')}}</th>
                            @endrole
                            <th>{{__('Award Type')}}</th>
                            <th>{{__('Date')}}</th>
                            <th>{{__('Gift')}}</th>
                            <th>{{__('Description')}}</th>
                            @if(Gate::check('Edit Award') || Gate::check('Delete Award'))
                                <th class="text-right">{{__('Action')}}</th>
                            @endif
                        </tr>
                        </thead>
                        <tbody class="font-style">
                        @foreach ($awards as $award)
                            <tr>
                                @role('company')
                                <td>{{!empty( $award->employee())? $award->employee()->name:'' }}</td>
                                @endrole
                                <td>{{ !empty($award->awardType())?$award->awardType()->name:'' }}</td>
                                <td>{{  \Auth::user()->dateFormat($award->date )}}</td>
                                <td>{{ $award->gift }}</td>
                                <td>{{ $award->description }}</td>

                                @if(Gate::check('Edit Award') || Gate::check('Delete Award'))
                                    <td class="text-right">
                                        @can('Edit Award')
                                            <a href="#" data-url="{{ URL::to('award/'.$award->id.'/edit') }}" data-size="lg" data-ajax-popup="true" data-title="{{__('Edit Award')}}" class="btn btn-outline-success  mr-1" data-toggle="tooltip" data-original-title="{{__('Edit')}}"><i class="fas fa-pencil-alt"></i> <span>{{__('Edit')}}</span></a>
                                        @endcan
                                        @can('Delete Award')
                                            <a href="#" class="btn btn-outline-danger " data-toggle="tooltip" data-original-title="{{__('Delete')}}" data-confirm="Are You Sure?|This action can not be undone. Do you want to continue?" data-confirm-yes="document.getElementById('delete-form-{{$award->id}}').submit();"><i class="fas fa-trash"></i> <span>{{__('Delete')}}</span></a>
                                            {!! Form::open(['method' => 'DELETE', 'route' => ['award.destroy', $award->id],'id'=>'delete-form-'.$award->id]) !!}
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
