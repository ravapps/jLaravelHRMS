@extends('layouts.dashboard')
@section('page-title')
    {{__('Promotion')}}
@endsection
@section('content')

<div class="row mt-4">
    <div class="col-12">
        <div class="page-title-box-hori">
            <h4 class="page-title">{{__('Edit Promotion')}}</h4>
            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                  <li class="breadcrumb-item"><a href="{{__('home')}}">{{__('Dashboard')}}</a></li>
                  <li class="breadcrumb-item"><a href="{{route('employee.index')}}">{{__('Promotion')}}</a></li>
                  <li class="breadcrumb-item active">{{__('Edit')}}</li>
                </ol>
            </div>
        </div>
    </div>
</div>
<hr class="mt-0">

{{Form::model($promotion,array('route' => array('promotion.update', $promotion->id), 'method' => 'PUT')) }}


<div class="row">
    <div class="col-md-12 ">
        <div class="card ">
            <!-- <div class="card-header"><h4>{{--__('Promotion Details')--}}</h4></div> -->
            <div class="card-body ">

                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                           <label>Employee Name</label><span class="text-danger pl-1">*</span>
                            <select name="emp_ids" required class="form-control" id="emp_ids">
                                <option value="{{$get_employee->id}}">{{$get_employee->first_name}} {{$get_employee->last_name}}</option>

                            </select>
                        </div>
                    </div>
                    <div class="col-md-4">
                            <div class="form-group">
                                <label>Department Name</label><span class="text-danger pl-1">*</span>
                                    <select name="department_id"  class="form-control" id="department_id">
                                        <option value="{{$department->id}}">{{$department->name}}</option>

                                    </select>
                            </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Designation</label><span class="text-danger pl-1">*</span>
                                  <select name="designation_id"  class="form-control" id="designation_id">
                                     <option value="{{$designations->id}}">{{$designations->name}}</option>

                                    </select>
                            </div>
                    </div>

                </div>






                        <div class="row">

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Designation to</label><span class="text-danger pl-1">*</span>
                                        <select name="designation_to_id" required class="form-control" id="designation_to_id">
                                            <option value="">Select Employee</option>
                                            @if($designations1)
                                            @foreach($designations1 as $designation)
                                            <option value="{{$designation->id}}" <?php if($designation->id==$promotion->designation_to_id) echo 'selected="selected"'?>>{{$designation->name}}</option>
                                            @endforeach
                                            @endif
                                        </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Promotion  Date</label><span class="text-danger pl-1">*</span>
                                    <input type="text" name="promotion_date" id="promotion_date" class="form-control datetime" value="{{date('d-m-Y', strtotime($promotion->promotion_date))}}" required>
                                </div>
                            </div>



                        </div>

                        <div class="row">

                            <div class="col-md-12">
                              {!! Form::submit('Update', ['class' => 'btn btn-success float-right']) !!}
                            </div>
                          </div>





            </div>
        </div>
    </div>



  </div>

{!! Form::close() !!}

@endsection

@push('script-page')
<script>
$('.datetime').daterangepicker({

            singleDatePicker: true,

            locale: {
                format: 'DD-MM-YYYY'
            }

        });
  </script>

@endpush
