@extends('layouts.dashboard')
@section('page-title')
    @if(\Auth::user()->type=='super admin')
        {{__('Company')}}
    @else
        {{__('User')}}
    @endif
@endsection
@php
    $profile=asset(Storage::url('uploads/avatar/'));
@endphp
@section('content')
<div class="row mt-4">
    <div class="col-12">
        <div class="page-title-box-hori">
            <h4 class="page-title">
              @if(\Auth::user()->type =='super admin')
                  {{__('Company')}}
              @else
                  {{__('User')}}
              @endif
            </h4>
            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item"><a href="{{route('home')}}">{{__('Dashboard')}}</a></li>
                    @if(\Auth::user()->type=='super admin')
                        <li class="breadcrumb-item active">{{__('Company')}}</li>
                    @else
                        <li class="breadcrumb-item active">{{__('User')}}</li>
                    @endif
                </ol>
            </div>
        </div>
    </div>
</div>
<hr class="mt-0">
@can('Create User')
<div class="row">
    <div class="col-sm-4">
        <div class="mb-3">

              @if(\Auth::user()->type=='super admin')
                  <a href="#" data-url="{{ route('user.create') }}" data-size="xl" data-ajax-popup="true" data-title="{{__('Create New Company')}}" class="btn btn-icon icon-left btn-success">
                      <i class="fa fa-plus"></i> {{__('Create')}}
                  </a>
              @else
                  <a href="#" data-url="{{ route('user.create') }}" data-size="xl" data-ajax-popup="true" data-title="{{__('Create New User')}}" class="btn btn-icon icon-left btn-success">
                      <i class="fa fa-plus"></i> {{__('Create')}}
                  </a>
              @endif

        </div>
    </div>
    <div class="col-sm-8">
        <div class="float-sm-right mb-3">
            <form class="form-inline">
                <div class="form-group mr-2">
                    <label for="membersearch-input" class="sr-only">Search</label>
                    <input type="search" class="form-control" id="membersearch-input" placeholder="Search...">
                </div>
            </form>

        </div>
    </div><!-- end col-->
</div>
@endcan
<div class="row">
    @foreach($users as $user)
    <div class="col-xl-4 col-sm-6">
            <div class="card text-center">
                <div class="card-body">
                    <div class="member-card">
                        <div class="member-thumb mx-auto">
                            <img src="{{(!empty($users->avatar)? $profile.'/'.$users->avatar : $profile.'/avatar.png')}}" class="rounded-circle avatar-xl img-thumbnail" alt="profile-image">
                        </div>

                        <div class="mt-3">
                            <h4 class="mb-1">{{ $user->name }}</h4>
                            <p class="text-muted">{{ $user->company_name }} <span> | </span> {{ $user->type }}</p>
                            <p class="text-muted"><a href="mailto:{{ $user->email }}" class="">{{ $user->email }}</a></p>
                        </div>


                        @if(\Auth::user()->type == 'super admin')



                        <div class="mt-3">
                            <h4 class="mb-1">{{!empty($user->currentPlan)?$user->currentPlan->name:''}}</h4>
                        </div>

                        <a href="#" class="btn btn-icon icon-left btn-success" data-url="{{ route('plan.upgrade',$user->id) }}" data-ajax-popup="true" data-title="{{__('Upgrade Plan')}}">{{__('Upgrade Plan')}}</a>

                        <div class="mt-3">
                            <div class="row">
                                <div class="col-4">
                                    <div class="mt-3">
                                        <h4>{{!empty($user->plan_expire_date) ? \Auth::user()->dateFormat($user->plan_expire_date):'Unlimited'}}</h4>
                                        <p class="mb-0 text-muted text-truncate">{{__('Plan Expired : ') }} </p>
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="mt-3">
                                        <h4>{{\Auth::user()->countUsers()}}</h4>
                                        <p class="mb-0 text-muted text-truncate">Users</p>
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="mt-3">
                                        <h4>{{\Auth::user()->countEmployees()}}</h4>
                                        <p class="mb-0 text-muted text-truncate">Employees</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="d-flex justify-content-between align-items-center mt-3">
                          @if($user->is_active==1)
                              @if(Gate::check('Edit User') || Gate::check('Delete User'))
                              @can('Edit User')
                                  <a href="#" data-url="{{ route('user.edit',$user->id) }}" class="btn btn-success w-100" data-ajax-popup="true" data-toggle="tooltip" data-title="{{__('Edit User')}}" data-original-title="{{ __('Edit User') }}">{{__('Edit')}}</a>
                              @endcan
                              @can('Delete User')
                                  <a href="#" class="btn btn-danger w-100" data-toggle="tooltip" data-original-title="{{__('Delete')}}" data-confirm="{{__('Are You Sure?|This action can not be undone. Do you want to continue?')}}" data-confirm-yes="document.getElementById('delete-form-{{$user->id}}').submit();">{{__('Delete')}}</a>
                                  {!! Form::open(['method' => 'DELETE', 'route' => ['user.destroy', $user->id],'id'=>'delete-form-'.$user->id]) !!}
                                  {!! Form::close() !!}
                              @endcan
                              @endif
                          @else

                            <button href="#" class="btn btn-success w-100" disabled><i class="fas fa-lock"></i></button>

                          @endif
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    @endforeach
</div>
@endsection
