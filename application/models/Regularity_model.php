<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Regularity_model extends CI_Model
{
    //load database
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }
    public function get_regularity()
    {
        $this->db->select('*');
        $this->db->from('regularity');
        $this->db->order_by('id', 'DESC');
        $query = $this->db->get();
        return $query->result();
    }
    public function get_regularity_blog()
    {
        $this->db->select('*');
        $this->db->from('regularity');
        $this->db->where('regularity_type', 'Blog');
        $this->db->order_by('id', 'DESC');
        $query = $this->db->get();
        return $query->result();
    }
    public function get_regularity_iklan($regularity_id)
    {
        $this->db->select('*');
        $this->db->from('regularity');
        $this->db->where(array(
            'id'            => $regularity_id
        ));
        $this->db->order_by('id', 'DESC');
        $query = $this->db->get();
        return $query->row();
    }

    public function get_regularity_sidebar()
    {
        $this->db->select('*');
        $this->db->from('regularity');
        $this->db->where('regularity_type', 'Blog');
        $this->db->order_by('id', 'DESC');
        $query = $this->db->get();
        return $query->result();
    }
    public function detail_regularity($id)
    {
        $this->db->select('*');
        $this->db->from('regularity');
        $this->db->where('id', $id);
        $this->db->order_by('id');
        $query = $this->db->get();
        return $query->row();
    }
    //Read Berita
    public function read($regularity_slug)
    {
        $this->db->select('*');
        $this->db->from('regularity');
        // Join

        //End Join
        $this->db->where(array(
            'regularity.regularity_slug'      =>  $regularity_slug
        ));
        $this->db->order_by('id', 'DESC');
        $query = $this->db->get();
        return $query->row();
    }

    public function create($data)
    {
        $this->db->insert('regularity', $data);
    }
    public function update($data)
    {
        $this->db->where('id', $data['id']);
        $this->db->update('regularity', $data);
    }
    //Delete Data
    public function delete($data)
    {
        $this->db->where('id', $data['id']);
        $this->db->delete('regularity', $data);
    }

    //Total Berita Main Regularity
    public function total_row()
    {
        $this->db->select('*');
        $this->db->from('regularity');
        $this->db->order_by('id', 'DESC');
        $query = $this->db->get();
        return $query->result();
    }
}
