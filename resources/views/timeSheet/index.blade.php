@extends('layouts.dashboard')
@section('page-title')
    {{__('TimeSheet')}}
@endsection
@section('content')
<div class="row mt-4">
    <div class="col-12">
        <div class="page-title-box-hori">
            <h4 class="page-title">{{__('Manage TimeSheet')}}</h4>
            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item"><a href="{{__('home')}}">{{__('Dashboard')}}</a></li>
                    <li class="breadcrumb-item active">{{__('TimeSheet')}}</li>
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
                    <h4>{{--__('TimeSheet List')--}}</h4>
                    @can('Create TimeSheet')
                        <a href="#" data-url="{{ route('timesheet.create') }}" class="btn btn-icon icon-left btn-success" data-ajax-popup="true" data-toggle="tooltip" data-title="{{__('Create New')}}" data-original-title="{{__('Create TimeSheet')}}">
                            <i class="fa fa-plus"></i> {{__('Create')}}
                        </a>
                    @endcan
                </div>
            </div>

            <div class="card-body">
              @if(\Auth::user()->type != 'employee')
                  {{ Form::open(array('route' => array('timesheet.index'),'method'=>'get')) }}
                    <div class="row">
                      <div class="col">
                          {{Form::label('start_date',__('Start Date'))}}
                          {{Form::date('start_date',isset($_GET['start_date'])?$_GET['start_date']:'',array('class'=>'form-control'))}}
                      </div>
                      <div class="col">
                          {{Form::label('end_date',__('End Date'))}}
                          {{Form::date('end_date',isset($_GET['end_date'])?$_GET['end_date']:'',array('class'=>'form-control'))}}
                      </div>
                      <div class="col">
                          {{ Form::label('employee', __('Employee')) }}
                          {{ Form::select('employee', $employeesList,isset($_GET['employee'])?$_GET['employee']:'', array('class' => 'form-control select2')) }}
                      </div>
                      <div class="col-auto apply-btn">
                          <label class="w-100">&nbsp;</label>
                          {{Form::submit(__('Apply'),array('class'=>'btn btn-success'))}}
                          <a href="{{route('timesheet.index')}}" class="btn btn-danger">{{__('Reset')}}</a>
                      </div>
                  </div>
                {{ Form::close() }}
              @endif
              <hr>
                <div class="table-responsive">
                    <table class="table table-striped mb-0" id="dataTable">
                        <thead>
                        <tr>
                            @if(\Auth::user()->type!='employee')
                                <th>{{__('Employee')}}</th>
                            @endif
                            <th>{{__('Date')}}</th>
                            <th>{{__('Hours')}}</th>
                            <th>{{__('Description')}}</th>
                            <th width="200px">{{__('Action')}}</th>
                        </tr>
                        </thead>
                        <tbody class="font-style">
                        @foreach ($timeSheets as $timeSheet)
                            <tr>
                                @if(\Auth::user()->type!='employee')
                                    <td>{{!empty($timeSheet->employee)?$timeSheet->employee->name:''}}</td>
                                @endif
                                <td>{{  \Auth::user()->dateFormat($timeSheet->date) }}</td>
                                <td>{{ $timeSheet->hours }}</td>
                                <td>{{ $timeSheet->remark }}</td>
                                <td>
                                    @can('Delete TimeSheet')
                                        <a href="#" data-url="{{route('timesheet.edit',$timeSheet->id)}}" data-size="lg" data-ajax-popup="true" data-title="{{__('Edit Termination')}}" class="btn btn-outline-success  mr-1" data-toggle="tooltip" data-original-title="{{__('Edit')}}">
                                            <i class="fas fa-pencil-alt"></i> <span>{{__('Edit')}}</span>
                                        </a>
                                    @endcan
                                    @can('Delete TimeSheet')
                                        <a href="#" class="btn btn-outline-danger " data-toggle="tooltip" data-original-title="{{__('Delete')}}" data-confirm="Are You Sure?|This action can not be undone. Do you want to continue?" data-confirm-yes="document.getElementById('delete-form-{{$timeSheet->id}}').submit();"><i class="fas fa-trash"></i> <span>{{__('Delete')}}</span></a>
                                        {!! Form::open(['method' => 'DELETE', 'route' => ['timesheet.destroy', $timeSheet->id],'id'=>'delete-form-'.$timeSheet->id]) !!}
                                        {!! Form::close() !!}
                                    @endcan
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
