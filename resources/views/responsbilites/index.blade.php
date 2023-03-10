@extends('layouts.dashboard')
@section('page-title')
    {{__('Designation')}}
@endsection
<?php
  $pageTitle  = "Manage Responsbilites";
?>
@section('content')
<div class="row mt-4">
    <div class="col-12">
        <div class="page-title-box-hori">
            <h4 class="page-title">{{__('Manage Responsbilites')}}</h4>
            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                  <li class="breadcrumb-item"><a href="{{__('home')}}">{{__('Dashboard')}}</a></li>
                    <li class="breadcrumb-item active">{{__('Responsbilites')}}</li>
                </ol>
            </div>
        </div>
    </div>
</div>
<hr class="mt-0 mb-2">

<div class="row">
    <div class="col-md-12">
        <div class="card">
          @if(Session::has('error'))
          <span class="text-danger pl-1">{{ Session::get('error') }}</span><br>
          @endif
            <div class="card-header">
                <div class="d-flex justify-content-between w-100">
                    <h4>{{--__('Responsbilites List')--}}</h4>
                    <a href="javascript:;" data-url="{{ route('responsbilites.import') }}" class="btn btn-icon icon-left btn-success" data-ajax-popup="true" data-toggle="tooltip" data-title="{{__('Create New Responsbilites')}}" data-original-title="{{__('Add Responsbilites')}}">
                        <i class="fa fa-plus"></i> {{__('Import CSV')}}
                    </a>
                    <a href="javascript:;" data-url="{{ route('responsbilites.create') }}" class="btn btn-icon icon-left btn-success" data-ajax-popup="true" data-toggle="tooltip" data-title="{{__('Create New Responsbilites')}}" data-original-title="{{__('Add Responsbilites')}}">
                        <i class="fa fa-plus"></i> {{__('Create')}}
                    </a>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped mb-0" id="dataTable">
                        <thead>
                        <tr>
                            <th>{{__('Department')}}</th>
                            <th>{{__('Responsbilites')}}</th>
                            <th class="text-right">{{__('Action')}}</th>
                        </tr>
                        </thead>
                        <tbody class="font-style">
                          @foreach ($resp as $designation)
                              @php
                                  $department = \App\Department::where('id', $designation->designation_id)->first();
                              @endphp
                          <tr>
                              <td>{{ !empty($department->name)?$department->name:'' }}</td>
                              <td>{{ $designation->res_name }}</td>
                              <td class="text-right">

                                <a href="#" data-url="{{route('responsbilites.edit',$designation->id) }}" data-size="lg" data-ajax-popup="true" data-title="{{__('Edit Designation')}}" title="{{__('Edit Designation')}}" class="btn btn-success btn-sm mr-1" data-toggle="tooltip" data-placement="top"><i class="fas fa-pencil-alt"></i></a>

                            @can('Delete Designation')
                                <a href="#" class="btn btn-danger btn-sm" data-toggle="tooltip" title="{{__('Delete')}}" data-confirm="Are You Sure?|This action can not be undone. Do you want to continue?" data-confirm-yes="document.getElementById('delete-form-{{$designation->id}}').submit();"><i class="fas fa-trash"></i></a>
                                {!! Form::open(['method' => 'DELETE', 'route' => ['responsbilites.destroy', $designation->id],'id'=>'delete-form-'.$designation->id]) !!}
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
