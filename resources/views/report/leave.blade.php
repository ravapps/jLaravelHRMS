@extends('layouts.dashboard')
@section('page-title')
    {{__('Leave')}}
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

    <script>
        $('input[name="type"]:radio').on('change', function (e) {
            var type = $(this).val();
            if (type == 'monthly') {
                $('.month').addClass('d-block');
                $('.month').removeClass('d-none');
                $('.year').addClass('d-none');
                $('.year').removeClass('d-block');
            } else {
                $('.year').addClass('d-block');
                $('.year').removeClass('d-none');
                $('.month').addClass('d-none');
                $('.month').removeClass('d-block');
            }
        });

        $('input[name="type"]:radio:checked').trigger('change');

    </script>
@endpush
@section('content')
<div class="row mt-4">
    <div class="col-12">
        <div class="page-title-box-hori">
            <h4 class="page-title">{{__('Manage Leave')}}</h4>
            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                  <li class="breadcrumb-item"><a href="{{__('home')}}">{{__('Dashboard')}}</a></li>
                  <!-- <li class="breadcrumb-item"><a href="{{route('employee.index')}}">{{__('Promotion')}}</a></li> -->
                  <li class="breadcrumb-item active">{{__('Leave')}}</li>
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
                {{ Form::open(array('route' => array('report.leave'),'method'=>'get')) }}
                <div class="row">
                    <div class="col">
                        <label for="gender">{{__('Type')}}</label>
                        <div class="d-flex w-100">
                          <label class="custom-control custom-radio mr-1">
                              <input type="radio" name="type" value="monthly" class="custom-control-input monthly" {{isset($_GET['type']) && $_GET['type']=='monthly' ?'checked':'checked'}}>
                              <span class="custom-control-label">{{__('Monthly')}}</span>
                          </label>
                          <label class="custom-control custom-radio">
                              <input type="radio" name="type" value="yearly" class="custom-control-input yearly" {{isset($_GET['type']) && $_GET['type']=='yearly' ?'checked':''}}>
                              <span class="custom-control-label">{{__('Yearly')}}</span>
                          </label>
                        </div>
                    </div>
                    <div class="col month">
                        {{Form::label('month',__('Month'))}}
                        {{Form::month('month',isset($_GET['month'])?$_GET['month']:date('Y-m'),array('class'=>'form-control'))}}
                    </div>
                    <div class="col year d-none">
                        {{ Form::label('year', __('Year')) }}
                        <select class="form-control select2" id="year" name="year" tabindex="-1" aria-hidden="true">
                            @for($filterYear['starting_year']; $filterYear['starting_year'] <= $filterYear['ending_year']; $filterYear['starting_year']++)
                                <option {{(isset($_GET['year']) && $_GET['year'] == $filterYear['starting_year'] ?'selected':'')}} {{(!isset($_GET['year']) && date('Y') == $filterYear['starting_year'] ?'selected':'')}} value="{{$filterYear['starting_year']}}">{{$filterYear['starting_year']}}</option>
                            @endfor
                        </select>
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
                        {{Form::submit(__('Apply'),array('class'=>'btn btn-success'))}}
                        <a href="{{route('report.leave')}}" class="btn btn-danger">{{__('Reset')}}</a>
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
              <div class="card-body">
                  <input type="hidden" value="{{  $filterYear['branch'] .' '.__('Branch') .' '.$filterYear['dateYearRange'].' '.$filterYear['type'].' '.__('Leave Report of').' '. $filterYear['department'].' '.'Department'}}" id="filename">

                  <div class="row">
                      <div class="col">
                          <h5>{{__('Report')}} : {{$filterYear['type'].' '.__('Leave Summary')}}</h5>
                      </div>
                      @if($filterYear['branch']!='All')
                          <div class="col">
                              <h5>{{__('Branch')}} : {{($filterYear['branch']) }}</h5>
                          </div>
                      @endif
                      @if($filterYear['department']!='All')
                          <div class="col">
                              <h5>{{__('Department')}} : {{$filterYear['department'] }}</h5>
                          </div>
                      @endif
                      <div class="col">
                           <h5>{{__('Duration')}} :{{$filterYear['dateYearRange']}}</h5>
                      </div>

                  </div>
              </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-4 col-md-6 col-sm-6 col-12">
            <div class="card">
              <div class="card-header">
                  <h4>{{__('Approved Leaves')}}</h4>
              </div>
                <div class="card-body">
                  <div class="progreess-status mt-2">
                      <h5><strong>{{$filter['totalApproved']}} </strong></h5>
                  </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-md-6 col-sm-6 col-12">
            <div class="card">
              <div class="card-header">
                  <h4>{{__('Rejected Leave')}}</h4>
              </div>
              <div class="card-body">
                <div class="progreess-status mt-2">
                    <h5><strong>{{$filter['totalReject']}} </strong></h5>
                </div>
              </div>
            </div>
        </div>
        <div class="col-lg-4 col-md-6 col-sm-6 col-12">
            <div class="card">
              <div class="card-header">
                  <h4>{{__('Pending Leaves')}}</h4>
              </div>
              <div class="card-body">
                <div class="progreess-status mt-2">
                    <h5><strong>{{$filter['totalPending']}} </strong></h5>
                </div>
              </div>
            </div>
        </div>

    </div>
</div>
<div class="row">
    <div class="col">
        <div class="card">
            <div class="card-body">
                <div class="table-responsive py-4">
                    <table class="table table-striped mb-0" id="report-dataTable">
                        <thead class="thead-light">
                        <tr>
                            <th>{{__('Employee ID')}}</th>
                            <th>{{__('Employee')}}</th>
                            <th>{{__('Approved Leaves')}}</th>
                            <th>{{__('Rejected Leaves')}}</th>
                            <th>{{__('Pending Leaves')}}</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($leaves as $leave)

                            <tr>
                                <td>{{ \Auth::user()->employeeIdFormat($leave['employee_id']) }}</td>
                                <td>{{$leave['employee']}}</td>

                                <td>
                                    <a href="#!" data-url="{{ route('report.employee.leave',[$leave['id'],'Approve',isset($_GET['type']) ?$_GET['type']:'no',isset($_GET['month'])?$_GET['month']:date('Y-m'),isset($_GET['year'])?$_GET['year']:date('Y')]) }}" data-ajax-popup="true" data-title="{{__('Approved Leave Detail')}}" data-toggle="tooltip" data-original-title="{{__('View')}}" class="btn btn-outline-success">
                                        <span class="badge badge-success mr-2">{{$leave['approved']}}</span> <i class="fas fa-eye"></i>
                                    </a>
                                </td>
                                <td>
                                    <a href="#!" data-url="{{ route('report.employee.leave',[$leave['id'],'Reject',isset($_GET['type']) ?$_GET['type']:'no',isset($_GET['month'])?$_GET['month']:date('Y-m'),isset($_GET['year'])?$_GET['year']:date('Y')]) }}" class="table-action table-action-delete btn btn-outline-danger" data-ajax-popup="true" data-title="{{__('Rejected Leave Detail')}}" data-toggle="tooltip" data-original-title="{{__('View')}}">
                                        <span class="badge badge-danger mr-2">{{$leave['reject']}}</span> <i class="fas fa-eye"></i>
                                    </a>
                                </td>
                                <td>
                                    <a href="#!" data-url="{{ route('report.employee.leave',[$leave['id'],'Pending',isset($_GET['type']) ?$_GET['type']:'no',isset($_GET['month'])?$_GET['month']:date('Y-m'),isset($_GET['year'])?$_GET['year']:date('Y')]) }}" class="table-action table-action-delete btn btn-outline-primary" data-ajax-popup="true" data-title="{{__('Pending Leave Detail')}}" data-toggle="tooltip" data-original-title="{{__('View')}}">
                                        <span class="badge badge-primary mr-2">{{$leave['pending']}}</span> <i class="fas fa-eye"></i>
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
