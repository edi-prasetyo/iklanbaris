<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Home extends CI_Controller
{
  public function __construct()
  {
    parent::__construct();
    $this->load->helper('short_number'); //calling helper short number format
    $this->load->library('pagination');
    $this->load->model('meta_model');
    $this->load->model('iklan_model');
    $this->load->model('category_model');
  }
  public function index()
  {


    $id = $this->session->userdata('id');
    $user = $this->user_model->user_detail($id);
    $meta = $this->meta_model->get_meta();
    $iklan = $this->iklan_model->get_iklan_home();
    $category = $this->category_model->get_category_iklan();

    // var_dump($category);
    // die;

    // End Listing Berita dengan paginasi
    $data = array(
      'title'       => 'Property',
      'deskripsi'   => 'Berita - ' . $meta->description,
      'keywords'    => 'Berita - ' . $meta->keywords,
      'user'        => $user,
      'meta'        => $meta,
      'category'      => $category,
      'iklan'         => $iklan,
      'pagination'    => $this->pagination->create_links(),
      'content'       => 'front/home/index_home'
    );
    $this->load->view('front/layout/wrapp', $data, FALSE);
  }
}
