<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Page extends CI_Controller
{

    //Load Model
    public function __construct()
    {
        parent::__construct();
        $this->load->model('meta_model');
        $this->load->model('page_model');
    }

    //main page - Berita
    public function index()
    {
        $meta           = $this->meta_model->get_meta();
        $page           = $this->page_model->get_page();

        // End Listing Berita dengan paginasi
        $data = array(
            'title'       => 'Halaman',
            'deskripsi'   => 'Berita - ' . $meta->description,
            'keywords'    => 'Berita - ' . $meta->keywords,
            'page'        => $page,
            'content'     => 'front/page/index_page'
        );
        $this->load->view('front/layout/wrapp', $data, FALSE);
    }
    // Detail Page
    public function detail($page_slug)
    {
        $meta           = $this->meta_model->get_meta();
        $page           = $this->page_model->read($page_slug);

        $data = array(
            'title'       => $page->page_title,
            'deskripsi'   => 'Halaman - ' . $meta->description,
            'keywords'    => 'Halaman - ' . $meta->keywords,
            'page'        => $page,
            'content'     => 'front/page/detail_page'
        );
        $this->load->view('front/layout/wrapp', $data, FALSE);
    }
}

/* End of file berita.php */
/* Location: ./application/controllers/Berita.php */
