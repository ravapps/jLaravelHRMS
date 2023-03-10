@extends('layouts.dashboard')
@section('page-title')
    {{__('Monthly Attendance')}}
@endsection
@push('script-page')
    <script type="text/javascript" src="{{ asset('js/html2pdf.bundle.min.js') }}"></script>
    <script>


        var filename = $('#filename').val();

        function saveAsPDF() {
            var element = document.getElementById('printableArea');
            var opt = {
                margin: 0.3,
                filename: filename,
                image: {type: 'jpeg', quality: 1},
                html2canvas: {scale: 4, dpi: 72, letterRendering: true},
                jsPDF: {unit: 'in', format: 'A2'}
            };
            html2pdf().set(opt).from(element).save();

        }
    </script>

@endpush
@section('content')

<div class="row mt-4">
    <div class="col-12">
        <div class="page-title-box-hori">
            <h4 class="page-title">{{__('Manage Monthly Attendance')}}</h4>
            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                  <li class="breadcrumb-item"><a href="{{__('home')}}">{{__('Dashboard')}}</a></li>
                  <!-- <li class="breadcrumb-item"><a href="{{route('employee.index')}}">{{__('Promotion')}}</a></li> -->
                  <li class="breadcrumb-item active">{{__('Monthly Attendance')}}</li>
                </ol>
            </div>
        </div>
    </div>
</div>
<hr class="mt-0">

<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                {{ Form::open(array('route' => array('report.monthly.attendance'),'method'=>'get')) }}
                <div class="row">
                    <div class="col">
                        {{Form::label('month',__('Month'))}}
                        {{Form::month('month',isset($_GET['month'])?$_GET['month']:date('Y-m'),array('class'=>'form-control'))}}
                    </div>
                    <div class="col">
                        {{ Form::label('branch', __('Branch')) }}
                        {{ Form::select('branch', $branch,isset($_GET['branch'])?$_GET['branch']:'', array('class' => 'form-control select2')) }}
                    </div>
                    <div class="col">
                        {{ Form::label('department', __('Department')) }}
                        {{ Form::select('department', $department,isset($_GET['department'])?$_GET['department']:'', array('class' => 'form-control select2')) }}
                    </div>
                    <div class="col-auto apply-btn">
                        <label class="w-100">&nbsp;</label>
                        {{Form::submit(__('Apply'),array('class'=>'btn btn-success '))}}
                        <a href="{{route('report.monthly.attendance')}}" class="btn btn-danger ">{{__('Reset')}}</a>
                        <a href="#" class="btn btn-warning  mb-1" onclick="saveAsPDF()" id="">{{__('Download')}}</a>
                    </div>
                </div>
                {{ Form::close() }}
            </div>
        </div>
    </div>
</div>
<div id="printableArea">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
              <div class="card-body">
                  <input type="hidden" value="{{  $data['branch'] .' '.__('Branch') .' '.$data['curMonth'].' '.__('Attendance Report of').' '. $data['department'].' '.'Department'}}" id="filename">

                  <div class="row">
                      <div class="col">
                          <h5>{{__('Report')}} : {{__('Attendance Summary')}}</h5>
                      </div>
                      @if($data['branch']!='All')
                          <div class="col">
                              <h5>{{__('Branch')}} : {{($data['branch']) }}</h5>
                          </div>
                      @endif
                      @if($data['department']!='All')
                          <div class="col">
                              <h5>{{__('Department')}} : {{$data['department'] }}</h5>
                          </div>
                      @endif
                      <div class="col">
                          <h5>{{__('Duration')}} : {{$data['curMonth']}}</h5>
                      </div>

                  </div>
              </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-3 col-md-6 col-sm-6 col-12">
            <div class="card">
                <div class="card-header">
                    <h4>{{__('Attendance')}}</h4>
                </div>

                <div class="card-body">
                  <div class="progreess-status">
                      <span>{{__('Total present')}} :</span>
                      <span><strong>{{$data['totalPresent']}} </strong></span>
                      <span class="float-right"><strong>{{$data['totalLeave']}} </strong></span>
                      <span class="float-right">{{__('Total leave')}} :</span>
                  </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-6 col-12">
            <div class="card">
              <div class="card-header">
                  <h4>{{__('Overtime')}}</h4>
              </div>
                <div class="card-body">
                  <div class="progreess-status">
                      <span>{{__('Total overtime in hours')}} :</span>
                      <span><strong>{{number_format($data['totalOvertime'],2)}} </strong></span>
                  </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-6 col-12">
            <div class="card">
              <div class="card-header">
                  <h4>{{__('Early Leave')}}</h4>
              </div>
                <div class="card-body">
                  <div class="progreess-status">
                      <span>{{__('Total early leave in hours')}} :</span>
                      <span><strong>{{number_format($data['totalEarlyLeave'],2)}} </strong></span>

                  </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-6 col-12">
            <div class="card card-statistic-1">
              <div class="card-header">
                  <h4>{{__('Employee Late')}}</h4>
              </div>
                <div class="card-body">
                  <div class="progreess-status">
                      <span>{{__('Total late in hours')}} :</span>
                      <span><strong>{{number_format($data['totalLate'],2)}} </strong></span>
                  </div>
                </div>
            </div>
        </div>

    </div>
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive attendance-table-responsive">
                        <table class="table table-striped mb-0" id="dataTable-1">
                            <thead>
                            <tr>
                                <th class="active">{{__('Name')}}</th>
                                @foreach($dates as $date)
                                    <th>{{$date}}</th>
                                @endforeach
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($employeesAttendance as $attendance)

                                <tr>
                                    <td>{{$attendance['name']}}</td>
                                    @foreach($attendance['status'] as $status)
                                        <td>
                                            @if($status=='P')
                                                <i class="custom-badge badge-success">{{__('P')}}</i>
                                            @elseif($status=='L')
                                                <i class="custom-badge badge-danger">{{__('L')}}</i>
                                            @endif
                                        </td>
                                    @endforeach
                                </tr>
                            @endforeach
                            </tbody>
                        </table>

                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
@endsection
