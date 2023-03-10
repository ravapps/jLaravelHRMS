@extends('layouts.dashboard')
@section('page-title')
    {{__('Bulk Upload')}}
@endsection
@section('content')
<div class="row mt-4">
    <div class="col-12">
        <div class="page-title-box-hori">
            <h4 class="page-title">{{__('Bulk Upload')}}</h4>
            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                  <li class="breadcrumb-item"><a href="{{__('home')}}">{{__('Dashboard')}}</a></li>
                  <li class="breadcrumb-item"><a href="{{route('employee.index')}}">{{__('Bulk Upload')}}</a></li>
                    <li class="breadcrumb-item active">{{__('Create')}}</li>
                </ol>
            </div>
        </div>
    </div>
</div>
<hr class="mt-0 mb-2">

<div class="row">
  <div class="col-sm-12">
    <div class="card">
      <div class="card-body">
        <form method="post" action="{{route('attendanceemployee.bulkattendance')}}" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col">
                    <div class="form-group">
                       <label>Name</label><span class="text-danger pl-1">*</span>
                       <input type="file" name="bulk_upload" value=""  id="bulk_upload" class="form-control" required>
                       <a href="{{asset('public/uploads/sample.xlsx')}}" download><b>Click here to download sample</b></a>
                    </div>
                </div>
                <div class="col-auto">
                    <div class="form-group">
                      <label class="w-100">&nbsp;</label>
                       {!! Form::submit('Upload', ['class' => 'btn btn-success']) !!}
                    </div>
                </div>
            </div>
        {!! Form::close() !!}
      </div>
    </div>
  </div>
</div>
@endsection
@push('script-page')
<script>
$(document).ready(function(){
    $("#bulk_upload").on('change',function () {
        var ext = $("#bulk_upload").val().split('.').pop();

        if(ext!='xlsx')
        {
            alert("Only XLXS file format required");
            $("#bulk_upload").val("");
            return false;

        }
        });
});
</script>
@endpush
