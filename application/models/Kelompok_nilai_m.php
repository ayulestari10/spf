<?php defined('BASEPATH') || exit('No direct script allowed');

class Kelompok_nilai_m extends MY_Model
{
	public function __construct()
	{
		parent::__construct();
		$this->data['table_name']  = 'kelompok_nilai';
		$this->data['primary_key'] = 'id_kelompok_nilai';
	}
}

