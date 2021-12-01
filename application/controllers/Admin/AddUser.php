<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class AddUser extends CI_Controller {

public function __construct(){

        parent::__construct();
            $this->load->model('adminlogin_model');
            $this->load->model('user_model');
        }

    public function index()
    {   
       $admin=$this->session->userdata('id');
       $adminname['admin_name']=$this->adminlogin_model->getusername($admin);
       $this->load->view('include/header',$adminname);
       $this->load->view('include/sidebar',$adminname);
       $this->load->view('adduser');
       $this->load->view('include/footer');
       
       
        
    }
  // add user function
  public function adduser(){
      $users = array(
               'name'=>$this->input->post('name'),
               'email'=>$this->input->post('email'),
               'mobile'=>$this->input->post('email'),
               'gender'=>$this->input->post('gender'),
               'status'=>$this->input->post('status')
            );
       $data['newuser']= $this->user_model->add_user($users);
       if($data['newuser']){
           $this->session->set_flashdata('msg','yes');
           redirect('admin/users');
       }    
  }  
}