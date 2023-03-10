@extends('layouts.dashboard')
@section('page-title')
    {{__('Create Company policy')}}
@endsection
@section('content')
<div class="row mt-4">
    <div class="col-12">
        <div class="page-title-box-hori">
            <h4 class="page-title">{{__('Create Company policy')}}</h4>
            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                  <li class="breadcrumb-item"><a href="{{__('home')}}">{{__('Dashboard')}}</a></li>
                  <li class="breadcrumb-item"><a href="{{route('company-policy.index')}}">{{__('Company Policy')}}</a></li>
                  <li class="breadcrumb-item active">{{__('Create')}}</li>
                </ol>
            </div>
        </div>
    </div>
</div>
<hr class="mt-0">


{{Form::open(array('url'=>'company-policy','method'=>'post', 'enctype' => "multipart/form-data"))}}

        <div class="row">
            <div class="col-md-12 ">
                <div class="card ">
                    <!-- <div class="card-header"><h4>{{__('Company policy')}}</h4></div> -->
                    <div class="card-body ">


                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                {{Form::label('title',__('Policy Name'))}}
                                 {{Form::text('title',null,array('class'=>'form-control','required'=>'required'))}}

                                </div>
                            </div>


                            <div class="col-md-6">
                                <div class="form-group">
                                        <label class="">Select Department</label>
                                        <select name="branch" class="form-control" required>
                                        <option value="">Select Department</option>
                                        @if(!empty($department))
                                            @foreach($department as $row)
                                                <option value="{{$row->id}}">{{$row->name}}</option>
                                            @endforeach
                                        @endif
                                        </select>
                                </div>
                            </div>

                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="">Upload Documents</label>
                                  <input type="file" id="check_format" name="images[]" class="form-control" multiple required>
                                  <em>Upload files only: png,jpg,jpeg,pdf,xlsx,csv</em>
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
@push('script-page')
<script>
$(document).ready(function(){
    $("#check_format").on("change",function(){
        var check_format=$(this).val();
        var ext = check_format.split('.').pop();
        if(ext=='png' || ext=='jpg' || ext=='jpeg' || ext=='xlsx' || ext=='csv' || ext=='pdf' || ext=='PDF')
        {

        }
        else
        {
            alert("Please select valid file format");
            $("#check_format").val('');
            return false;
        }
    });
});
</script>
@endpush
