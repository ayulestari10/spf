<?php defined('BASEPATH') || exit('No direct script allowed');

class Hasil_penilaian_m extends MY_Model
{
	public function __construct()
	{
		parent::__construct();
		$this->data['table_name']  = 'hasil_penilaian';
		$this->data['primary_key'] = 'id_hasil';
	}

	public function get_rank($id_penilaian)
	{
		$this->db->query('SET @rank:=0;');
		$query = $this->db->query('SELECT * FROM (SELECT *, @rank := @rank + 1 AS rank FROM hasil_penilaian WHERE id_penilaian=' . $id_penilaian . ' ORDER BY hasil_akhir DESC) x');
		return $query->result();
	}
}

