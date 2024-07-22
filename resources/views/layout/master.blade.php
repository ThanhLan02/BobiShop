<!DOCTYPE html>
<html lang="en">

@include('layout.header')

<body>

    <!-- Sidebar -->
    @include('layout.headbar')
    <!-- End of Sidebar -->
    @yield('main-content')
    <!-- Content Wrapper -->
    <!-- End of Main Content -->
    @include('layout.footer')
    @stack('scripts')
</body>

</html>