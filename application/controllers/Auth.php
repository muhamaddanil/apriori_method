<?php defined('BASEPATH') or exit('No direct script access allowed');
class Auth extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->model('m_auth');
		$this->load->library('session');
	}

	public function index()
	{
		$this->load->view('_template/landing_page');
	}

	public function login()
	{
		$this->load->view('_template/login');
	}

	public function validate()
	{
		if ($_POST) {
			$result           = $this->m_auth->validate(str_replace(' ', '', $this->db->escape_str($this->input->post('username'))));
			if (!!($result)) {
				if (md5($this->input->post('password')) ==  $result[0]->password) {

					// SESSION DATA
					$data = array(
						'id_pengguna'         => $result[0]->id_pengguna,
						'username'       => $result[0]->username,
						'nama_lengkap'   => $result[0]->nama_lengkap,
						'id_grup'      	=> $result[0]->id_grup,
						'nama_grup'      	=> $result[0]->nama_grup,
						'sess_rowpage'    => 5,
						'IsAuthorized'    => true
					);

					$this->session->set_userdata($data);

					redirect('Home_page');
				} else {
					// ALERT
					$alert = 'Username atau Password salah!';
					get_instance()->session->set_flashdata('alert', $alert);
					$this->load->view('_template/login');
				}
			} else {
				// ALERT
				$alert = 'Akun tidak valid!';
				get_instance()->session->set_flashdata('alert', $alert);
				$this->load->view('_template/login');
			}
		}
	}


	public function logout()
	{
		$this->session->sess_destroy();
		redirect('auth');
	}
}
