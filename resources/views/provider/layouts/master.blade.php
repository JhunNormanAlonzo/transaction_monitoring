<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>FiberGigaBandWifi</title>
    <meta content="" name="description">
    <meta content="" name="keywords">

    <!-- Favicons -->
    <link href="{{asset('fgb.png')}}" rel="icon">
    <link href="{{asset('NiceAdmin/assets/img/apple-touch-icon.png')}}" rel="apple-touch-icon">

    <!-- Google Fonts -->
    <link href="https://fonts.gstatic.com" rel="preconnect">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="{{asset('NiceAdmin/assets/vendor/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{asset('NiceAdmin/assets/vendor/bootstrap-icons/bootstrap-icons.css')}}" rel="stylesheet">
    <link href="{{asset('NiceAdmin/assets/vendor/boxicons/css/boxicons.min.css')}}" rel="stylesheet">
    <link href="{{asset('NiceAdmin/assets/vendor/quill/quill.snow.cs')}}s" rel="stylesheet">
    <link href="{{asset('NiceAdmin/assets/vendor/quill/quill.bubble.css')}}" rel="stylesheet">
    <link href="{{asset('NiceAdmin/assets/vendor/remixicon/remixicon.css')}}" rel="stylesheet">
    <link href="{{asset('NiceAdmin/assets/vendor/simple-datatables/style.css')}}" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('css/flatpicker.css')}}">
    <link rel="stylesheet" href="{{asset('css/datatable.css')}}">
    <!-- Template Main CSS File -->
    <link href="{{asset('NiceAdmin/assets/css/style.css')}}" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('assets/bootstrap/css/dateTime.css')}}">

    <script src="{{asset('js/jquery.js')}}"></script>
    <script src="{{asset('js/flatpicker.js')}}"></script>
    <script src="{{asset('js/datatable.js')}}"></script>


</head>

<body>
@include('provider.layouts.navbar')

@auth()
    @include('provider.layouts.sidebar')
@endauth


@yield('content')

@auth()
    @include('provider.layouts.footer')
@endauth
<!-- Vendor JS Files -->

<script src="{{asset('NiceAdmin/assets/vendor/apexcharts/apexcharts.min.js')}}"></script>
<script src="{{asset('NiceAdmin/assets/vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<script src="{{asset('NiceAdmin/assets/vendor/chart.js/chart.umd.js')}}"></script>
<script src="{{asset('NiceAdmin/assets/vendor/echarts/echarts.min.js')}}"></script>
<script src="{{asset('NiceAdmin/assets/vendor/quill/quill.min.js')}}"></script>
<script src="{{asset('NiceAdmin/assets/vendor/simple-datatables/simple-datatables.js')}}"></script>
<script src="{{asset('NiceAdmin/assets/vendor/tinymce/tinymce.min.js')}}"></script>
<script src="{{asset('NiceAdmin/assets/vendor/php-email-form/validate.js')}}"></script>

<!-- Template Main JS File -->


<script src="{{asset('assets/bootstrap/for_dataTable/buttons_dt.js')}}"></script>
<script src="{{asset('assets/bootstrap/for_dataTable/pdfmake.js')}}"></script>
<script src="{{asset('assets/bootstrap/for_dataTable/pdf_fonts.js')}}"></script>
<script src="{{asset('assets/bootstrap/for_dataTable/buttons_html.js')}}"></script>
<script src="{{asset('assets/bootstrap/for_dataTable/print.js')}}"></script>
<script src="{{asset('assets/bootstrap/js/moment.js')}}"></script>
<script src="{{asset('assets/bootstrap/js/dateTime.js')}}"></script>



@yield('script')
</body>

</html>
