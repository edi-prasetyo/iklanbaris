<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Transaction extends CI_Controller
{
  //load data
  public function __construct()
  {
    parent::__construct();
    $this->load->model('transaction_model');
    $this->load->model('category_model');
    $this->load->library('pagination');
  }
  //Index
  public function index()
  {
    $transaction_code    =   $this->input->post('transaction_code');

    $config['base_url']       = base_url('admin/transaction/index/');
    $config['total_rows']     = count($this->transaction_model->total_row());
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

    $transaction = $this->transaction_model->get_transaction($limit, $start, $transaction_code);
    $data = [
      'title'           => 'Data Transaksi',
      'transaction'     => $transaction,
      'pagination'      => $this->pagination->create_links(),
      'content'         => 'admin/transaction/index_transaction'
    ];
    $this->load->view('admin/layout/wrapp', $data, FALSE);
  }
  // View
  public function view($id)
  {
    $transaction = $this->transaction_model->transaction_detail($id);
    $data = [
      'title'           => 'Detail Transaction',
      'transaction'     => $transaction,
      'content'         => 'admin/transaction/view_transaction'
    ];
    $this->load->view('admin/layout/wrapp', $data, FALSE);
  }
  // Success
  public function success($id)

  {
    //Proteksi
    is_login();
    $transaction = $this->transaction_model->transaction_detail($id);
    $user_id = $transaction->user_id;
    $transaction_count = $transaction->transaction_count;
    // var_dump($user_id);
    // die;
    $data = [
      'id'                              => $id,
      'transaction_status'              => 'Success',
    ];
    $this->transaction_model->update($data);
    $this->update_count_user($user_id, $transaction_count);
    $this->session->set_flashdata('message', 'Pembayaran sudah Berhasil');
    redirect($_SERVER['HTTP_REFERER']);
  }
  // Update Count
  public function update_count_user($user_id, $transaction_count)
  {

    $data = [
      'id'                          => $user_id,
      'premium_count'               => $transaction_count,
    ];
    $this->user_model->update($data);
  }
  // Proses
  public function process($id)

  {
    //Proteksi
    is_login();
    $data = [
      'id'                                => $id,
      'transaction_status'                => 'Process',
    ];
    $this->transaction_model->update($data);
    $this->session->set_flashdata('message', 'Order sudah di proses');
    redirect($_SERVER['HTTP_REFERER']);
  }

  // Decline
  public function decline($id)

  {
    //Proteksi
    is_login();
    $data = [
      'id'                                => $id,
      'transaction_status'                => 'Decline',
    ];
    $this->transaction_model->update($data);
    $this->session->set_flashdata('message', 'Transaksi Di batalkan');
    redirect($_SERVER['HTTP_REFERER']);
  }
}
