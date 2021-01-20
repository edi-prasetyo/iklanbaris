<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Transaction extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('pagination');
        $this->load->model('user_model');
        $this->load->model('transaction_model');
        $this->load->model('category_model');
        $this->load->model('province_model');
    }

    // Listing transaction transaction

    public function index()
    {
        $id = $this->session->userdata('id');
        $user = $this->user_model->user_detail($id);
        $meta = $this->meta_model->get_meta();


        $config['base_url']       = base_url('myaccount/transaction/index/');
        $config['total_rows']     = count($this->transaction_model->total_row_transaction_user($id));
        $config['per_page']       = 3;
        $config['uri_segment']    = 4;

        //Membuat Style pagination untuk BootStrap v4
        $config['first_link']       = 'First';
        $config['last_link']        = 'Last';
        $config['next_link']        = 'Next';
        $config['prev_link']        = 'Prev';
        $config['full_tag_open']    = '<div class="pagging text-center"><nav><ul class="pagination justify-content-center">';
        $config['full_tag_close']   = '</ul></nav></div>';
        $config['num_tag_open']     = '<li class="page-item"><span class="page-link">';
        $config['num_tag_close']    = '</span></li>';
        $config['cur_tag_open']     = '<li class="page-item active"><span class="page-link">';
        $config['cur_tag_close']    = '<span class="sr-only">(current)</span></span></li>';
        $config['next_tag_open']    = '<li class="page-item"><span class="page-link">';
        $config['next_tagl_close']  = '<span aria-hidden="true">&raquo;</span></span></li>';
        $config['prev_tag_open']    = '<li class="page-item"><span class="page-link">';
        $config['prev_tagl_close']  = '</span>Next</li>';
        $config['first_tag_open']   = '<li class="page-item"><span class="page-link">';
        $config['first_tagl_close'] = '</span></li>';
        $config['last_tag_open']    = '<li class="page-item"><span class="page-link">';
        $config['last_tagl_close']  = '</span></li>';


        //Limit dan Start
        $limit                    = $config['per_page'];
        $start                    = ($this->uri->segment(4)) ? ($this->uri->segment(4)) : 0;
        //End Limit Start
        $this->pagination->initialize($config);
        $transaction = $this->transaction_model->get_transaction_user($limit, $start, $id);

        // End Listing transaction dengan paginasi
        $data = array(
            'title'       => 'transaction Saya',
            'deskripsi'   => 'transaction - ' . $meta->description,
            'keywords'    => 'transaction - ' . $meta->keywords,
            'user'        => $user,
            'meta'        => $meta,
            'transaction'    => $transaction,
            'pagination'    => $this->pagination->create_links(),
            'content'     => 'myaccount/transaction/index_transaction'
        );
        $this->load->view('myaccount/layout/wrapp', $data, FALSE);
    }

    // Create transaction transaction
    public function confirm($id)
    {
        $transaction = $this->transaction_model->transaction_detail($id);
        $user_id = $this->session->userdata('id');
        if ($transaction->user_id == $user_id) {

            //Validasi
            $this->form_validation->set_rules(
                'transaction_status',
                'Status Transaksi',
                'required',
                ['required'      => 'Status Transaksi harus di isi',]
            );

            if ($this->form_validation->run()) {

                $config['upload_path']          = './assets/img/struk/';
                $config['allowed_types']        = 'gif|jpg|png|jpeg|svg';
                $config['max_size']             = 5000; //Dalam Kilobyte
                $config['max_width']            = 5000; //Lebar (pixel)
                $config['max_height']           = 5000; //tinggi (pixel)
                $this->load->library('upload', $config);
                if (!$this->upload->do_upload('transaction_image')) {

                    $data = [
                        'title'        => 'Konfirmasi Transaksi',
                        'deskripsi'     => 'deskripsi',
                        'keywords'      => 'keywords',
                        'transaction'   => $transaction,
                        'error_upload' => $this->upload->display_errors(),
                        'content'       => 'myaccount/transaction/confirm_transaction'
                    ];
                    $this->load->view('myaccount/layout/wrapp', $data, FALSE);
                } else {

                    //Proses Manipulasi Gambar
                    $upload_data    = array('uploads'  => $this->upload->data());
                    //Gambar Asli disimpan di folder assets/upload/image
                    //lalu gambara Asli di copy untuk versi mini size ke folder assets/upload/image/thumbs

                    $config['image_library']    = 'gd2';
                    $config['source_image']     = './assets/img/struk/' . $upload_data['uploads']['file_name'];
                    //Gambar Versi Kecil dipindahkan
                    // $config['new_image']        = './assets/img/artikel/thumbs/' . $upload_data['uploads']['file_name'];
                    $config['create_thumb']     = TRUE;
                    $config['maintain_ratio']   = TRUE;
                    $config['width']            = 500;
                    $config['height']           = 500;
                    $config['thumb_marker']     = '';

                    $this->load->library('image_lib', $config);
                    $this->image_lib->resize();

                    $data = [
                        'id'                        => $id,
                        'transaction_status'        => $this->input->post('transaction_status'),
                        'transaction_image'         => $upload_data['uploads']['file_name'],
                        'date_updated'              => time()
                    ];
                    $this->transaction_model->update($data);
                    // $this->upload_images($insert_id);
                    $this->session->set_flashdata('message', '<div class="alert alert-success" >Terima Kasih telah melakukan pembayaran Transaksi Anda akan segera di proses</div>');
                    redirect(base_url('myaccount/transaction'), 'refresh');
                }
            }

            $data = [
                'title'        => 'Konfirmasi Transaksi',
                'deskripsi'     => 'deskripsi',
                'keywords'      => 'keywords',
                'transaction'   => $transaction,
                'content'       => 'myaccount/transaction/confirm_transaction'
            ];
            $this->load->view('myaccount/layout/wrapp', $data, FALSE);
        } else {
            redirect(base_url('myaccount/unautorized'), 'refresh');
        }
    }

    function decline($id)

    {
        //Proteksi delete
        is_login();
        $user_id = $this->session->userdata('id');
        $transaction = $this->transaction_model->transaction_detail($id);
        if ($transaction->user_id == $user_id) {
            $data = [
                'id'                          => $id,
                'transaction_status'                => 'Decline',
            ];
            $this->transaction_model->update($data);
            $this->session->set_flashdata('message', '<div class="alert alert-success" >Transaksi Di batalkan</div>');
            redirect($_SERVER['HTTP_REFERER']);
        } else {
            redirect(base_url('myaccount/unautorized'), 'refresh');
        }
    }
}
