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

			$email = $this->input->post('email', true);
			$data = [
				'user_title'	=> $this->input->post('user_title'),
				'user_name' 	=> htmlspecialchars($this->input->post('user_name', true)),
				'email' 			=> htmlspecialchars($email),
				'username'		=> $this->input->post('username'),
				'user_image' 	=> 'default.jpg',
				'user_phone'	=> $hp,
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
			$this->email->message('






			<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
			<html xmlns="http://www.w3.org/1999/xhtml">
			<head>
			  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
			  <meta name="viewport" content="width=device-width, initial-scale=1" />
			  <title>Neopolitan Invoice Email</title>


			  <style type="text/css">
			  @import url(http://fonts.googleapis.com/css?family=Droid+Sans);


			  img {
			    max-width: 600px;
			    outline: none;
			    text-decoration: none;
			    -ms-interpolation-mode: bicubic;
			  }

			  a {
			    text-decoration: none;
			    border: 0;
			    outline: none;
			    color: #bbbbbb;
			  }

			  a img {
			    border: none;
			  }

			  /* General styling */

			  td, h1, h2, h3  {
			    font-family: Helvetica, Arial, sans-serif;
			    font-weight: 400;
			  }

			  td {
			    text-align: center;
			  }

			  body {
			    -webkit-font-smoothing:antialiased;
			    -webkit-text-size-adjust:none;
			    width: 100%;
			    height: 100%;
			    color: #37302d;
			    background: #ffffff;
			    font-size: 16px;
			  }

			   table {
			    border-collapse: collapse !important;
			  }

			  .headline {
			    color: #ffffff;
			    font-size: 36px;
			  }

			 .force-full-width {
			  width: 100% !important;
			 }

			 .force-width-80 {
			  width: 80% !important;
			 }




			  </style>

			  <style type="text/css" media="screen">
			      @media screen {

			        }
			      }
			  </style>

			  <style type="text/css" media="only screen and (max-width: 480px)">
			    @media only screen and (max-width: 480px) {

			      table[class="w320"] {
			        width: 320px !important;
			      }

			      td[class="mobile-block"] {
			        width: 100% !important;
			        display: block !important;
			      }


			    }
			  </style>
			</head>
			<body class="body" style="padding:0; margin:0; display:block; background:#ffffff; -webkit-text-size-adjust:none" bgcolor="#ffffff">
			<table align="center" cellpadding="0" cellspacing="0" class="force-full-width" height="100%" >
			  <tr>
			    <td align="center" valign="top" bgcolor="#ffffff"  width="100%">
			      <center>
			        <table style="margin: 0 auto;" cellpadding="0" cellspacing="0" width="600" class="w320">
			          <tr>
			            <td align="center" valign="top">



			                <table style="margin: 0 auto;" cellpadding="0" cellspacing="0" class="force-full-width" bgcolor="#2c3e50">
			                  <tr>
			                    <td style="color:#ffffff;">
			                    <br>
			                      ' . $meta->title . '
			                    </td>
			                  </tr>
			                  <tr>
			                    <td class="headline">
			                      Verifikasi Akun!
			                    </td>
			                  </tr>
			                  <tr>
			                    <td>

			                      <center>
			                        <table style="margin: 0 auto;" cellpadding="0" cellspacing="0" width="60%">
			                          <tr>
			                            <td style="color:#ffffff;">
			                            <br>
			                             Silahkan Klik tombol Verifikasi untuk mengaktifkan Akun Anda
			                            <br>
			                            <br>
			                            </td>
			                          </tr>
			                        </table>
			                      </center>

			                    </td>
			                  </tr>
			                  <tr>
			                    <td>
			                      <div>

			                        </div>
			                      <br>
			                      <br>
			                    </td>
			                  </tr>
			                </table>

			                <table style="margin: 0 auto;" cellpadding="0" cellspacing="0" class="force-full-width" bgcolor="#f5774e">
			                  <tr>
			                    <td style="background-color:#34495e;">

			                    <center>
			                      <table style="margin:0 auto;" cellspacing="0" cellpadding="0" class="force-width-80">
			                        <tr>

			                        </tr>
			                      </table>


			                      <table style="margin:60px auto;" cellspacing="0" cellpadding="0" class="force-width-80">
			                        <tr>
			                          <td  class="mobile-block" >

									  <a href="' . base_url() . 'auth/verify?email=' . $this->input->post('email') . '&token=' . urlencode($token) . '"
			                      style="background-color:#178f8f;border-radius:4px;color:#ffffff;display:inline-block;font-family:Helvetica, Arial, sans-serif;font-size:16px;font-weight:bold;line-height:50px;text-align:center;text-decoration:none;width:200px;-webkit-text-size-adjust:none;">Verifikasi</a>


			                          </td>
			                        </tr>
			                      </table>






			                      <table style="margin: 0 auto;" cellspacing="0" cellpadding="0" class="force-width-80">
			                        <tr>
			                          <td style="text-align:left; color:#ffffff;line-height:25px">
			                          <br>
			                            Terima kasih ' . $this->input->post('email') . ' Telah Bergabung menjadi member graha studio, Nikmati layanan yang kami sediakan mulai dari yang free sampai berbayar
			                          <br>
			                          <br>
			                          Graha Studio
			                          <br>
			                          <br>
			                          <br>
			                          </td>
			                        </tr>
			                      </table>
			                    </center>



			                    </td>
			                  </tr>


			                </table>

			                <table style="margin: 0 auto;" cellpadding="0" cellspacing="0" class="force-full-width" bgcolor="#414141" style="margin: 0 auto">
			                  <tr>
			                    <td style="background-color:#2c3e50;">
			                    <br>
			                    <br>
			                      <span style="color:#ffffff;">Untuk Informasi silahkan Hubungi ' . $meta->telepon . '</span>
			                      <br>
			                      <br>
			                    </td>
			                  </tr>

			                </table>

			            </td>
			          </tr>
			        </table>
			    </center>
			    </td>
			  </tr>
			</table>
			</body>
			</html>









































			');
		} elseif ($type == 'forgot') {
			$this->email->subject('Reset Password');
			$this->email->message('










			<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
			<html xmlns="http://www.w3.org/1999/xhtml">
			<head>
			  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
			  <meta name="viewport" content="width=device-width, initial-scale=1" />
			  <title>Neopolitan Invoice Email</title>


			  <style type="text/css">
			  @import url(http://fonts.googleapis.com/css?family=Droid+Sans);


			  img {
			    max-width: 600px;
			    outline: none;
			    text-decoration: none;
			    -ms-interpolation-mode: bicubic;
			  }

			  a {
			    text-decoration: none;
			    border: 0;
			    outline: none;
			    color: #bbbbbb;
			  }

			  a img {
			    border: none;
			  }

			  /* General styling */

			  td, h1, h2, h3  {
			    font-family: Helvetica, Arial, sans-serif;
			    font-weight: 400;
			  }

			  td {
			    text-align: center;
			  }

			  body {
			    -webkit-font-smoothing:antialiased;
			    -webkit-text-size-adjust:none;
			    width: 100%;
			    height: 100%;
			    color: #37302d;
			    background: #ffffff;
			    font-size: 16px;
			  }

			   table {
			    border-collapse: collapse !important;
			  }

			  .headline {
			    color: #ffffff;
			    font-size: 36px;
			  }

			 .force-full-width {
			  width: 100% !important;
			 }

			 .force-width-80 {
			  width: 80% !important;
			 }




			  </style>

			  <style type="text/css" media="screen">
			      @media screen {

			        }
			      }
			  </style>

			  <style type="text/css" media="only screen and (max-width: 480px)">
			    @media only screen and (max-width: 480px) {

			      table[class="w320"] {
			        width: 320px !important;
			      }

			      td[class="mobile-block"] {
			        width: 100% !important;
			        display: block !important;
			      }


			    }
			  </style>
			</head>
			<body class="body" style="padding:0; margin:0; display:block; background:#ffffff; -webkit-text-size-adjust:none" bgcolor="#ffffff">
			<table align="center" cellpadding="0" cellspacing="0" class="force-full-width" height="100%" >
			  <tr>
			    <td align="center" valign="top" bgcolor="#ffffff"  width="100%">
			      <center>
			        <table style="margin: 0 auto;" cellpadding="0" cellspacing="0" width="600" class="w320">
			          <tr>
			            <td align="center" valign="top">



			                <table style="margin: 0 auto;" cellpadding="0" cellspacing="0" class="force-full-width" bgcolor="#2c3e50">
			                  <tr>
			                    <td style="color:#ffffff;">
			                    <br>
			                      ' . $meta->title . '
			                    </td>
			                  </tr>
			                  <tr>
			                    <td class="headline">
			                      Reset Password!
			                    </td>
			                  </tr>
			                  <tr>
			                    <td>

			                      <center>
			                        <table style="margin: 0 auto;" cellpadding="0" cellspacing="0" width="60%">
			                          <tr>
			                            <td style="color:#ffffff;">
			                            <br>
			                             Silahkan Klik tombol Reset password untuk merubah password akun anda
			                            <br>
			                            <br>
			                            </td>
			                          </tr>
			                        </table>
			                      </center>

			                    </td>
			                  </tr>
			                  <tr>
			                    <td>
			                      <div>

			                        </div>
			                      <br>
			                      <br>
			                    </td>
			                  </tr>
			                </table>

			                <table style="margin: 0 auto;" cellpadding="0" cellspacing="0" class="force-full-width" bgcolor="#f5774e">
			                  <tr>
			                    <td style="background-color:#34495e;">

			                    <center>
			                      <table style="margin:0 auto;" cellspacing="0" cellpadding="0" class="force-width-80">
			                        <tr>

			                        </tr>
			                      </table>


			                      <table style="margin:60px auto;" cellspacing="0" cellpadding="0" class="force-width-80">
			                        <tr>
			                          <td  class="mobile-block" >

									  <a href="' . base_url() . 'auth/resetpassword?email=' . $this->input->post('email') . '&token=' . urlencode($token) . '"
			                      style="background-color:#178f8f;border-radius:4px;color:#ffffff;display:inline-block;font-family:Helvetica, Arial, sans-serif;font-size:16px;font-weight:bold;line-height:50px;text-align:center;text-decoration:none;width:200px;-webkit-text-size-adjust:none;">Reset Password</a>


			                          </td>
			                        </tr>
			                      </table>






			                      <table style="margin: 0 auto;" cellspacing="0" cellpadding="0" class="force-width-80">
			                        <tr>
			                          <td style="text-align:left; color:#ffffff;line-height:25px">
			                          <br>
			                            Pastikan anda selalu menyimpan password anda
			                          <br>
			                          <br>
			                          Graha Studio
			                          <br>
			                          <br>
			                          <br>
			                          </td>
			                        </tr>
			                      </table>
			                    </center>



			                    </td>
			                  </tr>


			                </table>

			                <table style="margin: 0 auto;" cellpadding="0" cellspacing="0" class="force-full-width" bgcolor="#414141" style="margin: 0 auto">
			                  <tr>
			                    <td style="background-color:#2c3e50;">
			                    <br>
			                    <br>
			                      <span style="color:#ffffff;">Untuk Informasi silahkan Hubungi ' . $meta->telepon . '</span>
			                      <br>
			                      <br>
			                    </td>
			                  </tr>

			                </table>

			            </td>
			          </tr>
			        </table>
			    </center>
			    </td>
			  </tr>
			</table>
			</body>
			</html>


















			');
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
