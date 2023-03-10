@extends('layouts.dashboard')
@section('page-title')
    {{__('Shift Roster')}}
@endsection

@section('content')
<div class="row mt-4">
    <div class="col-12">
        <div class="page-title-box-hori">
            <h4 class="page-title">{{__('Shift Roster')}}</h4>
            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item"><a href="{{__('home')}}">{{__('Dashboard')}}</a></li>
                    <li class="breadcrumb-item active">{{__('Shift Roster')}}</li>
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
                    <h4>{{--__('Shift Roster List')--}}</h4>
                    @can('Create Roaster')
                        <a href="{{ route('roaster.create') }}" class="btn btn-icon icon-left btn-success" >
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

                            <th>{{__('Employee Name')}}</th>
                            <th>{{__('Shift Name')}}</th>
                            <th>{{__('From Date')}}</th>
                            <th>{{__('To Date')}}</th>
                             <th class="text-right">{{__('Action')}}</th>

                        </tr>
                        </thead>
                        <tbody class="font-style">
                        @foreach ($get_shift as $row)

                            <tr>

                                <td>{{$row->employee->name}}</td>
                                <td>{{$row->shift_name->name}}</td>
                                <td>{{date("d-m-Y",strtotime($row->from_date))}}</td>
                                <td>{{date("d-m-Y",strtotime($row->to_date))}}</td>

                               @if(Gate::check('Edit Roaster'))
                                    <td class="text-right">
                                        @can('Edit Roaster')
                                            <a href="{{ URL::to('roaster/'.$row->id.'/edit') }}"  class="btn btn-outline-success  mr-1" ><i class="fas fa-pencil-alt"></i> <span>{{__('Edit')}}</span></a>
                                        @endcan
                                        @can('Edit Roaster')
                                            <a href="#" class="btn btn-outline-danger " data-toggle="tooltip" data-original-title="{{__('Delete')}}" data-confirm="Are You Sure?|This action can not be undone. Do you want to continue?" data-confirm-yes="document.getElementById('delete-form-{{$row->id}}').submit();"><i class="fas fa-trash"></i> <span>{{__('Delete')}}</span></a>
                                            {!! Form::open(['method' => 'DELETE', 'route' => ['roaster.destroy', $row->id],'id'=>'delete-form-'.$row->id]) !!}
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
