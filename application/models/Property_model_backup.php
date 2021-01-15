<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Property_model extends CI_Model
{
    //load database
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }
    public function get_allproperty()
    {
        $this->db->select('*');
        $this->db->from('property');
        $this->db->order_by('id', 'DESC');
        $query = $this->db->get();
        return $query->result();
    }

    public function get_property($limit, $start)
    {
        $this->db->select('property.*, user.user_name, user.user_image');
        $this->db->from('property');
        // Join
        $this->db->join('user', 'user.id = property.user_id', 'LEFT');
        //End Join
        $this->db->limit($limit, $start);
        $this->db->order_by('id', 'DESC');
        $query = $this->db->get();
        return $query->result();
    }

    public function get_property_user($limit, $start, $id)
    {
        $this->db->select('*');
        $this->db->from('property');
        $this->db->where('user_id', $id);
        $this->db->order_by('id', 'DESC');
        $this->db->limit($limit, $start);
        $query = $this->db->get();
        return $query->result();
    }

    public function total_row_user()
    {
        $this->db->select('*');
        $this->db->from('property');
        $this->db->order_by('id', 'DESC');
        $query = $this->db->get();
        return $query->result();
    }

    public function total_row()
    {
        $this->db->select('*');
        $this->db->from('property');
        $this->db->order_by('id', 'DESC');
        $query = $this->db->get();
        return $query->result();
    }

    public function property_detail($id)
    {
        $this->db->select('*');
        $this->db->from('property');
        $this->db->where('id', $id);
        $query = $this->db->get();
        return $query->row();
    }
    //Kirim Data Berita ke database
    public function create($data)
    {
          $this->db->insert('property', $data);
          $insert_id = $this->db->insert_id();
          return $insert_id;
    }
    //Update Data
    public function update($data)
    {
        $this->db->where('id', $data['id']);
        $this->db->update('property', $data);
    }
    //Hapus Data Dari Database
    public function delete($data)
    {
        $this->db->where('id', $data['id']);
        $this->db->delete('property', $data);
    }

}
