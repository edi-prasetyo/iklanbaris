<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Layanan extends CI_Controller
{

    //Load Model
    public function __construct()
    {
        parent::__construct();
        $this->load->model('transaksi_model');
    }

    //main page - Berita
    public function index()
    {
        $meta           = $this->meta_model->get_meta();

        // End Listing Berita dengan paginasi
        $data = [
            'title'       => 'About Us',
            'deskripsi'   => 'Berita - ' . $meta->description,
            'keywords'    => 'Berita - ' . $meta->keywords,
            'content'     => 'front/layanan/index_layanan'
        ];
        $this->load->view('front/layout/wrapp', $data, FALSE);
    }
    public function vector()
    {
        $meta           = $this->meta_model->get_meta();
      $data = [
          'title'       => 'Jasa Vector Art',
          'deskripsi'   => 'Berita',
          'keywords'    => 'Berita - ' . $meta->keywords,
          'content'     => 'front/layanan/index_layanan'
      ];
      $this->load->view('front/layout/wrapp', $data, FALSE);
    }
    public function desain()
    {

    }
    public function website()
    {

    }
    public function mobile()
    {

    }
}
