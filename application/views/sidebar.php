<?php
    $sidebar = $this->config->item('sidebar');
    // echo "<pre>"; print_r(); echo "</pre>";
    if($this->session->userdata('log_user')['type']=='1'){
      $admin = $sidebar['superadmin'];
    }
    elseif($this->session->userdata('log_user')['type']=='2') {
        $admin = $sidebar['mhl'];
    }
    elseif($this->session->userdata('log_user')['type']=='3') {
        $admin = $sidebar['project_manager'];
    }
    elseif ( $this->session->userdata('log_user')['type']=='4' ) {
        $admin = $sidebar['project_cordinate'];
    }
    elseif ( $this->session->userdata('log_user')['type']=='5' ) {
        $admin = $sidebar['call_center'];
    }
    elseif ( $this->session->userdata('log_user')['type']=='6' ||  $this->session->userdata('log_user')['type']=='15' ) {
      $admin = $sidebar['phelbotomist'];
    }
    elseif ( $this->session->userdata('log_user')['type']=='7' ) {
      $admin = $sidebar['sister_lab'];
    }
    elseif ( $this->session->userdata('log_user')['type']=='8' ) {
      $admin = $sidebar['business_head'];
    }
    elseif ( $this->session->userdata('log_user')['type']=='9' ) {
      $admin = $sidebar['zonal_manager'];
    }
    elseif ( $this->session->userdata('log_user')['type']=='10' ) {
      $admin = $sidebar['manager'];
    }
    elseif ( $this->session->userdata('log_user')['type']=='11' ) {
      $admin = $sidebar['requestor'];
    }
    elseif ( $this->session->userdata('log_user')['type']=='12' ) {
      $admin = $sidebar['grl_lab'];
    }
    elseif ( $this->session->userdata('log_user')['type']=='16' || $this->session->userdata('log_user')['type']=='19' ) {
      $admin = $sidebar['logistic'];
    }
    else{
      $admin = [];
    }

 ?>


 <!-- partial:partials/_sidebar.html -->
   <nav class="sidebar sidebar-offcanvas" id="sidebar">
     <ul class="nav">
       <li class="nav-item nav-profile">
         <div class="nav-link">
           <div class="user-wrapper">
             <div class="profile-image">
               <img src="<?=base_url('images/faces/face1.jpg')?>" alt="profile image">
             </div>
             <div class="text-wrapper">
               <p class="profile-name"><?=$this->session->userdata('log_user')['username']?></p>
               <div>
                 <small class="designation text-muted"><?=$this->session->userdata('log_user')['label']?></small>
                 <span class="status-indicator online"></span>
               </div>
             </div>
           </div>
           <?php if ( $this->session->userdata('log_user')['type']=='2' ): ?>
               <a href="<?=base_url('Project')?>"class="btn btn-success btn-block">New Project
                 <i class="mdi mdi-plus"></i>
               </a>
           <?php endif; ?>
         </div>
       </li>
       <?php foreach ($admin as $key => $value) : ?>
          <?php if($value['isSubmenu'] ): ?>
            <li class="nav-item">
              <a class="nav-link" data-toggle="collapse" href="#<?=$value['id']?>" aria-expanded="false" aria-controls="<?=$value['id'] ?>">
                <i class="<?=$value['icon']?>"></i>
                <span class="menu-title"><?=$key?></span>
                <i class="menu-arrow"></i>
              </a>
              <div class="collapse" id="<?=$value['id'] ?>">
                <ul class="nav flex-column sub-menu">
                  <?php foreach ($value['url'] as $urlKey => $urlValue): ?>
                    <li class="nav-item">
                      <a class="nav-link" href="<?=base_url($urlValue)?>"><?=$urlKey?></a>
                    </li>
                  <?php endforeach; ?>
                </ul>
              </div>
            </li>
         <?php else: ?>
           <li class="nav-item">
             <a class="nav-link" href="<?=base_url($value['url'])?>">
               <i class="<?=$value['icon']?>"></i>
               <span class="menu-title"><?=$key?></span>
             </a>
           </li>
         <?php endif; ?>
       <?php endforeach; ?>
       <!-- <li class="nav-item">
         <a class="nav-link" href="pages/forms/basic_elements.html">
           <i class="menu-icon mdi mdi-backup-restore"></i>
           <span class="menu-title">Form elements</span>
         </a>
       </li> -->
       <!-- <li class="nav-item">
         <a class="nav-link" href="pages/charts/chartjs.html">
           <i class="menu-icon mdi mdi-chart-line"></i>
           <span class="menu-title">Charts</span>
         </a>
       </li> -->
       <!-- <li class="nav-item">
         <a class="nav-link" href="pages/tables/basic-table.html">
           <i class="menu-icon mdi mdi-table"></i>
           <span class="menu-title">Tables</span>
         </a>
       </li> -->
       <!-- <li class="nav-item">
         <a class="nav-link" href="pages/icons/font-awesome.html">
           <i class="menu-icon mdi mdi-sticker"></i>
           <span class="menu-title">Icons</span>
         </a>
       </li> -->
       <!-- <li class="nav-item">
         <a class="nav-link" data-toggle="collapse" href="#auth" aria-expanded="false" aria-controls="auth">
           <i class="menu-icon mdi mdi-restart"></i>
           <span class="menu-title">User Pages</span>
           <i class="menu-arrow"></i>
         </a>
         <div class="collapse" id="auth">
           <ul class="nav flex-column sub-menu">
             <li class="nav-item">
               <a class="nav-link" href="pages/samples/blank-page.html"> Blank Page </a>
             </li>
             <li class="nav-item">
               <a class="nav-link" href="pages/samples/login.html"> Login </a>
             </li>
             <li class="nav-item">
               <a class="nav-link" href="pages/samples/register.html"> Register </a>
             </li>
             <li class="nav-item">
               <a class="nav-link" href="pages/samples/error-404.html"> 404 </a>
             </li>
             <li class="nav-item">
               <a class="nav-link" href="pages/samples/error-500.html"> 500 </a>
             </li>
           </ul>
         </div>
       </li> -->
     </ul>
   </nav>
   <!-- partial -->

   <div class="main-panel">


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
