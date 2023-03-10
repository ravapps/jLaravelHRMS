@extends('layouts.dashboard')
@section('page-title')
    {{__('Holiday')}}
@endsection
@section('content')
<div class="row mt-4">
    <div class="col-12">
        <div class="page-title-box-hori">
            <h4 class="page-title">{{__('Manage Holiday')}}</h4>
            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item"><a href="{{__('home')}}">{{__('Dashboard')}}</a></li>
                    <li class="breadcrumb-item active">{{__('Holiday')}}</li>
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
                    <h4>{{--__('Holiday List')--}}</h4>
                    @can('Create Holiday')
                        <a href="{{ route('holiday.create') }}" class="btn btn-icon icon-left btn-success" >
                            <i class="fa fa-plus"></i> {{__('Create')}}
                        </a>
                    @endcan
                </div>
            </div>
            <div class="card-body">
                {{ Form::open(array('url' => 'holiday','method'=>'get')) }}
                  <div class="row">
                    <div class="col">
                    {{Form::label('occasion',__('Holiday'))}}
                        {{Form::text('occasion',isset($_GET['occasion'])?$_GET['occasion']:'',array('class'=>'form-control'))}}
                    </div>
                    <div class="col">
                        {{Form::label('start_date',__('Start Date'))}}
                        {{Form::date('start_date',isset($_GET['start_date'])?$_GET['start_date']:'',array('class'=>'form-control'))}}
                    </div>
                    <div class="col">
                        {{Form::label('end_date',__('End Date'))}}
                        {{Form::date('end_date',isset($_GET['end_date'])?$_GET['end_date']:'',array('class'=>'form-control'))}}
                    </div>
                    <div class="col-auto apply-btn">
                        <label for="" class="w-100">&nbsp;</label>
                        {{Form::submit(__('Apply'),array('class'=>'btn btn-success'))}}
                        <a href="{{route('holiday.index')}}" class="btn btn-danger">{{__('Reset')}}</a>
                    </div>
                </div>
              {{ Form::close() }}
              <hr>

              <div class="table-responsive">
                  <table class="table table-striped mb-0" id="">
                      <thead>
                      <tr>
                      <th>{{__('Holiday Name')}}</th>
                          <th>{{__('Start Date')}}</th>
                          <th>{{__('End Date')}}</th>
                          <th>{{__('Start Time')}}</th>
                          <th>{{__('End Time')}}</th>
                          <th>{{__('Comment')}}</th>
                          @if( Gate::check('Edit Holiday') ||Gate::check('Delete Holiday'))
                              <th class="text-right">{{__('Action')}}</th>
                          @endif
                      </tr>
                      </thead>
                      <tbody class="font-style">
                      @foreach ($holidays as $holiday)
                          <tr>
                          <td>{{ $holiday->occasion }}</td>

                              <td>{{ \Auth::user()->dateFormat($holiday->date) }}</td>
                              <td>{{ \Auth::user()->dateFormat($holiday->end_date) }}</td>
                              <td>{{ $holiday->start_time }}</td>
                              <td>{{ $holiday->end_time }}</td>
                              <td>{{ $holiday->comment }}</td>
                              @if( Gate::check('Edit Holiday') ||Gate::check('Delete Holiday'))
                                  <td class="text-right">
                                      @can('Edit Holiday')
                                          <a href="{{ route('holiday.edit',$holiday->id) }}" class="btn btn-outline-success  mr-1" >
                                              <i class="fas fa-pencil-alt"></i> <span>{{__('Edit')}}</span>
                                          </a>
                                      @endcan
                                      @can('Delete Holiday')
                                          <a href="#!" class="btn btn-outline-danger " data-toggle="tooltip" data-original-title="{{__('Delete')}}" data-confirm="Are You Sure?|This action can not be undone. Do you want to continue?" data-confirm-yes="document.getElementById('delete-form-{{$holiday->id}}').submit();">
                                              <i class="fas fa-trash"></i> <span>{{__('Delete')}}</span>
                                          </a>
                                          {!! Form::open(['method' => 'DELETE', 'route' => ['holiday.destroy', $holiday->id],'id'=>'delete-form-'.$holiday->id]) !!}
                                          {!! Form::close() !!}
                                      @endcan
                                  </td>
                              @endif
                          </tr>
                      @endforeach
                      </tbody>
                  </table>
              </div>
              {{ $holidays->links() }}
            </div>
        </div>
    </div>
</div>
@endsection
