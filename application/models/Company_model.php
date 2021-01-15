<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Company_model extends CI_Model
{
    //load database
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }
    public function get_allcompany()
    {
        $this->db->select('*');
        $this->db->from('company');
        $this->db->order_by('id', 'DESC');
        $query = $this->db->get();
        return $query->result();
    }
    public function get_company($limit, $start)
    {
        $this->db->select('*');
        $this->db->from('company');
        $this->db->order_by('id', 'DESC');
        $this->db->limit($limit, $start);
        $query = $this->db->get();
        return $query->result();
    }


    //Total Company Main Page
    public function total_row()
    {
        $this->db->select('*');
        $this->db->from('company');
        $this->db->order_by('id', 'DESC');
        $query = $this->db->get();
        return $query->result();
    }

    public function company_detail($id)
    {
        $this->db->select('*');
        $this->db->from('company');
        $this->db->where('id', $id);
        $query = $this->db->get();
        return $query->row();
    }
    //Kirim Data Company ke database
    public function create($data)
    {
        $this->db->insert('company', $data);
    }
    //Update Data
    public function update($data)
    {
        $this->db->where('id', $data['id']);
        $this->db->update('company', $data);
    }
    //Hapus Data Dari Database
    public function delete($data)
    {
        $this->db->where('id', $data['id']);
        $this->db->delete('company', $data);
    }


}
