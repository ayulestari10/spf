<?php defined('BASEPATH') || exit('No direct script allowed');

class Admin_m extends MY_Model
{
	public function __construct()
	{
		parent::__construct();
		$this->data['table_name']  = 'admin';
		$this->data['primary_key'] = 'id_admin';
	}

	public function check_login($username, $password)
	{
		$result = $this->get_row(['username' => $username, 'password' => $password]);
		if (!isset($result))
			return $result;
		$this->session->set_userdata([
			'username'		=> $result->username,
			'admin'			=> true
		]);
		return $result;
	}
}

