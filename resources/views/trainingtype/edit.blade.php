{{Form::model($trainingType,array('route' => array('trainingtype.update', $trainingType->id), 'method' => 'PUT')) }}
<div class="card-body p-0">
    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                {{Form::label('name',__('Name'))}}
                {{Form::text('name',null,array('class'=>'form-control'))}}
            </div>
        </div>
    </div>
    <div class="row">
        
        <div class="col-md-12">
            <div class="form-group">
                <label>Descrption</label>
                <input type="text" name="description" class="form-control" value="{{$trainingType->description}}" required>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <select name="status" required class="form-control">
                    <option value="">Select status</option>
                    <option value="Active" @if($trainingType->status=="Active") selected='selected' @endif>Active</option>
                    <option value="In-Active" @if($trainingType->status=="In-Active") selected='selected' @endif>In-Active</option>
                </select>
            </div>
        </div>
       
    </div>

</div>
<div class="modal-footer pr-0">
    <button type="button" class="btn dark btn-outline" data-dismiss="modal">{{__('Cancel')}}</button>
    {{Form::submit(__('Update'),array('class'=>'btn btn-success'))}}
</div>
{{Form::close()}}

