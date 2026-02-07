@extends('admin_layout.master')

@section('page_title', '- Pengaturan')

@section('content')
<div class="body-wrapper">
        <div class="container-fluid">
          <div class="card bg-info-subtle shadow-none position-relative overflow-hidden mb-4">
            <div class="card-body px-4 py-3">
              <div class="row align-items-center">
                <div class="col-9">
                  <h4 class="fw-semibold mb-8">Pengaturan</h4>
                  <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                      <li class="breadcrumb-item">
                        <a class="text-muted text-decoration-none" href="../main/index.html">Menu</a>
                      </li>
                      <li class="breadcrumb-item" aria-current="page">Pengaturan</li>
                    </ol>
                  </nav>
                </div>
                <div class="col-3">
                  <div class="text-center mb-n5">
                    <img src="{{ url('/public/assets/themes/modernize-bootstrap/dist') }}/assets/images/breadcrumb/ChatBc.png" alt="modernize-img" class="img-fluid mb-n4" />
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-lg-12">
              @if (session()->has('success'))
                  <div class="alert customize-alert alert-dismissible alert-light-success bg-success-subtle text-success fade show remove-close-icon" role="alert">
                      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            <i class="ti ti-alert-circle fs-5 me-2 text-success"></i>{{ session('success') }}<br>
                  </div>
              @endif

              @if ($errors->any())
                  <div class="alert customize-alert alert-dismissible alert-light-danger bg-danger-subtle text-danger fade show remove-close-icon" role="alert">
                      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>                
                          @foreach ($errors->all() as $error)
                            <i class="ti ti-alert-circle fs-5 me-2 text-danger"></i>{{ $error }}<br>
                          @endforeach
                  </div>
              @endif

              <form action="{{ route('pengaturan.update') }}" method="POST" enctype="multipart/form-data">
              @csrf
              @method('PUT')
              <div class="card">
                <div class="px-4 py-3 border-bottom">
                  <h4 class="card-title mb-0">Identitas Website</h4>
                </div>
                <div class="card-body p-4">
                  <div class="mb-4">
                    <label for="nama_perusahaan" class="form-label">Nama Perusahaan</label>
                    <input type="text" class="form-control" id="nama_perusahaan" name="nama_perusahaan" placeholder="..." value="{{ config('settings.nama_perusahaan') }}">
                  </div>
                  <div class="mb-4">
                    <label for="logo" class="form-label">Logo Perusahaan</label>
                    <div class="row">
                      <div class="col-lg-6">
                        <input class="form-control" type="file" id="logo" name="logo"/>
                      </div>
                      <div class="col-lg-6">
                        <img src="{{ url('/public/uploads/logo') . '/' . config('settings.logo') }}" class="img-thumbnail" alt="..." width="200px">
                      </div>
                    </div>                    
                  </div>
                  <div class="mb-4">
                    <label for="favicon" class="form-label">Logo Favicon</label>
                    <div class="row">
                      <div class="col-lg-6">
                        <input class="form-control" type="file" id="favicon" name="favicon"/>
                      </div>
                      <div class="col-lg-6">
                        <img src="{{ url('/public/uploads/favicon') . '/' . config('settings.favicon') }}" class="img-thumbnail" width="100px">
                      </div>
                    </div>
                  </div>
                </div>
              </div>

              <div class="card">
                <div class="px-4 py-3 border-bottom">
                  <h4 class="card-title mb-0">Miscellaneous</h4>
                </div>
                <div class="card-body p-4">
                  <div class="mb-4">
                    <label for="exampleInputname" class="form-label">Tampil Stok</label>
                    <div class="form-check py-2">
                      <input type="radio" id="customRadio1" name="tampil_stok" value="Ya" class="form-check-input" @checked(config('settings.tampil_stok') == 'Ya')/>
                      <label class="form-check-label" for="customRadio1">Ya</label>
                    </div>
                    <div class="form-check py-2">
                      <input type="radio" id="customRadio2" name="tampil_stok" value="Tidak" class="form-check-input" @checked(config('settings.tampil_stok') == 'Tidak')/>
                      <label class="form-check-label" for="customRadio2">Tidak</label>
                    </div>
                  </div>         
                  
                  <div class="mb-4">
                    <label for="guest_kode" class="form-label">Kode Pelanggan Guest / Tamu</label>
                    <input type="text" class="form-control" id="guest_kode" name="guest_kode" placeholder="..." value="{{ config('settings.guest_kode') }}">
                  </div>
                  
                </div>
              </div>

              <button type="submit" class="btn btn-primary w-100">Save</button>
              </form>         
            </div>            
          </div>
        </div>
      </div>
@endsection