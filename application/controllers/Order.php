<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Order extends CI_Controller
{

    //Load Model
    public function __construct()
    {
        parent::__construct();
        $this->load->model('berita_model');
        $this->load->model('category_model');
        $this->load->model('meta_model');
        $this->load->library('pagination');
    }

    //main page - Berita
    public function index()
    {
        $meta               = $this->meta_model->get_meta();

        // End Listing Berita dengan paginasi
        $data = array(
            'title'                 => 'Cek Transaksi',
            'deskripsi'             => 'Blog - ' . $meta->description,
            'keywords'              => 'Blog - ' . $meta->keywords,
            'content'               => 'front/order/index_order'
        );
        $this->load->view('front/layout/wrapp', $data, FALSE);
    }
    public function vector()
    {
        $meta               = $this->meta_model->get_meta();

        // End Listing Berita dengan paginasi
        $data = array(
            'title'                 => 'Blog - ' . $meta->title,
            'deskripsi'             => 'Blog - ' . $meta->description,
            'keywords'              => 'Blog - ' . $meta->keywords,
            'content'               => 'front/order/index_order'
        );
        $this->load->view('front/layout/wrapp', $data, FALSE);
    }

}

/* End of file berita.php */
/* Location: ./application/controllers/Berita.php */
