

@extends('layouts.dashboard')
@section('page-title')
    {{__('Update Shift Type')}}
@endsection
@section('content')
<div class="row mt-4">
    <div class="col-12">
        <div class="page-title-box-hori">
            <h4 class="page-title">{{__('Edit Shift Type')}}</h4>
            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                  <li class="breadcrumb-item"><a href="{{__('home')}}">{{__('Dashboard')}}</a></li>
                  <li class="breadcrumb-item"><a href="{{route('commission.index')}}">{{__('Shift Type')}}</a></li>
                  <li class="breadcrumb-item active">{{__('Edit')}}</li>
                </ol>
            </div>
        </div>
    </div>
</div>
<hr class="mt-0">
{{Form::model($shift_type,array('route' => array('shift_type.update', $shift_type->id), 'method' => 'PUT', 'enctype' => 'multipart/form-data','onsubmit' => 'return Checktimes();')) }}

        <div class="row">
            <div class="col-md-12 ">
                <div class="card ">
                    <!-- <div class="card-header"><h4>{{__('Shift Type Details')}}</h4></div> -->
                    <div class="card-body ">

                        <div class="row">

                            <div class="col-md-6">
                                    <div class="form-group" >
                                        <label>Shift Name</label><span class="text-danger pl-1">*</span>

                                        <input type="text" name="name" value="{{$shift_type->name}}" id="name" class="form-control"   required>
                                    </select>
                                    </div>
                            </div>
                            <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Start Time</label><span class="text-danger pl-1">*</span>
                                        <input type="text" name="start_time" value="{{$shift_type->start_time}}" id="start_time" class="form-control time-picker"   required>
                                    </div>
                            </div>



                        </div>
                        <div class="row">
                                <div class="col-md-6">
                                        <div class="form-group">
                                            <label>End Time</label><span class="text-danger pl-1">*</span>
                                            <input type="text" name="end_time" value="{{$shift_type->end_time}}" id="end_time" class="form-control time-picker"   required>
                                        </div>
                                </div>
                                <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Late Count Time</label><span class="text-danger pl-1">*</span>
                                            <input type="text" name="late_time" value="{{$shift_type->late_time}}" id="late_time" class="form-control time-picker"   required>
                                        </div>
                                </div>
                        </div>

                        <div class="row">
                                <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Working Days</label><span class="text-danger pl-1">*</span>
                                            <select class="form-control" name="weekdays" required="">
                                                <option @if($shift_type->weekdays == 1) selected @endif value="1">Monday - Friday</option>
                                                <option @if($shift_type->weekdays == 2) selected @endif value="2">Monday - Saturday</option>
                                            </select>
                                        </div>
                                </div>
                                <div class="col-md-6">
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
$('.time-picker').timepicker({
            showMeridian: false
        });


function Checktimes() {
  var fromtime = document.getElementById("start_time").value;
  var totime =  document.getElementById("end_time").value;
  var latetime = document.getElementById("late_time").value;
console.log(parseInt(fromtime));
console.log(parseInt(totime));
console.log(parseInt(latetime));

if((parseInt(fromtime) == parseInt(totime)) || (parseInt(totime) == parseInt(latetime))) {
  alert('Time ranges should have atleast 1 hour difference');
  return false;
} else {
  if((parseInt(fromtime) > parseInt(totime)) || (parseInt(totime) > parseInt(latetime))) {
    alert('Wrong time range specified.');
    return false;
  }
}

  return true;
}
</script>
@endpush
