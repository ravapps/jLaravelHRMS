@extends('layouts.dashboard')
@section('page-title')
    {{__('Training Type')}}
@endsection
@section('content')
<div class="row mt-4">
    <div class="col-12">
        <div class="page-title-box-hori">
            <h4 class="page-title">{{__('Manage Training Type')}}</h4>
            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                  <li class="breadcrumb-item"><a href="{{__('home')}}">{{__('Dashboard')}}</a></li>
                    <li class="breadcrumb-item active">{{__('Training Type')}}</li>
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
                    <h4>{{--__('Training Type List')--}}</h4>
                    @can('Create Training Type')
                        <a href="#" data-url="{{ route('trainingtype.create') }}" class="btn btn-icon icon-left btn-success" data-ajax-popup="true" data-title="{{__('Create New Training Type')}}">
                            <i class="fa fa-plus"></i> {{__('Create')}}
                        </a>
                    @endcan
                </div>
            </div>
            <div class="card-body">

                <form action="{{route('trainingtype.index')}}" methode="get">
                    <div class="row">
                        <div class="col" >
                            <div class="form-group">
                               <label>Training Type</label><span class="text-danger pl-1">*</span>
                               <select name="train_type_id" required class="form-control" id="train_type_id" required>
                                  <option value="">Select Training Type</option>
                                  @if(!empty($trainingtypes))
                                      @foreach($trainingtypes as $trainingtype)
                                          <option value="{{$trainingtype->id}}">{{$trainingtype->name}}</option>
                                      @endforeach
                                  @endif
                                </select>
                            </div>
                        </div>

                        <div class="col">
                            <div class="form-group">
                               <label>Status</label><span class="text-danger pl-1">*</span>
                               <select name="status" class="form-control"  required>
                                    <option value="">Select Status</option>
                                    <option value="Active">Active</option>
                                    <option value="In-Active">In-Active</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-auto">
                            <div class="form-group">
                              <label class="w-100">&nbsp;</label>
                              {{Form::submit(__('Apply'),array('class'=>'btn btn-success'))}}
                              <a href="{{route('trainingtype.index')}}" class="btn btn-danger">{{__('Reset')}}</a>
                            </div>
                        </div>
                    </div>
                </form>

                <hr class="mt-2">

                <div class="table-responsive">
                    <table class="table table-striped mb-0" id="dataTable">
                        <thead>
                        <tr>
                            <th>{{__('Training Type')}}</th>
                            <th>{{__('Training Description')}}</th>
                            <th>{{__('Status')}}</th>
                            <th class="text-right">{{__('Action')}}</th>
                        </tr>
                        </thead>
                        <tbody class="font-style">
                        @foreach ($trainingtypes as $trainingtype)
                            <tr>
                                <td>{{ $trainingtype->name }}</td>
                                <td>{{ $trainingtype->description }}</td>
                                <td>{{ $trainingtype->status }}</td>

                                <td class="text-right">
                                    @can('Edit Training Type')
                                        <a href="#" data-url="{{ route('trainingtype.edit',$trainingtype->id) }}" data-size="lg" data-ajax-popup="true" data-title="{{__('Edit Training Type')}}" class="btn btn-outline-success  mr-1" ><i class="fas fa-pencil-alt"></i> <span>{{__('Edit')}}</span></a>
                                    @endcan
                                    @can('Delete Training Type')
                                        <a href="#" class="btn btn-outline-danger "  data-confirm="Are You Sure?|This action can not be undone. Do you want to continue?" data-confirm-yes="document.getElementById('delete-form-{{$trainingtype->id}}').submit();"><i class="fas fa-trash"></i> <span>{{__('Delete')}}</span></a>
                                        {!! Form::open(['method' => 'DELETE', 'route' => ['trainingtype.destroy', $trainingtype->id],'id'=>'delete-form-'.$trainingtype->id]) !!}
                                        {!! Form::close() !!}
                                    @endif
                                </td>
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
