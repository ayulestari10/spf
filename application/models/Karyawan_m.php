<?php defined('BASEPATH') || exit('No direct script allowed');

class Karyawan_m extends MY_Model
{
	public function __construct()
	{
		parent::__construct();
		$this->data['table_name']  = 'karyawan';
		$this->data['primary_key'] = 'id_karyawan';
	}

	public function check_login($username, $password)
	{
		$result = $this->get_row(['username' => $username, 'password' => $password]);
		if (!isset($result))
			return $result;
		$this->session->set_userdata([
			'username'		=> $result->username,
			'id_departemen'	=> $result->id_departemen,
			'id_jabatan'	=> $result->id_jabatan
		]);
		return $result;
	}
}

