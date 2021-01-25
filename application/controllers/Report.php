<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Report extends CI_Controller
{
    //load data
    public function __construct()
    {
        parent::__construct();
        $this->load->library('pagination');
        $this->load->model('report_model');
    }
    //Index Report
    public function index()
    {
        //Validasi
        $this->form_validation->set_rules(
            'report_desc',
            'Deskripsi',
            'required',
            array(
                'required'         => '%s Harus Diisi'
            )
        );
        if ($this->form_validation->run() === FALSE) {
            $data = [
                'title'             => 'Report',
                'content'          => 'front/report/report'
            ];
            $this->load->view('front/layout/wrapp', $data, FALSE);
        } else {

            $data  = [
                'user_id'           => $this->session->userdata('id'),
                'iklan_id'          => $this->input->post('iklan_id'),
                'report_desc'       => $this->input->post('report_desc'),
                'date_created'      => time()
            ];
            $this->report_model->create($data);
            $this->session->set_flashdata('message', '<div class="alert alert-success">Laporan Anda sudah di kirim</div>');
            redirect($_SERVER['HTTP_REFERER']);
        }
    }
}
