<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Package_model extends CI_Model
{
    //load database
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }
    public function get_package()
    {
        $this->db->select('*');
        $this->db->from('package');
        $this->db->order_by('id', 'DESC');
        $query = $this->db->get();
        return $query->result();
    }

    public function get_allpackage($limit, $start)
    {
        $this->db->select('*');
        $this->db->from('package');
        $this->db->order_by('id', 'DESC');
        $this->db->limit($limit, $start);
        $query = $this->db->get();
        return $query->result();
    }


    public function detail_package($id)
    {
        $this->db->select('*');
        $this->db->from('package');
        $this->db->where('id', $id);
        $this->db->order_by('id');
        $query = $this->db->get();
        return $query->row();
    }
    //Read Berita
    public function read($package_slug)
    {
        $this->db->select('*');
        $this->db->from('package');
        // Join

        //End Join
        $this->db->where(array(
            'package.package_slug'      =>  $package_slug
        ));
        $this->db->order_by('id', 'DESC');
        $query = $this->db->get();
        return $query->row();
    }

    public function create($data)
    {
        $this->db->insert('package', $data);
    }
    public function update($data)
    {
        $this->db->where('id', $data['id']);
        $this->db->update('package', $data);
    }
    //Delete Data
    public function delete($data)
    {
        $this->db->where('id', $data['id']);
        $this->db->delete('package', $data);
    }

    // Row
    public function total_row()
    {
        $this->db->select('*');
        $this->db->from('package');
        $this->db->order_by('id', 'DESC');
        $query = $this->db->get();
        return $query->result();
    }
}
