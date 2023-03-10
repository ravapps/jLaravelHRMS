@extends('layouts.dashboard')
@section('page-title')
    {{__('Trainer')}}
@endsection
@section('content')
<div class="row mt-4">
    <div class="col-12">
        <div class="page-title-box-hori">
            <h4 class="page-title">{{__('Manage Trainer')}}</h4>
            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item"><a href="{{__('home')}}">{{__('Dashboard')}}</a></li>
                    <li class="breadcrumb-item active">{{__('Trainer')}}</li>
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
                    <h4>{{--__('Trainer List')--}}</h4>
                    @can('Create Trainer')
                        <a href="#" data-url="{{ route('trainer.create') }}" class="btn btn-icon icon-left btn-success" data-ajax-popup="true" data-title="{{__('Create New Trainer')}}">
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
                            <th>{{__('Branch')}}</th>
                            <th>{{__('Full Name')}}</th>
                            <th>{{__('Contact')}}</th>
                            <th>{{__('Email')}}</th>
                            @if( Gate::check('Edit Trainer') ||Gate::check('Delete Trainer') ||Gate::check('Show Trainer'))
                                <th class="text-right">{{__('Action')}}</th>
                            @endif
                        </tr>
                        </thead>
                        <tbody class="font-style">
                        @foreach ($trainers as $trainer)
                            <tr>
                                <td>{{ !empty($trainer->branches)?$trainer->branches->name:'' }}</td>
                                <td>{{$trainer->firstname .' '.$trainer->lastname}}</td>
                                <td>{{$trainer->contact}}</td>
                                <td>{{$trainer->email}}</td>
                                @if( Gate::check('Edit Trainer') ||Gate::check('Delete Trainer') || Gate::check('Show Trainer'))
                                    <td class="text-right">
                                        @can('Show Trainer')
                                            <a href="#" data-url="{{ route('trainer.show',$trainer->id) }}" data-size="lg" data-ajax-popup="true" data-title="{{__('Trainer Detail')}}" class="btn btn-outline-warning  mr-1"><i class="fas fa-eye"></i> <span>{{__('Show')}}</span></a>
                                        @endcan
                                        @can('Edit Trainer')
                                            <a href="#" data-url="{{ route('trainer.edit',$trainer->id) }}" data-size="lg" data-ajax-popup="true" data-title="{{__('Edit Trainer')}}" class="btn btn-outline-success  mr-1"><i class="fas fa-pencil-alt"></i> <span>{{__('Edit')}}</span></a>
                                        @endcan
                                        @can('Delete Trainer')
                                            <a href="#" class="btn btn-outline-danger " data-confirm="Are You Sure?|This action can not be undone. Do you want to continue?" data-confirm-yes="document.getElementById('delete-form-{{$trainer->id}}').submit();"><i class="fas fa-trash"></i> <span>{{__('Delete')}}</span></a>
                                            {!! Form::open(['method' => 'DELETE', 'route' => ['trainer.destroy', $trainer->id],'id'=>'delete-form-'.$trainer->id]) !!}
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
