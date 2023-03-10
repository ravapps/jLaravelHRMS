{{Form::open(array('url'=>'responsbilites/import','method'=>'post','enctype'=>'multipart/form-data'))}}
   @csrf
  <div class="card-body p-0">
      <div class="row">
          <div class="col-md-12">


              <div class="form-group">
                {{ Form::label('department_id', __('Department')) }}
                {{ Form::select('department_id', $departments,null, array('class' => 'form-control select2','required'=>'required')) }}
              </div>
              <div class="form-group">


                <label for="department_id">Upload Responsbilites Excel</label>
                <input type="file" name="csvfile" value=""  required class="form-control">
                <a href="{{asset('public/uploads/samplecsv.csv')}}" class="w-100 mt-2"><small>Download sample excel file</small></a>

              </div>

          </div>
      </div>
  </div>
  <div class="modal-footer pr-0">
      <button type="button" class="btn dark btn-outline" data-dismiss="modal">{{__('Cancel')}}</button>
      <input type="hidden" name="formsubmit" value="yes">
      {{Form::submit(__('Save'),array('class'=>'btn btn-success'))}}
  </div>
{{Form::close()}}
