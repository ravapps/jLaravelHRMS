<div class="row">
    <table class="table table-striped mb-0">
        <tr>
            <th>{{__('Employee')}}</th>
            <td>{{  !empty($payslip->employees)? \Auth::user()->employeeIdFormat( $payslip->employees->employee_id):''}}</td>
            <td>&nbsp;</td>
        </tr>
        <tr>
            <th>{{__('Basic Salary')}}</th>
            <td>{{  \Auth::user()->priceFormat( $payslip->basic_salary)}}</td>
            <td>&nbsp;</td>
        </tr>
        <tr>
            <th>{{__('Payroll Month')}}</th>
            <td>{{ \Auth::user()->dateFormat( $payslip->salary_month)}}</td>
            <td>&nbsp;</td>
        </tr>
    </table>
</div>
{{Form::open(array('route'=>array('payslip.updateemployee',$payslip->employee_id),'method'=>'post'))}}
{!! Form::hidden('payslip_id', $payslip->id, ['class' => 'form-control']) !!}
<div class="row mt-4">
    <div class="col-12 col-sm-12 col-md-4">
        <ul class="nav nav-pills flex-column" id="myTab4" role="tablist">
            <li class="nav-item">
                <a class="nav-link active show" id="home-tab4" data-toggle="tab" href="#allowance" role="tab" aria-controls="home" aria-selected="true">{{__('Allowance')}}</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="profile-tab4" data-toggle="tab" href="#commission" role="tab" aria-controls="profile" aria-selected="false">{{__('Commission')}}</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="contact-tab4" data-toggle="tab" href="#loan" role="tab" aria-controls="contact" aria-selected="false">{{__('Loan')}}</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="contact-tab4" data-toggle="tab" href="#deduction" role="tab" aria-controls="contact" aria-selected="false">{{__('Saturation Deduction')}}</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="contact-tab4" data-toggle="tab" href="#payment" role="tab" aria-controls="contact" aria-selected="false">{{__('Other Payment')}}</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="contact-tab4" data-toggle="tab" href="#overtime" role="tab" aria-controls="contact" aria-selected="false">{{__('Overtime')}}</a>
            </li>
        </ul>
    </div>

    <div class="col-12 col-sm-12 col-md-8">
        <div class="tab-content no-padding" id="myTab2Content">
            <div class="tab-pane fade active show" id="allowance" role="tabpanel" aria-labelledby="home-tab4">
                @php
                    $allowances = json_decode($payslip->allowance);
                @endphp
                @foreach($allowances as $allownace)
                    <div class="col-md-12 form-group">
                        {!! Form::label('title', $allownace->title) !!}
                        {!! Form::text('allowance[]', $allownace->amount, ['class' => 'form-control']) !!}
                        {!! Form::hidden('allowance_id[]', $allownace->id, ['class' => 'form-control']) !!}
                    </div>
                @endforeach
            </div>
            <div class="tab-pane fade" id="commission" role="tabpanel" aria-labelledby="home-tab4">
                @php
                    $commissions = json_decode($payslip->commission);
                @endphp
                @foreach($commissions as $commission)
                    <div class="col-md-12 form-group">
                        {!! Form::label('title', $commission->title) !!}
                        {!! Form::text('commission[]', $commission->amount, ['class' => 'form-control']) !!}
                        {!! Form::hidden('commission_id[]', $commission->id, ['class' => 'form-control']) !!}
                    </div>
                @endforeach

            </div>
            <div class="tab-pane fade" id="loan" role="tabpanel" aria-labelledby="home-tab4">
                @php
                    $loans = json_decode($payslip->loan);
                @endphp
                @foreach($loans as $loan)
                    <div class="col-md-12 form-group">
                        {!! Form::label('title', $loan->title) !!}
                        {!! Form::text('loan[]', $loan->amount, ['class' => 'form-control']) !!}
                        {!! Form::hidden('loan_id[]', $loan->id, ['class' => 'form-control']) !!}
                    </div>
                @endforeach

            </div>
            <div class="tab-pane fade" id="deduction" role="tabpanel" aria-labelledby="home-tab4">
                @php
                    $saturation_deductions = json_decode($payslip->saturation_deduction);
                @endphp
                @foreach($saturation_deductions as $deduction)
                    <div class="col-md-12 form-group">
                        {!! Form::label('title', $deduction->title) !!}
                        {!! Form::text('saturation_deductions[]', $deduction->amount, ['class' => 'form-control']) !!}
                        {!! Form::hidden('saturation_deductions_id[]', $deduction->id, ['class' => 'form-control']) !!}
                    </div>
                @endforeach

            </div>
            <div class="tab-pane fade" id="payment" role="tabpanel" aria-labelledby="home-tab4">
                @php
                    $other_payments = json_decode($payslip->other_payment);
                @endphp
                @foreach($other_payments as $payment)
                    <div class="col-md-12 form-group">
                        {!! Form::label('title', $payment->title) !!}
                        {!! Form::text('other_payment[]', $payment->amount, ['class' => 'form-control']) !!}
                        {!! Form::hidden('other_payment_id[]', $payment->id, ['class' => 'form-control']) !!}
                    </div>
                @endforeach
            </div>
            <div class="tab-pane fade" id="overtime" role="tabpanel" aria-labelledby="home-tab4">
                @php
                    $overtimes = json_decode($payslip->overtime);
                @endphp
                @foreach($overtimes as $overtime)
                    <div class="row">
                        <div class="col-md-6 form-group">
                            {!! Form::label('rate', $overtime->title.' '.__('Rate')) !!}
                            {!! Form::text('rate[]', $overtime->rate, ['class' => 'form-control']) !!}
                            {!! Form::hidden('rate_id[]', $overtime->id, ['class' => 'form-control']) !!}
                        </div>
                        <div class="col-md-6 form-group">
                            {!! Form::label('hours',$overtime->title.' '.__('Hours')) !!}
                            {!! Form::text('hours[]', $overtime->rate, ['class' => 'form-control']) !!}
                        </div>
                    </div>
                @endforeach

            </div>
        </div>
    </div>
</div>
<div class="col-12 mt-4 text-right">
    <button type="button" class="btn dark btn-outline" data-dismiss="modal">{{__('Cancel')}}</button>
    {{Form::submit(__('Update'),array('class'=>'btn btn-success'))}}
</div>
{{Form::close()}}


