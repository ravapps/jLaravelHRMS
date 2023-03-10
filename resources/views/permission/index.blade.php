@extends('layouts.dashboard')
@section('content')

<div class="row mt-4">
    <div class="col-12">
        <div class="page-title-box-hori">
            <h4 class="page-title">{{__('Permission')}}</h4>
            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                  <li class="breadcrumb-item"><a href="{{__('home')}}">{{__('Dashboard')}}</a></li>
                  <!-- <li class="breadcrumb-item"><a href="{{route('employee.index')}}">{{__('Pay Grade')}}</a></li> -->
                  <li class="breadcrumb-item active">{{__('Permission')}}</li>
                </ol>
            </div>
        </div>
    </div>
</div>
<hr class="mt-0">

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <div class="d-flex justify-content-between w-100">
                    <h4> {{__('Manage Permission')}}</h4>

                    <a href="#" data-url="{{ route('permissions.create') }}" class="btn btn-icon icon-left btn-success" data-ajax-popup="true" data-toggle="tooltip" data-title="{{__('Add Permission')}}" data-original-title="{{__('Add Permission')}}">

                        <span>
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 49.861 49.861"><path d="M45.963 21.035h-17.14V3.896C28.824 1.745 27.08 0 24.928 0s-3.896 1.744-3.896 3.896v17.14H3.895C1.744 21.035 0 22.78 0 24.93s1.743 3.895 3.895 3.895h17.14v17.14c0 2.15 1.744 3.896 3.896 3.896s3.896-1.744 3.896-3.896v-17.14h17.14c2.152 0 3.896-1.744 3.896-3.895a3.9 3.9 0 0 0-3.898-3.896z" fill="#010002"/></svg>
                      </span>
                        {{ __('Create') }}
                    </a>

                </div>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="table-responsive">
                        <div class="row">
                            <div class="col-sm-12 card-body">
                                <div class="table-responsive">
                                    <table class="table table-striped " id="dataTable">
                                        <thead class="">
                                        <tr>
                                            <th scope="col" style="width: 88%;">{{__('title')}}</th>
                                            <th scope="col" style="width: 12%;">{{__('Action')}}</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach ($permissions as $permission)
                                            <tr role="row">
                                                <td>{{ $permission->name }}</td>
                                                <td>
                                                    <a href="#" data-url="{{ route('permissions.edit',$permission->id) }}" data-size="lg" data-ajax-popup="true" data-title="{{__('Update permission')}}" class="btn btn-outline  blue-madison">
                                                        <i class="far fa-edit"></i>
                                                    </a>
                                                    <a href="#" class="btn btn-outline  red" data-toggle="tooltip" data-original-title="{{__('Delete')}}" data-confirm="Are You Sure?|This action can not be undone. Do you want to continue?" data-confirm-yes="document.getElementById('delete-form-{{$permission->id}}').submit();">
                                                        <i class="far fa-trash-alt"></i></a>
                                                    {!! Form::open(['method' => 'DELETE', 'route' => ['permissions.destroy', $permission->id],'id'=>'delete-form-'.$permission->id]) !!}
                                                    {!! Form::close() !!}
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
            </div>
        </div>
    </div>
</div>
@endsection
