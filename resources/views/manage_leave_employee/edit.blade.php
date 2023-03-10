{{Form::model($employees_edit,array('route' => array('manage_leave_employee.update', $employees_edit->id), 'method' => 'PUT')) }}


<input type="hidden" name="employee_ids" id="employee_ids" value="{{$employees_edit->employee_id}}">
<input type="hidden" name="leave_ids" id="leave_ids" value="{{$employees_edit->id}}">
<div class="card-body p-0">
    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                <select name="leave_type_id" required class="form-control" id="leave_type_id" required>
                <option value="">Select Leave Type</option>
                @if($leave_type)
                @foreach($leave_type as $leave_types)
                <option value="{{$leave_types->id}}" <?php if($employees_edit->leave_type_id==$leave_types->id) echo "selected='selected'";?>>{{$leave_types->title}}</option>
                @endforeach
                @endif

                </select>
                @error('leave_type_id')
                <span class="invalid-name" role="alert">
                    <strong class="text-danger">{{ $message }}</strong>
                </span>
                @enderror
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
            <label>Number of days</label><span class="text-danger pl-1">*</span>
                                                <input type="text" name="total_leaves" value="{{$employees_edit->total_leaves}}" class="form-control" required>
            </div>
        </div>
    </div>

</div>
<div class="modal-footer pr-0">
    <button type="button" class="btn dark btn-outline" data-dismiss="modal">{{__('Cancel')}}</button>
    {{Form::submit(__('Create'),array('class'=>'btn btn-success'))}}
</div>
{{Form::close()}}



