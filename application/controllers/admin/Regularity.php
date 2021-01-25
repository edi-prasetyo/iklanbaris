<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Regularity extends CI_Controller
{
    //load data
    public function __construct()
    {
        parent::__construct();
        $this->load->helper('string');
        $this->load->library('pagination');
        $this->load->model('regularity_model');

        $id = $this->session->userdata('id');
        $user = $this->user_model->user_detail($id);
        if ($user->role_id == 2) {
            redirect('admin/dashboard');
        }
    }
    //Index
    public function index()
    {
        $config['base_url']       = base_url('admin/regularity/index/');
        $config['total_rows']     = count($this->regularity_model->total_row());
        $config['per_page']       = 10;
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

        $regularity = $this->regularity_model->get_regularity($limit, $start);
        $data = [
            'title'             => 'Peraturan',
            'regularity'              => $regularity,
            'pagination'    => $this->pagination->create_links(),
            'content'           => 'admin/regularity/index_regularity'
        ];
        $this->load->view('admin/layout/wrapp', $data, FALSE);
    }
    // Create
    public function create()
    {
        $regularity = $this->regularity_model->get_regularity();
        $this->form_validation->set_rules(
            'regularity_name',
            'Nama Peraturan',
            'required',
            array(
                'required'         => '%s Harus Diisi'
            )
        );
        $this->form_validation->set_rules(
            'regularity_type',
            'Type',
            'required',
            array(
                'required'         => '%s Harus Diisi'
            )
        );
        if ($this->form_validation->run() === FALSE) {
            $data = [
                'title'             => 'Buat FAQ',
                'deskripsi'         => 'Deskripsi',
                'keywords'          => 'Keywords',
                'regularity'        => $regularity,
                'content'           => 'admin/regularity/index_regularity'
            ];
            $this->load->view('admin/layout/wrapp', $data, FALSE);
        } else {

            $data  = [
                'user_id'                   => $this->session->userdata('id'),
                'regularity_name'           => $this->input->post('regularity_name'),
                'regularity_type'           => $this->input->post('regularity_type'),
                'date_created'              => time()
            ];
            $this->regularity_model->create($data);
            $this->session->set_flashdata('message', 'Data telah ditambahkan');
            redirect(base_url('admin/regularity'), 'refresh');
        }
    }
    //Update
    public function update($id)
    {
        $regularity = $this->regularity_model->detail_regularity($id);
        //Validasi
        $this->form_validation->set_rules(
            'regularity_name',
            'Nama Peraturan',
            'required',
            array('required'         => '%s Harus Diisi')
        );
        $this->form_validation->set_rules(
            'regularity_type',
            'Jawaban',
            'required',
            array('required'         => '%s Harus Diisi')
        );
        if ($this->form_validation->run() === FALSE) {
            //End Validasi

            $data = [
                'title'                     => 'Edit Peraturan',
                'regularity'                => $regularity,
                'content'                   => 'admin/regularity/update_regularity'
            ];
            $this->load->view('admin/layout/wrapp', $data, FALSE);
            //Masuk Database
        } else {

            $data  = [
                'id'                        => $id,
                'user_id'                   => $this->session->userdata('id'),
                'regularity_name'           => $this->input->post('regularity_name'),
                'regularity_type'           => $this->input->post('regularity_type'),
                'date_updated'              => time()
            ];
            $this->regularity_model->update($data);
            $this->session->set_flashdata('message', 'Data telah di Update');
            redirect(base_url('admin/regularity'), 'refresh');
        }
        //End Masuk Database
    }
    //delete
    public function delete($id)
    {
        //Proteksi delete
        is_login();

        $regularity = $this->regularity_model->detail_regularity($id);
        $data = ['id'   => $regularity->id];

        $this->regularity_model->delete($data);
        $this->session->set_flashdata('message', 'Data telah di Hapus');
        redirect(base_url('admin/regularity'), 'refresh');
    }
}
