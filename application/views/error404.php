<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Star Admin Free Bootstrap Admin Dashboard Template</title>
  <!-- plugins:css -->
  <?=link_tag('vendors/iconfonts/mdi/css/materialdesignicons.min.css')?>
  <?=link_tag('vendors/css/vendor.bundle.base.css')?>
  <?=link_tag('vendors/css/vendor.bundle.addons.css')?>
  <?=link_tag('css/style.css')?>

  <!-- sweetalert.css -->
   <?=link_tag('css/sweetalert.min.css')?>

  <!-- endinject -->
  <link rel="shortcut icon" href="<?=base_url('images/favicon.png')?>" />
  <script src="<?=base_url('js/jquery-3.3.1.min.js')?>"></script>
  <script src="<?=base_url('js/sweetalert.min.js')?>"></script>
</head>

<body>
  <div class="container-scroller">
    <div class="container-fluid page-body-wrapper full-page-wrapper auth-page">
      <div class="content-wrapper d-flex align-items-center text-center error-page bg-primary">
        <div class="row flex-grow">
          <div class="col-lg-7 mx-auto text-white">
            <div class="row align-items-center d-flex flex-row">
              <div class="col-lg-6 text-lg-right pr-lg-4">
                <h1 class="display-1 mb-0">404</h1>
              </div>
              <div class="col-lg-6 error-page-divider text-lg-left pl-lg-4">
                <h2>SORRY!</h2>
                <h3 class="font-weight-light">The page you’re looking for was not found.</h3>
              </div>
            </div>
            <div class="row mt-5">
              <div class="col-12 text-center mt-xl-2">
                <a class="text-white font-weight-medium" href="<?=base_url()?>">Back to home</a>
              </div>
            </div>
            <div class="row mt-5">
              <div class="col-12 mt-xl-2">
                <p class="text-white font-weight-medium text-center">Copyright &copy; 2018 All rights reserved.</p>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- content-wrapper ends -->
    </div>
    <!-- page-body-wrapper ends -->
  </div>
  <!-- container-scroller -->


    <!-- plugins:js -->
    <script src="<?=base_url('vendors/js/vendor.bundle.base.js')?>"></script>
    <!-- endinject -->
    <!-- inject:js -->
    <script src="<?=base_url('js/off-canvas.js')?>"></script>
    <script src="<?=base_url('js/misc.js')?>"></script>
    <!-- endinject -->
</body>

</html>
