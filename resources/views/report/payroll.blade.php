@extends('layouts.dashboard')
@section('page-title')
    {{__('Payroll')}}
@endsection
@push('script-page')
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
            <h4 class="page-title">{{__('Manage Payroll')}}</h4>
            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                  <li class="breadcrumb-item"><a href="{{__('home')}}">{{__('Dashboard')}}</a></li>
                  <!-- <li class="breadcrumb-item"><a href="{{route('employee.index')}}">{{__('Promotion')}}</a></li> -->
                  <li class="breadcrumb-item active">{{__('Payroll')}}</li>
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
                {{ Form::open(array('route' => array('report.payroll'),'method'=>'get')) }}
                <div class="row">
                    <div class="col">
                        <label for="gender">{{__('Type')}}</label>
                        <div class="d-flex w-100">
                            <label class="custom-control custom-radio mr-1">
                                <input type="radio" name="type" value="monthly" class="custom-control-input monthly" {{isset($_GET['type']) && $_GET['type']=='monthly' ?'checked':'checked'}}>
                                <span class="custom-control-label">{{__('Monthly')}}</span>
                            </label>
                            <label class="custom-control custom-radio mr-1">
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
                        {{Form::submit(__('Apply'),array('class'=>'btn btn-success '))}}
                        <a href="{{route('report.payroll')}}" class="btn btn-danger ">{{__('Reset')}}</a>
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
                  <input type="hidden" value="{{  $filterYear['branch'] .' '.__('Branch') .' '.$filterYear['dateYearRange'].' '.$filterYear['type'].' '.__('Payroll Report of').' '. $filterYear['department'].' '.'Department'}}" id="filename">

                  <div class="row">
                      <div class="col">
                          <h5>{{__('Report')}} : {{$filterYear['type'].' '.__('Payroll Summary')}}</h5>
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
                        <h5>{{__('Duration')}} : {{$filterYear['dateYearRange']}}</h5>
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
                  <h4>{{__('Total Basic Salary')}}</h4>
              </div>
                <div class="card-body">
                  <div class="progreess-status">
                      <h5><strong>{{\Auth::user()->priceFormat($filterData['totalBasicSalary'])}} </strong></h5>
                  </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-6 col-12">
            <div class="card">
              <div class="card-header">
                  <h4>{{__('Total Net Salary')}}</h4>
              </div>
              <div class="card-body">
                <div class="progreess-status">
                    <h5><strong>{{\Auth::user()->priceFormat($filterData['totalNetSalary'])}} </strong></h5>
                </div>
              </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-6 col-12">
            <div class="card">
              <div class="card-header">
                  <h4>{{__('Total Allowance')}}</h4>
              </div>
              <div class="card-body">
                <div class="progreess-status">
                    <h5><strong>{{\Auth::user()->priceFormat($filterData['totalAllowance'])}} </strong></h5>
                </div>
              </div>
            </div>
        </div>

        <div class="col-lg-3 col-md-6 col-sm-6 col-12">
            <div class="card">
              <div class="card-header">
                  <h4>{{__('Total Commission')}}</h4>
              </div>
              <div class="card-body">
                <div class="progreess-status">
                    <h5><strong>{{\Auth::user()->priceFormat($filterData['totalCommision'])}} </strong></h5>
                </div>
              </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-6 col-12">
            <div class="card">
              <div class="card-header">
                  <h4>{{__('Total Loan')}}</h4>
              </div>
              <div class="card-body">
                <div class="progreess-status">
                    <h5><strong>{{\Auth::user()->priceFormat($filterData['totalLoan'])}} </strong></h5>
                </div>
              </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-6 col-12">
            <div class="card">
              <div class="card-header">
                  <h4>{{__('Total Saturation Deduction')}}</h4>
              </div>
              <div class="card-body">
                <div class="progreess-status">
                    <h5><strong>{{\Auth::user()->priceFormat($filterData['totalSaturationDeduction'])}} </strong></h5>
                </div>
              </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-6 col-12">
            <div class="card">
              <div class="card-header">
                  <h4>{{__('Total Other Payment')}}</h4>
              </div>
              <div class="card-body">
                <div class="progreess-status">
                    <h5><strong>{{\Auth::user()->priceFormat($filterData['totalOtherPayment'])}} </strong></h5>
                </div>
              </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-6 col-12">
            <div class="card">
              <div class="card-header">
                  <h4>{{__('Total Overtime')}}</h4>
              </div>
              <div class="card-body">
                <div class="progreess-status">
                    <h5><strong>{{\Auth::user()->priceFormat($filterData['totalOverTime'])}} </strong></h5>
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
                <div class="table-responsive">
                    <table class="table table-striped mb-0" id="report-dataTable">
                        <thead class="thead-light">
                        <tr>
                            <th>{{__('Employee ID')}}</th>
                            <th>{{__('Employee')}}</th>
                            <th>{{__('Salary')}}</th>
                            <th>{{__('Net Salary')}}</th>
                            <th>{{__('Month')}}</th>
                            <th>{{__('Status')}}</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($payslips as $payslip)

                            <tr>
                                <td><a href="{{route('employee.show',\Illuminate\Support\Facades\Crypt::encrypt($payslip->employee_id))}}" class="btn  btn-success">{{ !empty($payslip->employees)?\Auth::user()->employeeIdFormat($payslip->employees->employee_id):'' }}</a></td>
                                <td>{{(!empty($payslip->employees)) ? $payslip->employees->name:''}}</td>
                                <td>{{\Auth::user()->priceFormat($payslip->basic_salary)}}</td>
                                <td>{{\Auth::user()->priceFormat($payslip->net_payble)}}</td>
                                <td>{{$payslip->salary_month}}</td>
                                <td>
                                    @if($payslip->status==0)
                                        <div class="badge badge-danger"><a href="#" class="text-white">{{__('UnPaid')}}</a></div>
                                    @else
                                        <div class="badge badge-success"><a href="#" class="text-white">{{__('Paid')}}</a></div>
                                    @endif
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
