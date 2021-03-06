<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require './vendor/autoload.php';
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

class Auth extends CI_Controller {

	public function index()
	{
		if ($this->session->userdata('login')) {
			redirect('dashboard','refresh');
		}

		$valid = $this->form_validation;

		$valid->set_rules('email', 'email', 'required');
		$valid->set_rules('password', 'password', 'required');
		$valid->set_message('required', 'Kolom wajib diisi');

		if ($valid->run()) {
			$post = $this->input->post();

			$this->db->join('role', 'id_role', 'left');
			$user = $this->db->get_where('user', ['email' => $post['email']])->row_array();

			if ($user) {

				if (password_verify($post['password'], $user['password'])) {

					$session = [
						'login' => true,
						'id_user' => $user['id_user'],
						'id_role' => $user['id_role'],
						'nama_user' => $user['nama_user'],
						'level' => $user['nama_role'],
						'petugas' => $user['petugas'],
						'id_jurusan' => $user['id_jurusan']
					];

					$this->session->set_userdata($session);

					if ($user['petugas']) {
						redirect('transaksi','refresh');
					}

					redirect('dashboard','refresh');
					
				} else {
					$this->session->set_flashdata('error', 'Password anda salah');
					redirect('login','refresh');
				}
				
			}else{
				$this->session->set_flashdata('error', 'Email tidak ditemukan');
				redirect('login','refresh');
			}
		}

		$this->load->view('auth/login');
	}

	public function logout($value='')
	{
		$this->session->sess_destroy();
		redirect('login','refresh');
	}


	public function logout_siswa($value='')
	{
		$this->session->sess_destroy();
		redirect('login_siswa','refresh');
	}

	public function siswa()
	{
		$valid = $this->form_validation;

		$valid->set_rules('nis', 'nis', 'required');
		$valid->set_rules('password', 'password', 'required');
		$valid->set_message('required', 'Kolom wajib diisi');

		if ($valid->run()) {
			$post = $this->input->post();

			$siswa = $this->db->get_where('siswa', ['nis' => $post['nis']])->row_array();

			if ($siswa) {

				// if ($siswa['aktif'] == 0) {
				// 	$this->session->set_flashdata('error', 'Akun anda belum diaktifkan');
				// 	redirect('login_siswa','refresh');
				// }

				if (password_verify($post['password'], $siswa['password'])) {

					$session = [
						'loginsiswa' => true,
						'id_siswa' => $siswa['id_siswa'],
						'nis' => $siswa['nis'],
						'nama_siswa' => $siswa['nama_siswa'],
						'id_kelas' => $siswa['id_kelas'],
						'id_jurusan' => $siswa['id_jurusan']
					];

					$this->session->set_userdata($session);

					if ($siswa['aktif'] == 0) {
						redirect('auth/verifikasi_email','refresh');
					}

					redirect('dashboard/siswa','refresh');
					
				} else {
					$this->session->set_flashdata('error', 'Password anda salah');
					redirect('login_siswa','refresh');
				}
				
			}else{
				$this->session->set_flashdata('error', 'Email tidak ditemukan');
				redirect('login_siswa','refresh');
			}
		}

		$this->load->view('auth/login_siswa');
	}

	public function verifikasi_email()
	{
		$this->form_validation->set_rules('email', 'email', 'required');
		$this->form_validation->set_rules('pw1', 'password baru', 'required|matches[pw2]');
		$this->form_validation->set_rules('pw2', 'konfirmasi password baru', 'required|matches[pw1]');

		if ($this->form_validation->run()) {
			$token = acak(32);
			$post = $this->input->post();

			$siswa = $this->db->get_where('siswa', ['id_siswa' => $this->session->userdata('id_siswa')])->row_array();

			$token_siswa = [
				'id_siswa' => $siswa['id_siswa'],
				'token' => $token
			];

			$this->db->insert('token_siswa', $token_siswa);

			$this->db->set('email', $post['email']);
			$this->db->set('password', password_hash($post['pw1'], PASSWORD_DEFAULT));
			$this->db->where('id_siswa', $siswa['id_siswa']);
			$this->db->update('siswa');

			$this->_send_email_siswa($token, $post['email']);

			$this->session->set_flashdata('message', 'Periksa email anda untuk aktivasi akun, bila tidak terdapat email periksa folder SPAM');
			redirect('login_siswa','refresh');
		}else{
			$this->load->view('auth/verifikasi_email');
		}
	}

	public function daftar_siswa()
	{
		$this->form_validation->set_rules('nis', 'nis', 'required');
		$this->form_validation->set_rules('tgl', 'tgl', 'required');
		$this->form_validation->set_rules('email', 'email', 'required');
		$this->form_validation->set_rules('password', 'password', 'required|matches[konfirmasi_password]|is_unique[siswa.email]');
		$this->form_validation->set_rules('konfirmasi_password', 'konfirmasi password', 'required|matches[password]');

		if ($this->form_validation->run()) {
			$post = $this->input->post();

			$siswa = $this->db->get_where('siswa', ['nis' => $post['nis'], 'tgl_lahir' => $post['tgl']])->row_array();

			if ($siswa) {
				$token = acak(32);

				$token_siswa = [
					'id_siswa' => $siswa['id_siswa'],
					'token' => $token
				];

				$this->db->insert('token_siswa', $token_siswa);

				$this->db->set('email', $post['email']);
				$this->db->set('password', password_hash($post['password'], PASSWORD_DEFAULT));
				$this->db->where('id_siswa', $siswa['id_siswa']);
				$this->db->update('siswa');

				$this->_send_email_siswa($token, $siswa['email']);

				$this->session->set_flashdata('message', 'Periksa email anda untuk aktivasi akun, bila tidak terdapat email periksa folder SPAM');
				redirect('login_siswa','refresh');
			}else{
				$this->session->set_flashdata('error', 'NIS atau tanggal lahir anda salah');
				redirect('auth/daftar_siswa','refresh');
			}
		}
		$this->load->view('auth/daftar_siswa');
	}

	private function _send_email_siswa($token, $email)
	{
		$pengaturan = $this->db->get('pengaturan')->row_array();

		$mail = new PHPMailer(true);
		try {
		    //Server settings
		    // $mail->SMTPDebug = SMTP::DEBUG_SERVER;                     
			$mail->isSMTP();                                           
			$mail->Host       = $pengaturan['smtp_host'];                   
			$mail->SMTPAuth   = true;                                  
			$mail->Username   = $pengaturan['smtp_email'];                    
			$mail->Password   = $pengaturan['smtp_password'];                        
			$mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;        
			$mail->Port       = 465;                                   

		    //Recipients
			$mail->setFrom('noreply@mail.com', $pengaturan['nama_aplikasi']);
			$mail->addAddress($email);    

		    // Content
			$mail->isHTML(true);  
			$mail->Subject = 'AKTIVASI AKUN';
			$mail->Body    = '
			<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
			<html xmlns="http://www.w3.org/1999/xhtml">
			<head>
			<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
			<title>AKTIVASI AKUN</title>
			<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
			</head>
			<body style="margin: 0; padding: 0;">
			<table border="0" cellpadding="0" cellspacing="0" width="100%"> 
			<tr>
			<td style="padding: 10px 0 30px 0;">
			<table align="center" border="0" cellpadding="0" cellspacing="0" width="600" style="border: 1px solid #cccccc; border-collapse: collapse;">
			<tr>
			<td align="center" bgcolor="#70bbd9" style="padding: 40px 0 30px 0; color: #153643; font-size: 28px; font-weight: bold; font-family: Arial, sans-serif;">
			</td>
			</tr>
			<tr>
			<td bgcolor="#ffffff" style="padding: 40px 30px 40px 30px;">
			<table border="0" cellpadding="0" cellspacing="0" width="100%">
			<tr>
			<td style="color: #153643; font-family: Arial, sans-serif; font-size: 24px;">
			<b>AKTIVASI AKUN</b>
			</td>
			</tr>
			<tr>
			<td style="padding: 20px 0 30px 0; color: #153643; font-family: Arial, sans-serif; font-size: 16px; line-height: 20px;">
			Klik tautan dibawah untuk aktivasi akun anda!
			</td>
			</tr>
			<tr>
			<td><a href="' . base_url('auth/verify_siswa?email='. $email . '&token=' . $token) . '">AKTIVASI AKUN</a></td>
			</tr>
			</table>
			</td>
			</tr>
			</table>
			</td>
			</tr>
			</table>
			</body>
			</html>';

			$mail->send();

		} catch (Exception $e) {
			echo "Email gagal dikirim. Silahkan Coba Lagi";
			echo "<br>";
			echo "Mesage : {$mail->ErrorInfo}";
			die;
		}
	}


	private function _send_email($token, $email)
	{
		$pengaturan = $this->db->get('pengaturan')->row_array();

		$mail = new PHPMailer(true);
		try {
		    //Server settings
		    // $mail->SMTPDebug = SMTP::DEBUG_SERVER;                     
			$mail->isSMTP();                                           
			$mail->Host       = $pengaturan['smtp_host'];                   
			$mail->SMTPAuth   = true;                                  
			$mail->Username   = $pengaturan['smtp_email'];                    
			$mail->Password   = $pengaturan['smtp_password'];                        
			$mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;        
			$mail->Port       = 465;                                   

		    //Recipients
			$mail->setFrom('noreply@mail.com', $pengaturan['nama_aplikasi']);
			$mail->addAddress($email);    

		    // Content
			$mail->isHTML(true);  
			$mail->Subject = 'Lupa Password';
			$mail->Body    = '
			<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
			<html xmlns="http://www.w3.org/1999/xhtml">
			<head>
			<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
			<title>Lupa Password</title>
			<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
			</head>
			<body style="margin: 0; padding: 0;">
			<table border="0" cellpadding="0" cellspacing="0" width="100%"> 
			<tr>
			<td style="padding: 10px 0 30px 0;">
			<table align="center" border="0" cellpadding="0" cellspacing="0" width="600" style="border: 1px solid #cccccc; border-collapse: collapse;">
			<tr>
			<td align="center" bgcolor="#70bbd9" style="padding: 40px 0 30px 0; color: #153643; font-size: 28px; font-weight: bold; font-family: Arial, sans-serif;">
			<img target="_blank" src="'. base_url('assets/img/pengaturan/') . $pengaturan['logo'] .'" alt="Lupa Password" width="300" height="300" style="display: block;" />
			</td>
			</tr>
			<tr>
			<td bgcolor="#ffffff" style="padding: 40px 30px 40px 30px;">
			<table border="0" cellpadding="0" cellspacing="0" width="100%">
			<tr>
			<td style="color: #153643; font-family: Arial, sans-serif; font-size: 24px;">
			<b>Lupa Password</b>
			</td>
			</tr>
			<tr>
			<td style="padding: 20px 0 30px 0; color: #153643; font-family: Arial, sans-serif; font-size: 16px; line-height: 20px;">
			Klik tautan dibawah untuk mengatur ulang password anda!
			</td>
			</tr>
			<tr>
			<td><a href="' . base_url('auth/verify?email='. $email . '&token=' . $token) . '">RESET PASSWORD</a></td>
			</tr>
			</table>
			</td>
			</tr>
			</table>
			</td>
			</tr>
			</table>
			</body>
			</html>';

			$mail->send();

		} catch (Exception $e) {
			echo "Email gagal dikirim. Silahkan Coba Lagi";
			die;
		}
	}

	private function _send_email_pw_siswa($token, $email)
	{
		$pengaturan = $this->db->get('pengaturan')->row_array();

		$mail = new PHPMailer(true);
		try {
		    //Server settings
		    // $mail->SMTPDebug = SMTP::DEBUG_SERVER;                     
			$mail->isSMTP();                                           
			$mail->Host       = $pengaturan['smtp_host'];                   
			$mail->SMTPAuth   = true;                                  
			$mail->Username   = $pengaturan['smtp_email'];                    
			$mail->Password   = $pengaturan['smtp_password'];                        
			$mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;        
			$mail->Port       = 465;                                   

		    //Recipients
			$mail->setFrom('noreply@mail.com', $pengaturan['nama_aplikasi']);
			$mail->addAddress($email);    

		    // Content
			$mail->isHTML(true);  
			$mail->Subject = 'Lupa Password';
			$mail->Body    = '
			<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
			<html xmlns="http://www.w3.org/1999/xhtml">
			<head>
			<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
			<title>Lupa Password</title>
			<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
			</head>
			<body style="margin: 0; padding: 0;">
			<table border="0" cellpadding="0" cellspacing="0" width="100%"> 
			<tr>
			<td style="padding: 10px 0 30px 0;">
			<table align="center" border="0" cellpadding="0" cellspacing="0" width="600" style="border: 1px solid #cccccc; border-collapse: collapse;">
			<tr>
			<td align="center" bgcolor="#70bbd9" style="padding: 40px 0 30px 0; color: #153643; font-size: 28px; font-weight: bold; font-family: Arial, sans-serif;">
			<img target="_blank" src="'. base_url('assets/img/pengaturan/') . $pengaturan['logo'] .'" alt="Lupa Password" width="300" height="300" style="display: block;" />
			</td>
			</tr>
			<tr>
			<td bgcolor="#ffffff" style="padding: 40px 30px 40px 30px;">
			<table border="0" cellpadding="0" cellspacing="0" width="100%">
			<tr>
			<td style="color: #153643; font-family: Arial, sans-serif; font-size: 24px;">
			<b>Lupa Password</b>
			</td>
			</tr>
			<tr>
			<td style="padding: 20px 0 30px 0; color: #153643; font-family: Arial, sans-serif; font-size: 16px; line-height: 20px;">
			Klik tautan dibawah untuk mengatur ulang password anda!
			</td>
			</tr>
			<tr>
			<td><a href="' . base_url('auth/verify_password_siswa?email='. $email . '&token=' . $token) . '">RESET PASSWORD</a></td>
			</tr>
			</table>
			</td>
			</tr>
			</table>
			</td>
			</tr>
			</table>
			</body>
			</html>';

			$mail->send();

		} catch (Exception $e) {
			// echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
			echo "Email gagal dikirim. Silahkan Coba Lagi";
			die;
		}
	}

	public function lupa_password()
	{
		$this->form_validation->set_rules('email', 'email', 'required');

		if ($this->form_validation->run()) {

			$user = $this->db->get_where('user', ['email' => $this->input->post('email')])->row_array();

			if ($user) {

				$token = acak(32);

				$token_user = [
					'id_user' => $user['id_user'],
					'token' => $token
				];

				$this->db->insert('token_user', $token_user);

				$this->_send_email($token, $user['email']);

				$this->session->set_flashdata('message', 'Periksa email anda untuk mengatur ulang password anda');
				redirect('login','refresh');
			}else{
				$this->session->set_flashdata('error', 'Email tidak ditemukan!');
				redirect('auth/lupa_password','refresh');
			}

		}

		$this->load->view('auth/lupa_password');
	}

	public function lupa_password_siswa()
	{
		$this->form_validation->set_rules('email', 'email', 'required');

		if ($this->form_validation->run()) {

			$siswa = $this->db->get_where('siswa', ['email' => $this->input->post('email')])->row_array();

			if ($siswa) {

				$token = acak(32);

				$token_siswa = [
					'id_siswa' => $siswa['id_siswa'],
					'token' => $token
				];

				$this->db->insert('token_siswa', $token_siswa);

				$this->_send_email_pw_siswa($token, $siswa['email']);

				$this->session->set_flashdata('message', 'Periksa email anda untuk mengatur ulang password anda');
				redirect('login','refresh');
			}else{
				$this->session->set_flashdata('error', 'Email tidak ditemukan!');
				redirect('auth/lupa_password','refresh');
			}

		}

		$this->load->view('auth/lupa_password_siswa');
	}

	public function verify()
	{
		$email = $this->input->get('email');
		$token = $this->input->get('token');

		$user = $this->db->get_where('user', ['email' => $email])->row_array();

		if ($user) {
			$token_user = $this->db->get_where('token_user', ['token' => $token])->row_array();
			if ($token_user) {
				$this->session->set_userdata('reset_email', $email);
				$this->changePassword();
			} else {
				$this->session->set_flashdata('error', 'Lupa Password Gagal, Token Salah');
				redirect('auth');
			}
		} else {
			$this->session->set_flashdata('error', 'Lupa Password Gagal, Email Tidak Ditemukan');
			redirect('auth');
		}
	}

	public function verify_password_siswa()
	{
		$email = $this->input->get('email');
		$token = $this->input->get('token');

		$siswa = $this->db->get_where('siswa', ['email' => $email])->row_array();

		if ($siswa) {
			$token_siswa = $this->db->get_where('token_siswa', ['token' => $token])->row_array();
			if ($token_siswa) {
				$this->session->set_userdata('reset_email', $email);
				$this->changePasswordSiswa();
			} else {
				$this->session->set_flashdata('error', 'Lupa Password Gagal, Token Salah');
				redirect('auth');
			}
		} else {
			$this->session->set_flashdata('error', 'Lupa Password Gagal, Email Tidak Ditemukan');
			redirect('auth');
		}
	}

	public function verify_siswa()
	{
		$email = $this->input->get('email');
		$token = $this->input->get('token');

		$siswa = $this->db->get_where('siswa', ['email' => $email])->row_array();

		if ($siswa) {
			$token_siswa = $this->db->get_where('token_siswa', ['token' => $token])->row_array();
			if ($token_siswa) {

				$this->db->set('aktif', 1);
				$this->db->where('id_siswa', $siswa['id_siswa']);
				$this->db->update('siswa');

				$this->session->set_flashdata('success', 'Aktivasi berhasil');
				redirect('login_siswa');
			} else {
				$this->session->set_flashdata('error', 'Lupa Password Gagal, Token Salah');
				redirect('login_siswa');
			}
		} else {
			$this->session->set_flashdata('error', 'Lupa Password Gagal, Email Tidak Ditemukan');
			redirect('login_siswa');
		}
	}

	public function changePassword()
	{
		if (!$this->session->userdata('reset_email')) {
			redirect('auth');
		}

		$this->form_validation->set_rules('pw1', 'Password Baru', 'trim|required|matches[pw2]');
		$this->form_validation->set_rules('pw2', 'Konfirmasi Password', 'trim|required|matches[pw1]');

		if ($this->form_validation->run() == false) {
			$this->load->view('reset_password');
		} else {
			$password = password_hash($this->input->post('pw1'), PASSWORD_DEFAULT);
			$email = $this->session->userdata('reset_email');

			$user = $this->db->get('user', ['email' => $email])->row_array();

			$this->db->set('password', $password);
			$this->db->where('email', $email);
			$this->db->update('user');

			$this->session->unset_userdata('reset_email');

			$this->db->delete('token_user', ['id_user' => $user['id_user']]);

			$this->session->set_flashdata('message', 'Password berhasil diubah, silahkan login kembali');
			redirect('auth');
		}
	}

	public function changePasswordSiswa()
	{
		if (!$this->session->userdata('reset_email')) {
			show_404();
		}

		$this->form_validation->set_rules('pw1', 'Password Baru', 'trim|required|matches[pw2]');
		$this->form_validation->set_rules('pw2', 'Konfirmasi Password', 'trim|required|matches[pw1]');

		if ($this->form_validation->run() == false) {
			$this->load->view('reset_password');
		} else {
			$password = password_hash($this->input->post('pw1'), PASSWORD_DEFAULT);
			$email = $this->session->userdata('reset_email');

			$siswa = $this->db->get('siswa', ['email' => $email])->row_array();

			$this->db->set('password', $password);
			$this->db->where('email', $email);
			$this->db->update('siswa');

			$this->session->unset_userdata('reset_email');

			$this->db->delete('token_siswa', ['id_siswa' => $siswa['id_user']]);

			$this->session->set_flashdata('message', 'Password berhasil diubah, silahkan login kembali');
			redirect('auth/siswa');
		}
	}
}

/* End of file Auth.php */
/* Location: ./application/modules/auth/controllers/Auth.php */ ?>
