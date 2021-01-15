<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Oops extends CI_Controller
{
    //main page - home page
    public function index()
    {
        $data = array(
            'title' => 'Oops! Halaman tidak di temukan',
            'deskripsi' => 'error 404',
            'keywords' => 'keywords',
            'content'  => 'front/oops/index_oops'
        );
        $this->load->view('front/layout/wrapp', $data, FALSE);
    }
}

 /* End of file Kontak.php */
 /* Location: ./application/controllers/Kontak.php */
