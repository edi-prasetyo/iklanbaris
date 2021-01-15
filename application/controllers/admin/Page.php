<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Page extends CI_Controller
{
    //load data
    public function __construct()
    {
        parent::__construct();
        $this->load->model('page_model');

        $id = $this->session->userdata('id');
        $user = $this->user_model->user_detail($id);
        if ($user->role_id == 2) {
            redirect('admin/dashboard');
        }
    }
    //Index Category
    public function index()
    {
        $page = $this->page_model->get_page();
        $data = [
            'title'             => 'Halaman',
            'page'          => $page,
            'content'           => 'admin/page/index_page'
        ];
        $this->load->view('admin/layout/wrapp', $data, FALSE);
    }
    //Update
    public function update($id)
    {
        $page = $this->page_model->detail_page($id);
        //Validasi
        $this->form_validation->set_rules(
            'page_name',
            'Nama Kategori',
            'required',
            array('required'         => '%s Harus Diisi')
        );
        if ($this->form_validation->run() === FALSE) {
            //End Validasi

            $data = [
                'title'             => 'Edit kategori Berita',
                'page'          => $page,
                'content'           => 'admin/page/update_page'
            ];
            $this->load->view('admin/layout/wrapp', $data, FALSE);
            //Masuk Database
        } else {

            $data  = [
                'id'                => $id,
                'page_name'     => $this->input->post('page_name'),
                'page_type'     => $this->input->post('page_type'),
                'date_updated'      => time()
            ];
            $this->page_model->update($data);
            $this->session->set_flashdata('message', 'Data telah di Update');
            redirect(base_url('admin/page'), 'refresh');
        }
        //End Masuk Database
    }
    //delete Category
    public function delete($id)
    {
        //Proteksi delete
        is_login();

        $page = $this->page_model->detail_page($id);
        $data = ['id'   => $page->id];

        $this->page_model->delete($data);
        $this->session->set_flashdata('message', 'Data telah di Hapus');
        redirect(base_url('admin/page'), 'refresh');
    }
}
