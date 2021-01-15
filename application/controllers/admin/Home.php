<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Home extends CI_Controller
{

    //Load Model
    public function __construct()
    {
        parent::__construct();
        $this->load->library('pagination');
        $this->load->model('user_model');
        $this->load->model('kas_model');
        $this->load->model('category_model');
    }

    //main page - Berita
    public function index()
    {
        $id                         = $this->session->userdata('id');
        $user                       = $this->user_model->user_detail($id);
        $total_pemasukan_user       = $this->kas_model->total_pemasukan_user($id);
        $total_pengeluaran_user     = $this->kas_model->total_pengeluaran_user($id);

        // End Listing Berita dengan paginasi
        $data = array(
            'title'                     => 'Welcome',
            'total_pemasukan_user'      => $total_pemasukan_user,
            'total_pengeluaran_user'    => $total_pengeluaran_user,
            'user'                      => $user,
            'content'                   => 'admin/home/index_home'
        );
        $this->load->view('admin/layout/wrapp', $data, FALSE);
    }
    // List Data Pemasuan 
    public function pemasukan()
    {
        $id                         = $this->session->userdata('id');
        $user                       = $this->user_model->user_detail($id);

        $config['base_url']       = base_url('admin/home/pemasukan/index/');
        $config['total_rows']     = count($this->kas_model->total_row_pemasukan_user($id));
        $config['per_page']       = 3;
        $config['uri_segment']    = 5;

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
        $start                    = ($this->uri->segment(5)) ? ($this->uri->segment(5)) : 0;
        //End Limit Start
        $this->pagination->initialize($config);




        $pemasukan = $this->kas_model->get_pemasukan_user($limit, $start, $id);
        $total_pemasukan_user       = $this->kas_model->total_pemasukan_user($id);
        $data = [
            'title'                     => 'Data Pemasukan',
            'pemasukan'                 => $pemasukan,
            'user'                      => $user,
            'total_pemasukan_user'      => $total_pemasukan_user,
            'pagination'                => $this->pagination->create_links(),
            'content'                   => 'admin/home/index_pemasukan'
        ];
        $this->load->view('admin/layout/wrapp', $data, FALSE);
    }

    //Buat Data Pemasukan
    public function create_pemasukan()
    {

        $id                         = $this->session->userdata('id');
        $user                       = $this->user_model->user_detail($id);

        $category = $this->category_model->get_category_donasi();
        $this->form_validation->set_rules(
            'tanggal',
            'Tanggal',
            'required',
            [
                'required'      => 'Tanggal Donasi harus di isi',
            ]
        );
        $this->form_validation->set_rules(
            'category_id',
            'Kategori',
            'required',
            [
                'required'      => 'Harus Pilih kategori',
            ]
        );
        $this->form_validation->set_rules(
            'donatur_title',
            'Title Donatur',
            'required',
            [
                'required'      => 'Harus Pilih Title',
            ]
        );
        $this->form_validation->set_rules(
            'donatur_name',
            'Nama Donatur',
            'required',
            [
                'required'      => 'Nama Donatur Harus Diisi',
            ]
        );
        $this->form_validation->set_rules(
            'donatur_phone',
            'Nomor HP Donatur',
            'required',
            [
                'required'      => 'Nomor HP Donatur Harus Diisi',
            ]
        );

        $this->form_validation->set_rules(
            'keterangan',
            'Keterangan',
            'required',
            [
                'required'      => 'Keterangan Harus Diisi',
            ]
        );

        if ($this->form_validation->run()) {

            if (!empty($_FILES['foto']['name'])) {

                $config['upload_path']          = './assets/img/donatur/';
                $config['allowed_types']        = 'gif|jpg|png|jpeg';
                $config['max_size']             = 5000; //Dalam Kilobyte
                $config['max_width']            = 5000; //Lebar (pixel)
                $config['max_height']           = 5000; //tinggi (pixel)
                $this->load->library('upload', $config);

                if (!$this->upload->do_upload('foto')) {

                    //End Validasi
                    $data = [
                        'title'                     => 'Tambah Pemasukan ' . $user->user_name,
                        'category'              => $category,
                        'error_upload'          => $this->upload->display_errors(),
                        'content'               => 'admin/home/create_pemasukan'
                    ];
                    $this->load->view('admin/layout/wrapp', $data, FALSE);

                    //Masuk Database

                } else {

                    //Proses Manipulasi Gambar
                    $upload_data    = array('uploads'  => $this->upload->data());
                    //Gambar Asli disimpan di folder assets/upload/image
                    //lalu gambara Asli di copy untuk versi mini size ke folder assets/upload/image/thumbs

                    $config['image_library']    = 'gd2';
                    $config['source_image']     = './assets/img/donatur/' . $upload_data['uploads']['file_name'];
                    //Gambar Versi Kecil dipindahkan
                    // $config['new_image']        = './assets/img/artikel/thumbs/' . $upload_data['uploads']['file_name'];
                    $config['create_thumb']     = TRUE;
                    $config['maintain_ratio']   = TRUE;
                    $config['width']            = 500;
                    $config['height']           = 500;
                    $config['thumb_marker']     = '';

                    $this->load->library('image_lib', $config);
                    $this->image_lib->resize();


                    $data  = [
                        'user_id'               => $this->session->userdata('id'),
                        'asrama_id'               => $this->input->post('asrama_id'),
                        'tanggal'               => $this->input->post('tanggal'),
                        'category_id'           => $this->input->post('category_id'),
                        'donatur_title'            => $this->input->post('donatur_title'),
                        'donatur_name'             => $this->input->post('donatur_name'),
                        'donatur_phone'            => $this->input->post('donatur_phone'),
                        'donatur_address'          => $this->input->post('donatur_address'),
                        'nominal'               => $this->input->post('nominal'),
                        'pengeluaran'           => 0,
                        'foto'                  => $upload_data['uploads']['file_name'],
                        'keterangan'            => $this->input->post('keterangan'),
                        'type'                  => 'Pemasukan',
                        'date_created'          => time()
                    ];
                    $this->kas_model->create($data);
                    $this->session->set_flashdata('message', 'Data Donasi telah ditambahkan');
                    redirect(base_url('admin/home/pemasukan'), 'refresh');
                }
            } else {

                $data  = [
                    'user_id'               => $this->session->userdata('id'),
                    'asrama_id'               => $this->input->post('asrama_id'),
                    'tanggal'               => $this->input->post('tanggal'),
                    'category_id'           => $this->input->post('category_id'),
                    'donatur_title'            => $this->input->post('donatur_title'),
                    'donatur_name'             => $this->input->post('donatur_name'),
                    'donatur_phone'            => $this->input->post('product_price'),
                    'donatur_address'          => $this->input->post('donatur_address'),
                    'nominal'               => $this->input->post('nominal'),
                    'pengeluaran'           => 0,
                    'keterangan'            => $this->input->post('keterangan'),
                    'type'                  => 'Pemasukan',
                    'date_created'          => time()
                ];
                $this->kas_model->create($data);
                $this->session->set_flashdata('message', 'Data Donasi telah di Update');
                redirect(base_url('admin/home/pemasukan'), 'refresh');
            }
        }
        //End Masuk Database
        $data = [
            'title'                     => 'Tambah Pemasukan ' . $user->user_name,
            'category'                  => $category,
            'content'                   => 'admin/home/create_pemasukan'
        ];
        $this->load->view('admin/layout/wrapp', $data, FALSE);
    }
    // List Data Pengeluaran
    public function pengeluaran()
    {
        $id                         = $this->session->userdata('id');
        $user                       = $this->user_model->user_detail($id);

        $config['base_url']       = base_url('admin/home/pengeluaran/index/');
        $config['total_rows']     = count($this->kas_model->total_row_pengeluaran_user($id));
        $config['per_page']       = 3;
        $config['uri_segment']    = 5;

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
        $start                    = ($this->uri->segment(5)) ? ($this->uri->segment(5)) : 0;
        //End Limit Start
        $this->pagination->initialize($config);

        $pengeluaran = $this->kas_model->get_pengeluaran_user($limit, $start, $id);
        $total_pengeluaran_user       = $this->kas_model->total_pengeluaran_user($id);
        $data = [
            'title'                         => 'Data Pengeluaran',
            'pengeluaran'                   => $pengeluaran,
            'user'                          => $user,
            'total_pengeluaran_user'        => $total_pengeluaran_user,
            'pagination'                    => $this->pagination->create_links(),
            'content'                       => 'admin/home/index_pengeluaran'
        ];
        $this->load->view('admin/layout/wrapp', $data, FALSE);
    }
    //Buat Data Pengeluaran
    public function create_pengeluaran()
    {

        $category = $this->category_model->get_category_pengeluaran();
        $this->form_validation->set_rules(
            'tanggal',
            'Tanggal',
            'required',
            [
                'required'      => 'Tanggal harus Di Isi',
            ]
        );
        $this->form_validation->set_rules(
            'category_id',
            'Kategori',
            'required',
            [
                'required'      => 'Harus Pilih Kategori',
            ]
        );

        $this->form_validation->set_rules(
            'keterangan',
            'Keterangan',
            'required',
            [
                'required'      => 'Keterangan Harus di isi',
            ]
        );
        if ($this->form_validation->run()) {

            if (!empty($_FILES['foto']['name'])) {

                $config['upload_path']          = './assets/img/donatur/';
                $config['allowed_types']        = 'gif|jpg|png|jpeg';
                $config['max_size']             = 5000; //Dalam Kilobyte
                $config['max_width']            = 5000; //Lebar (pixel)
                $config['max_height']           = 5000; //tinggi (pixel)
                $this->load->library('upload', $config);

                if (!$this->upload->do_upload('foto')) {

                    //End Validasi
                    $data = [
                        'title'                 => 'Tambah Data',
                        'category'              => $category,
                        'error_upload'          => $this->upload->display_errors(),
                        'content'               => 'admin/home/create_pengeluaran'
                    ];
                    $this->load->view('admin/layout/wrapp', $data, FALSE);

                    //Masuk Database

                } else {

                    //Proses Manipulasi Gambar
                    $upload_data    = array('uploads'  => $this->upload->data());
                    //Gambar Asli disimpan di folder assets/upload/image
                    //lalu gambara Asli di copy untuk versi mini size ke folder assets/upload/image/thumbs

                    $config['image_library']    = 'gd2';
                    $config['source_image']     = './assets/img/donatur/' . $upload_data['uploads']['file_name'];
                    //Gambar Versi Kecil dipindahkan
                    // $config['new_image']        = './assets/img/artikel/thumbs/' . $upload_data['uploads']['file_name'];
                    $config['create_thumb']     = TRUE;
                    $config['maintain_ratio']   = TRUE;
                    $config['width']            = 500;
                    $config['height']           = 500;
                    $config['thumb_marker']     = '';

                    $this->load->library('image_lib', $config);
                    $this->image_lib->resize();


                    $data  = [
                        'user_id'               => $this->session->userdata('id'),
                        'asrama_id'               => $this->input->post('asrama_id'),
                        'tanggal'               => $this->input->post('tanggal'),
                        'category_id'           => $this->input->post('category_id'),
                        'nominal'               => 0,
                        'pengeluaran'           => $this->input->post('pengeluaran'),
                        'foto'                  => $upload_data['uploads']['file_name'],
                        'keterangan'            => $this->input->post('keterangan'),
                        'type'                  => 'Pengeluaran',
                        'date_created'          => time()
                    ];
                    $this->kas_model->create($data);
                    $this->session->set_flashdata('message', 'Data Pengeluaran telah ditambahkan');
                    redirect(base_url('admin/home/pengeluaran'), 'refresh');
                }
            } else {

                $data  = [
                    'user_id'               => $this->session->userdata('id'),
                    'asrama_id'               => $this->input->post('asrama_id'),
                    'tanggal'               => $this->input->post('tanggal'),
                    'category_id'           => $this->input->post('category_id'),
                    'nominal'               => 0,
                    'pengeluaran'           => $this->input->post('pengeluaran'),
                    'keterangan'            => $this->input->post('keterangan'),
                    'type'                  => 'Pengeluaran',
                    'date_created'          => time()
                ];
                $this->kas_model->create($data);
                $this->session->set_flashdata('message', 'Data Pengeluaran telah di Tambahkan');
                redirect(base_url('admin/home/pengeluaran'), 'refresh');
            }
        }
        //End Masuk Database
        $data = [
            'title'                     => 'Tambah Pengeluaran',
            'category'                  => $category,
            'content'                   => 'admin/home/create_pengeluaran'
        ];
        $this->load->view('admin/layout/wrapp', $data, FALSE);
    }





    // GET AUTOCOMPLETE
    // AUTOCOMPLETE
    function get_autocomplete()
    {
        if (isset($_GET['term'])) {
            $result = $this->kas_model->search_blog($_GET['term']);
            if (count($result) > 0) {
                foreach ($result as $row)
                    $arr_result[] = array(
                        'label'            => $row->donatur_name,
                        'donatur_phone'    => $row->donatur_phone,
                    );
                echo json_encode($arr_result);
            }
        }
    }
}
