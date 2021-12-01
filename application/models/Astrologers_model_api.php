<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Astrologers_model_api extends CI_Model
{
    public function all()
    {
       return $this->db->get('astrologers')->result();
    }

    public function get($id) {
        return $this->db
            ->get_where('astrologers', ['id' => $id])
            ->row();
    }

    public function create($data)
    {
        $this->db->insert('astrologers', $data);
        return $this->db->insert_id();
    }

}
