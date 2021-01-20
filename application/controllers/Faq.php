<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Faq extends CI_Controller
{

    //Load Model
    public function __construct()
    {
        parent::__construct();
        $this->load->model('meta_model');
        $this->load->model('faq_model');
    }

    //main page - Berita
    public function index()
    {
        $meta           = $this->meta_model->get_meta();
        $faq            = $this->faq_model->get_faq();

        // End Listing Berita dengan paginasi
        $data = array(
            'title'       => 'FAQ',
            'deskripsi'   => 'FAQ - ' . $meta->description,
            'keywords'    => 'FAQ - ' . $meta->keywords,
            'faq'         => $faq,
            'content'     => 'front/faq/index_faq'
        );
        $this->load->view('front/layout/wrapp', $data, FALSE);
    }
}

/* End of file berita.php */
/* Location: ./application/controllers/Berita.php */