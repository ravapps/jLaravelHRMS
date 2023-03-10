@extends('layouts.dashboard')
@section('page-title')
    {{__('Employee')}}
@endsection
@section('content')
<style>
input[type="file"] {
  display: block;
}
.imageThumb {
  max-height: 75px;
  border: 2px solid;
  padding: 1px;
  cursor: pointer;
}
.pip {
  display: inline-block;
  margin: 10px 10px 0 0;
}
.img-delete {
  display: block;
  background: #444;
  border: 1px solid black;
  color: white;
  text-align: center;
  cursor: pointer;
}
.img-delete:hover {
  background: white;
  color: black;
}
</style>
<div class="row mt-4">
    <div class="col-12">
        <div class="page-title-box-hori">
            <h4 class="page-title">{{__('Salary Date')}}</h4>
            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                  <li class="breadcrumb-item"><a href="{{__('home')}}">{{__('Dashboard')}}</a></li>
                  <li class="breadcrumb-item"><a href="{{route('employee.index')}}">{{__('Salary Date')}}</a></li>
                  <li class="breadcrumb-item active">{{__('Create')}}</li>
                </ol>
            </div>
        </div>
    </div>
</div>
<hr class="mt-0">

<form method="post" action="{{url('set_salary_date_emp')}}">
    @csrf
    <input type="hidden" name="emp_c_d" id="emp_c_d" value="{{$get_employee_salary_date->id}}">
    <input type="hidden" name="emp_sal_id" id="emp_sal_id" value="{{Request::segment(2)}}">
    <div class="row">
        <div class="col-md-12 ">
            <div class="card ">
                <!-- <div class="card-header"><h4>{{__('Salary Date Details')}}</h4></div> -->
                <div class="card-body ">
                @php $data_range=range(1,31);@endphp
                  <div class="row">
                      <div class="col-md-6">
                              <div class="form-group">
                                  <label>From</label><span class="text-danger pl-1">*</span>
                                  <select name="emp_from_d" required class="form-control" id="emp_from_d">
                                  <option value="">Select From</option>
                                  @foreach($data_range as $row)
                                  <option value="{{$row}}" @if(!empty($get_employee_salary_date) && $get_employee_salary_date->from_d==$row) selected="selected" @endif>{{$row}}</option>
                                  @endforeach
                                  </select>
                              </div>
                          </div>
                          <div class="col-md-6">
                              <div class="form-group">
                                  <label>To</label><span class="text-danger pl-1">*</span>
                                  <select name="emp_to_d" required class="form-control" id="emp_to_d">
                                  <option value="">Select To</option>
                                  @foreach($data_range as $row)
                                  <option value="{{$row}}" @if(!empty($get_employee_salary_date) && $get_employee_salary_date->to_d==$row) selected="selected" @endif>{{$row}}</option>
                                  @endforeach
                                  </select>
                              </div>
                      </div>
                  </div>
                  <div class="row">
                    <div class="col-md-12">
                      <div class="form-group">
                        <button type="submit" class="btn btn-success" >{{__('Save')}}</button>
                      </div>
                    </div>
                  </div>
                </div>
            </div>
        </div>
    </div>

{!! Form::close() !!}

@endsection
