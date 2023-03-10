@extends('layouts.dashboard')
@section('page-title')
    {{__('Documents')}}
@endsection
@section('content')
<div class="row mt-4">
    <div class="col-12">
        <div class="page-title-box-hori">
            <h4 class="page-title">{{__('Manage Document')}}</h4>
            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                  <li class="breadcrumb-item"><a href="{{__('home')}}">{{__('Dashboard')}}</a></li>
                    <li class="breadcrumb-item active">{{__('Documents')}}</li>
                </ol>
            </div>
        </div>
    </div>
</div>
<hr class="mt-0 mb-2">

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <div class="d-flex justify-content-between w-100">
                    <h4>{{--__('Document List')--}}</h4>
                    @can('Create Document')
                        <a href="{{ route('document-upload.create') }}" class="btn btn-icon icon-left btn-success">
                            <i class="fa fa-plus"></i> {{__('Create')}}
                        </a>
                    @endcan
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped mb-0" id="dataTable">
                        <thead>
                        <tr>
                            <th>{{__('Name')}}</th>
                            <th>{{__('Document')}}</th>
                            <th>{{__('Upload Date')}}</th>
                             @if(Gate::check('Edit Document') || Gate::check('Delete Document'))
                                <th class="text-right">{{__('Action')}}</th>
                            @endif
                        </tr>
                        </thead>
                        <tbody class="font-style">
                        @foreach ($documents as $document)
                            @php $get_id_array=array();
                                $documentPath=asset(Storage::url('uploads/documentUpload'));
                                   $roles = \Spatie\Permission\Models\Role::find($document->role);
                                   $get_images=DB::table("document_images")->where("document_id",$document->id)->get();

                                   $get_assign_docs=DB::table("assign_emp_document")->where("document_id",$document->id)->get();

                            @endphp
                              @if(!empty($get_assign_docs))
                                        @foreach($get_assign_docs as $row)
                                        @php $get_id_array[]=$row->employee_id;  @endphp
                                        @endforeach
                                   @endif
                            <tr>
                                <td>{{ $document->name }}</td>
                                <td>

                                    @if(!empty($get_images))
                                        @foreach($get_images as $row1)
                                            <a href="{{asset('public/uploads/document/'.$row1->image_name)}}" class="" target="_blank"><i class="fa fa-file" aria-hidden="true" style="color:#6777ef;"></i></a>
                                        @endforeach
                                   @endif
                                </td>
                                <td>{{ date("d-m-Y",strtotime($document->created_at)) }}</td>
                                @if(Gate::check('Edit Document') || Gate::check('Delete Document'))
                                    <td class="text-right">
                                        <a href="{{ url('document-upload/assign',$document->id)}}"  class="btn btn-outline-primary  mr-1" ><i class="fas fa-pencil-alt"></i> <span>{{__('Assign to Employees')}}</span></a>
                                        @can('Edit Document')
                                            <a href="{{ route('document-upload.edit',$document->id)}}"  class="btn btn-outline-success  mr-1" ><i class="fas fa-pencil-alt"></i> <span>{{__('Edit')}}</span></a>
                                        @endcan
                                        @can('Delete Document')
                                            <a href="#" class="btn btn-outline-danger " data-toggle="tooltip" data-original-title="{{__('Delete')}}" data-confirm="Are You Sure?|This action can not be undone. Do you want to continue?" data-confirm-yes="document.getElementById('delete-form-{{$document->id}}').submit();"><i class="fas fa-trash"></i> <span>{{__('Delete')}}</span></a>

                                            {!! Form::open(['method' => 'DELETE', 'route' => ['document-upload.destroy', $document->id],'id'=>'delete-form-'.$document->id]) !!}
                                            {!! Form::close() !!}
                                        @endif

                                    </td>
                                @endif
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
