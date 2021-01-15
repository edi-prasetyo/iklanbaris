<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Report extends CI_Controller
{
  //load data
  public function __construct()
  {
    parent::__construct();
    $this->load->model('category_model');
    $this->load->model('images_model');
    $this->load->model('report_model');
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
    $config['base_url']       = base_url('admin/report/index/');
    $config['total_rows']     = count($this->report_model->total_row());
    $config['per_page']       = 1;
    $config['uri_segment']    = 4;
    // $config['use_page_numbers'] = TRUE;
    // $config['page_query_string'] = true;
    // $config['query_string_segment'] = 'page';




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


    $report = $this->report_model->get_allreport($limit, $start);
    $data = [
      'title'         => 'Report Saya',
      'report'         => $report,
      'pagination'    => $this->pagination->create_links(),
      'content'       => 'admin/report/index_report'
    ];
    $this->load->view('admin/layout/wrapp', $data, FALSE);
  }
  // Create Report Property
  public function create()
  {
    // Validasi
    $this->form_validation->set_rules(
      'report_title',
      'Judul Report',
      'required',
      [
        'required'      => 'Judul Report harus di isi',
      ]
    );

    if ($this->form_validation->run()) {

      $data = [
        'report_title'   => $this->input->post('report_title'),
        // 'file1'         => $file1,
        // 'file2'         => $file2
      ];
      $insert_id = $this->report_model->create($data);
      $this->upload_images($insert_id);
      $this->session->set_flashdata('message', 'Data Report telah ditambahkan');
      redirect(base_url('admin/report'), 'refresh');
    } else {

      $data = [
        'title'         => 'Pasang Report Property',
        'pagination'    => $this->pagination->create_links(),

        'content'       => 'admin/report/create_property'
      ];
      $this->load->view('admin/layout/wrapp', $data, FALSE);
    }
  }
  // Update Report Property
  public function update($id)
  {
    // Validasi
    $this->form_validation->set_rules(
      'report_title',
      'Judul Report',
      'required',
      [
        'required'      => 'Judul Report harus di isi',
      ]
    );

    if ($this->form_validation->run()) {

      $data = [
        'report_title'   => $this->input->post('report_title'),
        // 'file1'         => $file1,
        // 'file2'         => $file2
      ];
      $insert_id = $this->report_model->create($data);
      $this->upload_images($insert_id);
      $this->session->set_flashdata('message', 'Data Report telah ditambahkan');
      redirect(base_url('admin/report'), 'refresh');
    } else {

      $data = [
        'title'         => 'Pasang Report Property',
        'pagination'    => $this->pagination->create_links(),

        'content'       => 'admin/report/create_property'
      ];
      $this->load->view('admin/layout/wrapp', $data, FALSE);
    }
  }

  public function upload_images($insert_id)
  {

    $config['upload_path']          = './assets/img/report/';
    $config['allowed_types']        = 'gif|jpg|png|jpeg';
    $config['max_size']             = 5000; //Dalam Kilobyte
    $config['max_width']            = 5000; //Lebar (pixel)
    $config['max_height']           = 5000; //tinggi (pixel)
    $config['encrypt_name']         = TRUE;
    $this->load->library('upload', $config);

    for ($i = 1; $i <= 3; $i++) {
      if (!empty($_FILES['file' . $i]['name'])) {
        if (!$this->upload->do_upload('file' . $i));
        // $data2 = $this->upload->data();



        //Proses Manipulasi Gambar
        $upload_data    = array('uploads'  => $this->upload->data());

        // Resize Image
        $config['image_library']    = 'gd2';
        $config['source_image']     = './assets/img/report/' . $upload_data['uploads']['file_name'];
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
        $config['source_image']     = './assets/img/report/' . $upload_data['uploads']['file_name'];
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
          'report_id'      => $insert_id,
          'file'         =>  $upload_data['uploads']['file_name'],
          'date_created'  => time()
        ];
        $this->images_model->create($data);
      }
    }
  }

  // View

  public function view($id)
  {
    $report = $this->report_model->report_detail($id);
    $gambar = $this->images_model->gambar_report($id);

    $data = [
      'title'        => 'View report',
      'report'     => $report,
      'gambar'    => $gambar,
      'content'          => 'admin/report/view_report'
    ];
    $this->load->view('admin/layout/wrapp', $data, FALSE);
  }

  //Banned User
  public function inactive($id)
  {
    //Proteksi delete
    is_login();
    $data = [
      'id'                    => $id,
      'report_status'             => 'Inactive',
    ];
    $this->report_model->update($data);
    $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissable fade show" >Iklan telah Di Nonaktifkan <button class="close" data-dismiss="alert" aria-label="Close">×</button></div>');
    redirect($_SERVER['HTTP_REFERER']);
  }

  public function delete($id)
  {
    //Proteksi delete
    is_login();

    $report = $this->report_model->report_detail($id);
    $images = $this->images_model->gambar_report($id);
    //Hapus gambar

    if ($images->file != "") {
      unlink('./assets/img/report/' . $images->file);
      // unlink('./assets/img/artikel/thumbs/' . $berita->berita_gambar);
    }
    //End Hapus Gambar
    $data = ['id'   => $report->id];
    $this->report_model->delete($data);
    $this->session->set_flashdata('message', 'Data telah di Hapus');
    redirect($_SERVER['HTTP_REFERER']);
  }
}
