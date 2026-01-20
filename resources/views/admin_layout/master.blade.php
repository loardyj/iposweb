
<!DOCTYPE html>
<html lang="en" dir="ltr" data-bs-theme="light" data-color-theme="Blue_Theme" data-layout="vertical">

@include('admin_layout.header')

<body class="link-sidebar">
  <!-- Preloader -->
  <!-- <div class="preloader">
    <img src="{{ url('/assets/themes/modernize-bootstrap/dist') }}/assets/images/logos/favicon.png" alt="loader" class="lds-ripple img-fluid" />
  </div> -->
  <div id="main-wrapper">

    <!-- Sidebar Start -->
    @include('admin_layout.sidebar')
    <!--  Sidebar End -->

    <div class="page-wrapper">
        <!--  Header Start -->
        @include('admin_layout.topbar')
        <!--  Header End -->

        @include('admin_layout.horizontalbar')

        @yield('content')

        @include('admin_layout.settings')

        <!--  Search Bar -->
        @include ('admin_layout.searchbar')

        <!--  Shopping Cart -->
        @include('admin_layout.shoppingcart')
    </div>

  <div class="dark-transparent sidebartoggler"></div>

  @include('admin_layout.footer')

</body>

</html>