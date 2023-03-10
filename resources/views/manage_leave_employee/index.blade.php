@extends('layouts.dashboard')
@section('page-title')
    {{__('Employee')}}
@endsection
@section('content')


<div class="row mt-4">
    <div class="col-12">
        <div class="page-title-box-hori">
            <h4 class="page-title">{{__('Manage Leave')}}</h4>
            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                  <li class="breadcrumb-item"><a href="{{__('home')}}">{{__('Dashboard')}}</a></li>
                  <!-- <li class="breadcrumb-item"><a href="{{route('leave.index')}}">{{__('Leave')}}</a></li> -->
                  <li class="breadcrumb-item active">{{__('Leave')}}</li>
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
                    <h4>{{--__('Manage Employee')--}}</h4>
                    @can('Create Employee')
                        <a href="{{ route('employee.create') }}" class="btn btn-icon icon-left btn-success">
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
                            <th>{{__('Employee ID')}}</th>
                            <th>{{__('Photo')}}</th>
                            <th>{{__('Name')}}</th>
                           <th>{{__('Department') }}</th>
                            <th>{{__('Phone') }}</th>
                            <th>{{__('Employee Type') }}</th>
                            <th>{{__('Date Of Joining') }}</th>
                            @if(Gate::check('Edit Employee') || Gate::check('Delete Employee'))
                                <th class="text-right">{{__('Action')}}</th>
                            @endif
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($employees as $employee)
                            <tr>
                                <td>
                                    @can('Show Employee')
                                        <a href="{{route('employee.show',\Illuminate\Support\Facades\Crypt::encrypt($employee->id))}}" class="btn  btn-success">{{ \Auth::user()->employeeIdFormat($employee->employee_id) }}</a>
                                    @else
                                        <a href="#" class="btn  btn-success">{{ \Auth::user()->employeeIdFormat($employee->employee_id) }}</a>
                                    @endcan
                                </td>

                                <td> <img src="{{asset('public/uploads/document/')}}/{{$employee->documents}}" style="width:50px;"></td>
                                <td class="font-style">{{ $employee->first_name }} {{ $employee->last_name }}</td>
                                <td class="font-style">{{!empty(\Auth::user()->getDepartment($employee->department_id ))?\Auth::user()->getDepartment($employee->department_id )->name:''}} <br/>Designation :{{!empty(\Auth::user()->getDesignation($employee->designation_id ))?\Auth::user()->getDesignation($employee->designation_id )->name:''}}</td>
                                <td class="font-style">{{$employee->phone}}</td>
                                <td class="font-style">{{$employee->emp_type}}</td>

                                <td class="font-style">{{ \Auth::user()->dateFormat($employee->company_doj )}}</td>


                                @if(Gate::check('Edit Employee') || Gate::check('Delete Employee') || Gate::allows('Manage Leave Employee'))
                                    <td class="text-right">


                                        @if($employee->is_active==1)
                                            @can('Edit Employee')
                                                {{--                                                                <a href="{{ URL::to('employee/'.$employee->id.'/edit') }}" class="btn btn-outline-success  mr-1"><i class="fas fa-pencil-alt"></i> <span>{{__('Edit')}}</span></a>--}}
                                                <a href="{{route('employee.edit',\Illuminate\Support\Facades\Crypt::encrypt($employee->id))}}" class="btn btn-outline-success  mr-1"><i class="fas fa-pencil-alt"></i> <span>{{__('Edit')}}</span></a>
                                            @endcan
                                            @can('Delete Employee')
                                                <a href="#" class="btn btn-outline-danger " data-toggle="tooltip" data-original-title="{{__('Delete')}}" data-confirm="Are You Sure?|This action can not be undone. Do you want to continue?" data-confirm-yes="document.getElementById('delete-form-{{$employee->id}}').submit();"><i class="fas fa-trash"></i> <span>{{__('Delete')}}</span></a>
                                                {!! Form::open(['method' => 'DELETE', 'route' => ['employee.destroy', $employee->id],'id'=>'delete-form-'.$employee->id]) !!}
                                                {!! Form::close() !!}

                                            @endcan
                                            @can('Manage Leave Employee')
                                             <br/> <a href="{{route('employee.manage_leave',\Illuminate\Support\Facades\Crypt::encrypt($employee->id))}}" class="btn btn-outline-success  mr-1"><i class="fas fa-pencil-alt"></i> <span>{{__('Manage Leave')}}</span></a>
                                             @endcan
                                        @else
                                            <i class="fas fa-lock"></i>
                                        @endif
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
