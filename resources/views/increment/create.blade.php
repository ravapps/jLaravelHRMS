@extends('layouts.dashboard')
@section('page-title')
    {{__('Employee')}}
@endsection
@section('content')
<div class="row mt-4">
    <div class="col-12">
        <div class="page-title-box-hori">
            <h4 class="page-title">{{__('Add Increment')}}</h4>
            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item"><a href="{{__('home')}}">{{__('Dashboard')}}</a></li>
                    <li class="breadcrumb-item"><a href="{{route('increment.index')}}">{{__('Increment')}}</a></li>
                    <li class="breadcrumb-item active">{{__('Add')}}</li>
                </ol>
            </div>
        </div>
    </div>
</div>
<hr class="mt-0 mb-2">

<form method="post" action="{{route('increment.store')}}" enctype="multipart/form-data">
    @csrf
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
                                    <select name="emp_ids" required class="form-control" id="emp_ids">
                                        <option value="">Select Employee</option>
                                        @if($employees)
                                            @foreach($employees as $employee)
                                            <option value="{{$employee->id}}">{{$employee->first_name}} {{$employee->last_name}}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                    <div class="form-group" id="emp_department_text" style="display:none;">
                                        <label>Department Name</label><span class="text-danger pl-1">*</span>
                                            <select name="department_id"  class="form-control" id="department_id">
                                                <option value="">Select Department</option>

                                            </select>
                                    </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group" id="emp_designation_text" style="display:none;">
                                    <label>Designation</label><span class="text-danger pl-1">*</span>
                                          <select name="designation_id"  class="form-control" id="designation_id">
                                                <option value="">Select Designation</option>

                                            </select>
                                    </div>
                            </div>

                        </div>



                        <div class="row" id="salary_info_id" style="display:none;">
                            <div class="col-md-3">
                                <div class="form-group">
                                   <label>Joining Date</label><span class="text-danger pl-1">*</span>
                                   <input type="text" name="joining_date" id="joining_date" class="form-control" readonly>
                                </div>
                            </div>
                            <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Salary Type</label><span class="text-danger pl-1">*</span>
                                        <input type="text" name="salary_type" id="salary_type" class="form-control" readonly>
                                    </div>
                            </div>
                            <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Grade Type</label><span class="text-danger pl-1">*</span>
                                        <select name="grade_id"  class="form-control" id="grade_id">


                                            </select>
                                    </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Previous Salary</label><span class="text-danger pl-1">*</span>
                                    <input type="text" name="previous_salary" class="form-control" id="previous_salary" readonly>
                                    </div>
                            </div>

                        </div>


                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                   <label>Increment Date</label><span class="text-danger pl-1">*</span>
                                   <input type="text" name="increment_date" id="increment_date" class="form-control datetime" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Increment Percentage</label><span class="text-danger pl-1">*</span>
                                        <input type="text" name="increment_percent" id="increment_percent" class="form-control" required>
                                    </div>
                            </div>


                        </div>

                        <div class="row">
                            <div class="col-md-12">

                              {!! Form::submit('Create', ['class' => 'btn btn-success float-right']) !!}
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


        $(document).ready(function () {

            $("#emp_ids").on("change",function(){
               var emp_ids=$(this).val();

                 if(emp_ids==''){

                            $("#emp_department_text").hide();
                            $("#emp_designation_text").hide();
                            $("#salary_info_id").hide();

                            return false;
                        }
                        else
                        {
                            $.ajax({
                                url: '{{route('increment.json')}}',
                                type: 'POST',
                                data: {
                                "emp_ids": emp_ids, "_token": "{{ csrf_token() }}",
                                },
                                success: function (data) {


                                    $("#salary_info_id").show();
                                    $("#salary_type").val(data.salary_type);
                                    $("#previous_salary").val(data.salary_amount);
                                    $("#joining_date").val(data.joining);

                                            $("#emp_department_text").show();
                                            $("#emp_designation_text").show();

                                            $("#department_id").html(data.html);
                                            $("#designation_id").html(data.html1);
                                            $("#grade_id").html(data.html12);
                                }
                            });
                        }


            });















        });



    </script>
@endpush
