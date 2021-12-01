<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Users extends CI_Controller {

public function __construct(){

        parent::__construct();
            $this->load->helper('url');
            $this->load->library('session');
            $this->load->model('user_model');
            $this->load->model('adminlogin_model');
           
        }

    public function index()
    {   
       $data['user_list'] = $this->user_model->allUsers();
       $data['astrologer_list'] = $this->user_model->allAstrologer();
       $admin=$this->session->userdata('id');
       $adminname['admin_name']=$this->adminlogin_model->getusername($admin);
       $this->load->view('include/header',$adminname);
       $this->load->view('include/sidebar',$adminname);
       $this->load->view('user',$data);
       $this->load->view('include/footer');
        
    }

    //all astrologer show
    public function astrologer(){
        $data['astrologer_list'] = $this->user_model->allAstrologer();
        $admin=$this->session->userdata('id');
       $adminname['admin_name']=$this->adminlogin_model->getusername($admin);
       $this->load->view('include/header',$adminname);
       $this->load->view('include/sidebar',$adminname);
       $this->load->view('astrologer',$data);
       $this->load->view('include/footer');
       
    }
  // user edit function 
    public function userEdit(){
       $data=array(
                'id'=>$this->input->post('id'),
                'name'=> $this->input->post('name'),
                'email'=>$this->input->post('email'),
                'mobile'=>$this->input->post('mobile'),
                'gender'=>$this->input->post('gender'),
                'status'=>$this->input->post('status')
       );
        $editdata['userdata']= $this->user_model->editUser($data); 
        
        if($editdata['userdata']==true){
            $this->session->set_flashdata('msg','yes');
           // exit;
            redirect('admin/users');
        }  

   }
  
    // edit astrologer

    public function astrologerEdit(){
        $data=array(
                 'id'=>$this->input->post('id'),
                 'name'=> $this->input->post('name'),
                 'email'=>$this->input->post('email'),
                 'mobile'=>$this->input->post('mobile'),
                 'gender'=>$this->input->post('gender'),
                 'status'=>$this->input->post('status')
        );
         $editdata['userdata']= $this->user_model->editUser($data); 
         
         if($editdata['userdata']==true){
             $this->session->set_flashdata('msg','yes');
            // exit;
             redirect('admin/users/astrologer');
         }  
 
    }



  //user delete function
    public function userDelete($id){
        $data['user_list']=$this->user_model->deleteuser($id);
        if ($data['user_list'] == true) {
            $this->session->set_flashdata('success', 'true');
            redirect('admin/users');
        }


    }

    //astrologer delete
    //user delete function
    public function astrologerDelete($id){
        $data['user_list']=$this->user_model->deleteuser($id);
        if ($data['user_list'] == true) {
            $this->session->set_flashdata('success', 'true');
            redirect('admin/users/astrologer');
        }


    }
 
}