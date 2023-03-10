@extends('layouts.dashboard')
@section('page-title')
    {{__('Pay Grade')}}
@endsection
@section('content')

<div class="row mt-4">
    <div class="col-12">
        <div class="page-title-box-hori">
            <h4 class="page-title">{{__('Allowance Application')}}</h4>
            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                  <li class="breadcrumb-item"><a href="{{__('home')}}">{{__('Dashboard')}}</a></li>
                  <li class="breadcrumb-item"><a href="{{route('allowanceoption.index')}}">{{__('Allowance')}}</a></li>
                  <li class="breadcrumb-item active">{{__('Create')}}</li>
                </ol>
            </div>
        </div>
    </div>
</div>
<hr class="mt-0">
<div class="card ">
    <div class="card-body ">
      {{Form::open(array('url'=>'allowanceoption','method'=>'post'))}}
        @csrf
        <div class="form-body">
            <div class="row">
                <div class="col-md-6 col-sm-6 col-xs-12">
                    <div class="form-group">
                        <label class="col-form-label">Allowance Name</label>
                        <input class="form-control" value="" name="name" placeholder="" required>
                    </div>
                </div>


                <div class="col-md-6 col-sm-6 col-xs-12">
                    <div class="form-group">
                            <label class="col-form-label"> Allowance Type </label>
                                <select class="form-control select2" name="al_type" required>
                                <option value="">Select Type</option>
                                <option value="Percentage">Percentage</option>
                                <option value="Fixed">Fixed</option>
                                </select>
                    </div>
                </div>

                <div class="col-md-6 col-sm-6 col-xs-12">
                    <div class="form-group">
                        <label class="col-form-label">Percentage of Basis</label>
                        <input class="form-control" value="" name="percentage" placeholder="" required>
                    </div>
                </div>
                <div class="col-md-6 col-sm-6 col-xs-12">
                    <div class="form-group">
                        <label class="col-form-label"> Limit Per Month </label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">$</span>
                            </div>
                            <input type="text" class="form-control" name="limit_month" placeholder="" value="" required>
                        </div>
                    </div>
                </div>



            </div>
            <div class="row">
            <div class="col-md-12">
              <div class="form-group text-right">
                <button class="btn btn-success float-right">Submit</button>
              </div>
            </div>
          </div>

        </div>
      {!! Form::close() !!}
    </div>
</div>

@endsection

@push('script-page')


@endpush
