<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Home extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('user_model');
        $this->load->model('property_model');
    }

    public function index()
    {
        $id = $this->session->userdata('id');
        $user = $this->user_model->user_detail($id);

        $total_property = $this->property_model->total_property_user($id);
        $property_active = $this->property_model->total_active_user($id);
        $property_inactive = $this->property_model->total_inactive_user($id);

        $data = [
            'title'             => 'Home',
            'deskripsi'         => 'Deskripsi',
            'keywords'          => 'Keywords',
            'user'              => $user,
            'total_property'   => $total_property,
            'property_active'   => $property_active,
            'property_inactive'   => $property_inactive,
            'content'           => 'myaccount/home/index'
        ];

        $this->load->view('myaccount/layout/wrapp', $data, FALSE);
    }
}
