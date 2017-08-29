<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 *
 */
class Karyawan extends MY_Controller
{

	private $data = [];

  	function __construct()
	{
	    parent::__construct();		
		// $this->data['username'] = $this->session->userdata('username');
		// if (!isset($this->data['username']))
		// {
		// 	redirect('login');
		// 	exit;
		// }
		
		// $this->data['id_role'] = $this->session->userdata('id_role');
		// if (!isset($this->data['id_role']) && $this->data['id_role'] != 4)
		// {
		// 	$this->session->unset_userdata('username');
		// 	$this->session->unset_userdata('id_role');
		// 	redirect('login');
		// 	exit;
		// }

		$this->load->model('Hasil_penilaian_m');
		$this->load->model('Karyawan_m');
  	}

  	public function index()
  	{
	    $this->data['title'] 	= 'Dashboard Karyawan';
	    $this->data['content']	= 'karyawan/dashboard';
	    $this->data['karyawan']	= $this->Karyawan_m->get();
	    $this->data['hasil_penelitian']	= $this->Hasil_penilaian_m->get();
	    $this->template($this->data);
	}

	public function data_karyawan()
	{
		if ($this->POST('get') && $this->POST('id_karyawan'))
		{
			$this->data['karyawan'] = $this->Karyawan_m->get_row(['id_karyawan' => $this->POST('id_karyawan')]);
			echo json_encode($this->data['karyawan']);
			exit;
		}
				
		$this->data['data']		= $this->Karyawan_m->get();
		$this->data['columns']	= ["id_karyawan","id_departemen","id_jabatan","NIK","nama","tempat_lahir","tgl_lahir","jenis_kelamin","agama","alamat","pendidikan",];
		$this->data['title'] 	= 'Data Karyawan';
		$this->data['content'] 	= 'karyawan/karyawan_all';
		$this->template($this->data);
	}


	public function detail_karyawan()
	{
		$this->data['id_karyawan'] = $this->uri->segment(3);
		if (!isset($this->data['id_karyawan']))
		{
			redirect('admin/karyawan');
			exit;
		}

		$this->data['columns']	= ["id_karyawan","id_departemen","id_jabatan","NIK","nama","tempat_lahir","tgl_lahir","jenis_kelamin","agama","alamat","pendidikan",];
		$this->data['data'] = $this->Karyawan_m->get_row(['id_karyawan' => $this->data['id_karyawan']]);
		$this->data['title'] 	= 'Detail Karyawan';
		$this->data['content'] 	= 'karyawan/karyawan_detail';
		$this->template($this->data);
	}

	public function hasil_penilaian()
  	{
  		if ($this->POST('get') && $this->POST('id_hasil'))
		{
			$this->data['hasil_penilaian'] = $this->Hasil_penilaian_m->get_row(['id_hasil' => $this->POST('id_hasil')]);
			echo json_encode($this->data['hasil_penilaian']);
			exit;
		}

	    $this->data['title'] 	= 'Hasil Penilaian';
	    $this->data['content']	= 'karyawan/hasil_penilaian';
	    $this->data['data']		= $this->Hasil_penilaian_m->get();
		$this->data['columns']	= ["id_hasil","id_penilaian","gap","bobot_nilai","core_factor","secondary_factor","total_nilai","hasil_akhir",];
	    $this->template($this->data);
	}

	public function detail_hasil_penilaian()
	{
		$this->data['id_hasil'] = $this->uri->segment(3);
		if (!isset($this->data['id_hasil']))
		{
			redirect('admin/hasil_penilaian');
			exit;
		}

		$this->data['columns']	= ["id_hasil","id_penilaian","gap","bobot_nilai","core_factor","secondary_factor","total_nilai","hasil_akhir",];
		$this->data['data'] = $this->Hasil_penilaian_m->get_row(['id_hasil' => $this->data['id_hasil']]);
		$this->data['title'] 	= 'Detail Hasil Penelitian';
		$this->data['content'] 	= 'admin/hasil_penilaian_detail';
		$this->template($this->data);
	}
}