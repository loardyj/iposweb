<div class="offcanvas offcanvas-end shopping-cart" tabindex="-1" id="offcanvasRight" aria-labelledby="offcanvasRightLabel">
      <div class="offcanvas-header justify-content-between py-4">
        <a href="##" onclick="resetCart()" class="btn btn-danger" id="linkWA">Reset</a>
        <h5 class="offcanvas-title fs-5 fw-semibold" id="offcanvasRightLabel">
          Keranjang
        </h5>
        <span class="badge bg-primary rounded-4 px-3 py-1 lh-sm" id="keranjang_item">0 item</span>
      </div>
      <!-- <table class="table table-striped table-bordered align-middle" width="100%">
        <thead>
          <tr>
            <th>Kode</th>
            <th>Nama Item</th>
            <th>Jenis</th>
            <th>Merek</th>
            <th>Satuan</th>
            <th>Harga</th>                        
            <th id="stok" {{ (config('settings.tampil_stok') == 'Tidak') ? 'hidden' : '' }}>Stok</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td>asd</td>
          </tr>                     
        </tbody>
        <tfoot>
        </tfoot>
      </table> -->
      <div class="offcanvas-body h-100 px-4 pt-0" data-simplebar>
        <ul class="mb-0" id="keranjang">
        <!-- <li class="pb-7 border-bottom mb-2">
          <div class="d-flex align-items-center">              
            <div>
              <h6 class="mb-1">Supreme toys cooker Supreme toys cooker Supreme toys cooker</h6>
              <p class="mb-0 text-muted fs-2">Kitchenware Item</p>
              <div class="d-flex align-items-center justify-content-between mt-2">
                <h6 class="fs-2 fw-semibold mb-0 text-muted">Rp 999.999.999</h6><br>                  
              </div>                
            </div>              
          </div>
          <div class="input-group input-group-sm w-30 float-end">
            <button class="btn border-0 round-20 p-0 bg-success-subtle text-success kurang" type="button" id="add1" onclick="updateQty(this)">
              -
            </button>
            <input type="text" inputmode="numeric" pattern="[0-9]*" class="form-control round-20 bg-transparent text-muted fs-2 border-0 text-center qty" placeholder="" aria-label="Example text with button addon" aria-describedby="add1" value="1"/>
            <button class="btn text-success bg-success-subtle p-0 round-20 border-0 tambah" type="button" id="addo2" onclick="updateQty(this)">
              +
            </button>
          </div>
        </li> -->
          <!-- <li class="pb-7">
            <div class="d-flex align-items-center">
              <img src="{{ url('/assets/themes/modernize-bootstrap/dist') }}/assets/images/products/product-2.jpg" width="95" height="75" class="rounded-1 me-9 flex-shrink-0" alt="modernize-img" />
              <div>
                <h6 class="mb-1">Supreme toys cooker</h6>
                <p class="mb-0 text-muted fs-2">Kitchenware Item</p>
                <div class="d-flex align-items-center justify-content-between mt-2">
                  <h6 class="fs-2 fw-semibold mb-0 text-muted">$250</h6>
                  <div class="input-group input-group-sm w-50">
                    <button class="btn border-0 round-20 minus p-0 bg-success-subtle text-success" type="button" id="add2">
                      -
                    </button>
                    <input type="text" class="form-control round-20 bg-transparent text-muted fs-2 border-0 text-center qty" placeholder="" aria-label="Example text with button addon" aria-describedby="add2" value="1" />
                    <button class="btn text-success bg-success-subtle p-0 round-20 border-0 add" type="button" id="addon34">
                      +
                    </button>
                  </div>
                </div>
              </div>
            </div>
          </li> -->
        </ul>
        <div class="align-bottom">
          <!-- <div class="d-flex align-items-center pb-7">
            <span class="text-dark fs-3">Sub Total</span>
            <div class="ms-auto">
              <span class="text-dark fw-semibold fs-3">$2530</span>
            </div>
          </div> -->
          <div class="d-flex align-items-center pb-7">
            <span class="text-dark fs-3">Total</span>
            <div class="ms-auto">
              <span class="text-dark fw-semibold fs-3" id="keranjang_total">Rp0</span>
            </div>
          </div>
          @if (Auth::user()->kode !== config('settings.guest_kode'))
          <a href="{{ route('keranjang.toWA') }}" target="_blank" class="btn btn-primary w-100" id="linkWA">Kirim Order Ke WA</a>
          @else
          <a onclick="errorTamu();" class="btn btn-primary w-100" id="linkWA">Kirim Order Ke WA</a>
          @endif
        </div>
      </div>
    </div>