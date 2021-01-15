<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Iklan extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('pagination');
        $this->load->model('user_model');
        $this->load->model('iklan_model');
        $this->load->model('category_model');
        $this->load->model('province_model');
    }

    // Listing Iklan iklan

    public function index()
    {
        $id = $this->session->userdata('id');
        $user = $this->user_model->user_detail($id);
        $meta = $this->meta_model->get_meta();


        $config['base_url']       = base_url('myaccount/iklan/index/');
        $config['total_rows']     = count($this->iklan_model->total_row_user());
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
        $iklan = $this->iklan_model->get_iklan_user($limit, $start, $id);

        // End Listing iklan dengan paginasi
        $data = array(
            'title'       => 'Iklan Saya',
            'deskripsi'   => 'iklan - ' . $meta->description,
            'keywords'    => 'iklan - ' . $meta->keywords,
            'user'        => $user,
            'meta'        => $meta,
            'iklan'    => $iklan,
            'pagination'    => $this->pagination->create_links(),
            'content'     => 'myaccount/iklan/index_iklan'
        );
        $this->load->view('myaccount/layout/wrapp', $data, FALSE);
    }

    // Create Iklan iklan
    public function create()
    {

        // Get type
        $category = $this->category_model->get_category_iklan();
        $province = $this->province_model->get_province();
        // Validasi
        $this->form_validation->set_rules(
            'iklan_title',
            'Judul Iklan',
            'required',
            ['required'      => 'Judul Iklan harus di isi',]
        );
        $this->form_validation->set_rules(
            'province_id',
            'Provinsi',
            'required',
            ['required'      => 'Anda harus memilih Provinsi',]
        );
        $this->form_validation->set_rules(
            'category_id',
            'Kategori',
            'required',
            ['required'      => 'Anda harus memilih Kategori',]
        );
        $this->form_validation->set_rules(
            'iklan_type',
            'Model',
            'required',
            ['required'      => 'Model harus di isi',]
        );
        $this->form_validation->set_rules(
            'iklan_price',
            'Harga Barang',
            'required',
            ['required'      => 'Harga Barang harus di isi',]
        );
        $this->form_validation->set_rules(
            'iklan_merek',
            'Merek Barang',
            'required',
            ['required'      => 'Merek Barang harus di isi',]
        );
        $this->form_validation->set_rules(
            'iklan_desc',
            'Merek Barang',
            'required',
            ['required'      => 'Deskripsi Iklan harus di isi',]
        );
        if ($this->form_validation->run()) {

            $config['upload_path']          = './assets/img/iklan/';
            $config['allowed_types']        = 'gif|jpg|png|jpeg|svg';
            $config['max_size']             = 5000; //Dalam Kilobyte
            $config['max_width']            = 5000; //Lebar (pixel)
            $config['max_height']           = 5000; //tinggi (pixel)
            $this->load->library('upload', $config);
            if (!$this->upload->do_upload('iklan_image')) {

                $data = [
                    'title'        => 'Tambah iklan',
                    'deskripsi'     => 'deskripsi',
                    'keywords'      => 'keywords',
                    'category'          => $category,
                    'province'      => $province,
                    'content'       => 'myaccount/iklan/create_iklan'
                ];
                $this->load->view('myaccount/layout/wrapp', $data, FALSE);
            } else {

                //Proses Manipulasi Gambar
                $upload_data    = array('uploads'  => $this->upload->data());
                //Gambar Asli disimpan di folder assets/upload/image
                //lalu gambara Asli di copy untuk versi mini size ke folder assets/upload/image/thumbs

                $config['image_library']    = 'gd2';
                $config['source_image']     = './assets/img/iklan/' . $upload_data['uploads']['file_name'];
                //Gambar Versi Kecil dipindahkan
                // $config['new_image']        = './assets/img/artikel/thumbs/' . $upload_data['uploads']['file_name'];
                $config['create_thumb']     = TRUE;
                $config['maintain_ratio']   = TRUE;
                $config['width']            = 500;
                $config['height']           = 500;
                $config['thumb_marker']     = '';

                $this->load->library('image_lib', $config);
                $this->image_lib->resize();

                $slugcode       = random_string('numeric', 5);
                $iklan_slug  = url_title($this->input->post('iklan_title'), 'dash', TRUE);
                $id_iklan =  random_string('numeric', 7);

                $data = [
                    'user_id'                   => $this->session->userdata('id'),
                    'province_id'               => $this->input->post('province_id'),
                    'id_iklan'                  => $id_iklan,
                    'category_id'               => $this->input->post('category_id'),
                    'iklan_slug'                => $slugcode . '-' . $iklan_slug,
                    'iklan_title'               => $this->input->post('iklan_title'),
                    'iklan_status'              => 'Active',
                    'iklan_merek'               => $this->input->post('iklan_merek'),
                    'iklan_type'                => $this->input->post('iklan_type'),
                    'iklan_kondisi'             => $this->input->post('iklan_kondisi'),
                    'iklan_price'               => $this->input->post('iklan_price'),
                    'iklan_negotiable'            => $this->input->post('iklan_negotiable'),
                    'iklan_desc'                => $this->input->post('iklan_desc'),

                    'iklan_image'                 => $upload_data['uploads']['file_name'],
                    'iklan_keywords'         => $this->input->post('iklan_keywords'),
                    'date_created'              => time()
                ];
                $insert_id = $this->iklan_model->create($data);
                $this->upload_images($insert_id);
                $this->session->set_flashdata('message', 'Data Iklan telah ditambahkan');
                redirect(base_url('myaccount/iklan'), 'refresh');
            }
        }

        $data = [
            'title'        => 'Tambah Iklan',
            'deskripsi'     => 'deskripsi',
            'keywords'      => 'keywords',
            'category'          => $category,
            'province'      => $province,
            'content'       => 'myaccount/iklan/create_iklan'
        ];
        $this->load->view('myaccount/layout/wrapp', $data, FALSE);
    }
}
