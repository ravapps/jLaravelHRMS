@extends('layouts.dashboard')
@section('page-title')
    {{__('Last Login')}}
@endsection
@section('content')
<div class="row mt-4">
    <div class="col-12">
        <div class="page-title-box-hori">
            <h4 class="page-title">{{__('Last Login')}}</h4>
            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                  <li class="breadcrumb-item"><a href="{{__('home')}}">{{__('Dashboard')}}</a></li>
                  <!-- <li class="breadcrumb-item"><a href="{{route('leave.index')}}">{{__('Leave')}}</a></li> -->
                  <li class="breadcrumb-item active">{{__('Last Login')}}</li>
                </ol>
            </div>
        </div>
    </div>
</div>
<hr class="mt-0">

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped mb-0" id="dataTable">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>{{__('Name')}}</th>
                            <th>{{__('Last Login')}}</th>
                            <th>{{__('Role')}}</th>
                        </tr>
                        </thead>
                        <tbody class="font-style">
                        @foreach ($users as $user)
                            <tr>
                                @if($user->type=='employee')
                                    <td>{{ \Auth::user()->employeeIdFormat($user->id) }}</td>
                                @else
                                    <td>--</td>
                                @endif
                                <td>{{ $user->name }}</td>
                                <td>{{$user->last_login}}</td>
                                <td>{{$user->type}}</td>
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
