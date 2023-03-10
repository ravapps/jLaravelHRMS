@extends('layouts.dashboard')
@section('page-title')
    {{__('Attendance')}}
@endsection
@push('script-page')

    <script>
        $('input[name="type"]:radio').on('change', function (e) {
            var type = $(this).val();

            if (type == 'monthly') {
                $('.month').addClass('d-block');
                $('.month').removeClass('d-none');
                $('.date').addClass('d-none');
                $('.date').removeClass('d-block');
            } else {
                $('.date').addClass('d-block');
                $('.date').removeClass('d-none');
                $('.month').addClass('d-none');
                $('.month').removeClass('d-block');
            }
        });

        $('input[name="type"]:radio:checked').trigger('change');

    </script>
@endpush
@section('content')
<div class="row mt-4">
    <div class="col-12">
        <div class="page-title-box-hori">
            <h4 class="page-title">{{__('Manage Attendance')}}</h4>
            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item"><a href="{{__('home')}}">{{__('Dashboard')}}</a></li>
                    <li class="breadcrumb-item active">{{__('Attendance')}}</li>
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
                    <h4>{{--__('Attendance List')--}}</h4>
                    @can('Create Attendance')

                        <a href="{{ route('attendanceemployee.create') }}" class="btn btn-icon icon-left btn-success">
                            <i class="fa fa-plus"></i>  {{__('Create')}}
                        </a>
                    @endcan
                </div>
            </div>
            <div class="card-body">
              {{ Form::open(array('route' => array('attendanceemployee.index'),'method'=>'get')) }}
                <div class="row">
                    <div class="col">
                      <label for="gender">{{__('Type')}}</label>
                      <div class="d-flex w-100">
                        <div class="custom-control custom-radio mr-2">
                            <input type="radio" name="type" value="monthly" class="custom-control-input monthly" {{isset($_GET['type']) && $_GET['type']=='monthly' ?'checked':'checked'}}>
                            <label class="custom-control-label">{{__('Monthly')}}</label>
                        </div>
                        <div class="custom-control custom-radio">
                            <input type="radio" name="type" value="daily" class="custom-control-input yearly" {{isset($_GET['type']) && $_GET['type']=='daily' ?'checked':''}}>
                            <label class="custom-control-label">{{__('Daily')}}</label>
                        </div>
                      </div>
                    </div>
                    <div class="col month">
                        {{Form::label('month',__('Month'))}}
                        {{Form::month('month',isset($_GET['month'])?$_GET['month']:date('Y-m'),array('class'=>'form-control'))}}
                    </div>
                    <div class="col date d-none">
                        {{Form::label('date',__('Date'))}}
                        {{Form::date('date',isset($_GET['date'])?$_GET['date']:'',array('class'=>'form-control'))}}
                    </div>
                    @if(\Auth::user()->type != 'employee')
                      <div class="col">
                          {{ Form::label('branch', __('Branch')) }}
                          {{ Form::select('branch', $branch,isset($_GET['branch'])?$_GET['branch']:'', array('class' => 'form-control select2')) }}
                      </div>
                      <div class="col">
                          {{ Form::label('department', __('Department')) }}
                          {{ Form::select('department', $department,isset($_GET['department'])?$_GET['department']:'', array('class' => 'form-control select2')) }}
                      </div>
                    @endif
                    <div class="col-auto apply-btn">
                        <label for="" class="w-100">&nbsp;</label>
                        {{Form::submit(__('Apply'),array('class'=>'btn btn-success'))}}
                        <a href="{{route('attendanceemployee.index')}}" class="btn btn-danger">{{__('Reset')}}</a>
                    </div>
                </div>
              {{ Form::close() }}
              <hr>
              <div class="table-responsive">
                    <table class="table table-striped mb-0" id="dataTable">
                        <thead>
                        <tr>
                            @if(\Auth::user()->type!='employee')
                                <th>{{__('Employee')}}</th>
                            @endif
                            <th>{{__('Date')}}</th>
                            <th>{{__('Status')}}</th>
                            <th>{{__('Clock In')}}</th>
                            <th>{{__('Clock Out')}}</th>
                            <th>{{__('Late')}}</th>
                            <th>{{__('Early Leaving')}}</th>
                            <th>{{__('Overtime')}}</th>
                            @if(Gate::check('Edit Attendance') || Gate::check('Delete Attendance'))
                                <th>{{__('Action')}}</th>
                            @endif
                        </tr>
                        </thead>
                        <tbody>

                        @foreach ($attendanceEmployee as $attendance)
                            <tr>
                                @if(\Auth::user()->type!='employee')
                                    <td>{{!empty($attendance->employee)?$attendance->employee->name:'' }}</td>
                                @endif
                                <td>{{ \Auth::user()->dateFormat($attendance->date) }}</td>
                                <td>{{ $attendance->status }}</td>
                                <td>{{ ($attendance->clock_in !='00:00:00') ?\Auth::user()->timeFormat( $attendance->clock_in):'00:00' }} </td>
                                <td>{{ ($attendance->clock_out !='00:00:00') ?\Auth::user()->timeFormat( $attendance->clock_out):'00:00' }}</td>
                                <td>{{ $attendance->late }}</td>
                                <td>{{ $attendance->early_leaving }}</td>
                                <td>{{ $attendance->overtime }}</td>
                                @if(Gate::check('Edit Attendance') || Gate::check('Delete Attendance'))
                                    <td>
                                        @can('Edit Attendance')
                                            <a href="#" data-url="{{ URL::to('attendanceemployee/'.$attendance->id.'/edit') }}" data-size="lg" data-ajax-popup="true" data-title="{{__('Edit Attendance')}}" class="btn btn-outline-success  mr-1" data-toggle="tooltip" data-original-title="{{__('Edit')}}"><i class="fas fa-pencil-alt"></i> <span>{{__('Edit')}}</span></a>
                                        @endcan
                                        @can('Delete Attendance')
                                            <a href="#" class="btn btn-outline-danger " data-toggle="tooltip" data-original-title="{{__('Delete')}}" data-confirm="Are You Sure?|This action can not be undone. Do you want to continue?" data-confirm-yes="document.getElementById('delete-form-{{$attendance->id}}').submit();"><i class="fas fa-trash"></i> <span>{{__('Delete')}}</span></a>
                                            {!! Form::open(['method' => 'DELETE', 'route' => ['attendanceemployee.destroy', $attendance->id],'id'=>'delete-form-'.$attendance->id]) !!}
                                            {!! Form::close() !!}
                                        @endif
                                    </td>
                                @endif
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('script-page')
    <script>
        $(document).ready(function () {
            $('.daterangepicker').daterangepicker({
                format: 'yyyy-mm-dd',
                locale: {format: 'YYYY-MM-DD'},
            });



        });


    </script>
@endpush
