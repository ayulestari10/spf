<?php defined('BASEPATH') || exit('No direct script allowed');

class Nilai_m extends MY_Model
{
	public function __construct()
	{
		parent::__construct();
		$this->data['table_name']  = 'nilai';
		$this->data['primary_key'] = 'id_nilai';
	}
}

