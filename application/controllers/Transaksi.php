<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Transaksi extends CI_Controller
{

  //Load Model
  public function __construct()
  {
    parent::__construct();
    $this->load->model('user_model');
    $this->load->model('transaksi_model');
    $this->load->model('meta_model');
    $this->load->model('vector_model');
    $this->load->model('bank_model');
    $this->load->library('pagination');
  }
  public function index()
  {
        $id                         = $this->session->userdata('id');
        $user                       = $this->user_model->user_detail($id);

        $config['base_url']       = base_url('transaksi/index/');
        $config['total_rows']     = count($this->transaksi_model->total_row_transaksi_user($id));
        $config['per_page']       = 5;
        $config['uri_segment']    = 3;

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
        $start                    = ($this->uri->segment(3)) ? ($this->uri->segment(3)) : 0;
        //End Limit Start
        $this->pagination->initialize($config);

        $transaksi = $this->transaksi_model->get_transaksi_user($limit, $start, $id);
        $data = [
            'title'                     => 'Data Transaksi',
            'deskripsi'                 => 'Data Transaksi',
            'keywords'                  => 'Data Transaksi',
            'transaksi'                 => $transaksi,
            'user'                      => $user,
            'pagination'                => $this->pagination->create_links(),
            'content'                   => 'front/transaksi/index_transaksi'
        ];
        $this->load->view('front/layout/wrapp', $data, FALSE);
    }
// Detail Transaksi
    public function detail()
  {

    //Validasi
    $valid = $this->form_validation;

    $valid->set_rules(
      'transaction_code',
      'Kode Transaksi',
      'required|trim',
      array('required'      => '%s harus diisi')
    );

    $valid->set_rules(
      'email',
      'Email',
      'required',
      array('required'      => '%s harus diisi')
    );


    if ($valid->run() === FALSE) {
      //End Validasi

      $data = array(
        'title'           => 'Transaksi',
        'deskripsi'       => 'Deskripsi',
        'keywords'        => 'Transaksi',
        'content'         => 'front/transaksi/detail_transaksi'
      );
      $this->load->view('front/layout/wrapp', $data, FALSE);
      //Masuk Database
    } else {

      $bank                       = $this->bank_model->get_allbank();
      $transaction_code           = $this->input->post('transaction_code');
      $email                      = $this->input->post('email');
      $transaksi                  = $this->transaksi_model->cek_transaksi($transaction_code, $email);

      $data = array(
        'title'                   => 'Transaksi',
        'deskripsi'               => 'Deskripsi',
        'keywords'                => 'Transaksi',
        'transaksi'               => $transaksi,
        'bank'                    => $bank,
        'content'                 => 'front/transaksi/detail_transaksi'
      );
      $this->load->view('front/layout/wrapp', $data, FALSE);
    }
  }
  // Konfirmasi Pembayaran
  //Tambah transaksi
  public function konfirmasi($transaction_code = NULL)
  {
    if (!empty($transaction_code)) {
        $transaction_code;
    } else {
        redirect(base_url('transaksi'));
    }

    $transaksi = $this->transaksi_model->detail_konfirmasi($transaction_code);
    $meta      = $this->meta_model->get_meta();
    $bank       = $this->bank_model->get_allbank();
    //Validasi
    $valid = $this->form_validation;

    $valid->set_rules(
      'payment_bank',
      'Transfer Ke',
      'required',
      array('required'      => 'Pilih %s Bank tujuan')
    );

    $valid->set_rules(
      'bank_name',
      'Nama Bank',
      'required',
      array('required'      => '%s harus diisi')
    );

    $valid->set_rules(
      'bank_account',
      'Nama Pemilik Rekening',
      'required',
      array('required'      => '%s harus diisi')
    );

    $valid->set_rules(
      'bank_number',
      'Nomor Rekening Anda',
      'required',
      array('required'      => '%s harus diisi')
    );

    $valid->set_rules(
      'date_payment',
      'Tanggal Bayar',
      'required',
      array('required'      => '%s harus diisi')
    );


    if ($valid->run()) {

      $config['upload_path']          = './assets/img/struk/';
      $config['allowed_types']        = 'gif|jpg|png|jpeg';
      $config['max_size']             = 5000; //Dalam Kilobyte
      $config['max_width']            = 5000; //Lebar (pixel)
      $config['max_height']           = 5000; //tinggi (pixel)
      $this->load->library('upload', $config);
      if (!$this->upload->do_upload('bukti_transfer')) {

        //End Validasi
        $data = array(
          'title'         => 'Update transaksi',
          'deskripsi'     => 'Deskripsi',
          'keywords'      => 'Transaksi',
          'transaksi'     => $transaksi,
          'meta'          => $meta,
          'bank'          => $bank,
          'error_upload'  => $this->upload->display_errors(),
          'content'       => 'front/transaksi/konfirmasi_transaksi'
        );
        $this->load->view('front/layout/wrapp', $data, FALSE);

        //Masuk Database

      } else {

        //Proses Manipulasi Gambar
        $upload_data    = array('uploads'  => $this->upload->data());
        //Gambar Asli disimpan di folder assets/upload/image
        //lalu gambara Asli di copy untuk versi mini size ke folder assets/upload/image/thumbs

        $config['image_library']    = 'gd2';
        $config['source_image']     = './assets/img/struk/' . $upload_data['uploads']['file_name'];
        //Gambar Versi Kecil dipindahkan
        // $config['new_image']        = './assets/img/artikel/thumbs/' . $upload_data['uploads']['file_name'];
        $config['create_thumb']     = TRUE;
        $config['maintain_ratio']   = TRUE;
        $config['width']            = 500;
        $config['height']           = 500;
        $config['thumb_marker']     = '';

        $this->load->library('image_lib', $config);

        $this->image_lib->resize();


        $i     = $this->input;

        $data  = array(
          'id'                  => $transaksi->id,
          'payment_bank'        => $i->post('payment_bank'),
          'bank_name'             => $i->post('bank_name'),
          'bank_account'         => $i->post('bank_account'),
          'bank_number'          => $i->post('bank_number'),
          'date_payment'         => $i->post('date_payment'),
          'bukti_transfer'        => $upload_data['uploads']['file_name'],
          'payment_status'        => 'Proses',
          'order_status'          =>  'Proses',
          'date_created'          => time()
        );
        $this->transaksi_model->update($data);
        $this->session->set_flashdata('sukses', 'Terima Kasih Atas konfirmasi anda pesanan anda akan segera kami proses');
        redirect(base_url('transaksi/success'), 'refresh');
      }
    }
    //End Masuk Database
    $data = array(
      'title'               => 'Update transaksi',
      'deskripsi'           => 'Deskripsi',
      'keywords'            => 'Transaksi Angelita Rentcar',
      'transaksi'           => $transaksi,
      'meta'                => $meta,
      'bank'                => $bank,
      'content'             => 'front/transaksi/konfirmasi_transaksi'
    );
    $this->load->view('front/layout/wrapp', $data, FALSE);
  }
  public function success()
  {
    $meta = $this->meta_model->get_meta();
    $data = array(
      'title'               => 'Konfirmasi transaksi',
      'deskripsi'           => 'Transaksi',
      'keywords'            => 'Transaksi sukses',
      'meta'                => $meta,
      'content'             => 'front/transaksi/konfirmasi_success'
    );
    $this->load->view('front/layout/wrapp', $data, FALSE);

  }

}


/* End of file Vector.php */
/* Location: ./application/controllers/Vector.php */
