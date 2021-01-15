<?php
defined('BASEPATH') or exit('No direct script access allowed');

class About extends CI_Controller
{

    //Load Model
    public function __construct()
    {
        parent::__construct();
        $this->load->model('meta_model');
    }

    //main page - Berita
    public function index()
    {
        $meta           = $this->meta_model->get_meta();

        // End Listing Berita dengan paginasi
        $data = array(
            'title'       => 'About Us',
            'deskripsi'   => 'Berita - ' . $meta->description,
            'keywords'    => 'Berita - ' . $meta->keywords,
            'content'     => 'front/page/index_about'
        );
        $this->load->view('front/layout/wrapp', $data, FALSE);
    }
}

/* End of file berita.php */
/* Location: ./application/controllers/Berita.php */
