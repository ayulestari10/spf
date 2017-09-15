<center>
	<h2>Laporan Penilaian Karyawan</h2>
</center>
<style type="text/css">
	tr, td {
		text-align: center;
		border-collapse: collapse;
	}
</style>
<hr>
<table style="width: 100%; border-collapse: collapse;" border="1">
	<thead>
		<tr>
			<th rowspan="2">Karyawan</th>
			<th colspan="3">Aspek</th>
			<th rowspan="2">Hasil Akhir</th>
			<th rowspan="2">Rangking</th>
		</tr>
		<tr>
			<th>KI</th>
			<th>KP</th>
			<th>KF</th>
		</tr>
	</thead>
	<tbody>
		<?php foreach ($karyawan as $row): ?>
		<tr>
			<td><?= $row->id_karyawan ?></td>
			<td><?= $row->kompetensi_inti ?></td>
			<td><?= $row->kompetensi_peran ?></td>
			<td><?= $row->kompetensi_fungsional ?></td>
			<td><?= $row->hasil_akhir ?></td>
			<td><?= $row->rank ?></td>
		</tr>
		<?php endforeach; ?>
	</tbody>
</table>