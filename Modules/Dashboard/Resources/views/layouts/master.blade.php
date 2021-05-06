<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $title ?? '' }} | Админ-панель</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="{{ Module::asset('dashboard:plugins/fontawesome-free/css/all.min.css') }}">
    <!-- IonIcons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ Module::asset('dashboard:css/adminlte.min.css') }}">

    <link rel="stylesheet" href="{{ Module::asset('dashboard:plugins/summernote/summernote-bs4.min.css') }}">


    <style>
        a.delete-item {
            margin-left: 10px;
        }
    </style>

    <link rel="stylesheet" type="text/css" href="{{ Module::asset('dashboard:plugins/toastr/toastr.css') }}"/>

    <link rel="stylesheet" href="{{ Module::asset('dashboard:plugins/dropzone/basic.css') }}">
    <link rel="stylesheet" href="{{ Module::asset('dashboard:plugins/dropzone/min/dropzone.min.css') }}">

</head>
<!--
`body` tag options:

  Apply one or more of the following classes to to the body tag
  to get the desired effect

  * sidebar-collapse
  * sidebar-mini
-->
<body class="hold-transition sidebar-mini">
<div class="wrapper">
    @include('dashboard::layouts.parts.master__top_menu')

    <!-- Main Sidebar Container -->
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
        <!-- Brand Logo -->
        <a href="{{ route('dashboard.index') }}" class="brand-link">
            <span class="brand-text font-weight-light">Админ-панель</span>
        </a>

        <!-- Sidebar -->
        <div class="sidebar">
            <!-- Sidebar user panel (optional) -->
            <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                <div class="image">
                    <img src="{{ Module::asset('dashboard:img/user-image.png') }}" class="img-circle elevation-2" alt="User Image">
                </div>
                <div class="info">
                    <a href="#" class="d-block">{{ Auth::user()->name }} {{ Auth::user()->surname }}</a>
                </div>
            </div>

            @include('dashboard::layouts.parts.master__left_menu')
        </div>
        <!-- /.sidebar -->
    </aside>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">{{ $title ?? '' }}</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        @include('dashboard::layouts.parts.master__breadcrumbs')
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <div class="content">
            <div class="container-fluid">
                @yield('content')
            </div>
            <!-- /.container-fluid -->
        </div>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">
        <!-- Control sidebar content goes here -->
    </aside>
    <!-- /.control-sidebar -->

    <!-- Main Footer -->
    <footer class="main-footer">
{{--        <strong>Copyright &copy; 2014-2021 <a href="https://adminlte.io">AdminLTE.io</a>.</strong>--}}
{{--        All rights reserved.--}}
{{--        <div class="float-right d-none d-sm-inline-block">--}}
{{--            <b>Version</b> 3.1.0-rc--}}
{{--        </div>--}}
    </footer>

    @include('dashboard::layouts.modals.master__delete_modal')
</div>
<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->

<!-- jQuery -->
<script src="{{ Module::asset('dashboard:plugins/jquery/jquery.min.js') }}"></script>
<!-- Bootstrap -->
<script src="{{ Module::asset('dashboard:plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

<script src="{{ Module::asset('dashboard:plugins/dropzone/dropzone.js') }}"></script>

<!-- AdminLTE -->
<script src="{{ Module::asset('dashboard:js/adminlte.js') }}"></script>

<!-- OPTIONAL SCRIPTS -->
<!-- AdminLTE for demo purposes -->
<script src="{{ Module::asset('dashboard:js/demo.js') }}"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
{{--<script src="{{ Module::asset('dashboard:js/pages/dashboard3.js') }}"></script>--}}

<script src="{{ Module::asset('dashboard:plugins/toastr/toastr.min.js') }}"></script>

<script src="{{ Module::asset('dashboard:js/table.js') }}"></script>

<script src="{{ Module::asset('dashboard:plugins/summernote/summernote-bs4.min.js') }}"></script>

<script src="{{ Module::asset('dashboard:js/custom/upload-image.js') }}"></script>



<script>
    $(function () {
        // Summernote
        $('.summernote').summernote({
            height: 200,
            callbacks: {

                onImageUpload: function (files, editor, welEditable) {
                    var insertData = {
                        route: 'page',
                        directory: 'upload'
                    };

                    sendFileImageEditor(insertData, files[0], this);
                }
            }
        });
    });

</script>

@if(\Illuminate\Support\Facades\Session::has('successMessage') && !empty(\Illuminate\Support\Facades\Session::get('successMessage')))
    <script>
        $(function (){
            toastr.success("{{\Illuminate\Support\Facades\Session::get('successMessage')}}")
        });
    </script>
@endif

@if(\Illuminate\Support\Facades\Session::has('errorMessage') && !empty(\Illuminate\Support\Facades\Session::get('errorMessage')))
    <script>
        $(function (){
            toastr.error("{{\Illuminate\Support\Facades\Session::get('errorMessage')}}")
        });
    </script>
@endif

@yield('footer-scripts')


<script>
    $(function () {
        var $deleteBtn = $('a.delete-item');
        var $deleteModal = $('#modal-delete-item');

        var deletingRoute = "";

        $deleteBtn.on('click', function (e) {
            e.preventDefault();

            var id = $(this).data('id'),
                route = $(this).data('route');

            deletingRoute = '/admin/' + route + '/delete/' + id;

            $deleteModal.find('#confirmDelete').attr('data-id', id);
            $deleteModal.modal('show');
        });

        $deleteModal.find('#confirmDelete').on('click', function (e) {
            e.preventDefault();

            $.ajax({
                url: deletingRoute,
                method: 'DELETE',
                data: {
                    _token: $('meta[name="csrf-token"]').attr('content')
                },
                success: function (response) {
                    if(response.success === true) {
                        toastr.success(response.message);
                        setTimeout(function () {
                            window.location.reload();
                        }, 3000);
                    } else {
                        toastr.error(response.message);
                    }
                }
            });

            $deleteModal.modal('hide');
        });
    });
</script>

</body>
</html>
