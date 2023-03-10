@extends('layouts.dashboard')
@section('page-title')
    {{__('Salary')}}
@endsection
@section('content')
<div class="row mt-4">
    <div class="col-12">
        <div class="page-title-box-hori">
            <h4 class="page-title">{{__('Employee Salary')}}</h4>
            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item"><a href="{{__('home')}}">{{__('Dashboard')}}</a></li>
                    <li class="breadcrumb-item active">{{__('Employee Salary')}}</li>
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
                    <h4>{{--__('Employee Salary')--}}</h4>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped mb-0" id="dataTable">
                        <thead>
                          <tr>
                              <th>{{__('Employee Id')}}</th>
                              <th>{{__('Name')}}</th>
                              <th>{{__('Payroll Type') }}</th>
                              <th>{{__('Salary') }}</th>
                              <th>{{__('Net Salary') }}</th>
                              <th class="text-right">{{__('Action')}}</th>
                          </tr>
                        </thead>
                        <tbody>
                        @foreach ($employees as $employee)

                            <tr>
                                <td>{{ \Auth::user()->employeeIdFormat($employee->employee_id) }}</td>
                                <td>{{ $employee->name }}</td>
                                <td>{{ $employee->salary_type() }}</td>
                                <td>{{  \Auth::user()->priceFormat($employee->salary) }}</td>
                                <td>{{  !empty($employee->get_net_salary()) ?\Auth::user()->priceFormat($employee->get_net_salary()):'' }}</td>
                                <td class="text-right">
                                    <a href="{{route('setsalary.show',$employee->id)}}" class="btn btn-outline-warning  mr-1">
                                        <i class="fas fa-eye"> <span>{{__('View')}}</span></i>
                                    </a>
                                    @can('Edit Set Salary')
                                        <a href="{{ URL::to('setsalary/'.$employee->id.'/edit') }}" class="btn btn-outline-success  mr-1">
                                            <i class="fas fa-pencil-alt"></i> <span>{{__('Edit')}}</span>
                                        </a>
                                    @endcan


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
