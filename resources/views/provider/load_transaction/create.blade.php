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

            @if (Session::has('warning'))
                <div class="alert alert-warning" role="alert">
                    {{ Session('warning') }}
                </div>
            @endif


            <div class="card">
                <div class="card-header">{{ __('E-Load Transaction') }}</div>

                <div class="card-body">
                    <form action="{{route('provider_load_transactions.store')}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-12 col-lg-4">
                                <div class="mb-3">
                                    <label for="">Transaction Type</label>
                                    <select  name="wallet_transaction_type_id" id="wallet_transaction_type_id" class="form-control form-control-sm @error('wallet_transaction_type_id') is-invalid @enderror">
                                        <option value="">Choose transaction...</option>
                                        @foreach($wallet_transaction_types as $wallet_transaction_type)
                                            <option value="{{$wallet_transaction_type->id}}" @if($wallet_transaction_type->trans_description == 'E-LOAD') selected @endif @if(old('wallet_transaction_type_id') == $wallet_transaction_type->id) selected @endif>{{ucwords($wallet_transaction_type->trans_description)}}</option>
                                        @endforeach
                                    </select>

                                    @error('wallet_transaction_type_id')
                                    <span class="invalid-feedback">
                                            {{$message}}
                                            </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-12 col-lg-4">
                                <div class="mb-3">
                                    <label for="">Load Type</label>
                                    <select  name="load_type_id" id="load_type_id" class="form-control form-control-sm @error('load_type_id') is-invalid @enderror">
                                        <option value="">Choose transaction...</option>
                                        @foreach($load_types as $load_type)
                                            <option value="{{$load_type->id}}" @if(old('load_type_id') == $load_type->id) selected @endif>{{ucwords($load_type->load_name)}}</option>
                                        @endforeach
                                    </select>

                                    @error('load_type_id')
                                    <span class="invalid-feedback">
                                            {{$message}}
                                            </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-12 col-lg-4">
                                <div class="mb-3">
                                    <label for="">Cellphone number </label>
                                    <input name="trans_cpnumber" id="trans_cpnumber" type="number" value="{{old('trans_cpnumber')}}" class="form-control-sm form-control @error('trans_cpnumber') is-invalid @enderror">

                                    @error('trans_cpnumber')
                                    <span class="invalid-feedback">
                                                {{$message}}
                                            </span>
                                    @enderror
                                </div>
                            </div>
                            <input name="created_user_id" type="text" hidden value="{{  auth()->user()->id }}">
                            <div class="col-12 col-lg-4">
                                <div class="mb-3">
                                    <button type="button" class="btn btn-primary" data-bs-target="#lookupmodal" data-bs-toggle="modal">Submit</button>
                                </div>
                            </div>

                            <div class="modal fade"  id="lookupmodal">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">
                                                Load Confirmation
                                            </h5>
                                        </div>
                                        <div class="modal-body">
                                            <div class="row">
                                                <div class="col-12">
                                                    <label class="mb-1" for="">Transaction</label>
                                                    <h6 class="fw-bold" id="wallet_transaction_type_id_view"></h6>
                                                    <hr>
                                                </div>
                                                <div class="col-12">
                                                    <label class="mb-1" for="">Load Type</label>
                                                    <h6 class="fw-bold" id="load_type_id_view"></h6>
                                                    <hr>
                                                </div>
                                                <div class="col-12">
                                                    <label class="mb-1" for="">Mobile Number</label>
                                                    <h6 class="fw-bold" id="trans_cpnumber_view"></h6>
                                                </div>
                                                <div class="col-12">
                                                    <hr>
                                                    <b class="text-danger">Note * </b>
                                                    <small class="text-muted">Please check carefully as this transaction is not refundable! <i class="text-danger"> Click YES to proceed</i>.</small>
                                                </div>
                                                <div class="modal-footer">
                                                    <button class="btn btn-danger" data-bs-dismiss="modal" type="button">No</button>
                                                    <button class="btn btn-primary" type="submit">Yes</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection


@section('datatable')
    <script>
        $(document).ready(function (){
            var wallet_transaction_type_id = document.getElementById("wallet_transaction_type_id");
            var text = wallet_transaction_type_id.options[wallet_transaction_type_id.selectedIndex].text;
            document.getElementById("wallet_transaction_type_id_view").innerHTML = text;
            $("#wallet_transaction_type_id").on("change", function (){
                var wallet_transaction_type_id = document.getElementById("wallet_transaction_type_id");
                var text = wallet_transaction_type_id.options[wallet_transaction_type_id.selectedIndex].text;

                document.getElementById("wallet_transaction_type_id_view").innerHTML = text;
            });

            $("#load_type_id").on("change", function (){
                var load_type_id = document.getElementById("load_type_id");
                var text = load_type_id.options[load_type_id.selectedIndex].text;
                document.getElementById("load_type_id_view").innerHTML = text;
            });

            $("#trans_cpnumber").on("keydown", function (){
                var trans_cpnumber = document.getElementById("trans_cpnumber");
                var text = trans_cpnumber.value;

                document.getElementById("trans_cpnumber_view").innerHTML = text;
            });
        });

    </script>
@endsection





