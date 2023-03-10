@extends('layouts.dashboard')
@section('page-title')
    {{__('Award')}}
@endsection
@section('content')
<div class="row mt-4">
    <div class="col-12">
        <div class="page-title-box-hori">
            <h4 class="page-title">{{__('Manage Commission')}}</h4>
            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item"><a href="{{__('home')}}">{{__('Dashboard')}}</a></li>
                    <li class="breadcrumb-item active">{{__('Commission')}}</li>
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
                    <h4>{{--__('Commission List')--}}</h4>
                    @can('Create Commission')
                        <a href="{{ route('commission.create') }}" class="btn btn-icon icon-left btn-success" >
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

                            <th>{{__('Employee')}}</th>

                            <th>{{__('Apply Date')}}</th>
                            <th>{{__('Commission')}}</th>
                            <th>{{__('Remark')}}</th>
                            <th>{{__('Amount')}}</th>
                            <th>{{__('Status')}}</th>
                            <th>{{__('Documents')}}</th>

                                <th class="text-right">{{__('Action')}}</th>

                        </tr>
                        </thead>
                        <tbody class="font-style">
                        @foreach ($get_commission as $row)
                        @php $get_employee=DB::table("employees")->where("id",$row->employee_id)->first();@endphp
                            <tr>
                               <td>@if(!empty($get_employee)) {{$get_employee->first_name}} {{$get_employee->last_name}} @endif</td>
                                <td>{{date("d-m-Y",strtotime($row->created_at))}}</td>
                                <td>{{$row->name}}</td>
                                <td>{{$row->remark}}</td>
                                <td>${{$row->amount}}</td>
                                <td>{{$row->status}}</td>
                                <td>@if(!empty($row->documents))
                                @php $get_explode=explode("#",$row->documents) @endphp
                                        @if(!empty($get_explode))
                                            @foreach($get_explode as $key=>$val)

                                            <a href="{{asset('public/uploads/document')}}/{{$val}}" download><i class="fa fa-file"></i></a>
                                            @endforeach
                                        @endif

                                @endif
                                </td>

                                @if(Gate::check('Edit Award') || Gate::check('Delete Award'))
                                    <td class="text-right">
                                        @can('Edit Award')
                                            <a href="{{ URL::to('commission/'.$row->id.'/edit') }}"  class="btn btn-outline-success  mr-1" ><i class="fas fa-pencil-alt"></i> <span>{{__('Edit')}}</span></a>
                                        @endcan
                                        @can('Delete Award')
                                            <a href="#" class="btn btn-outline-danger " data-toggle="tooltip" data-original-title="{{__('Delete')}}" data-confirm="Are You Sure?|This action can not be undone. Do you want to continue?" data-confirm-yes="document.getElementById('delete-form-{{$row->id}}').submit();"><i class="fas fa-trash"></i> <span>{{__('Delete')}}</span></a>
                                            {!! Form::open(['method' => 'DELETE', 'route' => ['commission.destroy', $row->id],'id'=>'delete-form-'.$row->id]) !!}
                                            {!! Form::close() !!}
                                        @endcan
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
