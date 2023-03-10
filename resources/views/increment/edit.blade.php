@extends('layouts.dashboard')
@section('page-title')
    {{__('Employee')}}
@endsection
@section('content')
<div class="row mt-4">
    <div class="col-12">
        <div class="page-title-box-hori">
            <h4 class="page-title">{{__('Edit Increment')}}</h4>
            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item"><a href="{{__('home')}}">{{__('Dashboard')}}</a></li>
                    <li class="breadcrumb-item"><a href="{{route('increment.index')}}">{{__('Increment')}}</a></li>
                    <li class="breadcrumb-item active">{{__('Edit')}}</li>
                </ol>
            </div>
        </div>
    </div>
</div>
<hr class="mt-0 mb-2">

{{Form::model($increments,array('route' => array('increment.update', $increments->id), 'method' => 'PUT')) }}


    <div class="section-body">
        <div class="row">
            <div class="col-md-12 ">
                <div class="card ">
                    <!-- <div class="card-header"><h4>{{__('Increment Details')}}</h4></div> -->
                    <div class="card-body ">

                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                   <label>Employee Name</label><span class="text-danger pl-1">*</span>
                                    <select name="emp_ids" required class="form-control select2" id="emp_ids">
                                        <option value="{{$get_employee->id}}">{{$get_employee->first_name}} {{$get_employee->last_name}}</option>

                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Department Name</label><span class="text-danger pl-1">*</span>
                                            <select name="department_id"  class="form-control select2" id="department_id">
                                                <option value="{{$department->id}}">{{$department->name}}</option>

                                            </select>
                                    </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Designation</label><span class="text-danger pl-1">*</span>
                                          <select name="designation_id"  class="form-control select2" id="designation_id">
                                             <option value="{{$designations->id}}">{{$designations->name}}</option>

                                            </select>
                                    </div>
                            </div>

                        </div>



                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                   <label>Joining Date</label><span class="text-danger pl-1">*</span>
                                   <input type="text" name="joining_date" id="joining_date" class="form-control" value="{{date('d-m-Y', strtotime($increments->joining_date))}}" readonly>
                                </div>
                            </div>
                            <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Salary Type</label><span class="text-danger pl-1">*</span>
                                        <input type="text" name="salary_type" id="salary_type" class="form-control" value="{{$increments->salary_type}}" readonly>
                                    </div>
                            </div>
                            <?php $get_grade= DB::table("emp_paygrades")->where("id",$increments->grade_id)->first();?>
                            <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Grade Type</label><span class="text-danger pl-1">*</span>
                                        <select name="grade_id"  class="form-control" id="grade_id">

                                            <option value="{{$get_grade->id}}">{{$get_grade->grade_name}}</option>
                                            </select>
                                    </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Previous Salary</label><span class="text-danger pl-1">*</span>
                                    <input type="text" name="previous_salary" class="form-control" id="previous_salary" value="{{$increments->previous_salary}}" readonly>
                                    </div>
                            </div>

                        </div>


                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                   <label>Increment Date</label><span class="text-danger pl-1">*</span>
                                   <input type="text" name="increment_date" id="increment_date" class="form-control datetime" value="{{date('d-m-Y', strtotime($increments->increment_date))}}" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Increment Percentage</label><span class="text-danger pl-1">*</span>
                                        <input type="text" name="increment_percent" id="increment_percent" class="form-control" value="{{$increments->increment_percent}}" required>
                                    </div>
                            </div>


                        </div>

                        <div class="row">
                          <div class="col-sm-12">
                            {!! Form::submit('Update', ['class' => 'btn btn-success float-right']) !!}
                          </div>
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
    <script>
    function readURL(input) {
  if (input.files && input.files[0]) {
    var reader = new FileReader();

    reader.onload = function(e) {
      $('.custom-file-container__image-preview').html('<img src="'+e.target.result+'" style="width:150px;height:150px;">');
    }

    reader.readAsDataURL(input.files[0]); // convert to base64 string
  }
}




    </script>
@endpush
