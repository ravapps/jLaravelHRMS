@extends('layouts.dashboard')
@section('page-title')
    {{__('Salary Details')}}
@endsection
@section('content')
<div class="row mt-4">
    <div class="col-12">
        <div class="page-title-box-hori">
            <h4 class="page-title">{{__('Employee CPF')}}</h4>
            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                  <li class="breadcrumb-item"><a href="{{__('home')}}">{{__('Dashboard')}}</a></li>
                  <li class="breadcrumb-item active">{{__('CPF')}}</li>
                </ol>
            </div>
        </div>
    </div>
</div>
<hr class="mt-0">


<div class="row">
    <div class="col-12">
        <div class="card">
          
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped mb-0" id="dataTable">

                        <thead>

                        @if(!empty($final_calculation1))
                            @foreach($final_calculation1 as $row)
                            <tr>
                                <th>{{__('Employee')}}: {{$row['name']}}</th>
                                <th>{{__('Gross Salary')}}: {{$row['gross_salary']}}</th>
                                <th>{{__('Salary Type')}}: {{$row['salary_type']}}</th>
                                <th>{{__('Employee CPF') }}: -{{$row['get_cpf_percentage']}}</th>
                                <th>{{__('Employer CPF') }}: +{{$row['get_cpf_percentage1']}}</th>
                                <th>{{__('Donation Type') }}: {{$row['donation_type']}}</th>
                                <th>{{__('Donation Amount') }}: - @if(!empty($row['gross_salary'])) {{$row['donation_amount']}} @endif</th>
                                <th>{{__('Allowance Amount') }}: +@if(!empty($row['gross_salary'])) {{$row['allnc_cost']}} @endif</th>
                                <th>{{__('Commission Amount') }}: +{{$row['commission_cost']}}</th>
                                <th>{{__('Bonus Amount') }}: +@if(!empty($row['gross_salary'])) {{$row['bonus_cost']}} @endif</th>
                                <th>{{__('Overtime Amount') }}: +@if(!empty($row['gross_salary'])) {{$row['get_overtime_cost']}} @endif</th>
                                <th>{{__('Total') }}: @if(!empty($row['gross_salary'])) {{$row['total_salary']}} @endif</th>
                            </tr>
                            @endforeach
                        @endif
                        </thead>


                    </table>
                </div>
            </div>

        </div>
    </div>
</div>












    <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">

      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">

          <h4 class="modal-title">Set Salary</h4>
        </div>
        <div class="modal-body">
        @php $data_range=range(1,31);@endphp
        @if(empty($emp_set_date))

            <form action="{{url('set_salary_date')}}" method="post">
            @csrf
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label>From</label><span class="text-danger pl-1">*</span>
                        <select name="from_d" required class="form-control" id="from_d">
                        <option value="">Select From</option>
                        @foreach($data_range as $row)
                            <option value="{{$row}}">{{$row}}</option>
                        @endforeach
                    </select>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>To</label><span class="text-danger pl-1">*</span>
                        <select name="to_d" required class="form-control" id="to_d">
                        <option value="">Select To</option>
                        @foreach($data_range as $row)
                            <option value="{{$row}}">{{$row}}</option>
                        @endforeach
                    </select>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                         <button type="submit" class="btn btn-success" >{{__('Save')}}</button>
                    </div>
                </div>

            </div>
            <form>

            @else
            <form action="{{url('set_salary_date')}}" method="post">
            @csrf
            <input type="hidden" name="set_salry_d" value="{{$emp_set_date->id}}">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label>From</label><span class="text-danger pl-1">*</span>
                        <select name="from_d" required class="form-control" id="from_d">
                        <option value="">Select From</option>
                        @foreach($data_range as $row)
                            <option value="{{$row}}" @if($emp_set_date->from_d==$row) selected="selected" @endif>{{$row}}</option>
                        @endforeach
                    </select>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>To</label><span class="text-danger pl-1">*</span>
                        <select name="to_d" required class="form-control" id="to_d">
                        <option value="">Select To</option>
                        @foreach($data_range as $row)
                            <option value="{{$row}}" @if($emp_set_date->to_d==$row) selected="selected" @endif>{{$row}}</option>
                        @endforeach
                    </select>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                         <button type="submit" class="btn btn-success" >{{__('Save')}}</button>
                    </div>
                </div>

            </div>
            <form>


             @endif

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>

    </div>
  </div>



@endsection
