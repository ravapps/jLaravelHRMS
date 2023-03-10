@extends('layouts.dashboard')
@section('page-title')
    {{__('Timesheet')}}
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
                jsPDF: {unit: 'in', format: 'A4'}
            };
            html2pdf().set(opt).from(element).save();

        }

        $(document).ready(function () {
            var filename = $('#filename').val();
            $('#report-dataTable').DataTable({
                dom: 'lBfrtip',
                buttons: [
                    {
                        extend: 'excel',
                        title: filename
                    },
                    {
                        extend: 'pdf',
                        title: filename
                    }, {
                        extend: 'print',
                        title: filename
                    }, {
                        extend: 'csv',
                        title: filename
                    }
                ]
            });
        });

    </script>
@endpush
@section('content')
<div class="row mt-4">
    <div class="col-12">
        <div class="page-title-box-hori">
            <h4 class="page-title">{{__('Manage Timesheet')}}</h4>
            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                  <li class="breadcrumb-item"><a href="{{__('home')}}">{{__('Dashboard')}}</a></li>
                  <!-- <li class="breadcrumb-item"><a href="{{route('employee.index')}}">{{__('Promotion')}}</a></li> -->
                  <li class="breadcrumb-item active">{{__('Timesheet')}}</li>
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
                {{ Form::open(array('route' => array('report.timesheet'),'method'=>'get')) }}
                <div class="row">
                    <div class="col">
                        {{Form::label('start_date',__('Start Date'))}}
                        {{Form::date('start_date',isset($_GET['start_date'])?$_GET['start_date']:date('Y-m-01'),array('class'=>'form-control'))}}
                    </div>
                    <div class="col">
                        {{Form::label('end_date',__('End Date'))}}
                        {{Form::date('end_date',isset($_GET['end_date'])?$_GET['end_date']:date('Y-m-t'),array('class'=>'form-control'))}}
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
                        <a href="{{route('report.timesheet')}}" class="btn btn-danger ">{{__('Reset')}}</a>
                        <a href="#" class="btn btn-warning" onclick="saveAsPDF()" id="">{{__('Download')}}</a>
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
                <div class="card-wrap">
                    <div class="card-body">
                        <input type="hidden" value="{{$filterYear['branch'] .' '.__('Branch') .' '.__('Timesheet Report').' '}}{{$filterYear['start_date'].' to '.$filterYear['end_date'].' '.__('of').' '.$filterYear['department'].' '.'Department'}}" id="filename">

                        <div class="row">
                            <div class="col">
                                <h5>{{__('Title')}} : {{__('Timesheet Report')}}</h5>
                            </div>
                            @if($filterYear['branch']!='All')
                                <div class="col">
                                     <h5>{{__('Branch')}} :{{($filterYear['branch']) }}</h5>
                                </div>
                            @endif
                            @if($filterYear['department']!='All')
                                <div class="col">
                                     <h5>{{__('Department')}} : {{$filterYear['department'] }}</h5>
                                </div>
                            @endif
                            <div class="col">
                                <h5>{{__('Duration')}} : {{$filterYear['start_date'].' to '.$filterYear['end_date']}}</h5>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-6 col-md-6 col-sm-6 col-12">
            <div class="card">
              <div class="card-header">
                  <h4>{{__('Total Working Employee')}}</h4>
              </div>
                <div class="card-body">
                  <div class="progreess-status">
                      <h5><strong>{{$filterYear['totalEmployee']}} </strong></h5>
                  </div>
                </div>
            </div>
        </div>
        <div class="col-lg-6 col-md-6 col-sm-6 col-12">
            <div class="card">
              <div class="card-header">
                  <h4>{{__('Total Working Hours')}}</h4>
              </div>
              <div class="card-body">
                <div class="progreess-status">
                    <h5><strong>{{$filterYear['totalHours']}}</strong></h5>
                </div>
              </div>
            </div>
        </div>
        @foreach($timesheetFilters as $timesheetFilter)
            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                <div class="card">
                  <div class="card-header">
                      <h4>{{__('Total Working Hours')}}</h4>
                  </div>
                    <div class="card-body">
                      <div class="progreess-status">
                           <h5><strong>{{$timesheetFilter->total}}</strong></h5>
                      </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
<div class="row">
    <div class="col">
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped mb-0" id="report-dataTable">
                        <thead class="thead-light">
                        <tr>
                            <th>{{__('Employee ID')}}</th>
                            <th>{{__('Employee')}}</th>
                            <th>{{__('Date')}}</th>
                            <th>{{__('Hours')}}</th>
                            <th>{{__('Description')}}</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($timesheets as $timesheet)
                            <tr>
                                <td><a href="{{route('employee.show',\Illuminate\Support\Facades\Crypt::encrypt($timesheet->employee_id))}}" class="btn  btn-success">{{ \Auth::user()->employeeIdFormat($timesheet->employee_id) }}</a></td>
                                <td>{{(!empty($timesheet->employee)) ? $timesheet->employee->name:''}}</td>
                                <td>{{\Auth::user()->dateFormat($timesheet->date)}}</td>
                                <td>{{$timesheet->hours}}</td>
                                <td>{{$timesheet->remark}}</td>
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
