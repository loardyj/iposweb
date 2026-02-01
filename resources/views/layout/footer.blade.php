<script src="{{ url('/assets/themes/modernize-bootstrap/dist') }}/assets/js/vendor.min.js"></script>
  <!-- Import Js Files -->
<script src="{{ url('/assets/themes/modernize-bootstrap/dist') }}/assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
<script src="{{ url('/assets/themes/modernize-bootstrap/dist') }}/assets/libs/simplebar/dist/simplebar.min.js"></script>
<script src="{{ url('/assets/themes/modernize-bootstrap/dist') }}/assets/js/theme/app.init.js"></script>
<script src="{{ url('/assets/themes/modernize-bootstrap/dist') }}/assets/js/theme/theme.js"></script>
<!-- Custom Theme Settings -->
<script>
  userSettings = {
    Layout: "horizontal", // vertical | horizontal
    SidebarType: "full", // full | mini-sidebar
    BoxedLayout: true, // true | false
    Direction: "ltr", // ltr | rtl
    Theme: "light", // light | dark
    ColorTheme: "Blue_Theme", // Blue_Theme | Aqua_Theme | Purple_Theme | Green_Theme | Cyan_Theme | Orange_Theme
    cardBorder: false, // true | false
  };
</script>
<script src="{{ url('/assets/themes/modernize-bootstrap/dist') }}/assets/js/theme/app.min.js"></script>
<script src="{{ url('/assets/themes/modernize-bootstrap/dist') }}/assets/js/theme/sidebarmenu.js"></script>

<!-- solar icons -->
<script src="https://cdn.jsdelivr.net/npm/iconify-icon@1.0.8/dist/iconify-icon.min.js"></script>

<!-- highlight.js (code view) -->
<script src="{{ url('/assets/themes/modernize-bootstrap/dist') }}/assets/js/highlights/highlight.min.js"></script>
<script>
    hljs.initHighlightingOnLoad();


    document.querySelectorAll("pre.code-view > code").forEach((codeBlock) => {
    codeBlock.textContent = codeBlock.innerHTML;
    });
</script>
<script src="{{ url('/assets/themes/modernize-bootstrap/dist') }}/assets/js/plugins/animation-init.js"></script>

<!-- Datatables -->
<script src="{{ url('/assets/themes/modernize-bootstrap/dist') }}/assets/libs/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.5.0/js/dataTables.responsive.js"></script>
<script src="{{ url('/assets/themes/modernize-bootstrap/dist') }}/assets/js/datatable/datatable-basic.init.js"></script>

<!-- Select2 -->
<script src="{{ url('/assets/themes/modernize-bootstrap/dist') }}/assets/libs/select2/dist/js/select2.full.min.js"></script>
<script src="{{ url('/assets/themes/modernize-bootstrap/dist') }}/assets/libs/select2/dist/js/select2.min.js"></script>
<script src="{{ url('/assets/themes/modernize-bootstrap/dist') }}/assets/js/forms/select2.init.js"></script>

<!-- SweetAlert2 -->
<script src="{{ url('/assets/themes/modernize-bootstrap/dist') }}/assets/libs/sweetalert2/dist/sweetalert2.min.js"></script>

<!-- NumberFormat -->
<script src="https://raw.githubusercontent.com/customd/jquery-number/refs/heads/master/jquery.number.min.js"></script>

<script>
    var table = new DataTable('#daftar_item', {
    ajax: 'daftar-item/json',
    processing: true,
    serverSide: true,
    // autoWidth: false,
    // columns: [
    //   {data: 'kodeitem', width:'80px'},
    //   {data: 'namaitem', width:'260px'},
    //   {data: 'jenis', width:'80px'},
    //   {data: 'satuan', width:'80px'},
    //   {data: 'merek', width:'170px'},
    //   {data: 'hargajual', width:'170px'},
    // ],
    columns: [
      {data: 'kodeitem'},
      {data: 'namaitem'},
      {data: 'ketjenis'},      
      {data: 'ketmerek'},
      {data: 'satuan'},
      {data: 'hargajual',
        // className: 'dt-right',
        render: $.fn.dataTable.render.number('.', ',', 0)
      },
      {data: 'stok', defaultContent: 'N/A',
        // className: 'dt-right',
        render: $.fn.dataTable.render.number('.', ',', 0)
      },
    ],

    columnDefs: [
      {
        targets: "_all",
        className: 'dt-head-center',        
      },
      {
        targets: [1, 2, 3, 4, 5, 6],
        render: function (data, type, row) {
          var hargajual = "Rp"+Intl.NumberFormat('id-ID').format(row.hargajual);
          var keterangan = row.namaitem + '<br>@ ' + hargajual;
          return `<a href="##" onclick="addToCart('${row.kodeitem}', '${keterangan}')">${data}</a>`;
        }
      }
    ],
    // fixedColumns: true,
    responsive: true,
    order: [],
    dom: 'lrtip'
    // dom: 'fltip'
    // ordering: false,
  });

  //
  // Loading array data
  //
  var dataJenis = [];
  var dataMerek = [];

  $.getJSON("daftar-item/filter_json", function(data) {
    dataJenis = data.jenis;
    dataMerek = data.merek;
  })
  .done(function() {
    $("#select2-jenis").select2({
      dropdownParent: $('#filter-modal'),
      data: dataJenis,
    });

    $("#select2-merek").select2({
      dropdownParent: $('#filter-modal'),
      data: dataMerek,
    });
  });



  // $("#select2-merek").select2({
  //   dropdownParent: $('#filter-modal'),
  //   data: data,
  // });

  function filterData() {
    var jenisVal = $("#select2-jenis option:selected").text();
    var merekVal = $("#select2-merek option:selected").text();

    var jenisIdx = $("#select2-jenis option:selected").index();
    var merekIdx = $("#select2-merek option:selected").index();
    
    table
      .column(2)
      .search(jenisVal)
      .draw();

    table
      .column(3)
      .search(merekVal)
      .draw();

    $('#filter-modal').modal('hide');

    console.log(jenisIdx);

    var filter_alert_text = '';
    if (jenisIdx > 0 || merekIdx > 0) {
      if (jenisIdx > 0) {
        filter_alert_text += '<b>Jenis: </b>' + jenisVal;
      }
      if (jenisIdx > 0 && merekIdx > 0) {
        filter_alert_text += ', ';
      }
      if (merekIdx > 0) {
        filter_alert_text += '<b>Merek: </b>' + merekVal;
      }
      $('#filter_alert_text').html(filter_alert_text);
      $('#filter_alert').show();    
    } else {
      $('#filter_alert').hide(); 
    }
  }

  function resetFilter() {
    $("#select2-jenis").val('').change();
    $("#select2-merek").val('').change();

    filterData();
  }  

  if ($("#stok").is(":hidden")) {
    table.column(6).visible(false);
  } else {
    table.column(6).visible(true);
  }

  const swalWithBootstrapButtons = Swal.mixin({
    customClass: {
      confirmButton: "btn btn-success",
      cancelButton: "me-6 btn btn-danger",
    },
    buttonsStyling: false,
  });
  
  function insertCart(isInsert, kode, qty) { 

    var itemObj = {
        "isInsert": isInsert,
        "id": 0,
        "kode": kode,
        "qty": qty,
    };
    
    $.ajax({
        url: 'keranjang/update', // The URL defined in your Laravel routes
        method: 'POST',
        dataType: 'json', // Expecting a JSON response from the server
        contentType: 'application/json', // Inform the server that the data is JSON
        headers: {
          'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content') // Pass the CSRF token
        },
        data: JSON.stringify(itemObj), // Convert the JavaScript object to a JSON string
        success: function(response) {
          showCart();
          if (isInsert) {
            swalWithBootstrapButtons.fire(
              "",
              "Item telah dimasukkan ke keranjang!",
              "success"
            );
          }
            // console.log('Success:', response);
        },
        error: function(xhr, status, error) {
          var errorMsg = 'Terjadi Kesalahan!';
          if (xhr.status == 401) {
            errorMsg = xhr.responseJSON.message;
          }

          swalWithBootstrapButtons.fire(
              "Error!",
              errorMsg,
              "error"
            );
          showCart();
          // console.error('Error:', xhr.responseText);
        }
    });
  }

  function addToCart(id, keterangan) {
    const swalWithBootstrapButtons = Swal.mixin({
      customClass: {
        confirmButton: "btn btn-success",
        cancelButton: "me-6 btn btn-danger",
      },
      buttonsStyling: false,
    });

    swalWithBootstrapButtons
      .fire({
        title: "<h1>Order</h1><h5>" + keterangan +"</h5>",
        // text: keterangan,
        type: "warning",
        showCancelButton: true,
        confirmButtonText: "OK",
        cancelButtonText: "Cancel",
        reverseButtons: true,
        html: `
          <div class="input-group input-group-sm w-50 mx-auto">
            <button class="btn border-0 round-40 p-0 bg-success-subtle text-success kurang insertBtn fs-5" type="button" onclick="updateQty(this)">
              -
            </button>
            <input type="number" class="form-control round-40 bg-transparent text-muted fs-5 border-0 text-center qty" id="insertQty" value="1" min="1"/>
            <button class="btn text-success bg-success-subtle p-0 round-40 border-0 tambah insertBtn fs-5" type="button" onclick="updateQty(this)">
              +
            </button>
          </div>
        `,
        preConfirm: () => {
          // Get the input elements by their IDs
          const insertQty = Swal.getPopup().querySelector('#insertQty');

          // Return the values as an object or array
          return {
            qty: insertQty.value
          };
        },
      })
      .then((result) => {
        if (result.value) {
          insertCart(true, id, result.value.qty);
          // swalWithBootstrapButtons.fire(
          //   "Deleted!",
          //   "Your file has been deleted.",
          //   "success"
          // );
        }
        // else if (
        //   // Read more about handling dismissals
        //   result.dismiss === Swal.DismissReason.cancel
        // ) {
        //   swalWithBootstrapButtons.fire(
        //     "Cancelled",
        //     "Your imaginary file is safe :)",
        //     "error"
        //   );
        // }
      });
  }

  
  async function showCart() {
    var ul = $('#keranjang');

    $.getJSON('keranjang/json', function(data) {
      // 'data' is the JavaScript array of objects returned by getJSON
      if (data[0].details) {
        // if (data[0].details.length <= 0) {
        //   $('#linkWA').attr("href", "https://www.newurl.com");
        // }

        var total = 0;
        var maxId = 0;
        $.each(data[0].details, function(index, item) {
          // 'index' is the current iteration index (0, 1, 2, ...)
          // 'item' is the current object in the array

          var id = item.id;
          var kodeitem = item.kode_item;
          var namaitem = item.item_details.namaitem;
          var merek = item.item_details.merek;
          var hargajual = Intl.NumberFormat('id-ID').format(item.item_details.harga_jual[0].hargajual);
          var qty = item.qty;
          var subtotal = item.item_details.harga_jual[0].hargajual * item.qty;
          
          maxId = item.id;

          total += subtotal;
          
          // console.log(index);
          var li = $("#keranjang li").eq(index);
          var idLi = li.find('#id').text();
          if (id == idLi) {
            li.find(".qty").val(qty);
          } else {
            // console.log(id + "=" + idLi);
            if (idLi == '' || id < idLi) {
              ul.append($(`<li class="pb-7 border-bottom mb-2">
                    <div class="d-flex align-items-center mb-1">              
                      <div>
                        <span id="id" hidden>` + id + `</span>
                        <span id="kode" hidden>` + kodeitem + `</span>
                        <h6 class="mb-1">[` + kodeitem + `] - ` + namaitem + `</h6>
                        <p class="mb-0 text-muted fs-2">Merek: ` + merek + `</p>
                        <div class="d-flex align-items-center justify-content-between mt-2">
                          <h6 class="fs-2 fw-semibold mb-0 text-muted">Rp` + hargajual + `</h6><br>                  
                        </div>                
                      </div>              
                    </div>
                    <button class="btn border-0 round-30 p-0 bg-danger-subtle text-danger float-start" type="button" onclick="deleteCartItem(`+id+`)">
                      <i class="icon ti ti-trash fs-3 m-2"></i>
                    </button>   
                    <div class="input-group input-group-sm w-30 float-end">
                      <button class="btn border-0 round-20 p-0 bg-success-subtle text-success kurang" type="button" id="add1" onclick="updateQty(this)">
                        -
                      </button>
                      <input type="number" class="form-control round-20 bg-transparent text-muted fs-2 border-0 text-center qty qty_keranjang" value="` + qty + `" min="1"/>
                      <button class="btn text-success bg-success-subtle p-0 round-20 border-0 tambah" type="button" id="addo2" onclick="updateQty(this)">
                        +
                      </button>
                    </div>
                  </li>`));
            }
            else if (id > idLi) {
              li.remove();
            }              
          }
          
          
        });

        const spans = document.querySelectorAll('#keranjang li span#id');

        // Iterate over the collection of spans
        spans.forEach(span => {
          // console.log(span.textContent);
          var spanId = span.textContent;
          if (spanId > maxId) {
            span.closest('li').remove();
          }
        });

        var jumlahItem = data[0].details.length;
        $('#keranjang_item').text(jumlahItem + ' item');
        $('.keranjang_item').text(jumlahItem);

        var totalText = 'Rp'+Intl.NumberFormat('id-ID').format(total);
        $('#keranjang_total').text(totalText);
      }
    }).fail(function(jqXHR, textStatus, errorThrown) {
      // Handle any errors during the request
      console.error("getJSON error: " + textStatus + ' : ' + errorThrown);
    });
  }

  $(document).on('change', 'input.qty_keranjang', function() {
    var btn = this;
    var li = btn.closest('li');
    var span = li.querySelector('span#id');
    var id = span.textContent;
    var kode = li.querySelector('span#kode').textContent;

    var qtyInput = btn.closest("div").querySelector(".qty");
    var currentVal = parseInt(qtyInput.value);

    if (currentVal !== 0) {
      insertCart(false, kode, currentVal);
    }
  });

  $(document).ready(function(){
    showCart();

    $('#cari_item').on('keyup', function() {
        table.search(this.value).draw(); // Use the DataTables API search() method
    });    
  });

  function updateQty(btn) {
    var qtyInput = btn.closest("div").querySelector(".qty");
    var currentVal = parseInt(qtyInput.value);
    var isAdd = btn.classList.contains("tambah");

    if (!isNaN(currentVal)) {
      qtyInput.value = isAdd
        ? ++currentVal
        : currentVal > 1
        ? --currentVal
        : currentVal;      

      if (!$(btn).hasClass("insertBtn")) {
        var li = btn.closest('li');
        var span = li.querySelector('span#id');
        var id = span.textContent;
        var kode = li.querySelector('span#kode').textContent; 

        if (currentVal !== 0) {
          insertCart(false, kode, currentVal);
        }
      }      
    }
  }

  function resetCart() {
    Swal.fire({
      title: "Konfirmasi",
      text: "Yakin reset keranjang?",
      type: "warning",
      showCancelButton: true,
      confirmButtonColor: "#DD6B55",
      confirmButtonText: "Ya",
      closeOnConfirm: false,
    }
    ).then((result) => {
      if (result.isConfirmed) {        
        $.ajax({
          url: 'keranjang/reset', // The URL defined in your Laravel routes
          method: 'POST',
          headers: {
              'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content') // Pass the CSRF token
          },
          success: function(response) {
              showCart();
          },
          error: function(xhr, status, error) {
              // console.error('Error:', xhr.responseText);
          }
        });
      } else {
        
      }
    });    
  }

  function deleteCartItem(id) {
    Swal.fire({
      title: "Konfirmasi",
      text: "Yakin hapus item?",
      type: "warning",
      showCancelButton: true,
      confirmButtonColor: "#DD6B55",
      confirmButtonText: "Ya",
      closeOnConfirm: false,
    }
    ).then((result) => {
      if (result.isConfirmed) {
        var itemObj = {
          "id": id,
        };
        
        $.ajax({
          url: 'keranjang/delete', // The URL defined in your Laravel routes
          method: 'POST',
          dataType: 'json', // Expecting a JSON response from the server
          contentType: 'application/json', // Inform the server that the data is JSON
          headers: {
              'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content') // Pass the CSRF token
          },
          data: JSON.stringify(itemObj), // Convert the JavaScript object to a JSON string
          success: function(response) {
              // console.log('Success:', response);
              showCart();
          },
          error: function(xhr, status, error) {
              // console.error('Error:', xhr.responseText);
          }
        });
      } else {
        
      }
    });    
  }
</script>