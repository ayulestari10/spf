<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Karyawan extends MY_Controller
{

	private $data = [];

  	public function __construct()
	{
	    parent::__construct();		
		$this->data['username'] = $this->session->userdata('username');
		if (!isset($this->data['username']))
		{
			redirect('logout');
			exit;
		}
		
		$this->data['id_departemen'] 	= $this->session->userdata('id_departemen');
		$this->data['id_jabatan']		= $this->session->userdata('id_jabatan');

		if ($this->data['id_jabatan'] == 4)
		{
			redirect('direktur');
			exit;
		}

		$this->load->model('Hasil_penilaian_m');
		$this->load->model('Karyawan_m');

		$this->data['user'] = $this->Karyawan_m->get_row(['username' => $this->data['username']]);
		if (!isset($this->data['user']))
		{
			redirect('logout');
			exit;
		}
  	}

  	public function index()
  	{
  		$this->load->model('penilaian_m');
  		$this->load->model('karyawan_m');
	    $this->data['title'] 			= 'Dashboard Karyawan';
	    $this->data['content']			= 'karyawan/dashboard';
	    $this->data['karyawan']			= $this->karyawan_m->get();
	    $this->data['daftar_penilaian']	= $this->penilaian_m->get_by_order('id_penilaian', 'DESC');
	    $this->data['penilaian']		= $this->penilaian_m->get_by_order('tgl_penilaian', 'DESC');
	    $this->template($this->data);
	}

	// public function penilaian()
	// {
	// 	if ($this->data['id_departemen'] != 2)
	// 	{
	// 		redirect('karyawan');
	// 		exit;
	// 	}

	// 	$this->load->model('penilaian_m');
	// 	$this->data['penilaian']	= $this->penilaian_m->get_by_order('tgl_penilaian', 'DESC');
	// 	$this->data['title']		= 'Penilaian';
	// 	$this->data['content']		= 'karyawan/penilaian';
	// 	$this->template($this->data);
	// }

	// public function penilaian_detail()
	// {
	// 	if ($this->data['id_departemen'] != 2)
	// 	{
	// 		redirect('karyawan');
	// 		exit;
	// 	}

	// 	$this->data['id_penilaian'] = $this->GET('id_penilaian');
	// 	if (!isset($this->data['id_penilaian']))
	// 	{
	// 		$this->flashmsg('<i class="fa fa-warning"></i> Data penilaian tidak ditemukan', 'danger');
	// 		redirect('manajer/penilaian');
	// 		exit;
	// 	}

	// 	$this->load->model('karyawan_m');
	// 	$this->load->model('departemen_m');
	// 	$this->load->model('jabatan_m');
	// 	$this->load->model('nilai_m');
	// 	$this->load->model('acc_penilaian_m');
	// 	$this->load->model('hasil_penilaian_m');

	// 	if ($this->POST('validasi') && $this->POST('id_karyawan'))
	// 	{
	// 		$check_hasil = $this->hasil_penilaian_m->get_row(['id_penilaian' => $this->data['id_penilaian'], 'id_karyawan' => $this->POST('id_karyawan')]);
	// 		$response['error'] = FALSE;
	// 		if ($check_hasil)
	// 		{
	// 			$check_validasi = $this->acc_penilaian_m->get_row(['id_hasil' => $check_hasil->id_hasil]);
	// 			if ($check_validasi)
	// 			{
	// 				$this->data['entri_acc'] = [
	// 					'validasi_hrd'			=> $this->data['id_departemen'] == 2 && $this->data['id_jabatan'] != 2 ? ($check_validasi->validasi_hrd ? 0 : 1) : $check_validasi->validasi_hrd,
	// 					'validasi_dept_manajer'	=> ($this->data['id_jabatan'] == 2 && $this->data['id_departemen'] == 2) || $this->data['id_jabatan'] == 2 ? ($check_validasi->validasi_dept_manajer ? 0 : 1) : $check_validasi->validasi_dept_manajer,
	// 					'validasi_pimpinan'		=> $check_validasi->validasi_pimpinan,
	// 					'status_acc'			=> !$check_validasi->validasi_hrd && $check_validasi->validasi_dept_manajer && $check_validasi->validasi_pimpinan ? 'Valid' : 'Tidak valid',
	// 					'tgl_acc'				=> date('Y-m-d')
	// 				];
	// 				if ($this->data['entri_acc']['validasi_pimpinan'] && $this->data['entri_acc']['validasi_hrd'] && $this->data['entri_acc']['validasi_dept_manajer'])
	// 				{
	// 					$this->data['entri_acc']['status_acc'] = 'Valid'; 
	// 				}
	// 				else
	// 				{
	// 					$this->data['entri_acc']['status_acc'] = 'Tidak valid';	
	// 				}
	// 				$this->acc_penilaian_m->update($check_validasi->id_hasil, $this->data['entri_acc']);
	// 				$state = FALSE;
	// 				if ($this->data['id_departemen'] == 2 && $this->data['id_jabatan'] == 2)
	// 				{
	// 					$state = $this->data['entri_acc']['validasi_dept_manajer'];
	// 				}
	// 				else if ($this->data['id_departemen'] == 2)
	// 				{
	// 					$state = $this->data['entri_acc']['validasi_hrd'];
	// 				}
	// 				else if ($this->data['id_jabatan'] == 2)
	// 				{
	// 					$state = $this->data['entri_acc']['validasi_dept_manajer'];
	// 				}
	// 				$response['result'] = '<button class="btn btn-' . ($state ? 'success' : 'danger') . ' btn-sm" onclick="acc_penilaian(' . $this->POST('id_karyawan') . ');"><i class="fa fa-' . ($state ? 'check' : 'times') . '"></i> ' . ($state ? 'Valid' : 'Tidak valid') . '</button>';
	// 			}
	// 			else
	// 			{
	// 				$this->data['entri_acc'] = [
	// 					'id_hasil'				=> $check_hasil->id_hasil,
	// 					'validasi_hrd'			=> 1,
	// 					'validasi_dept_manajer'	=> 0,
	// 					'validasi_pimpinan'		=> 0,
	// 					'status_acc'			=> 'Tidak valid',
	// 					'tgl_acc'				=> date('Y-m-d')
	// 				];
	// 				$this->acc_penilaian_m->insert($this->data['entri_acc']);
	// 				$response['result'] = '<button class="btn btn-success btn-sm" onclick="acc_penilaian(' . $this->POST('id_karyawan') . ');"><i class="fa fa-check"></i> Valid</button>';
	// 			}
	// 		}
	// 		else
	// 		{
	// 			$response['error'] = TRUE;
	// 		}

	// 		echo json_encode($response);
	// 		exit;
	// 	}

	// 	$this->data['karyawan'] = $this->karyawan_m->get('id_karyawan != ' . $this->data['user']->id_karyawan . ' AND (id_jabatan = 1 OR id_jabatan = 3)');
	// 	$this->data['title'] 	= 'Data Penilaian';
	// 	$this->data['content'] 	= 'karyawan/penilaian_detail';
	// 	$this->template($this->data);
	// }

	// public function detail_nilai()
	// {
	// 	if ($this->data['id_departemen'] != 2)
	// 	{
	// 		redirect('karyawan');
	// 		exit;
	// 	}

	// 	$this->data['id_penilaian'] = $this->GET('id_penilaian');
	// 	$this->data['id_karyawan']	= $this->GET('id_karyawan');

	// 	if (!isset($this->data['id_penilaian'], $this->data['id_karyawan']))
	// 	{
	// 		redirect('direktur');
	// 		exit;
	// 	}

	// 	$this->load->model('karyawan_m');
	// 	$this->load->model('hasil_penilaian_m');
	// 	$this->load->model('acc_penilaian_m');
	// 	$this->load->model('subkriteria_m');
	// 	$this->load->model('nilai_m');
	// 	$this->load->model('penilaian_m');
	// 	$this->load->model('kelompok_nilai_m');
	// 	$this->load->model('kriteria_m');
	// 	$this->load->model('jenis_kriteria_m');
	// 	$this->load->model('gap_analysis_m');

	// 	$this->data['penilaian'] = $this->penilaian_m->get_row(['id_penilaian' => $this->data['id_penilaian']]);
	// 	if (!isset($this->data['penilaian']))
	// 	{
	// 		redirect('karyawan');
	// 		exit;
	// 	}

	// 	$this->data['karyawan'] = $this->karyawan_m->get_row(['id_karyawan' => $this->data['id_karyawan']]);
	// 	if (!isset($this->data['karyawan']))
	// 	{
	// 		redirect('karyawan');
	// 		exit;
	// 	}

	// 	$this->data['hasil_penilaian'] = $this->hasil_penilaian_m->get_row([
	// 		'id_penilaian'	=> $this->data['id_penilaian'],
	// 		'id_karyawan'	=> $this->data['id_karyawan']
	// 	]);
	// 	if (!isset($this->data['hasil_penilaian']))
	// 	{
	// 		redirect('karyawan');
	// 		exit;
	// 	}

	// 	$this->data['title']	= 'Detail Nilai';
	// 	$this->data['content']	= 'karyawan/detail_nilai';
	// 	$this->template($this->data);
	// }

	public function daftar_penilaian()
	{
		$this->load->model('penilaian_m');
		$this->load->model('hasil_penilaian_m');
		$this->data['penilaian']	= $this->penilaian_m->get_by_order('tgl_penilaian', 'DESC');
		$this->data['title']		= 'Daftar Penilaian';
		$this->data['content']		= 'karyawan/daftar_penilaian';
		$this->template($this->data);	
	}

	public function hasil_akhir_penilaian()
	{
		$this->data['id_penilaian'] = $this->GET('id_penilaian');

		if (!isset($this->data['id_penilaian']))
		{
			redirect('karyawan');
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
			redirect('karyawan');
			exit;
		}

		$this->data['karyawan'] = $this->karyawan_m->get_row(['id_karyawan' => $this->data['user']->id_karyawan]);
		if (!isset($this->data['karyawan']))
		{
			redirect('karyawan');
			exit;
		}

		$this->data['hasil_penilaian'] = $this->hasil_penilaian_m->get_row([
			'id_penilaian'	=> $this->data['id_penilaian'],
			'id_karyawan'	=> $this->data['user']->id_karyawan
		]);
		if (!isset($this->data['hasil_penilaian']))
		{
			redirect('manajer');
			exit;
		}

		$this->data['id_karyawan']	= $this->data['user']->id_karyawan;
		$this->data['title']		= 'Detail Nilai';
		$this->data['content']		= 'karyawan/detail_nilai';
		$this->template($this->data);
	}

	public function karyawan()
	{
		if ($this->data['id_departemen'] != 2)
		{
			redirect('karyawan');
			exit;
		}

		$this->load->model('Karyawan_m');
		$this->load->model('departemen_m');
		$this->load->model('jabatan_m');

		if ($this->POST('insert'))
		{
			$this->data['entry'] = [
				"id_karyawan" => $this->POST("id_karyawan"),
				"id_departemen" => $this->POST("id_departemen"),
				"id_jabatan" => $this->POST("id_jabatan"),
				"username" => $this->POST("username"),
				"password" => md5($this->POST("password")),
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
			redirect('karyawan/karyawan');
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
			redirect('karyawan/karyawan');
			exit;
		}

		if ($this->POST('get') && $this->POST('id_karyawan'))
		{
			$this->data['karyawan'] = $this->Karyawan_m->get_row(['id_karyawan' => $this->POST('id_karyawan')]);

			$departemen_all = $this->departemen_m->get();
			$dept = [];
			foreach ($departemen_all as $d)
			{
				$dept[$d->id_departemen] = $d->nama;
			}
			$this->data['karyawan']->departemen = form_dropdown('id_departemen', $dept, $this->data['karyawan']->id_departemen, ['class' => 'form-control', 'id' => 'edit_id_departemen']);
			
			$jabatan_all = $this->jabatan_m->get();
			$jab = [];
			foreach ($jabatan_all as $j)
			{
				$jab[$j->id_jabatan] = $j->nama;
			}
			$this->data['karyawan']->jabatan = form_dropdown('id_jabatan', $jab, $this->data['karyawan']->id_jabatan, ['class' => 'form-control', 'id' => 'edit_id_jabatan']);

			echo json_encode($this->data['karyawan']);
			exit;
		}

		$this->data['data']			= $this->Karyawan_m->get();
		$this->data['departemen_all']	= $this->departemen_m->get();
		$this->data['jabatan_all']		= $this->jabatan_m->get();
		$this->data['columns']		= ["id_karyawan","nama","NIK","id_departemen","id_jabatan","tempat_lahir","tgl_lahir","jenis_kelamin"];
		$this->data['title'] 		= 'Data Karyawan';
		$this->data['content'] 		= 'karyawan/data_karyawan';
		$this->template($this->data);
	}

	public function detail_karyawan()
	{
		if ($this->data['id_departemen'] != 2)
		{
			redirect('karyawan');
			exit;
		}

		$this->data['id_karyawan'] = $this->uri->segment(3);
		if (!isset($this->data['id_karyawan']))
		{
			redirect('admin/karyawan');
			exit;
		}

		$this->load->model('Karyawan_m');
		$this->load->model('departemen_m');
		$this->load->model('jabatan_m');

		$this->data['columns']	= ["id_karyawan","id_departemen","id_jabatan","NIK","nama","tempat_lahir","tgl_lahir","jenis_kelamin","agama","alamat","pendidikan",];
		$this->data['data'] = $this->Karyawan_m->get_row(['id_karyawan' => $this->data['id_karyawan']]);
		$this->data['title'] 	= 'Title';
		$this->data['content'] 	= 'karyawan/data_detail_karyawan';
		$this->template($this->data);
	}

	public function bobot_gap()
	{
		if ($this->data['id_departemen'] != 2) 
		{
			$this->flashmsg('<i class="fa fa-warning"></i> Anda tidak diizinkan untuk mengakses halaman tersebut', 'warning');
			redirect('karyawan');
			exit;
		}

		$this->load->model('bobot_gap_m');

		if ($this->POST('submit'))
		{
			$existing_data_count 	= count($this->POST('id_bobot'));
			$dynamic_form_count		= count($this->POST('selisih'));
			$selisih 				= $this->POST('selisih');
			$bobot_nilai 			= $this->POST('bobot_nilai');
			$keterangan 			= $this->POST('keterangan');
			$id_bobot				= $this->POST('id_bobot');

			for ($i = 0; $i < $existing_data_count; $i++)
			{
				if (trim($selisih[$i]) == '' or trim($bobot_nilai[$i]) == '')
				{
					continue;
				}

				$this->bobot_gap_m->update($id_bobot[$i], [
					'selisih'		=> $selisih[$i],
					'bobot_nilai'	=> $bobot_nilai[$i],
					'keterangan'	=> $keterangan[$i]
				]);
			}

			for ($i = $existing_data_count; $i < $dynamic_form_count; $i++)
			{
				if (trim($selisih[$i]) == '' or trim($bobot_nilai[$i]) == '')
				{
					continue;
				}

				$this->bobot_gap_m->insert([
					'selisih'		=> $selisih[$i],
					'bobot_nilai'	=> $bobot_nilai[$i],
					'keterangan'	=> $keterangan[$i]
				]);	
			}

			$this->flashmsg('<i class="fa fa-check"></i> Pengaturan bobot gap berhasil disimpan');
			redirect('karyawan/bobot-gap');
			exit;
		}

		$this->data['bobot_gap']	= $this->bobot_gap_m->get();
		$this->data['title'] 		= 'Pengaturan Bobot Gap';
		$this->data['content'] 		= 'karyawan/pengaturan_bobot_gap';
		$this->template($this->data);
	}

	public function input_penilaian()
	{
		if ($this->data['id_departemen'] != 2) 
		{
			$this->flashmsg('<i class="fa fa-warning"></i> Anda tidak diizinkan untuk mengakses halaman tersebut', 'warning');
			redirect('karyawan');
			exit;
		}

		if ($this->POST('submit'))
		{
			$this->data['entri_penilaian'] = [
				// 'standar_requirement'	=> $this->POST('standar_requirement'),
				'tgl_penilaian'			=> $this->POST('tgl_penilaian'),
				'thn_penilaian'			=> $this->POST('thn_penilaian')
			];

			$this->load->model('penilaian_m');
			$this->penilaian_m->insert($this->data['entri_penilaian']);

			$this->flashmsg('<i class="fa fa-check"></i> Data penilaian berhasil ditambahkan');
			redirect('karyawan/input-penilaian');
			exit;
		}

		$this->data['title'] 	= 'Input Penilaian';
		$this->data['content'] 	= 'manajer/input_penilaian';
		$this->template($this->data);
	}

	public function input_kriteria()
	{
		if ($this->data['id_departemen'] != 2) 
		{
			$this->flashmsg('<i class="fa fa-warning"></i> Anda tidak diizinkan untuk mengakses halaman tersebut', 'warning');
			redirect('karyawan');
			exit;
		}

		$this->load->model('jabatan_m');
		$this->load->model('kelompok_nilai_m');

		if ($this->input->get('action'))
		{
			$action = $this->input->get('action');
			if ($action == 'get_jabatan')
			{
				$jabatan = $this->jabatan_m->get();
				echo json_encode($jabatan);
			}
			else if ($action == 'get_kelompok_nilai')
			{
				$kelompok_nilai = $this->kelompok_nilai_m->get();
				echo json_encode($kelompok_nilai);
			}
			exit;
		}

		$this->load->model('departemen_m');
		$this->load->model('kriteria_m');
		$this->load->model('jenis_kriteria_m');
		$this->load->model('subkriteria_m');

		if ($this->POST('submit'))
		{
			// $this->data['entri_kriteria'] = [
			// 	'id_jenis_kriteria'	=> $this->POST('id_jenis_kriteria'),
			// 	'id_departemen'		=> $this->POST('id_departemen'),
			// 	'id_jabatan'		=> $this->POST('id_jabatan')
			// ];
			// $this->kriteria_m->insert($this->data['entri_kriteria']);

			$dynamic_form_count = count($this->POST('nama'));
			$nama 				= $this->POST('nama');
			$standar_nilai		= $this->POST('standar_nilai');
			$id_kelompok_nilai	= $this->POST('id_kelompok_nilai');
			$id_jenis_kriteria 	= $this->POST('id_jenis_kriteria');

			for ($i = 0; $i < $dynamic_form_count; $i++)
			{
				if (empty($nama[$i]) or !isset($standar_nilai[$i]) or !isset($id_kelompok_nilai[$i]))
				{
					continue;
				}

				$this->data['entri_subkriteria'] = [
					'id_jenis_kriteria'	=> $id_jenis_kriteria[$i],
					'id_kelompok_nilai'	=> $id_kelompok_nilai[$i],
					'nama'				=> $nama[$i],
					'standar_nilai'		=> $standar_nilai[$i],
					'id_departemen'		=> $this->POST('id_departemen'),
					'id_jabatan'		=> $this->POST('id_jabatan')
				];
				$this->subkriteria_m->insert($this->data['entri_subkriteria']);
			}

			$this->flashmsg('Data kriteria berhasil ditambahkan');
			redirect('karyawan/input-kriteria');
			exit;
		}

		$this->data['kompetensi'] = [
            'inti'  => [
                'Kreatif', 'Integritas & Kejujuran', 'Aktif Berkomunikasi', 'Tanggung Jawab', 'Disiplin', 'Respek & Saling Percaya', 'Inisiatif', 'Kerja Sama', 'Fokus ke Pelanggan'
            ],
            'peran' => [
                'Managerial', 'Leadership'
            ]
        ];

		$this->data['departemen']		= $this->departemen_m->get();
		$this->data['jabatan']			= $this->jabatan_m->get();
		$this->data['jenis_kriteria']	= $this->jenis_kriteria_m->get();
		$this->data['kelompok_nilai']	= $this->kelompok_nilai_m->get();
		$this->data['title'] 			= 'Input Kriteria Penilaian';
		$this->data['content'] 			= 'karyawan/input_kriteria';
		$this->template($this->data);
	}

	public function jabatan()
	{
		if ($this->data['id_departemen'] != 2)
		{
			$this->flashmsg('<i class="fa fa-warning"></i> Anda tidak diizinkan untuk mengakses halaman ini', 'warning');
			redirect('karyawan');
			exit;
		}

		$this->load->model('Jabatan_m');

		if ($this->POST('insert'))
		{
			$this->data['entry'] = [
				"id_jabatan" => $this->POST("id_jabatan"),
				"nama" => $this->POST("nama"),
			];
			$this->Jabatan_m->insert($this->data['entry']);
			redirect('karyawan/jabatan');
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
				"nama" => $this->POST("nama"),
			];
			$this->Jabatan_m->update($this->POST('edit_id_jabatan'), $this->data['entry']);
			redirect('karyawan/jabatan');
			exit;
		}

		if ($this->POST('get') && $this->POST('id_jabatan'))
		{
			$this->data['jabatan'] = $this->Jabatan_m->get_row(['id_jabatan' => $this->POST('id_jabatan')]);
			echo json_encode($this->data['jabatan']);
			exit;
		}
				
		$this->data['data']		= $this->Jabatan_m->get();
		$this->data['columns']	= ["id_jabatan","nama",];
		$this->data['title'] 	= 'Jabatan';
		$this->data['content'] 	= 'karyawan/jabatan_all';
		$this->template($this->data);
	}


	public function detail_jabatan()
	{
		if ($this->data['id_departemen'] != 2)
		{
			$this->flashmsg('<i class="fa fa-warning"></i> Anda tidak diizinkan untuk mengakses halaman ini', 'warning');
			redirect('karyawan');
			exit;
		}

		$this->load->model('Jabatan_m');

		$this->data['id_jabatan'] = $this->uri->segment(3);
		if (!isset($this->data['id_jabatan']))
		{
			redirect('karyawan/jabatan');
			exit;
		}

		$this->data['columns']	= ["id_jabatan","nama",];
		$this->data['data'] = $this->Jabatan_m->get_row(['id_jabatan' => $this->data['id_jabatan']]);
		$this->data['title'] 	= 'Jabatan';
		$this->data['content'] 	= 'karyawan/jabatan_detail';
		$this->template($this->data);
	}

	public function departemen()
	{
		$this->load->model('Departemen_m');

		if ($this->data['id_departemen'] != 2)
		{
			$this->flashmsg('<i class="fa fa-warning"></i> Anda tidak diizinkan untuk mengakses halaman ini', 'warning');
			redirect('karyawan');
			exit;
		}

		if ($this->POST('insert'))
		{
			$this->data['entry'] = [
				"id_departemen" => $this->POST("id_departemen"),
				"nama" => $this->POST("nama"),
			];
			$this->Departemen_m->insert($this->data['entry']);
			redirect('karyawan/departemen');
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
			redirect('karyawan/departemen');
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
		$this->data['title'] 	= 'Departemen';
		$this->data['content'] 	= 'karyawan/departemen_all';
		$this->template($this->data);
	}


	public function detail_departemen()
	{
		$this->load->model('Departemen_m');

		if ($this->data['id_departemen'] != 2)
		{
			$this->flashmsg('<i class="fa fa-warning"></i> Anda tidak diizinkan untuk mengakses halaman ini', 'warning');
			redirect('karyawan');
			exit;
		}

		$this->data['id_departemen'] = $this->uri->segment(3);
		if (!isset($this->data['id_departemen']))
		{
			redirect('karyawan/departemen');
			exit;
		}

		$this->data['columns']	= ["id_departemen","nama",];
		$this->data['data'] = $this->Departemen_m->get_row(['id_departemen' => $this->data['id_departemen']]);
		$this->data['title'] 	= 'Departemen';
		$this->data['content'] 	= 'karyawan/departemen_detail';
		$this->template($this->data);
	}
}