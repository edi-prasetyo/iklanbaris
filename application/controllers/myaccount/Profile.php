<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Profile extends CI_Controller
{

    //Load Model
    public function __construct()
    {
        parent::__construct();
        $this->load->helper('short_number'); //calling helper short number format
        $this->load->library('pagination');
        $this->load->model('meta_model');
        $this->load->model('iklan_model');
    }

    public function index()
    {
        $id = $this->session->userdata('id');
        $user = $this->user_model->user_detail($id);

        $iklan_saya     = $this->iklan_model->total_iklan_user($id);
        $iklan_active   = $this->iklan_model->total_iklan_user_active($id);
        $iklan_pending  = $this->iklan_model->total_iklan_user_pending($id);

        $data = [
            'title'                 => 'Ubah Profile',
            'deskripsi'             => 'Deskripsi',
            'keywords'              => 'Keywords',
            'user'                  => $user,
            'iklan_saya'            => $iklan_saya,
            'iklan_active'          => $iklan_active,
            'iklan_pending'         => $iklan_pending,
            'content'               => 'myaccount/profile/index_profile'
        ];
        $this->load->view('myaccount/layout/wrapp', $data, FALSE);
    }
    public function update()
    {
        $id = $this->session->userdata('id');
        $user = $this->user_model->user_detail($id);
        $meta = $this->meta_model->get_meta();

        $this->form_validation->set_rules(
            'user_name',
            'Nama',
            'required',
            [
                'required'         => 'Nama harus di isi'
            ]
        );
        $this->form_validation->set_rules(
            'user_whatsapp',
            'Nama',
            'trim|numeric',
            [
                'numeric'         => 'Tidak Boleh ada spasi'
            ]
        );
        if ($this->form_validation->run()) {
            //Kalau nggak Ganti gambar
            if (!empty($_FILES['user_image']['name'])) {

                $config['upload_path']          = './assets/img/avatars/';
                $config['allowed_types']        = 'gif|jpg|png|jpeg';
                $config['max_size']             = 5000000; //Dalam Kilobyte
                $config['max_width']            = 5000000; //Lebar (pixel)
                $config['max_height']           = 5000000; //tinggi (pixel)
                $this->load->library('upload', $config);
                if (!$this->upload->do_upload('user_image')) {

                    //End Validasi
                    $data = [
                        'title'                 => 'Ubah Profile',
                        'deskripsi'             => 'Deskripsi',
                        'keywords'              => 'Keywords',
                        'meta'                  => $meta,
                        'error_upload'          => $this->upload->display_errors(),
                        'content'               => 'myaccount/profile/update_profile'
                    ];
                    $this->load->view('myaccount/layout/wrapp', $data, FALSE);

                    //Masuk Database

                } else {

                    //Proses Manipulasi Gambar
                    $upload_data    = array('uploads'  => $this->upload->data());
                    //Gambar Asli disimpan di folder assets/upload/image


                    $config['image_library']    = 'gd2';
                    $config['source_image']     = './assets/img/avatars/' . $upload_data['uploads']['file_name'];
                    $config['create_thumb']     = TRUE;
                    $config['maintain_ratio']   = TRUE;
                    $config['encrypt_name']     = TRUE;
                    $config['width']            = 200;
                    $config['height']           = 200;
                    $config['thumb_marker']     = '';
                    $this->load->library('image_lib', $config);
                    $this->image_lib->resize();

                    // Hapus Gambar Lama Jika Ada upload gambar baru
                    if ($user->user_image != "") {
                        unlink('./assets/img/avatars/' . $user->user_image);
                        // unlink('./assets/img/artikel/thumbs/' . $berita->berita_gambar);
                    }
                    //End Hapus Gambar

                    $nomor_hp = $this->input->post('user_phone');

                    // kadang ada penulisan no hp 0811 239 345
                    $nomor_hp = str_replace(" ", "", $nomor_hp);
                    // kadang ada penulisan no hp (0274) 778787
                    $nomor_hp = str_replace("(", "", $nomor_hp);
                    // kadang ada penulisan no hp (0274) 778787
                    $nomor_hp = str_replace(")", "", $nomor_hp);
                    // kadang ada penulisan no hp 0811.239.345
                    $nomor_hp = str_replace(".", "", $nomor_hp);

                    // cek apakah no hp mengandung karakter + dan 0-9
                    if (!preg_match('/[^+0-9]/', trim($nomor_hp))) {
                        // cek apakah no hp karakter 1-3 adalah +62
                        if (substr(trim($nomor_hp), 0, 3) == '+62') {
                            $hp = trim($nomor_hp);
                        }
                        // cek apakah no hp karakter 1 adalah 0
                        elseif (substr(trim($nomor_hp), 0, 1) == '0') {
                            $hp = '62' . substr(trim($nomor_hp), 1);
                        }
                    }

                    $hp = '62' . substr(trim($nomor_hp), 1);
                    $data  = [
                        'id'                    => $id,
                        'user_name'             => $this->input->post('user_name'),
                        'user_phone'            => $hp,
                        'user_whatsapp'         => $this->input->post('user_whatsapp'),
                        'user_address'          => $this->input->post('user_address'),
                        'user_bio'              => $this->input->post('user_bio'),
                        'user_facebook'         => $this->input->post('user_facebook'),
                        'user_instagram'        => $this->input->post('user_instagram'),
                        'user_twitter'          => $this->input->post('user_twitter'),
                        'user_youtube'          => $this->input->post('user_youtube'),
                        'user_image'            => $upload_data['uploads']['file_name'],
                        'date_updated'          => time()
                    ];
                    $this->user_model->update($data);
                    $this->session->set_flashdata('message', '<div class="alert alert-success"> Data telah di ubah<button type="button" aria-hidden="true" class="close" data-notify="dismiss">×</button></div> ');
                    redirect(base_url('myaccount/profile'), 'refresh');
                }
            } else {
                //Update Berita Tanpa Ganti Gambar
                // Hapus Gambar Lama Jika ada upload gambar baru


                $nomor_hp = $this->input->post('user_phone');

                // kadang ada penulisan no hp 0811 239 345
                $nomor_hp = str_replace(" ", "", $nomor_hp);
                // kadang ada penulisan no hp (0274) 778787
                $nomor_hp = str_replace("(", "", $nomor_hp);
                // kadang ada penulisan no hp (0274) 778787
                $nomor_hp = str_replace(")", "", $nomor_hp);
                // kadang ada penulisan no hp 0811.239.345
                $nomor_hp = str_replace(".", "", $nomor_hp);

                // cek apakah no hp mengandung karakter + dan 0-9
                if (!preg_match('/[^+0-9]/', trim($nomor_hp))) {
                    // cek apakah no hp karakter 1-3 adalah +62
                    if (substr(trim($nomor_hp), 0, 3) == '+62') {
                        $hp = trim($nomor_hp);
                    }
                    // cek apakah no hp karakter 1 adalah 0
                    elseif (substr(trim($nomor_hp), 0, 1) == '0') {
                        $hp = '62' . substr(trim($nomor_hp), 1);
                    }
                }
                $hp = '62' . substr(trim($nomor_hp), 1);

                if ($user->user_image != "")
                    $data  = [
                        'id'                    => $id,
                        'user_name'             => $this->input->post('user_name'),
                        'user_phone'            => $hp,
                        'user_whatsapp'         => $this->input->post('user_whatsapp'),
                        'user_address'          => $this->input->post('user_address'),
                        'user_bio'              => $this->input->post('user_bio'),
                        'user_facebook'         => $this->input->post('user_facebook'),
                        'user_instagram'        => $this->input->post('user_instagram'),
                        'user_twitter'          => $this->input->post('user_twitter'),
                        'user_youtube'          => $this->input->post('user_youtube'),
                        'date_updated'          => time()
                    ];
                $this->user_model->update($data);
                $this->session->set_flashdata('message', '<div class="alert alert-success"> Data telah di ubah<button type="button" aria-hidden="true" class="close" data-notify="dismiss">×</button></div> ');
                redirect(base_url('myaccount/profile'), 'refresh');
            }
        }

        $data = [
            'title'                 => 'Ubah Profile',
            'deskripsi'             => 'Update Akun Saya',
            'keywords'              => 'update Account',
            'meta'                  => $meta,
            'user'                  => $user,
            'content'               => 'myaccount/profile/update_profile'
        ];
        $this->load->view('myaccount/layout/wrapp', $data, FALSE);
    }

    public function ubah_password()
    {
        $id = $this->session->userdata('id');
        $user = $this->user_model->user_detail($id);
        $meta = $this->meta_model->get_meta();

        $this->form_validation->set_rules(
            'password1',
            'Password',
            'required|trim|min_length[3]|matches[password2]',
            [
                'required'      => 'Password harus Di isi',
                'matches'         => 'Password tidak sama',
                'min_length'     => 'Password Min 3 karakter'
            ]
        );
        $this->form_validation->set_rules('password2', 'Ulangi Password', 'required|trim|matches[password1]');

        if ($this->form_validation->run() == false) {
            // End Listing Berita dengan paginasi
            $data = array(
                'title'       => 'Ubah Password',
                'deskripsi'             => 'Update Password Saya',
                'keywords'              => 'update Password',
                'user'        => $user,
                'meta'        => $meta,
                'content'     => 'front/myaccount/password_account'
            );
            $this->load->view('myaccount/layout/wrapp', $data, FALSE);
        } else {
            $data = [
                'id'            => $id,
                'password'        => password_hash($this->input->post('password1'), PASSWORD_DEFAULT),
            ];
            $this->user_model->update($data);
            $this->session->set_flashdata('message', 'Data telah di ubah');
            redirect(base_url('myaccount'), 'refresh');
        }
    }
}
