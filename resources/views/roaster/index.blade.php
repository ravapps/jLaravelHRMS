@extends('layouts.dashboard')
@section('page-title')
    {{__('Shift Roster')}}
@endsection
@section('styles')

<link href="{{ asset('public/new_assets/libs/@fullcalendar/core/main.min.css') }}" rel="stylesheet" type="text/css">
<link href="{{ asset('public/new_assets/libs/@fullcalendar/daygrid/main.min.css') }}" rel="stylesheet" type="text/css">
<link href="{{ asset('public/new_assets/libs/@fullcalendar/bootstrap/main.min.css') }}" rel="stylesheet" type="text/css">
<link href="{{ asset('public/new_assets/libs/@fullcalendar/timegrid/main.min.css') }}" rel="stylesheet" type="text/css">
<link href="{{ asset('public/new_assets/libs/@fullcalendar/list/main.min.css') }}" rel="stylesheet" type="text/css">

@stop
@section('content')
<div class="row mt-4">
    <div class="col-12">
        <div class="page-title-box-hori">
            <h4 class="page-title">{{__('Shift Roster')}}</h4>
            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item"><a href="{{__('home')}}">{{__('Dashboard')}}</a></li>
                    <li class="breadcrumb-item active">{{__('Shift Roster')}}xxx</li>
                </ol>
            </div>
        </div>
    </div>
</div>
<hr class="mt-0 mb-2">
@if(Session::has('error'))
<span class="text-danger pl-1">{{ Session::get('error') }}</span><br>
@endif
<div class="row">
    <div class="col-md-12">
      <div class="card">
        <div class="card-body">
          <div class="row">
              <div class="col">
                <div class="row">
                  <!-- <div class="col">
                    <div class="form-group">
                        <input type="text" class="form-control" value="" placeholder="Search By keywords...">
                    </div>
                  </div> -->
                <?php if(empty($id)) $id = "" ?>
                  <div class="col">
                    <div class="form-group">
                        <select name="employee_id" class="form-control select2" id="employee_id" onchange="document.location.href='{{ URL::to('roaster') }}'+'/'+document.getElementById('employee_id').value;">
                           <option value="">All</option>
                            @if($employees)
                                @foreach($employees as $employee)
                                <option value="{{$employee->id}}"  @if($employee->id==$id) selected='selected'  @endif >{{$employee->first_name}} {{$employee->last_name}}</option>
                                @endforeach
                            @endif
                        </select>


                    </div>
                  </div>
                  <div class="col">
                    <div class="form-group" style="display:none;">
                        <select class="form-control select2">
                          <option value="">Customer Name</option>
                          <option value="">Robik Udin</option>
                          <option value="">Jhon Deo</option>
                        </select>
                        <input type="hidden" value="0" name="cid">
                    </div>
                  </div>
                  <div class="col">
                    <div class="form-group" style="display:none;">
                      <select class="form-control custom-select" name="" id="" required="">
                        <option value="">Site Address</option>
                          <option value="">Balestier Plaza 400 Balestier Road #02-20, Singapore 310170</option>
                          <option value="">545 Orchard Road #11-12, Singapore 310170 </option>
                      </select>
                      <input type="hidden" value="0" name="siteid">
                    </div>
                  </div>
                  <form method="post" action="{{route('roaster.export')}}"  name="repofrm" id="repofrm"  >
                  <div class="col">
                      <div class="form-group">
                          <div class="input-group">
                            <input type="text" class="form-control datetime" name="fromdate"  id="fromdate">
                            <span class="input-group-text">
                              To
                            </span>
                            <input type="text" class="form-control datetime" name="todate"  id="todate" >
                            <input type="hidden" name="employee_id" value="{{$id}}">
                              @csrf
                          </div>
                      </div>
                  </div>
                  <div class="col-auto">
                      <div class="float-end">
                        <a href="javascript:;" onclick="return checkDate();" class="btn btn-success waves-effect waves-light mb-3"><i class="fa fa-download me-1"></i> Report</a>
                        <!-- <a href="{{ route('roaster.list') }}" class="btn btn-success waves-effect waves-light mb-3"><i class="fa fa-eye me-1"></i> List</a> -->
                      </div>
                  </div>
                </form>
                </div>
              </div>

          </div>
        </div>
      </div>
    </div>
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-3">
                        @can('Create Roaster')
                            <a href="{{ route('roaster.create') }}" class="btn btn-lg font-16 btn-dark btn-block mt-2" >
                                <i class="fa fa-plus"></i> {{__('Create Roster')}}
                            </a>
                        @endcan
                        <!-- <button class="btn btn-lg font-16 btn-primary btn-block" id="btn-new-event"><i class="mdi mdi-plus-circle-outline"></i> Create New Event</button> -->
                        <div id="external-events" class="m-t-20">

                        </div>

                        <div class="external-event bg-primary" data-class="bg-primary">Supervisor</div>
                        <div class="external-event bg-success" data-class="bg-success">Cleaner</div>
                        <div class="external-event bg-warning" data-class="bg-warning">Floater</div>

                    </div> <!-- end col-->

                    <div class="col-lg-9">
                        <div class="mt-4 mt-lg-0">
                            <div id="calendar"></div>
                        </div>
                    </div> <!-- end col -->

                </div>  <!-- end row -->

            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="event-modal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
          <!--  <div class="modal-header py-3 px-4 border-bottom-0 d-block">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h5 class="modal-title" id="modal-title">Event</h5>
            </div>
            <div class="modal-body p-4">
                <form class="needs-validation" name="event-form" id="form-event" novalidate="">
                    <div class="row">
                        <div class="col-12">
                            <div class="form-group" >
                                <label>Employee Name</label><span class="text-danger pl-1">*</span>
                               <select class="form-control" name="employee_id" required id="event-title">
                                 <option value=""> Select Employee</option>
                                 <option value=""> Jhon Deo</option>
                                 <option value=""> Robik Udin</option>
                               </select>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                <label class="control-label">Designation</label>
                                <select class="form-control custom-select" name="category" id="event-category" required="">
                                    <option value="bg-primary">Supervisor</option>
                                    <option value="bg-success">Cleaner</option>
                                    <option value="bg-warning">Floater</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                <label class="control-label">Client Name</label>
                                <select class="form-control custom-select" name="" id="" required="">
                                    <option value="">Jiahao Kong</option>
                                    <option value="">lee</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                <label class="control-label">Site Address</label>
                                <select class="form-control custom-select" name="" id="" required="">
                                    <option value="">Balestier Plaza 400 Balestier Road #02-20, Singapore 310170</option>
                                    <option value="">545 Orchard Road #11-12, Singapore 310170 </option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-group">
                              <label>Start Date</label><span class="text-danger pl-1">*</span>
                              <input type="text" name="from_date" value="" id="" class="form-control datetime"   required>
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-group">
                              <label>End Date</label><span class="text-danger pl-1">*</span>
                              <input type="text" name="to_date" value="" id="end_time" class="form-control datetime"   required>
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-group">
                            <label>Working Hours</label><span class="text-danger pl-1">*</span>
                            <select class="form-control" name="shift_type" required="">
                                <option value="1"> Select Working Hours</option>
                                <option value="2">Monday - Friday</option>
                                <option value="3">Monday - Saturday</option>
                            </select>
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-group">
                            <label>Shift</label><span class="text-danger pl-1">*</span>
                            <select class="form-control" name="shift_type" required="">
                                <option value=""> Select Shift</option>
                                <option value="2">Day Shift</option>
                                <option value="3">Night Shift</option>
                                <option value="4">Test</option>
                                <option value="5">Test User</option>
                            </select>
                          </div>
                        </div>
                    </div>
                    <div class="row mt-2">
                        <div class="col-6">
                            <button type="button" class="btn btn-danger" id="btn-delete-event">Delete</button>
                        </div>
                        <div class="col-6 text-right">
                            <button type="button" class="btn btn-light mr-1" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-success" id="btn-save-event">Save</button>
                        </div>
                    </div>
                </form>
            </div> -->
        </div> <!-- end modal-content-->
    </div> <!-- end modal dialog-->
</div>
@endsection

@section('scripts')

  <script src="{{ asset('public/new_assets/libs/@fullcalendar/core/main.min.js') }}"></script>
  <script src="{{ asset('public/new_assets/libs/@fullcalendar/bootstrap/main.min.js') }}"></script>
  <script src="{{ asset('public/new_assets/libs/@fullcalendar/daygrid/main.min.js') }}"></script>
  <script src="{{ asset('public/new_assets/libs/@fullcalendar/timegrid/main.min.js') }}"></script>
  <script src="{{ asset('public/new_assets/libs/@fullcalendar/list/main.min.js') }}"></script>
  <script src="{{ asset('public/new_assets/libs/@fullcalendar/interaction/main.min.js') }}"></script>

  <!-- Calendar init
  <script src="{{ asset('public/new_assets/js/pages/calendar.init.js') }}"></script>-->

<script>
!function(l){"use strict";function e(){this.$body=l("body"),this.$modal=l("#event-modal"),this.$calendar=l("#calendar"),this.$formEvent=l("#form-event"),this.$btnNewEvent=l("#btn-new-event"),this.$btnDeleteEvent=l("#btn-delete-event"),this.$btnSaveEvent=l("#btn-save-event"),this.$modalTitle=l("#modal-title"),this.$calendarObj=null,this.$selectedEvent=null,this.$newEventData=null}e.prototype.onEventClick=function(e){this.$formEvent[0].reset(),this.$formEvent.removeClass("was-validated"),this.$newEventData=null,this.$btnDeleteEvent.show(),this.$modalTitle.text("Edit Event"),this.$modal.modal({backdrop:"static"}),this.$selectedEvent=e.event,l("#event-title").val(this.$selectedEvent.title),l("#event-category").val(this.$selectedEvent.classNames[0])},e.prototype.onSelect=function(e){this.$formEvent[0].reset(),this.$formEvent.removeClass("was-validated"),this.$selectedEvent=null,this.$newEventData=e,this.$btnDeleteEvent.hide(),this.$modalTitle.text("Add New Event"),this.$modal.modal({backdrop:"static"}),this.$calendarObj.unselect()},e.prototype.init=function(){var e=new Date(l.now());new FullCalendarInteraction.Draggable(document.getElementById("external-events"),{itemSelector:".external-event",eventData:function(e){return{title:e.innerText,className:l(e).data("class")}}});

var t=[
  @foreach($get_data as $item)
  @php $classname = "bg-primary"; @endphp
  @if($item->desid == App\Employee::supervisor_desig_id())  @php $classname = "bg-info"; @endphp @endif
  @if($item->desid == App\Employee::worker_desig_id())  @php $classname = "bg-success"; @endphp @endif
  @if($item->worker_id == "floater")  @php $classname = "bg-warning"; @endphp @endif
  @if($loop->last)
  {title:"{{$item->empname}}",start:'{{$item->from_date}}T{{$item->start_time}}',end:'{{$item->to_date}}T{{$item->end_time}}',className:"{{$classname}}",url:'{{ URL::to('roaster/'.$item->roasterid.'/edit') }}'}
  @else
  {title:"{{$item->empname}}",start:'{{$item->from_date}}T{{$item->start_time}}',end:'{{$item->to_date}}T{{$item->end_time}}',className:"{{$classname}}",url:'{{ URL::to('roaster/'.$item->roasterid.'/edit') }}'},
  @endif
  @endforeach
],
a=this;a.$calendarObj=new FullCalendar.Calendar(a.$calendar[0],{plugins:["bootstrap","interaction","dayGrid","timeGrid","list"],slotDuration:"00:15:00",minTime:"08:00:00",maxTime:"19:00:00",themeSystem:"bootstrap",bootstrapFontAwesome:!1,buttonText:{today:"Today",month:"Month",week:"Week",day:"Day",list:"List",prev:"Prev",next:"Next"},defaultView:"dayGridMonth",handleWindowResize:!0,height:l(window).height()-200,header:{left:"prev,next today",center:"title",right:"dayGridMonth,timeGridWeek,timeGridDay,listMonth"},events:t,editable:0,droppable:!0,eventLimit:!0,selectable:!0,dateClick:function(e){a.onSelect(e)},eventClick:function(e){a.onEventClick(e)}}),a.$calendarObj.render(),a.$btnNewEvent.on("click",function(e){a.onSelect({date:new Date,allDay:!0})}),a.$formEvent.on("submit",function(e){e.preventDefault();var t=a.$formEvent[0];if(t.checkValidity()){if(a.$selectedEvent)a.$selectedEvent.setProp("title",l("#event-title").val()),a.$selectedEvent.setProp("classNames",[l("#event-category").val()]);else{var n={title:l("#event-title").val(),start:a.$newEventData.date,allDay:a.$newEventData.allDay,className:l("#event-category").val()};a.$calendarObj.addEvent(n)}a.$modal.modal("hide")}else e.stopPropagation(),t.classList.add("was-validated")}),l(a.$btnDeleteEvent.on("click",function(e){a.$selectedEvent&&(a.$selectedEvent.remove(),a.$selectedEvent=null,a.$modal.modal("hide"))}))},l.CalendarApp=new e,l.CalendarApp.Constructor=e}(window.jQuery),function(){"use strict";window.jQuery.CalendarApp.init()}();
</script>


  <script>
  $('.datetime').daterangepicker({
      singleDatePicker: true,
      locale: {
          format: 'DD-MM-YYYY'
      }
  });

  // $('.datetime').daterangepicker({
  //             timePicker: true,
  //             singleDatePicker: true,
  //             timePicker24Hour: false,
  //             timePickerIncrement: 1,
  //             timePickerSeconds: true,
  //             locale: {
  //                 format: 'HH:mm:ss'
  //             }
  //         }).on('show.daterangepicker', function (ev, picker) {
  //             picker.container.find(".calendar-table").hide();
  //         });
    </script>
  <script>
  function checkDate() {
    console.log(Date(document.getElementById("fromdate").value));
    console.log(Date(document.getElementById("todate").value));

    var x = document.getElementById("fromdate").value;
    var y = document.getElementById("todate").value;
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
    document.getElementById('repofrm').submit();
  }
</script>
@stop
