<?php

class Site extends CI_Controller{
    
    public function index(){
      $this->home();  
    }
    
    
    public function home(){
        $this->load->view('Header');
        $this->load->view('Nav');
        $this->load->view('ContentHome');
        $this->load->view('Footer');
    } 
    
    public function displayResults()
    {
        $data['result'] = $_POST['results'];
        //var_dump($data);
        
        //$this->load->view('Header');
        //$this->load->view('Nav');
        $page = $this->load->view('ContentDisplaySearch', $_POST, TRUE);
        //$this->load->view('Footer');
        echo $page;
    }
    
    
}