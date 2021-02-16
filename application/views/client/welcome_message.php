
<?php if( $this->session->flashdata('success') ): ?>
<div class="content-wrapper">
  <div class="alert alert-success alert-dismissible fade show" role="alert">
  <strong>Success !</strong>  <?=$this->session->flashdata('success')?>
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>
<?php elseif( $this->session->flashdata('error') ): ?>
<div class="content-wrapper">
  <div class="alert alert-warning alert-dismissible fade show" role="alert">
  <strong>Failed !</strong>  <?=$this->session->flashdata('error')?>
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>
<?php endif; ?>


  <div class="content-wrapper">
    <div class="row">
      <div class="col-xl-3 col-lg-3 col-md-3 col-sm-6 grid-margin stretch-card">
        <div class="card card-statistics">
          <div class="card-body">
            <div class="clearfix">
              <div class="float-left">
                <i class="mdi mdi-cube text-danger icon-lg"></i>
              </div>
              <div class="float-right">
                <p class="mb-0 text-right">Project</p>
                <div class="fluid-container">
                  <h3 class="font-weight-medium text-right mb-0">2</h3>
                </div>
              </div>
            </div>
            <p class="text-muted mt-3 mb-0">
              <i class="mdi mdi-alert-octagon mr-1" aria-hidden="true"></i> Total number of project
            </p>
          </div>
        </div>
      </div>
      <div class="col-xl-3 col-lg-3 col-md-3 col-sm-6 grid-margin stretch-card">
        <div class="card card-statistics">
          <div class="card-body">
            <div class="clearfix">
              <div class="float-left">
                <i class="mdi mdi-account-location text-info icon-lg"></i>
              </div>
              <div class="float-right">
                <p class="mb-0 text-right">Total Request</p>
                <div class="fluid-container">
                  <h3 class="font-weight-medium text-right mb-0">35</h3>
                </div>
              </div>
            </div>
            <p class="text-muted mt-3 mb-0">
              <i class="mdi mdi-alert-octagon mr-1" aria-hidden="true"></i> Total number of Request
            </p>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- content-wrapper ends -->
