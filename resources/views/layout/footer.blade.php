<script src="{{ url('/assets/themes/modernize-bootstrap/dist') }}/assets/js/vendor.min.js"></script>
  <!-- Import Js Files -->
<script src="{{ url('/assets/themes/modernize-bootstrap/dist') }}/assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
<script src="{{ url('/assets/themes/modernize-bootstrap/dist') }}/assets/libs/simplebar/dist/simplebar.min.js"></script>
<script src="{{ url('/assets/themes/modernize-bootstrap/dist') }}/assets/js/theme/app.init.js"></script>
<script src="{{ url('/assets/themes/modernize-bootstrap/dist') }}/assets/js/theme/theme.js"></script>
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
      {data: 'hargajual'},
    ],
    // fixedColumns: true,
    responsive: true,
    order: [],
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
    
    table
      .column(2)
      .search(jenisVal)
      .draw();

    table
      .column(3)
      .search(merekVal)
      .draw();

    $('#filter-modal').modal('hide');
  }

  function resetFilter() {
    $("#select2-jenis").val('').change();
    $("#select2-merek").val('').change();

    filterData();
  }
</script>