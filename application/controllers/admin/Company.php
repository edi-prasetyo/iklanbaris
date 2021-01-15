<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Company extends CI_Controller
{
    //load data
    public function __construct()
    {
        parent::__construct();
        $this->load->model('company_model');
        $this->load->library('pagination');

        $id = $this->session->userdata('id');
        $user = $this->user_model->user_detail($id);
        if ($user->role_id == 2) {
            redirect('admin/dashboard');
        }
    }
    //listing data company
    public function index()
    {
        $config['base_url']       = base_url('admin/company/index/');
        $config['total_rows']     = count($this->company_model->total_row());
        $config['per_page']       = 5;
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

        $company = $this->company_model->get_company($limit, $start);
        $data = [
            'title'         => 'Data Perusahaan',
            'company'        => $company,
            'pagination'    => $this->pagination->create_links(),
            'content'       => 'admin/company/index_company'
        ];
        $this->load->view('admin/layout/wrapp', $data, FALSE);
    }
    //Create New Company
    public function create()
    {
        // Validasi
        $this->form_validation->set_rules(
            'company_name',
            'Nama Perusahaan',
            'required',
            [
                'required'      => 'Nama Perusahaan harus di isi',
            ]
        );
        
        if ($this->form_validation->run()) {

            $config['upload_path']          = './assets/img/logo/';
            $config['allowed_types']        = 'gif|jpg|png|jpeg';
            $config['max_size']             = 50000; //Dalam Kilobyte
            $config['max_width']            = 50000; //Lebar (pixel)
            $config['max_height']           = 50000; //tinggi (pixel)
            $this->load->library('upload', $config);
            if (!$this->upload->do_upload('company_logo')) {

                //End Validasi
                $data = [
                    'title'        => 'Tambah Perusahaan',
                    'error_upload' => $this->upload->display_errors(),
                    'content'       => 'admin/company/create_company'
                ];
                $this->load->view('admin/layout/wrapp', $data, FALSE);

                //Masuk Database

            } else {

                //Proses Manipulasi Gambar
                $upload_data    = array('uploads'  => $this->upload->data());
                //Gambar Asli disimpan di folder assets/upload/image

                $config['image_library']    = 'gd2';
                $config['source_image']     = './assets/img/logo/' . $upload_data['uploads']['file_name'];
                //Gambar Versi Kecil dipindahkan
                // $config['new_image']        = './assets/img/artikel/thumbs/' . $upload_data['uploads']['file_name'];
                $config['create_thumb']     = TRUE;
                $config['maintain_ratio']   = TRUE;
                $config['encrypt_name']     = TRUE;
                $config['width']            = 500;
                $config['height']           = 500;
                $config['thumb_marker']     = '';

                $this->load->library('image_lib', $config);
                $this->image_lib->resize();

                $slugcode = random_string('numeric', 5);
                $company_slug  = url_title($this->input->post('company_name'), 'dash', TRUE);
                $data  = [
                    'company_slug'        =>  $company_slug . '-' . $slugcode,
                    'company_name'        => $this->input->post('company_name'),
                    'company_address'     => $this->input->post('company_address'),
                    'company_logo'        => $upload_data['uploads']['file_name'],
                    'company_phone'       => $this->input->post('company_phone'),
                    'date_created'        => time()
                ];
                $this->company_model->create($data);
                $this->session->set_flashdata('message', 'Data Perusahaan telah ditambahkan');
                redirect(base_url('admin/company'), 'refresh');
            }
        }
        //End Masuk Database
        $data = [
            'title'             => 'Tambah Perusahaan',
            'content'           => 'admin/company/create_company'
        ];
        $this->load->view('admin/layout/wrapp', $data, FALSE);
    }


    //Edit Company
    public function Update($id)
    {
        $company = $this->company_model->company_detail($id);

        //Validasi
        $valid = $this->form_validation;

        $valid->set_rules(
            'company_name',
            'Nama Perusahaan',
            'required',
            ['required'      => '%s harus diisi']
        );

        $valid->set_rules(
            'company_address',
            'Alamat Perusahaan',
            'required',
            ['required'      => '%s harus diisi']
        );


        if ($valid->run()) {
            //Kalau nggak Ganti gambar
            if (!empty($_FILES['company_logo']['name'])) {

                $config['upload_path']          = './assets/img/logo/';
                $config['allowed_types']        = 'gif|jpg|png|jpeg';
                $config['max_size']             = 50000; //Dalam Kilobyte
                $config['max_width']            = 50000; //Lebar (pixel)
                $config['max_height']           = 50000; //tinggi (pixel)
                $this->load->library('upload', $config);
                if (!$this->upload->do_upload('company_logo')) {

                    //End Validasi
                    $data = [
                        'title'        => 'Edit Perusahaan',
                        'company'       => $company,
                        'error_upload' => $this->upload->display_errors(),
                        'content'          => 'admin/company/update_company'
                    ];
                    $this->load->view('admin/layout/wrapp', $data, FALSE);

                    //Masuk Database

                } else {

                    //Proses Manipulasi Gambar
                    $upload_data    = array('uploads'  => $this->upload->data());
                    //Gambar Asli disimpan di folder assets/upload/image

                    $config['image_library']    = 'gd2';
                    $config['source_image']     = './assets/img/logo/' . $upload_data['uploads']['file_name'];
                    $config['create_thumb']     = TRUE;
                    $config['maintain_ratio']   = TRUE;
                    $config['encrypt_name']     = TRUE;
                    $config['width']            = 500;
                    $config['height']           = 500;
                    $config['thumb_marker']     = '';

                    $this->load->library('image_lib', $config);

                    $this->image_lib->resize();

                    // Hapus Gambar Lama Jika Ada upload gambar baru
                    if ($company->company_logo != "") {
                        unlink('./assets/img/logo/' . $company->company_logo);
                        // unlink('./assets/img/artikel/thumbs/' . $company->company_gambar);
                    }
                    //End Hapus Gambar

                    $data  = [
                        'id'                => $id,
                        // 'company_slug'       => url_title($this->input->post('company_title'), 'dash', TRUE),
                        'company_name'      => $this->input->post('company_name'),
                        'company_address'       => $this->input->post('company_address'),
                        'company_logo'     => $upload_data['uploads']['file_name'],
                        'company_phone'     => $this->input->post('company_phone'),
                        'date_updated'      => time()
                    ];
                    $this->company_model->update($data);
                    $this->session->set_flashdata('message', 'Data telah di Update');
                    redirect(base_url('admin/company'), 'refresh');
                }
            } else {
                //Update Company Tanpa Ganti Gambar
                // Hapus Gambar Lama Jika ada upload gambar baru
                if ($company->company_logo != "")
                    $data  = [
                        'id'         => $id,
                        // 'company_slug'       => url_title($this->input->post('company_title'), 'dash', TRUE),
                        'company_name'      => $this->input->post('company_name'),
                        'company_address'       => $this->input->post('company_address'),
                        //'company_logo'          => $upload_data['uploads']['file_name'],
                      'company_phone'     => $this->input->post('company_phone'),
                        'date_updated'      => time()
                    ];
                $this->company_model->update($data);
                $this->session->set_flashdata('message', 'Data telah di Update');
                redirect(base_url('admin/company'), 'refresh');
            }
        }
        //End Masuk Database
        $data = [
            'title'        => 'Update Perusahaan',
            'company'       => $company,
            'content'          => 'admin/company/update_company'
        ];
        $this->load->view('admin/layout/wrapp', $data, FALSE);
    }

    //delete
    public function delete($id)
    {
        //Proteksi delete
        is_login();

        $company = $this->company_model->company_detail($id);
        //Hapus gambar

        if ($company->company_gambar != "") {
            unlink('./assets/img/artikel/' . $company->company_gambar);
            // unlink('./assets/img/artikel/thumbs/' . $company->company_gambar);
        }
        //End Hapus Gambar
        $data = ['id'   => $company->id];
        $this->company_model->delete($data);
        $this->session->set_flashdata('message', 'Data telah di Hapus');
        redirect($_SERVER['HTTP_REFERER']);
    }
}
