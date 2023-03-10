@extends('layouts.dashboard')
@section('page-title')
    {{__('Pay Grade')}}
@endsection
@section('content')
<div class="row mt-4">
    <div class="col-12">
        <div class="page-title-box-hori">
            <h4 class="page-title">{{__('Add Daily Pay Grade')}}</h4>
            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                  <li class="breadcrumb-item"><a href="{{__('home')}}">{{__('Dashboard')}}</a></li>
                  <li class="breadcrumb-item"><a href="{{route('employee.index')}}">{{__('Pay Grade')}}</a></li>
                  <li class="breadcrumb-item active">{{__('Add')}}</li>
                </ol>
            </div>
        </div>
    </div>
</div>
<hr class="mt-0">

<form method="post" action="{{route('daily_grade.store')}}" enctype="multipart/form-data">
    @csrf
    <div class="row">
        <div class="col-md-12 ">
                <div class="card ">
                    <!-- <div class="card-header"><h4>{{__('Pay Grade Details')}}</h4></div> -->
                    <div class="card-body ">



                    <input type="hidden" value="{{$grade_type}}" name="grade_type">
                        <div class="form-body">
                          <div class="row">
                            <div class="col-md-3 col-sm-6 col-xs-12">
                              <div class="form-group">
                                <label class="col-form-label">Pay Grade Name</label>
                                <input class="form-control" value="" name="grade_name" placeholder="" required>
                              </div>
                            </div>
                            <div class="col-md-3 col-sm-6 col-xs-12">
                              <div class="form-group">
                                <label class="col-form-label">Gross Salary</label>
                                <div class="input-group">
                                  <div class="input-group-prepend">
                                    <span class="input-group-text">$</span>
                                  </div>
                                  <input type="text" class="form-control" value="" name="gross_salary" placeholder="" value="" required>
                                </div>
                              </div>
                            </div>
                            <div class="col-md-3 col-sm-6 col-xs-12">
                              <div class="form-group">
                                <label class="col-form-label">Percentage Of Basis</label>
                                <select class="form-control select2" name="percentage" required>
                                <option value="">Select Percentage</option>
                                @php $count_range=range(5, 100, 5);@endphp
                                @foreach($count_range as $val)
                                  <option value="{{$val}}">{{$val}}%</option>
                                @endforeach

                                </select>
                              </div>
                            </div>
                            <div class="col-md-3 col-sm-6 col-xs-12">
                              <div class="form-group">
                                <label class="col-form-label">Basic Salary</label>
                                <div class="input-group">
                                  <div class="input-group-prepend">
                                    <span class="input-group-text">$</span>
                                  </div>
                                  <input type="text" class="form-control" name="basic_salary" placeholder="" value="" required>
                                </div>
                              </div>
                            </div>
                            <div class="col-md-3 col-sm-6 col-xs-12">
                              <div class="form-group">
                                <label class="col-form-label">Overtime Rate (Per Hour)</label>
                                <div class="input-group">
                                  <div class="input-group-prepend">
                                    <span class="input-group-text">$</span>
                                  </div>
                                  <input type="text" class="form-control" name="overtime" placeholder="" value="" required>
                                </div>
                              </div>
                            </div>
                            <div class="col-md-3 col-sm-6 col-xs-12">
                              <div class="form-group">
                                <label class="col-form-label">Allowance</label>
                                <select class="form-control" multiple name="allowence[]" required>

                                @if(!empty($allowanceOption))
                                 @foreach($allowanceOption as $row)
                                   <option value="{{$row->id}}">{{$row->name}}</option>
                                 @endforeach
                                @endif

                                </select>
                              </div>
                            </div>

                          </div>
                          <div class="row mt-4">
                            <div class="col-md-12">
                              <div class="form-group text-right">
                                <button class="btn btn-success float-right">Submit</button>
                              </div>
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


@endpush
