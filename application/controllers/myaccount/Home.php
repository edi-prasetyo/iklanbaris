<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Home extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('user_model');
        $this->load->model('iklan_model');
    }

    public function index()
    {
        $id     = $this->session->userdata('id');
        $user   = $this->user_model->user_detail($id);

        $iklan_saya     = $this->iklan_model->total_iklan_user($id);
        $iklan_active   = $this->iklan_model->total_iklan_user_active($id);
        $iklan_pending  = $this->iklan_model->total_iklan_user_pending($id);

        $data = [
            'title'             => 'Home',
            'deskripsi'         => 'Deskripsi',
            'keywords'          => 'Keywords',
            'user'              => $user,
            'iklan_saya'        => $iklan_saya,
            'iklan_active'      => $iklan_active,
            'iklan_pending'     => $iklan_pending,
            'content'           => 'myaccount/profile/index_profile'
        ];

        $this->load->view('myaccount/layout/wrapp', $data, FALSE);
    }
}
