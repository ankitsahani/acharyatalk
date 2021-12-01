<?php
class Adminlogin_model extends CI_Model
{

function __construct()
{
parent::__construct();
$this->load->database();
}

//FOR LOGIN 
    public function adminlogin($email,$encryptpassword){
        $this->db->select('*');
        $this->db->from('admin_login');
        $this->db->where('email',$email);
        $this->db->where('password',$encryptpassword);
        $query=$this->db->get();
        if($query)
        {
           return $query->row_array();
        }
        else{
            return false;
        }  
        
    }
    public function getusername($admin){
        $this->db->select('*');
        $this->db->from('admin_login');
        $this->db->where('id',$admin);
        $query=$this->db->get();
        if($query){
            return $query->row_array();
        }else{
            return false;
        }
    }

}