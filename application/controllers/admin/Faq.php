<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Faq extends CI_Controller
{
    //load data
    public function __construct()
    {
        parent::__construct();
        $this->load->helper('string');
        $this->load->library('pagination');
        $this->load->model('faq_model');

        $id = $this->session->userdata('id');
        $user = $this->user_model->user_detail($id);
        if ($user->role_id == 2) {
            redirect('admin/dashboard');
        }
    }
    //Index FAQ
    public function index()
    {
        $config['base_url']       = base_url('admin/faq/index/');
        $config['total_rows']     = count($this->faq_model->total_row());
        $config['per_faq']       = 10;
        $config['uri_segment']    = 4;

        //Membuat Style pagination untuk BootStrap v4
        $config['first_link']       = 'First';
        $config['last_link']        = 'Last';
        $config['next_link']        = 'Next';
        $config['prev_link']        = 'Prev';
        $config['full_tag_open']    = '<div class="pagging text-center"><nav><ul class="pagination justify-content-center">';
        $config['full_tag_close']   = '</ul></nav></div>';
        $config['num_tag_open']     = '<li class="faq-item"><span class="faq-link">';
        $config['num_tag_close']    = '</span></li>';
        $config['cur_tag_open']     = '<li class="faq-item active"><span class="faq-link">';
        $config['cur_tag_close']    = '<span class="sr-only">(current)</span></span></li>';
        $config['next_tag_open']    = '<li class="faq-item"><span class="faq-link">';
        $config['next_tagl_close']  = '<span aria-hidden="true">&raquo;</span></span></li>';
        $config['prev_tag_open']    = '<li class="faq-item"><span class="faq-link">';
        $config['prev_tagl_close']  = '</span>Next</li>';
        $config['first_tag_open']   = '<li class="faq-item"><span class="faq-link">';
        $config['first_tagl_close'] = '</span></li>';
        $config['last_tag_open']    = '<li class="faq-item"><span class="faq-link">';
        $config['last_tagl_close']  = '</span></li>';


        //Limit dan Start
        $limit                    = $config['per_faq'];
        $start                    = ($this->uri->segment(4)) ? ($this->uri->segment(4)) : 0;
        //End Limit Start
        $this->pagination->initialize($config);

        $faq = $this->faq_model->get_faq($limit, $start);
        $data = [
            'title'             => 'Halaman',
            'faq'              => $faq,
            'pagination'    => $this->pagination->create_links(),
            'content'           => 'admin/faq/index_faq'
        ];
        $this->load->view('admin/layout/wrapp', $data, FALSE);
    }
    // Create
    public function create()
    {
        $this->form_validation->set_rules(
            'faq_answer',
            'Pertanyaan',
            'required',
            array(
                'required'         => '%s Harus Diisi'
            )
        );
        $this->form_validation->set_rules(
            'faq_question',
            'Jawaban',
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
                'content'           => 'admin/faq/create_faq'
            ];
            $this->load->view('admin/layout/wrapp', $data, FALSE);
        } else {

            $collapse = strtoupper(random_string('alpha', 5));
            $data  = [
                'user_id'           => $this->session->userdata('id'),
                'collapse'          => $collapse,
                'faq_answer'        => $this->input->post('faq_answer'),
                'faq_question'      => $this->input->post('faq_question'),
                'faq_status'        => $this->input->post('faq_status'),
                'date_created'      => time()
            ];
            $this->faq_model->create($data);
            $this->session->set_flashdata('message', 'Data telah ditambahkan');
            redirect(base_url('admin/faq'), 'refresh');
        }
    }
    //Update
    public function update($id)
    {
        $faq = $this->faq_model->detail_faq($id);
        //Validasi
        $this->form_validation->set_rules(
            'faq_answer',
            'Pertanyaan',
            'required',
            array('required'         => '%s Harus Diisi')
        );
        $this->form_validation->set_rules(
            'faq_question',
            'Jawaban',
            'required',
            array('required'         => '%s Harus Diisi')
        );
        if ($this->form_validation->run() === FALSE) {
            //End Validasi

            $data = [
                'title'             => 'Edit FAQ',
                'faq'              => $faq,
                'content'           => 'admin/faq/update_faq'
            ];
            $this->load->view('admin/layout/wrapp', $data, FALSE);
            //Masuk Database
        } else {

            $data  = [
                'id'                => $id,
                'user_id'           => $this->session->userdata('id'),
                'faq_answer'        => $this->input->post('faq_answer'),
                'faq_question'      => $this->input->post('faq_question'),
                'faq_status'        => $this->input->post('faq_status'),
                'date_updated'      => time()
            ];
            $this->faq_model->update($data);
            $this->session->set_flashdata('message', 'Data telah di Update');
            redirect(base_url('admin/faq'), 'refresh');
        }
        //End Masuk Database
    }
    //delete Category
    public function delete($id)
    {
        //Proteksi delete
        is_login();

        $faq = $this->faq_model->detail_faq($id);
        $data = ['id'   => $faq->id];

        $this->faq_model->delete($data);
        $this->session->set_flashdata('message', 'Data telah di Hapus');
        redirect(base_url('admin/faq'), 'refresh');
    }
}
