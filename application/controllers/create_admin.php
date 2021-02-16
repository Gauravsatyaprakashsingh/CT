<?php include_once APPPATH.'views/header.php'; ?>
<?php include_once APPPATH.'views/sidebar.php'; ?>

<div id="content">
  <div id="content-header">
    <div id="breadcrumb">
      <a href="<?=base_url(HOME_URL)?>" title="Go to Home" class="tip-bottom">
        <i class="icon-home"></i> Home</a>
         <a href="#" class="current">Create admin</a>
       </div>
    <!-- <h1>Create Admin</h1> -->
  </div>
  <div class="container-fluid">
    <div class="row-fluid">
      <div class="span12">
        <div class="widget-box">
          <div class="widget-title"> <span class="icon"> <i class="icon-user"></i> </span>
            <h5>Create admin</h5>
          </div>
          <div class="widget-content nopadding">
            <form class="form-horizontal" method="post" action="<?=base_url('Home/add_admin')?>"  id="create_admin" novalidate="novalidate">
              <div class="control-group">
                <label class="control-label">Username</label>
                <div class="controls">
                  <input type="text"  name="username">
                </div>
              </div>
              <div class="control-group">
                <label class="control-label">Email</label>
                <div class="controls">
                  <input type="text" name="email" >
                </div>
              </div>

              <div class="control-group">
                <label class="control-label">Password</label>
                <div class="controls">
                  <input type="password" id="password"  name="password" >
                </div>
              </div>

              <div class="control-group">
                <label class="control-label">Re-Password</label>
                <div class="controls">
                  <input type="password" name="cnfpassword" >
                </div>
              </div>


              <div class="form-actions">
                <input type="submit" value="Save" class="btn btn-success">
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>

  </div>
</div>

<script src="<?=base_url('js/jquery.validate.js')?>"></script>
<script src="<?=base_url('js/matrix.form_validation.js')?>"></script>

<?php include_once APPPATH.'views/footer.php'; ?>
