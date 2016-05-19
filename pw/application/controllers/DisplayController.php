<?php

class DisplayController extends CI_Controller{
    
    public function index(){
      $this->load->view('DisplayView');
    }   
}