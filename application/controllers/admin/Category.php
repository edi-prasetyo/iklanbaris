<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Category extends CI_Controller
{
    //load data
    public function __construct()
    {
        parent::__construct();
        $this->load->library('pagination');
        $this->load->model('category_model');

        $id = $this->session->userdata('id');
        $user = $this->user_model->user_detail($id);
        if ($user->role_id == 2) {
            redirect('admin/dashboard');
        }
    }
    //Index Category
    public function index()
    {

        $config['base_url']       = base_url('admin/category/index/');
        $config['total_rows']     = count($this->category_model->total_row());
        $config['per_page']       = 6;
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


        $category = $this->category_model->get_category($limit, $start);

        $data = [
            'title'             => 'Category',
            'category'          => $category,
            'pagination'    => $this->pagination->create_links(),
            'content'           => 'admin/category/index_category'
        ];
        $this->load->view('admin/layout/wrapp', $data, FALSE);
    }


    //Create New Category
    public function create()
    {



        // Validasi
        $this->form_validation->set_rules(
            'category_name',
            'Nama Kategori',
            'required',
            array(
                'required'         => '%s Harus Diisi',
                'is_unque'         => '%s <strong>' . $this->input->post('category_name') .
                    '</strong>Nama Kategori Sudah Ada. Buat Nama yang lain!'
            )
        );
        if ($this->form_validation->run()) {

            $config['upload_path']          = './assets/img/category/';
            $config['allowed_types']        = 'gif|jpg|png|jpeg|svg';
            $config['max_size']             = 500000; //Dalam Kilobyte
            $config['max_width']            = 500000; //Lebar (pixel)
            $config['max_height']           = 500000; //tinggi (pixel)
            $this->load->library('upload', $config);
            if (!$this->upload->do_upload('category_image')) {

                //End Validasi
                $data = [
                    'title'        => 'Tambah Category',
                    'error_upload' => $this->upload->display_errors(),
                    'content'       => 'admin/category/create_category'
                ];
                $this->load->view('admin/layout/wrapp', $data, FALSE);

                //Masuk Database

            } else {


                $upload_data    = array('uploads'  => $this->upload->data());
                $config['image_library']    = 'gd2';
                $config['source_image']     = './assets/img/category/' . $upload_data['uploads']['file_name'];
                $config['create_thumb']     = TRUE;
                $config['maintain_ratio']   = TRUE;
                $config['width']            = 500;
                $config['height']           = 500;
                $config['thumb_marker']     = '';

                $this->load->library('image_lib', $config);
                $this->image_lib->resize();
                $slugcode = random_string('numeric', 5);
                $category_slug  = url_title($this->input->post('category_name'), 'dash', TRUE);
                $data  = [
                    'category_slug'     => $slugcode . '-' . $category_slug,
                    'category_name'     => $this->input->post('category_name'),
                    'category_type'     => $this->input->post('category_type'),
                    'category_image'     => $upload_data['uploads']['file_name'],
                    'date_created'      => time()
                ];
                $this->category_model->create($data);
                $this->session->set_flashdata('message', 'Data Category telah ditambahkan');
                redirect(base_url('admin/category'), 'refresh');
            }
        }
        //End Masuk Database
        $data = [
            'title'        => 'Tambah Category',
            'content'          => 'admin/category/create_category'
        ];
        $this->load->view('admin/layout/wrapp', $data, FALSE);
    }
    //Update
    public function update($id)
    {
        $category = $this->category_model->detail_category($id);

        //Validasi
        $valid = $this->form_validation;

        $valid->set_rules(
            'category_name',
            'Nama Kategori',
            'required',
            ['required'      => '%s harus diisi']
        );


        if ($valid->run()) {
            //Kalau nggak Ganti gambar
            if (!empty($_FILES['category_image']['name'])) {

                $config['upload_path']          = './assets/img/category/';
                $config['allowed_types']        = 'gif|jpg|png|jpeg|svg';
                $config['max_size']             = 5000; //Dalam Kilobyte
                $config['max_width']            = 5000; //Lebar (pixel)
                $config['max_height']           = 5000; //tinggi (pixel)
                $this->load->library('upload', $config);
                if (!$this->upload->do_upload('category_image')) {

                    //End Validasi
                    $data = [
                        'title'        => 'Edit kategori',
                        'category'     => $category,
                        'error_upload' => $this->upload->display_errors(),
                        'content'          => 'admin/category/update_category'
                    ];
                    $this->load->view('admin/layout/wrapp', $data, FALSE);

                    //Masuk Database

                } else {

                    //Proses Manipulasi Gambar
                    $upload_data    = array('uploads'  => $this->upload->data());
                    //Gambar Asli disimpan di folder assets/upload/image
                    //lalu gambar Asli di copy untuk versi mini size ke folder assets/upload/image/thumbs

                    $config['image_library']    = 'gd2';
                    $config['source_image']     = './assets/img/category/' . $upload_data['uploads']['file_name'];
                    //Gambar Versi Kecil dipindahkan
                    // $config['new_image']        = './assets/img/artikel/thumbs/' . $upload_data['uploads']['file_name'];
                    $config['create_thumb']     = TRUE;
                    $config['maintain_ratio']   = TRUE;
                    $config['width']            = 500;
                    $config['height']           = 500;
                    $config['thumb_marker']     = '';

                    $this->load->library('image_lib', $config);

                    $this->image_lib->resize();

                    // Hapus Gambar Lama Jika Ada upload gambar baru
                    if ($category->category_image != "") {
                        unlink('./assets/img/category/' . $category->category_image);
                        // unlink('./assets/img/artikel/thumbs/' . $berita->berita_gambar);
                    }
                    //End Hapus Gambar

                    $data  = [
                        'id'                => $id,
                        'category_name'     => $this->input->post('category_name'),
                        'category_type'     => $this->input->post('category_type'),
                        'category_image'     => $upload_data['uploads']['file_name'],
                        'date_updated'      => time()
                    ];
                    $this->category_model->update($data);
                    $this->session->set_flashdata('message', 'Data telah di Update');
                    redirect(base_url('admin/category'), 'refresh');
                }
            } else {
                //Update Berita Tanpa Ganti Gambar
                // Hapus Gambar Lama Jika ada upload gambar baru
                if ($category->category_image != "")
                    $data  = [
                        'id'         => $id,
                        'category_name'     => $this->input->post('category_name'),
                        'category_type'     => $this->input->post('category_type'),
                        'date_updated'      => time()
                    ];
                $this->category_model->update($data);
                $this->session->set_flashdata('message', 'Data telah di Update');
                redirect(base_url('admin/category'), 'refresh');
            }
        }
        //End Masuk Database
        $data = [
            'title'        => 'Update Berita',
            'category'     => $category,
            'content'          => 'admin/category/update_category'
        ];
        $this->load->view('admin/layout/wrapp', $data, FALSE);
    }
    //delete Category
    public function delete($id)
    {
        //Proteksi delete
        is_login();

        $category = $this->category_model->detail_category($id);

        if ($category->category_image != "") {
            unlink('./assets/img/category/' . $category->category_image);
            // unlink('./assets/img/artikel/thumbs/' . $berita->berita_gambar);
        }

        $data = ['id'   => $category->id];

        $this->category_model->delete($data);
        $this->session->set_flashdata('message', 'Data telah di Hapus');
        redirect(base_url('admin/category'), 'refresh');
    }
}
