<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 *
 */
class Login extends MY_Controller
{

	private $data = [];


	public function __construct()
	{
		parent::__construct();
		$this->data['username'] = $this->session->userdata('username');
		if (isset($this->data['username']))
		{
			$this->data['id_departemen'] 	= $this->session->userdata('id_departemen');
			$this->data['id_jabatan']		= $this->session->userdata('id_jabatan');
			$this->data['admin']			= $this->session->userdata('admin');

			if (isset($this->data['id_departemen'], $this->data['id_jabatan']))
			{
				if ($this->data['id_jabatan'] == 2)
				{
					redirect('manajer');
				}
				else if ($this->data['id_jabatan'] == 4)
				{
					redirect('direktur');
				}
				else
				{
					redirect('karyawan');
				}
				exit;
			}

			if (isset($this->data['admin']))
			{
				redirect('admin');
			}
		}
	}

 

	public function index()
	{
		if ($this->POST('login-submit'))
		{
			$this->load->model('Karyawan_m');
			if (!$this->Karyawan_m->required_input(['username','password'])) 
			{
				$this->flashmsg('Data harus lengkap','warning');
				redirect('login');
				exit;
			}

			$data = [
				'username'	=> $this->POST('username'),
				'password'	=> md5($this->POST('password'))
			];

			$result = $this->Karyawan_m->check_login($data['username'], $data['password']);

			if (!isset($result))
			{
				$this->load->model('admin_m');
				$result = $this->admin_m->check_login($data['username'], $data['password']);
			}

			if (!isset($result)) 
			{
				$this->flashmsg('Username atau password salah','danger');
			}

			redirect('login');
			exit;
		}
		$this->data['title'] = 'LOGIN'.$this->title;
		$this->load->view('login',$this->data);
	}
}
