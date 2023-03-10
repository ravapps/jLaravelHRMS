@extends('layouts.dashboard')
@section('page-title')
    {{__('Promotion')}}
@endsection
@section('content')
<div class="row mt-4">
    <div class="col-12">
        <div class="page-title-box-hori">
            <h4 class="page-title">{{__('Manage Promotion')}}</h4>
            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item"><a href="{{__('home')}}">{{__('Dashboard')}}</a></li>
                    <li class="breadcrumb-item active">{{__('Promotion')}}</li>
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
                    <h4>{{--__('Promotion List')--}}</h4>
                    @can('Create Promotion')
                        <a href="{{ route('promotion.create') }}" data-url="" class="btn btn-icon icon-left btn-success">
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
                            <!-- @role('company')
                            <th>{{__('Promoted Employee')}}</th>
                            @endrole -->
                            <th>{{__('Promoted Employee')}}</th>
                            <!-- <th>{{__('Department')}}</th> -->
                            <th>{{__('Promotion Designation From ')}}</th>
                            <th>{{__('Promotion Designation To ')}}</th>
                            <th>{{__('Promotion Date ')}}</th>
                            @if(Gate::check('Edit Promotion') || Gate::check('Delete Promotion'))
                                <th class="text-right">{{__('Action')}}</th>
                            @endif

                        </tr>
                        </thead>
                        <tbody class="font-style">
                        @foreach ($promotions as $promotion)

                        <?php
                        $promotion_from=DB::table("designations")->where("id",$promotion->designation_id)->first();
                        $promotion_to=DB::table("designations")->where("id",$promotion->designation_to_id)->first();

                        ?>
                            <tr>
                                <!-- @role('company')
                                <td>{{ !empty($promotion->employee())?$promotion->employee()->name:'' }}</td>
                                @endrole -->
                                <td>{{ !empty($promotion->employee())?$promotion->employee()->name:'' }}</td>

                                <td>{{ $promotion_from->name}}</td>
                                <td>{{ $promotion_to->name }}</td>

                                <td>{{  \Auth::user()->dateFormat($promotion->promotion_date) }}</td>

                                @if(Gate::check('Edit Promotion') || Gate::check('Delete Promotion'))
                                    <td class="text-right">
                                        @can('Edit Promotion')
                                            <a href="{{ URL::to('promotion/'.$promotion->id.'/edit') }}" data-size="lg"  class="btn btn-outline-success  mr-1" ><i class="fas fa-pencil-alt"></i> <span>{{__('Edit')}}</span></a>
                                        @endcan
                                        @can('Delete Promotion')
                                            <a href="#" class="btn btn-outline-danger " data-toggle="tooltip" data-original-title="{{__('Delete')}}" data-confirm="Are You Sure?|This action can not be undone. Do you want to continue?" data-confirm-yes="document.getElementById('delete-form-{{$promotion->id}}').submit();"><i class="fas fa-trash"></i> <span>{{__('Delete')}}</span></a>
                                            {!! Form::open(['method' => 'DELETE', 'route' => ['promotion.destroy', $promotion->id],'id'=>'delete-form-'.$promotion->id]) !!}
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
