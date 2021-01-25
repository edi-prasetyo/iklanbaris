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
        $this->load->model('regularity_model');
        $this->load->model('settings_model');
    }

    // Listing Iklan iklan

    public function index()
    {
        $id = $this->session->userdata('id');
        $user = $this->user_model->user_detail($id);
        $meta = $this->meta_model->get_meta();


        $config['base_url']       = base_url('myaccount/iklan/index/');
        $config['total_rows']     = count($this->iklan_model->total_row_user());
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
        $iklan = $this->iklan_model->get_iklan_user($limit, $start, $id);

        // End Listing iklan dengan paginasi
        $data = array(
            'title'         => 'Iklan Saya',
            'deskripsi'     => 'iklan - ' . $meta->description,
            'keywords'      => 'iklan - ' . $meta->keywords,
            'user'          => $user,
            'meta'          => $meta,
            'iklan'         => $iklan,
            'pagination'    => $this->pagination->create_links(),
            'content'       => 'myaccount/iklan/index_iklan'
        );
        $this->load->view('myaccount/layout/wrapp', $data, FALSE);
    }

    // Create
    public function create()
    {
        $category           = $this->category_model->get_category_iklan();
        $province           = $this->province_model->get_province();
        $regularity         = $this->regularity_model->get_regularity_seller();
        $moderasi_status    = $this->settings_model->get_settings();
        $moderasi           = $moderasi_status->moderation;

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
            'iklan_price',
            'Harga Barang',
            'required',
            ['required'      => 'Harga Barang harus di isi',]
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
                    'title'             => 'Tambah iklan',
                    'deskripsi'         => 'deskripsi',
                    'keywords'          => 'keywords',
                    'category'          => $category,
                    'province'          => $province,
                    'regularity'        => $regularity,
                    'content'           => 'myaccount/iklan/create_iklan'
                ];
                $this->load->view('myaccount/layout/wrapp', $data, FALSE);
            } else {

                //Proses Upload Gambar
                $upload_data    = array('uploads'  => $this->upload->data());

                $config['image_library']    = 'gd2';
                $config['source_image']     = './assets/img/iklan/' . $upload_data['uploads']['file_name'];
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

                // Hapus Kata Tertentu
                $string = $this->input->post('iklan_desc');
                $patterns = ['/http:/', '/https:/', '/www./', '/.com/', '/.net/', '/.info/', '/.org/', '/.xyz/', '/.id/', '/.co.id/', '/.web.id/', '/.my.id/', '/obat/', '/0812/', '/0813/', '/0877/', '/0819/', '/0818/', '/021/', '/0859/', '/0878/', '/0817/', '/0818/', '/0811/', '/0821/', '/0822/', '/0823/', '/0852/', '/0853/', '/0851/', '/0898/', '/0899/', '/0895/', '/0896/', '/0897/', '/0814/', '/0815/', '/0816/', '/0855/', '/0856/', '/0857/', '/0858/', '/0889/', '/0881/', '/0882/', '/0883/', '/0886/', '/0887/', '/0888/', '/0884/', '/0885/', '/0832/', '/0833/', '/0838/', '/0831/', '/Obat Kuat/', '/Dewasa/', '/dewasa/', '/judi/', '/hubungi/', '/Hubungi/', '/HUBUNGI/', '/Website/', '/WEBSITE/', '/website/', '/situs/', '/Situs/', '/SITUS/'];
                $replacements = ['***', '***', '***', '***', '***', '***', '***', '***', '***', '***', '***', '***', '***', '***', '***', '***', '***', '***', '***', '***', '***', '***', '***', '***', '***', '***', '***', '***', '***', '***', '***', '***', '***', '***', '***', '***', '***', '***', '***', '***', '***', '***', '***', '***', '***', '***', '***', '***', '***', '***', '***', '***', '***', '***', '***', '***', '***', '***', '***', '***', '***', '***', '***', '***', '***', '***', '***', '***'];


                $data = [
                    'user_id'                   => $this->session->userdata('id'),
                    'province_id'               => $this->input->post('province_id'),
                    'id_iklan'                  => $id_iklan,
                    'category_id'               => $this->input->post('category_id'),
                    'iklan_slug'                => $slugcode . '-' . $iklan_slug,
                    'iklan_title'               => $this->input->post('iklan_title'),
                    'iklan_status'              => $moderasi,
                    'iklan_price'               => $this->input->post('iklan_price'),
                    'iklan_negotiable'          => $this->input->post('iklan_negotiable'),
                    'iklan_desc'                => preg_replace($patterns, $replacements, $string),
                    'iklan_image'               => $upload_data['uploads']['file_name'],
                    'iklan_keywords'            => $this->input->post('iklan_keywords'),
                    'date_created'              => time()
                ];
                $this->iklan_model->create($data);
                $this->session->set_flashdata('message', 'Data Iklan telah ditambahkan');
                redirect(base_url('myaccount/iklan'), 'refresh');
            }
        }

        $data = [
            'title'         => 'Tambah Iklan',
            'deskripsi'     => 'deskripsi',
            'keywords'      => 'keywords',
            'category'      => $category,
            'province'      => $province,
            'regularity'    => $regularity,
            'content'       => 'myaccount/iklan/create_iklan'
        ];
        $this->load->view('myaccount/layout/wrapp', $data, FALSE);
    }

    // Update
    public function update($id)
    {
        $moderasi_status    = $this->settings_model->get_settings();
        $moderasi           = $moderasi_status->moderation;
        $user_id            = $this->session->userdata('id');
        $iklan              = $this->iklan_model->iklan_detail($id);
        $category           = $this->category_model->get_category_iklan();
        $province           = $this->province_model->get_province();
        $regularity         = $this->regularity_model->get_regularity_seller();
        // Proteksi Iklan User
        if ($iklan->user_id == $user_id) {
            // Validasi
            $this->form_validation->set_rules(
                'iklan_title',
                'Judul Iklan',
                'required',
                [
                    'required'      => 'Judul Iklan harus di isi',
                ]
            );

            if ($this->form_validation->run()) {
                //Kalau nggak Ganti gambar
                if (!empty($_FILES['iklan_image']['name'])) {

                    $config['upload_path']          = './assets/img/iklan/';
                    $config['allowed_types']        = 'gif|jpg|png|jpeg';
                    $config['max_size']             = 5000; //Dalam Kilobyte
                    $config['max_width']            = 5000; //Lebar (pixel)
                    $config['max_height']           = 5000; //tinggi (pixel)
                    $this->load->library('upload', $config);
                    if (!$this->upload->do_upload('iklan_image')) {

                        //End Validasi
                        $data = [
                            'title'             => 'Edit Iklan',
                            'deskripsi'         => 'deskripsi',
                            'keywords'          => 'keywords',
                            'category'          => $category,
                            'province'          => $province,
                            'iklan'             => $iklan,
                            'regularity'        => $regularity,
                            'error_upload'      => $this->upload->display_errors(),
                            'content'           => 'myaccount/iklan/update_iklan'
                        ];
                        $this->load->view('myaccount/layout/wrapp', $data, FALSE);
                        //Masuk Database

                    } else {

                        //Proses Upload Gambar
                        $upload_data    = array('uploads'  => $this->upload->data());
                        $config['image_library']    = 'gd2';
                        $config['source_image']     = './assets/img/iklan/' . $upload_data['uploads']['file_name'];
                        $config['create_thumb']     = TRUE;
                        $config['maintain_ratio']   = TRUE;
                        $config['width']            = 500;
                        $config['height']           = 500;
                        $config['thumb_marker']     = '';
                        $this->load->library('image_lib', $config);
                        $this->image_lib->resize();
                        // Hapus Gambar Lama Jika Ada upload gambar baru
                        if ($iklan->iklan_image != "") {
                            unlink('./assets/img/iklan/' . $iklan->iklan_image);
                        }
                        //End Hapus Gambar

                        $data  = [
                            'id'                        => $id,
                            'user_id'                   => $this->session->userdata('id'),
                            'category_id'               => $this->input->post('category_id'),
                            'province_id'               => $this->input->post('province_id'),
                            'iklan_title'               => $this->input->post('iklan_title'),
                            'iklan_status'              => $moderasi,
                            'iklan_price'               => $this->input->post('iklan_price'),
                            'iklan_negotiable'          => $this->input->post('iklan_negotiable'),
                            'iklan_desc'                => $this->input->post('iklan_desc'),
                            'iklan_image'               => $upload_data['uploads']['file_name'],
                            'iklan_keywords'            => $this->input->post('iklan_keywords'),
                            'date_updated'              => time()
                        ];
                        $this->iklan_model->update($data);
                        $this->session->set_flashdata('message', 'Data telah di Update');
                        redirect(base_url('myaccount/iklan'), 'refresh');
                    }
                } else {
                    //Update Iklan Tanpa Ganti Gambar
                    // Hapus Gambar Lama Jika ada upload gambar baru
                    if ($iklan->iklan_image != "")
                        $data  = [
                            'id'                        => $id,
                            'user_id'                   => $this->session->userdata('id'),
                            'category_id'               => $this->input->post('category_id'),
                            'province_id'               => $this->input->post('province_id'),
                            'iklan_title'               => $this->input->post('iklan_title'),
                            'iklan_status'              => $moderasi,
                            'iklan_price'               => $this->input->post('iklan_price'),
                            'iklan_negotiable'          => $this->input->post('iklan_negotiable'),
                            'iklan_desc'                => $this->input->post('iklan_desc'),
                            // 'iklan_image'                 => $upload_data['uploads']['file_name'],
                            'iklan_keywords'            => $this->input->post('iklan_keywords'),
                            'date_updated'              => time()
                        ];
                    $this->iklan_model->update($data);
                    $this->session->set_flashdata('message', 'Data telah di Update');
                    redirect(base_url('myaccount/iklan'), 'refresh');
                }
            }
            //End Masuk Database
            $data = [
                'title'             => 'Update Iklan',
                'deskripsi'         => 'deskripsi',
                'keywords'          => 'keywords',
                'category'          => $category,
                'province'          => $province,
                'iklan'             => $iklan,
                'regularity'        => $regularity,
                'content'           => 'myaccount/iklan/update_iklan'
            ];
            $this->load->view('myaccount/layout/wrapp', $data, FALSE);
        } else {
            redirect(base_url('myaccount/unautorized'), 'refresh');
        }
    }

    // get Premium
    public function get_premium($id)
    {
        $user_id = $this->session->userdata('id');
        $user = $this->user_model->user_premium_detail($user_id);
        $iklan = $this->iklan_model->iklan_detail($id);
        $settings = $this->settings_model->get_settings();
        $package_range = $settings->premium_range;

        if ($iklan->user_id == $user_id) {

            $this->form_validation->set_rules(
                'iklan_id',
                'ID Iklan',
                'required',
                array(
                    'required'         => '%s Harus Diisi',
                )
            );
            if ($this->form_validation->run() === FALSE) {
                $data = [
                    'title'             => 'Province',
                    'deskripsi'         => 'deskripsi',
                    'keywords'          => 'keywords',
                    'iklan'             => $iklan,
                    'content'           => 'myaccount/iklan/premium_iklan'
                ];
                $this->load->view('myaccount/layout/wrapp', $data, FALSE);
            } else {

                if ($user->premium_count == 0) {
                    $this->session->set_flashdata('message', '<div class="alert alert-danger"> Sayangnya Paket Premium Anda sudah Habis Silahkan Order Paket di bawah ini<button type="button" aria-hidden="true" class="close" data-notify="dismiss">×</button></div> ');
                    redirect(base_url('myaccount/package'), 'refresh');
                } else {
                    $data = [
                        'id'                            => $this->input->post('iklan_id'),
                        'iklan_featured'                => date('Y-m-d', strtotime("+$package_range days")),
                    ];
                    $this->iklan_model->update($data);
                    $this->user_model->update_premium_count($user_id);
                    $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissable fade show" >Iklan Anda Berhasil di Highlight selama' . "$package_range " . 'Hari <button class="close" data-dismiss="alert" aria-label="Close">×</button></div>');
                    redirect(base_url('myaccount/iklan'), 'refresh');
                }
                $data = [
                    'title'             => 'Province',
                    'deskripsi'         => 'deskripsi',
                    'keywords'          => 'keywords',
                    'iklan'             => $iklan,
                    'content'           => 'myaccount/iklan/premium_iklan'
                ];
                $this->load->view('myaccount/layout/wrapp', $data, FALSE);
            }
        } else {
            redirect(base_url('myaccount/unautorized'), 'refresh');
        }
    }
}
