<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('user_model');
        $this->load->library('pagination');

        $id = $this->session->userdata('id');
        $user = $this->user_model->user_detail($id);
        if ($user->role_id == 2) {
            redirect('admin/dashboard');
        }
    }
    public function index()
    {
      $config['base_url']       = base_url('admin/user/index/');
      $config['total_rows']     = count($this->user_model->total_row());
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


        $list_user = $this->user_model->user_member($limit, $start);
        $data = [
            'title'                 => 'Data User',
            'list_user'             => $list_user,
            'pagination'            => $this->pagination->create_links(),
            'content'               => 'admin/user/index_user'

        ];
        $this->load->view('admin/layout/wrapp', $data, FALSE);
    }
    //Create User
    public function create()
  	{
  		$this->form_validation->set_rules(
  			'user_name',
  			'Nama',
  			'required|trim',
  			['required' => 'nama harus di isi']
  		);
  		$this->form_validation->set_rules(
  			'email',
  			'Email',
  			'required|trim|valid_email|is_unique[user.email]',
  			[
  				'required' 		=> 'Email Harus diisi',
  				'valid_email' 	=> 'Email Harus Valid',
  				'is_unique'		=> 'Email Sudah ada, Gunakan Email lain'
  			]
  		);
  		$this->form_validation->set_rules(
  			'password1',
  			'Password',
  			'required|trim|min_length[3]|matches[password2]',
  			[
  				'matches' 		=> 'Password tidak sama',
  				'min_length' 	=> 'Password Min 3 karakter'
  			]
  		);
  		$this->form_validation->set_rules('password2', 'Ulangi Password', 'required|trim|matches[password1]');

  		if ($this->form_validation->run() == false) {
  			$data = [
  				'title'			=> 'Create User',
  				'content'       => 'admin/user/create_user'
  			];
  			$this->load->view('admin/layout/wrapp', $data, FALSE);
  		} else {
  			$email = $this->input->post('email', true);
        $username = substr($email, 0, strpos($email, '@'));
  			$data = [
  				'user_title'	     => $this->input->post('user_title'),
  				'user_name' 	     => htmlspecialchars($this->input->post('user_name', true)),
  				'email' 		       => htmlspecialchars($email),
          'username'		     => $username,
  				'user_image' 	     => 'default.jpg',
  				'user_phone'	     => $this->input->post('user_phone'),
  				'password'		     => password_hash($this->input->post('password1'), PASSWORD_DEFAULT),
  				'role_id'		       => 2,
  				'is_active'		     => 0,
  				'date_created'	   => time()
  			];
  			$this->db->insert('user', $data);


  			$this->session->set_flashdata('message', '<div class="alert alert-success">Selamat Anda berhasil mendaftar, silahkan Aktivasi akun</div> ');
  			redirect('admin/user');
  		}
  	}

    //Banned User
  public function banned($id)
  {
    //Proteksi delete
    is_login();
    $data = [
      'id'                    => $id,
      'is_active'             => 0,
    ];
    $this->user_model->update($data);
    $this->session->set_flashdata('message', 'User Telah di banned');
    redirect($_SERVER['HTTP_REFERER']);
  }
  public function activated($id)
  {
    //Proteksi delete
    is_login();
    $data = [
      'id'                    => $id,
      'is_active'             => 1,
    ];
    $this->user_model->update($data);
    $this->session->set_flashdata('message', 'User Telah di Aktifkan');
    redirect($_SERVER['HTTP_REFERER']);
  }

}
