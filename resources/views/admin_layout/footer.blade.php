<script src="{{ url('/public/assets/themes/modernize-bootstrap/dist') }}/assets/js/vendor.min.js"></script>
  <!-- Import Js Files -->
<script src="{{ url('/public/assets/themes/modernize-bootstrap/dist') }}/assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
<script src="{{ url('/public/assets/themes/modernize-bootstrap/dist') }}/assets/libs/simplebar/dist/simplebar.min.js"></script>
<script src="{{ url('/public/assets/themes/modernize-bootstrap/dist') }}/assets/js/theme/app.init.js"></script>
<script src="{{ url('/public/assets/themes/modernize-bootstrap/dist') }}/assets/js/theme/theme.js"></script>
<!-- Custom Theme Settings -->
<!-- <script>
  userSettings = {
    Layout: "horizontal", // vertical | horizontal
    SidebarType: "full", // full | mini-sidebar
    BoxedLayout: true, // true | false
    Direction: "ltr", // ltr | rtl
    Theme: "light", // light | dark
    ColorTheme: "Blue_Theme", // Blue_Theme | Aqua_Theme | Purple_Theme | Green_Theme | Cyan_Theme | Orange_Theme
    cardBorder: false, // true | false
  };
</script> -->
<script src="{{ url('/public/assets/themes/modernize-bootstrap/dist') }}/assets/js/theme/app.min.js"></script>
<script src="{{ url('/public/assets/themes/modernize-bootstrap/dist') }}/assets/js/theme/sidebarmenu.js"></script>

<!-- solar icons -->
<script src="https://cdn.jsdelivr.net/npm/iconify-icon@1.0.8/dist/iconify-icon.min.js"></script>

<!-- highlight.js (code view) -->
<script src="{{ url('/public/assets/themes/modernize-bootstrap/dist') }}/assets/js/highlights/highlight.min.js"></script>
<script>
    hljs.initHighlightingOnLoad();


    document.querySelectorAll("pre.code-view > code").forEach((codeBlock) => {
    codeBlock.textContent = codeBlock.innerHTML;
    });
</script>
<script src="{{ url('/public/assets/themes/modernize-bootstrap/dist') }}/assets/js/plugins/animation-init.js"></script>

<!-- Datatables -->
<script src="{{ url('/public/assets/themes/modernize-bootstrap/dist') }}/assets/libs/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.5.0/js/dataTables.responsive.js"></script>
<script src="{{ url('/public/assets/themes/modernize-bootstrap/dist') }}/assets/js/datatable/datatable-basic.init.js"></script>

<!-- Select2 -->
<script src="{{ url('/public/assets/themes/modernize-bootstrap/dist') }}/assets/libs/select2/dist/js/select2.full.min.js"></script>
<script src="{{ url('/public/assets/themes/modernize-bootstrap/dist') }}/assets/libs/select2/dist/js/select2.min.js"></script>
<script src="{{ url('/public/assets/themes/modernize-bootstrap/dist') }}/assets/js/forms/select2.init.js"></script>

<!-- SweetAlert2 -->
<script src="{{ url('/public/assets/themes/modernize-bootstrap/dist') }}/assets/libs/sweetalert2/dist/sweetalert2.min.js"></script>

<script src="{{ url('/public/assets') }}/js/admin.js"></script>