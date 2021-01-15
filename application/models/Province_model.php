<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Province_model extends CI_Model
{
    //load database
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }
    public function get_province()
    {
        $this->db->select('*');
        $this->db->from('province');
        $this->db->order_by('id', 'DESC');
        $query = $this->db->get();
        return $query->result();
    }

    public function get_allprovince($limit, $start)
    {
        $this->db->select('*');
        $this->db->from('province');
        $this->db->order_by('id', 'DESC');
        $this->db->limit($limit, $start);
        $query = $this->db->get();
        return $query->result();
    }


    public function detail_province($id)
    {
        $this->db->select('*');
        $this->db->from('province');
        $this->db->where('id', $id);
        $this->db->order_by('id');
        $query = $this->db->get();
        return $query->row();
    }
    //Read Berita
    public function read($province_slug)
    {
        $this->db->select('*');
        $this->db->from('province');
        // Join

        //End Join
        $this->db->where(array(
            'province.province_slug'      =>  $province_slug
        ));
        $this->db->order_by('id', 'DESC');
        $query = $this->db->get();
        return $query->row();
    }

    public function create($data)
    {
        $this->db->insert('province', $data);
    }
    public function update($data)
    {
        $this->db->where('id', $data['id']);
        $this->db->update('province', $data);
    }
    //Delete Data
    public function delete($data)
    {
        $this->db->where('id', $data['id']);
        $this->db->delete('province', $data);
    }

    // Row
    public function total_row()
    {
        $this->db->select('*');
        $this->db->from('province');
        $this->db->order_by('id', 'DESC');
        $query = $this->db->get();
        return $query->result();
    }
}
