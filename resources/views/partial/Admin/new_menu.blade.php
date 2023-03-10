@php
    $logo=asset(Storage::url('uploads/logo/'));
 $company_logo=Utility::getValByName('company_logo');
 $company_small_logo=Utility::getValByName('company_small_logo');
@endphp

<div class="topnav">
    <div class="container-fluid">
        <nav class="navbar navbar-light navbar-expand-lg topnav-menu">

            <div class="collapse navbar-collapse" id="topnav-menu-content">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('home*') ? 'active' : '' }}" href="{{ route('home') }}">
                            <i class="fe-airplay mr-1"></i> {{ __('Dashboard') }}
                        </a>
                    </li>
                    @if(\Auth::user()->type=='super admin')
                        <li class="nav-item">
                            <a class="nav-link {{ request()->is('user*') ? 'active' : '' }}" href="{{ route('user.index') }}">
                                <i class="fe-database mr-1"></i> {{ __('Company') }}
                            </a>
                        </li>
                    @else
                        @if( Gate::check('Manage User') || Gate::check('Manage Role') || Gate::check('Manage Employee Profile')  || Gate::check('Manage Employee Last Login'))

                        <li class="nav-item dropdown {{ (Request::route()->getName() == 'user.index' || Request::route()->getName() == 'roles.index' || Request::route()->getName() == 'permissions.index' || Request::route()->getName() == 'employee.profile' || Request::route()->getName() == 'lastlogin') || request()->is('team*') ? 'active' : '' }}">
                            <a class="nav-link dropdown-toggle arrow-none" href="#" id="topnav-apps" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fe-layers mr-1"></i> {{ __('Staff') }} <div class="arrow-down"></div>
                            </a>
                            <div class="dropdown-menu" aria-labelledby="topnav-apps">
                              @can('Manage User')
                                  <a class="dropdown-item {{ request()->is('user*') ? 'active' : '' }}" href="{{ route('user.index') }}">{{ __('User') }}</a>
                              @endcan
                              @can('Manage Role')
                                  <a class="dropdown-item {{ request()->is('roles*') ? 'active' : '' }}" href="{{ route('roles.index') }}">{{ __('Role') }}</a>
                              @endcan


                              <a class="dropdown-item {{ request()->is('team*') ? 'active' : '' }}" href="{{ route('team_management.index') }}">{{ __('Team List') }}</a>


                              @if(Gate::check('Manage Employee'))
                                  @if(\Auth::user()->type =='employee')
                                      @php
                                          $employee=App\Employee::where('user_id',\Auth::user()->id)->first();
                                      @endphp
                                      <a class="dropdown-item {{ request()->is('employee*') ? 'active' : '' }}" href="{{route('employee.show',\Illuminate\Support\Facades\Crypt::encrypt($employee->id))}}">{{ __('Employee') }}</a>
                                  @else
                                      <a class="dropdown-item {{ (Request::route()->getName() == 'employee.index') ||  (Request::route()->getName() == 'employee.create') ||  (Request::route()->getName() == 'employee.edit') ||  (Request::route()->getName() == 'employee.show') ? 'active' : '' }}" href="{{route('employee.index')}}">{{ __('Employee List') }}</a>
                                  @endif
                              @endif
                              @can('Manage Employee Profile')
                                  <a class="dropdown-item {{ request()->is('employee-profile') ? 'active' : '' }}" href="{{ route('employee.profile') }}">{{ __('Employee Profile') }}</a>
                              @endcan
                              @can('Manage Employee Last Login')
                                  <a class="dropdown-item {{ request()->is('lastlogin') ? 'active' : '' }}" href="{{ route('lastlogin') }}">{{ __('Last Login') }}</a>
                              @endcan

                              @if(Gate::check('Manage Indicator') || Gate::check('Manage Appraisal') || Gate::check('Manage Goal Tracking'))
                              <div class="dropdown">
                                  <a class="dropdown-item dropdown-toggle arrow-none {{ (Request::route()->getName() == 'indicator.index' || Request::route()->getName() == 'appraisal.index' || Request::route()->getName() == 'goaltracking.index') ? 'active' : '' }}" href="#" id="topnav-performance" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                      {{ __('Performance') }} <div class="arrow-down"></div>
                                  </a>
                                  <div class="dropdown-menu" aria-labelledby="topnav-performance">
                                    @can('Manage Indicator')
                                        <a class="dropdown-item {{ request()->is('indicator*') ? 'active' : '' }}" href="{{ route('indicator.index') }}">{{ __('Indicator') }}</a>
                                    @endcan
                                    @can('Manage Appraisal')
                                        <a class="dropdown-item {{ request()->is('appraisal*') ? 'active' : '' }}" href="{{ route('appraisal.index') }}">{{ __('Appraisal') }}</a>
                                    @endcan
                                    @can('Manage Goal Tracking')
                                        <a class="dropdown-item {{ request()->is('goaltracking*') ? 'active' : '' }}" href="{{ route('goaltracking.index') }}">{{ __('Goal Tracking') }}</a>
                                    @endcan
                                  </div>
                              </div>
                              @endif

                              @if(Gate::check('Manage Trainer') || Gate::check('Manage Training'))
                                <div class="dropdown">
                                    <a class="dropdown-item dropdown-toggle arrow-none {{ (Request::route()->getName() == 'trainer.index' || Request::route()->getName() == 'training.index' || Request::route()->getName() == 'training.show') ? 'active' : '' }}" href="#" id="topnav-training" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        {{ __('Training') }} <div class="arrow-down"></div>
                                    </a>
                                    <div class="dropdown-menu" aria-labelledby="topnav-training">
                                      @can('Manage Training')
                                          <a class="dropdown-item {{ request()->is('training*') ? 'active' : '' }}" href="{{ route('training.index') }}">{{ __('Training List') }}</a>
                                      @endcan
                                      @can('Manage Trainer')
                                          <a class="dropdown-item {{ request()->is('trainer*') ? 'active' : '' }}" href="{{ route('trainer.index') }}">{{ __('Trainer') }}</a>
                                      @endcan
                                    </div>
                                </div>
                              @endif

                            </div>
                        </li>
                        @endif
                    @endif




                    @if(Gate::check('Manage Set Salary') || Gate::check('Manage Pay Slip') || Gate::check('Manage Monthly Grade') || Gate::check('Manage Allowance Option') || Gate::check('Commission') || Gate::check('Manage Bonus') || Gate::check('Manage Bonus Commission Type') || Gate::check('Manage Increment') || Gate::check('Manage Promotion'))
                        <li class="nav-item dropdown">
                          <a class="nav-link dropdown-toggle arrow-none {{ (Request::route()->getName() == 'bonus.index' || Request::route()->getName() == 'bonuscommission.index' || Request::route()->getName() == 'setsalary.index' || Request::route()->getName() == 'setsalary.show' || Request::route()->getName() == 'commission.index' || Request::route()->getName() == 'monthly_grade.index' || Request::route()->getName() == 'allowanceoption.index'  ||  Request::route()->getName() == 'payslip.index' || Request::route()->getName() == 'payslip.employeepayslip' || Request::route()->getName() == 'setsalary.edit' || Request::route()->getName() == 'employeesalary' || Request::route()->getName() == 'payslip.employeepayslip' || Request::route()->getName() == 'payslip.pdf') ? 'active' : '' }}" href="#" id="topnav-ui" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                              <i class="fe-briefcase mr-1"></i> {{ __('Payroll') }} <div class="arrow-down"></div>
                          </a>

                          <div class="dropdown-menu" aria-labelledby="topnav-ui">
                            @can('Manage Increment')
                                <a class="dropdown-item {{ (Request::route()->getName() == 'increment.index') ||  (Request::route()->getName() == 'increment.create') ||  (Request::route()->getName() == 'increment.edit') ? 'active' : '' }}" href="{{route('increment.index')}}">{{ __('Increments') }}</a>
                            @endcan

                            @can('Manage Promotion')
                                <a class="dropdown-item {{ request()->is('promotion*') ? 'active' : '' }}" href="{{ route('promotion.index') }}">{{ __('Promotion') }}</a>
                            @endcan
                            @can('Manage Allowance Option')
                                <a class="dropdown-item {{ request()->is('allowanceoption*') ? 'active' : '' }}" href="{{ route('allowanceoption.index') }}">{{ __('Allowance') }}</a>
                            @endcan

                            @can('Commission')
                                <a class="dropdown-item {{ request()->is('commission*') ? 'active' : '' }}" href="{{ route('commission.index') }}">{{ __('Commission') }}</a>
                            @endcan
                            @can('Claim')
                                <a class="dropdown-item {{ request()->is('claim*') ? 'active' : '' }}" href="{{ route('claim.index') }}">{{ __('Claim') }}</a>
                            @endcan

                            @can('Manage Bonus')
                                <a class="dropdown-item {{ request()->is('bonus') ? 'active' : '' }}" href="{{ route('bonus.index') }}">{{ __('Bonus') }}</a>
                            @endcan
                            @can('Manage Bonus Commission Type')
                                <a class="dropdown-item {{ request()->is('bonuscommission*') ? 'active' : '' }}" href="{{ route('bonuscommission.index') }}">{{ __('Bonus Comminsion Type') }}</a>
                            @endcan
                              <a class="dropdown-item {{ request()->is('cpf*') ? 'active' : '' }}" href="{{ route('cpf.index') }}">{{ __('CPF') }}</a>
                            @can('Shift Type')
                                <a class="dropdown-item {{ request()->is('shift_type*') ? 'active' : '' }}" href="{{ route('shift_type.index') }}">{{ __('Shift Managment') }}</a>
                            @endcan
                            @can('Roaster')
                                <a class="dropdown-item {{ request()->is('roaster*') ? 'active' : '' }}" href="{{ route('roaster.index') }}">{{ __('Shift Roster') }}</a>
                            @endcan

                            @if(\Auth::user()->type=='employee')
                              <a class="dropdown-item {{ (Request::segment(2) == 'employeeSalary' || Request::segment(1) == 'setsalary') ? 'active' : '' }}" href="{{ route('employeesalary') }}">{{ __('My Salary') }}</a>

                              <a class="dropdown-item {{ (Request::segment(2) == 'employeepayslip') ? 'active' : '' }}" href="{{ route('payslip.employeepayslip') }}">{{ __('Payslip') }}</a>
                            @endif

                            @can('Manage Monthly Grade')
                                <a class="dropdown-item {{ request()->is('monthly_grade*') ? 'active' : '' }}" href="{{ route('monthly_grade.index') }}">{{ __('Monthly Pay Grade') }}</a>
                            @endcan

                            @can('Manage Monthly Grade')
                                <a class="dropdown-item {{ request()->is('daily_grade*') ? 'active' : '' }}" href="{{ route('daily_grade.index') }}">{{ __('Daily Pay Grade') }}</a>
                            @endcan
                            @can('Manage Monthly Grade')
                                <a class="dropdown-item {{ request()->is('hourly_grade*') ? 'active' : '' }}" href="{{ route('hourly_grade.index') }}">{{ __('Hourly Pay Grade') }}</a>
                            @endcan

                            @can('Manage Set Salary')
                                <a class="dropdown-item {{ request()->is('setsalary*') ? 'active' : '' }}" href="{{ route('setsalary.index') }}">{{ __('Set Salary') }}</a>
                            @endcan
                            @can('Manage Pay Slip')
                                <a class="dropdown-item {{ request()->is('payslip*') ? 'active' : '' }}" href="{{ route('payslip.index') }}">{{ __('Payslip') }}</a>
                            @endcan

                          </div>
                        </li>
                    @endif


                    @if( Gate::check('Manage Attendance') || Gate::check('Manage Leave') || Gate::check('Manage TimeSheet') || Gate::check('Manage Holiday'))

                    <li class="nav-item dropdown {{ (Request::route()->getName() == 'attendanceemployee.index' || Request::route()->getName() == 'leave.index'  || Request::route()->getName() == 'timesheet.index' || Request::route()->getName() == 'attendanceemployee.bulkattendance') ? 'active' : '' }}">

                        <a class="nav-link dropdown-toggle arrow-none" href="#" id="topnav-Leave" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fe-box mr-1"></i> {{ __('Leave') }} <div class="arrow-down"></div>
                        </a>
                        <div class="dropdown-menu" aria-labelledby="topnav-components">
                          @can('Manage TimeSheet')
                              <a class="dropdown-item {{ request()->is('timesheet*') ? 'active' : '' }}" href="{{ route('timesheet.index') }}">{{ __('Timesheet') }}</a>
                          @endcan
                          @can('Manage Leave')
                              <a class="dropdown-item {{ request()->is('leave*') ? 'active' : '' }}" href="{{ route('leave.index') }}">{{ __('Manage Leave') }}</a>

                              <a class="dropdown-item {{ request()->is('balance_leave*') ? 'active' : '' }}" href="{{ url('balance_leave') }}">{{ __('Manage Leave Balance') }}</a>

                              <a class="dropdown-item {{ request()->is('leave_sumary*') ? 'active' : '' }}" href="{{ url('leave_sumary') }}">{{ __('Leave Summary Report') }}</a>
                          @endcan
                          @can('Manage Holiday')
                              <a class="dropdown-item {{ request()->is('holiday*') ? 'active' : '' }}" href="{{ route('holiday.index') }}">{{ __('Preset Public Holidays') }}</a>
                          @endcan
                          @can('Manage Attendance')
                              <div class="dropdown">
                                  <a class="dropdown-item dropdown-toggle arrow-none {{ (Request::route()->getName() == 'attendanceemployee.index' || Request::route()->getName() == 'attendanceemployee.bulkattendance') ? 'active' : '' }}" href="#" id="topnav-charts" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                      {{ __('Attendance') }} <div class="arrow-down"></div>
                                  </a>
                                  <div class="dropdown-menu" aria-labelledby="topnav-charts">
                                      <a class="dropdown-item {{ (Request::route()->getName() == 'attendanceemployee.index') ? 'active' : '' }}" href="{{ route('attendanceemployee.index') }}">{{ __('Attendance') }}</a>
                                    @can('Create Attendance')
                                        <a class="dropdown-item {{ (Request::route()->getName() == 'attendanceemployee.bulkattendance') ? 'active' : '' }}" href="{{ route('attendanceemployee.bulkattendance') }}">{{ __('Bulk Attendance') }}</a>
                                    @endcan
                                  </div>
                              </div>
                          @endcan
                        </div>
                    </li>
                    @endif



                    @if(Gate::check('Manage Account List') || Gate::check('Manage Payee')  || Gate::check('Manage Payer')  || Gate::check('Manage Deposit') || Gate::check('Manage Expense') || Gate::check('Manage Transfer Balance'))
                        <li class="nav-item dropdown {{ (Request::route()->getName() == 'accountlist.index' || Request::route()->getName() == 'accountbalance' || Request::route()->getName() == 'payees.index' || Request::route()->getName() == 'payer.index' || Request::route()->getName() == 'deposit.index' || Request::route()->getName() == 'expense.index' || Request::route()->getName() == 'transferbalance.index' || Request::route()->getName() == 'viewtransaction.index') ? 'active' : '' }}">

                            <a class="nav-link dropdown-toggle arrow-none" href="#" id="topnav-finance" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fe-layers mr-1"></i> {{ __('Finance') }} <div class="arrow-down"></div>
                            </a>
                            <div class="dropdown-menu" aria-labelledby="topnav-finance">
                              @can('Manage Account List')
                                  <a class="dropdown-item {{ request()->is('accountlist*') ? 'active' : '' }}" href="{{ route('accountlist.index') }}">{{ __('Account List') }}</a>
                              @endcan
                              @can('View Balance Account List')
                                  <a class="dropdown-item {{ request()->is('accountbalance*') ? 'active' : '' }}" href="{{ route('accountbalance') }}">{{ __('Account Balance') }}</a>
                              @endcan

                              @can('Manage Payee')
                                  <a class="dropdown-item {{ request()->is('payees*') ? 'active' : '' }}" href="{{ route('payees.index') }}">{{ __('Payees') }}</a>
                              @endcan
                              @can('Manage Payer')
                                  <a class="dropdown-item {{ request()->is('payer*') ? 'active' : '' }}" href="{{ route('payer.index') }}">{{ __('Payers') }}</a>
                              @endcan
                              @can('Manage Deposit')
                                  <a class="dropdown-item {{ request()->is('deposit*') ? 'active' : '' }}" href="{{ route('deposit.index') }}">{{ __('Deposit') }}</a>
                              @endcan
                              @can('Manage Expense')
                                  <a class="dropdown-item {{ request()->is('expense*') ? 'active' : '' }}" href="{{ route('expense.index') }}">{{ __('Expense') }}</a>
                              @endcan
                              @can('Manage Transfer Balance')
                                  <a class="dropdown-item {{ request()->is('transferbalance*') ? 'active' : '' }}" href="{{ route('transferbalance.index') }}">{{ __('Transfer Balance') }}</a>
                              @endcan
                            </div>
                        </li>
                    @endif

                    @if(Gate::check('Manage Awards') || Gate::check('Manage Transfer') || Gate::check('Manage Resignation')  || Gate::check('Manage Travels') ||  Gate::check('Manage Complaint')|| Gate::check('Manage Warning') || Gate::check('Manage Termination') || Gate::check('Manage Announcement'))
                      <li class="nav-item dropdown {{ (Request::route()->getName() == 'award.index' ||  Request::route()->getName() == 'transfer.index' || Request::route()->getName() == 'resignation.index' || Request::route()->getName() == 'travel.index' ||   Request::route()->getName() == 'complaint.index' || Request::route()->getName() == 'warning.index' || Request::route()->getName() == 'termination.index'
                      || Request::route()->getName() == 'holiday.index'  || Request::route()->getName() == 'announcement.index' ) ? 'active' : '' }}">

                          <a class="nav-link dropdown-toggle arrow-none" href="#" id="topnav-hr" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                              <i class="fe-layers mr-1"></i> {{ __('HR') }} <div class="arrow-down"></div>
                          </a>
                          <div class="dropdown-menu" aria-labelledby="topnav-hr">
                            @can('Manage Award')
                                <a class="dropdown-item {{ request()->is('award*') ? 'active' : '' }}" href="{{ route('award.index') }}">{{ __('Award') }}</a>
                            @endcan
                            @can('Manage Transfer')
                                <a class="dropdown-item {{ request()->is('transfer*') ? 'active' : '' }}" href="{{ route('transfer.index') }}">{{ __('Transfer') }}</a>
                            @endcan
                            @can('Manage Resignation')
                                <a class="dropdown-item {{ request()->is('resignation*') ? 'active' : '' }}" href="{{ route('resignation.index') }}">{{ __('Resignation') }}</a>
                            @endcan
                            @can('Manage Travel')
                                <a class="dropdown-item {{ request()->is('travel*') ? 'active' : '' }}" href="{{ route('travel.index') }}">{{ __('Trip') }}</a>
                            @endcan

                            @can('Manage Complaint')
                                <a class="dropdown-item {{ request()->is('complaint*') ? 'active' : '' }}" href="{{ route('complaint.index') }}">{{ __('Complaints') }}</a>
                            @endcan
                            @can('Manage Warning')
                                <a class="dropdown-item {{ request()->is('warning*') ? 'active' : '' }}" href="{{ route('warning.index') }}">{{ __('Warning') }}</a>
                            @endcan
                            @can('Manage Termination')
                                <a class="dropdown-item {{ request()->is('termination*') ? 'active' : '' }}" href="{{ route('termination.index') }}">{{ __('Termination') }}</a>
                            @endcan
                            @can('Manage Announcement')
                                <a class="dropdown-item {{ request()->is('announcement*') ? 'active' : '' }}" href="{{ route('announcement.index') }}">{{ __('Announcement') }}</a>
                            @endcan
                          </div>
                      </li>
                    @endif

                    <li class="nav-item dropdown ">
                        <a class="nav-link dropdown-toggle arrow-none" href="#" id="topnav-others" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fe-layers mr-1"></i> {{ __('Others') }} <div class="arrow-down"></div>
                        </a>
                        <div class="dropdown-menu" aria-labelledby="topnav-others">
                          @if(Gate::check('Manage Report'))
                              <div class="dropdown">
                                  <a class="dropdown-item dropdown-toggle arrow-none {{ (Request::route()->getName() == 'report.income-expense' || Request::route()->getName() == 'report.leave' || Request::route()->getName() == 'report.account.statement' || Request::route()->getName() == 'report.payroll' || Request::route()->getName() == 'report.monthly.attendance' || Request::route()->getName() == 'report.timesheet' ) ? 'active' : '' }}" href="#" id="topnav-report" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> {{ __('Report') }} <div class="arrow-down"></div>
                                  </a>
                                  <div class="dropdown-menu" aria-labelledby="topnav-report">

                                    @can('Manage Report')
                                        <a class="dropdown-item {{ request()->is('report/income-expense') ? 'active' : '' }}" href="{{ route('report.income-expense') }}">{{ __('Income Vs Expense') }}</a>

                                        <a class="dropdown-item {{ request()->is('report/monthly/attendance') ? 'active' : '' }}" href="{{ route('report.monthly.attendance') }}">{{ __('Monthly Attendance') }}</a>

                                        <a class="dropdown-item {{ request()->is('report/leave') ? 'active' : '' }}" href="{{ route('report.leave') }}">{{ __('Leave') }}</a>

                                        <a class="dropdown-item {{ request()->is('report/account-statement') ? 'active' : '' }}" href="{{ route('report.account.statement') }}">{{ __('Account Statement') }}</a>

                                        <a class="dropdown-item {{ request()->is('report/payroll') ? 'active' : '' }}" href="{{ route('report.payroll') }}">{{ __('Payroll') }}</a>

                                        <a class="dropdown-item {{ request()->is('report/timesheet') ? 'active' : '' }}" href="{{ route('report.timesheet') }}">{{ __('Timesheet') }}</a>
                                    @endcan
                                  </div>
                              </div>
                          @endif

                          @if(Gate::check('Manage Department') || Gate::check('Manage Designation')  || Gate::check('Manage Document Type')  || Gate::check('Manage Branch') || Gate::check('Manage Award Type') || Gate::check('Manage Termination Types')|| Gate::check('Manage Payslip Type') ||  Gate::check('Manage Loan Options')  || Gate::check('Manage Deduction Options') || Gate::check('Manage Expense Type')  || Gate::check('Manage Income Type') || Gate::check('Manage
                           Payment Type')  || Gate::check('Manage Leave Type') || Gate::check('Manage Training Type'))

                           <div class="dropdown">
                              <a class="dropdown-item dropdown-toggle arrow-none {{ (Request::route()->getName() == 'department.index' || Request::route()->getName() == 'designation.index' || Request::route()->getName() == 'document.index' || Request::route()->getName() == 'branch.index' || Request::route()->getName() == 'awardtype.index' || Request::route()->getName() == 'terminationtype.index' || Request::route()->getName() == 'paysliptype.index' ||  Request::route()->getName() == 'loanoption.index' || Request::route()->getName() == 'deductionoption.index' || Request::route()->getName() == 'expensetype.index' || Request::route()->getName() == 'incometype.index'|| Request::route()->getName() == 'paymenttype.index' || Request::route()->getName() == 'leavetype.index' || Request::route()->getName() == 'goaltype.index' || Request::route()->getName() == 'trainingtype.index' || Request::route()->getName() == 'trainingtype.index') ? 'active' : '' }}" href="#" id="topnav-constant" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> {{ __('Constant') }} <div class="arrow-down"></div>
                               </a>
                               <div class="dropdown-menu" aria-labelledby="topnav-constant">

                                 @can('Manage Branch')
                                     <a class="dropdown-item {{ request()->is('branch*') ? 'active' : '' }}" href="{{ route('branch.index') }}">{{ __('Branch') }}</a>
                                 @endcan
                                 @can('Manage Department')
                                     <a class="dropdown-item {{ request()->is('department*') ? 'active' : '' }}" href="{{ route('department.index') }}">{{ __('Department') }}</a>
                                 @endcan
                                 @can('Manage Designation')
                                     <a class="dropdown-item {{ request()->is('designation*') ? 'active' : '' }}" href="{{ route('designation.index') }}">{{ __('Designation') }}</a>
                                 @endcan

                                 <a class="dropdown-item {{ request()->is('responsbilites*') ? 'active' : '' }}" href="{{ route('responsbilites.index') }}">{{ __('Job Responsbilites') }}</a>

                                 @can('Manage Document Type')
                                     <a class="dropdown-item {{ request()->is('document*') ? 'active' : '' }}" href="{{ route('document.index') }}">{{ __('Document Type') }}</a>
                                 @endcan

                                 @can('Manage Award Type')
                                     <a class="dropdown-item {{ request()->is('awardtype*') ? 'active' : '' }}" href="{{ route('awardtype.index') }}">{{ __('Award Type') }}</a>
                                 @endcan
                                 @can('Manage Termination Types')
                                     <a class="dropdown-item {{ request()->is('terminationtype*') ? 'active' : '' }}" href="{{ route('terminationtype.index') }}">{{ __('Termination Type') }}</a>
                                 @endcan
                                 @can('Manage Payslip Type')
                                     <a class="dropdown-item {{ request()->is('paysliptype*') ? 'active' : '' }}" href="{{ route('paysliptype.index') }}">{{ __('Payslip Type') }}</a>
                                 @endcan

                                 @can('Manage Loan Option')
                                     <a class="dropdown-item {{ request()->is('loanoption*') ? 'active' : '' }}" href="{{ route('loanoption.index') }}">{{ __('Loan Option') }}</a>
                                 @endcan
                                 @can('Manage Deduction Option')
                                     <a class="dropdown-item {{ request()->is('deductionoption*') ? 'active' : '' }}" href="{{ route('deductionoption.index') }}">{{ __('Deduction Option') }}</a>
                                 @endcan
                                 @can('Manage Expense Type')
                                     <a class="dropdown-item {{ request()->is('expensetype*') ? 'active' : '' }}" href="{{ route('expensetype.index') }}">{{ __('Expense Type') }}</a>
                                 @endcan
                                 @can('Manage Income Type')
                                     <a class="dropdown-item {{ request()->is('incometype*') ? 'active' : '' }}" href="{{ route('incometype.index') }}">{{ __('Income Type') }}</a>
                                 @endcan
                                 @can('Manage Payment Type')
                                     <a class="dropdown-item {{ request()->is('paymenttype*') ? 'active' : '' }}" href="{{ route('paymenttype.index') }}">{{ __('Payment Type') }}</a>
                                 @endcan
                                 @can('Manage Leave Type')
                                     <a class="dropdown-item {{ request()->is('leavetype*') ? 'active' : '' }}" href="{{ route('leavetype.index') }}">{{ __('Leave Type') }}</a>
                                 @endcan
                                 @can('Manage Termination Type')
                                     <a class="dropdown-item {{ request()->is('terminationtype*') ? 'active' : '' }}" href="{{ route('terminationtype.index') }}">{{ __('Termination Type') }}</a>
                                 @endcan
                                 @can('Manage Goal Type')
                                     <a class="dropdown-item {{ request()->is('goaltype*') ? 'active' : '' }}" href="{{ route('goaltype.index') }}">{{ __('Goal Type') }}</a>
                                 @endcan
                                 @can('Manage Training Type')
                                     <a class="dropdown-item {{ request()->is('trainingtype*') ? 'active' : '' }}" href="{{ route('trainingtype.index') }}">{{ __('Training Type') }}</a>
                                 @endcan
                               </div>
                           </div>
                          @endif

                          @can('Manage Ticket')
                              <a class="dropdown-item {{ request()->is('ticket*') ? 'active' : '' }}" href="{{route('ticket.index')}}">{{ __('Ticket') }}</a>
                          @endcan
                          @can('Manage Event')
                              <a class="dropdown-item {{ request()->is('event*') ? 'active' : '' }}" href="{{route('event.index')}}">{{ __('Event') }}</a>
                          @endcan
                          @can('Manage Meeting')
                              <a class="dropdown-item {{ request()->is('meeting*') ? 'active' : '' }}" href="{{route('meeting.index')}}">{{ __('Meeting') }}</a>
                          @endcan
                          @if(Gate::check('Manage Assets'))
                              <a class="dropdown-item {{ (Request::segment(1) == 'account-assets')?'active':''}}" href="{{ route('account-assets.index') }}">{{__('Assets')}}</a>
                          @endif
                          @if(Gate::check('Manage Document'))
                            <a class="dropdown-item {{ (Request::segment(1) == 'document-upload')?'active':''}}" href="{{ route('document-upload.index') }}">{{__('Document')}}</a>
                          @endif
                          @if(Gate::check('Manage Company Policy'))
                              <a class="dropdown-item {{ (Request::segment(1) == 'company-policy')?'active':''}}" href="{{ route('company-policy.index') }}">{{__('Company Policy')}}</a>
                          @endif
                          @if(Gate::check('Manage Plan'))
                              <a class="dropdown-item {{ request()->is('plans*') ? 'active' : '' }}" href="{{route('plans.index')}}">{{ __('Plan') }}</a>
                          @endif
                          @if(Gate::check('manage coupon'))
                              <a class="dropdown-item {{ (Request::segment(1) == 'coupons')?'active':''}}" href="{{ route('coupons.index') }}">{{__('Coupon')}}</a>
                          @endif
                          @if(Gate::check('Manage Order'))
                              <a class="dropdown-item {{ request()->is('orders*') ? 'active' : '' }}" href="{{route('order.index')}}">{{ __('Order') }}</a>
                          @endif

                        </div>
                    </li>





                    @if(Auth::user()->type != 'super admin')
                        <li class="nav-item">
                            <a class="nav-link {{ (Request::route()->getName() == 'messages') ? 'active' : '' }}" href="{{ url('messages') }}">
                                <i class="fe-database mr-1"></i> {{__('Messenger')}}
                            </a>
                        </li>
                    @endif

                    @if(Gate::check('Manage Company Settings') || Gate::check('Manage System Settings'))
                        <li class="nav-item">
                            <a class="nav-link {{ request()->is('settings*') ? 'active' : '' }}" href="{{route('settings.index')}}">
                                <i class="fe-database mr-1"></i> {{ __('System Setting') }}
                            </a>
                        </li>
                    @endif
                </ul> <!-- end navbar-->
            </div> <!-- end .collapsed-->
        </nav>
    </div> <!-- end container-fluid -->
</div> <!-- end topnav-->
