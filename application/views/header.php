<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->

<!-- Bootstrap library -->

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Metropolis</title>
  <!-- plugins:css -->
  <?=link_tag('vendors/iconfonts/mdi/css/materialdesignicons.min.css')?>
  <?=link_tag('vendors/css/vendor.bundle.base.css')?>
  <?=link_tag('vendors/css/vendor.bundle.addons.css')?>

  <!-- font awesome -->
  <?=link_tag('vendors/iconfonts/font-awesome/css/font-awesome.css')?>

  <!-- endinject -->
  <!-- plugin css for this page -->
  <!-- End plugin css for this page -->
  <!-- inject:css -->
    <?=link_tag('css/style.css')?>
  <!-- endinject -->
  <link rel="shortcut icon" href="<?=base_url('images/logo1.png')?>" />
  <script src="<?=base_url('js/jquery-3.3.1.min.js')?>"></script>
  <script src="<?=base_url('js/jquery.validate.js')?>"></script>
  <script src="<?=base_url('js/sweetalert.min.js')?>"></script>

  

  <style >
  .navbar.default-layout .navbar-brand-wrapper .navbar-brand img{
    width:100%;
    max-width: 100%;
    height: auto;
    margin: auto;
    vertical-align: middle;
  }

  .navbar.default-layout .navbar-brand-wrapper{
    background: #47984b;
  }

  .navbar.default-layout{
    background: linear-gradient(120deg, #00ce686e, #00994a);
  }

  

div.dataTables_wrapper div.dataTables_paginate {
     margin-left:30px;
  } 
 div.dataTables_wrapper div.dataTables_paginate a {
     color:black;
     margin-left:10px;
     white-space: nowrap;
     
  }  

div.dataTables_wrapper div.dataTables_length label {
    /*display: none;*/
    /*float : right;*/
    /*margin-top: -2%;*/
    
}

  .sidebar .nav.sub-menu .nav-item .nav-link.active{
    color: #00994b;
  }

  .sidebar .nav .nav-item.active > .nav-link{
    color: #00984a;
  }
 /* .paging_simple_numbers{
      display: inline-block;
    }
  .paging_simple_numbers a {
      color: black;
      float:left;
      position:relative; left:900px; 
      padding: 8px 12px;
      text-decoration: none;
      border-radius: 5px;
      font-size: 16px;
      transition: background-color .3s;

  }
  
  .paging_simple_numbers a:hover:not(.active) {background-color: #ddd;}

  .paging_simple_numbers a.active {
      background-color: #4CAF50;
      color: white;

      border-radius: 5px;
  }
  @media (max-width: 991px){
    .navbar.default-layout .navbar-brand-wrapper {
      width: 210px;
    
  }
  </style>
  <script>
    window.setInterval(keepAliveCall, 20000);
    function keepAliveCall(){
      var xhttp = new XMLHttpRequest();
      xhttp.onreadystatechange = function() {
          if (this.readyState == 4 && this.status == 200) {
            console.log( this.responseText );
          }
      };
      xhttp.open("POST", "<?=base_url('Api/updateSessionTime')?>", true);
      xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
      xhttp.send("zsc_id=1");

    }
  </script>
</head>

<body>
  <div class="container-scroller">
    <!-- partial:partials/_navbar.html -->
    <nav class="navbar default-layout col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
      <div class="text-center navbar-brand-wrapper d-flex align-items-top justify-content-center">
        <a class="navbar-brand brand-logo" href="<?=base_url()?>">
          <img src="<?=base_url('images/logo1.png')?>" alt="logo" />
        </a>
        <a class="navbar-brand brand-logo-mini" href="<?=base_url()?>">
          <img src="<?=base_url('images/logo1.png')?>" alt="logo" />
        </a>
      </div>
      <div class="navbar-menu-wrapper d-flex align-items-center">
        <!-- <ul class="navbar-nav navbar-nav-left header-links d-none d-md-flex">
          <li class="nav-item">
            <a href="#" class="nav-link">Schedule
              <span class="badge badge-primary ml-1">New</span>
            </a>
          </li>
          <li class="nav-item active">
            <a href="#" class="nav-link">
              <i class="mdi mdi-elevation-rise"></i>Reports</a>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="mdi mdi-bookmark-plus-outline"></i>Score</a>
          </li>
        </ul> -->
        <ul class="navbar-nav navbar-nav-right">
          <li class="nav-item dropdown">
            <!-- <a class="nav-link count-indicator dropdown-toggle" id="messageDropdown" href="#" data-toggle="dropdown" aria-expanded="false">
              <i class="mdi mdi-file-document-box"></i>
              <span class="count">7</span>
            </a> -->
            <!-- <div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list" aria-labelledby="messageDropdown">
              <div class="dropdown-item">
                <p class="mb-0 font-weight-normal float-left">You have 7 unread mails
                </p>
                <span class="badge badge-info badge-pill float-right">View all</span>
              </div>
              <div class="dropdown-divider"></div>
              <a class="dropdown-item preview-item">
                <div class="preview-thumbnail">
                  <img src="<?=base_url('images/faces/face4.jpg')?>" alt="image" class="profile-pic">
                </div>
                <div class="preview-item-content flex-grow">
                  <h6 class="preview-subject ellipsis font-weight-medium text-dark">David Grey
                    <span class="float-right font-weight-light small-text">1 Minutes ago</span>
                  </h6>
                  <p class="font-weight-light small-text">
                    The meeting is cancelled
                  </p>
                </div>
              </a>
              <div class="dropdown-divider"></div>
              <a class="dropdown-item preview-item">
                <div class="preview-thumbnail">
                  <img src="<?=base_url('images/faces/face2.jpg')?>" alt="image" class="profile-pic">
                </div>
                <div class="preview-item-content flex-grow">
                  <h6 class="preview-subject ellipsis font-weight-medium text-dark">Tim Cook
                    <span class="float-right font-weight-light small-text">15 Minutes ago</span>
                  </h6>
                  <p class="font-weight-light small-text">
                    New product launch
                  </p>
                </div>
              </a>
              <div class="dropdown-divider"></div>
              <a class="dropdown-item preview-item">
                <div class="preview-thumbnail">
                  <img src="<?=base_url('images/faces/face3.jpg')?>" alt="image" class="profile-pic">
                </div>
                <div class="preview-item-content flex-grow">
                  <h6 class="preview-subject ellipsis font-weight-medium text-dark"> Johnson
                    <span class="float-right font-weight-light small-text">18 Minutes ago</span>
                  </h6>
                  <p class="font-weight-light small-text">
                    Upcoming board meeting
                  </p>
                </div>
              </a>
            </div> -->
          </li>
          <li class="nav-item dropdown">
            <!-- <a class="nav-link count-indicator dropdown-toggle" id="notificationDropdown" href="#" data-toggle="dropdown">
              <i class="mdi mdi-bell"></i>
              <span class="count">4</span>
            </a> -->
            <div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list" aria-labelledby="notificationDropdown">
              <a class="dropdown-item">
                <p class="mb-0 font-weight-normal float-left">You have 4 new notifications
                </p>
                <span class="badge badge-pill badge-warning float-right">View all</span>
              </a>
              <div class="dropdown-divider"></div>
              <a class="dropdown-item preview-item">
                <div class="preview-thumbnail">
                  <div class="preview-icon bg-success">
                    <i class="mdi mdi-alert-circle-outline mx-0"></i>
                  </div>
                </div>
                <div class="preview-item-content">
                  <h6 class="preview-subject font-weight-medium text-dark">Application Error</h6>
                  <p class="font-weight-light small-text">
                    Just now
                  </p>
                </div>
              </a>
              <div class="dropdown-divider"></div>
              <a class="dropdown-item preview-item">
                <div class="preview-thumbnail">
                  <div class="preview-icon bg-warning">
                    <i class="mdi mdi-comment-text-outline mx-0"></i>
                  </div>
                </div>
                <div class="preview-item-content">
                  <h6 class="preview-subject font-weight-medium text-dark">Settings</h6>
                  <p class="font-weight-light small-text">
                    Private message
                  </p>
                </div>
              </a>
              <div class="dropdown-divider"></div>
              <a class="dropdown-item preview-item">
                <div class="preview-thumbnail">
                  <div class="preview-icon bg-info">
                    <i class="mdi mdi-email-outline mx-0"></i>
                  </div>
                </div>
                <div class="preview-item-content">
                  <h6 class="preview-subject font-weight-medium text-dark">New user registration</h6>
                  <p class="font-weight-light small-text">
                    2 days ago
                  </p>
                </div>
              </a>
            </div>
          </li>
          <li class="nav-item dropdown d-none d-xl-inline-block">
            <a class="nav-link dropdown-toggle" id="UserDropdown" href="#" data-toggle="dropdown" aria-expanded="false">
              <span class="profile-text">Hello, <?=$this->session->userdata('log_user')['username']?>!</span>
              <img class="img-xs rounded-circle" src="<?=base_url('images/faces/face1.jpg')?>" alt="Profile image">
            </a>
            <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="UserDropdown">
              <a class="dropdown-item p-0">
                <div class="d-flex border-bottom">
                  <div class="py-3 px-4 d-flex align-items-center justify-content-center">
                    <i class="mdi mdi-bookmark-plus-outline mr-0 text-gray"></i>
                  </div>
                  <div class="py-3 px-4 d-flex align-items-center justify-content-center border-left border-right">
                    <i class="mdi mdi-account-outline mr-0 text-gray"></i>
                  </div>
                  <div class="py-3 px-4 d-flex align-items-center justify-content-center">
                    <i class="mdi mdi-alarm-check mr-0 text-gray"></i>
                  </div>
                </div>
              </a>
              <!-- <a class="dropdown-item mt-2">
                Manage Accounts
              </a> -->
              <!-- <a class="dropdown-item">
                Change Password
              </a> -->
              <!-- <a class="dropdown-item">
                Check Inbox
              </a> -->
              <a href="<?=base_url('Login/logout') ?>" class="dropdown-item">
                Sign Out
              </a>
            </div>
          </li>
        </ul>
        <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas">
          <span class="mdi mdi-menu"></span>
        </button>
      </div>
    </nav>
    <!-- partial -->

    <!-- partial -->
    <div class="container-fluid page-body-wrapper">
