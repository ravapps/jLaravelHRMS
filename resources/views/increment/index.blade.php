@extends('layouts.dashboard')
@section('page-title')
    {{__('Employee')}}
@endsection
@section('content')
<div class="row mt-4">
    <div class="col-12">
        <div class="page-title-box-hori">
            <h4 class="page-title">{{__('Manage Increments')}}</h4>
            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item"><a href="{{__('home')}}">{{__('Dashboard')}}</a></li>
                    <li class="breadcrumb-item active">{{__('Increment')}}</li>
                </ol>
            </div>
        </div>
    </div>
</div>
<hr class="mt-0 mb-2">

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <div class="d-flex justify-content-between w-100">
                    <h4>{{--__('Manage Increments')--}}</h4>
                    @can('Manage Increment')
                        <a href="{{ route('increment.create') }}" class="btn btn-icon icon-left btn-success">
                            <i class="fa fa-plus"></i> {{ __('Create') }}
                        </a>
                    @endcan
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped mb-0" id="dataTable">
                        <thead>
                        <tr>
                            <th>{{__('Employee')}}</th>
                          <th>{{__('Department') }}</th>
                           <th>{{__('Joining Date') }}</th>
                           <th>{{__('Increment Date') }}</th>
                           <th>{{__('Increment') }}</th>
                            @if(Gate::check('Manage Increment'))
                                <th class="text-right">{{__('Action')}}</th>
                            @endif
                        </tr>
                        </thead>
                        <tbody>

                        @foreach($increments as $increment)

                        <?php
                        $get_employee=DB::table("employees")->where("id",$increment->employee_id)->first();
                        $get_department=DB::table("departments")->where("id",$increment->department_id)->first();

                        ?>
                            <tr>


                                <td class="font-style">{{ $get_employee->first_name }} {{ $get_employee->last_name }}</td>
                                <td class="font-style">{{ $get_department->name}}</td>
                                <td class="font-style">{{$increment->joining_date}}</td>
                                <td class="font-style">{{$increment->increment_date}}</td>
                                <td class="font-style">{{$increment->increment_percent}}%</td>
                                @if(Gate::check('Manage Increment'))
                                    <td class="text-right">



                                            @can('Manage Increment')

                                                <a href="{{route('increment.edit',\Illuminate\Support\Facades\Crypt::encrypt($increment->id))}}" class="btn btn-outline-success  mr-1"><i class="fas fa-pencil-alt"></i> <span>{{__('Edit')}}</span></a>
                                            @endcan
                                            @can('Manage Increment')
                                                <a href="#" class="btn btn-outline-danger " data-toggle="tooltip" data-original-title="{{__('Delete')}}" data-confirm="Are You Sure?|This action can not be undone. Do you want to continue?" data-confirm-yes="document.getElementById('delete-form-{{$increment->id}}').submit();"><i class="fas fa-trash"></i> <span>{{__('Delete')}}</span></a>
                                                {!! Form::open(['method' => 'DELETE', 'route' => ['increment.destroy', $increment->id],'id'=>'delete-form-'.$increment->id]) !!}
                                                {!! Form::close() !!}

                                            @endcan


                                    </td>
                                @endif
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
