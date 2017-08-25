<?php defined('BASEPATH') || exit('No direct script allowed');

class Acc_penilaian_m extends MY_Model
{
	public function __construct()
	{
		parent::__construct();
		$this->data['table_name']  = 'acc_penilaian';
		$this->data['primary_key'] = 'id_hasil';
	}
}

