<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Package extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('package_model');
        $this->load->model('bank_model');
        $this->load->model('transaction_model');
    }

    public function index()
    {
        $user_id = $this->session->userdata('id');
        $transaction_user = $this->transaction_model->transaction_user($user_id);
        $package = $this->package_model->get_package();
        $data = [
            'title'             => 'Paket iklan',
            'deskripsi'         => 'Deskripsi',
            'keywords'          => 'Keywords',
            'transaction_user'    => $transaction_user,
            'package'           => $package,
            'content'           => 'myaccount/package/index_package'

        ];

        $this->load->view('myaccount/layout/wrapp', $data, FALSE);
    }
    // Buy Package
    public function order($id)
    {
        $bank = $this->bank_model->get_allbank();
        $package = $this->package_model->detail_package($id);

        $this->form_validation->set_rules(
            'bank_id',
            'Bank',
            'required',
            ['required'      => 'Anda harus Memilih Bank',]
        );
        if ($this->form_validation->run() == false) {

            $data = [
                'title'             => 'Beli Paket',
                'deskripsi'         => 'Deskripsi',
                'keywords'          => 'Keywords',
                'package'           => $package,
                'bank'              => $bank,
                'content'           => 'myaccount/package/order_package'
            ];
            $this->load->view('myaccount/layout/wrapp', $data, FALSE);
        } else {
            //Validasi Berhasil
            $transaction_code = date('dmY') . strtoupper(random_string('alnum', 5));
            $data  = [
                'user_id'                   => $this->session->userdata('id'),
                'bank_id'                   => $this->input->post('bank_id'),
                'transaction_code'          => $transaction_code,
                'transaction_user'          => $this->input->post('transaction_user'),
                'transaction_product'       => $this->input->post('transaction_product'),
                'transaction_price'         => $this->input->post('transaction_price'),
                'transaction_count'         => $this->input->post('transaction_count'),
                'transaction_status'        => 'Pending',
                'date_created'              => time()
            ];
            $insert_id = $this->transaction_model->create($data);
            $this->session->set_flashdata('message', 'Data telah ditambahkan');
            redirect(base_url('myaccount/package/success/' . $insert_id), 'refresh');
        }
    }
    // public function insert_order()
    // {
    //     $transaction_code = date('dmY') . strtoupper(random_string('alnum', 5));
    //     $data  = [
    //         'user_id'                   => $this->session->userdata('id'),
    //         'bank_id'                   => $this->input->post('bank_id'),
    //         'transaction_code'          => $transaction_code,
    //         'transaction_user'          => $this->input->post('transaction_user'),
    //         'transaction_product'       => $this->input->post('transaction_product'),
    //         'transaction_price'         => $this->input->post('transaction_price'),
    //         'transaction_count'         => $this->input->post('transaction_count'),
    //         'transaction_status'        => 'Pending',
    //         'date_created'              => time()
    //     ];
    //     $insert_id = $this->transaction_model->create($data);
    //     $this->session->set_flashdata('message', 'Data telah ditambahkan');
    //     redirect(base_url('myaccount/package/success/' . $insert_id), 'refresh');
    // }
    public function success($insert_id)
    {
        $user_id = $this->session->userdata('id');
        $last_transaction                     = $this->transaction_model->last_transaction($insert_id);
        if ($last_transaction->user_id == $user_id) {
            $data = [
                'title'                           => 'Order Sukses',
                'deskripsi'                       => 'Sewa mobil Online',
                'keywords'                        => 'Order Paket Premium',
                'last_transaction'                  => $last_transaction,
                'content'                         => 'myaccount/package/success_package'
            ];
            $this->load->view('myaccount/layout/wrapp', $data, FALSE);
        } else {
            redirect(base_url('myaccount/unautorized'), 'refresh');
        }
    }
    public function transaction()
    {
        $user_id = $this->session->userdata('id');
        $transaction_user = $this->transaction_model->transaction_user($user_id);
        $data = [
            'title'                           => 'Order Sukses',
            'deskripsi'                       => 'Sewa mobil Online',
            'keywords'                        => 'Order Paket Premium',
            'transaction_user'                  => $transaction_user,
            'content'                         => 'myaccount/package/transaction_package'
        ];
        $this->load->view('myaccount/layout/wrapp', $data, FALSE);
    }
}
