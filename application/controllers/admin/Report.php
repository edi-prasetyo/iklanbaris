<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Report extends CI_Controller
{
  //load data
  public function __construct()
  {
    parent::__construct();
    $this->load->model('category_model');
    $this->load->model('report_model');
    $this->load->library('pagination');

    $id = $this->session->userdata('id');
    $user = $this->user_model->user_detail($id);
    if ($user->role_id == 2) {
      redirect('admin/dashboard');
    }
  }
  //Index
  public function index()
  {
    $config['base_url']       = base_url('admin/report/index/');
    $config['total_rows']     = count($this->report_model->total_row());
    $config['per_page']       = 10;
    $config['uri_segment']    = 4;

    //Membuat Style pagination untuk BootStrap v4
    $config['first_link']       = 'First';
    $config['last_link']        = 'Last';
    $config['next_link']        = 'Next';
    $config['prev_link']        = 'Prev';
    $config['full_tag_open']    = '<div class="pagging text-center"><nav><ul class="pagination justify-content-center">';
    $config['full_tag_close']   = '</ul></nav></div>';
    $config['num_tag_open']     = '<li class="page-item"><span class="page-link">';
    $config['num_tag_close']    = '</span></li>';
    $config['cur_tag_open']     = '<li class="page-item active"><span class="page-link">';
    $config['cur_tag_close']    = '<span class="sr-only">(current)</span></span></li>';
    $config['next_tag_open']    = '<li class="page-item"><span class="page-link">';
    $config['next_tagl_close']  = '<span aria-hidden="true">&raquo;</span></span></li>';
    $config['prev_tag_open']    = '<li class="page-item"><span class="page-link">';
    $config['prev_tagl_close']  = '</span>Next</li>';
    $config['first_tag_open']   = '<li class="page-item"><span class="page-link">';
    $config['first_tagl_close'] = '</span></li>';
    $config['last_tag_open']    = '<li class="page-item"><span class="page-link">';
    $config['last_tagl_close']  = '</span></li>';


    //Limit dan Start
    $limit                    = $config['per_page'];
    $start                    = ($this->uri->segment(4)) ? ($this->uri->segment(4)) : 0;
    //End Limit Start
    $this->pagination->initialize($config);


    $report = $this->report_model->get_allreport($limit, $start);
    $data = [
      'title'         => 'Report Iklan',
      'report'         => $report,
      'pagination'    => $this->pagination->create_links(),
      'content'       => 'admin/report/index_report'
    ];
    $this->load->view('admin/layout/wrapp', $data, FALSE);
  }

  public function detail($id)
  {
    $report = $this->report_model->detail_report($id);
    $data = [
      'title'         => 'Detail Report',
      'report'         => $report,
      'pagination'    => $this->pagination->create_links(),
      'content'       => 'admin/report/detail_report'
    ];
    $this->load->view('admin/layout/wrapp', $data, FALSE);
  }


  public function delete($id)
  {
    //Proteksi delete
    is_login();

    $report = $this->report_model->report_detail($id);
    $data = ['id'   => $report->id];
    $this->report_model->delete($data);
    $this->session->set_flashdata('message', 'Data telah di Hapus');
    redirect($_SERVER['HTTP_REFERER']);
  }
}
