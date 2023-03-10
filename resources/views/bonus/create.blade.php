@extends('layouts.dashboard')
@section('page-title')
    {{__('Create Bonus And Commission Type')}}
@endsection
@section('content')
<div class="row mt-4">
    <div class="col-12">
        <div class="page-title-box-hori">
            <h4 class="page-title">{{__('Add Bonus And Commission Type')}}</h4>
            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                  <li class="breadcrumb-item"><a href="{{__('home')}}">{{__('Dashboard')}}</a></li>
                  <li class="breadcrumb-item"><a href="{{route('employee.index')}}">{{__('Bonus And Commission Type')}}</a></li>
                  <li class="breadcrumb-item active">{{__('Create')}}</li>
                </ol>
            </div>
        </div>
    </div>
</div>
<hr class="mt-0">

<form method="post" action="{{route('bonuscommission.store')}}" enctype="multipart/form-data">
    @csrf
    <div class="row">
        <div class="col-md-12 ">
            <div class="card ">
                <!-- <div class="card-header"><h4>{{__('Bonus And Commission Type')}}</h4></div> -->
                <div class="card-body ">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Type</label><span class="text-danger pl-1">*</span>
                                <div class="d-flex">
                                  <div class="custom-control custom-radio mr-1">
                                    <input type="radio" name="bonus_type" value="Bonus"  class="custom-control-input" required>
                                    <label class="custom-control-label">Bonus </label>
                                  </div>
                                  <div class="custom-control custom-radio mr-1">
                                    <input type="radio" name="bonus_type" value="Commission"  class="custom-control-input" required>
                                    <label class="custom-control-label">Commission </label>
                                  </div>
                                </div>


                                    <!-- <select name="bonus_type" required class="form-control" id="bonus_type" required>
                                        <option value="">Select Type</option>
                                        <option value="Bonus">Bonus</option>
                                        <option value="Commission">Commission</option>
                                    </select> -->
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                               <label>Name</label><span class="text-danger pl-1">*</span>
                               <input type="text" name="name" value=""  id="name" class="form-control" required>
                            </div>
                        </div>

                    </div>



                                <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Salary Type</label><span class="text-danger pl-1">*</span>
                                                <select name="salary_type" required class="form-control" id="salary_type" required>
                                                    <option value="">Select Salary Type</option>
                                                    <option value="Basic">Basic</option>
                                                    <option value="Gross">Gross</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Amount</label><span class="text-danger pl-1">*</span>
                                                <input type="text" name="amount" value=""  id="amount" class="form-control" required>
                                            </div>
                                        </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12 col-sm-12 col-xs-12">
                                        {!! Form::submit('Create', ['class' => 'btn btn-success float-right']) !!}
                                    </div>
                                </div>





                </div>
            </div>
        </div>

    </div>
{!! Form::close() !!}

@endsection
