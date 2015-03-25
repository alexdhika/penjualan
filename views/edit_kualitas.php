<?
foreach ($penjualan as $row){
	$id = $row->id;
	$nama = $row->nama;
	$tanggal = date('d-m-Y',strtotime($row->tanggal));
	$uraian = $row->uraian;
	$kualitas_transaksi = $row->kualitas_transaksi;
}

$a_kualitas = 
	array (
		array('1.0','Produk yang dibeli sesuai dengan pesanan awal'),
		array('1.1','Produk pesanan habis dan customer service menganjurkan konsumen untuk mencari produk pengganti'),
		array('1.5','Produk pesanan habis dan konsumen berinisiatif mencari produk pengganti'),
		array('3.0','Transaksi terjadi dari informasi stok yang sudah tersedia dari data pending produk yang habis di waktu lalu'),
		array('3.5','Transaksi terjadi karena konsumen mendapatkan pesan dari customer care'),
		array('4.8','Transaksi terjadi dari hasil follow up'),
		array('5.0','Produk yang dipesan habis dan Customer Service berhasil mengarahkan ke produk subsitusi'),
		array('7.0','Konsumen tidak mengetahui produk yang akan dibeli, transaksi terjadi karena konsultasi dengan customer service sanggup menyelesaikan masalah konsumen'),
		array('8.0','Produk yang dipesan habis dan Customer Service berhasil menggali informasi tentang produk lain yang dibutuhkan konsumen'),
		array('9.0','Customer service menawarkan produk atas inisiatif sendiri ke konsumen yang bahkan tidak membutuhkan produk tersebut sebelumnya')
	)
?>
<center>
<br>
<?echo form_open('penjualan/save_kualitas');?>
	<table border="0" width=600>
		<tr>
			<td class="td-head" colspan="3">Index Kualitas Transaksi</td>
		</tr>
		<tr>
			<td class="td-kecil">Nama Konsumen</td>
			<td class="td-kecil">:</td>
			<td class="td-kecil"><? echo $nama; ?></td>
		</tr>
		<tr>
			<td class="td-kecil">Tanggal</td>
			<td class="td-kecil">:</td>
			<td class="td-kecil"><? echo $tanggal; ?></td>
		</tr>
		<tr>
			<td class="td-kecil">Uraian</td>
			<td class="td-kecil">:</td>
			<td class="td-kecil"><? echo $uraian; ?></td>
		</tr>
		<tr>
			<td class="td-kecil" colspan="3">
				<table width="100%" cellspacing="5">
				<?php
					for ($i=0;$i<count($a_kualitas);$i++){
						$val = $a_kualitas[$i][0];
						$text = $a_kualitas[$i][1];
						$ch = ($kualitas_transaksi==$val?' checked ':'');
						echo '<tr>
							<td><input type="radio" name="kualitas" value="' .$val. '" id="' .$val. '" ' .$ch. '></td>
							<td><label for="' .$val. '">' .$text. ' (<b>' .$val. '</b>)</label></td>
						</tr>';
					}
				?>
				</table>

			</td>
		</tr>
		<tr>
			<td class="td-kecil" colspan="3" style="text-align:center;"><input type="submit" value="Simpan"></td>
		</tr>

	</table>
<?
	if (!empty($id)){
		echo '<input type="hidden" name="id" value="' .$id. '">';
	}
?>
<? echo form_close(); ?>
</center>
<br><br><br><br><br>
