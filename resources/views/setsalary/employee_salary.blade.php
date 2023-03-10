@extends('layouts.dashboard')
@section('content')

<div class="row mt-4">
    <div class="col-12">
        <div class="page-title-box-hori">
            <h4 class="page-title">{{__('Employee Set Salary')}}</h4>
            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                  <li class="breadcrumb-item"><a href="{{__('home')}}">{{__('Dashboard')}}</a></li>
                  <li class="breadcrumb-item"><a href="{{ route('setsalary.index') }}">{{__('Employee  Salary List')}}</a></li>
                  <li class="breadcrumb-item active">{{__('Employee Set Salary')}}</li>
                </ol>
            </div>
        </div>
    </div>
</div>
<hr class="mt-0">


@csrf
<div class="row">
    <div class="col-12">
        <div class="row">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header"><h4>{{__('Employee Salary')}}</h4></div>
                    <div class="card-body">
                        <div class="project-info d-flex">
                            <div class="project-info-inner mr-3 col-6">
                                <b class="m-0"> {{__('Payslip Type') }} </b>
                                <div class="project-amnt pt-1">{{ $employee->salary_type() }}</div>
                            </div>
                            <div class="project-info-inner mr-3 col-6">
                                <b class="m-0"> {{__('Salary') }} </b>
                                <div class="project-amnt pt-1">{{ $employee->salary }}</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header"><h4>{{__('Allowance')}}</h4></div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped mb-0">
                                <thead>
                                <tr>
                                    <th>{{__('Employee Name')}}</th>
                                    <th>{{__('Allownace Option')}}</th>
                                    <th>{{__('Title')}}</th>
                                    <th>{{__('Amount')}}</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach ($allowances as $allowance)
                                    <tr>
                                        <td>{{ !empty($allowance->employee())?$allowance->employee()->name:'' }}</td>
                                        <td>{{ !empty($allowance->allowance_option())?$allowance->allowance_option()->name:'' }}</td>
                                        <td>{{ $allowance->title }}</td>
                                        <td>{{  \Auth::user()->priceFormat($allowance->amount) }}</td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header"><h4>{{__('Commission')}}</h4></div>
                    <div class="card-body">

                        <div class="table-responsive">
                            <table class="table table-striped mb-0">
                                <thead>
                                <tr>
                                    <th>{{__('Employee Name')}}</th>
                                    <th>{{__('Title')}}</th>
                                    <th>{{__('Amount')}}</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach ($commissions as $commission)
                                    <tr>
                                        <td>{{ !empty($commission->employee())?$commission->employee()->name:'' }}</td>
                                        <td>{{ $commission->title }}</td>
                                        <td>{{ \Auth::user()->priceFormat( $commission->amount) }}</td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header"><h4>{{__('Loan')}}</h4></div>
                    <div class="card-body">

                        <div class="table-responsive">
                            <table class="table table-striped mb-0">
                                <thead>
                                <tr>
                                    <th>{{__('employee')}}</th>
                                    <th>{{__('Loan Options')}}</th>
                                    <th>{{__('Title')}}</th>
                                    <th>{{__('Loan Amount')}}</th>
                                    <th>{{__('Start Date')}}</th>
                                    <th>{{__('End Date')}}</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach ($loans as $loan)
                                    <tr>
                                        <td>{{ !empty($loan->employee())?$loan->employee()->name:'' }}</td>
                                        <td>{{!empty( $loan->loan_option())? $loan->loan_option()->name:'' }}</td>
                                        <td>{{ $loan->title }}</td>
                                        <td>{{  \Auth::user()->priceFormat($loan->amount) }}</td>
                                        <td>{{  \Auth::user()->dateFormat($loan->start_date) }}</td>
                                        <td>{{ \Auth::user()->dateFormat( $loan->end_date) }}</td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header"><h4>{{__('Saturation Deduction')}}</h4></div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped mb-0">
                                <thead>
                                <tr>
                                    <th>{{__('Employee Name')}}</th>
                                    <th>{{__('Deduction Option')}}</th>
                                    <th>{{__('Title')}}</th>
                                    <th>{{__('Amount')}}</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach ($saturationdeductions as $saturationdeduction)
                                    <tr>
                                        <td>{{ !empty($saturationdeduction->employee())?$saturationdeduction->employee()->name:'' }}</td>
                                        <td>{{ !empty($saturationdeduction->deduction_option())?$saturationdeduction->deduction_option()->name:'' }}</td>
                                        <td>{{ $saturationdeduction->title }}</td>
                                        <td>{{ \Auth::user()->priceFormat( $saturationdeduction->amount) }}</td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header"><h4>{{__('Other Payment')}}</h4></div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped mb-0">
                                <thead>
                                <tr>
                                    <th>{{__('employee')}}</th>
                                    <th>{{__('Title')}}</th>
                                    <th>{{__('Amount')}}</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach ($otherpayments as $otherpayment)
                                    <tr>
                                        <td>{{ !empty($otherpayment->employee())?$otherpayment->employee()->name:'' }}</td>
                                        <td>{{ $otherpayment->title }}</td>
                                        <td>{{  \Auth::user()->priceFormat($otherpayment->amount) }}</td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header"><h4>{{__('Overtime')}}</h4></div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped mb-0">
                                <thead>
                                <tr>
                                    <th>{{__('Employee Name')}}</th>
                                    <th>{{__('Overtime Title')}}</th>
                                    <th>{{__('Number of days')}}</th>
                                    <th>{{__('Hours')}}</th>
                                    <th>{{__('Rate')}}</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach ($overtimes as $overtime)
                                    <tr>
                                        <td>{{ !empty($overtime->employee())?$overtime->employee()->name:'' }}</td>
                                        <td>{{ $overtime->title }}</td>
                                        <td>{{ $overtime->number_of_days }}</td>
                                        <td>{{ $overtime->hours }}</td>
                                        <td>{{  \Auth::user()->priceFormat($overtime->rate) }}</td>
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
</div>
@endsection

@push('script-page')

    <script type="text/javascript">

        $(document).ready(function () {
            var d_id = $('#department_id').val();
            var designation_id = '{{ $employee->designation_id }}';
            getDesignation(d_id);


            $("#allowance-dataTable").dataTable({
                "columnDefs": [
                    {"sortable": false, "targets": [1]}
                ]
            });

            $("#commission-dataTable").dataTable({
                "columnDefs": [
                    {"sortable": false, "targets": [1]}
                ]
            });

            $("#loan-dataTable").dataTable({
                "columnDefs": [
                    {"sortable": false, "targets": [1]}
                ]
            });

            $("#saturation-deduction-dataTable").dataTable({
                "columnDefs": [
                    {"sortable": false, "targets": [1]}
                ]
            });

            $("#other-payment-dataTable").dataTable({
                "columnDefs": [
                    {"sortable": false, "targets": [1]}
                ]
            });

            $("#overtime-dataTable").dataTable({
                "columnDefs": [
                    {"sortable": false, "targets": [1]}
                ]
            });
        });

        $(document).on('change', 'select[name=department_id]', function () {
            var department_id = $(this).val();
            getDesignation(department_id);
        });

        function getDesignation(did) {
            $.ajax({
                url: '{{route('employee.json')}}',
                type: 'POST',
                data: {
                    "department_id": did, "_token": "{{ csrf_token() }}",
                },
                success: function (data) {
                    $('#designation_id').empty();
                    $('#designation_id').append('<option value="">Select any Designation</option>');
                    $.each(data, function (key, value) {
                        var select = '';
                        if (key == '{{ $employee->designation_id }}') {
                            select = 'selected';
                        }

                        $('#designation_id').append('<option value="' + key + '"  ' + select + '>' + value + '</option>');
                    });
                }
            });
        }

    </script>
@endpush
