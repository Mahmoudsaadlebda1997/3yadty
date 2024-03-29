@extends('layouts.head')
@section('title')
    لوحة التحكم
    @endsection
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        @include('layouts.head')
    </head>
    <body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">

        <!-- Preloader -->
        <div class="preloader flex-column justify-content-center align-items-center">
            <img class="animation__shake" src="{{asset('assets/img/AdminLTELogo.png')}}"
                 alt="AdminLTELogo" height="60" width="60">
        </div>

    @include('layouts.main-headerbar')
    <!-- Main Sidebar Container -->
    @include('layouts.main-sidebar')


            <!-- /.content-header -->

            <!-- Main content -->
        @yield('content')

        <!-- /.content -->
        </div>

    @include('layouts.footer')

    <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-dark">
            <!-- Control sidebar content goes here -->
        </aside>
        <!-- /.control-sidebar -->
    </div>
    <!-- ./wrapper -->

    @include('layouts.footer-scripts')
    </body>
    </html>
