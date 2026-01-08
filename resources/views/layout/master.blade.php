
<!DOCTYPE html>
<html lang="en" dir="ltr" data-bs-theme="light" data-color-theme="Blue_Theme" data-layout="vertical">

@include('layout.header')

<body class="link-sidebar">
  <!-- Preloader -->
  <!-- <div class="preloader">
    <img src="{{ url('/assets/themes/modernize-bootstrap/dist') }}/assets/images/logos/favicon.png" alt="loader" class="lds-ripple img-fluid" />
  </div> -->
  <div id="main-wrapper">

    <!-- Sidebar Start -->
    @include('layout.sidebar')
    <!--  Sidebar End -->

    <div class="page-wrapper">
        <!--  Header Start -->
        @include('layout.topbar')
        <!--  Header End -->

        @include('layout.horizontalbar')

        @yield('content')

        @include('layout.settings')

        <!--  Search Bar -->
        @include ('layout.searchbar')

        <!--  Shopping Cart -->
        @include('layout.shoppingcart')
    </div>

  <div class="dark-transparent sidebartoggler"></div>

  @include('layout.footer')

</body>

</html>