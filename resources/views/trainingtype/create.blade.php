{{Form::open(array('url'=>'trainingtype','method'=>'post'))}}
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
                <input type="text" name="description" class="form-control" value="" required>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <select name="status" required class="form-control">
                    <option value="">Select status</option>
                    <option value="Active">Active</option>
                    <option value="In-Active">In-Active</option>
                </select>
            </div>
        </div>
       
    </div>


</div>
<div class="modal-footer pr-0">
    <button type="button" class="btn dark btn-outline" data-dismiss="modal">{{__('Cancel')}}</button>
    {{Form::submit(__('Create'),array('class'=>'btn btn-success'))}}
</div>
{{Form::close()}}
