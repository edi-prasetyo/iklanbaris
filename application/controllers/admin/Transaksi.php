<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Transaksi extends CI_Controller
{
  //load data
  public function __construct()
  {
    parent::__construct();
    $this->load->model('transaksi_model');
    $this->load->model('category_model');
    $this->load->library('pagination');
  }
  //listing data berita
  public function index()
  {
    $config['base_url']       = base_url('admin/transaksi/index/');
    $config['total_rows']     = count($this->transaksi_model->total_row());
    $config['per_page']       = 5;
    $config['uri_segment']    = 4;
    // $config['use_page_numbers'] = TRUE;
    // $config['page_query_string'] = true;
    // $config['query_string_segment'] = 'page';




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

    $transaksi = $this->transaksi_model->get_transaksi($limit, $start);
    $data = [
      'title'         => 'Data Transaksi',
      'transaksi'     => $transaksi,
      'pagination'    => $this->pagination->create_links(),
      'content'       => 'admin/transaksi/index_transaksi'
    ];
    $this->load->view('admin/layout/wrapp', $data, FALSE);
  }
  // Update Transaksi
  public function view($id)
  {
    $transaksi = $this->transaksi_model->transaksi_detail($id);
    $data = [
      'title'         => 'Detail Transaksi',
      'transaksi'     => $transaksi,
      'content'       => 'admin/transaksi/view_transaksi'
    ];
    $this->load->view('admin/layout/wrapp', $data, FALSE);
  }
  public function lunas($id)

  {
    //Proteksi delete
    is_login();
    $data = [
      'id'                          => $id,
      'payment_status'              => 'Lunas',
    ];
    $this->transaksi_model->update($data);
    $this->session->set_flashdata('message', 'Pembayaran sudah Lunas');
    redirect($_SERVER['HTTP_REFERER']);
  }
  public function proses($id)

  {
    //Proteksi delete
    is_login();
    $data = [
      'id'                          => $id,
      'order_status'                => 'Proses',
    ];
    $this->transaksi_model->update($data);
    $this->session->set_flashdata('message', 'Order di proses');
    redirect($_SERVER['HTTP_REFERER']);
  }

  public function selesai($id)

  {
    //Proteksi delete
    is_login();
    $data = [
      'id'                          => $id,
      'order_status'                => 'Selesai',
    ];
    $this->transaksi_model->update($data);
    $this->session->set_flashdata('message', 'Pembayaran sudah Lunas');
    redirect($_SERVER['HTTP_REFERER']);
  }

}
