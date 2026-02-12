@extends('layout.master')

@section('page_title', '- Daftar Item')

@section('content')
<div class="body-wrapper">
        <div class="container-fluid">
          <div class="card bg-info-subtle shadow-none position-relative overflow-hidden mb-4  ">
            <div class="card-body px-4 py-3">
              <div class="row align-items-center">
                <div class="col-9">
                  <h4 class="fw-semibold mb-8">Daftar Item</h4>
                  <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                      <li class="breadcrumb-item">
                        <a class="text-decoration-none" href="##"><b>Cabang {{ Auth::user()->namaKantor }}</b>
                          <br>{{ $kantor->alamat }}
                          <br>Telp: {{ $kantor->whatsapp }}
                          <br><br>
                          <b>Komplain Pusat</b>
                          <br>{{ $kantorUTM->notelepon }}
                        </a>
                      </li>
                      <!-- <li class="breadcrumb-item" aria-current="page"></li> -->
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

        <!-- <div class="alert bg-light-subtle" role="alert">
          <strong>Komplain Pusat - </strong> {{ $kantorUTM->notelepon }}
        </div> -->
          
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

                <div class="alert alert-info text-info alert-dismissible fade show mb-3" role="alert">
                    <button type="button" class="btn-close btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    <strong>Info - </strong> Silahkan Klik Nama Item yang Akan Di-Order!
                </div>                 

                <button type="button" class="btn mb-1 bg-primary-subtle text-primary px-4 fs-4 mb-3" data-bs-toggle="modal" data-bs-target="#filter-modal">
                    Filter
                </button>

                <!-- <div class="form-floating mb-3">
                  <input type="text" class="form-control" id="tb-fname" placeholder="Enter Name here" />
                  <label for="tb-fname">Name</label>
                </div> -->

                <div class="alert alert-warning text-warning" role="alert" id="filter_alert" style="display:none;">
                    <strong>Menampilkan - </strong><span id="filter_alert_text"></span>
                </div>

                <div class="row">
                  <!-- <div class="col-sm-12 col-md-3">
                    <div class="mb-3">
                      <label class="form-label">Show entries:</label>                            
                        <select class="form-select" id="custom-page-length">
                            <option value="10">10</option>
                            <option value="25">25</option>
                            <option value="50">50</option>
                            <option value="-1">All</option>
                        </select>
                    </div>
                  </div> -->
                  <div class="col-sm-12 col-md-12">
                    <div class="mb-3">
                      <label for="cari_item" class="form-label">Search:</label>
                      <input type="text" class="form-control" id="cari_item" placeholder="Masukkan nama item" />
                    </div>
                  </div>                    
                </div>                
                
                <div class="table-responsive">
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
                        <th id="stoks" {{ (config('settings.tampil_stok') == 'Tidak') ? 'hidden' : '' }}>Stok</th>
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