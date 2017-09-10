<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 *
 */
class Admin extends MY_Controller
{

	private $data = [];

  	function __construct()
	{
	    parent::__construct();		
		$this->data['id_departemen'] 	= $this->session->userdata('id_departemen');
		$this->data['id_jabatan']		= $this->session->userdata('id_jabatan');

		if ($this->data['id_departemen'] != 1 && $this->data['id_jabatan'] != 2)
		{
			redirect('logout');
			$this->flashmsg('Anda tidak diizinkan untuk mengakses halaman ini','danger');
			exit;
		}
		$this->data['username'] = $this->session->userdata('username');

		$this->load->model('Jabatan_m');
		$this->load->model('Departemen_m');
		$this->load->model('Karyawan_m');
		$this->load->model('Kriteria_m');
		$this->load->model('Penilaian_m');
		$this->load->model('Subkriteria_m');
  	}

  	public function index()
  	{
	    $this->data['title'] 	= 'Dashboard Admin';
	    $this->data['content']	= 'admin/dashboard';
	    $this->data['karyawan']	= $this->Karyawan_m->get();
	    $this->data['departemen']	= $this->Departemen_m->get();
	    $this->data['kriteria']	= $this->Kriteria_m->get();
	    $this->data['subkriteria']	= $this->Subkriteria_m->get();
	    $this->data['jabatan']	= $this->Jabatan_m->get();
	    $this->template($this->data);
	}
  
  	public function jabatan()
	{
		if ($this->POST('insert'))
		{
			$this->data['entry'] = [
				"id_jabatan" => $this->POST("id_jabatan"),
				"id_departemen" => $this->POST("id_departemen"),
				"nama" => $this->POST("nama"),
			];
			$this->Jabatan_m->insert($this->data['entry']);
			redirect('admin/jabatan');
			exit;
		}
		
		if ($this->POST('delete') && $this->POST('id_jabatan'))
		{
			$this->Jabatan_m->delete($this->POST('id_jabatan'));
			exit;
		}
				
		if ($this->POST('edit') && $this->POST('edit_id_jabatan'))
		{
			$this->data['entry'] = [
				"id_jabatan" => $this->POST("id_jabatan"),
				"id_departemen" => $this->POST("id_departemen"),
				"nama" => $this->POST("nama"),
			];
			$this->Jabatan_m->update($this->POST('edit_id_jabatan'), $this->data['entry']);
			redirect('admin/jabatan');
			exit;
		}

		if ($this->POST('get') && $this->POST('id_jabatan'))
		{
			$this->data['jabatan'] = $this->Jabatan_m->get_row(['id_jabatan' => $this->POST('id_jabatan')]);
			echo json_encode($this->data['jabatan']);
			exit;
		}
				
		$this->data['data']		= $this->Jabatan_m->get();
		$this->data['columns']	= ["id_jabatan","id_departemen","nama",];
		$this->data['title'] 	= 'Title';
		$this->data['content'] 	= 'admin/jabatan_all';
		$this->template($this->data);
	}


	public function detail_jabatan()
	{
		$this->data['id_jabatan'] = $this->uri->segment(3);
		if (!isset($this->data['id_jabatan']))
		{
			redirect('admin/jabatan');
			exit;
		}

		$this->data['columns']	= ["id_jabatan","id_departemen","nama",];
		$this->data['data'] = $this->Jabatan_m->get_row(['id_jabatan' => $this->data['id_jabatan']]);
		$this->data['title'] 	= 'Title';
		$this->data['content'] 	= 'admin/jabatan_detail';
		$this->template($this->data);
	}

	public function departemen()
	{
		if ($this->POST('insert'))
		{
			$this->data['entry'] = [
				"id_departemen" => $this->POST("id_departemen"),
				"nama" => $this->POST("nama"),
			];
			$this->Departemen_m->insert($this->data['entry']);
			redirect('admin/departemen');
			exit;
		}
		
		if ($this->POST('delete') && $this->POST('id_departemen'))
		{
			$this->Departemen_m->delete($this->POST('id_departemen'));
			exit;
		}
				
		if ($this->POST('edit') && $this->POST('edit_id_departemen'))
		{
			$this->data['entry'] = [
				"id_departemen" => $this->POST("id_departemen"),
				"nama" => $this->POST("nama"),
			];
			$this->Departemen_m->update($this->POST('edit_id_departemen'), $this->data['entry']);
			redirect('admin/departemen');
			exit;
		}

		if ($this->POST('get') && $this->POST('id_departemen'))
		{
			$this->data['departemen'] = $this->Departemen_m->get_row(['id_departemen' => $this->POST('id_departemen')]);
			echo json_encode($this->data['departemen']);
			exit;
		}
				
		$this->data['data']		= $this->Departemen_m->get();
		$this->data['columns']	= ["id_departemen","nama",];
		$this->data['title'] 	= 'Title';
		$this->data['content'] 	= 'admin/departemen_all';
		$this->template($this->data);
	}


	public function detail_departemen()
	{
		$this->data['id_departemen'] = $this->uri->segment(3);
		if (!isset($this->data['id_departemen']))
		{
			redirect('admin/departemen');
			exit;
		}

		$this->data['columns']	= ["id_departemen","nama",];
		$this->data['data'] = $this->Departemen_m->get_row(['id_departemen' => $this->data['id_departemen']]);
		$this->data['title'] 	= 'Title';
		$this->data['content'] 	= 'admin/departemen_detail';
		$this->template($this->data);
	}

	public function karyawan()
	{
		if ($this->POST('insert'))
		{
			$this->data['entry'] = [
				"id_karyawan" => $this->POST("id_karyawan"),
				"id_departemen" => $this->POST("id_departemen"),
				"id_jabatan" => $this->POST("id_jabatan"),
				"username" => $this->POST("username"),
				"password" => $this->POST("password"),
				"NIK" => $this->POST("NIK"),
				"nama" => $this->POST("nama"),
				"tempat_lahir" => $this->POST("tempat_lahir"),
				"tgl_lahir" => $this->POST("tgl_lahir"),
				"jenis_kelamin" => $this->POST("jenis_kelamin"),
				"agama" => $this->POST("agama"),
				"alamat" => $this->POST("alamat"),
				"pendidikan" => $this->POST("pendidikan"),
			];
			$this->Karyawan_m->insert($this->data['entry']);
			redirect('admin/karyawan');
			exit;
		}
		
		if ($this->POST('delete') && $this->POST('id_karyawan'))
		{
			$this->Karyawan_m->delete($this->POST('id_karyawan'));
			exit;
		}
				
		if ($this->POST('edit') && $this->POST('edit_id_karyawan'))
		{
			$this->data['entry'] = [
				"id_karyawan" => $this->POST("id_karyawan"),
				"id_departemen" => $this->POST("id_departemen"),
				"id_jabatan" => $this->POST("id_jabatan"),
				"username" => $this->POST("username"),
				"password" => $this->POST("password"),
				"NIK" => $this->POST("NIK"),
				"nama" => $this->POST("nama"),
				"tempat_lahir" => $this->POST("tempat_lahir"),
				"tgl_lahir" => $this->POST("tgl_lahir"),
				"jenis_kelamin" => $this->POST("jenis_kelamin"),
				"agama" => $this->POST("agama"),
				"alamat" => $this->POST("alamat"),
				"pendidikan" => $this->POST("pendidikan"),
			];
			$this->Karyawan_m->update($this->POST('edit_id_karyawan'), $this->data['entry']);
			redirect('admin/karyawan');
			exit;
		}

		if ($this->POST('get') && $this->POST('id_karyawan'))
		{
			$this->data['karyawan'] = $this->Karyawan_m->get_row(['id_karyawan' => $this->POST('id_karyawan')]);
			echo json_encode($this->data['karyawan']);
			exit;
		}
				
		$this->data['data']		= $this->Karyawan_m->get();
		$this->data['columns']	= ["id_karyawan","id_departemen","id_jabatan","username","password","NIK","nama","tempat_lahir","tgl_lahir","jenis_kelamin","agama","alamat","pendidikan",];
		$this->data['title'] 	= 'Title';
		$this->data['content'] 	= 'admin/karyawan_all';
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

		$this->data['columns']	= ["id_karyawan","id_departemen","id_jabatan","username","password","NIK","nama","tempat_lahir","tgl_lahir","jenis_kelamin","agama","alamat","pendidikan",];
		$this->data['data'] = $this->Karyawan_m->get_row(['id_karyawan' => $this->data['id_karyawan']]);
		$this->data['title'] 	= 'Title';
		$this->data['content'] 	= 'admin/karyawan_detail';
		$this->template($this->data);
	}

	public function kriteria()
	{
		if ($this->POST('insert'))
		{
			$this->data['entry'] = [
				"id_kriteria" => $this->POST("id_kriteria"),
				"id_subkriteria" => $this->POST("id_subkriteria"),
				"kompetensi_inti" => $this->POST("kompetensi_inti"),
				"kompetensi_peran" => $this->POST("kompetensi_peran"),
				"kompetensi_fungsional" => $this->POST("kompetensi_fungsional"),
			];
			$this->Kriteria_m->insert($this->data['entry']);
			redirect('admin/kriteria');
			exit;
		}
		
		if ($this->POST('delete') && $this->POST('id_kriteria'))
		{
			$this->Kriteria_m->delete($this->POST('id_kriteria'));
			exit;
		}
				
		if ($this->POST('edit') && $this->POST('edit_id_kriteria'))
		{
			$this->data['entry'] = [
				"id_kriteria" => $this->POST("id_kriteria"),
				"id_subkriteria" => $this->POST("id_subkriteria"),
				"kompetensi_inti" => $this->POST("kompetensi_inti"),
				"kompetensi_peran" => $this->POST("kompetensi_peran"),
				"kompetensi_fungsional" => $this->POST("kompetensi_fungsional"),
			];
			$this->Kriteria_m->update($this->POST('edit_id_kriteria'), $this->data['entry']);
			redirect('admin/kriteria');
			exit;
		}

		if ($this->POST('get') && $this->POST('id_kriteria'))
		{
			$this->data['kriteria'] = $this->Kriteria_m->get_row(['id_kriteria' => $this->POST('id_kriteria')]);
			echo json_encode($this->data['kriteria']);
			exit;
		}
				
		$this->data['data']		= $this->Kriteria_m->get();
		$this->data['columns']	= ["id_kriteria","id_subkriteria","kompetensi_inti","kompetensi_peran","kompetensi_fungsional",];
		$this->data['title'] 	= 'Kriteria';
		$this->data['content'] 	= 'admin/kriteria_all';
		$this->template($this->data);
	}


	public function detail_kriteria()
	{
		$this->data['id_kriteria'] = $this->uri->segment(3);
		if (!isset($this->data['id_kriteria']))
		{
			redirect('admin/kriteria');
			exit;
		}

		$this->data['columns']	= ["id_kriteria","id_subkriteria","kompetensi_inti","kompetensi_peran","kompetensi_fungsional",];
		$this->data['data'] = $this->Kriteria_m->get_row(['id_kriteria' => $this->data['id_kriteria']]);
		$this->data['title'] 	= 'Detail Kriteria';
		$this->data['content'] 	= 'admin/kriteria_detail';
		$this->template($this->data);
	}

	public function penilaian()
	{
		if ($this->POST('insert'))
		{
			$this->data['entry'] = [
				"id_penilaian" => $this->POST("id_penilaian"),
				"id_karyawan" => $this->POST("id_karyawan"),
				"id_kriteria" => $this->POST("id_kriteria"),
				"id_hasil" => $this->POST("id_hasil"),
				"requirement" => $this->POST("requirement"),
				"penilaian" => $this->POST("penilaian"),
				"tgl_penelitian" => $this->POST("tgl_penelitian"),
				"thn_penelitian" => $this->POST("thn_penelitian"),
			];
			$this->Penilaian_m->insert($this->data['entry']);
			redirect('admin/penilaian');
			exit;
		}
		
		if ($this->POST('delete') && $this->POST('id_penilaian'))
		{
			$this->Penilaian_m->delete($this->POST('id_penilaian'));
			exit;
		}
				
		if ($this->POST('edit') && $this->POST('edit_id_penilaian'))
		{
			$this->data['entry'] = [
				"id_penilaian" => $this->POST("id_penilaian"),
				"id_karyawan" => $this->POST("id_karyawan"),
				"id_kriteria" => $this->POST("id_kriteria"),
				"id_hasil" => $this->POST("id_hasil"),
				"requirement" => $this->POST("requirement"),
				"penilaian" => $this->POST("penilaian"),
				"tgl_penelitian" => $this->POST("tgl_penelitian"),
				"thn_penelitian" => $this->POST("thn_penelitian"),
			];
			$this->Penilaian_m->update($this->POST('edit_id_penilaian'), $this->data['entry']);
			redirect('admin/penilaian');
			exit;
		}

		if ($this->POST('get') && $this->POST('id_penilaian'))
		{
			$this->data['penilaian'] = $this->Penilaian_m->get_row(['id_penilaian' => $this->POST('id_penilaian')]);
			echo json_encode($this->data['penilaian']);
			exit;
		}
				
		$this->data['data']		= $this->Penilaian_m->get();
		$this->data['columns']	= ["id_penilaian","id_karyawan","id_kriteria","id_hasil","requirement","penilaian","tgl_penelitian","thn_penelitian",];
		$this->data['title'] 	= 'Penilaian';
		$this->data['content'] 	= 'admin/penilaian_all';
		$this->template($this->data);
	}


	public function detail_penilaian()
	{
		$this->data['id_penilaian'] = $this->uri->segment(3);
		if (!isset($this->data['id_penilaian']))
		{
			redirect('admin/penilaian');
			exit;
		}

		$this->data['columns']	= ["id_penilaian","id_karyawan","id_kriteria","id_hasil","requirement","penilaian","tgl_penelitian","thn_penelitian",];
		$this->data['data'] = $this->Penilaian_m->get_row(['id_penilaian' => $this->data['id_penilaian']]);
		$this->data['title'] 	= 'Detail Penilaian';
		$this->data['content'] 	= 'admin/penilaian_detail';
		$this->template($this->data);
	}

	public function subkriteria()
	{
		if ($this->POST('insert'))
		{
			$this->data['entry'] = [
				"id_subkriteria" => $this->POST("id_subkriteria"),
				"id_kriteria" => $this->POST("id_kriteria"),
				"id_kelompok_nilai" => $this->POST("id_kelompok_nilai"),
				"nama" => $this->POST("nama"),
				"standar_nilai" => $this->POST("standar_nilai"),
			];
			$this->Subkriteria_m->insert($this->data['entry']);
			redirect('admin/subkriteria');
			exit;
		}
		
		if ($this->POST('delete') && $this->POST('id_subkriteria'))
		{
			$this->Subkriteria_m->delete($this->POST('id_subkriteria'));
			exit;
		}
				
		if ($this->POST('edit') && $this->POST('edit_id_subkriteria'))
		{
			$this->data['entry'] = [
				"id_subkriteria" => $this->POST("id_subkriteria"),
				"id_kriteria" => $this->POST("id_kriteria"),
				"id_kelompok_nilai" => $this->POST("id_kelompok_nilai"),
				"nama" => $this->POST("nama"),
				"standar_nilai" => $this->POST("standar_nilai"),
			];
			$this->Subkriteria_m->update($this->POST('edit_id_subkriteria'), $this->data['entry']);
			redirect('admin/subkriteria');
			exit;
		}

		if ($this->POST('get') && $this->POST('id_subkriteria'))
		{
			$this->data['subkriteria'] = $this->Subkriteria_m->get_row(['id_subkriteria' => $this->POST('id_subkriteria')]);
			echo json_encode($this->data['subkriteria']);
			exit;
		}
				
		$this->data['data']		= $this->Subkriteria_m->get();
		$this->data['columns']	= ["id_subkriteria","id_kriteria","id_kelompok_nilai","nama","standar_nilai",];
		$this->data['title'] 	= 'Title';
		$this->data['content'] 	= 'admin/subkriteria_all';
		$this->template($this->data);
	}


	public function detail_subkriteria()
	{
		$this->data['id_subkriteria'] = $this->uri->segment(3);
		if (!isset($this->data['id_subkriteria']))
		{
			redirect('admin/subkriteria');
			exit;
		}

		$this->data['columns']	= ["id_subkriteria","id_kriteria","id_kelompok_nilai","nama","standar_nilai",];
		$this->data['data'] = $this->Subkriteria_m->get_row(['id_subkriteria' => $this->data['id_subkriteria']]);
		$this->data['title'] 	= 'Title';
		$this->data['content'] 	= 'admin/subkriteria_detail';
		$this->template($this->data);
	}
}
