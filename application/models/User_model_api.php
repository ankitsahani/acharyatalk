<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User_Model_api extends CI_Model
{
    public function user_login($email)
    {
        $this->db->group_start();
        $this->db->where('email', $email)->or_where('mobile', $email);
        $this->db->group_end();
        //$this->db->where('password',md5($password));
        $result = $this->db->get('users')->row();
        if($result){
            return $result;
        }else{
            return 0;
        }
    }
    public function check_user_exist($email)
    {
        $this->db->group_start();
        $this->db->where('email', $email)->or_where('mobile', $email);
        $this->db->group_end();
        $this->db->from('users');
        $query= $this->db->get();
        if($query->num_rows() > 0){
          return true;
        }else{
             return false;
        }
    }

    public function insert_user($data) {
        $this->db->insert('users', $data);
        $result = $this->db->insert_id();

        if ($result) {
            return $result;
        } else {
            return 0;
        }
        
    }
    public function allUsers()
    {
        return $this->db->get('users')->result();
    }

    public function getUsers($id) {
        return $this->db
            ->get_where('users', ['id' => $id])
            ->row();
    }
}
