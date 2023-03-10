@extends('layouts.dashboard')
@section('page-title')
    {{__('Ticket')}}
@endsection
@section('content')
<div class="row mt-4">
    <div class="col-12">
        <div class="page-title-box-hori">
            <h4 class="page-title">{{__('Manage Ticket')}}</h4>
            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                  <li class="breadcrumb-item"><a href="{{__('home')}}">{{__('Dashboard')}}</a></li>
                    <li class="breadcrumb-item active">{{__('Ticket')}}</li>
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
                    <h4>{{--__('Ticket List')--}}</h4>
                    @can('Create Ticket')
                        <a href="#" data-url="{{ route('ticket.create') }}" class="btn btn-icon icon-left btn-success" data-ajax-popup="true" data-toggle="tooltip" data-title="{{__('Create New Ticket')}}" data-original-title="{{__('Create Ticket')}}">
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
                            <th>{{__('New Message')}}</th>
                            <th>{{__('Title')}}</th>
                            <th>{{__('Ticket Code')}}</th>
                            @role('company')
                            <th>{{__('Employee')}}</th>
                            @endrole
                            <th>{{__('Priority')}}</th>
                            <th>{{__('Date')}}</th>
                            <th>{{__('Created By')}}</th>
                            <th>{{__('Description')}}</th>
                            <th width="200px">{{__('Action')}}</th>
                        </tr>
                        </thead>
                        <tbody class="font-style">
                        @foreach ($tickets as $ticket)
                            <tr>
                                <td>
                                    @if(\Auth::user()->type=='employee')
                                        @if($ticket->ticketUnread()>0)
                                            <i title="New Message" class="fas fa-circle circle"></i>
                                        @endif
                                    @else
                                        @if($ticket->ticketUnread()>0)
                                            <i title="New Message" class="fas fa-circle circle"></i>
                                        @endif
                                    @endif
                                </td>
                                <td>{{ $ticket->title }}</td>
                                <td>{{ $ticket->ticket_code }}</td>
                                @role('company')
                                <td>{{ !empty(\Auth::user()->getUser($ticket->employee_id))?\Auth::user()->getUser($ticket->employee_id)->name:'' }}</td>
                                @endrole
                                <td>{{ $ticket->priority }}</td>
                                <td>{{  \Auth::user()->dateFormat($ticket->end_date) }}</td>
                                <td>{{ !empty($ticket->createdBy)?$ticket->createdBy->name:'' }}</td>
                                <td>{{ $ticket->description }}</td>
                                <td>
                                    <a href="{{ URL::to('ticket/'.$ticket->id.'/reply') }}" class="btn btn-outline-success  mr-1">
                                        <i class="fas fa-reply"></i> <span>{{__('Reply')}}</span>
                                    </a>

                                    @can('Delete Ticket')
                                        <a href="#" class="btn btn-outline-danger " data-toggle="tooltip" data-original-title="{{__('Delete')}}" data-confirm="Are You Sure?|This action can not be undone. Do you want to continue?" data-confirm-yes="document.getElementById('delete-form-{{$ticket->id}}').submit();"><i class="fas fa-trash"></i> <span>{{__('Delete')}}</span></a>
                                        {!! Form::open(['method' => 'DELETE', 'route' => ['ticket.destroy', $ticket->id],'id'=>'delete-form-'.$ticket->id]) !!}
                                        {!! Form::close() !!}
                                    @endcan
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
