@extends('layouts.dashboard')
@section('page-title')
    {{__('Plan')}}
@endsection
@php
    $dir= asset(Storage::url('uploads/plan'));
@endphp
@section('content')
<div class="row mt-4">
    <div class="col-12">
        <div class="page-title-box-hori">
            <h4 class="page-title">{{__('Plan')}}</h4>
            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                  <li class="breadcrumb-item"><a href="{{__('home')}}">{{__('Dashboard')}}</a></li>
                  <!-- <li class="breadcrumb-item"><a href="{{route('employee.index')}}">{{__('Pay Grade')}}</a></li> -->
                  <li class="breadcrumb-item active">{{__('Plan')}}</li>
                </ol>
            </div>
        </div>
    </div>
</div>
<hr class="mt-0">


<div class="row">
    <div class="col-md-12">
      <div class="d-flex justify-content-between w-100">
          <h4>{{--__('Manage Plan')--}}</h4>
          @can('Create Plan')
              <a href="#" data-url="{{ route('plans.create') }}" class="btn btn-icon icon-left btn-success" data-ajax-popup="true" data-toggle="tooltip" data-title="{{__('Create New Plan')}}" data-original-title="{{__('Create Plan')}}">
                  <i class="fa fa-plus"></i> {{__('Create')}}
              </a>
          @endcan
      </div>
    </div>
</div>
<div class="row plan-div">
    @foreach($plans as $plan)
        <div class="col-lg-4 col-md-4">
            <div class="plan-item">
                <h4 class="font-style mt-0"> {{$plan->name}}</h4>
                <div class="img-wrap">
                    @if(!empty($plan->image))
                        <img class="plan-img" src="{{$dir.'/'.$plan->image}}">
                    @endif
                </div>
                <h3>
                    {{isset(\Auth::user()->planPrice()['stripe_currency_symbol'])?\Auth::user()->planPrice()['stripe_currency_symbol'].$plan->price:''}}
                </h3>
                <p class="font-style">{{$plan->duration}}</p>
                <div class="text-center">
                    @can('Edit Plan')
                        <a title="Edit Plan" href="#" class="view-btn" data-url="{{ route('plans.edit',$plan->id) }}" data-ajax-popup="true" data-title="{{__('Edit Plan')}}" data-toggle="tooltip" data-original-title="{{__('Edit')}}"><i class="far fa-edit"></i></a>
                    @endcan

                    @if(\Auth::user()->type=='company' && \Auth::user()->plan == $plan->id)
                        <div class="text-center">
                            <a class="view-success-btn">
                                {{__('Active')}}
                            </a>
                        </div>
                        <div class="col-md-12 text-center">
                            <p class="font-style">{{__('Plan Expired : ') }} {{!empty($user->plan_expire_date) ? \Auth::user()->dateFormat($user->plan_expire_date):'Unlimited'}}</p>
                        </div>
                    @endif

                    @can('Buy Plan')
                        @if($plan->id != \Auth::user()->plan)
                            @if($plan->price > 0)
                                <a title="Buy Plan" class="view-btn" href="{{route('stripe',\Illuminate\Support\Facades\Crypt::encrypt($plan->id))}}"><i class="fa fa-cart-plus"></i></a>
                            @else
                                <a class="view-btn">{{__('Free')}}</a>
                            @endif
                        @endif
                    @endcan
                </div>
                <div class="col-md-12 text-center">
                    <p>{{$plan->description}}</p>
                </div>
                <ul>
                    <li>
                        <i class="fas fa-user-tie"></i>
                        <p>{{$plan->max_users}} {{__('Users')}}</p>
                    </li>
                    <li>
                        <i class="fas fa-user-plus"></i>
                        <p>{{$plan->max_employees}} {{__('Employees')}}</p>
                    </li>
                </ul>
            </div>
        </div>
    @endforeach
</div>
@endsection
