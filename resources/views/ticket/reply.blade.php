@extends('layouts.dashboard')
@section('page-title')
    {{__('Ticket Reply')}}
@endsection
@section('content')
<div class="row mt-4">
    <div class="col-12">
        <div class="page-title-box-hori">
            <h4 class="page-title">{{__('Ticket Reply')}}</h4>
            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                  <li class="breadcrumb-item"><a href="{{__('home')}}">{{__('Dashboard')}}</a></li>
                  <li class="breadcrumb-item"><a href="{{route('ticket.index')}}">{{__('Ticket')}}</a></li>
                  <li class="breadcrumb-item active">{{__('Ticket Reply')}}</li>
                </ol>
            </div>
        </div>
    </div>
</div>
<hr class="mt-0">

<div class="row">
    <div class=" col-md-12 pb-4">
        <div class="float-right">
            @if(\Auth::user()->type=='employee')
                @if($ticket->created_by==\Auth::user()->id)
                    @can('Edit Ticket')
                        <a href="#" data-url="{{ URL::to('ticket/'.$ticket->id.'/edit') }}" data-size="lg" data-ajax-popup="true" data-title="{{__('Edit Ticket')}}" class="btn btn-outline-success  mr-1" data-toggle="tooltip" data-original-title="{{__('Edit')}}"><i class="fas fa-pencil-alt"></i> <span>{{__('Edit')}}</span></a>
                    @endcan
                @endif
            @else
                @can('Edit Ticket')
                    <a href="#" data-url="{{ URL::to('ticket/'.$ticket->id.'/edit') }}" data-size="lg" data-ajax-popup="true" data-title="{{__('Edit Ticket')}}" class="btn btn-outline-success  mr-1" data-toggle="tooltip" data-original-title="{{__('Edit')}}"><i class="fas fa-pencil-alt"></i> <span>{{__('Edit')}}</span></a>
                @endcan
            @endif
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-6">
        @foreach($ticketreply as $reply)
            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between w-100">
                        <h4>{{!empty(\Auth::user()->getUser($reply->created_by))?\Auth::user()->getUser($reply->created_by)->name:'' }} </h4>
                        <p class="text-small text-gray">{{$reply->created_at->diffForHumans()}}</p>
                    </div>
                </div>
                <div class="card-body">
                    <p>{{ $reply->description }}</p>
                </div>
            </div>
        @endforeach
    </div>
    @if($ticket->status=='open')
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between w-100">
                        <h4>{{__('Add Reply')}}</h4>
                    </div>
                </div>
                <div class="card-body">
                    {{Form::open(array('url'=>'ticket/changereply','method'=>'post'))}}
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                {{Form::label('description',__('Description'))}}
                                {{Form::textarea('description',null,array('class'=>'form-control','placeholder'=>__('Ticket Reply')))}}
                            </div>
                        </div>
                    </div>
                    <input type="hidden" value="{{$ticket->id}}" name="ticket_id">

                    <div class="modal-footer pr-0">
                        {{Form::submit(__('Send'),array('class'=>'btn btn-success'))}}
                    </div>
                    {{Form::close()}}
                </div>
            </div>
        </div>
    @endif
</div>
@endsection
