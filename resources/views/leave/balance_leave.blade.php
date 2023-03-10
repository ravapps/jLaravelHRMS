@extends('layouts.dashboard')
@section('page-title')
    {{__('Leave')}}
@endsection
@section('content')
<div class="row mt-4">
    <div class="col-12">
        <div class="page-title-box-hori">
            <h4 class="page-title">{{__('Manage Leave Balance')}}</h4>
            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item"><a href="{{__('home')}}">{{__('Dashboard')}}</a></li>
                    <li class="breadcrumb-item active">{{__('Leave')}}</li>
                </ol>
            </div>
        </div>
    </div>
</div>
<hr class="mt-0 mb-2">

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <!-- <div class="card-header">
                <div class="d-flex justify-content-between w-100">
                    <h4>{{__('Leave List')}}</h4>

                </div>
            </div> -->
            <div class="card-body">
                <form action="{{url('balance_leave')}}" methode="get">
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                               <label>Employee Name</label><span class="text-danger pl-1">*</span>
                                <select name="employee_ids" required class="form-control" id="employee_ids" required>
                                    <option value="">Select Employee</option>
                                    @if(!empty($employees1))
                                        @foreach($employees1 as $row)
                                            <option value="{{$row->id}}">{{$row->first_name}} {{$row->last_name}}</option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                        </div>

                        <div class="col" >
                            <div class="form-group">
                               <label>Department</label><span class="text-danger pl-1">*</span>
                               <select name="department_id" required class="form-control" id="department_id" required>
                                    <option value="">Select Department</option>
                                    @if(!empty($departments))
                                        @foreach($departments as $department)
                                            <option value="{{$department->id}}">{{$department->name}}</option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                        </div>


                        <div class="col-auto">
                            <div class="form-group">
                              <label class="w-100">&nbsp;</label>
                              {{Form::submit(__('Apply'),array('class'=>'btn btn-success'))}}
                              <a href="{{url('balance_leave')}}" class="btn btn-danger">{{__('Reset')}}</a>
                            </div>
                        </div>
                    </div>
                </form>
                <hr>
                <div class="table-responsive">
                    <table class="table table-striped mb-0" id="dataTable">
                        <thead>
                        <tr>

                            <th>{{__('Employee Name')}}</th>
                            <th>{{__('Department')}}</th>
                            <?php $leave_type_array=array();?>
                            @if(!empty($leavetypes))
                                @foreach($leavetypes as $row1)

                                <?php $leave_type_array[]=$row1->id;?>
                                <th>{{$row1->title}}</th>
                                @endforeach
                            @endif

                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($employees as $employee)

                        <?php


                        $get_employee_details=DB::table('employees')->where("id",$employee->id)->first();


                        $get_department_details=DB::table('departments')->where("id",$employee->department_id)->first();

                        ?>
                            <tr>

                            <td>{{$employee->first_name}} {{$employee->last_name}}</td>
                            <td>{{$get_department_details->name}}</td>

                                @if(!empty($leave_type_array))
                                    @foreach($leave_type_array as $row2)
                                    @php  $get_employee_leave=DB::table('employee_manage_leave')->where("employee_id",$employee->id)->where("leave_type_id",$row2)->first(); @endphp
                                    <td>
                                        @if(!empty($get_employee_leave))
                                        <?php
                                                $employee_leave=DB::table('leaves')->where("leave_type_id",$row2) ->where("employee_id",$employee->id)->where("status","Approve")->groupBy('leave_type_id')->sum('total_leave_days');
                                                ?>
                                        {{$get_employee_leave->total_leaves-$employee_leave}}


                                        @else
                                        <?php

                                                $employee_leave1=DB::table('leaves')->where("leave_type_id",$row2) ->where("employee_id",$employee->id)->where("status","Approve")->groupBy('leave_type_id')->sum('total_leave_days');
                                                $global_leave=DB::table('leave_types')->where("id",$row2)->first();
                                                ?>
                                                {{$global_leave->leaves_days-$employee_leave1}}
                                        @endif

                                        </td>

                                    @endforeach
                                @endif

                            </tr>
                        @endforeach
                        </tbody>
                    </table>


                </div>
                {{ $leaves->links() }}
            </div>
        </div>
    </div>
</div>

@endsection

@push('script-page')

@endpush
