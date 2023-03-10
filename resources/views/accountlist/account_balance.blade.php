@extends('layouts.dashboard')
@section('page-title')
    {{__('Account')}}
@endsection
@section('content')
<div class="row mt-4">
    <div class="col-12">
        <div class="page-title-box-hori">
            <h4 class="page-title">{{__('Manage Account Balances')}}</h4>
            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item"><a href="{{__('home')}}">{{__('Dashboard')}}</a></li>
                    <li class="breadcrumb-item active">{{__('List All Account Balances')}}</li>
                </ol>
            </div>
        </div>
    </div>
</div>
<hr class="mt-0 mb-2">


<div class="row">
    <div class="col-md-12">
        <div class="card">
            <!-- <div class="card-header">
                <div class="d-flex justify-content-between w-100">
                    <h4>{{--__('List All  Account Balances')--}}</h4>
                </div>
            </div> -->
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped mb-0" id="dataTable">
                        <thead>
                        <tr>
                            <th>{{__('Account Name')}}</th>
                            <th>{{__('Initial Balance')}}</th>
                        </tr>
                        </thead>
                        <tbody class="font-style">
                        @php $totalInitialBalance = 0; @endphp
                        @foreach ($accountLists as $accountlist)
                            @php
                                $totalInitialBalance = $accountlist->initial_balance + $totalInitialBalance;
                            @endphp
                            <tr>
                                <td>{{ $accountlist->account_name }}</td>
                                <td>{{  \Auth::user()->priceFormat($accountlist->initial_balance) }}</td>
                            </tr>
                        @endforeach
                            <tr>
                                <td class="text-left text-dark">{{__('Total')}}</td>
                                <td>{{ \Auth::user()->priceFormat($totalInitialBalance)   }}</td>
                            </tr>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
