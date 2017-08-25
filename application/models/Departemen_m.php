<?php defined('BASEPATH') || exit('No direct script allowed');

class Departemen_m extends MY_Model
{
	public function __construct()
	{
		parent::__construct();
		$this->data['table_name']  = 'departemen';
		$this->data['primary_key'] = 'id_departemen';
	}
}

