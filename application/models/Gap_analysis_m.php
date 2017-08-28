<?php 

class Gap_analysis_m extends MY_Model 
{
	public function __construct()
	{
		parent::__construct();
	}

	public function gap($profil_karyawan, $profil_jabatan)
	{
		
		return $profil_karyawan - $profil_jabatan;
	}

	public function profil_jabatan($id_jenis_kriteria, $id_departemen, $id_jabatan)
	{
		$this->db->select('id_subkriteria, subkriteria.standar_nilai AS profil_jabatan');
		$this->db->from('kriteria');
		$this->db->join('subkriteria', 'kriteria.id_kriteria = subkriteria.id_kriteria', 'left');
		$this->db->where('kriteria.id_jabatan', $id_jabatan);
		$this->db->where('kriteria.id_jenis_kriteria', $id_jenis_kriteria);
		$this->db->where('kriteria.id_departemen', $id_departemen);
		$query = $this->db->get();
		return $query->result();
	}

	/**
	 * function to get core/secondary factor value
	 * @int id_penilaian
	 * @int id_karyawan
	 * @int id_jenis_kriteria -> kompetensi inti, peran, atau fungsional
	 * @int id_kelompok_nilai -> core factor atau secondary factor
	 * @int id_departemen
	 * @int id_jabatan
	 */
	public function factor($id_penilaian, $id_karyawan, $id_jenis_kriteria, $id_kelompok_nilai, $id_departemen, $id_jabatan)
	{
		$this->db->select('nilai.id_penilaian, nilai.id_karyawan, subkriteria.id_kelompok_nilai, (nilai.nilai - subkriteria.standar_nilai) AS nilai_gap');
		$this->db->from('nilai');
		$this->db->join('subkriteria', 'subkriteria.id_subkriteria = nilai.id_subkriteria');
		$this->db->where('nilai.id_penilaian', $id_penilaian);
		$this->db->where('nilai.id_karyawan', $id_karyawan);
		$this->db->where('nilai.id_jenis_kriteria', $id_jenis_kriteria);
		$this->db->where('subkriteria.id_kelompok_nilai', $id_kelompok_nilai);
		$query 			= $this->db->get();
		$result 		= $query->result();
		$result_length 	= count($result); 
		$total 			= 0;
		if ($result_length > 0)
		{
			$this->load->model('bobot_gap_m');
			$bobot_gap = $this->bobot_gap_m->get(['id_penilaian' => $id_penilaian]);
			$bobot = [];
			foreach ($bobot_gap as $row)
			{
				$bobot[(string)$row->selisih] = $row->bobot_nilai;
			}

			foreach ($result as $row)
			{
				$total += $bobot[(string)$row->nilai_gap];
			}

			return (float)$total / (float)$result_length;
		}
		else
		{
			return 0;
		}
	}

	public function aspect($ncf, $nsf)
	{
		return 0.6 * (float)$ncf + 0.4 * (float)$nsf;
	}

	public function performance($aspect_ki, $aspect_kp, $aspect_kf)
	{
		return 0.65 * (float)$aspect_ki + 0.25 * (float)$aspect_kp + 0.1 * (float)$aspect_kf;
	}
}