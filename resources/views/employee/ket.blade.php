@extends('layouts.dashboard')
@section('page-title')
    {{__('Employee')}}
@endsection
@section('content')

<div class="row mt-4">
    <div class="col-12">
        <div class="page-title-box-hori">
            <h4 class="page-title">{{__('KET')}}</h4>
            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item"><a href="{{__('home')}}">{{__('Dashboard')}}</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('employee.index') }}">{{__('Employee')}}</a></li>
                    <li class="breadcrumb-item active">{{__('KET')}}</li>
                </ol>
            </div>
        </div>
    </div>
</div>
@php $dayofthsalary = 7; @endphp
<div class="row">
    <div class="col-12">
        <div class="card">

            <div class="card-body">
              <div class="d-flex space-between">
                <h4>Key Employment Terms Issued on: {{$employee->created_at}}</h4>
              </div>
              <div class="row mt-2">
                <div class="col-lg-12 col-md-12 col-sm-12 col-12 d-flex" style="background-color: gray;">
                  <h4 style="color:white;" class="m-0 pt-1 pb-1">Section A | Details of Employment</h4>
                </div>
              </div>
              <div class="row mt-3">
                <div class="col-lg-6 col-md-12 col-sm-12 col-12 d-flex">
                  <div class="flex-fill">
                    <ul class="personal-info">
                      <li>
                        <div class="title">Company Name</div>
                        <div class="text">{{$employee->company}}</div>
                      </li>
                      <li>
                        <div class="title">Employee Name</div>
                        <div class="text">{{$employee->name}}</div>
                      </li>
                      <li>
                        <div class="title">Employee NRIC/FIN</div>
                        <div class="text">{{$employee->identifications_no}}</div>
                      </li>
                      <li>
                        <div class="title">Employment Start Date</div>
                        <div class="text">{{$employee->company_doj}}</div>
                      </li>
                    </ul>
                  </div>
                </div>
                <div class="col-lg-6 col-md-12 col-sm-12 col-12 d-flex">
                  <div class=" flex-fill">
                    <ul class="personal-info">
                      <li>
                        <div class="title">Job Title</div>
                        <div class="text">{{$employee->designation->name}}</div>
                      </li>
                      <li>
                        <div class="title">Main Duties and Responsibilities</div>
                        <div class="text">@foreach($edt_employee_jbrs as $t)
                          {{\App\Jbr::find($t->jbr_id)->res_name}}<br>
                        @endforeach</div>
                      </li>
                      <li>
                        <div class="title">Duration of Employment</div>
                        <div class="text">{{$employee->contract_period}} Days </div>
                      </li>
                      <li>
                        <div class="title">Place of Work </div>
                        <div class="text"></div>
                      </li>
                    </ul>
                  </div>
                </div>
              </div>
              <div class="row mt-3">
                <div class="col-lg-12 col-md-12 col-sm-12 col-12 d-flex" style="background-color: gray;">
                  <h4 style="color:white;" class="m-0 pt-1 pb-1">Section B | Working Hours and Rest Days</h4>
                </div>
              </div>
              @php $stobj = \App\ShiftTypes::find($employee->shift_type);  @endphp
              <div class="row mt-3">
                <div class="col-lg-6 col-md-12 col-sm-12 col-12 d-flex">
                  <div class="flex-fill">
                    <ul class="personal-info">
                      <li>
                        <div class="title">Details of Working Hours - From</div>
                        <div class="text"> @if($stobj->weekdays == 1) Monday - Friday @endif  @if($stobj->weekdays == 2) Monday - Saturday @endif {{$stobj->start_time}} </div>
                      </li>
                      <li>
                        <div class="title">To</div>
                        <div class="text"> @if($stobj->weekdays == 1) Monday - Friday @endif  @if($stobj->weekdays == 2) Monday - Saturday @endif {{$stobj->end_time}} </div>
                      </li>
                    </ul>
                  </div>
                </div>
                <div class="col-lg-6 col-md-12 col-sm-12 col-12 d-flex">
                  <div class=" flex-fill">
                    <ul class="personal-info">
                      <li>
                        <div class="title">Number of Working Days Per Week</div>
                        <div class="text"> @if($stobj->weekdays == 1) 5 @endif @if($stobj->weekdays == 2) 6 @endif days </div>
                      </li>
                      <li>
                        <div class="title">Rest Day Per Week</div>
                        <div class="text">  @if($stobj->weekdays == 1) 2 @endif @if($stobj->weekdays == 2) 1 @endif  day </div>
                      </li>
                    </ul>
                  </div>
                </div>
              </div>
              <div class="row  mt-3">
                <div class="col-lg-12 col-md-12 col-sm-12 col-12 d-flex" style="background-color: gray;">
                  <h4 style="color:white;" class="m-0 pt-1 pb-1">Section C | Salary</h4>
                </div>
              </div>
              <div class="row mt-3">
                <div class="col-lg-6 col-md-12 col-sm-12 col-12 d-flex">
                  <div class="flex-fill">
                    <ul class="personal-info">
                      <li>
                        <div class="title">Salary Period</div>
                        <div class="text">{{$employee_salary->salary_type}}</div>
                      </li>
                      <li>
                        <div class="title">Overtime Payment Period</div>
                        <div class="text">{{\App\ShiftTypes::find($employee->shift_type)->end_time}}  - {{\App\ShiftTypes::find($employee->shift_type)->late_time}}</div>
                      </li>
                      <li>
                        <h5>Fixed Allowances Per Salary Period</h5>
                        <table class="table table-striped mb-0">
                          <thead>
                            <tr>
                              <th>Item</th>
                              <th>Allowance($)</th>
                            </tr>
                          </thead>
                          <tbody>
                            @foreach($employee_allwances as $ea)
                            @php $alwobj = \App\AllowanceOption::find($ea->allowance_id); @endphp
                            <tr>
                              <td> {{$alwobj->name}} ( {{$alwobj->al_type }} ) </td>
                              <td> {{$alwobj->percentage}} @if($alwobj->al_type == "Percentage") % @endif  @if($alwobj->limit_month > 0) upto {{$alwobj->limit_month}} per month  @endif </td>
                            </tr>
                            @endforeach
                          </tbody>
                        </table>
                      </li>
                      <li>
                        <div class="title">Other Salary-Related Components</div>
                        <div class="text">Mode: {{$employee_salary->payment_type}}</div>
                      </li>
                    </ul>
                  </div>
                </div>
                <div class="col-lg-6 col-md-12 col-sm-12 col-12 d-flex">
                  <div class=" flex-fill">
                    <ul class="personal-info">
                      <li>
                        <div class="title">Date(s) of Salary Payment</div>
                        <div class="text">{{$dayofthsalary}}th Of Every Month</div>
                      </li>
                      <li>
                        <div class="title">Basic Salary</div>
                        <div class="text">{{$employee_salary->salary_amount}}</div>
                      </li>
                      <li>
                        <h5>Fixed Deductions Per Salary Period</h5>
                        <table class="table table-striped mb-0">
                          <thead>
                            <tr>
                              <th>Item</th>
                              <th>Deduction($)</th>
                            </tr>

                          </thead>
                          <tbody>
                            @foreach($employee_deduction as $d)
                            <tr>
                              <td>{{\App\DeductionOption::find($d->deduction_id)->name}} {{$d->other_text_d}}</td>
                              <td>{{($d->deduction_amount == 0) ? $d->other_amount : $d->deduction_amount}}</td>
                            </tr>
                            @endforeach
                          </tbody>
                        </table>
                      </li>
                      <li>
                        <div class="title">CPF Contributions Payable</div>
                        <div class="text"> {{$employee_cpf->cpf_contribution}} </div>
                      </li>
                    </ul>
                  </div>
                </div>
              </div>
              <div class="row mt-3">
                <div class="col-lg-12 col-md-12 col-sm-12 col-12 d-flex" style="background-color: gray;">
                  <h4 style="color:white;" class="m-0 pt-1 pb-1">Section D | Leave and Medical Benefits</h4>
                </div>
              </div>
              <div class="row mt-3">
                <div class="col-lg-12 col-md-12 col-sm-12 col-12 d-flex">
                  <div class="flex-fill">
                    <ul class="personal-info">
                      @foreach($global_leave as $l)
                      <li class="w-50 sw-100">
                        <div class="title">{{$l->title}}</div>
                        <div class="text">{{$l->days}} <strong>(days/hrs)</strong>
                        </div>
                      </li>
                      @endforeach
                    </ul>
                  </div>
                </div>
              </div>
              <div class="row mt-3">
                <div class="col-lg-12 col-md-12 col-sm-12 col-12 d-flex" style="background-color: gray;">
                  <h4 style="color:white;" class="m-0 pt-1 pb-1">Section E | Others</h4>
                </div>
              </div>
              <div class="row mt-3">
                <div class="col-lg-6 col-md-12 col-sm-12 col-12 d-flex">
                  <div class="flex-fill">
                    <ul class="personal-info">
                      <li>
                        <div class="title">Length of Probation</div>
                        <div class="text"> @if($employee->probation_period == "Other") {{$employee->emp_other_prob}} <?php $pp = $employee->emp_other_prob; ?> @else {{$employee->probation_period}}  <?php $pp = $employee->probation_period; ?> days @endif</div>
                      </li>
                      <li>
                        <div class="title">Probation Start Date</div>
                        <div class="text">{{$employee->company_doj}}</div>
                      </li>
                      <li>
                        <div class="title">Probation End Date</div>
                        <div class="text"> <?php if(is_numeric($pp)) {
                          echo date('Y-m-d', strtotime($employee->company_doj. ' + '.$pp.' days'));
                        }  ?> </div>
                      </li>
                    </ul>
                  </div>
                </div>
                <div class="col-lg-6 col-md-12 col-sm-12 col-12 d-flex">
                  <div class="flex-fill">
                    <ul class="personal-info">
                      <li>
                        <div class="title">
                          <b>Notice Period for Termination of Employment</b>
                          <br>
                          <span class="text-muted" style="font-weight:400;">(initiated by either party whereby the length shall be the same)</span>
                        </div>
                        <div class="text">  @if($employee->notice_period == "Other") {{$employee->emp_other_notice}} @else {{$employee->notice_period}} Days @endif </div>
                      </li>
                    </ul>
                  </div>
                </div>
              </div>
            </div>
        </div>
    </div>
</div>



@endsection
@push('script-page')

@endpush
