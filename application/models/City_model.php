<?php
defined('BASEPATH') or exit('No direct script access allowed');

class City_model extends CI_Model
{
    //load database
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }
    public function get_city()
    {
        $this->db->select('*');
        $this->db->from('city');
        $this->db->order_by('id', 'DESC');
        $query = $this->db->get();
        return $query->result();
    }

    public function get_city_iklan($city_id)
    {
        $this->db->select('*');
        $this->db->from('city');
        $this->db->where(array(
          'id'            => $city_id
        ));
        $this->db->order_by('id', 'DESC');
        $query = $this->db->get();
          return $query->row();
    }


    public function detail_city($id)
    {
        $this->db->select('*');
        $this->db->from('city');
        $this->db->where('id', $id);
        $this->db->order_by('id');
        $query = $this->db->get();
        return $query->row();
    }
    //Read Berita
    public function read($city_slug)
    {
        $this->db->select('*');
        $this->db->from('city');
        // Join

        //End Join
        $this->db->where(array(
            'city.city_slug'      =>  $city_slug
        ));
        $this->db->order_by('id', 'DESC');
        $query = $this->db->get();
        return $query->row();
    }

    public function create($data)
    {
        $this->db->insert('city', $data);
    }
    public function update($data)
    {
        $this->db->where('id', $data['id']);
        $this->db->update('city', $data);
    }
    //Delete Data
    public function delete($data)
    {
        $this->db->where('id', $data['id']);
        $this->db->delete('city', $data);
    }
    public function delete_byprovince($data)
    {
        $this->db->where('province_id', $data['province_id']);
        $this->db->delete('city', $data);
    }

    public function city_by_province($id)
    {
      $this->db->select('*');
      $this->db->from('city');
      $this->db->where('province_id',$id);
      $this->db->order_by('city.id','ASC');
      $query = $this->db->get();
      return $query->result();
    }


}
