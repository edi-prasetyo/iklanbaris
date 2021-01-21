<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Iklan extends CI_Controller
{
  //load data
  public function __construct()
  {
    parent::__construct();
    $this->load->model('category_model');
    $this->load->model('iklan_model');
    $this->load->model('regularity_model');
    $this->load->library('pagination');
  }
  //listing data berita
  // public function index()
  // {
  //   $meta = $this->meta_model->get_meta();
  //   $category = $this->category_model->get_category_iklan();
  //   $iklan_premium = $this->iklan_model->iklan_premium();


  //   $config['base_url']       = base_url('iklan/index/');
  //   $config['total_rows']     = count($this->iklan_model->total_row());
  //   $config['per_page']       = 3;
  //   $config['uri_segment']    = 3;

  //   $config['first_link']       = 'First';
  //   $config['last_link']        = 'Last';
  //   $config['next_link']        = 'Next';
  //   $config['prev_link']        = 'Prev';
  //   $config['full_tag_open']    = '<div class="pagging text-center"><nav><ul class="pagination justify-content-center">';
  //   $config['full_tag_close']   = '</ul></nav></div>';
  //   $config['num_tag_open']     = '<li class="page-item"><span class="page-link">';
  //   $config['num_tag_close']    = '</span></li>';
  //   $config['cur_tag_open']     = '<li class="page-item active"><span class="page-link">';
  //   $config['cur_tag_close']    = '<span class="sr-only">(current)</span></span></li>';
  //   $config['next_tag_open']    = '<li class="page-item"><span class="page-link">';
  //   $config['next_tagl_close']  = '<span aria-hidden="true">&raquo;</span></span></li>';
  //   $config['prev_tag_open']    = '<li class="page-item"><span class="page-link">';
  //   $config['prev_tagl_close']  = '</span>Next</li>';
  //   $config['first_tag_open']   = '<li class="page-item"><span class="page-link">';
  //   $config['first_tagl_close'] = '</span></li>';
  //   $config['last_tag_open']    = '<li class="page-item"><span class="page-link">';
  //   $config['last_tagl_close']  = '</span></li>';

  //   $limit                    = $config['per_page'];
  //   $start                    = ($this->uri->segment(3)) ? ($this->uri->segment(3)) : 0;
  //   $this->pagination->initialize($config);
  //   $iklan = $this->iklan_model->get_iklan($limit, $start);

  //   $data = array(
  //     'title'         => 'Iklan',
  //     'deskripsi'     => 'Berita - ' . $meta->description,
  //     'keywords'      => 'Berita - ' . $meta->keywords,
  //     'meta'          => $meta,
  //     'iklan'         => $iklan,
  //     'iklan_premium' => $iklan_premium,
  //     'category'      => $category,
  //     'pagination'    => $this->pagination->create_links(),
  //     'content'       => 'front/iklan/index_iklan'
  //   );
  //   $this->load->view('front/layout/wrapp', $data, FALSE);
  // }


  public function index($rowno = 0)
  {
    $meta = $this->meta_model->get_meta();
    $category = $this->category_model->get_category_iklan();
    $iklan_premium = $this->iklan_model->iklan_premium();

    // Search text
    // $search_text = "";
    // if ($this->input->post('submit') != NULL) {
    //   $search_text = $this->input->post('search');
    //   $this->session->set_userdata(array("search" => $search_text));
    // } else {
    //   if ($this->session->userdata('search') != NULL) {
    //     $search_text = $this->session->userdata('search');
    //   }
    // }

    // Row per page
    $rowperpage = 3;
    // Row position
    if ($rowno != 0) {
      $rowno = ($rowno - 1) * $rowperpage;
    }

    // All records count
    $allcount = $this->iklan_model->getrecordCountIklan();

    // Get records
    $result = $this->iklan_model->getData($rowno, $rowperpage);

    // Pagination Configuration
    $config['base_url'] = base_url() . 'iklan/index/';
    $config['use_page_numbers'] = TRUE;
    $config['total_rows'] = $allcount;
    $config['per_page'] = $rowperpage;

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

    // Initialize
    $this->pagination->initialize($config);

    // $data['pagination'] = $this->pagination->create_links();
    // $data['result'] = $users_record;
    // $data['row'] = $rowno;
    // $data['search'] = $search_text;

    // var_dump($result);
    // die;

    $data = [
      'title'         => 'Pencarian ',
      'deskripsi'     => 'Pencarian',
      'keywords'      => 'Pencarian',
      'pagination' => $this->pagination->create_links(),
      'iklan'      => $result,
      'row'         => $rowno,
      'search'     => '',
      'category'  => $category,
      'iklan_premium' => $iklan_premium,
      'content'         => 'front/iklan/index_iklan'

    ];
    // Load view
    $this->load->view('front/layout/wrapp', $data);
  }


  // View

  public function detail($iklan_slug)
  {
    $iklan = $this->iklan_model->read($iklan_slug);
    $meta = $this->meta_model->get_meta();
    $regularity_buyer = $this->regularity_model->get_regularity_buyer();

    $data = [
      'title'        => $iklan->iklan_title,
      'deskripsi'   => 'Iklan - ' . $meta->description,
      'keywords'    => 'Iklan - ' . $meta->keywords,
      'iklan'     => $iklan,
      'regularity_buyer'  => $regularity_buyer,
      'content'          => 'front/iklan/detail_iklan'
    ];
    $this->add_count($iklan_slug);
    $this->load->view('front/layout/wrapp', $data, FALSE);
  }



  //  Category Article
  public function category($slug_kategori = NULL)
  {
    if (!empty($slug_kategori)) {
      $slug_kategori;
    } else {
      redirect(base_url('iklan'));
    }

    $category_list                    = $this->category_model->read($slug_kategori);
    $category_id                      = $category_list->id;
    $category                         = $this->category_model->get_category_iklan();
    $iklan_premium                    = $this->iklan_model->iklan_premium();

    // $meta                       = $this->meta_model->listing();
    // Listing Berita Dengan Pagination
    $this->load->library('pagination');

    $config['base_url']       = base_url('iklan/category/' . $category_list->category_slug . '/index/');
    $config['total_rows']     = count($this->iklan_model->total_category($category_id));
    $config['per_page']       = 3;
    $config['uri_segment']    = 5;


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
    $start                    = ($this->uri->segment(5)) ? ($this->uri->segment(5)) : 0;
    //End Limit Start
    $this->pagination->initialize($config);

    $iklan                   = $this->iklan_model->iklan_category($category_id, $limit, $start);
    // End Listing Berita
    $data = array(
      'title'           => 'Kategori - ' . $category_list->category_name,
      'deskripsi'       => 'Kategori - ' . $category_list->category_name,
      'keywords'        => 'Kategori - ' . $category_list->category_name,
      'pagination'      => $this->pagination->create_links(),
      'iklan'           => $iklan,
      'category'        => $category,
      'iklan_premium'   => $iklan_premium,
      'search'          => '',
      'content'         => 'front/iklan/category_iklan'
    );
    $this->load->view('front/layout/wrapp', $data, FALSE);
  }
  //  Iklan User
  public function user($username = NULL)
  {
    if (!empty($username)) {
      $username;
    } else {
      redirect(base_url('iklan'));
    }

    $user_list                 = $this->user_model->read($username);
    $user_id                = $user_list->id;
    $category = $this->category_model->get_category_iklan();

    // $meta                       = $this->meta_model->listing();
    // Listing Berita Dengan Pagination
    $this->load->library('pagination');

    $config['base_url']       = base_url('iklan/user/' . $user_list->username . '/index/');
    $config['total_rows']     = count($this->iklan_model->total_user($user_id));
    $config['per_page']       = 1;
    $config['uri_segment']    = 5;


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
    $start                    = ($this->uri->segment(5)) ? ($this->uri->segment(5)) : 0;
    //End Limit Start
    $this->pagination->initialize($config);

    $iklan                   = $this->iklan_model->iklan_user($username, $limit, $start);
    // End Listing Berita
    $data = array(
      'title'         => 'User - ' . $user_list->username,
      'deskripsi'     => 'User - ' . $user_list->username,
      'keywords'      => 'User - ' . $user_list->username,
      'pagination'    => $this->pagination->create_links(),
      'iklan'         => $iklan,
      'user_list'      => $user_list,
      'category'      => $category,
      'content'         => 'front/iklan/user_iklan'
    );
    $this->load->view('front/layout/wrapp', $data, FALSE);
  }




  // This is the counter function..
  function add_count($iklan_slug)
  {
    // load cookie helper
    $this->load->helper('cookie');
    // this line will return the cookie which has slug name
    $check_visitor = $this->input->cookie(urldecode($iklan_slug), FALSE);
    // this line will return the visitor ip address
    $ip = $this->input->ip_address();
    // if the visitor visit this article for first time then //
    //set new cookie and update article_views column  ..
    //you might be notice we used slug for cookie name and ip
    //address for value to distinguish between articles  views
    if ($check_visitor == false) {
      $cookie = array(
        "name"   => urldecode($iklan_slug),
        "value"  => "$ip",
        "expire" =>  time() + 7200,
        "secure" => false
      );
      $this->input->set_cookie($cookie);
      $this->iklan_model->update_counter(urldecode($iklan_slug));
    }
  }




  // Fungsi Search
  public function search($rowno = 0)
  {

    $category = $this->category_model->get_category_iklan();
    $iklan_premium                    = $this->iklan_model->iklan_premium();

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
    $rowperpage = 2;
    // Row position
    if ($rowno != 0) {
      $rowno = ($rowno - 1) * $rowperpage;
    }

    // All records count
    $allcount = $this->iklan_model->getrecordCount($search_text);

    // Get records
    $result = $this->iklan_model->getData($rowno, $rowperpage, $search_text);

    // Pagination Configuration
    $config['base_url'] = base_url() . 'iklan/search';
    $config['use_page_numbers'] = TRUE;
    $config['total_rows'] = $allcount;
    $config['per_page'] = $rowperpage;

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

    // Initialize
    $this->pagination->initialize($config);

    // $data['pagination'] = $this->pagination->create_links();
    // $data['result'] = $users_record;
    // $data['row'] = $rowno;
    // $data['search'] = $search_text;

    // var_dump($result);
    // die;

    $data = [
      'title'         => 'Pencarian ',
      'deskripsi'     => 'Pencarian',
      'keywords'      => 'Pencarian',
      'pagination' => $this->pagination->create_links(),
      'iklan'      => $result,
      'row'         => $rowno,
      'search'     => $search_text,
      'category'    => $category,
      'iklan_premium' => $iklan_premium,
      'content'         => 'front/iklan/search_iklan'

    ];
    // Load view
    $this->load->view('front/layout/wrapp', $data);
  }
}
