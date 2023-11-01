<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Khóa Học Lập Trình Laravel Framework 7.x">
    <meta name="author" content="">
    <title>@yield('title')</title>

    @include('admin.layouts.style')
</head>

<body>

    <div id="wrapper">

        <!-- Navigation -->
        @include('admin.layouts.header')

        <!-- Page Content -->
        @yield('content')
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

    @include('admin.layouts.script')
</body>

</html>
