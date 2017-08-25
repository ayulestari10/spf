<?php defined('BASEPATH') || exit('No direct script allowed');

class Hasil_penilaian_m extends MY_Model
{
	public function __construct()
	{
		parent::__construct();
		$this->data['table_name']  = 'hasil_penilaian';
		$this->data['primary_key'] = 'id_hasil';
	}
}

