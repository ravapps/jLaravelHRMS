@extends('layouts.dashboard')
@section('page-title')
    {{__('Warning')}}
@endsection
@section('content')
<div class="row mt-4">
    <div class="col-12">
        <div class="page-title-box-hori">
            <h4 class="page-title">{{__('Manage Warning')}}</h4>
            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                  <li class="breadcrumb-item"><a href="{{__('home')}}">{{__('Dashboard')}}</a></li>
                    <li class="breadcrumb-item active">{{__('Warning')}}</li>
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
                    <h4>{{--__('Warning List')--}}</h4>
                    @can('Create Warning')
                        <a href="#" data-url="{{ route('warning.create') }}" class="btn btn-icon icon-left btn-success" data-ajax-popup="true" data-toggle="tooltip" data-title="{{__('Create New Warning')}}" data-original-title="{{__('Create Warning')}}">
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
                            <th>{{__('Warning By')}}</th>
                            <th>{{__('Warning To')}}</th>
                            <th>{{__('Subject')}}</th>
                            <th>{{__('Warning Date')}}</th>
                            <th>{{__('Description')}}</th>
                            @if(Gate::check('Edit Warning') || Gate::check('Delete Warning'))
                                <th class="text-right">{{__('Action')}}</th>
                            @endif
                        </tr>
                        </thead>
                        <tbody class="font-style">
                        @foreach ($warnings as $warning)
                            <tr>
                                <td>{{!empty( $warning->WarningBy($warning->warning_by))? $warning->WarningBy($warning->warning_by)->name:'' }}</td>
                                <td>{{ !empty($warning->warningTo($warning->warning_to))?$warning->warningTo($warning->warning_to)->name:'' }}</td>
                                <td>{{ $warning->subject }}</td>
                                <td>{{  \Auth::user()->dateFormat($warning->warning_date) }}</td>
                                <td>{{ $warning->description }}</td>
                                @if(Gate::check('Edit Warning') || Gate::check('Delete Warning'))
                                    <td class="text-right">
                                        @can('Edit Warning')
                                            <a href="#" data-url="{{ URL::to('warning/'.$warning->id.'/edit') }}" data-size="lg" data-ajax-popup="true" data-title="{{__('Edit Warning')}}" class="btn btn-outline-success  mr-1" data-toggle="tooltip" data-original-title="{{__('Edit')}}"><i class="fas fa-pencil-alt"></i> <span>{{__('Edit')}}</span></a>
                                        @endcan
                                        @can('Delete Warning')
                                            <a href="#" class="btn btn-outline-danger " data-toggle="tooltip" data-original-title="{{__('Delete')}}" data-confirm="Are You Sure?|This action can not be undone. Do you want to continue?" data-confirm-yes="document.getElementById('delete-form-{{$warning->id}}').submit();"><i class="fas fa-trash"></i> <span>{{__('Delete')}}</span></a>
                                            {!! Form::open(['method' => 'DELETE', 'route' => ['warning.destroy', $warning->id],'id'=>'delete-form-'.$warning->id]) !!}
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
