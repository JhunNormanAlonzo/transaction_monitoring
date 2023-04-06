@extends('layouts.master')


@section('page_title')
    Access Provider Module
@endsection

@section('header')
    <x-navbar></x-navbar>
    <x-sidebar></x-sidebar>
@endsection


@section('main')
    <div class="row">
        <div class="col-lg-8 offset-md-2 ">
            @if (Session::has('message'))
                <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 3000)" class="alert alert-success" role="alert">
                    {{ Session('message') }}
                </div>
            @endif
            <form action="{{route('superadmin_access_providers.update', [$access_provider->id])}}" method="POST">
                @csrf
                @method('PATCH')
                <div class="card mt-3">
                    <div class="card-header">
                        Update Access Provider
                    </div>

                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-4">
                                <label for="firstname" class=" col-form-label text-md-end">{{ __('First Name') }}</label>

                                <input id="firstname" type="text" class="form-control form-control-sm  @error('firstname') is-invalid @enderror" name="firstname" value="{{ $user->firstname }}" required autocomplete="firstname" autofocus>

                                @error('firstname')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>



                            <div class="col-md-4">
                                <label for="middlename" class="col-form-label text-md-end">{{ __('Middle Name') }}</label>
                                <input id="middlename" type="text" class="form-control form-control-sm  @error('middlename') is-invalid @enderror" name="middlename" value="{{ $user->middlename  }}" required autocomplete="middlename" >

                                @error('middlename')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>




                            <div class="col-md-4">
                                <label for="lastname" class=" col-form-label text-md-end">{{ __('Last Name') }}</label>
                                <input id="lastname" type="text" class="form-control form-control-sm  @error('lastname') is-invalid @enderror" name="lastname" value="{{ $user->lastname }}" required autocomplete="lastname" >

                                @error('lastname')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>





                            <div class="col-lg-12 col-sm-12">
                                <div class="mb-3">
                                    <label for="">Account Name</label>
                                    <input type="text" name="account_name" value="{{ $access_provider->account_name }}" class="form-control form-control-sm  @error('account_name') is-invalid @enderror" >
                                    @error('account_name')
                                    <span class="invalid-feedback">
                                        {{$message}}
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-12 col-sm-12">
                                <div class="mb-3">
                                    <label for="">Account Address</label>
                                    <textarea name="account_address" id="" class="form-control form-control-sm  @error('account_address') is-invalid @enderror" rows="2">{{ $access_provider->account_address  }}</textarea>
                                    @error('account_address')
                                    <span class="invalid-feedback">
                                        {{$message}}
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-4 col-sm-12">
                                <div class="mb-3">
                                    <label for="">Phone Number</label>
                                    <input type="number" name="phone_number" value="{{ $access_provider->phone_number }}" class="form-control form-control-sm  @error('phone_number') is-invalid @enderror" >
                                    @error('phone_number')
                                    <span class="invalid-feedback">
                                        {{$message}}
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-4 col-sm-12">
                                <div class="mb-3">
                                    <label for="">Provider Type</label>
                                    <select name="provider_type" id="" class="form-control form-control-sm  @error('provider_type') is-invalid @enderror">
                                        <option value="">Choose provider...</option>
                                        @foreach(\App\Models\ProviderType::all() as $provider)
                                            <option @if($access_provider->id == $provider->id) selected @endif value="{{$provider->id}}">{{ucwords($provider->type_description)}}</option>
                                        @endforeach

                                    </select>

                                    @error('provider_type')
                                    <span class="invalid-feedback">
                                        {{$message}}
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-4 col-sm-12">
                                <div class="mb-3">
                                    <label for="">Date Started</label>
                                    <input type="date" name="date_started" id="date_started" value="{{ $access_provider->date_started }}" class="form-control form-control-sm  @error('date_started') is-invalid @enderror" >
                                    @error('date_started')
                                    <span class="invalid-feedback">
                                        {{$message}}
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-6 col-sm-12">
                                <div class="mb-3">
                                    <label for="">Map Location</label>
                                    <input type="text" name="map_location" value="{{ $access_provider->map_location }}" class="form-control form-control-sm  @error('map_location') is-invalid @enderror" >
                                    @error('map_location')
                                    <span class="invalid-feedback">
                                        {{$message}}
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-lg-6 col-sm-12">
                                <div class="mb-3">
                                    <label for="">Wifi Site</label>

                                    <select name="wifi_site_id" id="" class="form-control form-control-sm @error('wifi_site_id') is-invalid @enderror">
                                        <option value="">Choose Site</option>
                                        @foreach($wifi_sites as $wifi_site)
                                            <option @if($access_provider->wifi_site_id == $wifi_site->id) selected @endif value="{{$wifi_site->id}}">{{$wifi_site->site_name}}</option>
                                        @endforeach
                                    </select>
                                    @error('wifi_site_id')
                                    <span class="invalid-feedback">
                                        {{$message}}
                                    </span>
                                    @enderror
                                </div>
                            </div>


                            <div class="col-12 mx-3 card card-body border shadow-lg">
                                <div class="row ">
                                    <div class="col-12 mt-3 px-2">
                                        <h5 class="text-muted fw-bolder ">Login info</h5>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="email" class="col-form-label text-md-end">{{ __('Email Address') }}</label>
                                        <input id="email" type="email" class="form-control form-control-sm  @error('email') is-invalid @enderror" name="email" value="{{ $user->email }}" required autocomplete="email">

                                        @error('email')
                                        <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>




                                    <div class="col-md-6">
                                        <label for="password" class="col-form-label text-md-end">{{ __('Password') }}</label>
                                        <small style="font-size: 12px;" class="text-danger">leave empty if no changes</small>
                                        <input id="password" type="password" class="form-control form-control-sm  @error('password') is-invalid @enderror" name="password" autocomplete="new-password">

                                        @error('password')
                                        <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                </div>
                            </div>


                            <div class="col-lg-12 col-sm-12">
                                <div class="mb-3">
                                    <button type="submit" class="btn btn-primary">Update</button>
                                    <a href="{{route('superadmin_access_providers.index')}}" class="float-end">Back</a>
                                </div>
                            </div>


                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection


@section('script')
    <script>
        document.getElementById('date_started').flatpickr();
    </script>
@endsection



