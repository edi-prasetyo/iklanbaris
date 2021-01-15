<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Package extends CI_Controller
{
  //load data
  public function __construct()
  {
    parent::__construct();
    $this->load->library('pagination');
    $this->load->model('package_model');
    $this->load->model('city_model');

    $id = $this->session->userdata('id');
    $user = $this->user_model->user_detail($id);
    if ($user->role_id == 2) {
      redirect('admin/dashboard');
    }
  }
  //Index Package
  public function index()
  {
    $config['base_url']       = base_url('admin/package/index/');
    $config['total_rows']     = count($this->package_model->total_row());
    $config['per_page']       = 5;
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

    $package = $this->package_model->get_allpackage($limit, $start);
    // var_dump($package);
    // die;
    //Validasi
    $this->form_validation->set_rules(
      'package_name',
      'Nama Kategori',
      'required',
      array(
        'required'         => '%s Harus Diisi',
        'is_unque'         => '%s <strong>' . $this->input->post('package_name') .
          '</strong>Nama Kategori Sudah Ada. Buat Nama yang lain!'
      )
    );
    if ($this->form_validation->run() === FALSE) {
      $data = [
        'title'             => 'Paket Iklan',
        'package'          => $package,
        'pagination'    => $this->pagination->create_links(),
        'content'           => 'admin/package/index_package'
      ];
      $this->load->view('admin/layout/wrapp', $data, FALSE);
    } else {

      $data  = [
        'package_name'     => $this->input->post('package_name'),
        'package_price'     => $this->input->post('package_price'),
        'package_post'     => $this->input->post('package_post'),
        'date_created'      => time()
      ];
      $this->package_model->create($data);
      $this->session->set_flashdata('message', 'Data telah ditambahkan');
      redirect(base_url('admin/package'), 'refresh');
    }
  }
  //Update
  public function update($id)
  {
    $package = $this->package_model->detail_package($id);
    //Validasi
    $this->form_validation->set_rules(
      'package_name',
      'Nama Kategori',
      'required',
      array('required'         => '%s Harus Diisi')
    );
    if ($this->form_validation->run() === FALSE) {
      //End Validasi

      $data = [
        'title'             => 'Edit kategori Berita',
        'package'          => $package,
        'content'           => 'admin/package/update_package'
      ];
      $this->load->view('admin/layout/wrapp', $data, FALSE);
      //Masuk Database
    } else {

      $data  = [
        'id'                => $id,
        'package_name'     => $this->input->post('package_name'),
        'date_updated'      => time()
      ];
      $this->package_model->update($data);
      $this->session->set_flashdata('message', 'Data telah di Update');
      redirect(base_url('admin/package'), 'refresh');
    }
    //End Masuk Database
  }
  //delete Package
  public function delete($id)
  {
    //Proteksi delete
    is_login();

    $package = $this->package_model->detail_package($id);
    $data = ['id'   => $package->id];
    $this->package_model->delete($data);
    $this->session->set_flashdata('message', 'Data telah di Hapus');
    redirect(base_url('admin/package'), 'refresh');
  }

  // Data Kota
  public function city($id)
  {
    $package       = $this->package_model->detail_package($id);
    $city      = $this->city_model->city_by_package($id);

    //Validasi
    $valid = $this->form_validation;

    $valid->set_rules(
      'city_name',
      'Nama Kota',
      'required',
      array('required'      => '%s harus dicontent')
    );

    if ($valid->run() === FALSE) {
      //End Validasi
      $data = array(
        'title'           => 'Tambah Kota',
        'package'        => $package,
        'city'            => $city,
        'content'         => 'admin/city/index_city'
      );
      $this->load->view('admin/layout/wrapp', $data, FALSE);

      //Masuk Database

    } else {
      $slugcodecity = random_string('numeric', 5);
      $city_slug  = url_title($this->input->post('city_name'), 'dash', TRUE);
      $data  = array(
        'package_id'         => $id,
        'city_slug'           =>  $city_slug . '-' . $slugcodecity,
        'city_name'           => $this->input->post('city_name'),
        'date_created'        => time()
      );
      $this->city_model->create($data);
      $this->session->set_flashdata('message', 'Data telah ditambahkan');
      redirect(base_url('admin/package/city/' . $id), 'refresh');
    }

    //End Masuk Database
    $data = array(
      'title'         => 'Tambah mobil',
      'package'         => $package,
      'city'              => $city,
      'content'           => 'admin/package/city'
    );
    $this->load->view('admin/layout/wrapp', $data, FALSE);
  }

  public function update_city($package_id, $id)
  {
    $city = $this->city_model->detail_city($id);
    //Validasi
    $this->form_validation->set_rules(
      'city_name',
      'Nama Kota',
      'required',
      array('required'         => '%s Harus Diisi')
    );
    if ($this->form_validation->run() === FALSE) {
      //End Validasi

      $data = [
        'title'             => 'Edit kategori Berita',
        '$city'          => $city,
        'content'           => 'admin/package/update_city'
      ];
      $this->load->view('admin/layout/wrapp', $data, FALSE);
      //Masuk Database
    } else {

      $data  = [
        'id'                => $id,
        'city_name'     => $this->input->post('city_name'),
        'date_updated'      => time()
      ];
      $this->city_model->update($data);
      $this->session->set_flashdata('message', 'Data telah di Update');
      redirect($_SERVER['HTTP_REFERER']);
    }
    //End Masuk Database
  }

  public function delete_city($id)
  {
    is_login();

    $city = $this->city_model->detail_city($id);
    $data = ['id'   => $city->id];
    $this->city_model->delete($data);
    $this->session->set_flashdata('message', 'Data Kota ' . $city->city_name . ' telah di Hapus');
    redirect($_SERVER['HTTP_REFERER']);
  }
}
