@extends('layouts.dashboard')
@section('page-title')
    {{__('Branch')}}
@endsection
@section('content')
<div class="row mt-4">
    <div class="col-12">
        <div class="page-title-box-hori">
            <h4 class="page-title">{{__('Manage Bonus')}}</h4>
            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item"><a href="{{__('home')}}">{{__('Dashboard')}}</a></li>
                    <li class="breadcrumb-item active">{{__('Bonus')}}</li>
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
                    <h4>{{--__('BonusList')--}}</h4>
                    @can('Create Bonus')
                        <a href="{{ route('bonus.create') }}" class="btn btn-icon icon-left btn-success" >
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
                            <th>{{__('Name')}}</th>
                            <th>{{__('Month')}}</th>
                            <th>{{__('Amount')}}</th>
                            <th class="text-right">{{__('Action')}}</th>
                        </tr>
                        </thead>
                        <tbody class="font-style">
                        @foreach ($bonuses as $bonus)
                            <tr>
                            <td>{{ $bonus->first_name }} {{ $bonus->last_name }}</td>
                                <td>{{ $bonus->name }}</td>
                                <td>{{ date('M',strtotime($bonus->date_bonus)) }}</td>
                                <td>${{ $bonus->amount }}</td>
                                <td class="text-right">
                                    @can('Manage Bonus')
                                        <a href="{{ URL::to('bonus/'.$bonus->id.'/edit') }}" class="btn btn-outline-success  mr-1" ><i class="fas fa-pencil-alt"></i> <span>{{__('Edit')}}</span></a>
                                    @endcan
                                    @can('Manage Branch')
                                        <a href="#" class="btn btn-outline-danger " data-toggle="tooltip" data-original-title="{{__('Delete')}}" data-confirm="Are You Sure?|This action can not be undone. Do you want to continue?" data-confirm-yes="document.getElementById('delete-form-{{$bonus->id}}').submit();"><i class="fas fa-trash"></i> <span>{{__('Delete')}}</span></a>
                                        {!! Form::open(['method' => 'DELETE', 'route' => ['bonus.destroy', $bonus->id],'id'=>'delete-form-'.$bonus->id]) !!}
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
