@extends('layouts.dashboard')
@section('page-title')
    {{__('Company Policy')}}
@endsection
@section('content')
<div class="row mt-4">
    <div class="col-12">
        <div class="page-title-box-hori">
            <h4 class="page-title">{{__('Manage Company Policy')}}</h4>
            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                  <li class="breadcrumb-item"><a href="{{__('home')}}">{{__('Dashboard')}}</a></li>
                    <li class="breadcrumb-item active">{{__('Company Policy')}}</li>
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
                    <h4>{{--__('Company Policy List')--}}</h4>
                    @can('Create Company Policy')
                        <a href="{{ route('company-policy.create') }}"  class="btn btn-icon icon-left btn-success" >
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
                            <th>{{__('Department')}}</th>
                            <th>{{__('Title')}}</th>

                            <th>{{__('Attachment')}}</th>
                            @if(Gate::check('Edit Company Policy') || Gate::check('Delete Company Policy'))
                                <th class="text-right">{{__('Action')}}</th>
                            @endif
                        </tr>
                        </thead>
                        <tbody class="font-style">
                        @foreach ($companyPolicy as $policy)

                            @php
                                $policyPath=asset(Storage::url('uploads/companyPolicy'));
                                $get_images=DB::table("policy_images")->where("policy_id",$policy->id)->get();
                            @endphp
                            <tr>
                                <td>{{ !empty($policy->department)?$policy->department->name:'' }}</td>
                                <td>{{ $policy->title }}</td>

                                <td>
                                @if(!empty($get_images))
                                        @foreach($get_images as $row1)
                                            <a href="{{asset('public/uploads/document/'.$row1->image_name)}}" class="" target="_blank"><i class="fa fa-file" aria-hidden="true" style="color:#6777ef;"></i></a>
                                        @endforeach
                                   @endif
                                </td>
                                @if(Gate::check('Edit Company Policy') || Gate::check('Delete Company Policy'))
                                    <td class="text-right">
                                        <a href="{{ url('company-policy/assign',$policy->id)}}"  class="btn btn-outline-primary  mr-1" ><i class="fas fa-pencil-alt"></i> <span>{{__('Assign to Employees')}}</span></a>
                                        @can('Edit Company Policy')
                                            <a href="{{ route('company-policy.edit',$policy->id)}}" class="btn btn-outline-success  mr-1" ><i class="fas fa-pencil-alt"></i> <span>{{__('Edit')}}</span></a>
                                        @endcan
                                        @can('Delete Company Policy')
                                            <a href="#" class="btn btn-outline-danger " data-toggle="tooltip" data-original-title="{{__('Delete')}}" data-confirm="Are You Sure?|This action can not be undone. Do you want to continue?" data-confirm-yes="document.getElementById('delete-form-{{$policy->id}}').submit();"><i class="fas fa-trash"></i> <span>{{__('Delete')}}</span></a>
                                            {!! Form::open(['method' => 'DELETE', 'route' => ['company-policy.destroy', $policy->id],'id'=>'delete-form-'.$policy->id]) !!}
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
