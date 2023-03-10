{{Form::model($jbr,array('route' => array('responsbilites.update', $jbr->id), 'method' => 'PUT')) }}


   @csrf
  <div class="card-body p-0">
      <div class="row">
          <div class="col-md-12">
              <div class="form-group">
                {{ Form::label('department_id', __('Department')) }}
                {{ Form::select('department_id', $departments,$jbr->designation_id, array('class' => 'form-control select2','required'=>'required')) }}
              </div>
              <div class="form-group">

                {{Form::label('Responsbilites Name',__('Responsbilites Name'))}}
                {{Form::text('res_name',null,array('class'=>'form-control','placeholder'=>__('Enter Responsbilites')))}}
                @error('name')

                <span class="invalid-name" role="alert">
                    <strong class="text-danger">{{ $message }}</strong>
                </span>
                @enderror


              </div>

          </div>
      </div>
  </div>
  <div class="modal-footer pr-0">
      <button type="button" class="btn dark btn-outline" data-dismiss="modal">{{__('Cancel')}}</button>
      <input type="hidden" name="id" value="{{$jbr->id}}">
      {{Form::submit(__('Update'),array('class'=>'btn btn-success'))}}
  </div>
{{Form::close()}}
