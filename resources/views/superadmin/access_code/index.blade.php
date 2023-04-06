
@extends('layouts.master')


@section('page_title')
    Import Access Code
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
                <div class="card-header">{{ __('File to import') }}</div>

                <div class="card-body">
                    <form action="{{route('superadmin_access_codes.store')}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-12 my-2">
                                <label for="" class="text-muted my-2">Browse your computer</label>
                                <input id="inputView" onchange="readCSVFile()" type="file" accept=".csv, application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel" class="form-control @error('csv') is-invalid @enderror form-control-sm" name="csv" />
                                @error('csv')
                                    <span class="invalid-feedback">
                                        {{$message}}
                                    </span>
                                @enderror
                            </div>
                            <div class="col-12 my-2">
                                <label for="" class="text-muted my-2">Wifi Site</label>
                                <select class="form-select @error('wifi_site_id') is-invalid @enderror form-control" name="wifi_site_id" id="">
                                    <option value="" disabled selected>Choose wifi site</option>
                                    @foreach($wifi_sites as $site)
                                        <option value="{{$site->id}}">{{ucwords($site->site_name)}}</option>
                                    @endforeach
                                </select>
                                @error('wifi_site_id')
                                    <span class="invalid-feedback">
                                        {{$message}}
                                    </span>
                                @enderror
                            </div>
                            <div class="col-12 my-2">
                                <button type="submit" class="btn btn-primary btn-sm">Upload <i class="bi bi-upload"></i></button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

{{--            <div class="col-12">--}}
{{--                <div class="">--}}
{{--                    <table class="" id="view" style="overflow-x: scroll">--}}
{{--                        <tbody >--}}
{{--                        </tbody>--}}
{{--                    </table>--}}
{{--                </div>--}}
{{--            </div>--}}
        </div>
    </div>
@endsection


@section('script')
{{--    <script>--}}
{{--        function readCSVFile(){--}}
{{--            var files = document.querySelector('#inputView').files;--}}

{{--            if(files.length > 0 ){--}}
{{--                var file = files[0];--}}
{{--                var reader = new FileReader();--}}
{{--                reader.readAsText(file);--}}
{{--                reader.onload = function(event) {--}}
{{--                    var csvdata = event.target.result;--}}
{{--                    var rowData = csvdata.split('\n');--}}
{{--                    var tbodyEl = document.getElementById('view').getElementsByTagName('tbody')[0];--}}
{{--                    tbodyEl.innerHTML = "";--}}
{{--                    for (var row = 0; row < rowData.length; row++) {--}}
{{--                        var newRow = tbodyEl.insertRow();--}}
{{--                        rowColData = rowData[row].split(',');--}}
{{--                        for (var col = 0; col < rowColData.length; col++) {--}}
{{--                            var newCell = newRow.insertCell();--}}
{{--                            newCell.innerHTML = rowColData[col];--}}
{{--                        }--}}
{{--                    }--}}
{{--                };--}}
{{--            }--}}

{{--        }--}}
{{--    </script>--}}
@endsection




