@extends('layout.master')

@section('page_title', '- Daftar Item')

@section('content')
<div class="body-wrapper">
        <div class="container-fluid">
          <div class="card bg-info-subtle shadow-none position-relative overflow-hidden mb-4">
            <div class="card-body px-4 py-3">
              <div class="row align-items-center">
                <div class="col-9">
                  <h4 class="fw-semibold mb-8">Daftar Item</h4>
                  <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                      <li class="breadcrumb-item">
                        <a class="text-muted text-decoration-none" href="../main/index.html">Cabang</a>
                      </li>
                      <li class="breadcrumb-item" aria-current="page">{{ Auth::user()->namaKantor }}</li>
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
                  <div id="filter-modal" class="modal fade" tabindex="-1" aria-labelledby="primary-header-modalLabel" aria-hidden="true">
                      <div class="modal-dialog modal-dialog-scrollable modal-md">
                          <div class="modal-content">
                              <div class="modal-header modal-colored-header bg-primary text-white">
                                  <h4 class="modal-title text-white" id="primary-header-modalLabel">
                                      Filter Data
                                  </h4>
                                  <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                              </div>
                              <div class="modal-body">
                                <div class="mb-4">
                                  <!-- <label for="select2-jenis" class="form-label">Jenis</label> -->
                                  <p class="form-label">Jenis</p>
                                  <select class="select2 form-control" id="select2-jenis"><option>&nbsp;</option></select>
                                </div>
                                <div class="mb-4">
                                  <p class="form-label">Merek</p>
                                  <select class="select2 form-control" id="select2-merek"><option>&nbsp;</option></select>
                                </div>
                              </div>
                              <div class="modal-footer">
                                  <button type="button" class="btn btn-light" data-bs-dismiss="modal" onclick="resetFilter()">
                                      Reset
                                  </button>
                                  <button type="button" class="btn bg-primary-subtle text-primary" onclick="filterData()">
                                      Save changes
                                  </button>
                              </div>
                          </div>
                          <!-- /.modal-content -->
                      </div>
                      <!-- /.modal-dialog -->
                  </div>
                  <!-- /.modal -->

                  <div class="alert alert-info text-info alert-dismissible fade show" role="alert">
                      <button type="button" class="btn-close btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                      <strong>Info - </strong> Silahkan Klik Nama Item yang Akan Di-Order!
                  </div>

                  <button type="button" class="btn mb-1 bg-primary-subtle text-primary px-4 fs-4 " data-bs-toggle="modal" data-bs-target="#filter-modal">
                      Filter
                  </button>                  

                  <br><br>

                  <table id="daftar_item" class="table table-striped table-bordered align-middle" width="100%">
                    <thead>
                      <!-- start row -->
                      <tr>
                        <!-- <th style="width:10%;min-width:80px">Kode</th>
                        <th style="width:30%;min-width:260px">Nama Item</th>
                        <th style="width:10%;min-width:80px">Jenis</th>
                        <th style="width:10%;min-width:80px">Satuan</th>
                        <th style="width:20%;min-width:170px">Merk</th>
                        <th style="width:20%;min-width:80px">Harga</th> -->

                        <th>Kode</th>
                        <th>Nama Item</th>
                        <th>Jenis</th>
                        <th>Merek</th>
                        <th>Satuan</th>
                        <th>Harga</th>                        
                        <th id="stok" {{ (config('settings.tampil_stok') == 'Tidak') ? 'hidden' : '' }}>Stok</th>
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