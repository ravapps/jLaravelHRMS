@extends('layouts.dashboard')
@section('page-title')
    {{__('Dashboard')}}
@endsection
@section('content')
    @push('css-page')
        <link rel="stylesheet" href="{{ asset('assets/modules/fullcalendar/fullcalendar.min.css') }}">
    @endpush
    @if (session('status'))
        <div class="alert alert-success" role="alert">
            {{ session('status') }}
        </div>
    @endif
    <!-- start page title -->
    <div class="row mt-4">
        <div class="col-12">
            <div class="page-title-box-hori">
                <h4 class="page-title">Dashboard</h4>
                <!-- <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Highdmin</a></li>
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Dashboard</a></li>
                        <li class="breadcrumb-item active">Dashboard</li>
                    </ol>
                </div> -->
            </div>
        </div>
    </div>
    <!-- end page title -->
    @if(\Auth::user()->type == 'employee')
        <div class="row">
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-header">
                        <h4>{{__('Event View')}}</h4>
                    </div>
                    <div class="card-body dash-card-body">
                        <div class="fc-overflow">
                            <div id="myEvent"></div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-6">
                <div class="card">
                    <div class="card-header">
                        <h4>{{__('Mark Attandance')}}</h4>
                    </div>
                    <div class="card-body dash-card-body">
                        <p class="text-muted pb-0-5">{{__('My Office Time: '.$officeTime['startTime'].' to '.$officeTime['endTime'])}}</p>
                        <center>
                            <div class="row">
                                <div class="col-md-6 float-right border-right">
                                    {{Form::open(array('url'=>'attendanceemployee/attendance','method'=>'post'))}}
                                    @if(empty($employeeAttendance) || $employeeAttendance->clock_out != '00:00:00')
                                        {{Form::submit(__('CLOCK IN'),array('class'=>'btn btn-success','name'=>'in','value'=>'0','id'=>'clock_in'))}}
                                    @else
                                        {{Form::submit(__('CLOCK IN'),array('class'=>'btn btn-success disabled','disabled','name'=>'in','value'=>'0','id'=>'clock_in'))}}
                                    @endif
                                    {{Form::close()}}
                                </div>
                                <div class="col-md-6 float-left">
                                    @if(!empty($employeeAttendance) && $employeeAttendance->clock_out == '00:00:00')
                                        {{Form::model($employeeAttendance,array('route'=>array('attendanceemployee.update',$employeeAttendance->id),'method' => 'PUT')) }}
                                        {{Form::submit(__('CLOCK OUT'),array('class'=>'btn btn-danger','name'=>'out','value'=>'1','id'=>'clock_out'))}}
                                    @else
                                        {{Form::submit(__('CLOCK OUT'),array('class'=>'btn btn-danger disabled','name'=>'out','disabled','value'=>'1','id'=>'clock_out'))}}
                                    @endif
                                    {{Form::close()}}
                                </div>
                            </div>
                        </center>

                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-header">
                        <h4>{{__('Announcement List')}}</h4>
                    </div>
                    <div class="card-body dash-card-body">
                        <div class="table-responsive">
                            <table class="table table-striped mb-0">
                                <thead>
                                <tr>
                                    <th>{{__('Title')}}</th>
                                    <th>{{__('Start Date')}}</th>
                                    <th>{{__('End Date')}}</th>
                                    <th>{{__('description')}}</th>
                                </tr>
                                </thead>
                                <tbody>
                                @forelse($announcements as $announcement)
                                    <tr>
                                        <td>{{ $announcement->title }}</td>
                                        <td>{{ \Auth::user()->dateFormat($announcement->start_date)  }}</td>
                                        <td>{{ \Auth::user()->dateFormat($announcement->end_date) }}</td>
                                        <td>{{ $announcement->description }}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4">
                                            <div class="text-center">
                                                <h6>{{__('there is no announcement')}}</h6>
                                            </div>
                                        </td>
                                    </tr>
                                @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-header">
                        <h4>{{__('Meeting List')}}</h4>
                    </div>
                    <div class="card-body dash-card-body">
                        <div class="table-responsive">
                            <table class="table table-striped mb-0">
                                <thead>
                                <tr>
                                    <th>{{__('Meeting title')}}</th>
                                    <th>{{__('Meeting Date')}}</th>
                                    <th>{{__('Meeting Time')}}</th>
                                </tr>
                                </thead>
                                <tbody>
                                @forelse($meetings as $meeting)
                                    <tr>
                                        <td>{{ $meeting->title }}</td>
                                        <td>{{ \Auth::user()->dateFormat($meeting->date) }}</td>
                                        <td>{{ \Auth::user()->timeFormat($meeting->time) }}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="3">
                                            <div class="text-center">
                                                <h6>{{__('there is no meeting schedule')}}</h6>
                                            </div>
                                        </td>
                                    </tr>
                                @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @else
        <div class="row">
          <div class="col-sm-6 col-xl-4">
              <div class="card">
                  <div class="card-body">
                      <div class="media align-items-center">
                          <div class="widget-chart-two-content media-body">
                              <p class="text-muted mb-0">{{__('TOTAL STAFF')}}</p>
                              <h3 class="mb-0">{{ $countUser +   $countEmployee}}</h3>
                          </div>
                          <div dir="ltr">
                            <div class="card-icon bg-success">
                                <i class="far fa-user"></i>
                            </div>
                          </div>
                      </div>
                      <div class="card-stats">
                          <div class="card-stats-title">
                              <div class="progreess-status mt-2">
                                  <span>{{__('USER')}} :</span>
                                  <span><strong>{{$countUser}} </strong></span>
                                  <span class="float-right"><strong>{{$countEmployee}} </strong></span>
                                  <span class="float-right">{{__('EMPLOYEE')}} :</span>
                              </div>
                          </div>
                      </div>

                  </div>
              </div>
          </div>

          <div class="col-sm-6 col-xl-4">
              <div class="card">
                  <div class="card-body">
                      <div class="media align-items-center">
                          <div class="widget-chart-two-content media-body">
                              <p class="text-muted mb-0">{{__('TOTAL TICKET')}}</p>
                              <h3 class="mb-0">{{$countTicket}}</h3>
                          </div>
                          <div dir="ltr">
                            <div class="card-icon bg-warning">
                                <i class="fas fa-ticket-alt"></i>
                            </div>
                          </div>
                      </div>
                      <div class="card-stats">
                        <div class="card-stats-title">
                          <div class="progreess-status mt-2">
                              <span>{{__('OPEN TICKET')}} :</span>
                              <span><strong>{{$countOpenTicket}} </strong></span>
                              <span class="float-right"><strong>{{$countCloseTicket}} </strong></span>
                              <span class="float-right">{{__('CLOSE TICKET')}} :</span>
                          </div>
                        </div>
                      </div>

                  </div>
              </div>
          </div>


            @if(\Auth::user()->type=='company')

            <div class="col-sm-6 col-xl-4">
                <div class="card">
                    <div class="card-body">
                        <div class="media align-items-center">
                            <div class="widget-chart-two-content media-body">
                                <p class="text-muted mb-0">{{__('ACCOUNT BALANCE')}}</p>
                                <h3 class="mb-0">{{ \Auth::user()->priceFormat($accountBalance) }}</h3>
                            </div>
                            <div dir="ltr">
                              <div class="card-icon bg-primary">
                                  <i class="fas fa-money-bill"></i>
                              </div>
                            </div>
                        </div>
                        <div class="card-stats">
                          <div class="card-stats-title">
                            <div class="progreess-status mt-2">
                                <span>{{__('PAYEE')}} :</span>
                                <span><strong>{{$totalPayer}} </strong></span>
                                <span class="float-right"><strong>{{$totalPayer}} </strong></span>
                                <span class="float-right">{{__('PAYER')}} :</span>
                            </div>
                          </div>
                        </div>

                    </div>
                </div>
            </div>
            @endif
        </div>
        <div class="row">
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-header">
                        <h4>{{__('Todays Not Clock In')}}</h4>
                    </div>
                    <div class="card-body dash-card-body">
                        <div class="table-responsive">
                            <table class="table table-striped mb-0">
                                <thead>
                                <tr>
                                    <th>{{__('Name')}}</th>
                                    <th>{{__('Status')}}</th>
                                </tr>
                                </thead>
                                <tbody>
                                @forelse($notClockIns as $notClockIn)
                                    <tr>
                                        <td>{{ $notClockIn->name }}</td>
                                        <td>
                                            <div class="badge badge-danger"><a href="#" class="text-white">{{__('Absent')}}</a></div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="2">
                                            <div class="text-center">
                                                <h6>{{__('there is no todays not clock in')}}</h6>
                                            </div>
                                        </td>
                                    </tr>
                                @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-header">
                        <h4>{{__('Announcement List')}}</h4>
                    </div>
                    <div class="card-body dash-card-body">
                        <div class="table-responsive">
                            <table class="table table-striped mb-0">
                                <thead>
                                <tr>
                                    <th>{{__('Title')}}</th>
                                    <th>{{__('Start Date')}}</th>
                                    <th>{{__('End Date')}}</th>
                                    <th>{{__('description')}}</th>
                                </tr>
                                </thead>
                                <tbody>
                                @forelse($announcements as $announcement)
                                    <tr>
                                        <td>{{ $announcement->title }}</td>
                                        <td>{{ \Auth::user()->dateFormat($announcement->start_date) }}</td>
                                        <td>{{ \Auth::user()->dateFormat($announcement->end_date) }}</td>
                                        <td>{{ $announcement->description }}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4">
                                            <div class="text-center">
                                                <h6>{{__('there is no announcement')}}</h6>
                                            </div>
                                        </td>
                                    </tr>
                                @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-header">
                        <h4>{{__('Event View')}}</h4>
                    </div>
                    <div class="card-body dash-card-body">
                        <div class="fc-overflow">
                            <div id="myEvent"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-header">
                        <h4>{{__('Meeting Schedule')}}</h4>
                    </div>
                    <div class="card-body dash-card-body">
                        <div class="table-responsive">
                            <table class="table table-striped mb-0">
                                <thead>
                                <tr>
                                    <th>{{__('Title')}}</th>
                                    <th>{{__('Date')}}</th>
                                    <th>{{__('Time')}}</th>
                                </tr>
                                </thead>
                                <tbody>
                                @forelse($meetings as $meeting)
                                    <tr>
                                        <td>{{ $meeting->title }}</td>
                                        <td>{{ \Auth::user()->dateFormat($meeting->date) }}</td>
                                        <td>{{  \Auth::user()->timeFormat($meeting->time) }}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="3">
                                            <div class="text-center">
                                                <h6>{{__('there is no meeting schedule')}}</h6>
                                            </div>
                                        </td>
                                    </tr>
                                @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif

    @push('script-page')
        <script src="{{ asset('assets/modules/fullcalendar/fullcalendar.min.js') }}"></script>

        <script>
            var arrEvents ={!! $arrEvents !!}
        </script>
        <script src="{{ asset('assets/js/page/modules-calendar.js') }}"></script>
    @endpush
@endsection
