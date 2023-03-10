@extends('layouts.dashboard')
@section('page-title')
    {{__('Event')}}
@endsection
@push('css-page')
    <link rel="stylesheet" href="{{ asset('assets/modules/fullcalendar/fullcalendar.min.css') }}">
@endpush
@section('content')
<div class="row mt-4">
    <div class="col-12">
        <div class="page-title-box-hori">
            <h4 class="page-title">{{__('Manage Event')}}</h4>
            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                  <li class="breadcrumb-item"><a href="{{__('home')}}">{{__('Dashboard')}}</a></li>
                    <li class="breadcrumb-item active">{{__('Event')}}</li>
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
                    <h4>{{--__('Event List')--}}</h4>
                    @can('Create Event')
                        <a href="#" data-url="{{ route('event.create') }}" class="btn btn-icon icon-left btn-success" data-ajax-popup="true" data-toggle="tooltip" data-title="{{__('Create New Event')}}" data-original-title="{{__('Create Event')}}">
                            <i class="fa fa-plus"></i> {{__('Create')}}
                        </a>
                    @endcan
                </div>
            </div>
            <div class="card-body">
                <div id="myEvent"></div>
            </div>
        </div>
    </div>
</div>

    @push('script-page')
        <script src="{{ asset('assets/modules/fullcalendar/fullcalendar.min.js') }}"></script>
        <script>
            var arrEvents ={!! $arrEvents !!}
        </script>
        <script src="{{ asset('assets/js/page/modules-calendar.js') }}"></script>

        <script>

            $(document).ready(function () {
                var b_id = $('#branch_id').val();
                getDepartment(b_id);
            });
            $(document).on('change', 'select[name=branch_id]', function () {
                var branch_id = $(this).val();
                getDepartment(branch_id);
            });

            function getDepartment(bid) {

                $.ajax({
                    url: '{{route('event.getdepartment')}}',
                    type: 'POST',
                    data: {
                        "branch_id": bid, "_token": "{{ csrf_token() }}",
                    },
                    success: function (data) {

                        $('#department_id').empty();
                        $('#department_id').append('<option value="">{{__('Select Department')}}</option>');

                        $('#department_id').append('<option value="0"> {{__('All Department')}} </option>');
                        $.each(data, function (key, value) {
                            $('#department_id').append('<option value="' + key + '">' + value + '</option>');
                        });
                    }
                });
            }

            $(document).on('change', '#department_id', function () {
                var department_id = $(this).val();
                getEmployee(department_id);
            });

            function getEmployee(did) {

                $.ajax({
                    url: '{{route('event.getemployee')}}',
                    type: 'POST',
                    data: {
                        "department_id": did, "_token": "{{ csrf_token() }}",
                    },
                    success: function (data) {
                        console.log(data);
                        $('#employee_id').empty();
                        $('#employee_id').append('<option value="">{{__('Select Employee')}}</option>');
                        $('#employee_id').append('<option value="0"> {{__('All Employee')}} </option>');

                        $.each(data, function (key, value) {
                            $('#employee_id').append('<option value="' + key + '">' + value + '</option>');
                        });
                    }
                });
            }
        </script>

    @endpush

@endsection
