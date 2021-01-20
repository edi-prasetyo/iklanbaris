<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Page extends CI_Controller
{
    //load data
    public function __construct()
    {
        parent::__construct();
        $this->load->library('pagination');
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
        $config['base_url']       = base_url('admin/page/index/');
        $config['total_rows']     = count($this->page_model->total_row());
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

        $page = $this->page_model->get_page($limit, $start);
        $data = [
            'title'             => 'Halaman',
            'page'              => $page,
            'pagination'    => $this->pagination->create_links(),
            'content'           => 'admin/page/index_page'
        ];
        $this->load->view('admin/layout/wrapp', $data, FALSE);
    }
    // Create
    public function create()
    {
        $this->form_validation->set_rules(
            'page_title',
            'Judul Halaman',
            'required',
            array(
                'required'         => '%s Harus Diisi'
            )
        );
        $this->form_validation->set_rules(
            'page_desc',
            'Deskripsi Halaman',
            'required',
            array(
                'required'         => '%s Harus Diisi'
            )
        );
        if ($this->form_validation->run() === FALSE) {
            $data = [
                'title'             => 'Buat Halaman',
                'deskripsi'         => 'Deskripsi',
                'keywords'          => 'Keywords',
                'content'           => 'admin/page/create_page'
            ];
            $this->load->view('admin/layout/wrapp', $data, FALSE);
        } else {
            $slugcode = random_string('numeric', 5);
            $page_slug  = url_title($this->input->post('page_title'), 'dash', TRUE);
            $data  = [
                'user_id'       => $this->session->userdata('id'),
                'page_slug'     =>  $page_slug . '-' . $slugcode,
                'page_title'     => $this->input->post('page_title'),
                'page_desc'     => $this->input->post('page_desc'),
                'date_created'      => time()
            ];
            $this->page_model->create($data);
            $this->session->set_flashdata('message', 'Data telah ditambahkan');
            redirect(base_url('admin/page'), 'refresh');
        }
    }
    //Update
    public function update($id)
    {
        $page = $this->page_model->detail_page($id);
        //Validasi
        $this->form_validation->set_rules(
            'page_title',
            'Judul Halaman',
            'required',
            array('required'         => '%s Harus Diisi')
        );
        $this->form_validation->set_rules(
            'page_desc',
            'Deskripsi Halaman',
            'required',
            array('required'         => '%s Harus Diisi')
        );
        if ($this->form_validation->run() === FALSE) {
            //End Validasi

            $data = [
                'title'             => 'Edit halaman',
                'page'              => $page,
                'content'           => 'admin/page/update_page'
            ];
            $this->load->view('admin/layout/wrapp', $data, FALSE);
            //Masuk Database
        } else {

            $data  = [
                'id'                => $id,
                'user_id'       => $this->session->userdata('id'),
                'page_title'     => $this->input->post('page_title'),
                'page_desc'     => $this->input->post('page_desc'),
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
