<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Myaccount extends CI_Controller
{

  //Load Model
  public function __construct()
  {
    parent::__construct();
    $this->load->helper('short_number'); //calling helper short number format
    $this->load->library('pagination');
    $this->load->model('meta_model');
    $this->load->model('iklan_model');
    $this->load->model('iklan_model');
    $this->load->model('images_model');
    $this->load->model('type_model');
    $this->load->model('province_model');
    $this->load->model('city_model');
    $this->load->model('category_model');
    $this->load->model('package_model');
  }

  //main page - iklan
  public function index()
  {
    $id = $this->session->userdata('id');
    $user = $this->user_model->user_detail($id);
    $meta = $this->meta_model->get_meta();


    $data = array(
      'title'       => 'Akun Saya',
      'deskripsi'   => 'iklan - ' . $meta->description,
      'keywords'    => 'iklan - ' . $meta->keywords,
      'user'        => $user,
      'meta'        => $meta,
      'pagination'    => $this->pagination->create_links(),
      'content'     => 'front/myaccount/index_account'
    );
    $this->load->view('front/layout/wrapp', $data, FALSE);
  }

  public function account()
  {
    $id = $this->session->userdata('id');
    $user = $this->user_model->user_detail($id);

    $meta = $this->meta_model->get_meta();

    // End Listing iklan dengan paginasi
    $data = array(
      'title'       => 'Akun Saya',
      'deskripsi'   => 'iklan - ' . $meta->description,
      'keywords'    => 'iklan - ' . $meta->keywords,
      'user'        => $user,
      'meta'        => $meta,
      'content'     => 'front/myaccount/account'
    );
    $this->load->view('front/layout/wrapp', $data, FALSE);
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
    if ($this->form_validation->run()) {
      //Kalau nggak Ganti gambar
      if (!empty($_FILES['user_image']['name'])) {

        $config['upload_path']          = './assets/img/avatars/';
        $config['allowed_types']        = 'gif|jpg|png|jpeg';
        $config['max_size']             = 5000; //Dalam Kilobyte
        $config['max_width']            = 5000; //Lebar (pixel)
        $config['max_height']           = 5000; //tinggi (pixel)
        $this->load->library('upload', $config);
        if (!$this->upload->do_upload('user_image')) {

          //End Validasi
          $data = [
            'title'                 => 'Ubah Profile',
            'deskripsi'             => 'Update Akun Saya',
            'keywords'              => 'update Account',
            'meta'                  => $meta,
            'error_upload'          => $this->upload->display_errors(),
            'content'               => 'front/myaccount/update_account'
          ];
          $this->load->view('front/layout/wrapp', $data, FALSE);

          //Masuk Database

        } else {

          //Proses Manipulasi Gambar
          $upload_data    = array('uploads'  => $this->upload->data());
          //Gambar Asli disimpan di folder assets/upload/image
          //lalu gambar Asli di copy untuk versi mini size ke folder assets/upload/image/thumbs

          $config['image_library']    = 'gd2';
          $config['source_image']     = './assets/img/avatars/' . $upload_data['uploads']['file_name'];
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
          if ($user->user_image != "") {
            unlink('./assets/img/avatars/' . $user->user_image);
            // unlink('./assets/img/artikel/thumbs/' . $iklan->iklan_gambar);
          }
          //End Hapus Gambar

          $data  = [
            'id'                    => $id,
            'user_name'             => $this->input->post('user_name'),
            'email'                 => $this->input->post('email'),
            'user_image'            => $upload_data['uploads']['file_name'],
            'user_phone'            => $this->input->post('user_phone'),
            'user_address'          => $this->input->post('user_address'),
            'date_updated'          => time()
          ];
          $this->user_model->update($data);
          $this->session->set_flashdata('message', 'Data telah di Update');
          redirect(base_url('myaccount'), 'refresh');
        }
      } else {
        //Update iklan Tanpa Ganti Gambar
        // Hapus Gambar Lama Jika ada upload gambar baru
        if ($user->user_image != "")
          $data  = [
            'id'                    => $id,
            'user_name'             => $this->input->post('user_name'),
            'email'                 => $this->input->post('email'),
            'user_phone'            => $this->input->post('user_phone'),
            'user_address'          => $this->input->post('user_address'),
            'date_updated'          => time()
          ];
        $this->user_model->update($data);
        $this->session->set_flashdata('message', 'Data telah di Update');
        redirect(base_url('myaccount'), 'refresh');
      }
    }

    $data = [
      'title'                 => 'Ubah Profile',
      'deskripsi'             => 'Update Akun Saya',
      'keywords'              => 'update Account',
      'meta'                  => $meta,
      'user'                  => $user,
      'content'               => 'front/myaccount/update_account'
    ];
    $this->load->view('front/layout/wrapp', $data, FALSE);
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
      // End Listing iklan dengan paginasi
      $data = array(
        'title'       => 'Ubah Password',
        'deskripsi'             => 'Update Password Saya',
        'keywords'              => 'update Password',
        'user'        => $user,
        'meta'        => $meta,
        'content'     => 'front/myaccount/password_account'
      );
      $this->load->view('front/layout/wrapp', $data, FALSE);
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


  // Listing Iklan iklan

  public function iklan()
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
      'content'     => 'front/myaccount/index_iklan'
    );
    $this->load->view('front/layout/wrapp', $data, FALSE);
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
          'content'       => 'front/myaccount/create_iklan'
        ];
        $this->load->view('front/layout/wrapp', $data, FALSE);
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
      'content'       => 'front/myaccount/create_iklan'
    ];
    $this->load->view('front/layout/wrapp', $data, FALSE);
  }
  // Update Iklan iklan
  public function update_iklan($id)
  {
    $iklan = $this->iklan_model->iklan_detail($id);
    $category = $this->category_model->get_category_iklan();
    $province = $this->province_model->get_province();

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
            'title'        => 'Edit Iklan',
            'deskripsi'     => 'deskripsi',
            'keywords'      => 'keywords',
            'category'     => $category,
            'province'      => $province,
            'iklan'       => $iklan,
            'error_upload' => $this->upload->display_errors(),
            'content'          => 'front/myaccount/update_iklan'
          ];
          $this->load->view('front/layout/wrapp', $data, FALSE);

          //Masuk Database

        } else {

          //Proses Manipulasi Gambar
          $upload_data    = array('uploads'  => $this->upload->data());
          //Gambar Asli disimpan di folder assets/upload/image
          //lalu gambar Asli di copy untuk versi mini size ke folder assets/upload/image/thumbs

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

          // Hapus Gambar Lama Jika Ada upload gambar baru
          if ($iklan->iklan_image != "") {
            unlink('./assets/img/iklan/' . $iklan->iklan_image);
            // unlink('./assets/img/artikel/thumbs/' . $iklan->iklan_gambar);
          }
          //End Hapus Gambar

          $data  = [
            'id'                => $id,
            'user_id'           => $this->session->userdata('id'),
            'category_id'       => $this->input->post('category_id'),
            'province_id'               => $this->input->post('province_id'),
            'iklan_title'            => $this->input->post('iklan_title'),
            'iklan_status'           => 'Active',
            'iklan_merek'            => $this->input->post('iklan_merek'),
            'iklan_type'            => $this->input->post('iklan_type'),
            'iklan_kondisi'            => $this->input->post('iklan_kondisi'),
            'iklan_price'            => $this->input->post('iklan_price'),
            'iklan_negotiable'            => $this->input->post('iklan_negotiable'),
            'iklan_desc'            => $this->input->post('iklan_desc'),
            'iklan_image'                 => $upload_data['uploads']['file_name'],
            'iklan_keywords'         => $this->input->post('iklan_keywords'),
            'date_updated'      => time()
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
            'id'                => $id,
            'user_id'           => $this->session->userdata('id'),
            'category_id'       => $this->input->post('category_id'),
            'province_id'               => $this->input->post('province_id'),
            'iklan_title'            => $this->input->post('iklan_title'),
            'iklan_status'           => 'Active',
            'iklan_merek'            => $this->input->post('iklan_merek'),
            'iklan_type'            => $this->input->post('iklan_type'),
            'iklan_kondisi'            => $this->input->post('iklan_kondisi'),
            'iklan_price'            => $this->input->post('iklan_price'),
            'iklan_negotiable'            => $this->input->post('iklan_negotiable'),
            'iklan_desc'            => $this->input->post('iklan_desc'),
            // 'iklan_image'                 => $upload_data['uploads']['file_name'],
            'iklan_keywords'         => $this->input->post('iklan_keywords'),
            'date_updated'      => time()
          ];
        $this->iklan_model->update($data);
        $this->session->set_flashdata('message', 'Data telah di Update');
        redirect(base_url('myaccount/iklan'), 'refresh');
      }
    }
    //End Masuk Database
    $data = [
      'title'        => 'Update Iklan',
      'deskripsi'     => 'deskripsi',
      'keywords'      => 'keywords',
      'category'     => $category,
      'province'      => $province,
      'iklan'       => $iklan,
      'content'          => 'front/myaccount/update_iklan'
    ];
    $this->load->view('front/layout/wrapp', $data, FALSE);
  }

  public function upload_images($insert_id)
  {

    $config['upload_path']          = './assets/img/iklan/';
    $config['allowed_types']        = 'gif|jpg|png|jpeg';
    $config['max_size']             = 5000; //Dalam Kilobyte
    $config['max_width']            = 5000; //Lebar (pixel)
    $config['max_height']           = 5000; //tinggi (pixel)
    $config['encrypt_name']         = TRUE;
    $this->load->library('upload', $config);

    for ($i = 1; $i <= 3; $i++) {
      if (!empty($_FILES['images' . $i]['name'])) {
        if (!$this->upload->do_upload('images' . $i));
        // $data2 = $this->upload->data();



        //Proses Manipulasi Gambar
        $upload_data    = array('uploads'  => $this->upload->data());

        // Resize Image
        $config['image_library']    = 'gd2';
        $config['source_image']     = './assets/img/iklan/' . $upload_data['uploads']['file_name'];
        $config['create_thumb']     = TRUE;
        $config['maintain_ratio']   = TRUE;
        $config['width']            = 500;
        $config['height']           = 500;
        $config['thumb_marker']     = '';
        $this->load->library('image_lib', $config);
        $this->image_lib->initialize($config);
        $this->image_lib->resize();

        // Watermark Image
        $config['image_library']    = 'gd2';
        $config['source_image']     = './assets/img/iklan/' . $upload_data['uploads']['file_name'];
        $config['wm_type'] = 'overlay';
        $config['wm_overlay_path'] = './assets/img/logo/logo-watermark.png';
        $config['wm_opacity'] = 50;
        $config['wm_vrt_alignment'] = 'middle';
        $config['wm_hor_alignment'] = 'center';
        $this->load->library('image_lib', $config);
        $this->image_lib->initialize($config);
        $this->image_lib->watermark();



        // $file = $data2['file_name'];


        $data = [
          'iklan_id'      => $insert_id,
          'images'         =>  $upload_data['uploads']['file_name'],
          'date_created'  => time()
        ];
        $this->images_model->create($data);
      }
    }
  }

  // View

  public function view($id)
  {
    $iklan = $this->iklan_model->iklan_detail($id);
    $gambar = $this->images_model->gambar_iklan($id);

    $data = [
      'title'        => 'View iklan',
      'iklan'     => $iklan,
      'gambar'    => $gambar,
      'content'          => 'admin/iklan/view_iklan'
    ];
    $this->load->view('admin/layout/wrapp', $data, FALSE);
  }

  public function delete($id)
  {
    //Proteksi delete
    is_login();

    $iklan = $this->iklan_model->iklan_detail($id);
    $images = $this->images_model->gambar_iklan($id);
    //Hapus gambar

    if ($images->file != "") {
      unlink('./assets/img/iklan/' . $images->file);
      // unlink('./assets/img/artikel/thumbs/' . $iklan->iklan_gambar);
    }
    //End Hapus Gambar
    $data = ['id'   => $iklan->id];
    $this->iklan_model->delete($data);
    $this->session->set_flashdata('message', 'Data telah di Hapus');
    redirect($_SERVER['HTTP_REFERER']);
  }


  // get Premium
  public function get_premium($id)
  {
    $user_id = $this->session->userdata('id');
    $user = $this->user_model->user_premium_detail($user_id);
    $iklan = $this->iklan_model->iklan_detail($id);
    $package_range = 3;
    // $iklan = $this->iklan_model->iklan_detail($id);

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
        'deskripsi'     => 'deskripsi',
        'keywords'      => 'keywords',
        'iklan'         => $iklan,
        'content'           => 'front/myaccount/premium_iklan'
      ];
      $this->load->view('front/layout/wrapp', $data, FALSE);
    } else {

      if ($user->premium_count == 0) {
        $this->session->set_flashdata('message', '<div class="alert alert-danger"> Sayangnya Paket Premium Anda sudah Habis Silahkan Order Paket di bawah ini<button type="button" aria-hidden="true" class="close" data-notify="dismiss">×</button></div> ');
        redirect(base_url('myaccount/package'), 'refresh');
      } else {
        $data = [
          'id'                        => $this->input->post('iklan_id'),
          'iklan_featured'              => date('Y-m-d', strtotime("+$package_range days")),
        ];
        $this->iklan_model->update($data);
        $this->user_model->update_premium_count($user_id);
        $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissable fade show" >Iklan Anda Berhasil di Highlight selama 90 Hari <button class="close" data-dismiss="alert" aria-label="Close">×</button></div>');
        redirect($_SERVER['HTTP_REFERER']);
      }
      $data = [
        'title'             => 'Province',
        'deskripsi'     => 'deskripsi',
        'keywords'      => 'keywords',
        'iklan'         => $iklan,
        'content'           => 'front/myaccount/premium_iklan'
      ];
      $this->load->view('front/layout/wrapp', $data, FALSE);
    }
  }

  public function package()
  {
    $meta = $this->meta_model->get_meta();
    $package = $this->package_model->get_package();
    $data = array(
      'title'       => 'Paket Iklan Premium',
      'deskripsi'   => 'deskripsi',
      'keywords'    => 'keywords ',
      'meta'        => $meta,
      'package'     => $package,
      'pagination'    => $this->pagination->create_links(),
      'content'     => 'front/myaccount/iklan_package'
    );
    $this->load->view('front/layout/wrapp', $data, FALSE);
  }
}

/* End of file Myaccount.php */
/* Location: ./application/controllers/Myaccount.php */
