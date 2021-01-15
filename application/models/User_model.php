<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User_model extends CI_Model
{
    //load database
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }
    //listing Pendaftaran
    public function listUser()
    {
        $this->db->select('*');
        $this->db->from('user');
        $this->db->order_by('id', 'DESC');
        $query = $this->db->get();
        return $query->result();
    }
    public function user_dashboard()
    {
        $this->db->select('*');
        $this->db->from('user');
        $this->db->limit(4);
        $this->db->order_by('id', 'DESC');
        $query = $this->db->get();
        return $query->result();
    }

    public function user_detail($id)
    {
        $this->db->select('user.*, company.company_name, user_role.role');
        $this->db->from('user');
        // Join
        $this->db->join('company', 'company.id = user.company_id', 'LEFT');
        $this->db->join('user_role', 'user_role.id = user.role_id', 'LEFT');
        // End Join
        $this->db->where(array(
            'user.email'    => $this->session->userdata('email')
        ));
        $query = $this->db->get();
        return $query->row();
    }
    public function user_premium_detail($user_id)
    {
        $this->db->select('user.*, company.company_name, user_role.role');
        $this->db->from('user');
        // Join
        $this->db->join('company', 'company.id = user.company_id', 'LEFT');
        $this->db->join('user_role', 'user_role.id = user.role_id', 'LEFT');
        // End Join
        $this->db->where(array(
            'user.email'    => $this->session->userdata('email'),
            'user.id'            => $user_id,
        ));
        $query = $this->db->get();
        return $query->row();
    }
    public function update($data)
    {
        $this->db->where('id', $data['id']);
        $this->db->update('user', $data);
    }

    public function get_user_iklan()
    {
        $this->db->select('*');
        $this->db->from('user');
        $this->db->order_by('id', 'DESC');
        $query = $this->db->get();
        return $query->result();
    }

    // Dashboard



    public function user_member($limit, $start)
    {
        $this->db->select('*');
        $this->db->from('user');
        $this->db->where('role_id', 5);
        $this->db->order_by('id', 'DESC');
        $this->db->limit($limit, $start);
        $query = $this->db->get();
        return $query->result();
    }

    // Product User Read
    public function read($username)
    {
        $this->db->select('*');
        $this->db->from('user');
        $this->db->where('username', $username);
        $this->db->order_by('id');
        $query = $this->db->get();
        return $query->row();
    }

    // Update Post Count
    public function update_post_count($id)
    {
        $this->db->where('id', $id);
        $this->db->select('post_count');
        $count = $this->db->get('user')->row();
        // then increase by one
        $this->db->where('id', $id);
        $this->db->set('post_count', ($count->post_count - 1));
        $this->db->update('user');
    }
    // Update Premium Count
    public function update_premium_count($user_id)
    {
        $this->db->where('id', $user_id);
        $this->db->select('premium_count');
        $count = $this->db->get('user')->row();
        // then increase by one
        $this->db->where('id', $user_id);
        $this->db->set('premium_count', ($count->premium_count - 1));
        $this->db->update('user');
    }
    // Total Row pagination
    //Total Berita Main Page
    public function total_row()
    {
        $this->db->select('*');
        $this->db->from('user');
        $this->db->order_by('id', 'DESC');
        $query = $this->db->get();
        return $query->result();
    }
}
