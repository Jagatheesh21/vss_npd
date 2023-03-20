<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="description" content="NPD">
    <meta name="author" content="VSSIPL">
    <meta name="keyword" content="NPD">
    <title>{{ config('app.name', 'Laravel') }}</title>
    {{-- <link rel="apple-touch-icon" sizes="57x57" href="{{asset('assets/favicon/apple-icon-57x57.png')}}">
    <link rel="apple-touch-icon" sizes="60x60" href="{{asset('assets/favicon/apple-icon-60x60.png')}}">
    <link rel="apple-touch-icon" sizes="72x72" href="{{asset('assets/favicon/apple-icon-72x72.png')}}">
    <link rel="apple-touch-icon" sizes="76x76" href="{{asset('assets/favicon/apple-icon-76x76.png')}}">
    <link rel="apple-touch-icon" sizes="114x114" href="{{asset('assets/favicon/apple-icon-114x114.png')}}">
    <link rel="apple-touch-icon" sizes="120x120" href="{{asset('assets/favicon/apple-icon-120x120.png')}}">
    <link rel="apple-touch-icon" sizes="144x144" href="{{asset('assets/favicon/apple-icon-144x144.png')}}">
    <link rel="apple-touch-icon" sizes="152x152" href="{{asset('assets/favicon/apple-icon-152x152.png')}}">
    <link rel="apple-touch-icon" sizes="180x180" href="{{asset('assets/favicon/apple-icon-180x180.png')}}">
    <link rel="icon" type="image/png" sizes="192x192" href="{{asset('assets/favicon/android-icon-192x192.png')}}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{asset('assets/favicon/favicon-32x32.png')}}">
    <link rel="icon" type="image/png" sizes="96x96" href="{{asset('assets/favicon/favicon-96x96.png')}}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{asset('assets/favicon/favicon-16x16.png')}}"> --}}
    <link rel="manifest" href="{{asset('assets/favicon/manifest.json')}}">
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="msapplication-TileImage" content="{{asset('assets/favicon/ms-icon-144x144.png')}}">
    <meta name="theme-color" content="#ffffff">
    <!-- Vendors styles-->
    <link rel="stylesheet" href="{{asset('vendors/simplebar/css/simplebar.css')}}">
    <link rel="stylesheet" href="{{asset('css/vendors/simplebar.css')}}">
    <!-- Main styles for this application-->
    <link rel="stylesheet" href="{{asset('css/prism.css')}}">
    <link href="{{asset('css/examples.css')}}" rel="stylesheet">
    <link href="{{asset('css/style.css')}}" rel="stylesheet">
    <link href="{{asset('css/select2.min.css')}}" rel="stylesheet" />
    <link href="{{asset('css/toast.min.css')}}" rel="stylesheet" />
    <style>
      .table{
        width:100% !important;
      }
    </style>
    @stack('styles')
  </head>
  <body>
    <div class="sidebar sidebar-dark sidebar-fixed sidebar-narrow-unfoldable" id="sidebar">
      <div class="sidebar-brand d-none d-md-flex">
        <img src="{{asset('assets/img/logo.png')}}" class="sidebar-brand-full" width="180" height="46" alt="Logo">
        <img src="{{asset('assets/img/fav_icon.png')}}" class="sidebar-brand-narrow" width="46" height="46" alt="Logo">
      </div>
      @include('partials.menu')
      <button class="sidebar-toggler" type="button" data-coreui-toggle="unfoldable"></button>
    </div>
    <div class="wrapper d-flex flex-column min-vh-100 bg-light">
      <header class="header header-sticky mb-4">
        <div class="container-fluid">
        <button class="header-toggler px-md-0 me-md-3" type="button" onclick="coreui.Sidebar.getInstance(document.querySelector('#sidebar')).toggle()">
        <svg class="icon icon-lg">
        <use xlink:href="{{asset('vendors/@coreui/icons/svg/free.svg#cil-menu')}}"></use>
        </svg>
        </button><a class="header-brand d-md-none" href="#">
        <svg width="118" height="46" alt="Logo">
        <use xlink:href="{{asset('assets/img/logo.png')}}"></use>
        </svg></a>
        <ul class="header-nav d-none d-md-flex">
        <li class="nav-item"><a class="nav-link" href="#"><b>New Product Development</b></a></li>
        </ul>
        <ul class="header-nav ms-auto">
        
        </ul>
        
        </div>
        {{-- <div class="header-divider"></div> --}}
        {{-- <div class="container-fluid">
        <nav aria-label="breadcrumb">
        <ol class="breadcrumb my-0 ms-2">
        <li class="breadcrumb-item">
        <span>Home</span>
        </li>
        <li class="breadcrumb-item active"><span>Dashboard</span></li>
        </ol>
        </nav>
        </div> --}}
        </header>
      <div class="body flex-grow-1 px-3 py-3">
        <div class="container-fluid">
          @yield('content')
        </div>
      </div>
      
  </body>
</html>
<script src="{{asset('vendors/chart.js/js/chart.min.js')}}"></script>
<script src="{{asset('vendors/@coreui/chartjs/js/coreui-chartjs.js')}}"></script>
<script src="{{asset('vendors/@coreui/utils/js/coreui-utils.js')}}"></script>
<script src="{{asset('vendors/@coreui/coreui/js/coreui.bundle.min.js')}}"></script>
<script src="{{asset('vendors/simplebar/js/simplebar.min.js')}}"></script>
<script src="{{asset('js/jquery.min.js')}}"></script>
<script src="{{asset('js/jquery_validation.min.js')}}"></script>
<script src="{{asset('js/sweetalert.min.js')}}"></script>
<script src="{{asset('js/toasts.js')}}"></script>
<script src="{{asset('js/toast.min.js')}}"></script>
<script type="text/javascript">
  $(function () {
    $.ajaxSetup({
          headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
    });
    $(".alert").delay(1000).slideUp(200, function() {
    $(this).alert('close');
});

  });
</script>
@stack('scripts')