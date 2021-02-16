<?php

  defined('BASEPATH') OR exit('No direct script access allowed');

   class Track extends CI_Controller
   {

    public function __construct(){
      parent::__construct();
    }

    public function trackRequest(){
      $this->load->view('track/requestTrack');
    }

   }













 ?>
