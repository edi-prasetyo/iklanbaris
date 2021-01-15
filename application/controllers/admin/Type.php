<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Type extends CI_Controller
{
    //load data
    public function __construct()
    {
        parent::__construct();
        $this->load->model('type_model');

        $id = $this->session->userdata('id');
        $user = $this->user_model->user_detail($id);
        if ($user->role_id == 2) {
            redirect('admin/dashboard');
        }
    }
    //Index Type
    public function index()
    {
        $type = $this->type_model->get_type();
        //Validasi
        $this->form_validation->set_rules(
            'type_name',
            'Nama Kategori',
            'required',
            array(
                'required'         => '%s Harus Diisi',
                'is_unque'         => '%s <strong>' . $this->input->post('type_name') .
                    '</strong>Nama Kategori Sudah Ada. Buat Nama yang lain!'
            )
        );
        if ($this->form_validation->run() === FALSE) {
            $data = [
                'title'             => 'Type',
                'type'          => $type,
                'content'           => 'admin/type/index_type'
            ];
            $this->load->view('admin/layout/wrapp', $data, FALSE);
        } else {
            $slugcode = random_string('numeric', 5);
            $type_slug  = url_title($this->input->post('type_name'), 'dash', TRUE);
            $data  = [
                'type_slug'     =>  $type_slug . '-' .$slugcode,
                'type_name'     => $this->input->post('type_name'),
                'date_created'      => time()
            ];
            $this->type_model->create($data);
            $this->session->set_flashdata('message', 'Data telah ditambahkan');
            redirect(base_url('admin/type'), 'refresh');
        }
    }
    //Update
    public function update($id)
    {
        $type = $this->type_model->detail_type($id);
        //Validasi
        $this->form_validation->set_rules(
            'type_name',
            'Nama Kategori',
            'required',
            array('required'         => '%s Harus Diisi')
        );
        if ($this->form_validation->run() === FALSE) {
            //End Validasi

            $data = [
                'title'             => 'Edit kategori Berita',
                'type'          => $type,
                'content'           => 'admin/type/update_type'
            ];
            $this->load->view('admin/layout/wrapp', $data, FALSE);
            //Masuk Database
        } else {

            $data  = [
                'id'                => $id,
                'type_name'     => $this->input->post('type_name'),
                'date_updated'      => time()
            ];
            $this->type_model->update($data);
            $this->session->set_flashdata('message', 'Data telah di Update');
            redirect(base_url('admin/type'), 'refresh');
        }
        //End Masuk Database
    }
    //delete Type
    public function delete($id)
    {
        //Proteksi delete
        is_login();

        $type = $this->type_model->detail_type($id);
        $data = ['id'   => $type->id];

        $this->type_model->delete($data);
        $this->session->set_flashdata('message', 'Data telah di Hapus');
        redirect(base_url('admin/type'), 'refresh');
    }
}
