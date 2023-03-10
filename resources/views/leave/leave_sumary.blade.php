@extends('layouts.dashboard')
@section('page-title')
    {{__('Leave')}}
@endsection
@section('content')
<div class="row mt-4">
    <div class="col-12">
        <div class="page-title-box-hori">
            <h4 class="page-title">{{__('Leave Summary Report')}}</h4>
            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item"><a href="{{__('home')}}">{{__('Dashboard')}}</a></li>
                    <li class="breadcrumb-item active">{{__('Leave Summary Report')}}</li>
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
                    <h4>{{__('Leave Summary Report')}}</h4>
                </div>
            </div> -->
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped mb-0" id="dataTable">
                        <thead>
                        <tr>

                            <th>{{__('Employee')}}</th>
                            <th>{{__('Leave Type')}}</th>
                            <!-- <th>{{__('Balance Leave')}}</th> -->
                            <th>{{__('Leave Consume')}}</th>
                            <th>{{__('Current Balance')}}</th>

                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($leaves as $leave)

                        <?php


                        $get_employee_details=DB::table('employees')->where("id",$leave->employee_id)->first();
                       $get_employee_leave=DB::table('employee_manage_leave')->where("employee_id",$leave->employee_id)->where("leave_type_id",$leave->leave_type_id)->first();
                       $employee_leave=DB::table('leaves')->where("employee_id",$leave->employee_id)->where("leave_type_id",$leave->leave_type_id)->where("status","Approve")->groupBy('leave_type_id')->sum('total_leave_days');
                        $leave_type_details=DB::table('leave_types')->where("id",$leave->leave_type_id)->first();

                        ?>
                            <tr>

                            <td>{{$get_employee_details->first_name}} {{$get_employee_details->last_name}}</td>
                            <td>{{$leave_type_details->title}}</td>
                            <td>{{$employee_leave}}</td>
                            <td>@if(!empty($get_employee_leave->total_leaves)){{$get_employee_leave->total_leaves-$employee_leave}} @else {{$leave_type_details->leaves_days-$employee_leave}} @endif</td>


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
