@extends('layouts.dashboard')
@section('page-title')
    {{__('Edit Bonus')}}
@endsection
@section('content')
<div class="row mt-4">
    <div class="col-12">
        <div class="page-title-box-hori">
            <h4 class="page-title">{{__('Edit Bonus')}}</h4>
            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                  <li class="breadcrumb-item"><a href="{{__('home')}}">{{__('Dashboard')}}</a></li>
                  <li class="breadcrumb-item"><a href="{{route('bonus.index')}}">{{__('Bonus')}}</a></li>
                  <li class="breadcrumb-item active">{{__('Edit')}}</li>
                </ol>
            </div>
        </div>
    </div>
</div>
<hr class="mt-0">

{{Form::model($bonus,array('route' => array('bonus.update', $bonus->id), 'method' => 'PUT')) }}
<div class="row">
    <div class="col-md-12 ">
        <div class="card ">
            <!-- <div class="card-header"><h4>{{__('Bonus Details')}}</h4></div> -->
            <div class="card-body ">

                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                           <label>Employee Name</label><span class="text-danger pl-1">*</span>
                            <select name="employee_id[]" required class="form-control" id="" >

                                @if($employees)
                                    @foreach($employees as $employee)
                                        @if($bonus->employee_id==$employee->id)
                                             <option value="{{$employee->id}}" @if($bonus->employee_id==$employee->id) selected='selected' @endif>{{$employee->first_name}} {{$employee->last_name}}</option>
                                        @endif
                                    @endforeach
                                @endif
                            </select>

                        </div>
                    </div>
                    <div class="col-md-4">
                            <div class="form-group" >
                                <label>Bonus Type</label><span class="text-danger pl-1">*</span>

                                  <select name="bonus_id" required class="form-control" id="bonus_id">
                                <option value="">Select Type</option>
                                @if($commission_types)
                                    @foreach($commission_types as $commission_type)
                                    <option value="{{$commission_type->id}}" @if($bonus->bonus_id==$commission_type->id) selected='selected' @endif>{{$commission_type->name}}</option>
                                    @endforeach
                                @endif
                            </select>
                            </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Amount</label><span class="text-danger pl-1">*</span>
                            <input type="text" name="amount" value="{{$amounts}}" id="amount" class="form-control"  readonly required>
                            </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                           {!! Form::submit('Update', ['class' => 'btn btn-success float-right']) !!}
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
    $("#bonus_id").on('change',function () {
            var bonus_id = $(this).val();
            $.ajax({
                url: '{{route('bonus.json')}}',
                type: 'POST',
                data: {
                    "bonus_id": bonus_id, "_token": "{{ csrf_token() }}",
                },
                success: function (data) {

                    $("#amount").val(data.bonus_amount);
                }
            });
        });
});
</script>
@endpush
