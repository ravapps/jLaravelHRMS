@extends('layouts.dashboard')
@section('page-title')
    {{__('Income Vs Expense')}}
@endsection
@push('script-page')
    <script type="text/javascript" src="{{ asset('js/html2pdf.bundle.min.js') }}"></script>
    <script>
        var BarsChart = (function () {
            var $chart = $('#chart-finance');

            function initChart($chart) {
                var ordersChart = new Chart($chart, {
                    type: 'bar',
                    data: {
                        labels: {!! json_encode($labels) !!},
                        datasets:  {!! json_encode($data) !!}
                    }
                });
                $chart.data('chart', ordersChart);
            }

            if ($chart.length) {
                initChart($chart);
            }
        })();

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
            <h4 class="page-title">{{__('Manage Income Vs Expense')}}</h4>
            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                  <li class="breadcrumb-item"><a href="{{__('home')}}">{{__('Dashboard')}}</a></li>
                  <!-- <li class="breadcrumb-item"><a href="{{route('employee.index')}}">{{__('Promotion')}}</a></li> -->
                  <li class="breadcrumb-item active">{{__('Income vs Expense Report')}}</li>
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
              {{ Form::open(array('route' => array('report.income-expense'),'method'=>'get')) }}
              <div class="row">
                  <div class="col">
                      {{Form::label('start_month',__('Start Month'))}}
                      {{Form::month('start_month',isset($_GET['start_month'])?$_GET['start_month']:'',array('class'=>'form-control'))}}
                  </div>
                  <div class="col">
                      {{Form::label('end_month',__('End Month'))}}
                      {{Form::month('end_month',isset($_GET['end_month'])?$_GET['end_month']:'',array('class'=>'form-control'))}}
                  </div>

                  <div class="col-auto apply-btn">
                    <label class="w-100">&nbsp</label>
                      {{Form::submit(__('Apply'),array('class'=>'btn btn-success '))}}
                      <a href="{{route('report.income-expense')}}" class="btn btn-danger ">{{__('Reset')}}</a>
                      <a href="#" class="btn btn-warning " onclick="saveAsPDF()" id="">{{__('Download')}}</a>
                  </div>
              </div>
              {{ Form::close() }}
            </div>
        </div>
    </div>
</div>
<div id="printableArea">

    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-12">
            <div class="card">
              <div class="card-body">
                  <input type="hidden" value="{{__('Income vs Expense Report of').' '}}{{$filter['startDateRange'].' to '.$filter['endDateRange']}}" id="filename">
                  <div class="row">
                      <div class="col">
                          <h5>{{__('Report')}} : {{__('Income vs Expense Summary')}}</h5>
                      </div>
                      <div class="col">
                          <h5>{{__('Duration')}} : {{$filter['startDateRange'].' to '.$filter['endDateRange']}}</h5>
                      </div>
                  </div>
                  <div class="row">
                      <div class="col">
                          <h5>{{__('Total Income')}} : {{\Auth::user()->priceFormat($incomeCount)}}</h5>
                      </div>
                      <div class="col">
                          <h5>{{__('Total Expense')}} : {{\Auth::user()->priceFormat($expenseCount)}}</h5>
                      </div>
                  </div>
              </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body min-height">
                    <div class="chart">
                        <div class="chartjs-size-monitor">
                            <div class="chartjs-size-monitor-expand">
                                <div class=""></div>
                            </div>
                            <div class="chartjs-size-monitor-shrink">
                                <div class=""></div>
                            </div>
                        </div>
                        <canvas id="chart-finance" class="chart-canvas chartjs-render-monitor"></canvas>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
@endsection
