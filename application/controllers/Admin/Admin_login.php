<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_login extends CI_Controller {

    public function __construct(){

        parent::__construct();
        $this->load->helper('url');
        $this->load->library('session','flash');
        $this->load->model('adminlogin_model');
    }

    public function index(){   
        $this->load->view('login');

    }

    public function adminlogin(){	
        $this->form_validation->set_rules('email', 'Email Address', 'required');
        $this->form_validation->set_rules('password','Password','required');
        if($this->form_validation->run()){
        $email= $this->input->post('email'); 
        $password= $this->input->post('password');  
        $encryptpassword=md5($password);                        
        $data['result'] = $this->adminlogin_model->adminlogin($email,$encryptpassword);
            if($data['result']['id'] == null){
            $this->session->set_flashdata('message','<div class="alert alert-danger">Wrong username or Password!</div>'); 
            redirect('admin/admin_login');	
            $this->session->set_userdata('adminlogin',false);
            }else{	
            $this->session->set_userdata('id',$data['result']['id']);
            $this->session->set_userdata('adminlogin',true);
        redirect('admin/authadmin');		
            }
        }else{
        $this->index();
    }	
    }
}