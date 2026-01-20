@extends('admin_layout.master')

@section('content')
<div class="body-wrapper">
        <div class="container-fluid">
          <div class="card bg-info-subtle shadow-none position-relative overflow-hidden mb-4">
            <div class="card-body px-4 py-3">
              <div class="row align-items-center">
                <div class="col-9">
                  <h4 class="fw-semibold mb-8">Kelola Admin</h4>
                  <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                      <li class="breadcrumb-item">
                        <a class="text-muted text-decoration-none" href="../main/index.html">Menu</a>
                      </li>
                      <li class="breadcrumb-item" aria-current="page">Kelola Admin</li>
                    </ol>
                  </nav>
                </div>
                <div class="col-3">
                  <div class="text-center mb-n5">
                    <img src="{{ url('/assets/themes/modernize-bootstrap/dist') }}/assets/images/breadcrumb/ChatBc.png" alt="modernize-img" class="img-fluid mb-n4" />
                  </div>
                </div>
              </div>
            </div>
          </div>
          <!-- start Zero Configuration -->
        <div class="datatables">
          <div class="card">
              <div class="card-body">
                <!-- <h4 class="card-title">Zero Configuration</h4>
                <p class="card-subtitle mb-3">
                  DataTables has most features enabled by default, so all
                  you need to do to use it with your own tables is to call
                  the construction function:<code> $().DataTable();</code>. You can refer full documentation from
                  here
                  <a href="https://datatables.net/">Datatables</a>
                </p> -->
                <div class="table-responsive">
                  <div id="tambah-modal" class="modal fade" tabindex="-1" aria-labelledby="primary-header-modalLabel" aria-hidden="true">
                      <div class="modal-dialog modal-dialog-scrollable modal-md">
                          <div class="modal-content">
                            <form action="{{ route('kelola_admin.store') }}" method="POST">
                            @csrf
                              <div class="modal-header modal-colored-header bg-primary text-white">
                                  <h4 class="modal-title text-white" id="primary-header-modalLabel">
                                      Tambah Data
                                  </h4>
                                  <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                              </div>
                              <div class="modal-body">
                                <div class="mb-4">
                                  <!-- <label for="select2-jenis" class="form-label">Jenis</label> -->
                                  <p class="form-label">Nama</p>
                                  <input type="text" class="form-control" name="nama"></input>
                                </div>
                                <div class="mb-4">
                                  <p class="form-label">Username</p>
                                  <input type="text" class="form-control" name="username"></input>
                                </div>
                                <div class="mb-4">
                                  <p class="form-label">Password</p>
                                  <input type="password" class="form-control" name="password"></input>
                                </div>
                                <div class="mb-4">
                                  <p class="form-label">Status</p>
                                  <select class="form-control" name="status">
                                    <option value="Aktif">Aktif</option>
                                    <option value="Nonaktif">Nonaktif</option>
                                  </select>
                                </div>
                              </div>
                              <div class="modal-footer">
                                  <button type="button" class="btn btn-light" data-bs-dismiss="modal">
                                      Close
                                  </button>
                                  <button type="submit" class="btn bg-primary-subtle text-primary" onclick="filterData()">
                                      Save changes
                                  </button>
                              </div>
                            </form>
                          </div>
                          <!-- /.modal-content -->
                      </div>
                      <!-- /.modal-dialog -->
                  </div>
                  <!-- /.modal -->

                  <div id="edit-modal" class="modal fade" tabindex="-1" aria-labelledby="primary-header-modalLabel" aria-hidden="true">
                      <div class="modal-dialog modal-dialog-scrollable modal-md">
                          <div class="modal-content">
                            <form action="{{ route('kelola_admin.update') }}" method="POST">
                            @csrf
                            @method('PUT')
                              <div class="modal-header modal-colored-header bg-primary text-white">
                                  <h4 class="modal-title text-white" id="primary-header-modalLabel">
                                      Edit Data
                                  </h4>
                                  <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                              </div>
                              <div class="modal-body">
                                <div class="mb-4">
                                  <!-- <label for="select2-jenis" class="form-label">Jenis</label> -->
                                  <p class="form-label">ID</p>
                                  <input type="text" class="form-control" id="id" name="id" readonly></input>
                                </div>
                                <div class="mb-4">
                                  <!-- <label for="select2-jenis" class="form-label">Jenis</label> -->
                                  <p class="form-label">Nama</p>
                                  <input type="text" class="form-control" id="nama" name="nama"></input>
                                </div>
                                <div class="mb-4">
                                  <p class="form-label">Username</p>
                                  <input type="text" class="form-control" id="username" name="username"></input>
                                </div>
                                <div class="mb-4">
                                  <p class="form-label">Password</p>
                                  <input type="password" class="form-control" id="password" name="password"></input>
                                </div>
                                <div class="mb-4">
                                  <p class="form-label">Status</p>
                                  <select class="form-control" id="status" name="status">
                                    <option value="Aktif">Aktif</option>
                                    <option value="Nonaktif">Nonaktif</option>
                                  </select>
                                </div>
                              </div>
                              <div class="modal-footer">
                                  <button type="button" class="btn btn-light" data-bs-dismiss="modal">
                                      Close
                                  </button>
                                  <button type="submit" class="btn bg-primary-subtle text-primary" onclick="filterData()">
                                      Save changes
                                  </button>
                              </div>
                            </form>
                          </div>
                          <!-- /.modal-content -->
                      </div>
                      <!-- /.modal-dialog -->
                  </div>
                  <!-- /.modal -->

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

                  <button type="button" class="btn mb-1 bg-primary-subtle text-primary px-4 fs-4 " data-bs-toggle="modal" data-bs-target="#tambah-modal">
                      Tambah
                  </button>

                  <br><br>

                  <table id="daftar_admin" class="table table-striped table-bordered align-middle" width="100%">
                    <thead>
                      <!-- start row -->
                      <tr>
                        <th>ID</th>
                        <th>Nama</th>
                        <th>Username</th>
                        <th>Status</th>
                        <th>Action</th>
                      </tr>
                      <!-- end row -->
                    </thead>
                    <tbody>

                    </tbody>
                    <tfoot>
                      <!-- start row -->
                      <!-- <tr>
                        <th>Name</th>
                        <th>Position</th>
                        <th>Office</th>
                        <th>Age</th>
                        <th>Start date</th>
                        <th>Salary</th>
                      </tr> -->
                      <!-- end row -->
                    </tfoot>
                  </table>
                </div>
              </div>
            </div>
            <!-- end Zero Configuration -->
        </div>
        </div>
      </div>
@endsection