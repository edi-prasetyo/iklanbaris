<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Berita extends CI_Controller
{
    //load data
    public function __construct()
    {
        parent::__construct();
        $this->load->model('berita_model');
        $this->load->model('category_model');
        $this->load->library('pagination');

        $id = $this->session->userdata('id');
        $user = $this->user_model->user_detail($id);
        if ($user->role_id == 2) {
            redirect('admin/dashboard');
        }
    }
    //listing data berita
    public function index()
    {
        $config['base_url']         = base_url('admin/berita/index/');
        $config['total_rows']       = count($this->berita_model->total_row());
        $config['per_page']         = 10;
        $config['uri_segment']      = 4;
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

        $berita = $this->berita_model->get_berita($limit, $start);
        $data = [
            'title'         => 'Data Artikel',
            'berita'        => $berita,
            'pagination'    => $this->pagination->create_links(),
            'content'       => 'admin/berita/index_berita'
        ];
        $this->load->view('admin/layout/wrapp', $data, FALSE);
    }
    //Create New Berita
    public function create()
    {
        $category = $this->category_model->get_category_blog();
        // Validasi
        $this->form_validation->set_rules(
            'berita_title',
            'Judul Berita',
            'required',
            [
                'required'      => 'Judul Berita harus di isi',
            ]
        );
        $this->form_validation->set_rules(
            'berita_desc',
            'Deskripsi Berita',
            'required',
            [
                'required'      => 'Deskripsi Berita harus di isi',
            ]
        );
        if ($this->form_validation->run()) {

            $config['upload_path']          = './assets/img/artikel/';
            $config['allowed_types']        = 'gif|jpg|png|jpeg';
            $config['max_size']             = 500000; //Dalam Kilobyte
            $config['max_width']            = 500000; //Lebar (pixel)
            $config['max_height']           = 500000; //tinggi (pixel)
            $this->load->library('upload', $config);
            if (!$this->upload->do_upload('berita_gambar')) {

                //End Validasi
                $data = [
                    'title'                 => 'Tambah Berita',
                    'category'              => $category,
                    'error_upload'          => $this->upload->display_errors(),
                    'content'               => 'admin/berita/create_berita'
                ];
                $this->load->view('admin/layout/wrapp', $data, FALSE);

                //Masuk Database

            } else {

                //Proses Upload Gambar
                $upload_data    = array('uploads'  => $this->upload->data());
                $config['image_library']    = 'gd2';
                $config['source_image']     = './assets/img/artikel/' . $upload_data['uploads']['file_name'];
                $config['create_thumb']     = TRUE;
                $config['maintain_ratio']   = TRUE;
                $config['width']            = 500;
                $config['height']           = 500;
                $config['thumb_marker']     = '';

                $this->load->library('image_lib', $config);
                $this->image_lib->resize();
                $slugcode = random_string('numeric', 5);
                $berita_slug  = url_title($this->input->post('berita_title'), 'dash', TRUE);
                $data  = [
                    'user_id'           => $this->session->userdata('id'),
                    'category_id'       => $this->input->post('category_id'),
                    'berita_slug'       => $berita_slug . '-' . $slugcode,
                    'berita_title'      => $this->input->post('berita_title'),
                    'berita_desc'       => $this->input->post('berita_desc'),
                    'berita_gambar'     => $upload_data['uploads']['file_name'],
                    'berita_status'     => $this->input->post('berita_status'),
                    'berita_keywords'   => $this->input->post('berita_keywords'),
                    'date_created'      => time()
                ];
                $this->berita_model->create($data);
                $this->session->set_flashdata('message', 'Data Berita telah ditambahkan');
                redirect(base_url('admin/berita'), 'refresh');
            }
        }
        //End Masuk Database
        $data = [
            'title'             => 'Tambah Berita',
            'category'          => $category,
            'content'           => 'admin/berita/create_berita'
        ];
        $this->load->view('admin/layout/wrapp', $data, FALSE);
    }

    //Edit Berita
    public function Update($id)
    {
        $berita = $this->berita_model->berita_detail($id);
        $category = $this->category_model->get_category_blog();
        //Validasi
        $valid = $this->form_validation;
        $valid->set_rules(
            'berita_title',
            'Judul Berita',
            'required',
            ['required'      => '%s harus diisi']
        );

        $valid->set_rules(
            'berita_desc',
            'Isi Berita',
            'required',
            ['required'      => '%s harus diisi']
        );
        if ($valid->run()) {
            //Kalau nggak Ganti gambar
            if (!empty($_FILES['berita_gambar']['name'])) {

                $config['upload_path']          = './assets/img/artikel/';
                $config['allowed_types']        = 'gif|jpg|png|jpeg';
                $config['max_size']             = 5000; //Dalam Kilobyte
                $config['max_width']            = 5000; //Lebar (pixel)
                $config['max_height']           = 5000; //tinggi (pixel)
                $this->load->library('upload', $config);
                if (!$this->upload->do_upload('berita_gambar')) {

                    //End Validasi
                    $data = [
                        'title'             => 'Edit Berita',
                        'category'          => $category,
                        'berita'            => $berita,
                        'error_upload'      => $this->upload->display_errors(),
                        'content'           => 'admin/berita/update_berita'
                    ];
                    $this->load->view('admin/layout/wrapp', $data, FALSE);

                    //Masuk Database

                } else {

                    //Proses Upload Gambar
                    $upload_data    = array('uploads'  => $this->upload->data());
                    $config['image_library']    = 'gd2';
                    $config['source_image']     = './assets/img/artikel/' . $upload_data['uploads']['file_name'];
                    $config['create_thumb']     = TRUE;
                    $config['maintain_ratio']   = TRUE;
                    $config['width']            = 500;
                    $config['height']           = 500;
                    $config['thumb_marker']     = '';

                    $this->load->library('image_lib', $config);
                    $this->image_lib->resize();
                    // Hapus Gambar Lama Jika Ada upload gambar baru
                    if ($berita->berita_gambar != "") {
                        unlink('./assets/img/artikel/' . $berita->berita_gambar);
                    }
                    //End Hapus Gambar

                    $data  = [
                        'id'                => $id,
                        'user_id'           => $this->session->userdata('id'),
                        'category_id'       => $this->input->post('category_id'),
                        // 'berita_slug'       => url_title($this->input->post('berita_title'), 'dash', TRUE),
                        'berita_title'      => $this->input->post('berita_title'),
                        'berita_desc'       => $this->input->post('berita_desc'),
                        'berita_gambar'     => $upload_data['uploads']['file_name'],
                        'berita_status'     => $this->input->post('berita_status'),
                        'berita_keywords'   => $this->input->post('berita_keywords'),
                        'date_updated'      => time()
                    ];
                    $this->berita_model->update($data);
                    $this->session->set_flashdata('message', 'Data telah di Update');
                    redirect(base_url('admin/berita'), 'refresh');
                }
            } else {
                //Update Berita Tanpa Ganti Gambar
                // Hapus Gambar Lama Jika ada upload gambar baru
                if ($berita->berita_gambar != "")
                    $data  = [
                        'id'                => $id,
                        'user_id'           => $this->session->userdata('id'),
                        'category_id'       => $this->input->post('category_id'),
                        // 'berita_slug'       => url_title($this->input->post('berita_title'), 'dash', TRUE),
                        'berita_title'      => $this->input->post('berita_title'),
                        'berita_desc'       => $this->input->post('berita_desc'),
                        //'gambar'          => $upload_data['uploads']['file_name'],
                        'berita_status'     => $this->input->post('berita_status'),
                        'berita_keywords'   => $this->input->post('berita_keywords'),
                        'date_updated'      => time()
                    ];
                $this->berita_model->update($data);
                $this->session->set_flashdata('message', 'Data telah di Update');
                redirect(base_url('admin/berita'), 'refresh');
            }
        }
        //End Masuk Database
        $data = [
            'title'             => 'Update Berita',
            'category'          => $category,
            'berita'            => $berita,
            'content'           => 'admin/berita/update_berita'
        ];
        $this->load->view('admin/layout/wrapp', $data, FALSE);
    }

    //delete
    public function delete($id)
    {
        //Proteksi delete
        is_login();

        $berita = $this->berita_model->berita_detail($id);
        //Hapus gambar

        if ($berita->berita_gambar != "") {
            unlink('./assets/img/artikel/' . $berita->berita_gambar);
        }
        //End Hapus Gambar
        $data = ['id'   => $berita->id];
        $this->berita_model->delete($data);
        $this->session->set_flashdata('message', 'Data telah di Hapus');
        redirect($_SERVER['HTTP_REFERER']);
    }
}
