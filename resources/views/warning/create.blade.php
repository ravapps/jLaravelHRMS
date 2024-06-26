{{Form::open(array('url'=>'warning','method'=>'post'))}}
<div class="card-body p-0">
    <div class="row">
        @if(\Auth::user()->type != 'employee')
            <div class="form-group col-md-6 col-lg-6">
                {{ Form::label('warning_by', __('Warning By')) }}
                {{ Form::select('warning_by', $employees,null, array('class' => 'form-control select2','required'=>'required')) }}
            </div>
        @endif
        <div class="form-group col-md-6 col-lg-6">
            {{Form::label('warning_to',__('Warning To'))}}
            {{Form::select('warning_to',$employees,null,array('class'=>'form-control select2'))}}
        </div>
        <div class="form-group col-md-6 col-lg-6">
            {{Form::label('subject',__('Subject'))}}
            {{Form::text('subject',null,array('class'=>'form-control'))}}
        </div>
        <div class="form-group col-md-6 col-lg-6">
            {{Form::label('warning_date',__('Warning Date'))}}
            {{Form::text('warning_date',null,array('class'=>'form-control datepicker'))}}
        </div>
        <div class="form-group col-md-12">
            {{Form::label('description',__('Description'))}}
            {{Form::textarea('description',null,array('class'=>'form-control','placeholder'=>__('Enter Description')))}}
        </div>
    </div>
</div>
<div class="modal-footer pr-0">
    <button type="button" class="btn dark btn-outline" data-dismiss="modal">{{__('Cancel')}}</button>
    {{Form::submit(__('Create'),array('class'=>'btn btn-success'))}}
</div>
{{Form::close()}}
