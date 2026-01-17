        </div>
        <!-- /.container-fluid -->
      </div>
      <!-- /.app-content -->
    </main>
    <!-- /.app-main -->

    <!--begin::Footer-->
    <footer class="app-footer">
      <div class="float-end d-none d-sm-inline">
        <i>Versi 1.0.0</i>
      </div>
      <span style="font-size: smaller;"><strong>Copyright &copy; <?= date('Y') ?>.</strong> WDP Technology - All rights reserved</span>
    </footer>
    <!--end::Footer-->
  </div>
  <!-- /.app-wrapper -->

  <!-- REQUIRED SCRIPTS -->
  
  <!-- jQuery -->
  <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
  
  <!-- OverlayScrollbars -->
  <script src="https://cdn.jsdelivr.net/npm/overlayscrollbars@2.11.0/browser/overlayscrollbars.browser.es6.min.js" crossorigin="anonymous"></script>
  
  <!-- Popper.js -->
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" crossorigin="anonymous"></script>
  
  <!-- Bootstrap 5 -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.min.js" crossorigin="anonymous"></script>
  
  <!-- AdminLTE 4 -->
  <script src="<?= base_url("adminlte4"); ?>/js/adminlte.js"></script>
  
  <!-- DataTables -->
  <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
  <script src="https://cdn.datatables.net/1.13.7/js/dataTables.bootstrap5.min.js"></script>
  <script src="https://cdn.datatables.net/responsive/2.5.0/js/dataTables.responsive.min.js"></script>
  <script src="https://cdn.datatables.net/responsive/2.5.0/js/responsive.bootstrap5.min.js"></script>
  <script src="https://cdn.datatables.net/buttons/2.4.2/js/dataTables.buttons.min.js"></script>
  <script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.bootstrap5.min.js"></script>
  
  <!-- Select2 -->
  <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
  
  <!-- Toastr -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
  
  <!-- Moment.js & Daterangepicker -->
  <script src="https://cdn.jsdelivr.net/npm/moment@2.29.4/moment.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
  
  <!-- CKEditor -->
  <script src="<?= base_url("assets"); ?>/dist/ckeditor/ckeditor.js"></script>
  
  <!-- Custom -->
  <script src="<?= base_url("assets"); ?>/dist/js/ubah_pass.js"></script>
  
  <!-- OverlayScrollbars Configure -->
  <script>
    const SELECTOR_SIDEBAR_WRAPPER = ".sidebar-wrapper";
    const Default = {
      scrollbarTheme: "os-theme-light",
      scrollbarAutoHide: "leave",
      scrollbarClickScroll: true
    };
    document.addEventListener("DOMContentLoaded", function() {
      const sidebarWrapper = document.querySelector(SELECTOR_SIDEBAR_WRAPPER);
      if (sidebarWrapper && typeof OverlayScrollbarsGlobal !== 'undefined' && OverlayScrollbarsGlobal?.OverlayScrollbars !== undefined) {
        OverlayScrollbarsGlobal.OverlayScrollbars(sidebarWrapper, {
          scrollbars: {
            theme: Default.scrollbarTheme,
            autoHide: Default.scrollbarAutoHide,
            clickScroll: Default.scrollbarClickScroll
          }
        });
      }
    });
  </script>

  <!-- This Application made with love by Wegi Zulianda
  author: wegizulianda@gmail.com
  company: https://webdeveloperpku.com -->

</body>
</html>