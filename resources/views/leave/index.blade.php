@extends('layouts.dashboard')
@section('page-title')
    {{__('Leave')}}
@endsection
@section('content')
<div class="row mt-4">
    <div class="col-12">
        <div class="page-title-box-hori">
            <h4 class="page-title">{{__('Manage Leave')}}</h4>
            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item"><a href="{{__('home')}}">{{__('Dashboard')}}</a></li>
                    <li class="breadcrumb-item active">{{__('Leave')}}</li>
                </ol>
            </div>
        </div>
    </div>
</div>
<hr class="mt-0 mb-2">

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <div class="d-flex justify-content-between w-100">
                    <h4>{{--__('Leave List')--}}</h4>
                    @can('Create Leave')
                        <a href="{{ route('leave.create') }}" class="btn btn-icon icon-left btn-success" >
                            <i class="fa fa-plus"></i> {{__('Create')}}
                        </a>
                    @endcan
                </div>
            </div>


            <div class="card-body">
              <form action="{{route('leave.index')}}" methode="get">
                <div class="row">
                  <div class="col">
                      <div class="form-group">
                         <label>Employee Name</label><span class="text-danger pl-1">*</span>

                              <select name="employee_ids" required class="form-control" id="employee_ids" required>
                                  <option value="">Select Employee</option>
                                  @if(!empty($employee))
                                      @foreach($employee as $row)
                                          <option value="{{$row->id}}">{{$row->first_name}} {{$row->last_name}}</option>
                                      @endforeach
                                  @endif
                              </select>
                      </div>
                  </div>

                  <div class="col" >
                      <div class="form-group">
                         <label>Leave Type</label><span class="text-danger pl-1">*</span>

                         <select name="leave_type_id1" required class="form-control" id="leave_type_id1" required>
                                  <option value="">Select Leave Type</option>
                                  @if(!empty($leavetypes))
                                      @foreach($leavetypes as $leavetype)
                                          <option value="{{$leavetype->id}}">{{$leavetype->title}}</option>
                                      @endforeach
                                  @endif
                              </select>
                      </div>
                  </div>

                  <div class="col">
                      <div class="form-group">
                         <label>Status</label><span class="text-danger pl-1">*</span>

                         <select name="status_id" required class="form-control" id="status_id" required>
                                  <option value="">Select Status</option>
                                  <option value="Pending">Pending</option>
                                   <option value="Approve">Approved</option>
                        </select>
                      </div>
                  </div>
                  <div class="col">
                      <div class="form-group">
                         <label>Date</label><span class="text-danger pl-1">*</span>

                        <input type="text" name="date_selected" value="" class="form-control datetime" required>
                      </div>
                  </div>
                  <div class="col-auto">
                      <div class="form-group">
                      <label class="w-100">&nbsp;</label>
                        {{Form::submit(__('Apply'),array('class'=>'btn btn-success'))}}
                        <a href="{{route('leave.index')}}" class="btn btn-danger">{{__('Reset')}}</a>
                      </div>
                  </div>
                </div>
              </form>
              <hr>
                <div class="table-responsive">
                    <table class="table table-striped mb-0" id="dataTable">
                        <thead>
                        <tr>
                            @if(\Auth::user()->type!='employee')
                                <th>{{__('Employee')}}</th>
                            @endif
                            <th>{{__('Leave Type')}}</th>
                            <th>{{__('Applied Date')}}</th>
                            <th>{{__('Start Date')}}</th>
                            <th>{{__('End Date')}}</th>
                            <th>{{__('No. Of Days')}}</th>
                            <th>{{__('Leave Reason')}}</th>
                            <th>{{__('Status')}}</th>
                            <th class="text-right">{{__('Action')}}</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($leaves as $leave)
                            <tr>
                                @if(\Auth::user()->type!='employee')
                                    <td>{{ !empty(\Auth::user()->getEmployee($leave->employee_id))?\Auth::user()->getEmployee($leave->employee_id)->name:'' }}</td>
                                @endif
                                <td>{{ !empty(\Auth::user()->getLeaveType($leave->leave_type_id))?\Auth::user()->getLeaveType($leave->leave_type_id)->title:'' }}</td>
                                <td>{{ \Auth::user()->dateFormat($leave->applied_on )}}</td>
                                <td>{{ \Auth::user()->dateFormat($leave->start_date ) }}</td>
                                <td>{{ \Auth::user()->dateFormat($leave->end_date )  }}</td>
                                @php
                                    $startDate = new \DateTime($leave->start_date);
                                    $endDate   = new \DateTime($leave->end_date);
                                    $total_leave_days = !empty($startDate->diff($endDate))?$startDate->diff($endDate)->days:0;
                                @endphp
                                <td>{{ $leave->total_leave_days }}</td>
                                <td>{{ $leave->leave_reason }}</td>
                                <td>
                                    @if($leave->status=="Pending")
                                        <div class="badge badge-warning">{{ $leave->status }}</div>
                                    @elseif($leave->status=="Approve")
                                        <div class="badge badge-success">{{ $leave->status }}</div>
                                    @else($leave->status=="Reject")
                                        <div class="badge badge-danger">{{ $leave->status }}</div>
                                    @endif
                                </td>
                                <td class="text-right">

                                    @if(\Auth::user()->type == 'employee')
                                        @if($leave->status == "approval" || $leave->status == "reject")
                                        @else
                                            @can('Edit Leave')
                                                <a href="{{ URL::to('leave/'.$leave->id.'/edit') }}"  class="btn btn-outline-success  mr-1" data-toggle="tooltip" data-original-title="{{__('Edit')}}"><i class="fas fa-pencil-alt"></i> <span>{{__('Edit')}}</span></a>
                                            @endcan
                                        @endif
                                    @else
                                    <a href="#" data-url="{{ URL::to('leave/'.$leave->id.'/action') }}" data-size="lg" data-ajax-popup="true" data-title="{{__('Leave Action')}}" class="btn btn-outline-success  mr-1" data-toggle="tooltip" data-original-title="{{__('Leave Action')}}"><i class="fas fa-caret-right"></i> <span>{{__('Approval')}}</span></a>
                                        @can('Edit Leave')
                                            <a href="{{ URL::to('leave/'.$leave->id.'/edit') }}"  class="btn btn-outline-success  mr-1" data-toggle="tooltip" data-original-title="{{__('Edit')}}"><i class="fas fa-pencil-alt"></i> <span>{{__('Edit')}}</span></a>
                                        @endcan
                                    @endif

                                    @can('Delete Leave')
                                        <a href="#" class="btn btn-outline-danger " data-toggle="tooltip" data-original-title="{{__('Delete')}}" data-confirm="Are You Sure?|This action can not be undone. Do you want to continue?" data-confirm-yes="document.getElementById('delete-form-{{$leave->id}}').submit();"><i class="fas fa-trash"></i> <span>{{__('Delete')}}</span></a>
                                        {!! Form::open(['method' => 'DELETE', 'route' => ['leave.destroy', $leave->id],'id'=>'delete-form-'.$leave->id]) !!}
                                        {!! Form::close() !!}
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>


                </div>
                {{ $leaves->links() }}
            </div>
        </div>
    </div>
</div>
@endsection

@push('script-page')
    <script>
        $(document).on('change', '#employee_id', function () {
            var employee_id = $(this).val();

            $.ajax({
                url: '{{route('leave.jsoncount')}}',
                type: 'POST',
                data: {
                    "employee_id": employee_id, "_token": "{{ csrf_token() }}",
                },
                success: function (data) {

                    $('#leave_type_id').empty();
                    $('#leave_type_id').append('<option value="">{{__('Select Leave Type')}}</option>');

                    $.each(data, function (key, value) {

                        if (value.total_leave >= value.days) {
                            $('#leave_type_id').append('<option value="' + value.id + '" disabled>' + value.title + '&nbsp(' + value.total_leave + '/' + value.days + ')</option>');
                        } else {
                            $('#leave_type_id').append('<option value="' + value.id + '">' + value.title + '&nbsp(' + value.total_leave + '/' + value.days + ')</option>');
                        }
                    });

                }
            });
        });

    </script>
    <script>
$('.datetime').daterangepicker({

            singleDatePicker: true,

            locale: {
                format: 'DD-MM-YYYY'
            }

        });
  </script>
@endpush
