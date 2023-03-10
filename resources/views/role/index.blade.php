@extends('layouts.dashboard')
@section('page-title')
    {{__('Role')}}
@endsection
@section('content')
<div class="row mt-4">
    <div class="col-12">
        <div class="page-title-box-hori">
            <h4 class="page-title">{{__('Manage Role')}}</h4>
            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                  <li class="breadcrumb-item"><a href="{{__('home')}}">{{__('Dashboard')}}</a></li>
                  <!-- <li class="breadcrumb-item"><a href="{{route('roaster.index')}}">{{__('Shift Roster')}}</a></li> -->
                  <li class="breadcrumb-item active">{{__('Role')}}</li>
                </ol>
            </div>
        </div>
    </div>
</div>
<hr class="mt-0">


<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <div class="d-flex justify-content-between w-100">
                    <h4>{{__('Role List')}}</h4>
                    <a href="#" data-url="{{ route('roles.create') }}" data-size="xl" data-ajax-popup="true" data-title="{{__('Create New Role')}}" class="btn btn-icon icon-left btn-success">
                        <i class="fa fa-plus"></i> {{__('Create')}}
                    </a>

                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped mb-0" id="dataTable">
                        <thead>
                        <tr>
                            <th>{{__('Role')}}</th>
                            <th>{{__('Permissions')}}</th>
                            <th class="text-right">{{__('Action')}}</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($roles as $role)
                            <tr>
                                <td>{{ $role->name }}</td>
                                <td>
                                    @foreach($role->permissions()->pluck('name') as $permission)
                                        <h6 class="float-left mr-1">
                                            <div class="badge badge-primary">{{$permission}}</div>
                                        </h6>
                                    @endforeach
                                </td>
                                <td class="text-right">
                                    @can('Edit Role')
                                        <a href="#" data-url="{{ URL::to('roles/'.$role->id.'/edit') }}" data-size="lg" data-ajax-popup="true" data-title="{{__('Edit Role')}}" class="btn btn-outline-success  mr-1" data-toggle="tooltip" data-original-title="{{__('Edit')}}"><i class="fas fa-pencil-alt"></i> <span>{{__('Edit')}}</span></a>
                                    @endcan
                                    @if($role->name!='employee')
                                        @can('Delete Role')
                                            <a href="#" class="btn btn-outline-danger " data-toggle="tooltip" data-original-title="{{__('Delete')}}" data-confirm="Are You Sure?|This action can not be undone. Do you want to continue?" data-confirm-yes="document.getElementById('delete-form-{{$role->id}}').submit();"><i class="fas fa-trash"></i> <span>{{__('Delete')}}</span></a>
                                            {!! Form::open(['method' => 'DELETE', 'route' => ['roles.destroy', $role->id],'id'=>'delete-form-'.$role->id]) !!}
                                            {!! Form::close() !!}
                                        @endcan
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
