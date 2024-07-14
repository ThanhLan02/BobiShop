<!DOCTYPE html>
<html lang="en">

@include('layout.header')

<body>

  <!-- Page Wrapper -->
  <div id="wrapper">

    <!-- Sidebar -->
    @include('layout.headbar')
    <!-- End of Sidebar -->

    <!-- Content Wrapper -->
    <div class="container">
        
        @yield('main-content')

      </div>
      <!-- End of Main Content -->
      @include('layout.footer')

</body>

</html>