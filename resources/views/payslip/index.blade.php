@extends('layouts.dashboard')
@section('page-title')
    {{__('Payslip')}}
@endsection
@section('content')
<div class="row mt-4">
    <div class="col-12">
        <div class="page-title-box-hori">
            <h4 class="page-title">{{__('Employee Payslip')}}</h4>
            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item"><a href="{{__('home')}}">{{__('Dashboard')}}</a></li>
                    <li class="breadcrumb-item active">{{__('Employee Payslip')}}</li>
                </ol>
            </div>
        </div>
    </div>
</div>
<hr class="mt-0 mb-2">
<div class="row">
    <div class="col-12">
        <div class="card">
          @can('Create Pay Slip')
            <div class="card-body">
                <div class="d-flex justify-content-between w-100">
                      <h4>{{__('Employee Select Month Salary')}}</h4>

                      {{Form::open(array('route'=>array('payslip.store'),'method'=>'POST','class'=>'d-flex justify-content-between w-50'))}}
                        <div class="col">
                            {{Form::select('month',$month,null,array('class'=>'form-control month select2' ))}}
                        </div>
                        <div class="col">
                            {{Form::select('year',$year,null,array('class'=>'form-control year select2' ))}}
                        </div>
                        <div class="col-auto pr-0">
                            {!! Form::submit('Genrate Payslip', ['class' => 'btn btn-success search']) !!}
                        </div>
                      {!! Form::close() !!}
                </div>
            </div>
          @endcan
      </div>
    </div>
</div>
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
              <div class="d-flex justify-content-between w-100">
                  <h4>{{__('Employee Salary')}}</h4>
                  <div class="d-flex justify-content-between w-50">
                    <div class="col">
                        <select class="form-control month_date select2" name="year" tabindex="-1" aria-hidden="true">
                            <option value="--">--</option>
                            @foreach($month as $k=>$mon)
                                <option value="{{$k}}">{{$mon}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col">
                        {{Form::select('year',$year,null,array('class'=>'form-control year_date select2' ))}}
                    </div>
                    <div class="col-auto pr-0">
                      @can('Create Pay Slip')
                          <a href="#" class="btn btn-success" id="bulk_payment" style="width:128px;">{{__('Bulk Payment')}}</a>
                      @endcan
                    </div>
                  </div>
              </div>
              <hr class="">
                <div class="table-responsive">
                    <table class="table table-striped mb-0" id="dataTable1">
                        <thead>
                        <tr>
                            <th>{{__('Id')}}</th>
                            <th>{{__('Employee Id')}}</th>
                            <th>{{__('Name')}}</th>
                            <th>{{__('Payroll Type') }}</th>
                            <th>{{__('Salary') }}</th>
                            <th>{{__('Net Salary') }}</th>
                            <th>{{__('Status') }}</th>
                            <th>{{__('Action') }}</th>
                        </tr>
                        </thead>
                        <tbody>

                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>
</div>

    @push('script-page')
        <script type="text/javascript">
$(document).ready(function () {
            var table = $('#dataTable1').DataTable({
                "aoColumnDefs": [
                    {
                        "aTargets": [6],
                        "mData": null,
                        "mRender": function (data, type, full) {
                            var month = $(".month_date").val();
                            var year = $(".year_date").val();
                            var datePicker = year + '-' + month;
                            var id = data[0];

                            if (data[6] == 'Paid')
                                return '<div class="badge badge-success"><a href="#" class="text-white">' + data[6] + '</a></div>';
                            else
                                return '<div class="badge badge-danger"><a  href="#" class="text-white">' + data[6] + '</a></div>';
                        }
                    },
                    {
                        "aTargets": [7],
                        "mData": null,
                        "mRender": function (data, type, full) {


                            var month = $(".month_date").val();
                            var year = $(".year_date").val();
                            var datePicker = year + '-' + month;

                            var id = data[0];
                            var payslip_id = data[7];

                            var clickToPaid = '';
                            var payslip = '';
                            var view = '';
                            var edit = '';

                            if (data[7] != 0) {
                                var payslip = '<a data-url="{{ url('payslip/pdf/') }}/' + id + '/' + datePicker + '" data-size="md-pdf"  data-ajax-popup="true" data-toggle="tooltip" class="btn  btn-warning btn-icon text-white mr-1" data-title="{{__('Employee Payslip')}}" data-original-title="{{__('Payslip')}}">' + '{{__('Payslip')}}' + '</a> ';
                            }

                            if (data[6] == "UnPaid" && data[7] != 0) {
                                clickToPaid = '<a href="{{ url('payslip/paysalary/') }}/' + id + '/' + datePicker + '"  class="btn  btn-success btn-icon text-white mr-1">' + '{{__('Click To Paid')}}' + '</a>  ';
                            }

                            if (data[7] != 0) {
                                view = '<a data-url="{{ url('payslip/showemployee/') }}/' + payslip_id + '"  data-ajax-popup="true" data-toggle="tooltip" class="btn  btn-info btn-icon text-white mr-1" data-title="{{__('View Employee Detail')}}" data-original-title="{{__('View Employee Detail')}}">' + '{{__('View')}}' + '</a>';
                            }

                            if (data[7] != 0 && data[6] == "UnPaid") {
                                edit = '<a data-url="{{ url('payslip/editemployee/') }}/' + payslip_id + '"  data-ajax-popup="true" data-toggle="tooltip" class="btn  btn-success btn-icon text-white mr-1" data-title="{{__('Edit Employee salary')}}" data-original-title="{{__('Edit Employee salary')}}">' + '{{__('Edit')}}' + '</a>';
                            }

                            return view + payslip + clickToPaid + edit;
                        }
                    },
                ]
            });


            function callback() {
                var month = $(".month_date").val();
                var year = $(".year_date").val();
                var datePicker = year + '-' + month;

                $.ajax({
                    url: '{{route('payslip.search_json')}}',
                    type: 'POST',
                    data: {
                        "datePicker": datePicker, "_token": "{{ csrf_token() }}",
                    },
                    success: function (data) {

                        table.rows().remove().draw();
                        table.rows.add(data).draw();
                        table.column(0).visible(false);

                        if (!(data)) {
                            show_msg('error', 'Payslip Not Found!', 'error');
                        }
                    },
                    error: function (data) {

                    }
                });
            }

            $(document).on("change", ".month_date,.year_date", function () {
                callback();
            });


            //bulkpayment Click
            $(document).on("click", "#bulk_payment", function () {
                var month = $(".month_date").val();
                var year = $(".year_date").val();
                var datePicker = year + '_' + month;

            });

            $(document).on('click', '#bulk_payment', 'a[data-ajax-popup="true"], button[data-ajax-popup="true"], div[data-ajax-popup="true"]', function () {
                var month = $(".month_date").val();
                var year = $(".year_date").val();
                var datePicker = year + '-' + month;

                var title = 'Bulk Payment';
                var size = 'md';
                var url = 'payslip/bulk_pay_create/' + datePicker;

                // return false;

                $("#commonModal .modal-title").html(title);
                $("#commonModal .modal-dialog").addClass('modal-' + size);
                $.ajax({
                    url: url,
                    success: function (data) {

                        // alert(data);
                        // return false;
                        if (data.length) {
                            $('#commonModal .modal-body').html(data);
                            $("#commonModal").modal('show');
                            // common_bind();
                        } else {
                            show_msg('Error', 'Permission denied.');
                            $("#commonModal").modal('hide');
                        }
                    },
                    error: function (data) {
                        data = data.responseJSON;
                        show_msg('Error', data.error);
                    }
                });
            });
});

        </script>
    @endpush
@endsection
