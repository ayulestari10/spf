<?php defined('BASEPATH') || exit('No direct script allowed');

class Karyawan_m extends MY_Model
{
	public function __construct()
	{
		parent::__construct();
		$this->data['table_name']  = 'karyawan';
		$this->data['primary_key'] = 'id_karyawan';
	}
}

