<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Type_model extends CI_Model
{
    //load database
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }
    public function get_type()
    {
        $this->db->select('*');
        $this->db->from('type');
        $this->db->order_by('id', 'DESC');
        $query = $this->db->get();
        return $query->result();
    }
    public function get_type_blog()
    {
        $this->db->select('*');
        $this->db->from('type');
        $this->db->where('type_type', 'Blog');
        $this->db->order_by('id', 'DESC');
        $query = $this->db->get();
        return $query->result();
    }
    public function get_type_iklan($type_id)
    {
        $this->db->select('*');
        $this->db->from('type');
        $this->db->where(array(
          'id'            => $type_id
        ));
        $this->db->order_by('id', 'DESC');
        $query = $this->db->get();
          return $query->row();
    }

    public function get_type_sidebar()
    {
        $this->db->select('*');
        $this->db->from('type');
        $this->db->where('type_type', 'Blog');
        $this->db->order_by('id', 'DESC');
        $query = $this->db->get();
        return $query->result();
    }
    public function detail_type($id)
    {
        $this->db->select('*');
        $this->db->from('type');
        $this->db->where('id', $id);
        $this->db->order_by('id');
        $query = $this->db->get();
        return $query->row();
    }
    //Read Berita
    public function read($type_slug)
    {
        $this->db->select('*');
        $this->db->from('type');
        // Join

        //End Join
        $this->db->where(array(
            'type.type_slug'      =>  $type_slug
        ));
        $this->db->order_by('id', 'DESC');
        $query = $this->db->get();
        return $query->row();
    }

    public function create($data)
    {
        $this->db->insert('type', $data);
    }
    public function update($data)
    {
        $this->db->where('id', $data['id']);
        $this->db->update('type', $data);
    }
    //Delete Data
    public function delete($data)
    {
        $this->db->where('id', $data['id']);
        $this->db->delete('type', $data);
    }
}
