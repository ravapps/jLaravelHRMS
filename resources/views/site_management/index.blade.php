@extends('layouts.dashboard')
@section('page-title')
    {{__('Department')}}
@endsection
@section('content')
<div class="row mt-4">
    <div class="col-12">
        <div class="page-title-box-hori">
            <h4 class="page-title">{{__('Site Management')}}</h4>
            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                  <li class="breadcrumb-item"><a href="{{__('home')}}">{{__('Dashboard')}}</a></li>
                    <li class="breadcrumb-item active">{{__('Site Management')}}</li>
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
                    <h4>{{--__('Site List')--}}</h4>
                    <a href="#" data-url="{{ route('site_management.create') }}" class="btn btn-icon icon-left btn-success" data-ajax-popup="true" data-toggle="tooltip" data-title="{{__('Create New Site')}}" data-original-title="{{__('Create New Site')}}">
                        <i class="fa fa-plus"></i> {{__('Create')}}
                    </a>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped mb-0" id="dataTable">
                        <thead>
                        <tr>
                            <th>{{__('Customer Name')}}</th>
                            <th>{{__('Site Address')}}</th>
                            <th class="text-right">{{__('Action')}}</th>
                        </tr>
                        </thead>
                        <tbody class="font-style">
                            <tr>
                                <td>Jhon Deo</td>
                                <td>665 ALJUNIED ROAD 05-11 CITITECH INDUSTRIAL BUILDING, 389838, Singapore</td>

                                <td class="text-right">
                                    <a href="#" data-url="{{ URL::to('site_management/edit') }}" data-size="lg" data-ajax-popup="true" data-title="{{__('Edit Site')}}" class="btn btn-outline-success  mr-1" data-toggle="tooltip" data-original-title="{{__('Edit')}}"><i class="fas fa-pencil-alt"></i> <span>{{__('Edit')}}</span></a>
                                    <a href="#" class="btn btn-outline-danger " data-toggle="tooltip" data-original-title="{{__('Delete')}}" data-confirm="Are You Sure?|This action can not be undone. Do you want to continue?" data-confirm-yes=""><i class="fas fa-trash"></i> <span>{{__('Delete')}}</span></a>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
