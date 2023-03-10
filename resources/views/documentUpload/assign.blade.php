@extends('layouts.dashboard')
@section('page-title')
    {{__('Assign Employee')}}
@endsection
@section('content')

<div class="row mt-4">
    <div class="col-12">
        <div class="page-title-box-hori">
            <h4 class="page-title">{{__('Assign Employee')}}</h4>
            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                  <li class="breadcrumb-item"><a href="{{__('home')}}">{{__('Dashboard')}}</a></li>
                  <li class="breadcrumb-item"><a href="{{route('document-upload.index')}}">{{__('Document Uploads')}}</a></li>
                  <li class="breadcrumb-item active">{{__('Assign')}}</li>
                </ol>
            </div>
        </div>
    </div>
</div>
<hr class="mt-0">

<form  action="{{route('document-upload.assign_member')}}" method="post">
    @csrf

    <div class="card ">
        <!-- <div class="card-header"><h4>{{__('Assign Employee')}}</h4></div> -->
        <div class="card-body ">


            <div class="row">
                <div class="col">
                    <div class="form-group">
                    <label>Employee Name</label><span class="text-danger pl-1">*</span>
                    <select name="employee_id[]" required class="form-control" id="" multiple>

                    @if($employees)
                    @foreach($employees as $employee)
                        @if (in_array($employee->id, $get_employee_id))

                        @else

                            <option value="{{$employee->id}}">{{$employee->first_name}} {{$employee->last_name}}</option>
                        @endif


                    @endforeach
                    @endif
                    </select>
                    <input type="hidden" name="docs_ids" id="docs_ids" value="{{$docs_ids}}">
                    </div>
                    </div>

                    <div class="col-auto">
                        <div class="form-group">
                            <label class="w-100">&nbsp;</label>
                            <button type="submit" class="btn btn-success float-left">Assign</button>

                        </div>
                    </div>


            </div>

        </div>
    </div>
    <div class="card ">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped mb-0" id="dataTable">
                    <thead>
                    <tr>
                        <th>{{__('Name')}}</th>
                        <th>{{__('Status')}}</th>

                         @if(Gate::check('Edit Document') || Gate::check('Delete Document'))
                            <th class="text-left">{{__('Action')}}</th>
                        @endif
                    </tr>
                    </thead>
                    <tbody class="font-style">
                    @foreach ($ge_employee_name as $ge_employee)

                        <tr>
                            <td>{{ $ge_employee->name }}</td>
                            <td>@if($ge_employee->read_flag=="0") Un-Read @else Read @endif</td>
                            <td>
                            <!-- <a href="javascript:void(0)" class="btn btn-outline-danger  trigger--fire-modal-1" onclick="delete_assign_emp({{$ge_employee->document_id }},{{$ge_employee->name }})"><i class="fas fa-trash"></i> <span>Delete</span></a> -->
                           <a href="javascript:void(0)" onclick="delete_assign_emp({{$ge_employee->document_id}},{{$ge_employee->id}})" class="btn btn-outline-danger" ><i class="fas fa-trash"></i> <span>Delete</span></a>
                            </td>

                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

{!! Form::close() !!}

@endsection
@push('script-page')
 <script>
function delete_assign_emp(image_id,docs_id)
{

    if(confirm("Are you sure to delete this record?"))
    {
        $.ajax({
                url: '{{route('document-upload.delete_assign_emp')}}',
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
