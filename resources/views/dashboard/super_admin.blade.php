@extends('layouts.dashboard')
@section('page-title')
    {{__('Dashboard')}}
@endsection
@push('script-page')

    <script src="{{ asset('assets/modules/chart/Chart.min.js') }} "></script>
    <script src="{{ asset('assets/modules/chart/Chart.extension.js') }} "></script>
    <script src="{{ asset('assets/js/custom_chart.js') }}"></script>
    <script>
        var SalesChart = (function () {
            var $chart = $('#chart-sales');

            function init($this) {
                var salesChart = new Chart($this, {
                    type: 'line',
                    options: {
                        scales: {
                            yAxes: [{
                                gridLines: {
                                    color: Charts.colors.gray[200],
                                    zeroLineColor: Charts.colors.gray[200]
                                },
                                ticks: {}
                            }]
                        }
                    },
                    data: {
                        labels:{!! json_encode($chartData['label']) !!},
                        datasets: [{
                            label: 'Order',
                            data:{!! json_encode($chartData['data']) !!}
                        }]
                    }
                });
                $this.data('chart', salesChart);
            };
            if ($chart.length) {
                init($chart);
            }
        })();
    </script>
@endpush
@section('content')
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


    <div class="main-content">
        <section class="section">
            <div class="row">
              <div class="col-sm-6 col-xl-4">
                  <div class="card">
                      <div class="card-body">
                          <div class="media align-items-center">
                              <div class="widget-chart-two-content media-body">
                                  <p class="text-muted mb-0">{{__('TOTAL USERS')}}</p>
                                  <h3 class="mb-0">{{$user->total_user}}</h3>
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
                                  <span>{{__('PAID USERS')}} :</span>
                                  <span><strong>{{$user['total_paid_user']}} </strong></span>
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
                                  <p class="text-muted mb-0">{{__('TOTAL ORDERS')}}</p>
                                  <h3 class="mb-0">{{$user->total_orders}}</h3>
                              </div>
                              <div dir="ltr">
                                <div class="card-icon bg-warning">
                                    <i class="fas fa-shopping-cart"></i>
                                </div>
                              </div>
                          </div>
                          <div class="card-stats">
                            <div class="card-stats-title">
                              <div class="progreess-status mt-2">
                                  <span>{{__('TOTAL ORDER AMOUNT')}} :</span>
                                  <span><strong>{{\Auth::user()->priceFormat($user['total_orders_price'])}}  </strong></span>
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
                                  <p class="text-muted mb-0">{{__('TOTAL PLANS')}}</p>
                                  <h3 class="mb-0">{{$user['total_plan']}}</h3>
                              </div>
                              <div dir="ltr">
                                <div class="card-icon bg-primary">
                                    <i class="fas fa-trophy"></i>
                                </div>
                              </div>
                          </div>
                          <div class="card-stats">
                            <div class="card-stats-title">
                              <div class="progreess-status mt-2">
                                  <span>{{__('MOST PURCHASE PLAN')}} :</span>
                                  <span><strong>{{$user['most_purchese_plan']}}  </strong></span>
                              </div>
                            </div>
                          </div>

                      </div>
                  </div>
              </div>

            </div>
            <div class="card">
                <div class="card-header">
                    <h4>{{__('Recent Order')}}</h4>
                </div>
                <div class="card-body">
                    <div class="chart">
                        <canvas id="chart-sales" class="chart-canvas"></canvas>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
