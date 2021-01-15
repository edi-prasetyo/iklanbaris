<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Iklan extends CI_Controller
{
  //load data
  public function __construct()
  {
    parent::__construct();
    $this->load->model('category_model');
    $this->load->model('images_model');
    $this->load->model('iklan_model');
    $this->load->library('pagination');

    $id = $this->session->userdata('id');
    $user = $this->user_model->user_detail($id);
    if ($user->role_id == 2) {
      redirect('admin/dashboard');
    }
  }
  //listing data berita
  public function index()
  {
    $data = [
      'title'         => 'Iklan Saya',
      'pagination'    => $this->pagination->create_links(),
      'content'       => 'admin/iklan/index_iklan'
    ];
    $this->load->view('admin/layout/wrapp', $data, FALSE);
  }
  public function property($category_id){
    if($category_id == 1){
      $category = $this->category_model->get_category_iklan($category_id);

      // Validasi
      $this->form_validation->set_rules(
          'iklan_title',
          'Judul Iklan',
          'required',
          [
              'required'      => 'Judul Iklan harus di isi',
          ]
      );



      if ($this->form_validation->run()) {

        $data = [
          'iklan_title'   => $this->input->post('iklan_title'),
          // 'file1'         => $file1,
          // 'file2'         => $file2
        ];
        $insert_id = $this->iklan_model->create($data);
        $this->upload_images($insert_id);
        $this->session->set_flashdata('message', 'Data Iklan telah ditambahkan');
        redirect(base_url('admin/iklan'), 'refresh');

      }else{

        $data = [
          'title'         => 'Pasang Iklan Property',
          'pagination'    => $this->pagination->create_links(),
          'category'      => $category,
          'content'       => 'admin/iklan/create_property'
        ];
        $this->load->view('admin/layout/wrapp', $data, FALSE);

      }

    }else{
      redirect('admin/iklan');
    }
  }
  public function mobil($category_id){
    if($category_id == 2){
      $category = $this->category_model->get_category_iklan($category_id);
      $data = [
        'title'         => 'Pasang Iklan Mobil',
        'pagination'    => $this->pagination->create_links(),
        'category'      => $category,
        'content'       => 'admin/iklan/create_mobil'
      ];
      $this->load->view('admin/layout/wrapp', $data, FALSE);
    }else{
      redirect('admin/iklan');
    }

  }

  public function upload_images($insert_id){

    $config['upload_path']          = './assets/img/artikel/';
    $config['allowed_types']        = 'gif|jpg|png|jpeg';
    $config['max_size']             = 5000; //Dalam Kilobyte
    $config['max_width']            = 5000; //Lebar (pixel)
    $config['max_height']           = 5000; //tinggi (pixel)
    $config['encrypt_name']         = TRUE;
    $this->load->library('upload', $config);

    // File 1
    if (!empty($_FILES['file1'])) {
      $this->upload->do_upload('file1');
      $data1 = $this->upload->data();
      $file1 = $data1['file_name'];
    }
    // File 2
    if (!empty($_FILES['file2'])) {
      $this->upload->do_upload('file2');
      $data2 = $this->upload->data();
      $file2 = $data2['file_name'];
    }

    $data = [
      'iklan_id'      => $insert_id,
      'file1'         => $file1,
      'file2'         => $file2,
      'date_created'  => time()
    ];
    $this->images_model->create($data);

  }


}
