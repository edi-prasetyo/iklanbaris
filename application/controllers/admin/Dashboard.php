<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('user_model');
        $this->load->model('berita_model');
        $this->load->model('iklan_model');
    }

    public function index()
    {

        $list_user              = $this->user_model->user_dashboard();
        $berita                 = $this->berita_model->get_allberita();
        $count_iklan            = $this->iklan_model->count_iklan();
        $iklan_terbaru          = $this->iklan_model->iklan_dashboard();


        $data = [
            'title'             => 'Dashboard',
            'list_user'         => $list_user,
            'count_iklan'       => $count_iklan,
            'iklan_terbaru'     => $iklan_terbaru,
            'berita'            => $berita,
            'content'           => 'admin/dashboard/dashboard'

        ];

        $this->load->view('admin/layout/wrapp', $data, FALSE);
    }
}
