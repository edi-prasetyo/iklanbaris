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
  public function index($rowno = 0)
  {


    $id = $this->session->userdata('id');
    $user = $this->user_model->user_detail($id);
    $meta = $this->meta_model->get_meta();
    $iklan = $this->iklan_model->get_iklan_home();
    $category = $this->category_model->get_category_iklan();


    // Search text
    $search_text = "";
    if ($this->input->post('submit') != NULL) {
      $search_text = $this->input->post('search');
      $this->session->set_userdata(array("search" => $search_text));
    } else {
      if ($this->session->userdata('search') != NULL) {
        $search_text = $this->session->userdata('search');
      }
    }

    // Row per page
    $rowperpage = 1;

    // Row position
    if ($rowno != 0) {
      $rowno = ($rowno - 1) * $rowperpage;
    }



    $allcount = $this->iklan_model->getrecordCount($search_text);
    $users_record = $this->iklan_model->getData($rowno, $rowperpage, $search_text);
    // Pagination Configuration
    $config['base_url'] = base_url() . 'index.php/iklan/search';
    $config['use_page_numbers'] = TRUE;
    $config['total_rows'] = $allcount;
    $config['per_page'] = $rowperpage;

    // Initialize
    $this->pagination->initialize($config);

    $data['pagination'] = $this->pagination->create_links();
    $data['result'] = $users_record;
    $data['row'] = $rowno;


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
      'search'        => $search_text,
      'pagination'    => $this->pagination->create_links(),
      'content'       => 'front/home/index_home'
    );
    $this->load->view('front/layout/wrapp', $data, FALSE);
  }
}
