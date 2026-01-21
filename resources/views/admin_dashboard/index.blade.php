@extends('admin_layout.master')

@section('content')
<div class="body-wrapper">
        <div class="container-fluid">
          <div class="card bg-info-subtle shadow-none position-relative overflow-hidden mb-4">
            <div class="card-body px-4 py-3">
              <div class="row align-items-center">
                <div class="col-9">
                  <h4 class="fw-semibold mb-8">Dashboard</h4>
                  <!-- <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                      <li class="breadcrumb-item">
                        <a class="text-muted text-decoration-none" href="../main/index.html">Order</a>
                      </li>
                      <li class="breadcrumb-item" aria-current="page">Daftar Item</li>
                    </ol>
                  </nav> -->
                </div>
                <div class="col-3">
                  <div class="text-center mb-n5">
                    <img src="{{ url('/assets/themes/modernize-bootstrap/dist') }}/assets/images/breadcrumb/ChatBc.png" alt="modernize-img" class="img-fluid mb-n4" />
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-lg-12 d-flex align-items-stretch">
              <div class="card w-100 bg-primary-subtle overflow-hidden shadow-none">
                <div class="card-body position-relative">
                  <div class="row">
                    <div class="col-sm-7">
                      <h3 class="fw-semibold mb-0 fs-5">Welcome to Admin Panel</h3>
                      <div class="d-flex align-items-center py-9 mx-0 border-bottom">
                        <img src="{{ url('/assets/themes/modernize-bootstrap/dist') }}/assets/images/profile/user-1.jpg" class="rounded-circle" width="140" height="140" alt="modernize-img" />
                        <div class="ms-3">
                          <h5 class="mb-1 fs-3">Logged in :</h5>
                          <h3 class="fw-semibold mb-0 fs-5">{{ Auth::user()->nama }}</h3>
                          <!-- <h5 class="mb-1 fs-3">{{ Auth::user()->nama }}</h5>
                          <span class="mb-1 d-block">{{ Auth::user()->nama_npwp }}</span>
                          <span class="mb-1 d-block">{{ Auth::user()->alamat }}</span>
                          <span class="mb-1 d-block">{{ Auth::user()->kota }}</span>
                          <span class="mb-1 d-block">{{ Auth::user()->telepon }}</span>
                          <span class="mb-1 d-block"></span>
                          <p class="mb-0 d-flex align-items-center gap-2">
                            <i class="ti ti-star fs-4"></i> {{ Auth::user()->kgrup }}
                          </p> -->
                        </div>
                      </div>
                      <div class="d-flex align-items-center">
                        <!-- <div class="pe-4 border-muted border-opacity-10">
                          <h3 class="mb-1 fw-semibold fs-8 d-flex align-content-center">Rp 2,340<i class="ti ti-arrow-up-right fs-5 lh-base text-success"></i>
                          </h3>
                          <p class="mb-0 text-dark">This Month Order</p>
                        </div> -->
                        <!-- <div class="ps-4">
                          <h3 class="mb-1 fw-semibold fs-8 d-flex align-content-center">35%<i class="ti ti-arrow-up-right fs-5 lh-base text-success"></i>
                          </h3>
                          <p class="mb-0 text-dark">Overall Performance</p>
                        </div> -->
                      </div>
                    </div>
                    <div class="col-sm-5">
                      <!-- <div class="d-flex align-items-center">
                        <div class="pe-4 border-muted border-opacity-10">
                          <h3 class="mb-1 fw-semibold fs-8 d-flex align-content-center">Rp 2,340<i class="ti ti-arrow-up-right fs-5 lh-base text-success"></i>
                          </h3>
                          <p class="mb-0 text-dark">This Month Order</p>
                        </div>
                      </div> -->
                      <div class="welcome-bg-img mb-n7 text-end">
                        <img src="{{ url('/assets/themes/modernize-bootstrap/dist') }}/assets/images/backgrounds/welcome-bg.svg" alt="modernize-img" class="img-fluid">
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>            
          </div>
        </div>
      </div>
@endsection