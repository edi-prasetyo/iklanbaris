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
            'content'               => 'myaccount/unautorized/index'
        ];
        $this->load->view('myaccount/layout/wrapp', $data, FALSE);
    }
}
