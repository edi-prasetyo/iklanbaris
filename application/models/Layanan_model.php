<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Layanan_model extends CI_Model
{
    //load database
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }
    public function get_layanan()
    {
        $this->db->select('*');
        $this->db->from('layanan');
        $this->db->order_by('id', 'DESC');
        $query = $this->db->get();
        return $query->result();
    }
    public function get_layanan_blog()
    {
        $this->db->select('*');
        $this->db->from('layanan');
        $this->db->where('layanan_type', 'Blog');
        $this->db->order_by('id', 'DESC');
        $query = $this->db->get();
        return $query->result();
    }
    public function get_layanan_iklan($layanan_id)
    {
        $this->db->select('*');
        $this->db->from('layanan');
        $this->db->where(array(
            'id'            => $layanan_id
        ));
        $this->db->order_by('id', 'DESC');
        $query = $this->db->get();
        return $query->row();
    }

    public function get_layanan_sidebar()
    {
        $this->db->select('*');
        $this->db->from('layanan');
        $this->db->where('layanan_type', 'Blog');
        $this->db->order_by('id', 'DESC');
        $query = $this->db->get();
        return $query->result();
    }
    public function detail_layanan($id)
    {
        $this->db->select('*');
        $this->db->from('layanan');
        $this->db->where('id', $id);
        $this->db->order_by('id');
        $query = $this->db->get();
        return $query->row();
    }
    //Read Berita
    public function read($layanan_slug)
    {
        $this->db->select('*');
        $this->db->from('layanan');
        // Join

        //End Join
        $this->db->where(array(
            'layanan.layanan_slug'      =>  $layanan_slug
        ));
        $this->db->order_by('id', 'DESC');
        $query = $this->db->get();
        return $query->row();
    }

    public function create($data)
    {
        $this->db->insert('layanan', $data);
    }
    public function update($data)
    {
        $this->db->where('id', $data['id']);
        $this->db->update('layanan', $data);
    }
    //Delete Data
    public function delete($data)
    {
        $this->db->where('id', $data['id']);
        $this->db->delete('layanan', $data);
    }
}
