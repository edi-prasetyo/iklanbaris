<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Images_model extends CI_Model
{
    //load database
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }
    public function get_alliklan()
    {
        $this->db->select('*');
        $this->db->from('images');
        $this->db->order_by('id', 'DESC');
        $query = $this->db->get();
        return $query->result();
    }

    public function gambar_iklan($id)
    {
        $this->db->select('*');
        $this->db->from('images');
        $this->db->where('iklan_id', $id);
        $query = $this->db->get();
        return $query->result();
    }

    //Kirim Data Berita ke database
    public function create($data)
    {
        $this->db->insert('images', $data);
        $insert_id = $this->db->insert_id();
        return $insert_id;
    }
    //Update Data
    public function update($data)
    {
        $this->db->where('id', $data['id']);
        $this->db->update('images', $data);
    }
    //Hapus Data Dari Database
    public function delete($data)
    {
        $this->db->where('id', $data['id']);
        $this->db->delete('images', $data);
    }

    public function images_iklan($iklan_id)
    {
        $this->db->select('*');
        $this->db->from('images');
        $this->db->where('iklan_id', $iklan_id);
        $query = $this->db->get();
        return $query->result();
    }
}
