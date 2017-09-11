<?php 

class Manajer extends MY_Controller
{
	public function __construct()
	{
		parent::__construct();

		$this->data['id_departemen'] 	= $this->session->userdata('id_departemen');
		$this->data['id_jabatan']		= $this->session->userdata('id_jabatan');

		if ($this->data['id_departemen'] != 2 && $this->data['id_jabatan'] != 3)
		{
			redirect('logout');
			$this->flashmsg('Anda tidak diizinkan untuk mengakses halaman ini','danger');
			exit;
		}
		$this->data['username'] = $this->session->userdata('username');
	}

	public function index()
	{
		$this->load->model('gap_analysis_m');
		$this->load->model('nilai_m');
		$standar_nilai = $this->gap_analysis_m->profil_jabatan(4, 1, 1);
		$profil_jabatan = [];
		foreach ($standar_nilai as $row)
		{
			$profil_jabatan []= $row->profil_jabatan;
		}

		$nilai_karyawan = $this->nilai_m->get(['id_karyawan' => 1]);
		echo '<h3>Kompetensi Inti</h3>';
		echo '<table>';
		echo '<thead>
					<tr>
						<th>Kompetensi Inti</th>
						<th>K001</th>
						<th>Profil Jabatan</th>
						<th>Gap</th>
						<th>Bobot Nilai</th>
					</tr>
				</thead>
				<tbody>
		';
		$bobot = [
			'0'		=> 5,
			'1' 	=> 4.5,
			'-1'	=> 4,
			'2'		=> 3.5,
			'-2'	=> 3,
			'3'		=> 2.5,
			'-3'	=> 2,
			'4'		=> 1.5,
			'-4'	=> 1
		];
		foreach ($profil_jabatan as $key => $val)
		{
			$gap = $this->gap_analysis_m->gap($nilai_karyawan[$key]->nilai, $val);
			echo '<tr>';
			echo '<td>KI0' . $key . '</td>';
			echo '<td>' . $nilai_karyawan[$key]->nilai . '</td>';
			echo '<td>' . $val . '</td>';
			echo '<td>' . $gap . '</td>';
			echo '<td>' . $bobot[(string)$gap] . '</td>';
			echo '</tr>';
		}
		echo '</tbody></table>';

		$ncf = $this->gap_analysis_m->factor(1, 1, 4, 1, 1, 1);
		$nsf = $this->gap_analysis_m->factor(1, 1, 4, 2, 1, 1);
		$aspect_ki = $this->gap_analysis_m->aspect($ncf, $nsf);
		echo '<h1>Factor KI</h1>';
		echo "<p>Core factor: " . $ncf. "</p>";
		echo "<p>Secondary factor: " . $nsf . "</p>";
		echo "<p>Aspect value: " . $aspect_ki . "</p>";

		$ncf = $this->gap_analysis_m->factor(1, 1, 5, 1, 1, 1);
		$nsf = $this->gap_analysis_m->factor(1, 1, 5, 2, 1, 1);
		$aspect_kp = $this->gap_analysis_m->aspect($ncf, $nsf);
		echo '<h1>Factor KP</h1>';
		echo "<p>Core factor: " . $ncf. "</p>";
		echo "<p>Secondary factor: " . $nsf . "</p>";
		echo "<p>Aspect value: " . $aspect_kp . "</p>";

		$ncf = $this->gap_analysis_m->factor(1, 1, 6, 1, 1, 1);
		$nsf = $this->gap_analysis_m->factor(1, 1, 6, 2, 1, 1);
		$aspect_kf = $this->gap_analysis_m->aspect($ncf, $nsf);
		echo '<h1>Factor KF</h1>';
		echo "<p>Core factor: " . $ncf. "</p>";
		echo "<p>Secondary factor: " . $nsf . "</p>";
		echo "<p>Aspect value: " . $aspect_kf . "</p>";

		echo '<h3>Performance: ' . $this->gap_analysis_m->performance($aspect_ki, $aspect_kp, $aspect_kf) . '</h3>';
	}

	public function penilaian()
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

		if ($this->POST('validasi') && $this->POST('id_karyawan'))
		{
			$this->load->model('acc_penilaian_m');
			$this->load->model('hasil_penilaian_m');
			$check_hasil = $this->hasil_penilaian_m->get_row(['id_penilaian' => $this->data['id_penilaian'], 'id_karyawan' => $this->POST('id_karyawan')]);
			$response['error'] = FALSE;
			if ($check_hasil)
			{
				$check_validasi = $this->acc_penilaian_m->get_row(['id_hasil' => $check_hasil->id_hasil]);
				if ($check_validasi)
				{
					$this->data['entri_acc'] = [
						'validasi_hrd'			=> $check_validasi->validasi_hrd ? 0 : 1,
						'validasi_dept_manajer'	=> $check_validasi->validasi_dept_manajer,
						'validasi_pimpinan'		=> $check_validasi->validasi_pimpinan,
						'status_acc'			=> !$check_validasi->validasi_hrd && $check_validasi->validasi_dept_manajer && $check_validasi->validasi_pimpinan ? 'Valid' : 'Tidak valid',
						'tgl_acc'				=> date('Y-m-d')
					];
					$this->acc_penilaian_m->update($check_validasi->id_hasil, $this->data['entri_acc']);
				}
				else
				{
					$this->data['entri_acc'] = [
						'id_hasil'				=> $check_hasil->id_hasil,
						'validasi_hrd'			=> 1,
						'validasi_dept_manajer'	=> 0,
						'validasi_pimpinan'		=> 0,
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

		$this->data['karyawan'] = $this->karyawan_m->get(['id_departemen' => 1]);
		$this->data['title'] 	= 'Data Penilaian';
		$this->data['content'] 	= 'manajer/penilaian';
		$this->template($this->data);
	}

	public function input_penilaian()
	{
		if ($this->POST('submit'))
		{
			$this->data['entri_penilaian'] = [
				'standar_requirement'	=> $this->POST('standar_requirement'),
				'tgl_penilaian'			=> $this->POST('tgl_penilaian'),
				'thn_penilaian'			=> $this->POST('thn_penilaian')
			];

			$this->load->model('penilaian_m');
			$this->penilaian_m->insert($this->data['entri_penilaian']);

			$dynamic_form_count = count($this->POST('selisih'));
			$selisih 		= $this->POST('selisih');
			$bobot_nilai	= $this->POST('bobot_nilai');
			$keterangan		= $this->POST('keterangan');
			$id_penilaian	= $this->db->insert_id();
			$this->load->model('bobot_gap_m');

			for ($i = 0; $i < $dynamic_form_count; $i++)
			{
				if (empty($selisih[$i]) or empty($bobot_nilai[$i]))
				{
					continue;
				}

				$this->data['entri_bobot_gap'] = [
					'id_penilaian'	=> $id_penilaian,
					'selisih'		=> $selisih[$i],
					'bobot_nilai'	=> $bobot_nilai[$i],
					'keterangan'	=> $keterangan[$i]
				];
				$this->bobot_gap_m->insert($this->data['entri_bobot_gap']);
			}

			$this->flashmsg('Data penilaian berhasil ditambahkan');
			redirect('manajer/input-penilaian');
			exit;
		}

		$this->data['title'] 	= 'Input Penilaian';
		$this->data['content'] 	= 'manajer/input_penilaian';
		$this->template($this->data);
	}

	public function input_kriteria()
	{
		$this->load->model('jabatan_m');
		$this->load->model('kelompok_nilai_m');

		if ($this->input->get('action'))
		{
			$action = $this->input->get('action');
			if ($action == 'get_jabatan')
			{
				$jabatan = $this->jabatan_m->get(['id_departemen' => $this->input->get('id_departemen')]);
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
			$this->data['entri_kriteria'] = [
				'id_jenis_kriteria'	=> $this->POST('id_jenis_kriteria'),
				'id_departemen'		=> $this->POST('id_departemen'),
				'id_jabatan'		=> $this->POST('id_jabatan')
			];
			$this->kriteria_m->insert($this->data['entri_kriteria']);

			$dynamic_form_count = count($this->POST('nama'));
			$nama 				= $this->POST('nama');
			$standar_nilai		= $this->POST('standar_nilai');
			$id_kelompok_nilai	= $this->POST('id_kelompok_nilai');
			$id_kriteria 		= $this->db->insert_id();

			for ($i = 0; $i < $dynamic_form_count; $i++)
			{
				if (empty($nama[$i]) or !isset($standar_nilai[$i]) or !isset($id_kelompok_nilai[$i]))
				{
					continue;
				}

				$this->data['entri_subkriteria'] = [
					'id_kriteria'		=> $id_kriteria,
					'id_kelompok_nilai'	=> $id_kelompok_nilai[$i],
					'nama'				=> $nama[$i],
					'standar_nilai'		=> $standar_nilai[$i]
				];
				$this->subkriteria_m->insert($this->data['entri_subkriteria']);
			}

			$this->flashmsg('Data kriteria berhasil ditambahkan');
			redirect('manajer/input-kriteria');
			exit;
		}

		$this->data['departemen']		= $this->departemen_m->get();
		$this->data['jabatan']			= $this->jabatan_m->get();
		$this->data['jenis_kriteria']	= $this->jenis_kriteria_m->get();
		$this->data['kelompok_nilai']	= $this->kelompok_nilai_m->get();
		$this->data['title'] 			= 'Input Kriteria Penilaian';
		$this->data['content'] 			= 'manajer/input_kriteria';
		$this->template($this->data);
	}

	public function input_nilai_karyawan()
	{
		$this->data['id_karyawan'] 	= $this->GET('id_karyawan');
		$this->data['id_penilaian']	= $this->GET('id_penilaian');
		if (!isset($this->data['id_karyawan']) or !isset($this->data['id_penilaian']))
		{
			$this->flashmsg('<i class="fa fa-warning"></i> Data karyawan atau data penilaian tidak ditemukan', 'danger');
			redirect('manajer/penilaian');
			exit;
		}

		$this->load->model('karyawan_m');
		$this->data['karyawan'] = $this->karyawan_m->get_row(['id_karyawan' => $this->data['id_karyawan']]);
		if (!isset($this->data['karyawan']))
		{
			$this->flashmsg('<i class="fa fa-warning"></i> Data karyawan dengan ID ' . $this->data['id_karyawan'] . ' tidak ditemukan', 'danger');
			redirect('manajer/penilaian');
			exit;
		}

		$this->data['id_departemen'] 	= $this->data['karyawan']->id_departemen;
		$this->data['id_jabatan']		= $this->data['karyawan']->id_jabatan;

		$this->load->model('kriteria_m');
		$this->data['kriteria']	= $this->kriteria_m->get([
			'id_departemen'	=> $this->data['id_departemen'],
			'id_jabatan'	=> $this->data['id_jabatan']
		]);

		$this->load->model('jenis_kriteria_m');
		$this->load->model('departemen_m');
		$this->load->model('jabatan_m');
		$this->load->model('subkriteria_m');
		$this->load->model('nilai_m');

		if ($this->POST('submit'))
		{
			$id_sub = $this->POST('id_sub');
			foreach ($id_sub as $id)
			{
				$this->data['entri_nilai'] = [
					'id_penilaian'		=> $this->data['id_penilaian'],
					'id_karyawan'		=> $this->data['id_karyawan'],
					'id_jenis_kriteria'	=> $this->POST('jenis_sub_' . $id),
					'id_subkriteria'	=> $id,
					'nilai'				=> $this->POST('nilai_sub_' . $id)
				];

				$check_nilai = $this->nilai_m->get_row([
					'id_penilaian'		=> $this->data['id_penilaian'],
					'id_karyawan'		=> $this->data['id_karyawan'],
					'id_jenis_kriteria'	=> $this->POST('jenis_sub_' . $id),
					'id_subkriteria'	=> $id
				]);

				if (isset($check_nilai))
				{
					$this->nilai_m->update($check_nilai->id_nilai, [
						'nilai'	=> $this->POST('nilai_sub_' . $id)
					]);
				}
				else
				{
					$this->nilai_m->insert($this->data['entri_nilai']);
				}
			}

			$kompetensi = $this->jenis_kriteria_m->get(); // select all (?)
			$this->load->model('gap_analysis_m');
			$aspect = [];
			foreach ($kompetensi as $row)
			{
				$standar_nilai = $this->gap_analysis_m->profil_jabatan($row->id_jenis_kriteria, $this->data['id_departemen'], $this->data['id_jabatan']);
				$profil_jabatan = [];
				foreach ($standar_nilai as $sn)
				{
					$profil_jabatan []= $sn->profil_jabatan;
				}

				$nilai_karyawan = $this->nilai_m->get(['id_karyawan' => $this->data['id_karyawan']]);

				$this->load->model('bobot_gap_m');
				$bobot_gap = $this->bobot_gap_m->get(['id_penilaian' => $this->data['id_penilaian']]);
				$bobot = [];
				foreach ($bobot_gap as $bg)
				{
					$bobot[(string)$bg->selisih] = $bg->bobot_nilai;
				}

				$this->load->model('kelompok_nilai_m');
				$kelompok_nilai = $this->kelompok_nilai_m->get();
				$factor = [];
				foreach ($kelompok_nilai as $kn)
				{
					$factor []= $this->gap_analysis_m->factor($this->data['id_penilaian'], $this->data['id_karyawan'], $row->id_jenis_kriteria, $kn->id_kelompok_nilai, $this->data['id_departemen'], $this->data['id_jabatan']);
				}

				$aspect []= $this->gap_analysis_m->aspect($factor[0], $factor[1]);
			}

			$performance = $this->gap_analysis_m->performance($aspect[0], $aspect[1], $aspect[2]);
			$this->data['entri_hasil'] = [
				'id_penilaian'			=> $this->data['id_penilaian'],
				'id_karyawan'			=> $this->data['id_karyawan'],
				'kompetensi_inti'		=> $aspect[0],
				'kompetensi_peran'		=> $aspect[1],
				'kompetensi_fungsional'	=> $aspect[2],
				'hasil_akhir'			=> $performance
			];
			$this->load->model('hasil_penilaian_m');
			$check_hasil = $this->hasil_penilaian_m->get_row([
				'id_penilaian'			=> $this->data['id_penilaian'],
				'id_karyawan'			=> $this->data['id_karyawan']
			]);
			if (isset($check_hasil))
			{
				$this->hasil_penilaian_m->update($check_hasil->id_hasil, $this->data['entri_hasil']);
			}
			else
			{
				$this->hasil_penilaian_m->insert($this->data['entri_hasil']);
			}

			$this->flashmsg('<i class="fa fa-check"></i> Nilai karyawan berhasil disimpan. <a href="' . base_url('manajer/penilaian-detail?id_penilaian=' . $this->data['id_penilaian']) . '"><u>Kembali</u></a>');
			redirect('manajer/input-nilai-karyawan?id_penilaian=' . $this->data['id_penilaian'] . '&id_karyawan=' . $this->data['id_karyawan']);
			exit;
		}

		$this->data['title']	= 'Input Nilai Karyawan';
		$this->data['content']	= 'manajer/input_nilai_karyawan';
		$this->template($this->data);
	}
}