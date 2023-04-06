@extends('layouts.master')


@section('page_title')
    Load Transaction Module
@endsection

@section('header')
    <x-navbar></x-navbar>
    <x-sidebar></x-sidebar>
@endsection


@section('main')
    <div class="row justify-content-center">
        <div class="col-md-12 col-lg-12">
            @if (Session::has('message'))
                <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 3000)" class="alert alert-success" role="alert">
                    {{ Session('message') }}
                </div>
            @endif


            <div class="row">
                <div class="col-12 my-2">
                    <a  href="{{route('provider_ledger')}}" class="btn float-end btn-sm btn-dark">Back</a>
                </div>
            </div>

            <div class="alert alert-success" role="alert">
                <div class="d-flex">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-exclamation-triangle-fill flex-shrink-0 me-2" viewBox="0 0 16 16" role="img" aria-label="Warning:">
                        <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
                    </svg>
                    <h4 class="alert-heading">{{'Loaded Successfully'}}</h4>
                </div>
                <p class="mt-3">
                    <small>Wifi Password</small>
                <h1 style="font-size: 60px">{{$access_code->voucher_code}}</h1>
                </p>
                <hr>
                <p class="mb-0">
                    <small>Reference #</small>
                <h5>{{$wallet_transaction->trans_reference}}</h5>
                </p>
            </div>
        </div>
    </div>
@endsection


@section('script')

@endsection



