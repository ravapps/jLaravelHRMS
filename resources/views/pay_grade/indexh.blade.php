@extends('layouts.dashboard')
@section('page-title')
    {{__('Pay Grade')}}
@endsection
@section('content')
<div class="row mt-4">
    <div class="col-12">
        <div class="page-title-box-hori">
            <h4 class="page-title">{{__('Manage Hourly Pay Grade')}}</h4>
            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item"><a href="{{__('home')}}">{{__('Dashboard')}}</a></li>
                    <li class="breadcrumb-item active">{{__('Pay Grade')}}</li>
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
            <div class="card-header">
                <div class="d-flex justify-content-between w-100">
                    <h4>{{--__('Pay Grade List')--}}</h4>
                    @can('Manage Monthly Grade')
                        <a href="{{ route('hourly_grade.create') }}" class="btn btn-icon icon-left btn-success">
                            <i class="fa fa-plus"></i> {{__('Create')}}
                        </a>
                    @endcan
                </div>
            </div>
            <div class="card-body">
              <form action="{{route('hourly_grade.index')}}" methode="get">
                  <div class="row">
                    <div class="col">
                        <div class="form-group">
                           <label>Name</label><span class="text-danger pl-1">*</span>
                           <input type="text" name="grade_name" class="form-control" required>
                        </div>
                    </div>


                    <div class="col">
                        <div class="form-group">
                            @php $range_data=range(1,100) @endphp
                           <label>Percentage </label><span class="text-danger pl-1">*</span>
                           <select name="grade_percentage" required class="form-control" id="grade_percentage" required>
                                    <option value="">Select Allowance Percentage</option>
                                  @foreach($range_data as $key=>$val)
                                    <option value="{{$val}}">{{$val}}%</option>
                                   @endforeach
                          </select>
                        </div>
                    </div>

                    <div class="col-auto">
                        <div class="form-group">
                          <label class="w-100">&nbsp;</label>
                          {{Form::submit(__('Apply'),array('class'=>'btn btn-success'))}}
                          <a href="{{route('hourly_grade.index')}}" class="btn btn-danger">{{__('Reset')}}</a>
                        </div>
                    </div>
                  </div>
              </form>
              <hr class="mt-1">
                <div class="table-responsive">
                    <table class="table table-striped mb-0" id="dataTable">
                        <thead>
                        <tr>

                            <th>{{__('Pay Grade Name')}}</th>
                            <th>{{__('Gross Salary')}}</th>
                            <th>{{__('Prcentage Of Basis')}}</th>
                            <th>{{__('Basic Salary')}}</th>
                            <th>{{__('Overtime Rate')}}</th>
                            <th class="text-right">{{__('Action')}}</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($monthly_grades as $monthly_grade)
                            <tr>

                                <td>{{$monthly_grade->grade_name}}</td>
                                <td>${{$monthly_grade->gross_salary}}</td>
                                <td>{{$monthly_grade->percentage}}%</td>
                                <td>${{$monthly_grade->basic_salary}}</td>

                                <td>${{$monthly_grade->overtime}}</td>

                                <td class="text-right">


                                        @can('Manage Monthly Grade')
                                            <a href="{{ URL::to('hourly_grade/'.$monthly_grade->id.'/edit') }}"  class="btn btn-outline-success  mr-1" data-toggle="tooltip" data-original-title="{{__('Edit')}}"><i class="fas fa-pencil-alt"></i> <span>{{__('Edit')}}</span></a>
                                        @endcan


                                    @can('Manage Monthly Grade')
                                        <a href="#" class="btn btn-outline-danger " data-toggle="tooltip" data-original-title="{{__('Delete')}}" data-confirm="Are You Sure?|This action can not be undone. Do you want to continue?" data-confirm-yes="document.getElementById('delete-form-{{$monthly_grade->id}}').submit();"><i class="fas fa-trash"></i> <span>{{__('Delete')}}</span></a>
                                        {!! Form::open(['method' => 'DELETE', 'route' => ['hourly_grade.destroy', $monthly_grade->id],'id'=>'delete-form-'.$monthly_grade->id]) !!}
                                        {!! Form::close() !!}
                                    @endif
                                </td>
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
