@extends('layouts.dashboard')
@section('page-title')
    {{__('Update Company policy')}}
@endsection
@section('content')
<div class="row mt-4">
    <div class="col-12">
        <div class="page-title-box-hori">
            <h4 class="page-title">{{__('Edit Company policy')}}</h4>
            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                  <li class="breadcrumb-item"><a href="{{__('home')}}">{{__('Dashboard')}}</a></li>
                  <li class="breadcrumb-item"><a href="{{route('company-policy.index')}}">{{__('Company Policy')}}</a></li>
                  <li class="breadcrumb-item active">{{__('Edit')}}</li>
                </ol>
            </div>
        </div>
    </div>
</div>
<hr class="mt-0">

{{Form::model($companyPolicy,array('route' => array('company-policy.update', $companyPolicy->id), 'method' => 'PUT','enctype' => "multipart/form-data")) }}

        <div class="row">
            <div class="col-md-12 ">
                <div class="card ">
                    <!-- <div class="card-header"><h4>{{__('Company policy')}}</h4></div> -->
                    <div class="card-body ">


                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">

                                 <label class="">Policy Name</label>
                                 <input type="text" name="title" class="form-control" value="{{$companyPolicy->title}}" required>
                                </div>
                            </div>

                            <?php  $get_images=DB::table("policy_images")->where("policy_id",$companyPolicy->id)->get();?>
                            <div class="col-md-6">
                                <div class="form-group">
                                        <label class="">Select Department</label>
                                        <select name="branch" class="form-control" required>
                                        <option value="">Select Department</option>
                                        @if(!empty($department))
                                            @foreach($department as $row)
                                                <option value="{{$row->id}}" @if($row->id==$companyPolicy->branch) selected='selected' @endif>{{$row->name}}</option>
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
                                  <input type="file" id="check_format" name="images[]" class="form-control" multiple @if(count($get_images)<1) required @endif>
                                  <em>Upload files only: png,jpg,jpeg,pdf,xlsx,csv</em><br/>
                                  @if(!empty($get_images))
                                            @foreach($get_images as $row1)
                                                <div class="d-flex w-100 mt-1">
                                                <a href="{{asset('public/uploads/document/'.$row1->image_name)}}" class="mr-1" target="_blank">{{$row1->image_name}}</a>
                                                <a href="javascript:void(0)" onclick="delete_image_policy({{$row1->id}},{{$companyPolicy->id}})" class="" style="color:red;">Remove</a>
                                              </div>
                                            @endforeach
                                       @endif
                                </div>
                            </div>

                        </div>

                        <div class="row">
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            {!! Form::submit('Update', ['class' => 'btn btn-success float-right']) !!}
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
function delete_image_policy(image_id,docs_id)
{

    if(confirm("Are you sure to delete this document file?"))
    {
        $.ajax({
                url: '{{route('company-policy.delete_image_policy')}}',
                type: 'POST',
                data: {
                    "image_id": image_id,"docs_id": docs_id, "_token": "{{ csrf_token() }}",
                },
                success: function (data) {

                   window.location.href=data.docs_id;
                }
            });
    }
    return false;
}
</script>
@endpush
