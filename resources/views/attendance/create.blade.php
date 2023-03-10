@extends('layouts.dashboard')
@section('page-title')
    {{__('Create Attendance')}}
@endsection
@section('content')
<div class="row mt-4">
    <div class="col-12">
        <div class="page-title-box-hori">
            <h4 class="page-title">{{__('Add Attendance')}}</h4>
            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                  <li class="breadcrumb-item"><a href="{{__('home')}}">{{__('Dashboard')}}</a></li>
                  <li class="breadcrumb-item"><a href="{{route('attendanceemployee.index')}}">{{__('Attendance')}}</a></li>
                  <li class="breadcrumb-item active">{{__('Add')}}</li>
                </ol>
            </div>
        </div>
    </div>
</div>
<hr class="mt-0">
{{Form::open(array('url'=>'attendanceemployee','method'=>'post'))}}
<div class="row">
    <div class="col-md-12 ">
        <div class="card ">
            <!-- <div class="card-header"><h4>{{__('Attendance Details')}}</h4></div> -->
            <div class="card-body ">


                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Employee</label>
                                <select name="employee_id" id="employee_id_s" required class="form-control">
                                    <option value="">Select Employee</option>
                                    @if(!empty($employees))
                                    @foreach($employees as $row)
                                    <option value="{{$row->id}}">{{$row->first_name}} {{$row->last_name}}</option>
                                    @endforeach
                                    @endif

                                </select>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                                <label>Shift Name</label>
                                   <input type="text" id="sh_name" class="form-control" required readonly>
                                   <input type="hidden" name="shift_id" id="shift_id">
                        </div>
                    </div>

                    <div class="col-md-4" >
                        <div class="form-group">
                        {{Form::label('date',__('Date'))}}
                         {{Form::text('date',null,array('class'=>'form-control datepicker'))}}
                        </div>
                    </div>


                </div>



                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                        {{Form::label('clock_in',__('Clock In'))}}
                         {{Form::text('clock_in',null,array('class'=>'form-control timepicker'))}}
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                        {{Form::label('clock_out',__('Clock Out'))}}
                            {{Form::text('clock_out',null,array('class'=>'form-control timepicker'))}}
                        </div>
                    </div>




                </div>





                <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12">
                    {!! Form::submit('Create', ['class' => 'btn btn-success float-right']) !!}
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
            timePicker: true,
            singleDatePicker: true,
            timePicker24Hour: false,
            timePickerIncrement: 1,
            timePickerSeconds: true,
            locale: {
                format: 'HH:mm:ss'
            }
        }).on('show.daterangepicker', function (ev, picker) {
            picker.container.find(".calendar-table").hide();
        });
  </script>

<script>
$('.datetime1').daterangepicker({

            singleDatePicker: true,

            locale: {
                format: 'DD-MM-YYYY'
            }

        });

        $(document).ready(function(){
            $("#employee_id_s").on("change",function(){
                var employee_id_s=$(this).val();
                    if(employee_id_s=='')
                    {
                        $("#sh_name").val('');
                            $("#shift_id").val('');
                        return false;
                    }
                    else
                    {
                        $.ajax({
                        url: '{{route('attendanceemployee.json')}}',
                        type: 'POST',
                        data: {
                            "employee_id_s": employee_id_s, "_token": "{{ csrf_token() }}",
                        },
                        success: function (data) {

                            $("#sh_name").val(data.get_name);
                            $("#shift_id").val(data.get_shift_id);
                            $("#clock_in").val(data.get_start_time);
                            $("#clock_out").val(data.get_end_time);
                        }
                        });
                    }

            });
        });
  </script>
@endpush
