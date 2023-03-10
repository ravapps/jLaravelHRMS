@extends('layouts.dashboard')
@section('page-title')
    {{__('Employee Profile')}}
@endsection

@section('content')
<div class="row mt-4">
    <div class="col-12">
        <div class="page-title-box-hori">
            <h4 class="page-title">{{__('Manage Employee Profile')}}</h4>
            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item"><a href="{{__('home')}}">{{__('Dashboard')}}</a></li>
                    <li class="breadcrumb-item active">{{__('Employee Profile')}}</li>
                </ol>
            </div>
        </div>
    </div>
</div>
<hr class="mt-0 mb-2">

<div class="row">
    <div class="col-12">
        <div class="card">
            <!-- <div class="card-header">
              <div class="d-flex justify-content-between align-items-center w-100">
                  <h4 class="header-title mb-0"></h4>
                  <div> </div>
              </div>
            </div> -->
            <div class="card-body">
              {{ Form::open(array('route' => array('employee.profile'),'method' => 'GET')) }}
                <div class="row">
                  <div class="col">
                    <div class="form-group">
                        {{ Form::label('branch', __('Branch')) }}
                        {{ Form::select('branch',$brances,isset($_GET['branch'])?$_GET['branch']:'', array('class' => 'form-control font-style select2','data-toggle'=>"select2")) }}
                    </div>
                  </div>
                  <div class="col">
                    <div class="form-group">
                        {{ Form::label('department', __('Department')) }}
                        {{ Form::select('department',$departments,isset($_GET['department'])?$_GET['department']:'', array('class' => 'form-control font-style select2','data-toggle'=>"select2")) }}
                    </div>
                  </div>
                  <div class="col">
                    <div class="form-group">
                        {{ Form::label('designation', __('Designation')) }}
                        <select class="select2 form-control select2-multiple" id="designation_id" name="designation" data-toggle="select2" data-placeholder="{{ __('Select Designation ...') }}">
                            <option value="">{{__('Designation')}}</option>
                        </select>
                    </div>
                  </div>
                  <div class="col-auto">
                    <div class="form-group">
                        <label class="w-100">&nbsp;</label>
                        <button type="submit" class="btn btn-success">{{__('Search')}}</button>
                        <a href="{{route('employee.profile')}}" class="btn btn-danger">{{__('Reset')}}</a>
                    </div>
                  </div>
                </div>
              {{ Form::close() }}
            </div>
        </div>
    </div>
    <div class="col-sm-12">
      <div class="row">
          @forelse($employees as $employee)
            <div class="col-xl-4 col-sm-6">
                <div class="card text-center">
                    <div class="card-body">
                        <div class="member-card">
                            <div class="member-thumb mx-auto">
                                <img src="{{!empty($employee->user->avatar) ? asset(Storage::url('uploads/avatar')).'/'.$employee->user->avatar : asset(Storage::url('uploads/avatar')).'/avatar.png'}}" class="rounded-circle avatar-xl img-thumbnail" alt="profile-image">
                            </div>
                            <h2 class="m-0"></h2>
                            <p></p>
                            <div class="mt-3">
                                <h4 class="mb-1">{{ $employee->name }}</h4>
                                <p class="text-muted">{{ !empty($employee->designation)?$employee->designation->name:'' }}</p>
                            </div>

                            @can('Show Employee Profile')
                                <div class="meta-info mb-3">

                                    <!-- <a href="{{route('show.employee.profile',\Illuminate\Support\Facades\Crypt::encrypt($employee->id))}}" class="btn btn-icon icon-left btn-success">{{ \Auth::user()->employeeIdFormat($employee->employee_id) }}</a> -->

                                    <a href="{{route('employee.show',\Illuminate\Support\Facades\Crypt::encrypt($employee->id))}}" class="btn btn-icon icon-left btn-success">{{ \Auth::user()->employeeIdFormat($employee->employee_id) }}</a>
                                </div>
                            @else
                                <div class="meta-info mb-3">
                                    <a href="#" class="btn btn-icon icon-left btn-success">{{ \Auth::user()->employeeIdFormat($employee->employee_id) }}</a>
                                </div>
                            @endcan
                        </div>
                    </div>
                </div>
            </div>
          @empty
            <div class="col-xl-4 col-sm-6">
                <div class="card text-center">
                    <div class="card-body">
                      <h6>{{__('there is no employee')}}</h6>
                    </div>
                </div>
            </div>
          @endforelse
      </div>
    </div>
</div>
@endsection
@push('script-page')

    <script>

        $(document).ready(function () {
            var d_id = $('#department').val();
            getDesignation(d_id);
        });

        $(document).on('change', 'select[name=department]', function () {
            var department_id = $(this).val();
            getDesignation(department_id);
        });

        function getDesignation(did) {
            $.ajax({
                url: '{{route('employee.json')}}',
                type: 'POST',
                data: {
                    "department_id": did, "_token": "{{ csrf_token() }}",
                },
                success: function (data) {
                    $('#designation_id').empty();
                    $('#designation_id').append('<option value="">{{__('Select Designation')}}</option>');
                    $.each(data, function (key, value) {
                        $('#designation_id').append('<option value="' + key + '">' + value + '</option>');
                    });
                }
            });
        }
    </script>
@endpush
