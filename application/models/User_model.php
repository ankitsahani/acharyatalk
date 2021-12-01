<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User_Model extends CI_Model
{
    public function allUsers()
    {
       // return $this->db->get('users')->result();
       $this->db->select('*');
       $this->db->from('users');
       $this->db->where('user_type', 'user');
       $result = $this->db->get()->result();
       return $result;
    }

  //user edit function
   public function editUser($data){
       $this->db->where('id',$data['id']);
       return $this->db->update('users',$data);

   }


   //user delete function 
    public function deleteuser($id) 
    {
        $this->db->where('id', $id);
        return $this->db->delete('users');
    }

    //add user functio
    public function add_user($users){
        return $this->db->insert('users',$users);
    }

    // get astrologer 
    public function allAstrologer()
    {
       $this->db->select('*');
       $this->db->from('users');
       $this->db->where('user_type', 'astrologer');
       $result = $this->db->get()->result();
       return $result;
    }
}
