@extends('layouts.dashboard')
@section('page-title')
    {{__('Account Statement')}}
@endsection
@push('script-page')
    <script type="text/javascript" src="{{ asset('js/html2pdf.bundle.min.js') }}"></script>
    <script>

        var filename = $('#filename').val();

        function saveAsPDF() {
            var element = document.getElementById('printableArea');
            var opt = {
                margin: 0.3,
                filename: filename,
                image: {type: 'jpeg', quality: 1},
                html2canvas: {scale: 4, dpi: 72, letterRendering: true},
                jsPDF: {unit: 'in', format: 'A4'}
            };
            html2pdf().set(opt).from(element).save();

        }


        $(document).ready(function () {
            var filename = $('#filename').val();
            $('#report-dataTable').DataTable({
                dom: 'lBfrtip',
                buttons: [
                    {
                        extend: 'excel',
                        title: filename
                    },
                    {
                        extend: 'pdf',
                        title: filename
                    }, {
                        extend: 'print',
                        title: filename
                    }, {
                        extend: 'csv',
                        title: filename
                    }
                ]
            });
        });


    </script>
@endpush
@section('content')

<div class="row mt-4">
    <div class="col-12">
        <div class="page-title-box-hori">
            <h4 class="page-title">{{__('Manage Account Statement')}}</h4>
            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                  <li class="breadcrumb-item"><a href="{{__('home')}}">{{__('Dashboard')}}</a></li>
                  <li class="breadcrumb-item"><a href="{{route('employee.index')}}">{{__('Promotion')}}</a></li>
                  <li class="breadcrumb-item active">{{__('Account Statement')}}</li>
                </ol>
            </div>
        </div>
    </div>
</div>
<hr class="mt-0">


<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                {{ Form::open(array('route' => array('report.account.statement'),'method'=>'get')) }}
                <div class="row">
                    <div class="col">
                        {{Form::label('start_month',__('Start Month'))}}
                        {{Form::month('start_month',isset($_GET['start_month'])?$_GET['start_month']:'',array('class'=>'form-control'))}}
                    </div>
                    <div class="col">
                        {{Form::label('end_month',__('End Month'))}}
                        {{Form::month('end_month',isset($_GET['end_month'])?$_GET['end_month']:'',array('class'=>'form-control'))}}
                    </div>
                    <div class="col">
                        {{ Form::label('account', __('Account')) }}
                        {{ Form::select('account', $accountList,isset($_GET['account'])?$_GET['account']:'', array('class' => 'form-control select2')) }}
                    </div>
                    <div class="col">

                        {{ Form::label('type', __('Type')) }}
                        <select class="form-control select2" id="type" name="type">
                            <option value="income" {{(isset($_GET['account']) && $_GET['type']=='income')?'selected':''}}>{{__('Income')}}</option>
                            <option value="expense" {{(isset($_GET['account']) && $_GET['type']=='expense')?'selected':''}}>{{__('Expense')}}</option>
                        </select>
                    </div>

                    <div class="col-auto apply-btn">
                        <label class="w-100">&nbsp;</label>
                        {{Form::submit(__('Apply'),array('class'=>'btn btn-success '))}}
                        <a href="{{route('report.account.statement')}}" class="btn btn-danger ">{{__('Reset')}}</a>
                        <a href="#" class="btn btn-warning" onclick="saveAsPDF()" id="">{{__('Download')}}</a>
                    </div>
                </div>
                {{ Form::close() }}
            </div>
        </div>
    </div>
</div>
<div id="printableArea">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
              <div class="card-body">
                  <input type="hidden" value="{{__('Account Statement').' '. $filterYear['type'].' '.'Report of'.' '.$filterYear['startDateRange'].' to '.$filterYear['endDateRange']}}" id="filename">

                  <div class="row">
                      <div class="col">
                          <h5>{{__('Report')}} : {{__('Account Statement Summary')}}</h5>
                      </div>

                      @if($filterYear['type']!='All')
                          <div class="col">
                              <h5>{{__('Transaction Type')}} : {{$filterYear['type'] }}</h5>
                          </div>
                      @endif
                      <div class="col">
                          <h5>{{__('Duration')}} : {{$filterYear['startDateRange'].' to '.$filterYear['endDateRange']}}</h5>
                      </div>

                  </div>
              </div>
            </div>
        </div>
    </div>
    <div class="row">
        @foreach($accounts as $account)
            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                <div class="card">
                  <div class="card-header">
                      <h4>{{$account->account_name}}</h4>
                  </div>
                  <div class="card-body">
                    <div class="progreess-status">
                        <h5>
                            @if(isset($_GET['type']) && $_GET['type'] =='expense')
                                {{__('Total Debit')}} :
                            @else
                                {{__('Total Credit')}} :
                            @endif
                            <strong>{{\Auth::user()->priceFormat($account->total)}} </strong>
                        </h5>
                    </div>
                  </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
<div class="row">
    <div class="col">
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped mb-0" id="report-dataTable">
                        <thead class="thead-light">
                        <tr>
                            <th>{{__('Account')}}</th>
                            <th>{{__('Date')}}</th>
                            <th>{{__('Amount')}}</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($accountData as $account)
                            <tr>
                                <td>{{!empty($account->accounts)?$account->accounts->account_name:''}}</td>
                                <td>{{\Auth::user()->dateFormat($account->date)}}</td>
                                <td>{{\Auth::user()->priceFormat($account->amount)}}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
