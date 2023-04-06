@extends('provider.layouts.master')

@section('content')
    <main id="main" class="main justify-content-center">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-12 col-lg-12">
                    @if (Session::has('message'))
                        <div class="alert alert-success" role="alert">
                            {{ Session('message') }}
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </main>

    <script>
        $("#table").DataTable();
    </script>


@endsection
