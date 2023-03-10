@extends('layouts.dashboard')
@section('page-title')
    {{__('Employee')}}
@endsection
@section('content')
<div class="row mt-4">
    <div class="col-12">
        <div class="page-title-box-hori">
            <h4 class="page-title">{{__('Add Commission')}}</h4>
            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                  <li class="breadcrumb-item"><a href="{{__('home')}}">{{__('Dashboard')}}</a></li>
                  <li class="breadcrumb-item"><a href="{{route('commission.index')}}">{{__('Commission')}}</a></li>
                  <li class="breadcrumb-item active">{{__('Add')}}</li>
                </ol>
            </div>
        </div>
    </div>
</div>
<hr class="mt-0">

<form method="post" action="{{route('commission.store')}}" enctype="multipart/form-data">
    @csrf
    <div class="section-body">
        <div class="row">
            <div class="col-md-12 ">
                <div class="card ">
                    <!-- <div class="card-header"><h4>{{__('Commission Details')}}</h4></div> -->
                    <div class="card-body ">

                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                   <label>Employee Name</label><span class="text-danger pl-1">*</span>
                                    <select name="employee_id[]" required class="form-control" id="" multiple>

                                        @if($employees)
                                            @foreach($employees as $employee)
                                            <option value="{{$employee->id}}">{{$employee->first_name}} {{$employee->last_name}}</option>
                                            @endforeach
                                        @endif
                                    </select>

                                </div>
                            </div>
                            <div class="col-md-3">
                                    <div class="form-group" >
                                        <label>Commission Type</label><span class="text-danger pl-1">*</span>

                                          <select name="title" required class="form-control" id="title_commission">
                                        <option value="">Select Type</option>
                                        @if($commission_types)
                                            @foreach($commission_types as $commission_type)
                                            <option value="{{$commission_type->id}}">{{$commission_type->name}}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                    </div>
                            </div>
                            <div class="col-md-3">
                                <!-- <div class="form-group">
                                    <label>Amount</label><span class="text-danger pl-1">*</span>
                                    <input type="text" name="amount" value="" id="amount" class="form-control"  readonly required>
                                    </div> -->

                                    <div class="form-group">
                                        <label class="">Amount</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">$</span>
                                            </div>
                                            <input type="text" name="amount" value="" id="amount" class="form-control"  readonly required>
                                        </div>
                            </div>

                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Status</label><span class="text-danger pl-1">*</span>
                                          <select name="status"  class="form-control"  required>
                                                <option value="">Select Status</option>
                                                <option value="Pending">Pending</option>
                                                <option value="Approved">Approved</option>

                                            </select>
                                    </div>
                            </div>

                        </div>


                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                   <label>Remark</label><span class="text-danger pl-1">*</span>
                                  <textarea name="remark" class="form-control" ></textarea>
                                </div>
                            </div>

                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                   <label>Upload Documents</label>
                                 <input type="file" name="documents[]" class="form-control">
                                </div>
                            </div>


                        </div>
                        <div class="row">
                            <div class="col-md-12">
                              {!! Form::submit('Create', ['class' => 'btn btn-success float-right']) !!}
                            </div>
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
$(document).ready(function(){
    $("#title_commission").on('change',function () {
            var commission_id = $(this).val();
            $.ajax({
                url: '{{route('commission.json')}}',
                type: 'POST',
                data: {
                    "commission_id": commission_id, "_token": "{{ csrf_token() }}",
                },
                success: function (data) {

                    $("#amount").val(data.commission_amount);
                }
            });
        });
});
</script>
@endpush
