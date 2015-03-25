<?php
echo '<div style="padding-left:10px;">';
	echo '<h1>Proses</h1>';
	foreach ($generate as $row){
		if (empty($row->nama_penerima)){
			$nama = $row->nama;
		} else {
			$nama = $row->nama_penerima;
		}

		if (empty($row->alamat_penerima)){
			$alamat = $row->alamat;
		} else {
			$alamat = $row->alamat_penerima;
		}

		if (empty($row->notelp_penerima)){
			$notelp = $row->nomer;
		} else {
			$notelp = $row->notelp_penerima;
		}

		$ket = '';
		if (!empty($row->keterangan)){
			$ket = ' (' . $row->keterangan . ')';
		}

		echo $row->uraian . $ket . ',' . $nama . ',' . $alamat . ',' . $notelp . ' (' . $row->singkatan . ' - ' .$row->bNumber. ')';
		echo '<br><br>';
	}

	echo '<h1>Rincian</h1>';
	foreach ($generate as $row){
		$hb = $row->harga_beli/1000;
		$b = $row->biaya/1000;
		$tt = $hb + $b;
		$total += $tt;
		$ket = '';
		if (!empty($row->keterangan)){
			$ket = ' (' . $row->keterangan . ')';
		}
		echo $row->uraian . $ket . ' [' . $hb . '+' . $b . '] = ' . $tt . ', ';
	}
	echo 'TOTAL : ' . $total;
echo '</div>';
?>
