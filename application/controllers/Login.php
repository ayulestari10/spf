<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 *
 */
class Login extends MY_Controller
{

	private $data = [];

  function __construct()
  {
    parent::__construct();
    $id_departemen 	= $this->session->userdata('id_departemen');
    $id_jabatan		= $this->session->userdata('id_jabatan');
		if (isset($id_departemen,$id_jabatan))
		{
			if($id_departemen == 2 && $id_jabatan == 3)
			{
				redirect('manajer');
			}
			elseif($id_departemen == 1 && $id_jabatan == 2)
			{
				redirect('admin');
			}
			else
			{
				redirect('login');
				$this->flashmsg('Akun anda tidak terdaftar','danger');
			}

			exit;
		}
     $this->load->model('Karyawan_m');
  }

  public function index()
  {
    if ($this->POST('login-submit'))
	{

	    if (!$this->Karyawan_m->required_input(['username','password'])) {
	        $this->flashmsg('Data harus lengkap','warning');
	        redirect('login');
	    }

		$data = [
			'username'	=> $this->POST('username'),
			'password'	=> md5($this->POST('password'))
		];

		$result = $this->Karyawan_m->check_login($data['username'], $data['password']);
				
	    if (!isset($result)) {
	        $this->flashmsg('Username atau password salah','danger');
	    }

		redirect('login');
		exit;
	}
    $this->data['title'] = 'LOGIN'.$this->title;
    $this->load->view('login',$this->data);
  }
}
