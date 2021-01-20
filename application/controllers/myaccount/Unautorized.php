<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Unautorized extends CI_Controller
{

    //Load Model
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {

        $data = [
            'title'                 => 'Unautorized',
            'deskripsi'             => 'Unautorized',
            'keywords'              => 'Keywords',
            'content'               => 'myaccount/unautorized/index'
        ];
        $this->load->view('myaccount/layout/wrapp', $data, FALSE);
    }
}
