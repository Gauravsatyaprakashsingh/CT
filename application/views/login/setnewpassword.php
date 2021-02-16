<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Metropolis Login | Adminpanel </title>
  <!-- plugins:css -->
  <?=link_tag('vendors/iconfonts/mdi/css/materialdesignicons.min.css')?>
  <?=link_tag('vendors/css/vendor.bundle.base.css')?>
  <?=link_tag('vendors/css/vendor.bundle.addons.css')?>
  <?=link_tag('css/style.css')?>

  <!-- sweetalert.css -->
   <?=link_tag('css/sweetalert.min.css')?>

  <!-- endinject -->
  <link rel="shortcut icon" href="<?=base_url('images/logo.png')?>" />
  <script src="<?=base_url('js/jquery-3.3.1.min.js')?>"></script>
  <script src="<?=base_url('js/sweetalert.min.js')?>"></script>
</head>
<body>

  <?php if ( !$isKeyValid ): ?>
    Link is Expired
  <?php else: ?>
    <?php if($this->session->flashdata('error')): ?>
      <script>
        swal("Error", "<?=$this->session->flashdata('error')?>", "warning");
      </script>
    <?php endif;   ?>


  <div class="container-scroller">
    <div class="container-fluid page-body-wrapper full-page-wrapper auth-page">
      <div class="content-wrapper d-flex align-items-center auth auth-bg-1 theme-one">
        <div class="row w-100">
          <div class="col-lg-4 mx-auto">
            <div class="auto-form-wrapper">
              <form action="<?=base_url('Login/update_password')?>" method="post">
                <div class="form-group">
                  <label class="label">New Password</label>
                  <div class="input-group">
                    <input type="password" name="password" class="form-control" placeholder="Enter email">
                    <input type="hidden" name="user_value" value="<?=$data['value']?>">
                    <div class="input-group-append">
                      <span class="input-group-text">
                        <i class="mdi mdi-mail"></i>
                      </span>
                    </div>
                  </div>
                </div>
                <div class="form-group">
                  <label class="label">Conform Password</label>
                  <div class="input-group">
                    <input type="password" name="confpassword" class="form-control" placeholder="*********">
                    <div class="input-group-append">
                      <span class="input-group-text">
                        <i class="mdi mdi-check-circle-outline"></i>
                      </span>
                    </div>
                  </div>
                </div>
                <div class="form-group">
                  <button class="btn btn-primary submit-btn btn-block">Reset</button>
                </div>
                <div class="form-group d-flex justify-content-between">
                  <div class="form-check form-check-flat mt-0">
                    <!-- <label class="form-check-label">
                      <input type="checkbox" class="form-check-input" checked> Keep me signed in
                    </label> -->
                  </div>
                  <!-- <a href="<?=base_url('Login/')?>" class="text-small forgot-password text-black">Back to Login</a> -->
                </div>
                <!-- <div class="form-group">
                  <button class="btn btn-block g-login">
                    <img class="mr-3" src="../../images/file-icons/icon-google.svg" alt="">Log in with Google</button>
                </div> -->
                <!-- <div class="text-block text-center my-3">
                  <span class="text-small font-weight-semibold">Not a member ?</span>
                  <a href="register.html" class="text-black text-small">Create new account</a>
                </div> -->
              </form>
            </div>
            <!-- <ul class="auth-footer">
              <li>
                <a href="#">Conditions</a>
              </li>
              <li>
                <a href="#">Help</a>
              </li>
              <li>
                <a href="#">Terms</a>
              </li>
            </ul> -->
            <!-- <p class="footer-text text-center">copyright © 2018 Bootstrapdash. All rights reserved.</p> -->
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
<?php endif; ?>

</body>

</html>
