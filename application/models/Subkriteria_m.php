<?php defined('BASEPATH') || exit('No direct script allowed');

class Subkriteria_m extends MY_Model
{
	public function __construct()
	{
		parent::__construct();
		$this->data['table_name']  = 'subkriteria';
		$this->data['primary_key'] = 'id_subkriteria';
	}
}

