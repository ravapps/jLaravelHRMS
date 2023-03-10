@extends('layouts.dashboard')
@section('page-title')
    {{__('Promotion')}}
@endsection
@section('content')
<div class="row mt-4">
    <div class="col-12">
        <div class="page-title-box-hori">
            <h4 class="page-title">{{__('Add Promotion')}}</h4>
            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                  <li class="breadcrumb-item"><a href="{{__('home')}}">{{__('Dashboard')}}</a></li>
                  <li class="breadcrumb-item"><a href="{{route('employee.index')}}">{{__('Promotion')}}</a></li>
                  <li class="breadcrumb-item active">{{__('Add')}}</li>
                </ol>
            </div>
        </div>
    </div>
</div>
<hr class="mt-0">

<form method="post" action="{{route('promotion.store')}}" enctype="multipart/form-data">
    @csrf
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
                                    <label>Designation From</label><span class="text-danger pl-1">*</span>
                                          <select name="designation_id"  class="form-control" id="designation_id">
                                                <option value="">Select Designation</option>

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
                                        @if($designations)
                                            @foreach($designations as $designation)
                                            <option value="{{$designation->id}}">{{$designation->name}}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                   <label>Promotion  Date</label><span class="text-danger pl-1">*</span>
                                   <input type="text" name="promotion_date" id="promotion_date" class="form-control datetime" required>
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
                                }
                            });
                        }


            });















        });



    </script>
@endpush
