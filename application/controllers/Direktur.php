<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Direktur extends MY_Controller
{
	public function __construct()
	{
		parent::__construct();

		$this->data['id_departemen'] 	= $this->session->userdata('id_departemen');
		$this->data['id_jabatan']		= $this->session->userdata('id_jabatan');

		if ($this->data['id_jabatan'] != 3)
		{
			redirect('logout');
			$this->flashmsg('Anda tidak diizinkan untuk mengakses halaman ini','danger');
			exit;
		}
		$this->data['username'] = $this->session->userdata('username');
	}

	// daftar penilaian
	public function index()
	{
		$this->load->model('penilaian_m');
		$this->data['penilaian']	= $this->penilaian_m->get_by_order('tgl_penilaian', 'DESC');
		$this->data['title']		= 'Penilaian';
		$this->data['content']		= 'manajer/daftar_penilaian';
		$this->template($this->data);
	}

	public function penilaian_detail()
	{
		$this->data['id_penilaian'] = $this->GET('id_penilaian');
		if (!isset($this->data['id_penilaian']))
		{
			$this->flashmsg('<i class="fa fa-warning"></i> Data penilaian tidak ditemukan', 'danger');
			redirect('manajer/penilaian');
			exit;
		}

		$this->load->model('karyawan_m');
		$this->load->model('departemen_m');
		$this->load->model('jabatan_m');
		$this->load->model('nilai_m');
		$this->load->model('acc_penilaian_m');
		$this->load->model('hasil_penilaian_m');

		if ($this->POST('validasi') && $this->POST('id_karyawan'))
		{
			$check_hasil = $this->hasil_penilaian_m->get_row(['id_penilaian' => $this->data['id_penilaian'], 'id_karyawan' => $this->POST('id_karyawan')]);
			$response['error'] = FALSE;
			if ($check_hasil)
			{
				$check_validasi = $this->acc_penilaian_m->get_row(['id_hasil' => $check_hasil->id_hasil]);
				if ($check_validasi)
				{
					$this->data['entri_acc'] = [
						'validasi_hrd'			=> $this->data['id_departemen'] == 2 && $this->data['id_jabatan'] != 2 ? ($check_validasi->validasi_hrd ? 0 : 1) : $check_validasi->validasi_hrd,
						'validasi_dept_manajer'	=> ($this->data['id_jabatan'] == 2 && $this->data['id_departemen'] == 2) || $this->data['id_jabatan'] == 2 ? ($check_validasi->validasi_dept_manajer ? 0 : 1) : $check_validasi->validasi_dept_manajer,
						'validasi_pimpinan'		=> $this->data['id_jabatan'] == 3 ? ($check_validasi->validasi_pimpinan ? 0 : 1) : $check_validasi->validasi_pimpinan,
						'status_acc'			=> $check_validasi->validasi_hrd && $check_validasi->validasi_dept_manajer && !$check_validasi->validasi_pimpinan ? 'Valid' : 'Tidak valid',
						'tgl_acc'				=> date('Y-m-d')
					];
					$this->acc_penilaian_m->update($check_validasi->id_hasil, $this->data['entri_acc']);
					$state = FALSE;
					if ($this->data['id_departemen'] == 2 && $this->data['id_jabatan'] == 2)
					{
						$state = $this->data['entri_acc']['validasi_dept_manajer'];
					}
					else if ($this->data['id_departemen'] == 2)
					{
						$state = $this->data['entri_acc']['validasi_hrd'];
					}
					else if ($this->data['id_jabatan'] == 2)
					{
						$state = $this->data['entri_acc']['validasi_dept_manajer'];
					}
					else if ($this->data['id_jabatan'] == 3)
					{
						$state = $this->data['entri_acc']['validasi_pimpinan'];
					}
					$response['result'] = '<button class="btn btn-' . ($state ? 'success' : 'danger') . ' btn-sm" onclick="acc_penilaian(' . $this->POST('id_karyawan') . ');"><i class="fa fa-' . ($state ? 'check' : 'times') . '"></i> ' . ($state ? 'Valid' : 'Tidak valid') . '</button>';
				}
				else
				{
					$this->data['entri_acc'] = [
						'id_hasil'				=> $check_hasil->id_hasil,
						'validasi_hrd'			=> 0,
						'validasi_dept_manajer'	=> 0,
						'validasi_pimpinan'		=> 1,
						'status_acc'			=> 'Tidak valid',
						'tgl_acc'				=> date('Y-m-d')
					];
					$this->acc_penilaian_m->insert($this->data['entri_acc']);
					$response['result'] = '<button class="btn btn-success btn-sm" onclick="acc_penilaian(' . $this->POST('id_karyawan') . ');"><i class="fa fa-check"></i> Valid</button>';
				}
			}
			else
			{
				$response['error'] = TRUE;
			}

			echo json_encode($response);
			exit;
		}

		$this->data['karyawan'] = $this->data['id_departemen'] != 2 && $this->data['id_jabatan'] != 3 ? $this->karyawan_m->get(['id_departemen' => $this->data['id_departemen']]) : $this->karyawan_m->get();
		$this->data['title'] 	= 'Data Penilaian';
		$this->data['content'] 	= 'manajer/penilaian';
		$this->template($this->data);
	}

	public function detail_nilai()
	{
		$this->data['id_penilaian'] = $this->GET('id_penilaian');
		$this->data['id_karyawan']	= $this->GET('id_karyawan');

		if (!isset($this->data['id_penilaian'], $this->data['id_karyawan']))
		{
			redirect('direktur');
			exit;
		}

		$this->load->model('karyawan_m');
		$this->load->model('hasil_penilaian_m');
		$this->load->model('acc_penilaian_m');
		$this->load->model('subkriteria_m');
		$this->load->model('nilai_m');
		$this->load->model('penilaian_m');
		$this->load->model('kelompok_nilai_m');
		$this->load->model('kriteria_m');
		$this->load->model('jenis_kriteria_m');
		$this->load->model('gap_analysis_m');

		$this->data['penilaian'] = $this->penilaian_m->get_row(['id_penilaian' => $this->data['id_penilaian']]);
		if (!isset($this->data['penilaian']))
		{
			redirect('direktur');
			exit;
		}

		$this->data['karyawan'] = $this->karyawan_m->get_row(['id_karyawan' => $this->data['id_karyawan']]);
		if (!isset($this->data['karyawan']))
		{
			redirect('direktur');
			exit;
		}

		$this->data['hasil_penilaian'] = $this->hasil_penilaian_m->get_row([
			'id_penilaian'	=> $this->data['id_penilaian'],
			'id_karyawan'	=> $this->data['id_karyawan']
		]);
		if (!isset($this->data['hasil_penilaian']))
		{
			redirect('direktur');
			exit;
		}

		$this->data['title']	= 'Detail Nilai';
		$this->data['content']	= 'karyawan/detail_nilai';
		$this->template($this->data);
	}
}