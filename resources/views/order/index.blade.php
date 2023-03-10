@extends('layouts.dashboard')
@section('page-title')
    {{__('Plan Order')}}
@endsection
@section('content')

<div class="row mt-4">
    <div class="col-12">
        <div class="page-title-box-hori">
            <h4 class="page-title">{{__('Manage Order')}}</h4>
            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                  <li class="breadcrumb-item"><a href="{{__('home')}}">{{__('Dashboard')}}</a></li>
                  <!-- <li class="breadcrumb-item"><a href="{{route('leave.index')}}">{{__('Leave')}}</a></li> -->
                  <li class="breadcrumb-item active">{{__('Order')}}</li>
                </ol>
            </div>
        </div>
    </div>
</div>
<hr class="mt-0">


<div class="row">
    <div class="col-md-12">
        <div class="card">
            <!-- <div class="card-header">
                <div class="d-flex justify-content-between w-100">
                    <h4>{{--__('Order List')--}}</h4>
                </div>
            </div> -->
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped mb-0" id="dataTable">
                        <thead>
                        <tr>
                            <th>{{__('Order Id')}}</th>
                            <th>{{__('Name')}}</th>
                            <th>{{__('Plan Name')}}</th>
                            <th>{{__('Price')}}</th>
                            <th>{{__('Status')}}</th>
                            <th>{{__('Date')}}</th>
                            <th>{{__('Coupon')}}</th>
                            <th class="text-center">{{__('Invoice')}}</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($orders as $order)

                            <tr>
                                <td>{{$order->order_id}}</td>
                                <td>{{$order->user_name}}</td>
                                <td>{{$order->plan_name}}</td>
                                <td>${{number_format($order->price)}}</td>
                                <td>
                                    @if($order->payment_status == 'succeeded')
                                        <i class="mdi mdi-circle text-success"></i> {{ucfirst($order->payment_status)}}
                                    @else
                                        <i class="mdi mdi-circle text-danger"></i> {{ucfirst($order->payment_status)}}
                                    @endif
                                </td>
                                <td>{{$order->created_at->format('d M Y')}}</td>
                                <td>{{!empty($order->total_coupon_used)? !empty($order->total_coupon_used->coupon_detail)?$order->total_coupon_used->coupon_detail->code:'':''}}</td>
                                <td class="text-center">
                                    @if(empty($order->receipt))
                                        <p>{{__('Manually plan upgraded by super admin')}}</p>
                                    @elseif($order->receipt =='free coupon')
                                        <p>{{__('Used 100 % discount coupon code.')}}</p>
                                    @else
                                        <a href="{{$order->receipt}}" title="Invoice" target="_blank" class=""><i class="fas fa-file-invoice"></i> </a>

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
