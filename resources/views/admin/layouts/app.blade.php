<!doctype html>
<html class="no-js" lang="">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta name="referrer" content="same-origin">
        <title>@yield('title', 'Admin panel')</title>
        <link rel="stylesheet" href="/admin-assets/bootstrap/bootstrap.min.css">
        <link rel="stylesheet" href="/admin-assets/font-awesome/css/font-awesome.min.css">
        <link rel="stylesheet" href="/admin-assets/AdminLTE.min.css">
        <link rel="stylesheet" href="/admin-assets/colors.css?v=2">
        <link rel="stylesheet" href="/admin-assets/_all-skins.min.css">
        <link rel="stylesheet" href="/admin-assets/dataTables/datatables.min.css">
        <link rel="stylesheet" href="/admin-assets/select2/select2.min.css">
        <script src="/admin-assets/jquery/jquery.min.js"></script>
        <script src="/admin-assets/bootstrap/bootstrap.js"></script>
        <script src="/admin-assets/dataTables/datatables.min.js"></script>
        <script src="/admin-assets/select2/select2.min.js"></script>
        <script src="/admin-assets/scripts-before.js"></script>
    </head>
    <body class="skin-{{ config('admin.theme') }} {{ config('admin.layout') }}">
        <div class="wrapper">
            @include('admin.includes.header')
            @include('admin.includes.sidebar')
            <!-- Content Wrapper. Contains page content -->
            <div class="content-wrapper">
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1>@yield('h1')</h1>
                </section>
                @include('admin.includes.partials.breadcrumbs-vzo')
                <!-- Main content -->
                <section class="content">
                    @include('admin.includes.partials.messages')
                    @yield('content')
                </section><!-- /.content -->
            </div><!-- /.content-wrapper -->
            @include('admin.includes.footer')
        </div><!-- ./wrapper -->
        <!-- JavaScripts -->
        @yield('before-scripts')
        <script src="/admin-assets/backend.js"></script>
        @yield('after-scripts')
    </body>
</html>
