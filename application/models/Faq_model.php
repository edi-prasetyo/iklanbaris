<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Faq_model extends CI_Model
{
    //load database
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }
    public function get_faq()
    {
        $this->db->select('*');
        $this->db->from('faq');
        $this->db->order_by('id', 'DESC');
        $query = $this->db->get();
        return $query->result();
    }

    public function detail_faq($id)
    {
        $this->db->select('*');
        $this->db->from('faq');
        $this->db->where('id', $id);
        $this->db->order_by('id');
        $query = $this->db->get();
        return $query->row();
    }
    //Read Berita
    public function read($faq_slug)
    {
        $this->db->select('*');
        $this->db->from('faq');
        // Join

        //End Join
        $this->db->where(array(
            'faq.faq_slug'      =>  $faq_slug
        ));
        $this->db->order_by('id', 'DESC');
        $query = $this->db->get();
        return $query->row();
    }

    public function create($data)
    {
        $this->db->insert('faq', $data);
    }
    public function update($data)
    {
        $this->db->where('id', $data['id']);
        $this->db->update('faq', $data);
    }
    //Delete Data
    public function delete($data)
    {
        $this->db->where('id', $data['id']);
        $this->db->delete('faq', $data);
    }

    //Total Berita Main Faq
    public function total_row()
    {
        $this->db->select('*');
        $this->db->from('faq');
        $this->db->order_by('id', 'DESC');
        $query = $this->db->get();
        return $query->result();
    }
}
