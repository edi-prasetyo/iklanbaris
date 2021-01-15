<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Category extends CI_Controller
{
    //Load Model
    public function __construct()
    {
        parent::__construct();
        $this->load->library('pagination');
        $this->load->model('berita_model');
        $this->load->model('category_model');
        $this->load->model('iklan_model');
        $this->load->model('meta_model');
    }

    public function index()
    {
        $meta             = $this->meta_model->get_meta();
        $category         = $this->category_model->get_category_iklan();
        // End Listing Berita dengan paginasi
        $data = array(
            'title'       => 'Berita - ' . $meta->title,
            'deskripsi'   => 'Berita - ' . $meta->description,
            'keywords'    => 'Berita - ' . $meta->keywords,
            'category'    => $category,
            'content'     => 'front/category/index_category'
        );
        $this->load->view('front/layout/wrapp', $data, FALSE);
    }
    // Detail Category
    public function detail($category_slug)
    {
        $category_detail = $this->category_model->read($category_slug);
        $category         = $this->category_model->get_category_iklan();
        $meta = $this->meta_model->get_meta();
        $category_id = $category_detail->id;

        $config['base_url']       = base_url('category/' . $category_slug . '/index/');
        $config['total_rows']     = count($this->iklan_model->total_row());
        $config['per_page']       = 1;
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


        $iklan = $this->iklan_model->get_iklan_category($category_id, $limit, $start);

        // var_dump($category_id);
        // die;

        $data = [
            'title'        => $category_detail->category_name,
            'deskripsi'   => 'Iklan - ' . $meta->description,
            'keywords'    => 'Iklan - ' . $meta->keywords,
            'category'     => $category,
            'category_detail' => $category_detail,
            'iklan'         => $iklan,
            'pagination'    => $this->pagination->create_links(),
            'content'          => 'front/category/detail_category'
        ];
        $this->load->view('front/layout/wrapp', $data, FALSE);
    }
}
