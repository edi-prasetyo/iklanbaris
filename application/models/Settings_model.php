<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Settings_model extends CI_Model
{
    //load database
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }
    public function get_settings()
    {
        $query = $this->db->get('settings');
        return $query->row();
    }
    public function detail_settings($id)
    {
        $this->db->select('*');
        $this->db->from('settings');
        $this->db->where('id', $id);
        $query = $this->db->get();
        return $query->row();
    }
    public function update($data)
    {
        $this->db->where('id', $data['id']);
        $this->db->update('settings', $data);
    }
}
