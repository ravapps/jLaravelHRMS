@extends('layouts.dashboard')
@section('page-title')
    {{__('Employee')}}
@endsection
@section('content')
<div class="row mt-4">
    <div class="col-12">
        <div class="page-title-box-hori">
            <h4 class="page-title">{{__('Employee Leave Detail')}}</h4>
            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                  <li class="breadcrumb-item"><a href="{{__('home')}}">{{__('Dashboard')}}</a></li>
                  <li class="breadcrumb-item"><a href="{{route('leave.index')}}">{{__('Leave')}}</a></li>
                  <li class="breadcrumb-item active">{{__('Leave Detail')}}</li>
                </ol>
            </div>
        </div>
    </div>
</div>
<hr class="mt-0">

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <div class="d-flex justify-content-between w-100">
                    <h4>{{--__('Manage Employee Leave')--}}</h4>
                    @can('Manage Leave Employee')
                        <!-- <a href="{{ route('manage_leave_employee.create') }}" class="btn btn-icon icon-left btn-success">
                            <i class="fa fa-plus"></i> {{ __('Create') }}
                        </a> -->
                        <a href="#" data-url="{{ route('manage_leave_employee.create') }}" class="btn btn-icon icon-left btn-success" data-ajax-popup="true" data-toggle="tooltip" data-title="{{__('Create New Leave')}}" data-employ_id="{{Request::segment(2)}}" data-original-title="{{__('Create Leave ')}}">
                            <i class="fa fa-plus"></i>  {{__('Create')}}
                        </a>
                    @endcan
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped mb-0" id="dataTable">
                        <thead>
                        <tr>
                            <th>{{__('Leave Name')}}</th>
                            <th>{{__('Total Leaves')}}</th>

                            @if(Gate::check('Manage Leave Employee'))
                                <th class="text-right" >{{__('Action')}}</th>
                            @endif
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($employees as $employee)

                        <?php
                    $get_leave_type=DB::table("leave_types")->where("id",$employee->leave_type_id)->first();
                        ?>
                            <tr>
                                <td>
                                   {{$get_leave_type->title}}
                                </td>

                                <td> {{$employee->total_leaves}}</td>




                                @if(Gate::check('Manage Leave Employee'))
                                    <td class="text-right">



                                            @can('Manage Leave Employee')

                                                <!-- <a href="{{route('manage_leave_employee.edit',\Illuminate\Support\Facades\Crypt::encrypt($employee->id))}}" class="btn btn-outline-success  mr-1"><i class="fas fa-pencil-alt"></i> <span>{{__('Edit')}}</span></a> -->
                                                <a href="#" data-url="{{ URL::to('manage_leave_employee/'.$employee->id.'/edit') }}" data-size="lg" data-ajax-popup="true" data-title="{{__('Edit Leave')}}" class="btn btn-outline-success  mr-1" data-toggle="tooltip" data-employ_id="{{Request::segment(2)}}" data-original-title="{{__('Edit')}}"><i class="fas fa-pencil-alt"></i> <span>{{__('Edit')}}</span></a>
                                            @endcan
                                            @can('Delete Employee')
                                                <a href="#" class="btn btn-outline-danger " data-toggle="tooltip" data-original-title="{{__('Delete')}}" data-confirm="Are You Sure?|This action can not be undone. Do you want to continue?" data-confirm-yes="document.getElementById('delete-form-{{$employee->id}}').submit();"><i class="fas fa-trash"></i> <span>{{__('Delete')}}</span></a>
                                                {!! Form::open(['method' => 'DELETE', 'route' => ['manage_leave_employee.destroy', $employee->id],'id'=>'delete-form-'.$employee->id]) !!}
                                                <input type="hidden" name="employee_ids" value="{{$employee->employee_id}}" >
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
