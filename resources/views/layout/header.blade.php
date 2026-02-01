<head>
  <!-- Required meta tags -->
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <meta name="csrf-token" content="{{ csrf_token() }}"> {{-- Include CSRF Token --}}

  <!-- Favicon icon-->
  <link rel="shortcut icon" type="image/png" href="{{ url('/public/uploads/logo') . '/' . config('settings.favicon') }}" />

  <!-- Core Css -->
  <link rel="stylesheet" href="{{ url('/assets/themes/modernize-bootstrap/dist') }}/assets/css/styles.css" />

  <title>{{ config('settings.nama_perusahaan') }} @yield('page_title')</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />

  <!-- Datatables -->
  <link rel="stylesheet" href="{{ url('/assets/themes/modernize-bootstrap/dist') }}/assets/libs/datatables.net-bs5/css/dataTables.bootstrap5.min.css" />
  <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.5.0/css/responsive.bootstrap5.min.css" />

  <!-- Select2 -->
  <link rel="stylesheet" href="{{ url('/assets/themes/modernize-bootstrap/dist') }}/assets/libs/select2/dist/css/select2.min.css">

  <!-- SweetAlert2 -->
  <link rel="stylesheet" href="{{ url('/assets/themes/modernize-bootstrap/dist') }}/assets/libs/sweetalert2/dist/sweetalert2.min.css">

  <style>
    tr td {
      word-break:break-all;
    }
    
    .dataTables_length {
      float: right; /* Moves "Show entries" to the right */
    }

    .dataTables_filter {
      float: left; /* Moves search to the left */
    }

    /* @media (max-width: 1299.98px) { */
      html[data-layout=horizontal] .body-wrapper>.container-fluid, html[data-layout=horizontal] .body-wrapper>.container-lg, html[data-layout=horizontal] .body-wrapper>.container-md, html[data-layout=horizontal] .body-wrapper>.container-sm, html[data-layout=horizontal] .body-wrapper>.container-xl, html[data-layout=horizontal] .body-wrapper>.container-xxl {
        padding-top: 30px !important;
      }
    /* } */
    
    @media (min-width:992px){
      #tombolCart {
        display: none !important;
      }
    }
    
    .nav-link.active {
      transition: all .1s ease-in-out;
      color: var(--bs-primary) !important;
    }

    /* Chrome, Safari, Edge, Opera */
    .qty::-webkit-outer-spin-button,
    .qty::-webkit-inner-spin-button {
      -webkit-appearance: none;
      margin: 0;
    }

    /* Firefox */
    .qty {
      -moz-appearance: textfield;
      appearance: textfield; /* Standard property for newer browsers */
    }

    .dataTables_length {
      margin-bottom: 1rem;
    }

    .table-responsive {
      overflow-y: hidden;
    }

    .dataTables_info {
      margin-bottom: 1.25rem;
    }

    .dataTables_paginate {
      margin-bottom: 1rem !important;
    }    
  </style>
</head>