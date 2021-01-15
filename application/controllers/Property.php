<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Property extends CI_Controller
{

  //Load Model
  public function __construct()
  {
    parent::__construct();
    $this->load->helper('short_number'); //calling helper short number format
    $this->load->library('pagination');
    $this->load->model('meta_model');
    $this->load->model('property_model');
    $this->load->model('images_model');
    $this->load->model('type_model');
    $this->load->model('province_model');
    $this->load->model('city_model');
  }

  //main page - Berita
  public function index()
  {
    $id = $this->session->userdata('id');
    $user = $this->user_model->user_detail($id);
    $meta = $this->meta_model->get_meta();


    $config['base_url']       = base_url('property/index/');
    $config['total_rows']     = count($this->property_model->total_row_user());
    $config['per_page']       = 3;
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
    $property = $this->property_model->get_property($limit, $start);

    // End Listing Berita dengan paginasi
    $data = array(
      'title'       => 'Property',
      'deskripsi'   => 'Berita - ' . $meta->description,
      'keywords'    => 'Berita - ' . $meta->keywords,
      'user'        => $user,
      'meta'        => $meta,
      'property'    => $property,
      'pagination'    => $this->pagination->create_links(),
      'content'     => 'front/property/index_property'
    );
    $this->load->view('front/layout/wrapp', $data, FALSE);
  }
  // Detail Property
  public function detail($property_slug = NULL){
    if (!empty($property_slug)) {
      $property_slug;
    } else {
      redirect(base_url('property'));
    }
    $property             = $this->property_model->read($property_slug);
    $property_id          = $property->id;
    $images               = $this->images_model->images_property($property_id);
    // var_dump($images);
    // die;
    $data = array(
      'title'                 => $property->property_title,
      'deskripsi'             => $property->property_desc,
      'keywords'              => $property->property_keywords,
      'property'                => $property,
      'images'                => $images,
      'content'               => 'front/property/detail_property'
    );
    $this->add_count($property_slug);
    $this->load->view('front/layout/wrapp', $data, FALSE);
  }
  // Counter View
  function add_count($property_slug)
  {
      // load cookie helper
      $this->load->helper('cookie');
      // this line will return the cookie which has slug name
      $check_visitor_property = $this->input->cookie(urldecode($property_slug), FALSE);
      // this line will return the visitor ip address
      $ip = $this->input->ip_address();
      // if the visitor visit this article for first time then //
      //set new cookie and update article_views column  ..
      //you might be notice we used slug for cookie name and ip
      //address for value to distinguish between articles  views
      if ($check_visitor_property == false) {
          $cookie = array(
              "name"   => urldecode($property_slug),
              "value"  => "$ip",
              "expire" =>  time() + 7200,
              "secure" => false
          );
          $this->input->set_cookie($cookie);
          $this->property_model->update_counter(urldecode($property_slug));
      }
  }

}
