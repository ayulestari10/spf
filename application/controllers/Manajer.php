<?php 

class Manajer extends MY_Controller
{
	public function __construct()
	{
		parent::__construct();
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

	public function kriteria_penilaian()
	{
		
	}
}