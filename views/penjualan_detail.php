<div style="padding-left:10px;">
<?
	foreach ($penjualan as $row){
		echo '<p>Tanggal : ' .date('d-m-Y',strtotime($row->tanggal)).'</p>';
		echo '<p>Nama : ' .$row->nama.'</p>';
		echo '<p><b>Alamat : ' .$row->alamat.'</b></p>';
		echo '<p>No. Telp : ' .$row->nomer.'</p>';
		echo '<p>Website : ' .$row->website.'</p>';
		echo '<p>Jasa Pengiriman : ' .$row->ekspedisi.'</p>';
		echo '<p>No. Resi : ' .$row->no_resi.'</p>';
		echo '<p>Harga Jual : ' .number_format($row->harga_jual,0,',','.').'</p>';
		switch ($row->status) {
			case 0:
				$status = 'Normal';
				break;
			case 2:
				$status = 'Batal/Refund';
				break;
			default:
				$status = 'Pending';
				break;
		}
		echo '<p>Status : <b>' .$status.'</b></p>';
		echo '<p>Catatan Status : ' .$row->catatan_status.'</p>';
	}
?>
</div>
