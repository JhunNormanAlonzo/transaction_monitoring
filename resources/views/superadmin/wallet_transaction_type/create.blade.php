
@extends('layouts.master')


@section('page_title')
    Wallet Transaction Type Module
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
            <div class="card">
                <div class="card-header">{{ __('Wallet Transaction') }}</div>

                <div class="card-body">
                    <form action="{{route('superadmin_transaction_types.store')}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-12 col-lg-6">
                                <div class="mb-3">
                                    <label for="">Transaction Description </label>
                                    <input  id="trans_description" name="trans_description" type="text"   class="form-control-sm form-control @error('trans_description') is-invalid @enderror">

                                    @error('trans_description')
                                    <span class="invalid-feedback">
                                                {{$message}}
                                            </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-12 col-lg-6">
                                <div class="mb-3">
                                    <label for="">Transaction Type</label>
                                    <select name="trans_type"  id=""  class="form-control-sm form-control @error('trans_type') is-invalid @enderror">
                                        <option value="" selected disabled>Choose Type...</option>
                                        <option value="DEBIT">DEBIT</option>
                                        <option value="CREDIT">CREDIT</option>
                                    </select>
                                    @error('trans_type')
                                    <span class="invalid-feedback">
                                                {{$message}}
                                            </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-12 col-lg-4">
                                <div class="mb-3">
                                    <label for="">Approval</label>
                                    <select name="approval"  id="" class="form-control-sm form-control @error('approval') is-invalid @enderror">
                                        <option value="" selected disabled>Choose...</option>
                                        <option value="1">YES</option>
                                        <option value="0">NO</option>
                                    </select>
                                    @error('approval')
                                    <span class="invalid-feedback">
                                                {{$message}}
                                            </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-12 col-lg-4">
                                <div class="mb-3">
                                    <label for="">E-Wallet Transaction</label>
                                    <select name="ewalletrans"  id="" class="form-control-sm form-control @error('ewalletrans') is-invalid @enderror">
                                        <option value="" selected disabled>Choose...</option>
                                        <option value="1">YES</option>
                                        <option value="0">NO</option>
                                    </select>
                                    @error('ewalletrans')
                                    <span class="invalid-feedback">
                                                {{$message}}
                                            </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-12 col-lg-4">
                                <div class="mb-3">
                                    <label for="">Provider Tag</label>
                                    <select name="providertag"  id="" class="form-control-sm form-control @error('providertag') is-invalid @enderror">
                                        <option value="" selected disabled>Choose...</option>
                                        <option value="1">YES</option>
                                        <option value="0">NO</option>
                                    </select>
                                    @error('providertag')
                                    <span class="invalid-feedback">
                                                {{$message}}
                                            </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-12">
                                <div class="mb-3">
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                    <a href="{{route('superadmin_transaction_types.index')}}" class="float-end">Back</a>
                                </div>
                            </div>

                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection


@section('script')

@endsection


