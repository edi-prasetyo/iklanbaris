<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Layanan extends CI_Controller
{
    /*
     * Halaman Pengaturan Layanan
     * Url Akses : https://domainanda.com/admin/layanan
     * Created By Edi Prasetyo
     * Url : https://grahastudio.com
     */
    //load data
    public function __construct()
    {
        parent::__construct();
        $this->load->model('layanan_model');
        $id = $this->session->userdata('id');
        $user = $this->user_model->user_detail($id);
        if ($user->role_id == 3) {
            redirect('admin/dashboard');
        }
    }
    //Index Layanan
    public function index()
    {
        $layanan = $this->layanan_model->get_layanan();
        $data = [
            'title'                     => 'Layanan',
            'layanan'                   => $layanan,
            'content'                   => 'admin/layanan/index_layanan'
        ];
        $this->load->view('admin/layout/wrapp', $data, FALSE);
    }
    // Create layanan
    public function create()
    {
        $this->form_validation->set_rules(
            'layanan_title',
            'Judul Layanan',
            'required',
            array('required'            => '%s Harus Diisi')
        );
        if ($this->form_validation->run() === FALSE) {
            $data = [
                'title'                 => 'Tambah Layanan',
                'content'               => 'admin/layanan/create_layanan'
            ];
            $this->load->view('admin/layout/wrapp', $data, FALSE);
        } else {
            $slugcode = random_string('numeric', 5);
            $layanan_slug  = url_title($this->input->post('layanan_title'), 'dash', TRUE);
            $data  = [
                'layanan_slug'           => $layanan_slug . '-' . $slugcode,
                'layanan_title'          => $this->input->post('layanan_title'),
                'layanan_icon'           => $this->input->post('layanan_icon'),
                'layanan_desc'           => $this->input->post('layanan_desc'),
                'date_created'           => time()
            ];
            $this->layanan_model->create($data);
            $this->session->set_flashdata('message', 'Data telah dibuat');
            redirect(base_url('admin/layanan'), 'refresh');
        }
    }
    //Update Layanan
    public function update($id)
    {
        $layanan = $this->layanan_model->detail_layanan($id);
        //Membuat Validasi
        $this->form_validation->set_rules(
            'layanan_title',
            'Judul Halaman',
            'required',
            array('required'         => '%s Harus Diisi')
        );
        if ($this->form_validation->run() === FALSE) {
            $data = [
                'title'                 => 'Edit kategori Berita',
                'layanan'               => $layanan,
                'content'               => 'admin/layanan/update_layanan'
            ];
            $this->load->view('admin/layout/wrapp', $data, FALSE);
        } else {
            $data  = [
                'id'                    => $id,
                'layanan_title'         => $this->input->post('layanan_title'),
                'layanan_desc'          => $this->input->post('layanan_desc'),
                'date_updated'          => time()
            ];
            $this->layanan_model->update($data);
            $this->session->set_flashdata('message', 'Data telah di Update');
            redirect(base_url('admin/layanan'), 'refresh');
        }
    }
    //Hapus data Layanan
    public function delete($id)
    {
        //Proteksi delete
        is_login();
        $layanan = $this->layanan_model->detail_layanan($id);
        $data = ['id'   => $layanan->id];
        $this->layanan_model->delete($data);
        $this->session->set_flashdata('message', 'Data telah di Hapus');
        redirect(base_url('admin/layanan'), 'refresh');
    }
}
