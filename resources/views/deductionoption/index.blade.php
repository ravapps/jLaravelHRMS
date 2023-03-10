@extends('layouts.dashboard')
@section('page-title')
    {{__('Deduction Option')}}
@endsection
@section('content')
<div class="row mt-4">
    <div class="col-12">
        <div class="page-title-box-hori">
            <h4 class="page-title">{{__('Manage Deduction Option')}}</h4>
            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                  <li class="breadcrumb-item"><a href="{{__('home')}}">{{__('Dashboard')}}</a></li>
                    <li class="breadcrumb-item active">{{__('Deduction Option')}}</li>
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
                    <h4>{{--__('Deduction Option List')--}}</h4>
                    @can('Create Deduction Option')
                        <a href="#" data-url="{{ route('deductionoption.create') }}" class="btn btn-icon icon-left btn-success" data-ajax-popup="true" data-toggle="tooltip" data-title="{{__('Create New Deduction Option')}}" data-original-title="{{__('Create Deduction Option')}}">
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
                            <th>{{__('Deduction Option')}}</th>
                            <th>{{__('Deduction Amount')}}</th>
                            <th class="text-right">{{__('Action')}}</th>
                        </tr>
                        </thead>
                        <tbody class="font-style">
                        @foreach ($deductionoptions as $deductionoption)
                            <tr>
                                <td>{{ $deductionoption->name }}</td>
                                <td>{{ $deductionoption->deduct_amt }}</td>

                                <td class="text-right">
                                    @if($deductionoption->id != 987)
                                    @can('Edit Deduction Option')
                                        <a href="#" data-url="{{ URL::to('deductionoption/'.$deductionoption->id.'/edit') }}" data-size="lg" data-ajax-popup="true" data-title="{{__('Edit Deduction Option')}}" class="btn btn-outline-success  mr-1" data-toggle="tooltip" data-original-title="{{__('Edit')}}"><i class="fas fa-pencil-alt"></i> <span>{{__('Edit')}}</span></a>
                                    @endcan
                                    @can('Delete Deduction Option')

                                        <a href="#" class="btn btn-outline-danger " data-toggle="tooltip" data-original-title="{{__('Delete')}}" data-confirm="Are You Sure?|This action can not be undone. Do you want to continue?" data-confirm-yes="document.getElementById('delete-form-{{$deductionoption->id}}').submit();"><i class="fas fa-trash"></i> <span>{{__('Delete')}}</span></a>
                                        {!! Form::open(['method' => 'DELETE', 'route' => ['deductionoption.destroy', $deductionoption->id],'id'=>'delete-form-'.$deductionoption->id]) !!}
                                        {!! Form::close() !!}

                                    @endif
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
