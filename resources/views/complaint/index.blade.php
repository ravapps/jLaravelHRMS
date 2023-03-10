@extends('layouts.dashboard')
@section('page-title')
    {{__('Complain')}}
@endsection
@section('content')
<div class="row mt-4">
    <div class="col-12">
        <div class="page-title-box-hori">
            <h4 class="page-title">{{__('Manage Complaint')}}</h4>
            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                  <li class="breadcrumb-item"><a href="{{__('home')}}">{{__('Dashboard')}}</a></li>
                    <li class="breadcrumb-item active">{{__('Complaint')}}</li>
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
                    <h4>{{--__('Complaint List')--}}</h4>
                    @can('Create Complaint')
                        <a href="#" data-url="{{ route('complaint.create') }}" class="btn btn-icon icon-left btn-success" data-ajax-popup="true" data-toggle="tooltip" data-title="{{__('Create New Complaint')}}" data-original-title="{{__('Create Complaint')}}">
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
                            <th>{{__('Complaint From')}}</th>
                            <th>{{__('Complaint Against')}}</th>
                            <th>{{__('Title')}}</th>
                            <th>{{__('Complaint Date')}}</th>
                            <th>{{__('Description')}}</th>
                            @if(Gate::check('Edit Complaint') || Gate::check('Delete Complaint'))
                                <th class="text-right">{{__('Action')}}</th>
                            @endif
                        </tr>
                        </thead>
                        <tbody class="font-style">
                        @foreach ($complaints as $complaint)

                            <tr>
                                <td>{{!empty( $complaint->complaintFrom($complaint->complaint_from))? $complaint->complaintFrom($complaint->complaint_from)->name:'' }}</td>
                                <td>{{ !empty($complaint->complaintAgainst($complaint->complaint_against))?$complaint->complaintAgainst($complaint->complaint_against)->name:'' }}</td>
                                <td>{{ $complaint->title }}</td>
                                <td>{{ \Auth::user()->dateFormat( $complaint->complaint_date) }}</td>
                                <td>{{ $complaint->description }}</td>
                                @if(Gate::check('Edit Complaint') || Gate::check('Delete Complaint'))
                                    <td class="text-right">
                                        @can('Edit Complaint')
                                            <a href="#" data-url="{{ URL::to('complaint/'.$complaint->id.'/edit') }}" data-size="lg" data-ajax-popup="true" data-title="{{__('Edit Complaint')}}" class="btn btn-outline-success  mr-1" data-toggle="tooltip" data-original-title="{{__('Edit')}}"><i class="fas fa-pencil-alt"></i> <span>{{__('Edit')}}</span></a>
                                        @endcan
                                        @can('Delete Complaint')
                                            <a href="#" class="btn btn-outline-danger " data-toggle="tooltip" data-original-title="{{__('Delete')}}" data-confirm="Are You Sure?|This action can not be undone. Do you want to continue?" data-confirm-yes="document.getElementById('delete-form-{{$complaint->id}}').submit();"><i class="fas fa-trash"></i> <span>{{__('Delete')}}</span></a>
                                            {!! Form::open(['method' => 'DELETE', 'route' => ['complaint.destroy', $complaint->id],'id'=>'delete-form-'.$complaint->id]) !!}
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
