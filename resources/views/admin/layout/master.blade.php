<!DOCTYPE html>
<html lang="en">

@include('admin.layout.head')

<body class="hold-transition sidebar-mini layout-fixed">

  <!-- Page Wrapper -->
  <div class="wrapper">
    <!-- Preloader -->
    <div class="preloader flex-column justify-content-center align-items-center">
      <img class="animation__shake" src="{{ asset('dist/img/AdminLTELogo.png') }}" alt="AdminLTELogo" height="60" width="60">
    </div>
    <!-- Topbar -->
    @include('admin.layout.topbar')
        <!-- End of Topbar -->

    <!-- Sidebar -->
    @include('admin.layout.sidebar')
    <!-- End of Sidebar -->

    <!-- Content Wrapper -->
    <div class="content-wrapper">

        <!-- Begin Page Content -->
        @yield('main-content')
        <!-- /.container-fluid -->

      </div>
      <!-- End of Main Content -->
      @include('admin.layout.footer')

</body>

</html>