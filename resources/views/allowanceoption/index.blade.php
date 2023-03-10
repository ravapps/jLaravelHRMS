@extends('layouts.dashboard')
@section('page-title')
    {{__('Allowance Option')}}
@endsection
@section('content')
<div class="row mt-4">
    <div class="col-12">
        <div class="page-title-box-hori">
            <h4 class="page-title">{{__('Manage Allowance Option')}}</h4>
            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item"><a href="{{__('home')}}">{{__('Dashboard')}}</a></li>
                    <li class="breadcrumb-item active">{{__('Allowance Option')}}</li>
                </ol>
            </div>
        </div>
    </div>
</div>
<hr class="mt-0 mb-2">
@if(Session::has('error'))
<span class="text-danger pl-1">{{ Session::get('error') }}</span><br>
@endif

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <div class="d-flex justify-content-between w-100">
                    <h4>{{--__('Allowance Option List')--}}</h4>
                    @can('Create Allowance Option')
                        <a href="{{ route('allowanceoption.create') }}" class="btn btn-icon icon-left btn-success" >
                            <i class="fa fa-plus"></i> {{__('Create')}}
                        </a>
                    @endcan
                </div>
            </div>
            <div class="card-body">
                <form action="{{route('allowanceoption.index')}}" methode="get">
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                               <label>Name</label><span class="text-danger pl-1">*</span>

                                   <input type="text" name="al_name" class="form-control" required>
                            </div>
                        </div>

                        <div class="col" >
                            <div class="form-group">
                               <label>Allowance Type</label><span class="text-danger pl-1">*</span>

                               <select name="al_type" required class="form-control" id="al_type" required>
                                            <option value="">Select Allowance Type</option>
                                            <option value="Percentage">Percentage</option>
                                            <option value="Fixed">Fixed</option>

                                    </select>
                            </div>
                        </div>

                        <div class="col">
                            <div class="form-group">
                            @php $range_data=range(1,100) @endphp
                               <label> Allowance Percentage </label><span class="text-danger pl-1">*</span>

                               <select name="al_percentage" required class="form-control" id="al_percentage" required>
                                        <option value="">Select Allowance Percentage</option>
                                      @foreach($range_data as $key=>$val)
                                        <option value="{{$val}}">{{$val}}%</option>
                                       @endforeach
                              </select>
                            </div>
                        </div>

                        <div class="col-auto">
                            <div class="form-group">
                              <label class="w-100"> &nbsp;</label>
                              {{Form::submit(__('Apply'),array('class'=>'btn btn-success'))}}
                              <a href="{{route('allowanceoption.index')}}" class="btn btn-danger">{{__('Reset')}}</a>

                            </div>
                        </div>
                    </div>
                </form>
                <div class="table-responsive no-header">
                    <table class="table table-striped mb-0" id="dataTable">
                        <thead>
                        <tr>
                            <th>{{__('Allowance Option')}}</th>
                            <th>{{__('Allowance Type')}}</th>
                            <th>{{__('Percentage Of Basis')}}</th>
                            <th>{{__('Limit Per Month')}}</th>
                            <th class="text-right">{{__('Action')}}</th>
                        </tr>
                        </thead>
                        <tbody class="font-style">
                        @foreach ($allowanceoptions as $allowanceoption)
                            <tr>
                                <td>{{ $allowanceoption->name }}</td>
                                <td>{{ $allowanceoption->al_type }}</td>
                                <td>@if(!empty($allowanceoption->percentage)){{ $allowanceoption->percentage }}% @endif</td>
                                <td>@if(!empty($allowanceoption->limit_month))${{ $allowanceoption->limit_month }} @endif</td>

                                <td class="text-right">
                                    @can('Edit Allowance Option')
                                        <a href="{{ URL::to('allowanceoption/'.$allowanceoption->id.'/edit') }}" class="btn btn-outline-success  mr-1" ><i class="fas fa-pencil-alt"></i> <span>{{__('Edit')}}</span></a>
                                    @endcan
                                    @can('Delete Allowance Option')
                                        <a href="#" class="btn btn-outline-danger " data-toggle="tooltip" data-original-title="{{__('Delete')}}" data-confirm="Are You Sure?|This action can not be undone. Do you want to continue?" data-confirm-yes="document.getElementById('delete-form-{{$allowanceoption->id}}').submit();"><i class="fas fa-trash"></i> <span>{{__('Delete')}}</span></a>
                                        {!! Form::open(['method' => 'DELETE', 'route' => ['allowanceoption.destroy', $allowanceoption->id],'id'=>'delete-form-'.$allowanceoption->id]) !!}
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
