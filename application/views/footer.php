<!-- partial:partials/_footer.html -->
<footer class="footer">
  <!-- <div class="container-fluid clearfix">
    <span class="text-muted d-block text-center text-sm-left d-sm-inline-block">Copyright © 2018
      <a href="http://www.bootstrapdash.com/" target="_blank">Bootstrapdash</a>. All rights reserved.</span>
    <span class="float-none float-sm-right d-block mt-1 mt-sm-0 text-center">Hand-crafted & made with
      <i class="mdi mdi-heart text-danger"></i>
    </span>
  </div> -->
</footer>
<!-- partial -->

</div>
    <!-- main-panel ends -->
  </div>
  <!-- page-body-wrapper ends -->
</div>
<!-- container-scroller -->

<!-- plugins:js -->
<script src="<?=base_url('vendors/js/vendor.bundle.base.js')?>"></script>

<!-- <script src="<?=base_url('vendors/js/vendor.bundle.addons.js')?>"></script> -->
<!-- endinject -->
<!-- Plugin js for this page-->
<!-- End plugin js for this page-->
<!-- inject:js -->
<script src="<?=base_url('js/off-canvas.js')?>"></script>
<script src="<?=base_url('js/misc.js')?>"></script>
<!-- endinject -->
<!-- Custom js for this page-->
<script src="<?=base_url('js/dashboard.js')?>"></script>
<!-- End custom js for this page-->

 <!-- Datatables -->
<script type="text/javascript" charset="utf8" src="<?=base_url('js/jquery.dataTables.js')?>"></script>
<script >
  $(document).ready( function () {
     $('#table_id').DataTable();
  });
</script>

</body>

</html>
