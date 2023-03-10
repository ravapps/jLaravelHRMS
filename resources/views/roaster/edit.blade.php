

@extends('layouts.dashboard')
@section('page-title')
    {{__('Update Shift Roster')}}
@endsection
@section('content')


<div class="row mt-4">
    <div class="col-12">
        <div class="page-title-box-hori">
            <h4 class="page-title">{{__('Edit Shift Roster')}}</h4>
            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                  <li class="breadcrumb-item"><a href="{{__('home')}}">{{__('Dashboard')}}</a></li>
                  <li class="breadcrumb-item"><a href="{{route('roaster.index')}}">{{__('Shift Roster')}}</a></li>
                  <li class="breadcrumb-item active">{{__('Edit')}}</li>
                </ol>
            </div>
        </div>
    </div>
</div>
<hr class="mt-0">
@if(Session::has('error'))
<span class="text-danger pl-1">{{ Session::get('error') }}</span><br>
@endif
{{Form::model($emproastershifts,array('route' => array('roaster.update', $emproastershifts->id), 'method' => 'PUT', 'enctype' => 'multipart/form-data',  'onsubmit' => 'return checkDate();')) }}

        <div class="row">
            <div class="col-md-12 ">
                <div class="card ">
                    <!-- <div class="card-header"><h4>{{__('Shift Roster')}}</h4></div> -->
                    <div class="card-body ">

                        <div class="row">

                            <div class="col-md-6">
                                    <div class="form-group" >
                                        <label>Employee Name</label><span class="text-danger pl-1">*</span>

                                       <select class="form-control" name="employee_id" readonly disabled>
                                        <option value=""> Select Employee</option>
                                        @if(!empty($employees))
                                            @foreach($employees as $row)
                                             <option value="{{$row->id}}" @if($row->id==$emproastershifts->employee_id) selected='selected' @endif>{{$row->first_name}} {{$row->last_name}}</option>
                                            @endforeach
                                        @endif
                                       </select>
                                    </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">Employee Designation</label>
                                    <select class="form-control custom-select" name="designation_id" id="designation_id" readonly >

                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">Client Name</label>
                                    <select class="form-control custom-select" name="cid" id="cid" required="">
                                        <option value="0">Select Site</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">Site Address</label>
                                    <select class="form-control custom-select" name="siteid" id="siteid" required="">
                                        <option value="0">Select Site</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Start Date</label><span class="text-danger pl-1">*</span>
                                        <input type="text" name="from_date"  id="from_date"  value="{{date('d-m-Y',strtotime($emproastershifts->from_date))}}" id="" class="form-control datetime"   required>
                                    </div>
                            </div>
                                <div class="col-md-6">
                                        <div class="form-group">
                                            <label>End Date</label><span class="text-danger pl-1">*</span>
                                            <input type="text" name="to_date"  id="to_date"  value="{{date('d-m-Y',strtotime($emproastershifts->to_date))}}"  class="form-control datetime"   required>
                                        </div>
                                </div>
                                <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Shift</label><span class="text-danger pl-1">*</span>
                                            <select class="form-control" readonly name="shift_type" id="shift_type">
                                                <option value=""> Select Shift</option>
                                                    @if(!empty($get_shift))
                                                    @foreach($get_shift as $row)
                                                    <option value="{{$row->id}}" @if($row->id==$emproastershifts->shift_type) selected='selected' @endif>{{$row->name}}</option>
                                                    @endforeach
                                                    @endif
                                            </select>
                                        </div>
                                </div>
                                <div class="col-md-6">
                                        <div class="form-group">
                                <label>Working Hours</label><span class="text-danger pl-1">*</span>
                                <select class="form-control" readonly name="weekdays" required="">
                                    <option  @if($row->weekdays=='1') selected='selected' @endif value="1">Monday - Friday</option>
                                    <option  @if($row->weekdays=='2') selected='selected' @endif  value="2">Monday - Saturday</option>
                                </select>
                              </div>
              </div>
                        </div>




                        <div class="row">
                                <div class="col-md-12">
                                  <input type="hidden" name="oldurl" value="{{url()->previous()}}">
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
    locale: {
      format: 'DD-MM-YYYY'
    },
    singleDatePicker: true,
    showDropdowns: true,
    minYear: 1901,
    maxYear: parseInt(moment().format('YYYY'),10)
  }, function(start, end, label) {
    var years = moment().diff(start, 'years');

  });


    $(document).ready(function () {
      var d_id = {{$emproastershifts->employee_id}};
      if(d_id)
        getDesignation(d_id);
      //$("#shift_type").val({{$emproastershifts->shift_type}});



      function getDesignation(did) {
          console.log('here');
         $.ajax({
              url: '{{route('employee.json10')}}',
              type: 'POST',
              data: {
                  "employee_id": did, "_token": "{{ csrf_token() }}",
              },
              success: function (data) {
                console.log(data);
                $('#designation_id').empty();
                 $.each(data, function (key, value) {
                    //console.log(key);
                    if(key == 'shiftid') {
                      $("#shift_type").val(value);
                    } else if(key == 'weekdays') {
                      $("#weekdays").val(value);
                    } else {
                      $('#designation_id').append('<option value="' + key + '">' + key + '-' + value + '</option>');
                    }
                  });

              }
          });
      }


    });



    function checkDate() {
      console.log(Date(document.getElementById("from_date").value));
      console.log(Date(document.getElementById("to_date").value));

      var x = document.getElementById("from_date").value;
      var y = document.getElementById("to_date").value;
      d1 = x.split("-");
      d2 = y.split("-");
      var fd = new Date(d1[2],d1[1],d1[0]);
      var td = new Date(d2[2],d2[1],d2[0]);
      console.log(d1);
      console.log(d2);
      console.log(fd>td);
      console.log(td>fd);
      if(fd>td) {
        alert('Please specify valid from date and to date.');
        return false;
      }
      return true;
    }

  </script>
@endpush
