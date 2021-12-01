<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class AuthAdmin extends CI_Controller {

public function __construct(){

        parent::__construct();
            $this->load->model('adminlogin_model');
        }

    public function index()
    {   
       $admin=$this->session->userdata('id');
       $adminname['admin_name']=$this->adminlogin_model->getusername($admin);
       $this->load->view('include/header',$adminname);
       $this->load->view('include/sidebar',$adminname);
       $this->load->view('dashboard');
       $this->load->view('include/footer');
       
       
        
    }
}