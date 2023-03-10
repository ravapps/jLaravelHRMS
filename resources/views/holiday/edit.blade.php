



@extends('layouts.dashboard')
@section('page-title')
    {{__('Holidays')}}
@endsection
@section('content')
<div class="row mt-4">
    <div class="col-12">
        <div class="page-title-box-hori">
            <h4 class="page-title">{{__('Edit Holiday')}}</h4>
            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                  <li class="breadcrumb-item"><a href="{{__('home')}}">{{__('Dashboard')}}</a></li>
                  <li class="breadcrumb-item"><a href="{{route('holiday.index')}}">{{__('Holidays')}}</a></li>
                  <li class="breadcrumb-item active">{{__('Edit')}}</li>
                </ol>
            </div>
        </div>
    </div>
</div>
<hr class="mt-0">


{{ Form::model($holiday, array('route' => array('holiday.update', $holiday->id), 'method' => 'PUT')) }}
    <div class="row">
            <div class="col-md-12 ">
                <div class="card ">
                    <!-- <div class="card-header"><h4>{{__('Holiday Details')}}</h4></div> -->
                    <div class="card-body ">


                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                <label>Holiday Name</label><span class="text-danger pl-1">*</span>

                                   <input type="text" name="occasion" value="{{$holiday->occasion}}"  id="occasion" class="form-control" required>
                                </div>
                            </div>
                            <?php //echo $holiday->date;exit;?>
                            <div class="col-md-4">
                                <div class="form-group">
                                   <label>Start Date</label><span class="text-danger pl-1">*</span>

                                   <input type="text" name="date" value="{{date('d-m-Y', strtotime($holiday->date))}}"  id="date" class="form-control datetime1" required>
                                </div>
                            </div>

                            <div class="col-md-4" >
                                <div class="form-group">
                                   <label>End Date</label><span class="text-danger pl-1">*</span>

                                   <input type="text" name="end_date" value="{{date('d-m-Y', strtotime($holiday->end_date))}}" id="end_date" class="form-control datetime1" required>
                                </div>
                            </div>


                        </div>



                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                <label>Start Time</label><span class="text-danger pl-1">*</span>

                                   <input type="text" name="start_time" value="{{$holiday->start_time}}"  id="start_time" class="form-control datetime" required>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                   <label>End Time</label><span class="text-danger pl-1">*</span>

                                   <input type="text" name="end_time" value="{{$holiday->end_time}}"  id="end_time" class="form-control datetime" required>
                                </div>
                            </div>




                        </div>


                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                <label>Comment</label><span class="text-danger pl-1">*</span>

                                  <textarea name="comment" class="form-control" required>{{$holiday->comment}}</textarea>
                                </div>
                            </div>


                        </div>



                        <div class="row">
                        <div class="col-md-12 col-sm-12 col-xs-12">
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
  </script>
@endpush
