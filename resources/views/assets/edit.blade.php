{{ Form::model($asset, array('route' => array('account-assets.update', $asset->id), 'method' => 'PUT')) }}
<div class="row">
    <div class="form-group col-md-6">
        {{ Form::label('name', __('Name')) }}
        {{ Form::text('name', null, array('class' => 'form-control','required'=>'required')) }}
    </div>
    <div class="form-group col-md-6">
        {{ Form::label('amount', __('Amount')) }}
        {{ Form::number('amount', null, array('class' => 'form-control','required'=>'required','step'=>'0.01')) }}
    </div>

    <div class="form-group  col-md-6">
        {{ Form::label('purchase_date', __('Purchase Date')) }}
        {{ Form::text('purchase_date',null, array('class' => 'form-control datepicker')) }}
    </div>
    <div class="form-group  col-md-6">
        {{ Form::label('supported_date', __('Support Until')) }}
        {{ Form::text('supported_date',null, array('class' => 'form-control datepicker')) }}
    </div>
    <div class="form-group  col-md-12">
        {{ Form::label('description', __('Description')) }}
        {{ Form::textarea('description', null, array('class' => 'form-control')) }}
    </div>
    <div class="col-md-12 text-right">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">{{__('Cancel')}}</button>
        {{Form::submit(__('Update'),array('class'=>'btn btn-success'))}}
    </div>
</div>
{{ Form::close() }}




