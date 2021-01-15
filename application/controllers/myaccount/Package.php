<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Package extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {

        $data = [
            'title'             => 'Paket iklan',
            'content'           => 'myaccount/package/index_package'

        ];

        $this->load->view('myaccount/layout/wrapp', $data, FALSE);
    }
}
