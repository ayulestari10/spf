<?php defined('BASEPATH') || exit('No direct script allowed');

class Bobot_gap_m extends MY_Model
{
	public function __construct()
	{
		parent::__construct();
		$this->data['table_name']  = 'bobot_gap';
		$this->data['primary_key'] = 'id_bobot';
	}
}

