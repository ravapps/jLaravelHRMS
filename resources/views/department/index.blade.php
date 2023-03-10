@extends('layouts.dashboard')
@section('page-title')
    {{__('Department')}}
@endsection
@section('content')
<div class="row mt-4">
    <div class="col-12">
        <div class="page-title-box-hori">
            <h4 class="page-title">{{__('Manage Department')}}</h4>
            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                  <li class="breadcrumb-item"><a href="{{__('home')}}">{{__('Dashboard')}}</a></li>
                    <li class="breadcrumb-item active">{{__('Department')}}</li>
                </ol>
            </div>
        </div>
    </div>
</div>
<hr class="mt-0 mb-2">
@if(Session::has('error'))
<span class="text-danger pl-1">{{ Session::get('error') }}</span><br>
@endif
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <div class="d-flex justify-content-between w-100">
                    <h4>{{--__('Department List')--}}</h4>
                    @can('Create Department')
                        <a href="#" data-url="{{ route('department.create') }}" class="btn btn-icon icon-left btn-success" data-ajax-popup="true" data-toggle="tooltip" data-title="{{__('Create New Department')}}" data-original-title="{{__('Add Department')}}">
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
                            <th>{{__('Department')}}</th>
                            <th class="text-right">{{__('Action')}}</th>
                        </tr>
                        </thead>
                        <tbody class="font-style">
                        @foreach ($departments as $department)
                            <tr>
                                <td>{{ !empty($department->branch)?$department->branch->name:'' }}</td>
                                <td>{{ $department->name }}</td>

                                <td class="text-right">
                                    @can('Edit Department')
                                        <a href="#" data-url="{{ URL::to('department/'.$department->id.'/edit') }}" data-size="lg" data-ajax-popup="true" data-title="{{__('Edit Department')}}" class="btn btn-outline-success  mr-1" data-toggle="tooltip" data-original-title="{{__('Edit')}}"><i class="fas fa-pencil-alt"></i> <span>{{__('Edit')}}</span></a>
                                    @endcan
                                    @can('Delete Department')
                                        <a href="#" class="btn btn-outline-danger " data-toggle="tooltip" data-original-title="{{__('Delete')}}" data-confirm="Are You Sure?|This action can not be undone. Do you want to continue?" data-confirm-yes="document.getElementById('delete-form-{{$department->id}}').submit();"><i class="fas fa-trash"></i> <span>{{__('Delete')}}</span></a>
                                        {!! Form::open(['method' => 'DELETE', 'route' => ['department.destroy', $department->id],'id'=>'delete-form-'.$department->id]) !!}
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
