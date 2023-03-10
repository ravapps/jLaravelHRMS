@extends('layouts.dashboard')
@section('page-title')
    {{__('Payslip')}}
@endsection
@section('content')

<div class="row mt-4">
    <div class="col-12">
        <div class="page-title-box-hori">
            <h4 class="page-title">{{__('Employee Salary')}}</h4>
            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                  <li class="breadcrumb-item"><a href="{{__('home')}}">{{__('Dashboard')}}</a></li>
                  <!-- <li class="breadcrumb-item"><a href="{{route('employee.index')}}">{{__('Pay Grade')}}</a></li> -->
                  <li class="breadcrumb-item active">{{__('Salary')}}</li>
                </ol>
            </div>
        </div>
    </div>
</div>
<hr class="mt-0">


<div class="row">
    <div class="col-12">

        <div class="card">
            <!-- <div class="card-header">
                <div class="d-flex justify-content-between w-100">
                    <h4>{{__('Employee Salary')}}</h4>

                </div>
            </div> -->
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped mb-0" id="dataTable1">
                        <thead>
                        <tr>
                            <th>{{__('Name')}}</th>
                            <th>{{__('Payroll Month') }}</th>
                            <th>{{__('Salary') }}</th>
                            <th>{{__('Net Salary') }}</th>
                            <th>{{__('Status') }}</th>
                            <th class="" width="200px">{{__('Action')}}</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($payslip as $payslip)
                            <tr>
                                <td>{{!empty( \App\PaySlip::employee($payslip->employee_id))? \App\PaySlip::employee($payslip->employee_id)->name:'' }}</td>
                                <td>{{ $payslip->salary_month }}</td>
                                <td>{{ $payslip->basic_salary }}</td>
                                <td>{{ $payslip->net_payble }}</td>
                                <td>
                                    @if($payslip->status == 1)
                                        <div class="badge badge-success"><a class="text-white">{{__('Paid')}}</a></div> @else
                                        <div class="badge badge-danger"><a class="text-white">{{__('Unpaid')}}</a></div>
                                    @endif
                                </td>
                                <td>
                                    <a href="#" data-url="{{ route('payslip.showemployee',$payslip->id) }}" class="btn btn-icon icon-left btn-success" data-ajax-popup="true" data-toggle="tooltip" data-title="{{__('View Employee Detail')}}" data-original-title="{{__('View Employee Detail')}}">
                                        {{__('View')}}
                                    </a>
                                    <a href="#" data-url="{{ route('payslip.pdf',[$payslip->employee_id,$payslip->salary_month]) }}" data-size="md-pdf" class="btn btn-icon icon-left btn-success" data-ajax-popup="true" data-toggle="tooltip" data-title="{{__('Payslip')}}" data-original-title="{{__('Payslip')}}">
                                        {{__('Payslip')}}
                                    </a>
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
