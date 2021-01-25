<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('meta_model');
		$this->load->library('form_validation');
	}

	public function index()
	{

		if ($this->session->userdata('id')) {
			redirect('myaccount');
		}
		$this->form_validation->set_rules(
			'email',
			'Email',
			'required|trim|valid_email',
			[
				'required' 		=> 'Email harus di isi',
				'valid_email' 	=> 'Format email Tidak sesuai'
			]
		);
		$this->form_validation->set_rules(
			'password',
			'Password',
			'required|trim',
			[
				'required' 		=> 'Password harus di isi',
			]
		);
		if ($this->form_validation->run() == false) {
			$data = [
				'title' 				=> 'User Login',
				'deskripsi'     => 'Halaman Login Member area Graha studio',
				'keywords'      => 'Graha Studio, Login Member',
				'content'       => 'front/auth/login'
			];
			$this->load->view('front/layout/wrapp', $data, FALSE);
		} else {
			//Validasi Berhasil
			$this->_login();
		}
	}
	private function _login()
	{
		$email = $this->input->post('email');
		$password = $this->input->post('password');

		$user = $this->db->get_where('user', ['email' => $email])->row_array();
		if ($user) {
			//User Ada
			//Jika User Aktif
			if ($user['is_active'] == 1) {
				//Cek Password
				if (password_verify($password, $user['password'])) {
					//Password Berhasil
					$data  = [
						'email'		=> $user['email'],
						'role_id'	=> $user['role_id'],
						'id'			=> $user['id'],
					];
					$this->session->set_userdata($data);
					if ($user['role_id'] == 1) {
						redirect('/');
					} else {
						redirect('/');
					}
				} else {
					//Password Salah
					$this->session->set_flashdata('message', '<div class="alert alert-danger">Password Salah</div> ');
					redirect('auth');
				}
			} else {
				//User tidak Aktif
				$this->session->set_flashdata('message', '<div class="alert alert-danger">Email Belum di Aktivasi, Silahkan Cek email anda</div> ');
				redirect('auth');
			}
		} else {
			//User tidak ada
			$this->session->set_flashdata('message', '<div class="alert alert-danger">Email Tidak Terdaftar</div> ');
			redirect('auth');
		}
	}

	public function register()
	{
		if ($this->session->userdata('id')) {
			redirect('myaccount');
		}
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
			'username',
			'Username',
			'required|trim|alpha_numeric|is_unique[user.username]',
			[
				'required' 			=> 'Username Harus diisi',
				'alpha_numeric'	=> 'hanya boleh diisi huruf dan angka tanpa spasi',
				'is_unique'			=> 'Username Sudah digunakan, Coba tambahkan angka di belakangnya'
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
				'title'					=> 'Register',
				'deskripsi'     		=> 'Register',
				'keywords'      		=> 'Register',
				'content'       		=> 'front/auth/register'
			];
			$this->load->view('front/layout/wrapp', $data, FALSE);
		} else {



			$email = $this->input->post('email', true);
			$data = [
				'user_title'	=> $this->input->post('user_title'),
				'user_name' 	=> htmlspecialchars($this->input->post('user_name', true)),
				'email' 			=> htmlspecialchars($email),
				'username'		=> $this->input->post('username'),
				'user_image' 	=> 'default.jpg',
				'password'		=> password_hash($this->input->post('password1'), PASSWORD_DEFAULT),
				'role_id'			=> 5,
				'is_active'		=> 0,
				'post_count '	=> 20,
				'date_register'	=> time()
			];
			//Token
			$token = base64_encode(random_bytes(25));
			$user_token = [
				'email'			=> $email,
				'token'			=> $token,
				'date_created'	=> time()
			];
			$this->db->insert('user', $data);
			$this->db->insert('user_token', $user_token);
			//Kirim Email
			$this->_sendEmail($token, 'verify');

			$this->session->set_flashdata('message', '<div class="alert alert-success">Selamat Anda berhasil mendaftar, silahkan Aktivasi akun</div> ');
			redirect('auth');
		}
	}
	private function _sendEmail($token, $type)
	{
		$meta               = $this->meta_model->get_meta();
		$config = [

			'protocol' 		=> 'smtp',
			'smtp_host' 	=> 'ssl://mail.site.com',
			'smtp_port' 	=> 465,
			'smtp_user' 	=> 'mail@site.com',
			'smtp_pass' 	=> 'password',
			'mailtype' 		=> 'html',
			'charset' 		=> 'utf-8',

		];

		$this->load->library('email', $config);
		$this->email->initialize($config);

		$this->email->set_newline("\r\n");

		$this->email->from('mail@site.com', 'Testing');
		$this->email->to($this->input->post('email'));

		if ($type == 'verify') {
			$this->email->subject('Account Verification');
			$this->email->message('Silahkan Klik Link di bawah ini untuk mengaktivasi akun <br>
			<a style="background-color:#1aa35c;border-radius:3px;color:#ffffff;display:inline-block;font-family:sans-serif;font-size:16px;line-height:44px;text-align:center;text-decoration:none;padding:0 15px 0 15px" href=" ' . base_url() . 'auth/verify?email=' . $this->input->post('email') . '&token=' . urlencode($token) . ' ">Aktivasi Akun &rarr;</a>');
		} elseif ($type == 'forgot') {
			$this->email->subject('Reset Password');
			$this->email->message('Silahkan Klik Link ini untuk Mereset Password <br>
			<a style="background-color:#1aa35c;border-radius:3px;color:#ffffff;display:inline-block;font-family:sans-serif;font-size:16px;line-height:44px;text-align:center;text-decoration:none;padding:0 15px 0 15px" href=" ' . base_url() . 'auth/resetpassword?email=' . $this->input->post('email') . '&token=' . urlencode($token) . ' ">Reset Password &rarr;</a>');
		}


		if ($this->email->send()) {
			return true;
		} else {
			echo $this->email->print_debugger();
			die;
		}
	}
	public function verify()
	{
		if ($this->session->userdata('id')) {
			redirect('myaccount');
		}

		$email = $this->input->get('email');
		$token = $this->input->get('token');

		$user = $this->db->get_where('user', ['email' => $email])->row_array();

		if ($user) {
			$user_token = $this->db->get_where('user_token', ['token' => $token])->row_array();
			if ($user_token) {
				if (time() - $user_token['date_created'] < (60 * 60 * 24)) {

					$this->db->set('is_active', 1);
					$this->db->where('email', $email);
					$this->db->update('user');

					$this->db->delete('user_token', ['email' => $email]);
					$this->session->set_flashdata('message', '<div class="alert alert-success">Selamat email ' . $email . '  sudah di aktivasi, Silahkan login!</div> ');
					redirect('auth');
				} else {
					$this->db->delete('user', ['email' => $email]);
					$this->db->delete('user', ['token' => $token]);
					$this->session->set_flashdata('message', '<div class="alert alert-danger">Aktivasi akun Gagal, Token Expired!</div> ');
					redirect('auth');
				}
			} else {
				$this->session->set_flashdata('message', '<div class="alert alert-danger">Aktivasi akun Gagal, Token salah!</div> ');
				redirect('auth');
			}
		} else {
			$this->session->set_flashdata('message', '<div class="alert alert-danger">Aktivasi akun Gagal, Email salah!</div> ');
			redirect('auth');
		}
	}
	public function forgotPassword()
	{
		if ($this->session->userdata('id')) {
			redirect('myaccount');
		}
		$this->form_validation->set_rules(
			'email',
			'Email',
			'required|trim|valid_email',
			[
				'required' 		=> 'Email harus di isi',
				'valid_email' 	=> 'Format email Tidak sesuai'
			]
		);
		if ($this->form_validation->run() == false) {
			$data = [
				'title'		=> 'Forgot Password',
				'deskripsi'     => 'Halaman Lupa Password  Graha studio',
				'keywords'      => 'Graha Studio, Lupa Password',
				'content'	=> 'front/auth/forgot_password'
			];
			$this->load->view('front/layout/wrapp', $data, FALSE);
		} else {
			$email = $this->input->post('email');
			$user = $this->db->get_where('user', ['email' => $email, 'is_active' => 1])->row_array();
			if ($user) {
				$token = base64_encode(random_bytes(25));
				$user_token = [
					'email'			=> $email,
					'token'			=> $token,
					'date_created'	=> time()
				];
				$this->db->insert('user_token', $user_token);
				$this->_sendEmail($token, 'forgot');

				$this->session->set_flashdata('message', '<div class="alert alert-success">Silahkan cek email untuk mereset password</div> ');
				redirect('auth');
			} else {
				$this->session->set_flashdata('message', '<div class="alert alert-danger">Email Tidak Terdaftar atau belum di aktivasi</div> ');
				redirect('auth');
			}
		}
	}
	public function resetPassword()
	{
		if ($this->session->userdata('id')) {
			redirect('myaccount');
		}

		$email = $this->input->get('email');
		$token = $this->input->get('token');
		$user = $this->db->get_where('user', ['email' => $email])->row_array();

		if ($user) {
			$user_token = $this->db->get_where('user_token', ['token' => $token])->row_array();

			if ($user_token) {
				$this->session->set_userdata('reset_email', $email);
				$this->changePassword();
			} else {
				$this->session->set_flashdata('message', '<div class="alert alert-danger">Reset password Gagal, Token salah</div> ');
				redirect('auth');
			}
		} else {
			$this->session->set_flashdata('message', '<div class="alert alert-danger">Reset password Gagal, Email salah</div> ');
			redirect('auth');
		}
	}
	public function changePassword()
	{
		if (!$this->session->userdata('reset_email')) {
			redirect('auth');
		}
		$this->form_validation->set_rules(
			'password1',
			'Password',
			'trim|required|min_length[5]|matches[password2]'
		);
		$this->form_validation->set_rules(
			'password2',
			'Repeat Password',
			'trim|required|min_length[5]|matches[password1]'
		);

		if ($this->form_validation->run() == false) {
			$data = [
				'title'					=> 'Change Password',
				'deskripsi'     => 'Reset Password Graha studio',
				'keywords'      => 'Graha Studio, Reset Password',
				'content'				=> 'front/auth/change_password'
			];
			$this->load->view('front/layout/wrapp', $data, FALSE);
		} else {
			$password = password_hash($this->input->post('password1'), PASSWORD_DEFAULT);
			$email = $this->session->userdata('reset_email');

			$this->db->set('password', $password);
			$this->db->where('email', $email);
			$this->db->update('user');

			$this->session->unset_userdata('reset_email');
			$this->session->set_flashdata('message', '<div class="alert alert-success">Password has been change</div> ');
			redirect('auth');
		}
	}
	public function logout()
	{
		$this->session->unset_userdata('email');
		$this->session->unset_userdata('id');
		$this->session->unset_userdata('role_id');
		$this->session->set_flashdata('message', '<div class="alert alert-success">Anda sudah Logout</div> ');
		redirect('auth');
	}
}
